FROM php:7.4-apache

# Install required packages
RUN apt-get update && apt-get install -y \
    gcc \
    g++ \
    make \
    libmariadb-dev \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql

# Configure Apache
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# CRITICAL: Configure Apache to listen on port 3206
RUN sed -i 's/Listen 80/Listen 80\nListen 3206/' /etc/apache2/ports.conf

# Create custom VirtualHost for port 3206
# Use printf to avoid Docker parse errors with multi-line configs
RUN printf '<VirtualHost *:3206>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>\n' > /etc/apache2/sites-available/000-default.conf

# Copy application files
COPY src/ /var/www/html/

# Create .htaccess file for Apache routing
RUN echo 'RewriteEngine On' > /var/www/html/.htaccess && \
    echo 'RewriteCond %{REQUEST_FILENAME} !-f' >> /var/www/html/.htaccess && \
    echo 'RewriteCond %{REQUEST_FILENAME} !-d' >> /var/www/html/.htaccess && \
    echo 'RewriteRule ^ index.php [QSA,L]' >> /var/www/html/.htaccess

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 3206
CMD ["apache2-foreground"]
