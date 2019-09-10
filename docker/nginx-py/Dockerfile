FROM nginx:latest

RUN rm /etc/nginx/conf.d/default.conf
COPY docker/nginx-py/proxy.conf /etc/nginx/conf.d
