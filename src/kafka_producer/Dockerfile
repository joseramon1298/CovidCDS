FROM python:3.8
RUN pip install --upgrade pip
COPY requirements.txt .
RUN pip install -r requirements.txt
COPY kafka_producer.py /app/
WORKDIR /app
CMD ["python", "kafka_producer.py"]