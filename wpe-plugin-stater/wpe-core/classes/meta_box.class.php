<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'WPE_Core_Meta_Box' ) ) {
	/**
	 * WPE_Core_Meta_Box Class
	 *
	 * @since	1.0
	 */
	class WPE_Core_Meta_Box {

		public $fields;
        
		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
		 	add_action('add_meta_boxes',array( $this, 'add_meta_boxes' ) );
            add_action('save_post', array( $this, 'save_account' ), 10, 2);
		}

		public static function adminEnqueueScripts() {
			wp_enqueue_script( 'meta_box', WPE_CORE_URL .'/assets/admin/js/meta_box.js', array( 'jquery' ), WPE_CORE_VERSION, true );
		}
        public function add_meta_boxes() {
            
			$this->options = apply_filters( 'wpe_add_meta_box', array() );
    		if( !isset($this->options) || count($this->options) <= 0 ) {
    			return; 
            }
            foreach ($this->options as $key => $option) {
                $this->fields[$option["ID"]] =  $option["fields"];
                add_meta_box(
                    $option["ID"], 
                    $option["title"],
                    array(&$this, 'meta_filds'),
                    $option["post_type"] ,
                    $option["context"]);
            }
        }
        public function meta_filds($post, $option){
            wp_nonce_field('wpe_nonce_active_field', 'wpe_nonce_name_field');
            ?>
                <table class="form-table">
                    <tbody>
            <?php
                foreach ($this->fields[$option["id"]] as $key => $option) {
                    if (in_array($option["type"],array('text','textarea','radio','color','select','time','date_time','tab'))):
                        $meta_exists = get_post_meta($post->ID,  $option['param_name']);
                        if (is_array($meta_exists) && count($meta_exists) > 0) {
                            $option['value'] = $meta_exists[0];
                        } 
                        include 'meta_fields/'.$option["type"].'.field.php';
                    endif;
                }
            ?>
                    </tbody>
                </table>
            <?php
        }
        public function save_account($post_id, $post){
            if (!isset($_POST['wpe_nonce_name_field'])) {
				return;
			}
			if (!wp_verify_nonce($_POST['wpe_nonce_name_field'], 'wpe_nonce_active_field')) {
				return;
            }
            $_POST = BestBug_Helper::sanitize_data($_POST);
            foreach ( $_POST as $meta_name => $meta_value) {
				if (strpos( $meta_name, WPE_META_POST )!==false) {
					$meta_exists = get_post_meta($post_id, $meta_name);
					if (is_array($meta_exists) && count($meta_exists) > 0) {
						if ($meta_value !== $meta_exists[0]) {
							update_post_meta($post_id, $meta_name, $meta_value);
						}
					} else {
						add_post_meta($post_id, $meta_name, $meta_value, true);
					}
				}
            }
        }
        
		
    }
	
	new WPE_Core_Meta_Box();
}

