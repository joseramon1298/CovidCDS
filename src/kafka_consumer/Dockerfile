FROM python:3.8
RUN pip install --upgrade pip
COPY requirements.txt .
RUN pip install -r requirements.txt
COPY kafka_consumer.py /app/
WORKDIR /app
CMD ["python", "kafka_consumer.py"]