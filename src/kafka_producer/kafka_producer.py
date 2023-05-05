import json
import time
import requests
from kafka import KafkaProducer, KafkaAdminClient
from kafka.errors import KafkaTimeoutError

# Kafka producer
producer = KafkaProducer(
    bootstrap_servers=['kafka:29092'],
    value_serializer=lambda x: json.dumps(x).encode('utf-8'),
)

while True:
    try:
        response = requests.get('https://analisis.datosabiertos.jcyl.es/api/records/1.0/search/?dataset=situacion-epidemiologica-coronavirus-en-castilla-y-leon&q=&rows=100&sort=fecha', timeout=10)
        response.raise_for_status()
        data = response.json()

        # Send the data to the Kafka topic
        future = producer.send('casos', value=data)
        result = future.get(timeout=120)
        print(result)
    except requests.exceptions.RequestException as e:
        print('Error:', e)

    time.sleep(120)


