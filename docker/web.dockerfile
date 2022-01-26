FROM nginx:stable

ADD config/vhost.conf /etc/nginx/conf.d/default.conf

RUN apt update && apt -y upgrade