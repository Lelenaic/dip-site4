FROM php:latest

RUN apt-get update \
&& apt-get install git -yqq

WORKDIR /app

CMD git clone "https://github.com/Lelenaic/dip-site4" .
CMD php -S 0.0.0.0:8192