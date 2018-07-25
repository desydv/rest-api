FROM hephaestus/alpine-php:latest

WORKDIR /var/www
COPY . /var/www
RUN chmod +x logs