<?php
/**
 * Custom database class for TiDB Cloud SSL support (Development only)
 */

// Only apply custom database handling in development environment
// Check for common development indicators
$is_development = (
    // Check if WP_ENV is set to development/local
    (defined('WP_ENV') && in_array(WP_ENV, ['development', 'local', 'dev'])) ||
    // Check if WP_DEBUG is enabled (common in dev)
    (defined('WP_DEBUG') && WP_DEBUG === true) ||
    // Check for local domains
    (isset($_SERVER['HTTP_HOST']) && (
        strpos($_SERVER['HTTP_HOST'], '.local') !== false ||
        strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ||
        strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false
    )) ||
    // Check for specific TiDB host pattern (adjust as needed)
    (defined('DB_HOST') && strpos(DB_HOST, 'tidb') !== false)
);

// Only load custom database class if in development
if ($is_development) {
    require_once(ABSPATH . 'wp-includes/class-wpdb.php');

    class wpdb_ssl extends wpdb {
        public function db_connect($allow_bail = true) {
            $this->is_mysql = true;
            
            $this->dbh = mysqli_init();
            
            // Enable SSL for TiDB Cloud
            mysqli_ssl_set(
                $this->dbh,
                NULL,
                NULL,
                '/etc/ssl/certs/ca-certificates.crt',
                NULL,
                NULL
            );
            
            // Parse host and port
            $host = $this->dbhost;
            $port = 3306;
            
            if (strpos($this->dbhost, ':') !== false) {
                list($host, $port) = explode(':', $this->dbhost);
            }
            
            // Connect with SSL
            $connected = @mysqli_real_connect(
                $this->dbh,
                $host,
                $this->dbuser,
                $this->dbpassword,
                $this->dbname,
                intval($port),
                null,
                MYSQLI_CLIENT_SSL
            );
            
            if (!$connected) {
                if ($allow_bail) {
                    $message = '<h1>Error establishing a database connection</h1>';
                    $message .= '<p>SSL connection to TiDB Cloud failed: ' . mysqli_connect_error() . '</p>';
                    wp_die($message);
                }
                return false;
            }
            
            $this->set_charset($this->dbh);
            $this->ready = true;
            
            // Enable TiDB noop functions for WordPress compatibility
            mysqli_query($this->dbh, "SET tidb_enable_noop_functions = 1");
            
            $this->set_sql_mode();
            $this->select($this->dbname, $this->dbh);
            
            return true;
        }
    }

    // Replace global wpdb instance
    $wpdb = new wpdb_ssl(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
    $wpdb->set_prefix($table_prefix);
}