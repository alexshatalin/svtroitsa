<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div class="event_details">

	<!-- Notices -->
	<?php tribe_the_notices() ?>
	
	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'envit' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
						
				<div class="row">
					<div class="col-md-9">
					   <div class="image custom-hover">
						   <?php
								if( has_post_thumbnail( ) ) {
									the_post_thumbnail( 'blog-large', array('class' => 'img-responsive') );
								}
							?>
						</div>
				   </div>
				   
				   <div class="col-md-3 pl0 ml15">
					   <div class="buy_ticket">
						  <?php echo tribe_events_event_schedule_details( $event_id, '<h4>', '</h4>' ); ?>
						  <?php if ( tribe_get_cost() ) : ?>
							<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
						  <?php endif; ?>
								<h4><?php echo tribe_get_full_address(); ?></h4>
					   </div>
				   </div>
			   </div>
						
			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			
				<div class="details">
					<h3 class="tt-title font28"><?php the_title(); ?></h3>
					<?php the_content(); ?>
				</div>
						
			<!-- .tribe-events-single-event-description -->
			<?php 
				do_action( 'tribe_events_single_event_after_the_content' );
				do_action( 'tribe_events_single_event_before_the_meta' );
				tribe_get_template_part( 'modules/meta' ); 
				do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div>
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>



</div><!-- #tribe-events-content -->
