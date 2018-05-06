<?php envit_get_header(); ?>
	
<div class="error_page">
	<div class="container">
		<div class="pageErroreTitle">
			<div class="cell-view">
				<h1 class="h1 as light"><?php echo esc_html__('404','envit'); ?></h1>
				<p><?php echo esc_html__('Oops! That page cannot be found','envit'); ?></p>
				<span><?php echo esc_html__('Sorry, but the page you are looking for does not existing','envit'); ?></span>
				<div class="emptySpace60 emptySpace-xs30"></div>
				<a href="<?php echo esc_url(get_home_url('/')); ?>" class="button errorbtn"><?php echo esc_html__('go to home page','envit'); ?></a>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>