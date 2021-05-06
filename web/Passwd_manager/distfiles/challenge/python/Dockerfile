FROM python:3.7

WORKDIR /app

ADD . /app/

RUN pip install --upgrade pip && \
    pip install flask requests

CMD ["python", "main.py"]