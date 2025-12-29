<?php
/**
 * Fired during plugin deactivation
 *
 * @link https://neoslab.com
 * @since 1.0.0
 *
 * @package Maintenance_Work
 * @subpackage Maintenance_Work/includes
*/

/**
 * Class `Maintenance_Work_Deactivator`
 * This class defines all code necessary to run during the plugin's deactivation
 * @since 1.0.0
 * @package Maintenance_Work
 * @subpackage Maintenance_Work/includes
 * @author NeosLab <support@neoslab.com>
*/
class Maintenance_Work_Deactivator
{
	/**
	 * Deactivate plugin
	 * @since 1.0.0
	*/
	public static function deactivate()
	{
		$option = delete_option('_maintenance_work');
	}
}

?>