<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'BB_PLUGIN_OPTIONS' ) ) {
	/**
	 * BB_PLUGIN_OPTIONS Class
	 *
	 * @since	1.0
	 */
	class BB_PLUGIN_OPTIONS {


		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			$this->init();
		}

		public function init() {
			
			add_filter('bb_register_options', array( $this, 'options'), 10, 1 );

			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
        }

		public function adminEnqueueScripts() {
			$_GET = BestBug_Helper::sanitize_data( $_GET );
			if(isset($_GET['post_type']) && ($_GET['post_type'] == 'bb-core')) {
				BestBug_Core_Options::adminEnqueueScripts();
			}
		}

		public function enqueueScripts() {
		
        }
        
        public function options($options) {
			if( empty($options) ) {
				$options = array();
			}
			
			$prefix = 'bb_fb_';
			$options[] = array(
				'type' => 'options_fields',
				'menu' => array(
					// add_submenu_page || add_menu_page
					'type' => 'add_submenu_page',
					'parent_slug' => 'edit.php?post_type=' . BB_PLUGIN_POSTTYPE,
					'page_title' => esc_html('Settings', 'bestbug'),
					'menu_title' => esc_html('Settings', 'bestbug'),
					'capability' => 'manage_options',
					'menu_slug' => BB_PLUGIN_PAGESLUG,
				),
				'fields' => array(
					array(
						'type'       => 'tab',
						'heading'    => esc_html__( 'Dark theme', 'bestbug' ),
						'param_name' => $prefix . 'theme',
						'value'      => array(
							'dark' => esc_html__( 'Dark', 'bestbug' ),
							'light' => esc_html__( 'light', 'bestbug' ),
						),
						'std' => 'light',
						'description' => esc_html__('', 'bestbug'),
					),
					array(
						'type'       => 'toggle',
						'heading'    => esc_html__( 'Dark theme', 'bestbug' ),
						'param_name' => $prefix . 'dark_theme',
						'value'      => 'yes',
						'description' => esc_html__('', 'bestbug'),
						'tab' => array(
							'element' =>  $prefix . 'theme',
							'value' => array('dark')
						),
					),
					array(
						'type'       => 'toggle',
						'heading'    => esc_html__( 'Display footer', 'bestbug' ),
						'param_name' => $prefix . 'auto_show',
						'value'      => 'yes',
						'description' => esc_html__('Display footer automatically', 'bestbug'),
						'tab' => array(
							'element' =>  $prefix . 'theme',
							'value' => array('dark')
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Max width', 'bestbug'),
						'param_name' => $prefix . 'max_width',
						'value' => '1170px',
						'description' => esc_html('The max-width of footer', 'bestbug'),
						'tab' => array(
							'element' =>  $prefix . 'theme',
							'value' => array('light')
						),
					),
					array(
						'type' => 'toggle',
						'heading' => esc_html__('Display by Footer Settings', 'bestbug'),
						'param_name' => $prefix . 'display_by_fsettings',
						'value' => 'no',
						'description' => esc_html__('You can choose conditions in Footer Settings to display footer', 'bestbug'),
						'tab' => array(
							'element' =>  $prefix . 'theme',
							'value' => array('light')
						),
					),
				),
			);
			
			return $options;
        }
        
    }
	
	new BB_PLUGIN_OPTIONS();
}

