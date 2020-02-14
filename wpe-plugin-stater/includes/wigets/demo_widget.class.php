<?php
class wpe_demo_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'wpe_demo_widget',
			'description' => esc_html('Display Posts Widgets', 'wpelite'),
		);
		parent::__construct( 'wpe_demo_widget', esc_html('Posts Widget', 'wpelite'), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		if ( ! empty( $instance['id_shortcode'] ) ) {
			echo do_shortcode( '[your_shortcode id="'.$instance['id_shortcode'].'"]' );
		}
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$id_shortcode = ! empty( $instance['id_shortcode'] ) ? $instance['id_shortcode'] : '';
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		
		$shortcodes = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'post',
			'orderby' => 'title',
			'order'   => 'ASC',
		));
		
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'wpelite' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'id_shortcode' ) ); ?>"><?php esc_attr_e( 'Shortcode:', 'wpelite' ); ?></label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'id_shortcode' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id_shortcode' ) ); ?>">
			<?php foreach ($shortcodes as $id => $shortcode) { ?>
				<option <?php if($id_shortcode == $shortcode->ID) echo 'selected="selected"'; ?> value="<?php echo esc_attr($shortcode->ID) ?>"><?php echo esc_html($shortcode->post_title) ?></option>
			<?php } ?>
		</select>
		</p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['id_shortcode'] = ( ! empty( $new_instance['id_shortcode'] ) ) ? strip_tags( $new_instance['id_shortcode'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'wpe_demo_widget' );
});