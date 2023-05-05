import mysql.connector
from flask import Flask, jsonify, request
from flask_cors import CORS
import threading

app = Flask(__name__)
CORS(app)

def obtener_conexion():
    conexion = mysql.connector.connect(
        host='covidcds-mysql-1',
        user="root",
        password="", 
        database="covid"
    )
    return conexion

def obtener_datos_desde_bd(cursor):
    # Consulta para obtener los datos de la tabla "casos"
    consulta = "SELECT provincia, MAX(casos_confirmados), MAX(fallecimientos) FROM casos GROUP BY provincia ORDER BY provincia ASC"
    cursor.execute(consulta)
    resultados = cursor.fetchall()

    # Transformar los resultados de la consulta en una lista de diccionarios
    datos = []
    for resultado in resultados:
        dato = {
            "provincia": resultado[0],
            "casos_confirmados": round(resultado[1], 2),
            "fallecimientos": round(resultado[2], 2)
        }
        datos.append(dato)

    return datos

def actualizar_datos():
    conexion = obtener_conexion()
    cursor = conexion.cursor()
    datos_db = obtener_datos_desde_bd(cursor)
    cursor.close()
    conexion.close()

    # Programar la siguiente ejecución de la función para dentro de 600 segundos
    threading.Timer(600, actualizar_datos).start()

    return datos_db

@app.route('/datos', methods=['GET'])
def obtener_datos():
    return jsonify(actualizar_datos())


def obtener_casos_desde_bd(cursor):
    # Consulta para obtener los datos de la tabla "casos"
    consulta = "SELECT * FROM casos ORDER BY fecha DESC"
    cursor.execute(consulta)
    resultados = cursor.fetchall()

    # Transformar los resultados de la consulta en una lista de diccionarios
    casos = []
    for resultado in resultados:
        caso = {
            "id": resultado[0],
            "fecha": resultado[1],
            "provincia": resultado[2],
            "casos_confirmados": resultado[3],
            "nuevos_positivos": resultado[4],
            "altas": resultado[5],
            "fallecimientos": resultado[6]
        }
        casos.append(caso)

    return casos

def actualizar_casos():
    conexion = obtener_conexion()
    cursor = conexion.cursor()
    casos_db = obtener_casos_desde_bd(cursor)
    cursor.close()
    conexion.close()

    # Programar la siguiente ejecución de la función para dentro de 600 segundos
    threading.Timer(600, actualizar_casos).start()

    return casos_db

    
@app.route('/casos', methods=['GET'])
def obtener_casos():
    return jsonify(actualizar_casos())

def obtener_resumen_desde_bd(cursor):
    # Consulta para obtener la provincia con más casos de cada día
    consulta = """
        SELECT t1.fecha,
               t1.provincia,
               t1.nuevos_positivos
        FROM (
            SELECT fecha,
                   provincia,
                   SUM(nuevos_positivos) AS nuevos_positivos
            FROM casos
            GROUP BY fecha, provincia
        ) t1
        JOIN (
            SELECT fecha,
                   MAX(nuevos_positivos) AS max_nuevos_positivos
            FROM (
                SELECT fecha,
                       provincia,
                       SUM(nuevos_positivos) AS nuevos_positivos
                FROM casos
                GROUP BY fecha, provincia
            ) t2
            GROUP BY fecha
        ) t3
        ON t1.fecha = t3.fecha AND t1.nuevos_positivos = t3.max_nuevos_positivos
        ORDER BY t1.fecha DESC;
    """
    cursor.execute(consulta)
    resultados_provincia = cursor.fetchall()

    # Crear un diccionario para almacenar la provincia con más casos de cada día
    provincias = {}
    for resultado in resultados_provincia:
        provincias[resultado[0]] = resultado[1]

    # Consulta para obtener los datos de la tabla "casos"
    consulta = """
        SELECT fecha,
               SUM(casos_confirmados) AS casos_confirmados,
               SUM(nuevos_positivos) AS nuevos_positivos,
               SUM(altas) AS altas,
               SUM(fallecimientos) AS fallecimientos
        FROM casos
        GROUP BY fecha
        ORDER BY fecha DESC;
    """
    cursor.execute(consulta)
    resultados = cursor.fetchall()

    resumenes = []
    for resultado in resultados:
        fecha = resultado[0]
        casos_confirmados = resultado[1]
        nuevos_positivos = resultado[2]
        altas = resultado[3]
        fallecimientos = resultado[4]

        # Obtener la provincia con más casos para esta fecha
        if fecha in provincias:
            provincia_mas_casos = provincias[fecha]
            texto_provincia_mas_casos = f" La provincia con más casos es {provincia_mas_casos}."
        else:
            texto_provincia_mas_casos = ""

        # Generar el texto del resumen
        texto = f"El día {fecha} ha habido un total de {casos_confirmados} casos confirmados en Castilla y León desde el inicio de la pandemia. Se han registrado {nuevos_positivos} nuevos positivos, {altas} altas y {fallecimientos} fallecimientos.{texto_provincia_mas_casos}"

        resumenes.append({
            'fecha': fecha,
            'resumen': texto
        })

    return resumenes

def actualizar_resumen():
    conexion = obtener_conexion()
    cursor = conexion.cursor()
    resumenes_db = obtener_resumen_desde_bd(cursor)
    cursor.close()
    conexion.close()

    # Programar la siguiente ejecución de la función para dentro de 600 segundos
    threading.Timer(600, actualizar_resumen).start()

    return resumenes_db

@app.route('/resumen', methods=['GET'])
def obtener_resumen():
    return jsonify(actualizar_resumen())

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8000)