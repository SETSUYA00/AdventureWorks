FROM dunglas/frankenphp:php8.2-bookworm

# Install the required PHP extensions
RUN install-php-extensions intl mysqli pdo_mysql

# Install unzip (required by Composer to download packages)
RUN apt-get update && apt-get install -y unzip && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-dev

# Copy application code
COPY . .

# Set permissions for the writable directory
RUN chmod -R 777 writable

# Configure Caddy to serve from public/ on the correct port
RUN printf 'http://:{$PORT} {\n\troot * /app/public\n\tphp_server\n}' > /etc/caddy/Caddyfile

# Expose the port
EXPOSE ${PORT:-80}
