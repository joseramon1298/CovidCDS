FROM python:3.9
RUN pip install --upgrade pip
COPY requirements.txt .
RUN pip install -r requirements.txt
COPY api_gateway.py /app/
WORKDIR /app
CMD ["python", "api_gateway.py"]