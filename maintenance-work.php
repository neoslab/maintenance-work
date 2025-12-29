<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link https://neoslab.com
 * @since 1.0.0
 * @package Maintenance_Work
 *
 * @wordpress-plugin
 * Plugin Name: Maintenance Work
 * Plugin URI: https://wordpress.org/plugins/maintenance-work/
 * Description: Add a maintenance page to your website that lets visitors know your page is down for maintenance and allowing to work on beside of this.
 * Version: 2.3.3
 * Author: NeosLab
 * Author URI: https://neoslab.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: maintenance-work
 * Domain Path: /languages
*/

/**
 * If this file is called directly, then abort
*/
if(!defined('WPINC'))
{
	die;
}

/**
 * Currently plugin version
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions
*/
define('MAINTENANCE_WORK_VERSION', '2.3.3');

/**
 * The code that runs during plugin activation
 * This action is documented in includes/class-maintenance-work-activator.php
*/
function activate_maintenance_work()
{
	require_once plugin_dir_path(__FILE__).'includes/class-maintenance-work-activator.php';
	Maintenance_Work_Activator::activate();
}

/**
 * The code that runs during plugin deactivation
 * This action is documented in includes/class-maintenance-work-deactivator.php
*/
function deactivate_maintenance_work()
{
	require_once plugin_dir_path(__FILE__).'includes/class-maintenance-work-deactivator.php';
	Maintenance_Work_Deactivator::deactivate();
}

/**
 * Activation/deactivation hook
*/
register_activation_hook(__FILE__, 'activate_maintenance_work');
register_deactivation_hook(__FILE__, 'deactivate_maintenance_work');

/**
 * The core plugin class that is used to define internationalization
 * admin-specific hooks, and public-facing site hooks
*/
require plugin_dir_path(__FILE__).'includes/class-maintenance-work-core.php';

/**
 * Begins execution of the plugin
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle
 * @since 1.0.0
*/
function run_maintenance_work()
{
	$plugin = new Maintenance_Work();
	$plugin->run();
}

/**
 * Run plugin
*/
run_maintenance_work();

?>