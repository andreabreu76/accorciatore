#Imagem Padrão utilizada na Afilio até 22/10/2020
#FROM php:7.4.11-fpm
FROM php:8.1.2-fpm-buster

# Add Repositorio NODE
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

#Atualização da imagem a ser utilizada no container
RUN apt update && apt -y upgrade 

# Instalação para atender demanda do framework Laravel & NODEJS
RUN apt install -y --no-install-recommends curl apt-utils mcrypt libpq-dev libz-dev libfreetype6-dev zlib1g-dev libssl-dev libmcrypt-dev libxml2-dev libxslt-dev libzip-dev libbz2-dev libmcrypt-dev nodejs\ 
  && docker-php-ext-install pcntl \
  && docker-php-ext-configure gd \
  && docker-php-ext-install zip \
  && docker-php-ext-install bz2 \
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-install mysqli \
  && docker-php-ext-install xsl

# Instalação do COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove arquivos de instalação dos pacotes de atualização.
RUN rm -rf /var/lib/apt/lists/*

