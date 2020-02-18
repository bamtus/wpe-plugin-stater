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
        
    }
	
	new WPE_PLUGIN_POSTTYPES();
}

