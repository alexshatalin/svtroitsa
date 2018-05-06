<?php 	global $envit_option; 
		$stickyclass = '';
		if(isset($envit_option['sticky_menu']) && $envit_option['sticky_menu'] != 1 ) {
			$stickyclass = 'header_not_sticky';
		} 
		if (! is_front_page()) {
			$bannerpos = 'absolute';
		}else{
			$bannerpos = 'relative';
		} 
?>
<header id="header" class="header2 <?php echo esc_attr($bannerpos); ?>">
	<?php 
		if(isset($envit_option['header_one_background']['url']) && $envit_option['header_one_background']['url'] != ''):	
			$headerBackground = 'style=background:url('.$envit_option['header_one_background']['url'].')';
		else:
			$headerBackground = '';
		endif; 
	?>

	<div id = "menuid" class="main_menu menu_fixed nav-home-three <?php echo esc_attr($stickyclass); ?>">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav_bg">
              <div class="navi">
                <div class="nav-menu pull-left text-left">
					<div class="logo pull-left desktop-screen">
						<?php	
							$logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
							if (isset($envit_option['logo_header_two']['url'] )):
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( $envit_option['logo_header_two']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
						</a>
						<?php elseif($logo ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
							</a>
						<?php else: ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>	
					</div>
					<div class="logo pull-left mobile-screen">
						<?php	
							$logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
							if (isset($envit_option['mobile_logo_two']['url'] )):
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( $envit_option['mobile_logo_two']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
						</a>
						<?php elseif($logo ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
							</a>
						<?php else: ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>	
					</div>
					<div class="nav-t-holder pull-right text-left display_none">
						<div class="nav-t-header">
						  <button><i class="fa fa-bars"></i></button>
						</div>
						<div class="nav-t-footer">
							<?php wp_nav_menu( 
								  array(
									'menu_id' => 'Primary',
									'theme_location' => 'envit-primary_menu',
									'container'      => false,
									'depth'          => 3,
									'after'     	 => '<i class="fa fa-angle-down"></i>',
									'menu_class'     => 'nav'
									)
								); 			
							?>
							
							<?php if(isset($envit_option['search']) && $envit_option['search'] == 1) { ?>
							<i class="icon icon-Search search1"></i><?php }?>
							<div class="mobile-link" style="display:none;">
							 <ul>
							 <?php if(isset($envit_option['donate_now']) && $envit_option['donate_now'] != '') { ?>
							 <li><a href="<?php echo esc_url(get_permalink($envit_option['donate_now']));?>"><?php echo get_the_title($envit_option['donate_now']);?></a></li>
							 <?php } ?>
							 </ul>
							</div>
							<div class="nav-search1 pull-right text-right">
								<div class="widget-t widget-t-search">
								  <div class="widget-t-inner">
								<?php 
									$serValue = '';
									if ( is_search()) {
										$serValue = get_search_query();
									}
								?>
									<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form">
									  <div class="input-group">
										<input type="search" value="<?php echo esc_attr($serValue); ?>" name="s" placeholder="<?php echo esc_html__( 'Search', 'envit'); ?>" class="form-control" required /><span class="input-group-addon">
										  <button type="submit"><i class="icon icon-Search"></i></button></span>
										</div>
									</form>
								  </div>
								</div>
							</div>
						</div>
					</div>
                </div>
			
			 </div>
			</div>
          </div>
		</div>
		     <div id="cd-search" class="cd-search is-visible" style="display: none;">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
				  <input value="<?php echo esc_attr($serValue); ?>" type="search" name="s" placeholder="<?php echo esc_html__( 'Search...', 'envit'); ?>" required />
				</form>
				<a href="#" id="close-search-btn"><i class="fa fa-times" aria-hidden="true"></i></a>
			</div>
      </div>
</header>