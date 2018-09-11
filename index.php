<?php
/*
Plugin Name: Vendi - A11Y
Description: Accessibility Tool
Plugin URI: https://www.vendiadvertising.com/
Author: Vendi Advertising
Version: 1.0.0
Author URI: https://www.vendiadvertising.com/
*/

define('VENDI_A11Y_PLUGIN_FILE', __FILE__);
define('VENDI_A11Y_PLUGIN_DIR', __DIR__ );
define('VENDI_A11Y_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once VENDI_A11Y_PLUGIN_DIR . '/includes/php-defaults.php';
require_once VENDI_A11Y_PLUGIN_DIR . '/includes/autoload.php';
require_once VENDI_A11Y_PLUGIN_DIR . '/includes/hooks.php';
require_once VENDI_A11Y_PLUGIN_DIR . '/includes/routes.php';
require_once VENDI_A11Y_PLUGIN_DIR . '/includes/cli.php';
require_once VENDI_A11Y_PLUGIN_DIR . '/includes/vendi-base.php';
