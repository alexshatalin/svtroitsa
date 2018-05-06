<?php

/* ------------------------------------------------------------------------ */
/* Redux Configuration
/* ------------------------------------------------------------------------ */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "envit_option";
	global $logo_tmp_src;
    $theme = wp_get_theme(); // For use with some settings. Not necessary.

   $args = array(
        'opt_name'          => 'tmc_options',       // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
        'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
        'menu_type'         => 'submenu',               //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'    => false,                   // Show the sections below the admin menu item or not
        'menu_title'        => __('Theme Options', 'envit'),
        'page_title'        => __('Theme Options', 'envit'),
        'save_defaults'     => true,
        'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
        'admin_bar'         => false,                    // Show the panel pages on the admin bar
        'global_variable'   => 'envit_option',     // Set a different name for your global variable other than the opt_name
        'dev_mode'          => false,                    // Show the time the page took to load, etc
        'customizer'        => false,                    // Enable basic customizer support
        'page_slug'         => 'envit_options',
        'system_info'       => false,
        'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    );

	 
	
    Redux::setArgs( $opt_name, $args, $logo_tmp_src  );

    /* Set Extensions /-------------------------------------------------- */
    Redux::setExtensions( $opt_name, dirname( __FILE__ ) . '/extensions/' );

	 /* General /--------------------------------------------------------- */
    Redux::setSection( $opt_name, array(
        'title'     => __('General', 'envit'),
		'desc'   	=> '',
        'icon'      => 'el-icon-home',
		'class'     => 'main_background',
		'submenu'   => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

			array(
                'id'       => 'switch_comments',
                'type'     => 'switch', 
                'title'    => __('Global Page Comments', 'minti-framework'),
                'subtitle' => __('You can globally disable the Page Comments.', 'minti-framework'),
                'default'  => true,
            )
			
        ),
    ) );

	/* Layout  */
	
		Redux::setSection( $opt_name, array(
			'title'     => esc_html__('Layout', 'envit'),
			'desc'   => '',
			'class'     => 'main_background',
			'icon'   => 'el el-th',
			'submenu' => true,
			'fields'    => array(
	
			array(
				'id'       => 'top_back_button_one',
				'type'     => 'select',
				'title'    => __('Back to Top Button', 'envit'),
				'subtitle' => esc_html__('Enable / Disable Back to Top Button.', 'envit'),
				'options'  => array(
					'1' => 'Enable on All Devices',
					'2' => 'Enable on Desktop Only',
					'3' => 'Enable on Mobile Only',
					'4' => 'Disable'
				),
				'default'  => '1',
			),
			
			array(
				'id'       => 'layout_style',
				'type'     => 'select',
				'title'    => __('Layout Style', 'envit'),
				'subtitle' => esc_html__('Choose your Layout Style.', 'envit'),
				'options'  => array(
					'1' => 'Fullwidth',
					'2' => 'Boxed Layout',
				),
				'default'  => '1',
			), 
			  array(
				'id'       => 'boxed_bg',
				'type'     => 'background',
				'compiler' => true,
				'output'   => array('body'),
				'title'    => esc_html__('Body Background', 'envit'),
				'required' => array('layout_style','=','2', ),
				'default'  => ''
			),
		)
	) );
	
	/* Header /--------------------------------------------------------- */
	 
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__('Header', 'envit'),
		'background-color' => '#ef9a9a',
		'desc'   => '',
		'class'     => 'main_background multi-header',
        'icon'   => 'el el-credit-card',
		'submenu' => true,
        'fields'    => array(			
		
		array(
                'id'       => 'header_style',
                'type'     => 'image_select',
                'title'    => __('Header Layout', 'envit'), 
                'subtitle' => __('Select the header Layout', 'envit'),
                'description' => __('', 'envit'),
                'options'  => array(
                    'envit_header_1'      => array(
                        'alt'   => 'Header 1', 
                        'img'   => plugin_dir_url( __FILE__ ) .'/images/headers/header_1.png'
                    ),
					'envit_header_2'      => array(
                        'alt'   => 'Header 2', 
                        'img'   => plugin_dir_url( __FILE__ ) .'/images/headers/header_2.png'
                    ),
					'envit_header_3'      => array(
                        'alt'   => 'Header 3', 
                        'img'   => plugin_dir_url( __FILE__ ) .'/images/headers/header_3.png'
                    ),
					'envit_header_4'      => array(
                        'alt'   => 'Header 4', 
                        'img'   => plugin_dir_url( __FILE__ ) .'/images/headers/header_4.png'
                    ),
                ),
                'default' => 'envit_header_3'
            ),			
			array(
				'id'       => 'seprater_logo',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Logo', 'envit'),
				'required' => array( 
					array('header_style','!=','envit_header_3')	
				)   
			),
			array(
				'id'       =>'logo_header_one',
				'url'      => false,
				'type'     => 'media',
				'title'    => esc_html__('Logo', 'envit'),
				'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/tmp/logo.png' ),
				'required' => array('header_style','=','envit_header_1', )
				
			),
			array(
				'id'       =>'logo_header_two',
				'url'      => false,
				'type'     => 'media',
				'title'    => esc_html__('Logo', 'envit'),
				'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/tmp/logo.png' ),
				'required' => array('header_style','=','envit_header_2', )
			),
			array(
				'id'       =>'logo_header_four',
				'url'      => false,
				'type'     => 'media',
				'title'    => esc_html__('Logo', 'envit'),
				'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/tmp/logohomepage3.png' ),
				'required' => array('header_style','=','envit_header_4', )	
			),
			array(
				'id'       =>'mobile_logo',
				'url'      => false,
				'type'     => 'media',
				'title'    => esc_html__('Mobile Logo Upload', 'envit'),
				'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/tmp/logo.png' ),
				'required' => array('header_style','=','envit_header_1', )
			),
			array(
				'id'       =>'mobile_logo_two',
				'url'      => false,
				'type'     => 'media',
				'title'    => esc_html__('Mobile Logo Upload', 'envit'),
				'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/tmp/logo.png' ),
				'required' => array('header_style','=','envit_header_2', )
			),
			array(
				'id'       =>'mobile_logo_four',
				'url'      => false,
				'type'     => 'media',
				'title'    => esc_html__('Mobile Logo Upload', 'envit'),
				'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/tmp/logo.png' ),
				'required' => array('header_style','=','envit_header_4', )
			),					
			array(
				'id'       => 'seprater_info',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Header Information', 'envit'),
				'required' => array( 
					array('header_style','=','envit_header_1')	
				)   
			),					
			array(
				'id'       => 'header_one_line_one_icon',
				'type'     => 'text',
				'title'    => esc_html__('Address Icon', 'envit'),
				'default'  => esc_html__( 'icon icon-Pointer', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_1')	
				)
			),				
			array(
				'id'       => 'header_one_line_one',
				'type'     => 'text',
				'title'    => esc_html__('Address line One', 'envit'),
				'default'  => esc_html__( '13005 Greenville Avenue', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_1')	
				)
			),	
			array(
				'id'       => 'header_one_line_two',
				'type'     => 'text',
				'title'    => esc_html__('Address line Two', 'envit'),
				'default'  => esc_html__( 'California, TX 70240', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_1')	
				)
			),	
			array(
				'id'       => 'seprater_topbar_header_three',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Topbar', 'envit'),
				'required' => array( 
					array('header_style','=','envit_header_3')	
				)   
			),	
			array(
				'id'       => 'phone_text',
				'type'     => 'text',
				'title'    => esc_html__('Phone Text', 'envit'),
				'default'  => esc_html__( 'Phone:', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_3')	
				)
			),
			array(
				'id'       => 'header_three_phone_line_one',
				'type'     => 'text',
				'title'    => esc_html__('Phone line One', 'envit'),
				'default'  => esc_html__( '(1800) 456 7890', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_3')	
				)
			),	
			array(
				'id'       => 'email_text',
				'type'     => 'text',
				'title'    => esc_html__('Email Text', 'envit'),
				'default'  => esc_html__( 'Email:', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_3')	
				)
			),			
			array(
				'id'       => 'header_three_email_line',
				'type'     => 'text',
				'title'    => esc_html__('Email', 'envit'),
				'default'  => esc_html__( 'info@envit.com', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_3')	
				)
			),				
			array(
					'id'       => 'social_switch_header_three',
					'type'     => 'switch',
					'title'    => esc_html__('Enable Social Media', 'envit'),
					'subtitle' => __('Enable / Disable Social Media', 'envit'),
					'default'  => true,
					'required' => array(
										array('header_style','=','envit_header_3'),
										),
				  ),
			array(
				'id'       => 'seprater_logo_header_three',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Logo', 'envit'),
				'required' => array( 
					array('header_style','=','envit_header_3')	
				)   
			),
			array(
				'id'       =>'logo_header_three',
				'url'      => false,
				'type'     => 'media',
				'title'    => esc_html__('Logo', 'envit'),
				'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/tmp/logo_small.png' ),
				'required' => array('header_style','=','envit_header_3', )	
			),
			array(
				'id'       =>'mobile_logo_three',
				'url'      => false,
				'type'     => 'media',
				'title'    => esc_html__('Mobile Logo Upload', 'envit'),
				'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/tmp/logo_small.png' ),
				'required' => array('header_style','=','envit_header_3', )
			),
			array(
				'id'       => 'header_one_phone_line_one_icon',
				'type'     => 'text',
				'title'    => esc_html__('Phone Icon', 'envit'),
				'default'  => esc_html__( 'icon icon-Phone2', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_1')	
				)
			),	
			array(
				'id'       => 'header_one_phone_line_one',
				'type'     => 'text',
				'title'    => esc_html__('Phone line One', 'envit'),
				'default'  => esc_html__( '(1800) 456 7890', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_1')	
				)
			),	
			array(
				'id'       => 'header_one_phone_line_two',
				'type'     => 'text',
				'title'    => esc_html__('Phone line Two', 'envit'),
				'default'  => esc_html__( 'Toll Free', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_1')	
				)
			),
			array(
				'id'       => 'seprater_info_header_four',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Header Information', 'envit'),
				'required' => array( 
					array('header_style','=','envit_header_4')	
				)   
			),
			array(
				'id'       => 'header_four_phone_line_one_icon',
				'type'     => 'text',
				'title'    => esc_html__('Phone Icon', 'envit'),
				'default'  => esc_html__( 'icon icon-Phone2', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_4')	
				)
			),
			array(
				'id'       => 'header_four_phone_line_one',
				'type'     => 'text',
				'title'    => esc_html__('Phone line One', 'envit'),
				'default'  => esc_html__( '(1800) 456 7890', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_4')	
				)
			),	
			array(
				'id'       => 'header_four_phone_line_two',
				'type'     => 'text',
				'title'    => esc_html__('Phone line Two', 'envit'),
				'default'  => esc_html__( 'Toll Free', 'envit' ),			
				'required' => array( 
					array('header_style','=','envit_header_4')	
				)
			),					
			array(
				'id'       => 'seprater_header_setting',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Header Setting', 'envit'),    
			),
			array(
				'id'       => 'search',
				'type'     => 'switch',
				'title'    => esc_html__('Search', 'envit'),
				'subtitle' => __('Enable / Disable Search', 'envit'),
				'default'  => true,
			),
			array(	
				'id'       => 'donate_now',
				'type'     => 'select',	
				'title'    => __( 'Donate Now', 'envit' ), 
				'data'     => 'pages',	
				'default'  => array('page'	=> ''),			
				'required' => array( 
					array('header_style','=',array( 'envit_header_1', 'envit_header_4' ))	
				)	
			),
			array(
				'id'       =>'header_one_background',
				'type'     => 'background',
				'compiler' => true,
				'output'   => array('#header .header_top'),
				'title'    => esc_html__('Header Background', 'envit'),
				'default'  => '',
				'required' => array('header_style','=','envit_header_1'),
			),
			array(
				'id'       =>'header_three_background',
				'type'     => 'background',
				'compiler' => true,
				'output'   => array('.header3 .main_menu'),
				'title'    => esc_html__('Header Background', 'envit'),
				'default'  => '',
				'required' => array('header_style','=','envit_header_3'),
			),
			array(
				'id'       =>'header_four_background',
				'type'     => 'background',
				'compiler' => true,
				'output'   => array('#header.header4 .header_top'),
				'title'    => esc_html__('Header Background', 'envit'),
				'default'  => '',
				'required' => array('header_style','=','envit_header_4'),
			),
         array(
				'id'       => 'sticky_menu',
				'type'     => 'switch',
				'title'    => esc_html__('Sticky Header', 'envit'),
				'subtitle' => __('Enable / Disable Sticky Header', 'envit'),
				'default'  => true,
			  ),
		array(
				'id'       => 'seprater',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Logo for Transparent Background', 'envit'),
			),
		array(
				'id'       => 'logo_padding',
				'type'           => 'spacing',
				'output'         => array('.logo.pull-left'),
				'mode'           => 'padding',
				'units'          => array('em','px','%'),
				'units_extended' => 'false',
				'title'   => esc_html__( 'Logo Padding', 'envit' ),
				'subtitle' => esc_html__('Enter your top padding value for the logo.', 'envit'),
				'default'        => array(
				
					'padding-top'     => '',
					'padding-right'   => '',
					'padding-bottom'  => '',
					'padding-left'    => '',
					'units'          => 'px',
				)
			),
		array(
				'id'       => 'social_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Enable Social Media', 'envit'),
				'subtitle' => __('Enable / Disable Social Media', 'envit'),
				'default'  => true,
				'required' => array(
									array('header_style','=','envit_header_4'),
									),
			  ),	
        ),
    ) );
	/* Menu Styling /--------------------------------------------------------- */
    Redux::setSection( $opt_name, array(
        'title'     => __('Menu', 'envit'),
		'desc'   	=> '',
        'icon'      => 'el el-th-list',
		'class'     => 'main_background',
		'submenu'   => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

		
			array( 
				'id'       => 'border_nav_color',
				'type'     => 'border',
				'title'    => __('Menu Border', 'envit'),
				'left'     => true,
				'right'     => true,
				'bottom'     => true,				
				'output'   => array('#header .navi'),
				'default'  => array(
					'border-color'  => '', 
					'border-style'  => '', 
					'border-top'    => '', 
				),
			),
			array( 
				'id'       => 'sep_color',
				'type'     => 'border',
				'title'    => __('Menu Seprator Color', 'envit'),
				'left'     => false,
				'right'    => true,
				'bottom'   => false,
				'top'      => false,
				'output'   => array('.nav-t-holder .nav-t-footer ul.nav > li > a:after'),
				'default'  => array(
					'border-color'  => '', 
					'border-style'  => '', 
					'border-right'    => '', 
				),
			),
			array(
				'id' => 'menu_padding_first_level',
				'title' => 'Menu Padding - First Level',
				'type' => 'spacing',
				'mode' => 'padding',
				'units' => array('px','%','em'),
				'output' => array('.nav-t-holder .nav-t-footer ul.nav > li'),
				'default' => array(
					'padding-top' => '', 
					'padding-right' => '', 
					'padding-bottom' => '', 
					'padding-left' => ''
				),
			),
			array(
				'id' => 'menu_margin_first_level',
				'title' => 'Menu Margin - First Level',
				'output' => array('.nav-t-holder .nav-t-footer ul.nav > li'),
				'type' => 'spacing',
				'mode' => 'margin',
				'units' => array('px', '%', 'em'),
			),
			array(
				'id'          => 'menu_fontsize_first_level',
				'type'        => 'typography', 
				'title'       => __('Menu- First Level', 'envit'),
				'google'      => true,
				'line-height' => false,
				'text-align' => false,
				'font-backup' => true,
				'output'      => array('.nav-t-holder .nav-t-footer ul.nav > li > a'),
				'units'       =>array('px','%','em'),
				'default'     => array(
					'color'       => '', 
					'font-style'  => '', 
					'font-family' => '', 
					'google'      => true,
					'font-size'   => '', 
					'line-height' => ''
				),
			),
			array(
				'id' => 'menu_bg',
				'type' => 'color_rgba',
				'title' => esc_html__('Menu Background Color', 'envit'),
				'default' => array(
					'color'     => '',
					'alpha'     => 1
				),
				'output' => array( 'background' => '#header .nav_bg'),
			),
		   array(
				'id' => 'menu_color_first_level_hover',
				'type' => 'color',
				'title' => esc_html__('Menu Hover color  - First level', 'envit'),
				'output' => array('.nav-t-holder .nav-t-footer ul.nav > li:hover a'),
				'default' => ''
			),
		    array(
				'id' => 'menu_active_color_first_level',
				'type' => 'color',
				'title' => esc_html__('Menu Active Color - First level', 'envit'),
				'output' => array('.nav-t-holder .nav-t-footer ul.nav > li.current-menu-item a'),
				'default' => ''
			),
			array(
				'id'       => 'seprater',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Sub Menu', 'envit'),    
			),
			array(
				'id' => 'sub_menu_bg',
				'type' => 'color_rgba',
				'title' => esc_html__('Sub Menu Background Color', 'envit'),
				'default' => array(
					'color'     => '',
					'alpha'     => 1
				),
				'output' => array( 'background' => '.nav-t-holder .nav-t-footer ul.nav > li ul.submenu li'),
			),
			array(
				'id'          => 'menu_fontsize_sub_level',
				'type'        => 'typography', 
				'title'       => __('Menu- Sub Level', 'envit'),
				'google'      => true, 
				'font-backup' => true,
				'line-height' => false,
				'output'      => array('.nav-t-holder .nav-t-footer ul.nav > li ul.submenu li a'),
				'units'       =>array('px','%','em'),
				'default'     => array(
					'color'       => '', 
					'font-style'  => '', 
					'font-family' => '', 
					'google'      => true,
					'font-size'   => ''
				),
			),
			array(
				'id' => 'menu_color_sub_hover',
				'type' => 'color',
				'title' => esc_html__('Menu Color Hover - Sub level', 'envit'),
				'output' => array('.nav-t-holder .nav-t-footer ul.nav > li ul.submenu li:hover > a'),
				'default' => ''
			),
			array(
				'id' => 'sub_active_color_level',
				'type' => 'color',
				'title' => esc_html__('Menu Active Color - Sub level', 'envit'),
				'output' => array('.nav-t-holder .nav-t-footer ul.nav > li ul.submenu li.current-menu-item > a'),
				'default' => ''
			),
			array(
				'id'       => 'seprater_sticky',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Sticky Menu', 'envit'),    
			   ),
			array(
				'id' => 'sticky_menu_bg',
				'type' => 'color_rgba',
				'title' => esc_html__('Sticky Menu Background Color', 'envit'),
				'output' => array( 'background' => '.fixed1, #header .fixed1 .nav_bg'),
				'default' => array(
					'color'     => '',
					'alpha'     => 1
				),
			),
			array(
				'id'          => 'sticky_menu_color_first_level',
				'type'        => 'typography', 
				'title'       => __('Sticky Menu - first level', 'envit'),
				'google'      => true, 
				'font-backup' => true,
				'line-height' => false,
				'text-align' => false,
				'output'      => array('.fixed1 .nav-t-holder .nav-t-footer ul.nav > li > a'),
				'units'       =>array('px','%','em'),
				'default'     => array(
					'color'       => '', 
					'font-style'  => '', 
					'font-family' => '', 
					'google'      => true,
					'font-size'   => '',
				),
			),
			array(
				'id' => 'sticky_menu_color_first_level_hover',
				'type' => 'color',
				'title' => esc_html__('Sticky Menu color hover - first level', 'envit'),
				'output' => '.fixed1 .nav-t-holder .nav-t-footer ul.nav > li:hover a',
				'default' => ''
			),
			array(
				'id' => 'sticky_active_color_level',
				'type' => 'color',
				'title' => esc_html__('Sticky Menu Color Active - first level', 'envit'),
				'output' => array('.fixed1 .nav-t-holder .nav-t-footer ul.nav > li.current-menu-item a'),
				'default' => ''
			),
			
			array(
				'id'       => 'mobile-menu-seprater',
				'url'      => false,
				'type'     => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Mobile Menu', 'plumbing'),    
			   ),
			   array(
				'id' => 'mobile_inner_background',
				'type' => 'color_rgba',
				'title' => esc_html__('Menu background color.', 'plumbing'),
				'default' => array(''),
				'output' => array( 'background' => '.mobile-menu .nav-t-holder > .nav-t-footer'),
			   ),
			   array(
				'id' => 'mobile_text_color',
				'type' => 'color',
				'title' => esc_html__('Menu text color.', 'plumbing'),
				'output' => array('.mobile-menu .nav-t-holder .nav-t-footer ul.nav > li > a'),
				'default' => ''
			   ),
			   array(
				'id' => 'mobile_text_hover_color',
				'type' => 'color',
				'title' => esc_html__('Menu text hover color.', 'plumbing'),
				'output' => array('.mobile-menu .nav-t-holder > .nav-t-footer ul.nav > li:hover > a'),
				'default' => ''
			   ),

			   array( 
				'id'       => 'mobile_border_color',
				'type'     => 'border',
				'top'    => false, 
				'right'  => false, 
				'left'   => false,
				'title'    => __('Menu Border.', 'plumbing'),
				'output'   => array('.mobile-menu .nav-t-footer ul.nav > li > a'),
				'default'  => array(
				 'border-color'  => '', 
				 'border-style'  => 'solid', 
				 'border-top'    => '', 
				 'border-right'  => '', 
				 'border-bottom' => '', 
				 'border-left'   => ''
				)
			   ),
			   array(
				'id'       => 'mobile-sub-menu-seprater',
				'url'      => false,
				'type'     => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Mobile Sub Menu.', 'plumbing'),    
			   ),
			   array(
				'id' => 'mobile_sub_menu_background',
				'type' => 'color_rgba',
				'title' => esc_html__('Sub Menu Background Color.', 'plumbing'),
				'default' => array(''),
				'output' => array( 'background' => '.mobile-menu .nav-t-holder .nav-t-footer ul.nav > li ul.submenu li'),
			   ),
			   array(
				'id' => 'mobile_sub_menu_text_color',
				'type' => 'color',
				'title' => esc_html__('Sub Menu text color.', 'plumbing'),
				'output' => array('.mobile-menu .nav-t-holder .nav-t-footer ul.nav > li ul.submenu li a'),
				'default' => ''
			   ),
			   array(
				'id' => 'mobile_sub_menu_text_hover_color',
				'type' => 'color',
				'title' => esc_html__('Sub Menu text hover color.', 'plumbing'),
				'output' => array('.mobile-menu .nav-t-holder .nav-t-footer ul.nav > li ul.submenu li:hover > a'),
				'default' => ''
			   ),			
        ),
    ) );

	/* Titlebar  */
	
		Redux::setSection( $opt_name, array(
			'title'     => esc_html__('Titlebar / Inner Header', 'envit'),
			'desc'   => '',
			'class'     => 'main_background',
			'icon'   => 'el el-text-width',
			'submenu' => true,
			'fields'    => array(

			array(
				'id'       => 'titlebar_full_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Enable Titlebar', 'envit'),
				'subtitle' => esc_html__('Enable / Disable Titlebar', 'envit'),
				'default'  => true,
			),
			array(
				'id'       => 'seprater_bg',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Background', 'envit'),	
				'required' => array('titlebar_full_switch','=',true )
			),				
			array(
				'id'       => 'bg_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Background', 'envit'),
				'subtitle' => esc_html__('Enable / Disable Background', 'envit'),
				'default'  => true,
				'required' => array('titlebar_full_switch','=',true )
				),
			array(
				'id'       => 'title_background',
				'type'    => 'background',				
				'title'   => esc_html__( 'Title Background', 'envit' ),
				'output'  => '',
				'default'  => array(
					'background-color' => '',
					'background-image' => get_template_directory_uri() .'/assets/images/tmp/bg.jpg',
				),
				'required' => array('bg_switch','=',true )
			),
			array(
				'id'       => 'seprater_eight',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Titlebar Text', 'envit'),		
				'required' => array('titlebar_full_switch','=',true )
			),
			array(
				'id'       => 'title_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Title Text', 'envit'),
				'subtitle' => esc_html__('Enable / Disable Title Text', 'envit'),
				'default'  => true,
				'required' => array('titlebar_full_switch','=',true )
				),
			array(
				'id'          => 'typography_title',
				'type'        => 'typography', 
				'title'       => __('Title Text', 'envit'),
				'google'      => true, 
				'font-backup' => false,
				'line-height' => false,
				'output'      => array('.banner-title'),
				'units'       =>'px',
				'default'     => array(
					'color'       => '', 
					'google'      => true
				),
				'required' => array('title_switch','=',true )
			),			
			array(
				'id'       => 'seprater_breadcrumb',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Breadcrumbs', 'envit'),
				'required' => array('titlebar_full_switch','=',true )
			),		
			array(
				'id'       => 'breadcrumb_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Breadcrumbs', 'envit'),
				'subtitle' => esc_html__('Enable / Disable Breadcrumbs', 'envit'),
				'default'  => true,
				'required' => array('titlebar_full_switch','=',true )
				),
			array(
				'id'             =>'breadcrumb_text',
				'type'           => 'typography',
				'title'          => esc_html__('Breadcrumb Text', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>true,
				'subsets'        =>true,
				'font-size'      =>true,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>false,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('.breadcrumb,.breadcrumb .breadblock, .breadcrumb .breadblock span a,  .breadcrumb ul li a'),
				'units'          =>'px',
				'default'        => array(
					'color'       =>'',
					'font-family' =>''
				),
				'required' => array('breadcrumb_switch','=',true )
			),
			array(
				'id'       => 'breadcrumb_margin_top',
				'type'           => 'spacing',
				'output'         => array('.breadcrumb'),
				'mode'           => 'padding',
				'units'          => array('em','px','%'),
				'units_extended' => 'false',
				'title'   => esc_html__( 'Breadcrumb Padding', 'envit' ),
				'default'        => array(
				
					'padding-top'     => '',
					'padding-right'   => '',
					'padding-bottom'  => '',
					'padding-left'    => '',
					'units'          => 'px',
				),
				'required' => array('breadcrumb_switch','=',true )
			),
			
		)
	) );
	
 /* Typography  /--------------------------------------------------------- */
	
	Redux::setSection( $opt_name, array(
        'title'     => __('Typography', 'envit'),
		'header'     => '',
		'desc'       => '',
		'class'     => 'main_background',
		'icon_class' => 'el-icon-large',
		'icon'       => 'el-icon-font',
		'submenu'    => true,
        'fields'    => array(
		 array(
				'id'             =>'typography_body',
				'type'           => 'typography',
				'title'          => esc_html__('Body', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'font-weight'    =>false,
				'all_styles'     =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>true,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>false,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('body'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for your main body text.', 'envit'),
				'default'        => array(
					'font-family'=> '',
					'font-weight'=> '', 
					'height'=>'',
					'overflow-x'=> '',
					'letter-spacing'=> ''								
				)
			),
			 array(
				'id'             =>'typography_p',
				'type'           => 'typography',
				'title'          => esc_html__('Paragraph', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'font-weight'    =>false,
				'all_styles'     =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>true,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>false,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('p, p.text-brand, .locationContent p, .footerBlock .simple-article p, .copy p, .caption-style-2 .content p, .single-campaign .campaign-description, blockquote p, .blogdetails .simple-article p, .caption-style-2 .caption-text p, .simple-text, .tt-accordeon .vc_tta-panel-body .simple-text'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for your Paragraph text.', 'envit'),
				'default'        => array(
					'font-family'=> '',
					'font-weight'=> '', 
					'height'=>'',
					'overflow-x'=> '',
					'letter-spacing'=> ''								
				)
			),
			array(
				'id'             =>'typography_h1',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H1', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h1, .h1'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h1', 'envit'),
				'default'        => array(
					'color'       =>'',
					'font-family' =>'',
				)
			),
			array(
				'id'             =>'typography_h2',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H2', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h2, .h2'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h2', 'envit'),
				'default'        => array(
					'color'       =>'',
					'font-family' =>'',
				)
			),
			array(
				'id'             =>'typography_h3',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H3', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h3, .h3, .welcome_section h3, h3.tt-title, .resources h3.tt-title, .urgent .saveforest h3.tt-title, .service-sub-content h3, .main-heading h3.tt-title, .newsletter3 h3.tt-title'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h3 ...', 'envit'),
				'default'        => array(
					'color'       =>'',
					'font-family' =>'',
				)
			),
			array(
				'id'             =>'typography_h4',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H4', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h4, .h4, h4.tt-subtitle, h4 .titleLink, .carousel-inner h4.name, .footerTitle p, .recycling h4.tt-featured-title, .recycling .box2 h4.tt-featured-title, .test-about h4.name, h4.tt-service-title, h4.tt-faq-title, .wpb-js-composer .vc_tta-color-grey.vc_tta-style-outline.tt-accordeon .vc_tta-panel .vc_tta-panel-title>a, .wpb-js-composer .vc_tta-color-grey.vc_tta-style-outline.tt-accordeon .vc_tta-panel.vc_active .vc_tta-panel-title>a, .donatepage h4.tt-featured-title, .event_details .details h4.tt-subtitle, .buy_ticket h4'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h4 ...', 'envit'),
				'default'        => array(
					'color'       =>'',
					'font-family' =>'',
				)
			),
			array(
				'id'             =>'typography_h5',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H5', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h5, .h5, .tt-image-row h5, .caption-style-2 .content h5, .blogWrapper h5 a, .recentTitle h5.as, .blogWrapper .date h5'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h5', 'envit'),
				'default'        => array(
					'color'       =>'',
					'font-family' =>'',
				)
			),
			array(
				'id'             =>'typography_h6',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H6', 'envit'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h6, .h6, .contact-info .locationContent p'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h6', 'envit'),
				'default'        => array(
					'color'       =>'',
					'font-family' =>'',
				)
			),
		),
		
    ) );

	
	/* Social Media /--------------------------------------------------------- */
    Redux::setSection( $opt_name, array(
		'title'  => esc_html__( 'Social Media', 'envit' ),
		'desc'   => 'Enter social url here and then active them in footer or header options. Please add full URLs include http://',
		'icon'   => 'el el-twitter',
		'class'     => 'main_background',
		'submenu' => true,
        'fields'    => array(

				array(
					'id'       => 'enable_social',
					'type'     => 'switch',
					'title'    => esc_html__('Enable / Disable social Media', 'envit'),
					'default'  => true,
				),
				array(
					'id'       =>'facebook-value',
					'type'     => 'text',
					'title'    => esc_html__('Facebook', 'envit'),
					'subtitle' => '',
					'default' => 'www.facebook.com',
					'desc'     => esc_html__('Enter your Facebook URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),
				array(
					'id'       =>'twitter-value',
					'type'     => 'text',
					'title'    => esc_html__('Twitter', 'envit'),
					'subtitle' => '',
					'default' => 'www.twitter.com',
					'desc'     => esc_html__('Enter your Twitter URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),
				array(
					'id'       =>'google-value',
					'type'     => 'text',
					'title'    => esc_html__('GooglePlus', 'envit'),
					'subtitle' => '',
					'default' => 'www.googleplus.com',
					'desc'     => esc_html__('Enter your GooglePlus URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),
				array(
					'id'       =>'linkedin-value',
					'type'     => 'text',
					'title'    => esc_html__('Linkedin', 'envit'),
					'subtitle' => '',
					'default' => 'www.linkedin.com',
					'desc'     => esc_html__('Enter your Linkedin URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),
				array(
					'id'       =>'pinterest-value',
					'type'     => 'text',
					'title'    => esc_html__('Pinterest', 'envit'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Pinterest URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),			
				array(
					'id'       =>'instagram-value',
					'type'     => 'text',
					'title'    => esc_html__('Instagram', 'envit'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Instagram URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),				
				array(
					'id'       =>'yelp-value',
					'type'     => 'text',
					'title'    => esc_html__('Yelp', 'envit'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Yelp URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),
				
				array(
					'id'       =>'foursquare-value',
					'type'     => 'text',
					'title'    => esc_html__('Foursquare', 'envit'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Foursquare URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),
				array(
					'id'       =>'flickr-value',
					'type'     => 'text',
					'title'    => esc_html__('Flickr', 'envit'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Flickr URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),

				array(
					'id'       =>'youtube-value',
					'type'     => 'text',
					'title'    => esc_html__('Youtube', 'envit'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Youtube URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),

				array(
					'id'       =>'email-value',
					'type'     => 'text',
					'title'    => esc_html__('Email', 'envit'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Email URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),
				array(
					'id'       =>'rss-value',
					'type'     => 'text',
					'title'    => esc_html__('Rss', 'envit'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Rss URL.', 'envit'),
					'required' => array('enable_social','=',true )
					           
				),			
        ),
    ) );

		
	/* Blog Pages Layout /--------------------------------------------------------- */
	
		Redux::setSection( $opt_name, array(
			'title'     => esc_html__('Blog', 'envit'),
			'desc'   => '',
			'class'     => 'main_background',
			'icon'   => 'el el-globe',
			'submenu' => true,
			'fields'    => array(
			
			 array(
				'id'       => 'blog_title',
				'title'   => esc_html__( 'Blog Title', 'envit' ),
				'subtitle' => esc_html__('Title for the blog page.', 'envit'),
				'type'    => 'text',
				'default'  => 'Blog',
			),	
			array(
				'id'       => 'blog_img_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Inner Header Enable / Disable', 'envit'),
				'subtitle' => '',
				'default'  => true,
			),
			array(
				'id'       =>'blog_image',
				'url'      => false,
				'type'     => 'background',
				'title'    => esc_html__('Inner Header', 'envit'),
				'default'  => array(
					'background-color' => '',
					'background-image' => get_template_directory_uri() .'/assets/images/allmix/bg.jpg',
				),
				'required' => array('blog_img_switch','=',true )
				
			),
     		array(
				'id'       => 'blog_metadata',
				'type'     => 'switch',
				'title'    => esc_html__('Metadata on Blog Posts', 'envit'),
				'subtitle'       => esc_html__('Enable / Disable Metadata on Blog Posts.', 'envit'),
				'default'  => true,
			),
			array(
				'id'       => 'blog_multi_checkbox',
				'type'     => 'checkbox',
				'title'    => __('Metadata Options', 'envit'), 
				'subtitle' => __('Check the Metadata you want to show on Blog Posts.', 'envit'),
				'options'  => array(
					'1' => 'Date',
					'2' => 'Author',
					'3' => 'Comments',
					'4' => 'Tags'
				),
				'default' => array(
					'1' => '1', 
					'2' => '1', 
					'3' => '1',
					'4' => '1'
				),
				'required' => array('blog_metadata','=',true )
			),
			array(
				'id'       => 'blog_sidebar_type',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Sidebar Type', 'envit' ),
				'options' => array(
					'wp' => esc_html__( 'Wordpress Sidebars', 'envit' ),
					'vc' => esc_html__( 'VC Sidebars', 'envit' )
				),
				'default' => 'wp'
			),
			
			array(
				'id'       => 'blog_wp_sidebar',
				'type'      => 'select',
				'data' => 'sidebars',
				'title'     => esc_html__( 'Wordpress Sidebar', 'envit' ),
				'default'   => 'envit-right-sidebar',
			'required' => array('blog_sidebar_type','=','wp', ),
			),
			 array(
			'id'       => 'blog_vc_sidebar',
			'type'     => 'select',
			'multi'    => false,
			'data'     => 'posts',
			'args'     => array( 'post_type' =>  array( 'sidebar', 'nyheter_forbundet', 'stup' ), 'numberposts' => -1 ),
			'title'    => esc_html__( 'VC Sidebar', 'envit' ),
			'required' => array('blog_sidebar_type','=','vc', ),
			),
			array(
				'id'       => 'blog_sidebar_position',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Blog Layout', 'envit' ),
				'subtitle' => __('Select the Sidebar Position for Blog Pages.', 'envit'),
				'options' => array(
					'left'  => array(
									'alt'   => '1', 
									'img'   => plugin_dir_url( __FILE__ ) .'/images/bloglayout/layout-1.jpg'
								),
					'right' => array(
									'alt'   => '2', 
									'img'   => plugin_dir_url( __FILE__ ) .'/images/bloglayout/layout-2.jpg'
								)
				),
				'default' => 'right'
			),
			array(
				'id'       => 'blog_pagination',
				'type'     => 'switch',
				'title'    => esc_html__('Previous / Next Pagination', 'envit'),
				'subtitle'       => esc_html__('Enable / Disable pagination for Blog Pages.', 'envit'),
				'default'  => true,
			),
			array(
				'id'       => 'seprater_blog_one',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Blog Post Detail Page', 'envit'),
				
			),
			array(
				'id'       => 'detail_sidebar_position',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Blog Detail Layout', 'envit' ),
				'subtitle' => __('Select the Sidebar Position for Blog Detail Pages.', 'envit'),
				'options' => array(
					'left'  => array(
									'alt'   => '1', 
									'img'   => plugin_dir_url( __FILE__ ) .'/images/bloglayout/layout-1.jpg'
								),
					'right' => array(
									'alt'   => '2', 
									'img'   => plugin_dir_url( __FILE__ ) .'/images/bloglayout/layout-2.jpg'
								)
				),
				'default' => 'right'
			),
			array(
				'id'       => 'blogdetail_metadata',
				'type'     => 'switch',
				'title'    => esc_html__('Metadata on Blog Detail Posts', 'envit'),
				'subtitle'       => esc_html__('Enable / Disable Metadata on Blog Detail Pages.', 'envit'),
				'default'  => true,
			),
			array(
				'id'       => 'blogdetail_multi_checkbox',
				'type'     => 'checkbox',
				'title'    => __('Metadata Options Of Blog Detail Page', 'envit'), 
				'subtitle' => __('Check the Metadata you want to show on Blog Detail Pages.', 'envit'),
				'options'  => array(
					'date' => 'Date',
					'author' => 'Author',
					'comment' => 'Comments',
					'tag' => 'Tags'
				),
				'default' => array(
						'date'    => '1', 
						'author'  => '1', 
						'comment' => '1',
						'tag'     => '1'
				),
				'required' => array('blogdetail_metadata','=',true )	
			),
			
		)
	) );
	
	/* Footer /--------------------------------------------------------- */
		
		 Redux::setSection( $opt_name, array(
        'title'     => __('Footer', 'envit'),
		'header'     => '',
		'desc'       => '',
		'icon'       => 'el-icon-photo',
		'class'     => 'main_background',
		'submenu'    => true,
        'fields'    =>  array(

			array(
				'id'       => 'footer_widget',
				'type'     => 'switch',
				'title'    => esc_html__('Footer Widget Area', 'envit'),
				'subtitle' => __('Enable / Disable Widgetzed Footer Area', 'envit'),
				'default'  => true,
			),
			array(
				'id'       => 'footer_sidebar_count',
				'type'     => 'image_select',
				'title'    => __('Footer Widget Columns', 'envit'), 
				'subtitle' => __('Select Footer Columns', 'envit'),
				'description' => __('', 'envit'),
				'required' => array('footer_widget','=',true, ),
				'options'  => array(
					'1'      => array(
						'alt'   => '1', 
						'img'   => plugin_dir_url( __FILE__ ) .'/images/footers/col-1.jpg'
					),
					
					'2'      => array(
						'alt'   => '2', 
						'img'   => plugin_dir_url( __FILE__ ) .'/images/footers/col-2.jpg'
					),
					'3'      => array(
						'alt'   => '3', 
						'img'   => plugin_dir_url( __FILE__ ) .'/images/footers/col-3.jpg'
					),
					'4'      => array(
						'alt'   => '4', 
						'img'   => plugin_dir_url( __FILE__ ) .'/images/footers/col-4.jpg'
					)
				),
				'default' => '4'
			),
			array(
				'id'       => 'footer_bg',
				'type'     => 'background',
				'compiler' => true,
				'output'   => '',
				'title'    => esc_html__('Footer Background', 'envit'),
				'default'  => array(
					'background-color' => '',
					'background-image' => get_template_directory_uri() .'/assets/images/allmix/footer.jpg',
				),
				'required' => array('footer_widget','=',true)
			),
			
			array(
				'id'       => 'seprater_three',
				'url'      => false,
				'type'    => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Copyright', 'envit'),
				
			),		
			array(
				'id'       => 'copyright_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Copyright Area', 'envit'),
				'subtitle' => __('Enable / Disable Copyright Area', 'envit'),
				'default'  => true,
			),
			array(
				'id'       => 'footer_copyright',
				'type'     => 'textarea',
				'title'    => esc_html__('Copyright Text', 'envit'),
				'subtitle' => __('Enter your Copyright Text.', 'envit'),
				'default'  => esc_html__( 'Copyright © envit '.date("Y").'. All rights reserved.', 'envit'),
				'required' => array('copyright_switch','=',true, )
			),
			array(
				'id'       => 'copyright_right_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Copyright Right Area', 'envit'),
				'subtitle' => __('Enable / Disable Copyright Right Area', 'envit'),
				'default'  => true,
				'required' => array('copyright_switch','=',true, )
			),
			array(
				'id'       => 'copy_right_first',
				'type'      => 'text',
				'title'     => esc_html__( 'Copyright Author Info', 'envit' ),
				'default'   => esc_html__('Created by:', 'envit'),
				'required' => array('copyright_right_switch','=',true, ),
			),
			array(
				'id'       => 'copy_right',
				'type'      => 'text',
				'title'     => esc_html__( 'Copyright Right Content', 'envit' ),
				'default'   => esc_html__('ThemeChampion', 'envit'),
				'required' => array('copyright_right_switch','=',true, )
			),
			array(
				'id'       => 'copy_right_link',
				'type'      => 'text',
				'title'     => esc_html__( 'Copyright Right Content Link', 'envit' ),
				'default'   => esc_html__('https://themeforest.net/user/ThemeChampion', 'envit'),
				'required' => array('copyright_right_switch','=',true, )
			),
		)
) );

/* ------------------------------------------------------------------------ */
/* Custom function for envittheme's own CSS
/* ------------------------------------------------------------------------ */

		function envit_option_styles() {
			$plugin_url =  plugins_url('', __FILE__);
			wp_enqueue_style( 'admin-styles', $plugin_url . '/style.css', null, null, 'all' );
		}
		add_action( 'admin_enqueue_scripts', 'envit_option_styles' );