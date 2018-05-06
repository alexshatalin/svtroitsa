<?php
class envit_donate_now extends WP_Widget {

	public function __construct() {

		// Widget actual processes
        parent::__construct(
	 		'envit_donate_now',                                                          // Base ID
			esc_html__('TMC Donate Now','envit'),                                          // Name
			array( 'description' => esc_html__( 'Eye catching posts widget', 'envit' ), )  // Args
		);
	}
 	public function form( $envit_instance )
	{
		/* Set up default widget settings. */
		    $defaults = array(
            'title'      => '',
			        );
        $envit_instance         = wp_parse_args( (array) $envit_instance, $defaults );

		if ( isset( $envit_instance[ 'text_content' ] ) ) 
		{
            $text_content = $envit_instance[ 'text_content' ];
        } 
		else 
		{
            $text_content = '';
        }
		if ( isset( $envit_instance[ 'textarea_content' ] ) ) 
		{
            $textarea_content = $envit_instance[ 'textarea_content' ];
        } 
		else 
		{
            $textarea_content = '';
        }
		
        ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('text_content')); ?>"><?php echo esc_html( 'Text:', 'envit' ); ?></label>	
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'text_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text_content' )); ?>"><?php echo esc_attr( $text_content ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('textarea_content')); ?>"><?php echo esc_html( 'Content:', 'envit' ); ?></label>	
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'textarea_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'textarea_content' )); ?>"><?php echo esc_attr( $textarea_content ); ?></textarea>
		</p>

		<?php 
	}
	public function update( $new_envit__instance, $old_instance ) {
		// processes widget options to be saved
        $envit_instance = array();
		$envit_instance[ 'text_content' ]     = $new_envit__instance[ 'text_content' ];
		$envit_instance[ 'textarea_content' ] = $new_envit__instance[ 'textarea_content' ];
		
		return $envit_instance;
	}

	public function widget( $args, $envit_instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $envit_option;
		$textContent      = apply_filters( 'text_content', $envit_instance['text_content'] );
		$textareaContent      = apply_filters( 'textarea_content', $envit_instance['textarea_content'] );		
		echo $before_widget;
	?>

		<div class="faq_query">
						<h4 class="tt-faq-title"><?php echo esc_attr($envit_instance['text_content']);?></h4>
						<div class="simple-text">
								<p><?php echo esc_attr($envit_instance[ 'textarea_content' ]);?></p>
						</div>
						<a class="c-btn" href="<?php echo esc_url(get_permalink($envit_option['donate_now']));?>"><?php echo get_the_title($envit_option['donate_now']);?></a>
		</div>
<?php
        wp_reset_postdata();
    	echo $after_widget;
	}
}
register_widget( 'envit_donate_now' );