<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'BB_PLUGIN_POSTTYPES' ) ) {
	/**
	 * BB_PLUGIN_POSTTYPES Class
	 *
	 * @since	1.0
	 */
	class BB_PLUGIN_POSTTYPES {


		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			$this->init();
			add_filter( 'bb_register_posttypes', array( $this, 'register_posttypes' ), 10, 1 );
			add_filter( 'bb_add_meta_box', array( $this, 'add_meta_boxes' ), 10, 1 );
		}

		public function init() {

			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );

        }
		public function adminEnqueueScripts() {
			BestBug_Core_Meta_Box::adminEnqueueScripts();
		}
		public function enqueueScripts(){
		}
		
		public function register_posttypes($posttypes) {
			if( empty($posttypes) ) {
				$posttypes = array();
			}
			$labels = array(
				'name'               => _x( 'BB Posts', 'BB Posts', 'bestbug' ),
				'singular_name'      => _x( 'BB Post', 'BB Post', 'bestbug' ),
				'menu_name'          => __( 'The post name', 'bestbug' ),
				'name_admin_bar'     => __( 'BB Post', 'bestbug' ),
				'parent_item_colon'  => __( 'Parent Menu:', 'bestbug' ),
				'all_items'          => __( 'All Post name', 'bestbug' ),
				'add_new_item'       => __( 'Add New BB Post', 'bestbug' ),
				'add_new'            => __( 'Add New', 'bestbug' ),
				'new_item'           => __( 'New BB Post', 'bestbug' ),
				'edit_item'          => __( 'Edit BB Post', 'bestbug' ),
				'update_item'        => __( 'Update BB Post', 'bestbug' ),
				'view_item'          => __( 'View BB Post', 'bestbug' ),
				'search_items'       => __( 'Search BB Post', 'bestbug' ),
				'not_found'          => __( 'Not found', 'bestbug' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'bestbug' ),
			);
			$args   = array(
				'label'               => __( 'BB Post', 'bestbug' ),
				'description'         => __( 'BB Post', 'bestbug' ),
				'labels'              => $labels,
				'supports' => array(
                    'title',
                    'thumbnail',
                ),
				'capability_type' 	  => 'page',
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 13,
				'menu_icon' 		  => BB_PLUGIN_URL . 'bestbugcore/assets/admin/images/logo-white.png',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => true,
			);
			$posttypes[BB_PLUGIN_POSTTYPE] = $args;
			return $posttypes;
		}

		public function add_meta_boxes($options) {
			$options[] = array(
				'ID' => 'whatsapp-account-info',
				'title' => 'Account Information',
				'post_type'=> BB_PLUGIN_POSTTYPE,
				'context' => 'normal',
				'fields' => array(
					array(
						'type' => 'text',
						'heading'     => esc_html__('text', 'bestbug' ),
						'param_name'  => BB_META_POST.'text',
						'value' => 'ahihi11111',
						'description' => esc_html__( 'text', 'bestbug' ),
					),
					array(
						'type' => 'textarea',
						'heading'     => esc_html__('textarea', 'bestbug' ),
						'cols'=>"3",
						'rows'=>"3",
						'param_name'  => BB_META_POST.'textarea',
						'value' => 'ahihi11111',
						'description' => esc_html__( 'textarea', 'bestbug' ),
					),
					array(
						'type' => 'radio',
						'heading'     => esc_html__('radio', 'bestbug' ),
						'options'=> array(
							'round' => esc_html__('Round', 'bestbug' ),
							'square' => esc_html__('Square', 'bestbug' ),
						),
						'horizontal' => 'yes',
						'param_name'  => BB_META_POST.'radio',
						'value' => 'square',
						'description' => esc_html__( 'radio', 'bestbug' ),
					),
					array(
						'type' => 'select',
						'heading'     => esc_html__('radio', 'bestbug' ),
						'options'=> array(
							'round' => esc_html__('Round', 'bestbug' ),
							'square' => esc_html__('Square', 'bestbug' ),
						),
						'param_name'  => BB_META_POST.'select',
						'value' => 'square',
						'description' => esc_html__( 'select', 'bestbug' ),
					),
					array(
						'type' => 'color',
						'heading'     => esc_html__('color', 'bestbug' ),
						'param_name'  => BB_META_POST.'color',
						'value' => '#f1f1f1',
						'description' => esc_html__( 'color', 'bestbug' ),
					),
					array(
						'type' => 'time',
						'heading'     => esc_html__('time', 'bestbug' ),
						'param_name'  => BB_META_POST.'time',
						'value' => '08:00',
						'description' => esc_html__( 'time', 'bestbug' ),
					),
					array(
						'type' => 'date_time',
						'heading'     => esc_html__('date_time', 'bestbug' ),
						'param_name'  => BB_META_POST.'date_time',
						'value' => '2020-01-01T01:00',
						'description' => esc_html__( 'date_time', 'bestbug' ),
					),
				)
			);
			return $options;
		}

		
    }
	
	new BB_PLUGIN_POSTTYPES();
}

