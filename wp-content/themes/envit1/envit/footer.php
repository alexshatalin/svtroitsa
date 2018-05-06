	</div> <!--.content_wrapper-->
	<?php global $envit_option; 
	if (  class_exists( 'Redux' ) )
	{		
		//$footerBg = '';
		//$footerBg = backgroundStyle('footer_bg');
		//$footerBg = implode('', $footerBg);
		?>
			<footer style="<?#php echo esc_attr($footerBg); ?>">
				<?php if( isset($envit_option['footer_widget']) && $envit_option['footer_widget'] == '1' ) 
				{ 
					if(is_active_sidebar( 'envit-footer-1') || is_active_sidebar( 'envit-footer-2') || is_active_sidebar( 'envit-footer-3') || is_active_sidebar( 'envit-footer-4')): 
					if( isset($envit_option['footer_sidebar_count'] )): ?>
						<div class="footer-top">
							<div class="container">
								<div class="row">
								<?php
									$footer_sidebar_count = intval( $envit_option['footer_sidebar_count'] );
									$col = 12 / $footer_sidebar_count;
									for ( $count = 1; $count <= $footer_sidebar_count; $count ++ ): 
			 
									if( $count == 3 ): 
										$className = 'fwidget';
									else: 
										$className = '';
									endif; 
								?>
									<div class="widget<?php echo esc_attr($count); ?> col-xs-12 col-sm-6 col-md-<?php echo esc_attr( $col ); ?> footer-<?php echo esc_attr($count); ?> <?php echo esc_attr($className); ?>">
								<?php 	if( is_active_sidebar( 'envit-footer-' . $count ) )
										{ 
											dynamic_sidebar( 'envit-footer-' . $count );
										} ?>
									</div>
								<?php endfor; ?>
								</div>
							</div>
						</div>
			<?php 	endif; 
					endif; 
				} 
				if( !empty( $envit_option['copyright_switch'] ) ) 
				{ ?>
					<div class="footer-bottom">
						<div class="container">
							<div class="row">
								<div class="bottomInfo small">
									<div class="col-xs-12 col-sm-8">
									<div class="copy">
										<?php if( !empty( $envit_option['footer_copyright'] ) ) { ?>							
											<p><?php echo wp_kses_post( $envit_option['footer_copyright'] ); ?></p>
										<?php } ?>
									</div>
									</div>
									<div class="col-xs-12 col-sm-4">
										<div class="created">
											<?php if( !empty( $envit_option['copyright_right_switch'] ) ) { ?>
												<a href="<?php echo wp_kses_post( $envit_option['copy_right_link'] ); ?>"><?php echo wp_kses_post( $envit_option['copy_right_first'] ); ?> <?php echo wp_kses_post( $envit_option['copy_right'] ); ?></a>
											<?php } ?>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
			<?php } ?>
			</footer>
<?php
	}
	else
	{ ?>
			<footer>
		<?php 	if(is_active_sidebar( 'envit-footer-1') || is_active_sidebar( 'envit-footer-2') || is_active_sidebar( 'envit-footer-3') || is_active_sidebar( 'envit-footer-4')): ?>
					<div class="footer-top">
						<div class="container">
							<div class="row">
								<div class="widget1 col-xs-12 col-sm-6 col-md-3 footer-1">
									<?php 	
									if( is_active_sidebar( 'envit-footer-1') )
									{ 
										dynamic_sidebar( 'envit-footer-1');
									}
									?>
								</div>
								<div class="widget2 col-xs-12 col-sm-6 col-md-3 footer-2">
									<?php 	
									if( is_active_sidebar( 'envit-footer-2') )
									{ 
										dynamic_sidebar( 'envit-footer-2');
									}
									?>
								</div>
								<div class="widget3 col-xs-12 col-sm-6 col-md-3 footer-3">
									<?php 	
									if( is_active_sidebar( 'envit-footer-3') )
									{ 
										dynamic_sidebar( 'envit-footer-3');
									}
									?>
								</div>
								<div class="widget4 col-xs-12 col-sm-6 col-md-3 footer-4">
									<?php 	
									if( is_active_sidebar( 'envit-footer-4') )
									{ 
										dynamic_sidebar( 'envit-footer-4');
									}
									?>
								</div>
							</div>
						</div>
					</div>
		<?php 	endif; ?>
				<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="bottomInfo small">
								<div class="col-xs-12 col-sm-8">
									<div class="copy">					
										<p><?php echo esc_html__('Copyright © envit 2018. All rights reserved.','envit')?></p>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="created">
										<a href="<?php echo esc_html__('https://themeforest.net/user/ThemeChampion','envit'); ?>"><?php echo esc_html__('Created by: ThemeChampion','envit')?></a>
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</footer>
<?php
	}	?>
</div>
<?php 
	if( isset($envit_option['top_back_button_one']) && $envit_option['top_back_button_one'] == 4){ ?>
	<?php }elseif($envit_option['top_back_button_one'] == 3){ ?>
			<div id="btt" class="mobileBtt"><i class="fa fa-angle-double-up"></i></div>
	<?php }elseif($envit_option['top_back_button_one'] == 2){ ?>
			<div id="btt" class="desktopBtt"><i class="fa fa-angle-double-up"></i></div>
	<?php } else { ?>
			<div id="btt"><i class="fa fa-angle-double-up"></i></div>
<?php } 
wp_footer(); ?>
</body>
</html>