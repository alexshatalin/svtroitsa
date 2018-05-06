<?php
require get_template_directory() . '/inc/tgm/tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'envit_require_plugins' );

function envit_require_plugins() {
	$plugins_path = get_template_directory() . '/inc/tgm/plugins';
	$plugins      = array(
		
		array(
			'name'             => esc_html__('TMC Post Type','envit'),
			'slug'             => 'tmc-post-type',
			'source'           => $plugins_path . '/tmc-post-type.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
			'name'         => esc_html__('WPBakery Visual Composer','envit'),
			'slug'         => 'vc-composer',
			'source'       =>  'http://demos.pixelatethemes.com/allplugins/js_composer.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
			'external_url' => esc_url('http://vc.wpbakery.com','envit'),
		),
		array(
			'name'         => esc_html__('Revolution Slider','envit'),
			'slug'         => 'revslider',
			'source'       => 'http://demos.pixelatethemes.com/allplugins/revslider.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
			'external_url' => esc_url('http://www.themepunch.com/revolution/','envit'),
		),
		array(
			'name'     => esc_html__('Breadcrumb NavXT','envit'),
			'slug'     => 'breadcrumb-navxt',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),	
		array(
			'name'     => esc_html__('MailChimp for WordPress Lite','envit'),
			'slug'     => 'mailchimp-for-wp',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),		
		array(
			'name'     => esc_html__('Contact Form 7','envit'),
			'slug'     => 'contact-form-7',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'               => 'TMC Data options',
            'slug'               => 'tmc-data-options', 
            'source'             => $plugins_path . '/tmc-data-options.zip',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'      => 'Charitable',
            'slug'      => 'charitable',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'      => 'Events',
            'slug'      => 'the-events-calendar',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'               => 'Envato Market',
            'slug'               => 'envato-market', 
            'source'             => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip', 
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'      	     => 'Donation Plugin',
            'slug'      		 => 'give',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
		
	);

	tgmpa( $plugins, array( 'is_automatic' => true ) );
}