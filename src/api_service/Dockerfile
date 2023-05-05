FROM python:3.9
RUN apt-get update && apt-get install -y iputils-ping
RUN pip install --upgrade pip
COPY requirements.txt .
RUN pip install -r requirements.txt
COPY api_service.py /app/
WORKDIR /app
CMD ["python", "api_service.py"]
