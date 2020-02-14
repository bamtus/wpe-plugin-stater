<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Wpe_demo_shortcode_class' ) ) {
	/**
	 * Wpe_demo_shortcode_class Class
	 *
	 * @since	1.0
	 */
	class Wpe_demo_shortcode_class {

		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			add_action( 'init', array( $this, 'init' ) );
		}

		public function init() {
			
			add_shortcode( 'wpe_demo_shortcode', array( $this, 'shortcode' ) );
		
			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );

        }

		public function adminEnqueueScripts() {
			// wp_enqueue_style( 'css', BESTBUG_RPPRO_URL . '/assets/admin/css/style.css' );
			// wp_enqueue_script( 'js', BESTBUG_RPPRO_URL . '/assets/admin/js/script.js', array( 'jquery' ), '1.0', true );
		}

		public function enqueueScripts() {
			// wp_enqueue_style( 'css', BESTBUG_RPPRO_URL . '/assets/css/style.css' );
			// wp_enqueue_script( 'js', BESTBUG_RPPRO_URL . '/assets/js/script.js', array( 'jquery' ), '1.0', true );
		}
		
		public function shortcode( $atts ){

			extract( shortcode_atts( array(
				'title' => '',
				'logo' => '',
				'el_class' => '',
			), $atts ) );
			
			$class_array = array('wpe-logo');

			if(isset($el_class) && !empty($el_class)) {
				array_push($class_array, $el_class);
			}
			$class_string = implode(' ', $class_array);
			
			if ( $logo > 0 ) {
				$logo = wp_get_attachment_image_src( $logo, 'full' );
				if(isset($logo[0]) && !empty($logo[0])) {
					return '<a class="'.esc_attr($class_string).'" href="'.home_url().'" ><img alt="'.$title.'" src="'.$logo[0].'" /></a>';
				}
			}
			
			return '';
		}
		
    }
	
	new Wpe_demo_shortcode_class();
}
