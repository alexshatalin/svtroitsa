<?php 	global $envit_option; 
		$stickyclass = '';
		if(isset($envit_option['sticky_menu']) && $envit_option['sticky_menu'] != 1 ) {
			$stickyclass = 'header_not_sticky';
		} 
		if (! is_front_page())
			$bannerpos = 'absolute';
		else
			$bannerpos = 'relative';
?>
<header id="header" class="header4 <?php echo esc_attr($bannerpos); ?>">
	<?php 
		if(isset($envit_option['header_four_background']['url']) && $envit_option['header_four_background']['url'] != ''):	
			$headerBackground = 'style=background:url('.$envit_option['header_four_background']['url'].')';
		else:
			$headerBackground = '';
		endif; 
	?>
	<div class="header_top" <?php echo 	esc_attr($headerBackground); ?>>
	  <div class="container">	
		 <div class="thm-container clearfix">
			<div class="logo pull-left main-logo desktop-screen">
				<?php	
					$logo = get_template_directory_uri() .'/assets/images/tmp/logohomepage3.png';
					if (isset($envit_option['logo_header_four']['url'] )):
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( $envit_option['logo_header_four']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
				</a>
				<?php elseif($logo ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
					</a>
				<?php else: ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="header-right-info pull-right">
			  <ul>
				<li>
				  <div class="single-header-right-info">
						<?php if(isset($envit_option['header_four_phone_line_one']) && $envit_option['header_four_phone_line_one'] != '' || isset($envit_option['header_four_phone_line_two']) && $envit_option['header_four_phone_line_two'] != '' ):
							if(!empty($envit_option['header_four_phone_line_one_icon']))
							{
								?>
								<div class="icon-box">
									<i class="<?php echo esc_attr($envit_option['header_four_phone_line_one_icon']); ?>"></i>
								</div>
								<?php 
							} ?>
						<div class="text-box">
							<p><?php echo esc_attr($envit_option['header_four_phone_line_two']); ?></p>
							<h5><?php echo esc_attr($envit_option['header_four_phone_line_one']); ?></h5>	  
						</div>
						<?php endif; ?>
				  </div>
				</li>				
						<?php if(isset($envit_option['donate_now']) && $envit_option['donate_now'] != '') { ?>
						<li><a href="<?php echo esc_url(get_permalink($envit_option['donate_now']));?>" class="donatebtn"><?php echo get_the_title($envit_option['donate_now']);?></a></li>
						<?php } ?>			   
			  </ul>
			</div>
		 </div>
	  </div>
	</div>
	<div id = "menuid" class="main_menu menu_fixed nav-home-three <?php echo esc_attr($stickyclass); ?>">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav_bg">
              <div class="navi">
                <div class="nav-menu pull-left text-left">
					<div class="logo pull-left responsive-logo">
						<?php	
							$logo = get_template_directory_uri() .'/assets/images/tmp/logo.png';
							if (isset($envit_option['mobile_logo_four']['url'] )):
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( $envit_option['mobile_logo_four']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
						</a>
						<?php elseif($logo ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
							</a>
						<?php else: ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>	
					</div>
					
					<div class="nav-t-holder pull-left text-left display_none">
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
							if(isset($envit_option['search']) && $envit_option['search'] == 1) 
							{	?>
							<i class="icon icon-Search search1"></i>
					<?php 	}	?>
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
			   <div class="nav-search pull-right text-right">
					<?php if (  class_exists( 'Redux' ) ) 
					{
						if(isset($envit_option['social_switch']) && $envit_option['social_switch'] == '1')
						{
							$socials = envit_get_socials( 'footer_socials' ); 
							if ( $socials): ?>					
								<ul class="top-social">
								<?php foreach( $socials as $key => $val ):?>
								<li>
								<a href="<?php echo esc_url( $val ); ?>" target="_blank" class="social-<?php echo esc_attr( $key ); ?>">
								<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
								</a>
								</li>
								<?php endforeach; ?>
								</ul>					
							<?php endif; 
						}
					} ?>
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