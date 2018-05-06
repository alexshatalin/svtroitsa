<?php
/**
 * The template for displaying search results pages.
 *
 * @package envit
 */
global $post;
envit_get_header();
?>
 	<div class="row_inner_wrapper clearfix blogs-area search">
		<div class="row">
			<div id="primary" class="col-sm-12 col-md-9">
				<div id="main" class="mainBlogContent">
					<?php 
					$search_format = array('post_type' =>  'any', 's' => $s, 'paged' => $paged); 
					query_posts($search_format);
					if ( have_posts() ) : ?>
						<div class="blog-posts">
							<?php
							if( have_posts()):
								while ( have_posts() ) : the_post(); 
									if ( get_post_format( $post->ID )):
										get_template_part( 'content', get_post_format() );
									else:
										get_template_part('search', 'format');
									endif;	
								endwhile;
							endif;
							?>
						</div>
					<?php else : ?>
					<div class="simple-text">
						<p>
							<?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'envit' ); ?>
						</p>
					</div>
					<?php endif; ?>
				</div><!-- #main -->
				<div class="paginationWrapper large">
					<div class="nubmerPagination">
						<?php echo paginate_links( array(
								'type'      => 'list',
								'prev_text' => '<i class="fa fa-angle-left"></i>',
								'next_text' => '<i class="fa fa-angle-right"></i>',
							) );
						?>
					</div>
				</div>
			</div><!-- #primary -->
			<div class="col-sm-12 col-md-3">
				<aside class="blogAside">
			<?php 	if( is_active_sidebar( 'envit-right-sidebar' ) )
					{ ?>
					<div class="sidebar-section">
						<?php dynamic_sidebar( 'envit-right-sidebar' ); ?>
					</div>
			<?php 	} ?>	
				</aside>
			</div>
		</div> <!-- /#content-wrap -->
	</div>
<?php get_footer(); ?>