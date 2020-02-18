<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'WPE_PLUGIN_META_BOX' ) ) {
	/**
	 * WPE_PLUGIN_META_BOX Class
	 *
	 * @since	1.0
	 */
	class WPE_PLUGIN_META_BOX {


		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			$this->init();
			add_filter( 'wpe_add_meta_box', array( $this, 'add_meta_boxes' ), 10, 1 );
		}

		public function init() {

			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );

        }

		public function adminEnqueueScripts() {
			WPE_Core_Meta_Box::adminEnqueueScripts();
		}

		public function enqueueScripts() {
		
        }
        
		public function add_meta_boxes($options) {
			$options[] = array(
				'ID' => 'whatsapp-account-info',
				'title' => 'Account Information',
				'post_type'=> WPE_PLUGIN_POSTTYPE,
				'context' => 'normal',
				'fields' => array(
					array(
						'type' => 'tab',
						'param_name'  => WPE_META_POST.'tab',
						'options'=> array(
							'round' => esc_html__('Round', 'bestbug' ),
							'square' => esc_html__('Square', 'bestbug' ),
						),
						'value' => 'round',
						'description' => esc_html__( 'tab', 'bestbug' ),
					),
					array(
						'type' => 'text',
						'heading'     => esc_html__('text', 'bestbug' ),
						'param_name'  => WPE_META_POST.'text',
						'value' => 'ahihi11111',
						'description' => esc_html__( 'text', 'bestbug' ),
						'tab' => array(
							'element' =>  WPE_META_POST.'tab',
							'value' => array('round')
						),
					),
					array(
						'type' => 'textarea',
						'heading'     => esc_html__('textarea', 'bestbug' ),
						'cols'=>"3",
						'rows'=>"3",
						'param_name'  => WPE_META_POST.'textarea',
						'value' => 'ahihi11111',
						'description' => esc_html__( 'textarea', 'bestbug' ),
						'tab' => array(
							'element' =>  WPE_META_POST.'tab',
							'value' => array('square')
						),
					),
					array(
						'type' => 'radio',
						'heading'     => esc_html__('radio', 'bestbug' ),
						'options'=> array(
							'round' => esc_html__('Round', 'bestbug' ),
							'square' => esc_html__('Square', 'bestbug' ),
						),
						'horizontal' => 'yes',
						'param_name'  => WPE_META_POST.'radio',
						'value' => 'square',
						'description' => esc_html__( 'radio', 'bestbug' ),
						'tab' => array(
							'element' =>  WPE_META_POST.'tab',
							'value' => array('square')
						),
					),
					array(
						'type' => 'select',
						'heading'     => esc_html__('radio', 'bestbug' ),
						'options'=> array(
							'round' => esc_html__('Round', 'bestbug' ),
							'square' => esc_html__('Square', 'bestbug' ),
						),
						'param_name'  => WPE_META_POST.'select',
						'value' => 'square',
						'description' => esc_html__( 'select', 'bestbug' ),
						'tab' => array(
							'element' =>  WPE_META_POST.'tab',
							'value' => array('round')
						),
					),
					array(
						'type' => 'color',
						'heading'     => esc_html__('color', 'bestbug' ),
						'param_name'  => WPE_META_POST.'color',
						'value' => '#f1f1f1',
						'description' => esc_html__( 'color', 'bestbug' ),
						'tab' => array(
							'element' =>  WPE_META_POST.'tab',
							'value' => array('square')
						),
					),
					array(
						'type' => 'time',
						'heading'     => esc_html__('time', 'bestbug' ),
						'param_name'  => WPE_META_POST.'time',
						'value' => '08:00',
						'description' => esc_html__( 'time', 'bestbug' ),
						'tab' => array(
							'element' =>  WPE_META_POST.'tab',
							'value' => array('round')
						),
					),
					array(
						'type' => 'date_time',
						'heading'     => esc_html__('date_time', 'bestbug' ),
						'param_name'  => WPE_META_POST.'date_time',
						'value' => '2020-01-01T01:00',
						'description' => esc_html__( 'date_time', 'bestbug' ),
						'tab' => array(
							'element' =>  WPE_META_POST.'tab',
							'value' => array('square')
						),
					),
				)
			);
			return $options;
		}
        
    }
	
	new WPE_PLUGIN_META_BOX();
}

