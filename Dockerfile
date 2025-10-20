# Use official PHP CLI image
FROM php:8.3-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip git libzip-dev \
    && docker-php-ext-install zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install dev dependencies (including PHPUnit)
RUN composer install

# Default command: run PHPUnit
CMD ["./vendor/bin/phpunit", "--colors=always"]
