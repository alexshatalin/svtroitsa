<?php
class envit_Get_In_Touch extends WP_Widget {

	public function __construct() {

		// Widget actual processes
        parent::__construct(
	 		'envit_get_in_touch',                                                          // tmchampion ID
			esc_html__('TMC Get In Touch','envit'),                                         // Name
			array( 'description' => esc_html__( 'Eye catching posts widget', 'envit' ), )  // Args
		);
	}

 	public function form( $instance )
	{
		/* Set up default widget settings. */
        $defaults = array(
            'title'      => '',
            'post_order' => 'date'
        );
        $instance         = wp_parse_args( (array) $instance, $defaults );
		
		
		 if ( isset( $instance[ 'footer_getintouch_title' ] ) ) {
            $footer_getintouch_title = $instance[ 'footer_getintouch_title' ];
        } else {
            $footer_getintouch_title = '';
        }
		if ( isset( $instance[ 'footer_address' ] ) ) {
            $footer_address = $instance[ 'footer_address' ];
        } else {
            $footer_address = '';
        }
		if ( isset( $instance[ 'footer_address_two' ] ) ) {
            $footer_address_two = $instance[ 'footer_address_two' ];
        } else {
            $footer_address_two = '';
        }
		 if ( isset( $instance[ 'footer_phone' ] ) ) {
            $footer_phone = $instance[ 'footer_phone' ];
        } else {
            $footer_phone = '';
        }
		 if ( isset( $instance[ 'footer_email' ] ) ) {
            $footer_email = $instance[ 'footer_email' ];
        } else {
            $footer_email = '';
        }
       	if ( isset( $instance[ 'footer_work_timings' ] ) ) {
            $footer_work_timings = $instance[ 'footer_work_timings' ];
        } else {
            $footer_work_timings = '';
        }
		
        ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('footer_getintouch_title')); ?>"><?php echo esc_html( 'Title:', 'envit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'footer_getintouch_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'footer_getintouch_title' )); ?>" type="text" value="<?php echo esc_attr( $footer_getintouch_title ); ?>" />	
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('footer_address')); ?>"><?php echo esc_html( 'Address Line One:', 'envit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'footer_address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'footer_address' )); ?>" type="text" value="<?php echo esc_attr( $footer_address ); ?>" />
			
		</p>
        
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('footer_address_two')); ?>"><?php echo esc_html( 'Address Line Two:', 'envit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'footer_address_two' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'footer_address_two' )); ?>" type="text" value="<?php echo esc_attr( $footer_address_two ); ?>" />
			
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('footer_phone')); ?>"><?php echo esc_html( 'Phone:', 'envit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'footer_phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'footer_phone' )); ?>" type="text" value="<?php echo esc_attr( $footer_phone ); ?>" />
		</p>
		
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id('footer_email')); ?>"><?php echo esc_html( 'Email:', 'envit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'footer_email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'footer_email' )); ?>" type="text" value="<?php echo esc_attr( $footer_email ); ?>" />
		</p>

		<p>
    		<label for="<?php echo esc_attr($this->get_field_id('footer_work_timings')); ?>"><?php echo esc_html( 'Timings:', 'envit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'footer_work_timings' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'footer_work_timings' )); ?>" type="text" value="<?php echo esc_attr( $footer_work_timings ); ?>" />
		</p>

		
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = array();
		$instance[ 'footer_getintouch_title' ]= strip_tags( $new_instance['footer_getintouch_title'] );
		$instance[ 'footer_address' ] = $new_instance['footer_address'];
		$instance[ 'footer_address_two' ] = $new_instance['footer_address_two'];
		$instance[ 'footer_phone' ]= $new_instance['footer_phone'];
		$instance['footer_email'] = strip_tags( $new_instance['footer_email'] );
        $instance['footer_work_timings'] = strip_tags( $new_instance['footer_work_timings'] );

		return $instance;
	}

	public function widget( $args, $instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $envit_option;
		 $address      = apply_filters( 'widget_address', $instance['footer_address'] );
		 $addressTwo      = apply_filters( 'widget_address', $instance['footer_address_two'] );
		 $phone      = apply_filters( 'widget_phone', $instance['footer_phone'] );
		
		echo $before_widget;
	?>
	
		<div class="footerTitle">
			<p><?php echo esc_attr($instance[ 'footer_getintouch_title' ]);?></p>
		</div>
		<div class="locationBlock">
			<?php if($instance[ 'footer_address' ] != '' || $instance[ 'footer_address_two' ] != ''): ?>
				<i class="fa fa-map-marker"></i>
				<div class="locationContent">
					<p><?php echo esc_attr($instance[ 'footer_address' ]);?></p>
					<span><?php echo esc_attr($instance[ 'footer_address_two' ]);?></span>
				</div>
			<?php endif; ?>
		</div>
		<div class="footerContants">
			<?php if($instance[ 'footer_phone' ] != ''): ?>
				<i class="fa fa-phone"></i>
				<a href="tel:<?php echo esc_attr($instance[ 'footer_phone' ]);?>"><?php echo esc_attr($instance[ 'footer_phone' ]);?></a>
			<?php endif; ?>
		</div>
		<div class="footerContants">
			<?php if($instance[ 'footer_email' ] != ''): ?>
				<i class="fa fa-envelope-o"></i>
				<a href="mailto:<?php echo esc_attr($instance[ 'footer_email' ]);?>" class="mail"><?php echo esc_attr($instance[ 'footer_email' ]);?></a>
			<?php endif; ?>
		</div>
		<div class="footerContants ">
			<?php if($instance[ 'footer_work_timings' ] != ''): ?>
				<i class="icon icon-Timer"></i>
				<span class="time"><?php echo esc_attr($instance[ 'footer_work_timings' ]);?></span>
			<?php endif; ?>
		</div>
	<?php

        wp_reset_postdata();
    	echo $after_widget;
	}
}
register_widget( 'envit_get_in_touch' );