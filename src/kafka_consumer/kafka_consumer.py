import json
from kafka import KafkaConsumer
import mysql.connector

# MySQL connection
conn = mysql.connector.connect(user='root', password='',
                                host='covidcds-mysql-1',
                                database='covid')
cursor = conn.cursor()

# Kafka consumer
consumer = KafkaConsumer('casos',
                         bootstrap_servers=['kafka:29092'],
                         value_deserializer=lambda x: json.loads(x.decode('utf-8')))

for message in consumer:
    data = message.value
    print(data)
    nuevos_casos = data['records']
    
    for caso in nuevos_casos:
        fecha = caso['fields']['fecha']
        provincia = caso['fields']['provincia']
        casos_confirmados = caso['fields']['casos_confirmados']
        nuevos_positivos = caso['fields']['nuevos_positivos']
        altas = caso['fields']['altas']
        fallecimientos = caso['fields']['fallecimientos']
        
        # Check if the record already exists in the database
        query = f"SELECT * FROM casos WHERE fecha='{fecha}' AND provincia='{provincia}'"
        cursor.execute(query)
        result = cursor.fetchone()
        
        # If the record doesn't exist in the database, insert it
        if not result:
            cursor.execute("INSERT INTO casos (fecha, provincia, nuevos_positivos, casos_confirmados, altas, fallecimientos) VALUES (%s, %s, %s, %s, %s, %s)", (fecha, provincia, nuevos_positivos, casos_confirmados, altas, fallecimientos))
            conn.commit()
    
    # Count the number of records in the table
    cursor.execute("SELECT COUNT(*) FROM casos")
    count = cursor.fetchone()[0]

    # If the number of records exceeds 100, delete the oldest records
    if count > 100:
        cursor.execute("DELETE FROM casos ORDER BY fecha ASC LIMIT %s", (count - 100,))
        conn.commit()
            
cursor.close()
conn.close()