<?php global $envit_option; 
	$stickyclass = '';
	if(isset($envit_option['sticky_menu']) && $envit_option['sticky_menu'] != 1 ) 
	{
		$stickyclass = 'header_not_sticky';
	} 
	if (! is_front_page()) 
	{
		$bannerpos = 'absolute';
	}
	else
	{
		$bannerpos = 'relative';
	} 
?>
<header id="header" class="header2 header3 <?php echo esc_attr($bannerpos); ?>">
	<?php 
		if(isset($envit_option['header_three_background']['url']) && $envit_option['header_three_background']['url'] != ''):	
			$headerBackground = 'style=background:url('.$envit_option['header_three_background']['url'].')';
		else:
			$headerBackground = '';
		endif; 
	if (  class_exists( 'Redux' ) ) 
	{ ?>
	<div class="top-line">
        <div class="container">
            <div class="top-line-inner clearfix">
			     <div class="top-line-left">
					<?php if(isset($envit_option['header_three_phone_line_one']) && $envit_option['header_three_phone_line_one'] != '' ) ?>
				    <div class="top-info"><?php echo esc_attr($envit_option['phone_text']); ?>
						<a href="tel:+ <?php echo esc_url($envit_option['header_three_phone_line_one']);?>" class="hmnumber"><?php echo esc_attr($envit_option['header_three_phone_line_one']); ?></a>
					</div>
					<?php if(isset($envit_option['header_three_email_line']) && $envit_option['header_three_email_line'] != '' ) ?>
					<div class="top-info"><?php echo esc_attr($envit_option['email_text']); ?> 
						<a href="mailto:info@envit.com"><?php echo esc_attr($envit_option['header_three_email_line']); ?></a>
					</div>
				</div>
				<div class="top-line-right">
					<?php 
					if(isset($envit_option['social_switch_header_three']) && $envit_option['social_switch_header_three'] == '1')
					{
						$socials = envit_get_socials( 'footer_socials' ); 
						if ( $socials): ?>
						<div class="top-info">
							<ul class="top-social">
							<?php foreach( $socials as $key => $val ):?>
							<li>
							<a href="<?php echo esc_url( $val ); ?>" target="_blank" class="social-<?php echo esc_attr( $key ); ?>">
							<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
							</a>
							</li>
							<?php endforeach; ?>
							</ul>
						</div>
						<?php endif; 
					}
					?>
				</div>  
			</div>
		</div>	
	</div>
<?php } ?>
	<div id = "menuid" class="main_menu menu_fixed nav-home-three <?php echo esc_attr($stickyclass); ?>">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav_bg">
              <div class="navi">
                <div class="nav-menu pull-left text-left">
					<div class="logo pull-left desktop-screen">
						<?php	
							$logo = get_template_directory_uri() .'/assets/images/tmp/logo_small.png';
							if (isset($envit_option['logo_header_three']['url'] )):
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( $envit_option['logo_header_three']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
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
							$logo = get_template_directory_uri() .'/assets/images/tmp/logo_small.png';
							if (isset($envit_option['mobile_logo_three']['url'] )):
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( $envit_option['mobile_logo_three']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
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
      </div>
</header>