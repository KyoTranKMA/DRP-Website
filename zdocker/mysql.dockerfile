# Use the official MySQL 8.3.0 image
FROM mysql:8.3.0

# Set environment variables
ENV MYSQL_DATABASE=ct07_db \
    MYSQL_ROOT_PASSWORD=admin \
    MYSQL_USER=ad_db_ct07 \
    MYSQL_PASSWORD=admin \
    MYSQL_ALLOW_EMPTY_PASSWORD=yes

# # Copy the data.sql file to the Docker container
COPY ./Data/dump/table_structure.sql /docker-entrypoint-initdb.d/

# Expose MySQL port
EXPOSE 3306

# Grant all privileges to ad_db_ct07 user for the ct07_db database
RUN echo "GRANT ALL PRIVILEGES ON ct07_db.* TO 'ad_db_ct07'@'%' IDENTIFIED BY 'admin';" > /docker-entrypoint-initdb.d/grant.sql

# Set permissions to make sure the script is executable
RUN chmod +x /docker-entrypoint-initdb.d/grant.sql
