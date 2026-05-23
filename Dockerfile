FROM dunglas/frankenphp:php8.2-bookworm

# Install the intl extension (requires libicu-dev)
RUN install-php-extensions intl

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

# Configure Caddy to serve from public/
RUN printf '{\n\tauto_https off\n}\n\n:{$PORT:80} {\n\troot * /app/public\n\tphp_server\n}' > /etc/caddy/Caddyfile

# Expose the port
EXPOSE ${PORT:-80}
