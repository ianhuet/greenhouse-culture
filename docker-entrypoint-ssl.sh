#!/bin/bash
set -euo pipefail

# Navigate to WordPress directory
cd /var/www/html

# Remove wp-config.php if it exists as a directory (Docker volume mount issue)
if [ -d /var/www/html/wp-config.php ]; then
    echo "Removing wp-config.php directory (Docker mount artifact)..."
    rm -rf /var/www/html/wp-config.php
fi

# Check if custom wp-config exists and copy it
if [ -f /tmp/wp-config-custom.php ]; then
    echo "Using custom wp-config from mounted file..."
    cp /tmp/wp-config-custom.php /var/www/html/wp-config.php
    chmod 644 /var/www/html/wp-config.php
    chown www-data:www-data /var/www/html/wp-config.php
elif [ ! -e /var/www/html/wp-config.php ]; then
    echo "Generating wp-config.php from sample..."
    # Setup WordPress config with SSL support for TiDB Cloud
    awk '
    /^\/\*.*stop editing.*\*\/$/ {
        print "/* SSL Configuration for TiDB Cloud */"
        print "define(\"MYSQL_CLIENT_FLAGS\", MYSQLI_CLIENT_SSL);"
        print "define(\"MYSQL_CLIENT_SSL_DONT_VERIFY_SERVER_CERT\", true);"
        print ""
    }
    { print }
    ' wp-config-sample.php > wp-config.php
    
    # Replace database values
    sed -i "s/database_name_here/$WORDPRESS_DB_NAME/g" wp-config.php
    sed -i "s/username_here/$WORDPRESS_DB_USER/g" wp-config.php
    sed -i "s/password_here/$WORDPRESS_DB_PASSWORD/g" wp-config.php
    sed -i "s/localhost/$WORDPRESS_DB_HOST/g" wp-config.php
    
    # Add debug settings if provided
    if [ ! -z "${WORDPRESS_DEBUG:-}" ]; then
        sed -i "/WP_DEBUG/s/false/$WORDPRESS_DEBUG/" wp-config.php
    fi
fi

# Call the original WordPress entrypoint
exec docker-entrypoint.sh "$@"