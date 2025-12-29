<?php
/**
 * Fired during plugin activation
 *
 * @link https://neoslab.com
 * @since 1.0.0
 *
 * @package Maintenance_Work
 * @subpackage Maintenance_Work/includes
*/

/**
 * Class `Maintenance_Work_Activator`
 * This class defines all code necessary to run during the plugin's activation
 * @since 1.0.0
 * @package Maintenance_Work
 * @subpackage Maintenance_Work/includes
 * @author NeosLab <support@neoslab.com>
*/
class Maintenance_Work_Activator
{
	/**
	 * Activate plugin
	 * @since 1.0.0
	*/
	public static function activate()
	{
		$option = add_option('_maintenance_work', false);
	}
}

?>