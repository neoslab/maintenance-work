<?php
/**
 * Provide a public-facing view for the plugin
 * This file is used to markup the admin-facing aspects of the plugin
 *
 * @link https://neoslab.com
 * @since 1.0.0
 *
 * @package Maintenance_Work
 * @subpackage Maintenance_Work/admin/partials
*/

/**
 * Check Visitor
*/
if(($GLOBALS['pagenow'] !== 'wp-login.php') && (!current_user_can('manage_options')))
{
    $maintenance = get_option('_maintenance_work');
    if((isset($maintenance['status'])) && ($maintenance['status'] === 'on'))
    {
        require(dirname(plugin_dir_path(__FILE__)).'/templates/page.php');
        exit();
    }
}

?>