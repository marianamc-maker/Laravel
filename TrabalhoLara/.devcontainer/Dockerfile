FROM mcr.microsoft.com/devcontainers/php:8.2

# Instalar extensões necessárias para Laravel
RUN apt-get update && \
    apt-get install -y \
      libpng-dev \
      libonig-dev \
      libxml2-dev \
      zip unzip git curl \
      && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Node já vem via recursos do devcontainer.json
