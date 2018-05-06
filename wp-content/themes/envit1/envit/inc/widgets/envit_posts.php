<?php 
class envit_Posts extends WP_Widget {
	public function __construct() {
		// Widget actual processes
        parent::__construct(
	 		'envit_posts',                                                                // Base ID
			esc_html__('TMC Posts','envit'),                                               // Name
			array( 'description' => esc_html__( 'Eye catching posts widget', 'envit' ), )  // Args
		);
	}
 	public function form( $envit_instance ) {
		/* Set up default widget settings. */
        $defaults = array(
            'title'      => '',
            'number'     => 4,
            'post_order' => 'date'
        );
        $envit_instance         = wp_parse_args( (array) $envit_instance, $defaults );
		if ( isset( $envit_instance[ 'title' ] ) ) {
            $title = $envit_instance[ 'title' ];
        } else {
            $title = '';
        }
        $number = intval($envit_instance[ 'number' ]);
        if($number<=0){
            $number = 4;
        }

        $post_order_types = array(
            'comment_count' => 'Popular Posts',
            'date'          => 'Recent Posts',
            'rand'          => 'Random Posts'
        );
        ?>
		<p>
    		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html( 'Title:','envit'); ?></label> 
    		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p> 	
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php  echo esc_html('How many posts to show ?' ,'envit') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'post_order' )); ?>"><?php echo esc_html('Posts order:', 'envit') ?></label>
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
		$envit_instance[ 'title' ]      = $new_instance['title'];
        $envit_instance[ 'number' ]     = intval($new_instance[ 'number' ]);
        $envit_instance[ 'post_order' ] = $new_instance[ 'post_order' ];
		return $envit_instance;
	}

	public function widget( $args, $envit_instance )
	{
		// Outputs the content of the widget
        extract( $args );
		$title      = apply_filters( 'widget_title', $envit_instance['title'] );
        $post_order = $envit_instance['post_order'];
        $number     = intval($envit_instance['number']);
        if($number<=0) $number = 4;
        
		echo $before_widget;

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'orderby' => $post_order
        );
        $the_query = new WP_Query( $args );
        $count     = 0;

        if ( $the_query->have_posts() ) : ?>
		<?php if($envit_instance['title'] != ''){ ?>
			<div class="recentTitle">
				<h5 class="h5 as"><?php echo wp_kses_post($envit_instance['title']);?></h5>
			</div>
		<?php } ?>					
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); $count ++; ?>
			<div class="recentNewsBlock normall">
				<div class="recentNews">
					<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
					<span><?php echo get_the_date("d"); ?> <?php echo get_the_date("M"); ?> <?php echo get_the_date("Y"); ?></span>
				</div>
			</div>
		<?php endwhile; ?>
			<?php 
        endif;
        wp_reset_postdata();
        
    	echo $after_widget;
	}
}
register_widget( 'envit_Posts' );