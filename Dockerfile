FROM laravelsail/php82-composer

# Set working directory
WORKDIR /var/www/html

# Install MySQL client
RUN apt-get update && \
    apt-get install -y default-mysql-client && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-enable pdo_mysql

# Copy everything
COPY . .

# Laravel startup
CMD bash -c "\
    composer install && \
    php artisan key:generate && \
    php artisan migrate --force || true && \
    php artisan serve --host=0.0.0.0 --port=8000 \
"
