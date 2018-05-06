<?php
	class envit_logo_text extends WP_Widget {
	public function __construct() 
	{
		// Widget actual processes
		$widget = array(
            'classname' => 'envit_info',
            'description' => 'Widget that uses the built in Media library.'
        );	
		parent::__construct( 'pu_media_upload', 'TMC Logo & Text', $widget );
        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
	}
	public function upload_scripts()
    {
		wp_enqueue_media();
		wp_enqueue_script( 'upload_media_widget', get_template_directory_uri() . '/assets/js/upload-media.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );
    }
 	public function form( $instance )
	{
		/* Set up default widget settings. */	
		 $instance         = wp_parse_args( (array) $instance  );
		$image = '';
		$image_uri = '';
		
		if(isset($instance['image_uri']))
        {
            $image = $instance['image_uri'];
        }
		if(isset($instance['image']))
        {
            $image = $instance['image'];
        }
        $defaults = array(
							'footer_content' => '',
							'footer_logo' => '',
							'image_uri' => '',
							
						);
        $instance         = wp_parse_args( (array) $instance, $defaults );
		$footer_logo = '';
		if ( isset( $instance[ 'footer_logo' ] ) ) 
		{
            $footer_logo = $instance[ 'footer_logo' ];
        } 
		else 
		{			
			 $footer_logo = '';
		}
		$footer_content = '';
		if ( isset( $instance[ 'footer_content' ] ) ) 
		{
            $footer_content = $instance[ 'footer_content' ];
        }		
		else
		{
			$footer_content = '';
		}
		if ( isset( $instance[ 'readmore_text' ] ) ) 
		{
            $readmore_text = $instance[ 'readmore_text' ];
        }
		else 
		{
            $readmore_text = '';
        }
		
        ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image_uri')); ?>"><?php echo esc_html( 'Logo:', 'envit' ); ?></label><br />
			<?php
				if ( $instance['image_uri'] != '' ) :		
				$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
				if(isset($instance['image']))
				{
					$detectedType = exif_imagetype($instance['image']['tmp_name']);
				}
				else
				{
					$detectedType = '';
				}
				$error = !in_array($detectedType, $allowedTypes);			
					echo '<img class="custom_media_image" src="'.esc_url($instance['image_uri']).'" style="margin:0;padding:0;float:left;display:inline-block" width=100px; height=100px; /><br />';
				endif;
			?>
			<input type="text" class="widefat custom_media_url" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" id="<?php echo esc_attr($this->get_field_id('image_uri')); ?>" value="<?php echo esc_url($instance['image_uri']); ?>" style="margin-top:5px;">

			<input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" value="Upload Image" style="margin-top:5px;" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'content' )); ?>"><?php echo esc_html__('Content' ,'envit') ?></label> 
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'footer_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'footer_content' )); ?>"><?php echo esc_attr( $footer_content ); 
			?></textarea>
		</p>
				
			<?php 
	}
	public function update( $new_instance, $old_instance ) 
	{
		// processes widget options to be saved
        $instance = array();
		$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
        $instance[ 'footer_content' ]     = $new_instance[ 'footer_content' ];		
		
		return $instance;
	}
	public function widget( $args, $instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $envit_option;
        $footer_content     = $instance['footer_content'];
        
		
		
		echo $before_widget; 
		if ($instance['image_uri']): ?>
				
		<div class="footer_logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tt-footer-logo">
			<img class="img-responsive" src="<?php echo esc_url( $instance['image_uri'] ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>			
		</div>
		<div class="empty-space-mb-30"></div>
		<?php endif; ?>	   
		<div class="simple-article">
			<p>
				<?php echo esc_attr($instance['footer_content']); ?> 
			</p>	
		</div>					
		<?php	
        wp_reset_postdata();        
    	echo $after_widget;
	}
}
register_widget( 'envit_logo_text' );