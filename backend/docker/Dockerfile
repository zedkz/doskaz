FROM webdevops/php-nginx:7.3 AS base

RUN apt-get update \
    && apt-get install -y \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install -j$(nproc) \
        pdo_pgsql
USER application
RUN composer global require hirak/prestissimo
WORKDIR /app
ENV WEB_DOCUMENT_ROOT /app/public
RUN mkdir /app/storage
VOLUME /app/storage
USER root

FROM base
USER application
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-suggest && \
    composer clear-cache
COPY . .
RUN composer dump-autoload --optimize
RUN php bin/console c:c --env=prod --no-debug
USER root
ENV APP_ENV prod
