# Use uma imagem base moderna do PHP-FPM (Alpine é leve)
FROM php:8.3-fpm-alpine

# Defina o diretório de trabalho
WORKDIR /var/www/symfony_docker

# Instale dependências do sistema necessárias para as extensões do PHP e ferramentas
# $PHPIZE_DEPS são dependências necessárias para compilar extensões
RUN apk add --no-cache \
    $PHPIZE_DEPS \
    icu-dev \
    libzip-dev \
    libpng-dev \
    git \
    unzip \
    curl

# Instale as extensões PHP comuns necessárias para o Symfony
RUN docker-php-ext-install \
    pdo_mysql \
    intl \
    zip \
    opcache \
    gd

# Instale o Composer (gerenciador de pacotes do PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# A imagem base alpine do php-fpm já usa o usuário 'www-data'.
# Os volumes serão montados com as permissões do host,
# então vamos executar o composer como o usuário do host nas instruções do README.

# Exponha a porta 9000 (padrão do FPM)
EXPOSE 9000
