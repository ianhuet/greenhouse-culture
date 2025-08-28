<?php
/**
 * WordPress configuration with TiDB Cloud SSL support
 */

// Database settings from environment
define('DB_NAME', getenv('WORDPRESS_DB_NAME'));
define('DB_USER', getenv('WORDPRESS_DB_USER'));
define('DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD'));
define('DB_HOST', getenv('WORDPRESS_DB_HOST'));
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Debug settings
define('WP_DEBUG', filter_var(getenv('WORDPRESS_DEBUG'), FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_LOG', filter_var(getenv('WORDPRESS_DEBUG_LOG'), FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_DISPLAY', filter_var(getenv('WORDPRESS_DEBUG_DISPLAY'), FILTER_VALIDATE_BOOLEAN));

// Salts
define('AUTH_KEY',         '2vAY!85Mqa#W82fdtt2EHaSgf)hXtj^wozZkE6RWzwPyJB&Q07J3nvd*RMD)8e4I');
define('SECURE_AUTH_KEY',  'Ln(!Bgi^0Vtb^LZaQDcxht6UMX3%QSFDUB2Ug0iifBklnL6Ef5fWgRq9)AnSL^D*');
define('LOGGED_IN_KEY',    'E4au8KecgTBmL52zcfy(^m@K06OCBkVq%49VruNZYVO*!H@wM5ot(ZjKeYxplLfg');
define('NONCE_KEY',        'F7Y(FFlw2wHxQ5y!cz!F2&NqhfW4M@y&SRYFFr@k(%pHS38I%En!eF1q%Z*7xYRm');
define('AUTH_SALT',        'DTUgAzLzVuFC7%D)p1Y8KK5VikPzj6Ovud0a1&^Si9U6Lmw(cKhEFGNI4aNxUaC6');
define('SECURE_AUTH_SALT', '&wdM*C&MO#5SzX0w2wo8nyoTjO7bP*gmh8fsOC%X6Mjw171VVhcw4Hq49yDmkPuv');
define('LOGGED_IN_SALT',   'Uu)NBvhBV7^rvo!ajIhY1C5QV&k43DqG*#pQxpYX31nPHzcP6(RpE)QoLU*1A)i9');
define('NONCE_SALT',       'yvWMS#%q0CNPYVt7I0f)CA1@bU7O8eu&uHswF)3mvA4Ewz5jwRt2wjr5F8Ya!!4l');

$table_prefix = 'wp_';

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once(ABSPATH . 'wp-settings.php');