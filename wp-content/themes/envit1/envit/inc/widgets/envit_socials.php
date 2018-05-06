<?php class envit_socials extends WP_Widget {
	public function __construct() {
		// Widget actual processes
        parent::__construct(
	 		'envit_socials',                                                          // Base ID
			esc_html__('TMC Social Icons','envit'),                                         // Name
			array( 'description' => esc_html__( 'Display socials Icons', 'envit' ), )  // Args
		);
	}
 	public function form( $instance )
	{
		/* Set up default widget settings. */
        $instance         = wp_parse_args( (array) $instance );
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = array();
		return $instance;
	}
	public function widget( $args, $instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $envit_option;
		echo $before_widget;
        $count     = 0;
	?>
	<?php $socials = envit_get_socials(); ?>	
	<?php if ( $socials): ?>
		<ul class="nav footer-social">			<?php foreach( $socials as $key => $val ): ?>			<li><a href="<?php echo esc_url( $val ); ?>" target="_blank" class="social-<?php echo esc_attr( $key ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a></li>			<?php endforeach; ?>		</ul>	
	<?php endif; ?>	
<?php
       	wp_reset_postdata();
	echo $after_widget;
	}
}
register_widget( 'envit_socials' );