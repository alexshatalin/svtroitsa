<?php envit_get_header(); ?>
	<div class="content-area">
		<div class="blogdetails causedetails">
			<div class="container">
				<div class="row">
					<?php
						while ( have_posts() ) 
						{
							the_post();
							?>
							<div class="col-sm-12 col-md-9">
								<div class="mainBlogContent">
									<div class="blogWrapper">
										<a class="tt-news-img custom-hover imgWrapper" href="#">
										   <?php
											if( has_post_thumbnail( ) ) 
											{
												the_post_thumbnail( 'blog-large', array('class' => 'img-responsive') );
											}
											?>
										</a>
										<h5 class="h5 as tt-featured-title font-20"><a href="#"><?php the_title(); ?></a></h5>
										<div class="text_block wpb_text_column blogContent clearfix">
											<?php the_content(); ?>
										</div>
										<?php
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'envit' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
											'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'envit' ) . ' </span>%',
											'separator'   => '<span class="screen-reader-text">, </span>',
										) );
										?>
									</div>
									<?php
									if ( comments_open() || get_comments_number() ) 
									{
										comments_template();
									}								
						}	?>
								</div>
							</div>
							<div class="col-sm-12 col-md-3">
								<?php dynamic_sidebar( 'envit-right-sidebar' ); ?>
							</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>