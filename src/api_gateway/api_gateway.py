import requests
from flask import Flask, jsonify, request
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

API_SERVICE_URL = 'http://api_service:8000'

@app.route('/casos', methods=['GET'])
def obtener_casos():
    response = requests.get(API_SERVICE_URL + '/casos')
    return jsonify(response.json())

@app.route('/resumen', methods=['GET'])
def obtener_resumen():
    response = requests.get(API_SERVICE_URL + '/resumen')
    return jsonify(response.json())

@app.route('/datos', methods=['GET'])
def obtener_datos():
    response = requests.get(API_SERVICE_URL + '/datos')
    return jsonify(response.json())

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=9000)

