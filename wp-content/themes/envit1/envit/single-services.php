<?php envit_get_header(); ?>
<div class="cellpadding servicestype">
	<?php
	while ( have_posts() ) 
	{
		the_post();
	?>
		<div class="row">
			<?php if(is_active_sidebar( 'envit-services-sidebar'))
			{ ?>
				<div class="col-sm-12 col-md-4 col-md-push-8 col-lg-3 col-lg-push-9">
					<aside class="blogAside">
					<?php dynamic_sidebar('envit-services-sidebar'); ?>
					</aside>
				</div>
	<?php 	} ?>	
			<div class="col-sm-12 col-md-8 col-md-pull-4 col-lg-9 col-lg-pull-3">
				<div class="mainServicesContent">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
<?php } ?>
</div>
<?php get_footer(); ?>