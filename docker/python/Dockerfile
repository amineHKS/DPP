FROM python:3-alpine

MAINTAINER AmineHKS

COPY docker/python/app/requirements.txt /var/www/html/requirements.txt

WORKDIR /var/www/html

RUN pip install --upgrade pip  \
  && pip install -r requirements.txt

COPY docker/python/app/app.py /var/www/html/app.py

EXPOSE 8088

CMD ["python", "app.py"]
