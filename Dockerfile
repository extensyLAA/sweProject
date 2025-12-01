# Imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões necessárias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia todos os arquivos do seu repositório para a pasta do Apache
COPY . /var/www/html

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80