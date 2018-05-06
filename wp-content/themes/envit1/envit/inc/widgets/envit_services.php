<?php
class envit_services extends WP_Widget {

	public function __construct() {

		// Widget actual processes
        parent::__construct(
	 		'envit_services',                                                          // Base ID
			esc_html__('TMC Services','envit'),                                          // Name
			array( 'description' => esc_html__( 'Eye catching posts widget', 'envit' ), )  // Args
		);
	}
 	public function form( $envit_instance )
	{
		$envit_instance['post_order'] = '';
		/* Set up default widget settings. */
		$number = 6;
        $defaults = array(
            'title'      => '',
			'number'     => $number,
        );
        $envit_instance         = wp_parse_args( (array) $envit_instance, $defaults );


		 if ( isset( $envit_instance[ 'service_title' ] ) ) {
            $envit_service_title = $envit_instance[ 'service_title' ];
        } else {
            $envit_service_title = '';
        }
		
		$number = intval($envit_instance[ 'number' ]);
		if($number<=0){
            $number = '';
        }		
		$post_order_types = array(
            'date'          => 'Recent Services',
            'title'          => 'Sort By Title'
        );		
        ?>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php echo esc_html__('How many services to show ?' ,'envit') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
			
			<label for="<?php echo esc_attr($this->get_field_id( 'post_order' )); ?>"><?php echo esc_html__('Services order:', 'envit') ?></label>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name( 'post_order' ));?>" id="<?php echo esc_attr($this->get_field_id( 'post_order' ));?>">
                <?php foreach ( $post_order_types as $post_order_type=>$post_order_value ) { ?>
                    <option value="<?php echo esc_attr($post_order_type); ?>" <?php echo ($post_order_type == $envit_instance['post_order']) ? 'selected="selected" ' : '';?>><?php echo esc_attr($post_order_value); ?></option>
                <?php } ?>
            </select>
						
		</p>

		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $envit_instance = array();
		$envit_instance[ 'number' ]     = intval($new_instance[ 'number' ]);
		$envit_instance[ 'post_order' ] = $new_instance[ 'post_order' ];
		return $envit_instance;
	}

	public function widget( $args, $envit_instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $envit_option;
		$number     = intval($envit_instance['number']);
		$post_order = $envit_instance['post_order'];
		if($number<=0) $number = '';
		
		if($post_order == 'date'){
			$order = 'DESC';			
		} else if ($post_order == 'title'){
			$order = 'ASC';
		}
				
		echo $before_widget;
		$args = array(
		
            'post_type' => 'services',
            'post_status' => 'publish',
			'posts_per_page' => $number,
			'orderby' => $post_order,
			'order'   => $order		
        );
        $the_query = new WP_Query( $args );
        $count     = 0;
	?>
	<ul class="nav nav-tabs single-services-menu" role="tablist">
			<?php
				$varPageID = get_the_ID(); 
				while ( $the_query->have_posts() ) : $the_query->the_post();
				if($varPageID == get_the_ID())
					$varClass = 'active';
				else
					$varClass = 'unactive';
			?>
				<li class="<?php echo esc_attr($varClass); ?>">
					<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
				</li>
			<?php endwhile;?>
		</ul>	
<?php
        wp_reset_postdata();
    	echo $after_widget;
	}
}
register_widget( 'envit_services' );