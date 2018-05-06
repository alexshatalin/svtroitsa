<?php /* ************* POST FORMAT IMAGE ************** */
$thumbsize = 'envit-blog-large';
?>
<div <?php post_class("blogWrapper marginBttm")?> id="post-<?php the_ID(); ?>">
	<div class="wdt_img news_img shadow_effect effect-apollo">
		<?php if ( has_post_thumbnail()): 	?>
		
		<a href="<?php the_permalink()  ?>">
			<?php  
				echo get_the_post_thumbnail($post->ID, $thumbsize, array('class'=>'img-responsive'));
			 ?>
		</a>
		<?php endif;?>
	</div>
	<h3 class="margin-read"><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
	<div class="blogContent">
		<div class="simple-text">
			<p><?php echo the_excerpt(); ?></p>
		</div>
	</div>
	<div class="service-item margin-read">
		<a href="<?php the_permalink()?>" class="c-btn event_btn"><?php echo  esc_html__('Read More', 'envit');?></a>
	</div>
</div>