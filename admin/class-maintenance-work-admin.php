<?php
/**
 * The admin-specific functionality of the plugin
 *
 * @link https://neoslab.com
 * @since 1.0.0
 * @package Maintenance_Work
 * @subpackage Maintenance_Work/admin
*/

/**
 * Class `Maintenance_Work_Admin`
 * @package Maintenance_Work
 * @subpackage Maintenance_Work/admin
 * @author NeosLab <support@neoslab.com>
*/
class Maintenance_Work_Admin
{
	/**
	 * The ID of this plugin
	 * @since 1.0.0
	 * @access private
	 * @var string $pluginName the ID of this plugin
	*/
	private $pluginName;

	/**
	 * The version of this plugin
	 * @since 1.0.0
	 * @access private
	 * @var string $version the current version of this plugin
	*/
	private $version;

	/**
	 * Initialize the class and set its properties
	 * @since 1.0.0
	 * @param string $pluginName the name of this plugin
	 * @param string $version the version of this plugin
	*/
	public function __construct($pluginName, $version)
	{
		$this->pluginName = $pluginName;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area
	 * @since 1.0.0
	*/
	public function enqueue_styles()
	{
		wp_register_style($this->pluginName.'-fontawesome', plugin_dir_url(__FILE__).'assets/fonts/fontawesome/css/all.min.css', array(), $this->version, 'all');
		wp_register_style($this->pluginName.'-dashboard', plugin_dir_url(__FILE__).'assets/styles/maintenance-work-admin.min.css', array(), $this->version, 'all');
		wp_enqueue_style($this->pluginName.'-fontawesome');
		wp_enqueue_style($this->pluginName.'-dashboard');
	}

	/**
	 * Register the JavaScript for the admin area
	 * @since 1.0.0
	*/
	public function enqueue_scripts()
	{
		wp_register_script($this->pluginName.'-script', plugin_dir_url(__FILE__).'assets/javascripts/maintenance-work-admin.min.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->pluginName.'-script');
	}

	/**
	 * Return the header
	*/
	public function return_plugin_header()
	{
		$html = '<div class="wpdx-header"><span class="header-icon"><i class="fas fa-sliders-h"></i></span> <span class="header-text">'.__('Maintenance Work', 'maintenance-work').'</span></div>';
		return $html;
	}

	/**
	 * Return the tabs menu
	*/
	public function return_tabs_menu($tab)
	{
		$link = admin_url('options-general.php');
		$list = array
		(
			array('tab1', 'maintenance-work-admin', 'fa-cogs', __('Settings', 'maintenance-work'))
		);

		$menu = null;
		foreach($list as $item => $value)
		{
			$html = array('div' => array('class' => array()), 'a' => array('href' => array()), 'i' => array('class' => array()), 'p' => array(), 'span' => array());
			$menu ='<div class="tab-label '.$value[0].' '.(($tab === $value[0]) ? 'active' : '').'"><a href="'.$link.'?page='.$value[1].'"><p><i class="fas '.$value[2].'"></i><span>'.$value[3].'</span></p></a></div>';
			echo wp_kses($menu, $html);
		}
	}

	/**
 	 * Return Maintenance Page Title
	*/
	public function return_maintenance_title($old)
	{
		$opts = get_option('_maintenance_work');
		if((isset($opts['title'])) && (!empty($opts['title'])) && ($opts['title'] !== null))
		{
			return $opts['title'];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Return Maintenance Page Description
	*/
	public function return_maintenance_description($old)
	{
		$opts = get_option('_maintenance_work');
		if((isset($opts['description'])) && (!empty($opts['description'])) && ($opts['description'] !== null))
		{
			return $opts['description'];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Update `Options` on form submit
	*/
	public function return_update_options()
	{
		if((isset($_POST['mtw-update-option'])) && ($_POST['mtw-update-option'] === 'true')
		&& check_admin_referer('mtw-referer-form', 'mtw-referer-option'))
		{
			$opts = array('status' => 'off', 'title' => null, 'description' => null);
			if(isset($_POST['_maintenance_work']['status']))
			{
				$opts['status'] = sanitize_text_field($_POST['_maintenance_work']['status']);
				if($opts['status'] !== 'on')
				{
					header('location:'.admin_url('options-general.php?page=maintenance-work-admin').'&output=error&type=status');
					die();
				}
			}
			else
			{
				$opts['status'] = 'off';
			}

			if((isset($_POST['_maintenance_work']['title']))
			&& (isset($_POST['_maintenance_work']['description'])))
			{
				if(isset($_POST['_maintenance_work']['title']))
				{
					$opts['title'] = sanitize_text_field($_POST['_maintenance_work']['title']);
					if((empty($opts['title'])) || (strlen($opts['title']) < 3))
					{
						header('location:'.admin_url('options-general.php?page=maintenance-work-admin').'&output=error&type=title');
						die();
					}
				}

				if(isset($_POST['_maintenance_work']['description']))
				{
					$opts['description'] = wp_kses_post($_POST['_maintenance_work']['description']);
					if((empty($opts['description'])) || (strlen($opts['description']) < 3))
					{
						header('location:'.admin_url('options-general.php?page=maintenance-work-admin').'&output=error&type=description');
						die();
					}
				}

				$data = update_option('_maintenance_work', $opts);
				header('location:'.admin_url('options-general.php?page=maintenance-work-admin').'&output=updated');
				die();
			}
			else
			{
				header('location:'.admin_url('options-general.php?page=custom-email-sender-admin').'&output=error&type=unknown');
				die();
			}
		}
	}

	/**
	 * Return the `Options` page
	*/
	public function return_options_page()
	{
		$opts = get_option('_maintenance_work');
		require_once plugin_dir_path(__FILE__).'partials/maintenance-work-admin-options.php';
	}

	/**
	 * Return Backend Menu
	*/
	public function return_admin_menu()
	{
		add_options_page('Maintenance Mode', 'Maintenance Mode', 'manage_options', 'maintenance-work-admin', array($this, 'return_options_page'));
		remove_submenu_page('options-general.php', 'maintenance-work-about');
	}
}

?>