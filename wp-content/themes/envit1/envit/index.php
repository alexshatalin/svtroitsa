<?php envit_get_header();
	global $envit_option;
	if(!empty($envit_option['blog_sidebar_type'])) 
	{
		$sidebar_type = $envit_option['blog_sidebar_type'];	
	} 
	else 
	{
		$sidebar_type = 'wp';
	}
	if($sidebar_type == 'wp' && isset($envit_option['blog_wp_sidebar'])) 
	{	
		$sidebar_id = $envit_option['blog_wp_sidebar'];	
	} 
	else 
	{
		if(isset($envit_option['blog_vc_sidebar']))
		{
			$sidebar_id = $envit_option['blog_vc_sidebar'];
		}
	}
	if(!empty( $sidebar_id))
	{
		$sidebar_id =  $sidebar_id;	 
	} 
	else 
	{
		$sidebar_id = 'envit-right-sidebar';
	}
	if(!empty($envit_option['blog_sidebar_position'])) 
	{
		$sidebar_position = $envit_option['blog_sidebar_position'];
	} 
	else 
	{
		$sidebar_position = 'right';
	} 		
	$envit_layout = envit_get_structure( $sidebar_id, $sidebar_type, $sidebar_position); 
	echo wp_kses_post($envit_layout['content_before']); 
?>
	<div class="<?php echo esc_attr( $envit_layout['class'] ); ?>">
		<?php
			$posts_class = '';
			$paginate_links_data = paginate_links( array('type' => 'array') );
			if(empty( $paginate_links_data )) 
			{
				$posts_class .= ' no-paginate';
			}
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
			<?php
			if(have_posts()):
				while(have_posts()): 
					the_post();	
			?>
					<div class="blogWrapper">
						<?php if( has_post_thumbnail( ) ) 
						{ ?>
							<a class="tt-news-img imgWrapper" href="<?php echo get_the_permalink(); ?>">
							   <?php the_post_thumbnail( 'blog-large', array('class' => 'img-responsive') ); ?>
							</a>
							<?php 
							if(isset($envit_option['blog_metadata']) && $envit_option['blog_metadata'] == '1')
							{
								if(isset($envit_option['blog_multi_checkbox']) && $envit_option['blog_multi_checkbox'][1] == '1')
								{ ?>
									<div class="date"><a href="<?php echo get_the_permalink(); ?>">
										<h5><?php echo get_the_date("d"); ?></h5>
										<span><?php echo get_the_date("M"); ?></span></a>
									</div>
					<?php 		}
							}
							else
							{ ?>
								<div class="date">
									<a href="<?php echo get_the_permalink(); ?>">
										<h5><?php echo get_the_date("d"); ?></h5>
										<span><?php echo get_the_date("M"); ?></span>
									</a>
								</div>
					<?php 	} 
						} 
						if ( is_sticky( ) ) 
						{
							echo '<span class="genericon genericon-pinned"></span> ';
						} 
						if ('post' == get_post_type()):
							the_title( sprintf( '<h5 class="h5 as tt-featured-title font-20"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
								if('post' == get_post_type()):
									$tags = wp_get_post_tags(get_the_ID(), array('fields' => 'names'));
									if(isset($envit_option['blog_metadata']) && $envit_option['blog_metadata'] == '1')
									{ ?>
										<div class="blogInfo">
											<?php if(isset($envit_option['blog_multi_checkbox']) && $envit_option['blog_multi_checkbox'][2] == '1')
											{ ?>
												<p>
													<i class="fa fa-user"></i>
													<?php echo esc_html('By:','envit' ); ?> 
													<a href="<?php echo get_the_permalink(); ?>" class="titleLink blogLnk">
														<?php the_author(); ?>
													</a>
												</p>
									<?php 	}
											if(isset($envit_option['blog_multi_checkbox']) && $envit_option['blog_multi_checkbox'][4] == '1')
											{ 
												if(!empty($tags))
												{ ?>
													<p>
														<i class="fa fa-tag"></i>
												<?php 	foreach($tags as $postTags)
														{ ?>
															<a href="<?php echo get_the_permalink(); ?>" class="titleLink blogLnk">
																<?php echo esc_attr($postTags); ?>
															</a>
												<?php 	} ?>
													</p>
										<?php 	}
											}
											if(isset($envit_option['blog_multi_checkbox']) && $envit_option['blog_multi_checkbox'][3] == '1')
											{ ?>
												<p>
													<i class="fa fa-comments-o"></i>
													<?php echo esc_html('Comments:','envit' ); ?> 
													<a href="<?php comments_link(); ?>" class="titleLink blogLnk">
														<span>
															<?php echo get_comments_number(get_the_ID()); ?>
														</span>
													</a>
												</p>
									<?php 	} ?>
										</div>
							<?php 	}
									else
									{ ?>
										<div class="blogInfo">
											<p>
												<i class="fa fa-user"></i>
												<?php echo esc_html('By:','envit' ); ?> 
												<a href="<?php echo get_the_permalink(); ?>" class="titleLink blogLnk">
													<?php the_author(); ?>
												</a>
											</p>
									<?php 	if(!empty($tags))
											{ ?>
												<p>
													<i class="fa fa-tag"></i>
											<?php 	foreach($tags as $postTags)
													{ ?>
														<a href="<?php echo get_the_permalink(); ?>" class="titleLink blogLnk">
															<?php echo esc_attr($postTags); ?>
														</a>
											<?php 	} ?>
												</p>
									<?php	}	?>
											
											<p>
												<i class="fa fa-comments-o"></i>
												<?php echo esc_html('Comments:','envit' ); ?> 
												<a href="<?php comments_link(); ?>" class="titleLink blogLnk">
													<span>
														<?php echo get_comments_number(get_the_ID()); ?>
													</span>
												</a>
											</p>
										</div>
							<?php	}
						endif;
							endif; 
									the_content(sprintf(
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									));
									wp_link_pages( array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'envit' ),
										'after'  => '</div>',
									) );
								?>
					</div>
					<div class="emptySpace80 emptySpace-xs30"></div>
					<?php
				endwhile;
					if (class_exists( 'Redux' )) {
						if(isset($envit_option['blog_pagination']) && $envit_option['blog_pagination'] == '1'){ ?>
							<div class="paginationWrapper large">
								<div class="nubmerPagination">
								<?php		echo paginate_links( array(
										'type'      => 'list',
										'prev_text' => '<i class="fa fa-angle-left"></i>',
										'next_text' => '<i class="fa fa-angle-right"></i>',
									) );
								?>
								</div>
							</div>
					<?php	}
					}else{
						echo paginate_links( array(
							'type'      => 'list',
							'prev_text' => '<i class="fa fa-angle-left"></i>',
							'next_text' => '<i class="fa fa-angle-right"></i>',
						) );
					}
				
			 elseif ( is_search() ) : ?>
			<p><?php echo esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'envit' ); ?></p>
		<?php else : ?>

			<p><?php echo esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'envit' ); ?></p> 
		<?php	endif;
			?>
		</div>
	</div>

<?php echo wp_kses_post($envit_layout['content_after']); ?>
<?php echo wp_kses_post($envit_layout['sidebar_before']); ?>
<?php
if ( $sidebar_id ) {
	if ( $sidebar_type == 'wp' ) {
		$sidebar = true;
	} else {
		$sidebar = get_post( $sidebar_id );
	}
}
if ( isset( $sidebar ) ) {
	if ( $sidebar_type == 'vc' ) { ?>
		<div class="sidebar-area envit_sidebar">
			<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
		</div>
	<?php } else { ?>
	<?php if( is_active_sidebar( $sidebar_id ) ){ ?>
		<div class="mobileSearch large">
			<?php echo esc_attr('Sidebar','envit'); ?>
			<i class="fa fa-angle-down"></i>
		</div>
		<aside class="blogAside">
				<?php dynamic_sidebar( $sidebar_id ); ?>
		</aside>
		<?php } ?>
	<?php }
}
?>
<?php echo wp_kses_post($envit_layout['sidebar_after']); ?>
<?php get_footer(); ?>