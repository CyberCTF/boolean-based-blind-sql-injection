FROM mariadb:10.5

# Set environment variables
ENV MYSQL_ROOT_PASSWORD=root_password_secure_2024
ENV MYSQL_DATABASE=app_repo41
ENV TZ=UTC

# Copy initialization scripts
COPY init/ /docker-entrypoint-initdb.d/

# Expose custom port
EXPOSE 3207

# Configure MariaDB to use custom port
CMD ["mysqld", "--port=3207", "--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci"]
