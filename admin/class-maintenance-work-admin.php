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
 * Class Maintenance_Work_Admin
 * This class handles all admin-specific functionality for the maintenance mode plugin.
 * It manages enqueuing scripts/styles, displaying settings pages, and processing
 * form submissions for maintenance mode configuration.
 * 
 * @package Maintenance_Work
 * @subpackage Maintenance_Work/admin
 * @author NeosLab <support@neoslab.com>
*/
class Maintenance_Work_Admin
{
	/**
	 * The ID of this plugin
	 * This property stores the unique identifier for the plugin.
	 * It is used for hook registration and asset enqueuing.
	 * 
	 * @since 1.0.0
	 * @access private
	 * @var string $pluginName the ID of this plugin
	*/
	private $pluginName;

	/**
	 * The version of this plugin
	 * This property stores the current version number of the plugin.
	 * It is used for cache busting when enqueuing scripts and styles.
	 * 
	 * @since 1.0.0
	 * @access private
	 * @var string $version the current version of this plugin
	*/
	private $version;

	/**
	 * Initialize the class and set its properties
	 * This constructor method sets up the plugin name and version properties.
	 * These properties are used throughout the admin class for various operations.
	 * 
	 * @since 1.0.0
	 * @param string $pluginName the name of this plugin
	 * @param string $version the version of this plugin
	 * @return void
	*/
	public function __construct($pluginName, $version)
	{
		$this->pluginName = $pluginName;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area
	 * This method registers and enqueues all CSS files required for the admin interface.
	 * It includes FontAwesome icons and the plugin's custom dashboard styles.
	 * 
	 * @since 1.0.0
	 * @return void
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
	 * This method registers and enqueues all JavaScript files required for the admin interface.
	 * It loads the plugin's custom script with jQuery dependency.
	 * 
	 * @since 1.0.0
	 * @return void
	*/
	public function enqueue_scripts()
	{
		wp_register_script($this->pluginName.'-script', plugin_dir_url(__FILE__).'assets/javascripts/maintenance-work-admin.min.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->pluginName.'-script');
	}

	/**
	 * Return the header
	 * This method generates and returns the HTML markup for the plugin header.
	 * The header includes an icon and the plugin title text.
	 * 
	 * @since 1.0.0
	 * @return string HTML markup for the plugin header
	*/
	public function return_plugin_header()
	{
		$html = '<div class="wpdx-header"><span class="header-icon"><i class="fas fa-sliders-h"></i></span> <span class="header-text">'.__('Maintenance Work', 'maintenance-work').'</span></div>';
		return $html;
	}

	/**
	 * Return the tabs menu
	 * This method generates and outputs the navigation tabs for the settings page.
	 * It creates a tab for the Settings section and marks the active tab.
	 * 
	 * @since 1.0.0
	 * @param string $tab The currently active tab identifier
	 * @return void Outputs HTML markup directly
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
	 * This filter method retrieves and returns the saved maintenance page title.
	 * It checks if the title exists in the options and returns null if not found.
	 * 
	 * @since 1.0.0
	 * @param mixed $old The old title value passed by WordPress filter
	 * @return string|null The maintenance page title or null if not set
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
	 * This filter method retrieves and returns the saved maintenance page description.
	 * It checks if the description exists in the options and returns null if not found.
	 * 
	 * @since 1.0.0
	 * @param mixed $old The old description value passed by WordPress filter
	 * @return string|null The maintenance page description or null if not set
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
	 * Update Options on form submit
	 * This method processes the maintenance mode settings form submission.
	 * It validates the nonce, sanitizes all input fields, and saves them to the database.
	 * Includes validation for status, title, description, logo URL, copyright info,
	 * and all social media URLs. Redirects with appropriate success or error messages.
	 * 
	 * @since 1.0.0
	 * @return void Redirects to settings page with status parameter
	*/
	public function return_update_options()
	{
		if((isset($_POST['mtw-update-option'])) && ($_POST['mtw-update-option'] === 'true')
		&& check_admin_referer('mtw-referer-form', 'mtw-referer-option'))
		{
			$opts = array
			(
				'status' => 'off',
				'title' => null,
				'description' => null,
				'logo-url' => null,
				'copyright-name' => null,
				'copyright-title' => null,
				'copyright-link' => null,
				'powered-name' => null,
				'powered-title' => null,
				'powered-link' => null,
				'discord-url' => null,
				'facebook-url' => null,
				'github-url' => null,
				'instagram-url' => null,
				'linkedin-url' => null,
				'mastodon-url' => null,
				'telegram-url' => null,
				'tiktok-url' => null,
				'twitter-url' => null,
				'youtube-url' => null
			);
			
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

				if(isset($_POST['_maintenance_work']['logo-url']))
				{
					$opts['logo-url'] = esc_url_raw($_POST['_maintenance_work']['logo-url']);
				}

				if(isset($_POST['_maintenance_work']['copyright-name']))
				{
					$opts['copyright-name'] = sanitize_text_field($_POST['_maintenance_work']['copyright-name']);
				}

				if(isset($_POST['_maintenance_work']['copyright-title']))
				{
					$opts['copyright-title'] = sanitize_text_field($_POST['_maintenance_work']['copyright-title']);
				}

				if(isset($_POST['_maintenance_work']['copyright-link']))
				{
					$opts['copyright-link'] = esc_url_raw($_POST['_maintenance_work']['copyright-link']);
				}

				if(isset($_POST['_maintenance_work']['powered-name']))
				{
					$opts['powered-name'] = sanitize_text_field($_POST['_maintenance_work']['powered-name']);
				}

				if(isset($_POST['_maintenance_work']['powered-title']))
				{
					$opts['powered-title'] = sanitize_text_field($_POST['_maintenance_work']['powered-title']);
				}

				if(isset($_POST['_maintenance_work']['powered-link']))
				{
					$opts['powered-link'] = esc_url_raw($_POST['_maintenance_work']['powered-link']);
				}

				$socialfields = array
				(
					'discord-url',
					'facebook-url',
					'github-url',
					'instagram-url',
					'linkedin-url',
					'mastodon-url',
					'telegram-url',
					'tiktok-url',
					'twitter-url',
					'youtube-url'
				);
				
				foreach($socialfields as $field)
				{
					if(isset($_POST['_maintenance_work'][$field]))
					{
						$opts[$field] = esc_url_raw($_POST['_maintenance_work'][$field]);
					}
				}

				$data = update_option('_maintenance_work', $opts);
				header('location:'.admin_url('options-general.php?page=maintenance-work-admin').'&output=updated');
				die();
			}
			else
			{
				header('location:'.admin_url('options-general.php?page=maintenance-work-admin').'&output=error&type=unknown');
				die();
			}
		}
	}

	/**
	 * Return the Options page
	 * This method loads and displays the maintenance mode settings page.
	 * It retrieves the current options and includes the partial template file.
	 * 
	 * @since 1.0.0
	 * @return void Includes the options page template
	*/
	public function return_options_page()
	{
		$opts = get_option('_maintenance_work');
		require_once plugin_dir_path(__FILE__).'partials/maintenance-work-admin-options.php';
	}

	/**
	 * Return Backend Menu
	 * This method registers the plugin's admin menu page under WordPress Settings.
	 * It adds a submenu page and removes unnecessary about page if exists.
	 * 
	 * @since 1.0.0
	 * @return void
	*/
	public function return_admin_menu()
	{
		add_options_page('Maintenance Mode', 'Maintenance Mode', 'manage_options', 'maintenance-work-admin', array($this, 'return_options_page'));
		remove_submenu_page('options-general.php', 'maintenance-work-about');
	}
}

?>