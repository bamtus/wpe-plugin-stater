<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'WPE_PLUGIN_POSTTYPES' ) ) {
	/**
	 * WPE_PLUGIN_POSTTYPES Class
	 *
	 * @since	1.0
	 */
	class WPE_PLUGIN_POSTTYPES {


		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			$this->init();
			add_filter( 'bb_register_posttypes', array( $this, 'register_posttypes' ), 10, 1 );
			add_filter( 'wpe_add_meta_box', array( $this, 'add_meta_boxes' ), 10, 1 );
		}

		public function init() {

			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );

        }

		public function adminEnqueueScripts() {
		
		}

		public function enqueueScripts() {
		
        }
        
		public function register_posttypes($posttypes) {

			if( empty($posttypes) ) {
				$posttypes = array();
			}

			$labels = array(
				'name'               => _x( 'WPE Posts', 'WPE Posts', 'wpelite' ),
				'singular_name'      => _x( 'WPE Post', 'WPE Post', 'wpelite' ),
				'menu_name'          => __( 'WPE Name Post', 'wpelite' ),
				'name_admin_bar'     => __( 'WPE Post', 'wpelite' ),
				'parent_item_colon'  => __( 'Parent Menu:', 'wpelite' ),
				'all_items'          => __( 'All WPE Post', 'wpelite' ),
				'add_new_item'       => __( 'Add New WPE Post', 'wpelite' ),
				'add_new'            => __( 'Add New', 'wpelite' ),
				'new_item'           => __( 'New WPE Post', 'wpelite' ),
				'edit_item'          => __( 'Edit WPE Post', 'wpelite' ),
				'update_item'        => __( 'Update WPE Post', 'wpelite' ),
				'view_item'          => __( 'View WPE Post', 'wpelite' ),
				'search_items'       => __( 'Search WPE Post', 'wpelite' ),
				'not_found'          => __( 'Not found', 'wpelite' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'wpelite' ),
			);
			$args   = array(
				'label'               => __( 'WPE Post', 'lamblue' ),
				'description'         => __( 'WPE Post', 'lamblue' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', ),
				'capability_type' 	  => 'page',
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 13,
				'menu_icon' 		  => WPE_PLUGIN_URL . 'wpe-core/assets/admin/images/logo-white.png',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => true,
			);
			$posttypes[WPE_PLUGIN_POSTTYPE] = $args;
			return $posttypes;
		}
		public function add_meta_boxes($options) {
			$options[] = array(
				'ID' => 'whatsapp-account-info',
				'title' => 'Account Information',
				'post_type'=> WPE_PLUGIN_POSTTYPE,
				'context' => 'normal',
				'fields' => array(
					array(
						'type' => 'text',
						'heading'     => esc_html__('text', 'wpelite' ),
						'param_name'  => WPE_META_POST.'text',
						'value' => 'ahihi11111',
						'description' => esc_html__( 'text', 'wpelite' ),
					),
					array(
						'type' => 'textarea',
						'heading'     => esc_html__('textarea', 'wpelite' ),
						'cols'=>"3",
						'rows'=>"3",
						'param_name'  => WPE_META_POST.'textarea',
						'value' => 'ahihi11111',
						'description' => esc_html__( 'textarea', 'wpelite' ),
					),
					array(
						'type' => 'radio',
						'heading'     => esc_html__('radio', 'wpelite' ),
						'options'=> array(
							'round' => esc_html__('Round', 'wpelite' ),
							'square' => esc_html__('Square', 'wpelite' ),
						),
						'horizontal' => 'yes',
						'param_name'  => WPE_META_POST.'radio',
						'value' => 'square',
						'description' => esc_html__( 'radio', 'wpelite' ),
					),
					array(
						'type' => 'select',
						'heading'     => esc_html__('radio', 'wpelite' ),
						'options'=> array(
							'round' => esc_html__('Round', 'wpelite' ),
							'square' => esc_html__('Square', 'wpelite' ),
						),
						'param_name'  => WPE_META_POST.'select',
						'value' => 'square',
						'description' => esc_html__( 'select', 'wpelite' ),
					),
					array(
						'type' => 'color',
						'heading'     => esc_html__('color', 'wpelite' ),
						'param_name'  => WPE_META_POST.'color',
						'value' => '#f1f1f1',
						'description' => esc_html__( 'color', 'wpelite' ),
					),
					array(
						'type' => 'time',
						'heading'     => esc_html__('time', 'wpelite' ),
						'param_name'  => WPE_META_POST.'time',
						'value' => '08:00',
						'description' => esc_html__( 'time', 'wpelite' ),
					),
					array(
						'type' => 'date_time',
						'heading'     => esc_html__('date_time', 'wpelite' ),
						'param_name'  => WPE_META_POST.'date_time',
						'value' => '2020-01-01T01:00',
						'description' => esc_html__( 'date_time', 'wpelite' ),
					),
				)
			);
			return $options;
		}
        
    }
	
	new WPE_PLUGIN_POSTTYPES();
}

