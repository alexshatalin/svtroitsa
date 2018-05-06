<?php
if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( array(
		'page','post','services','team'
	) );
}

add_action( 'vc_before_init', 'envit_vc_set_as_theme' );

if( ! function_exists( 'envit_vc_set_as_theme' ) ) {
	function envit_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}

if( ! function_exists( 'envit_animator_param' ) ){
	function envit_animator_param( $settings, $value ) {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';
		$animations = json_decode( $wp_filesystem->get_contents( get_template_directory() . '/assets/js/animate-config.json' ), true );
		if ( $animations ) {
			$output = '<select name="' . esc_attr( $param_name ) . '" class="wpb_vc_param_value ' . esc_attr( $param_name . ' ' . $type . ' ' . $class ) . '">';
			foreach ( $animations as $key => $val ) {
				if ( is_array( $val ) ) {
					$labels = str_replace( '_', ' ', $key );
					$output .= '<optgroup label="' . ucwords( esc_attr( $labels ) ) . '">';
					foreach ( $val as $label => $style ) {
						$label = str_replace( '_', ' ', $label );
						if ( $label == $value ) {
							$output .= '<option selected value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						} else {
							$output .= '<option value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						}
					}
				} else {
					if ( $key == $value ) {
						$output .= "<option selected value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					} else {
						$output .= "<option value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					}
				}
			}

			$output .= '</select>';
		}

		return $output;
	}
}

add_filter( 'vc_google_fonts_get_fonts_filter', 'envit_vc_google_fonts', 10, 1 );

add_action( 'admin_init', 'envit_update_existing_shortcodes' );

if ( ! function_exists( 'envit_update_existing_shortcodes' ) ) {
	function envit_update_existing_shortcodes() {

		if ( function_exists( 'vc_add_params' ) ) {

			vc_add_params( 'vc_gallery', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Gallery type', 'envit' ),
					'param_name' => 'type',
					'value'      => array(
						__( 'Image grid', 'envit' )     => 'image_grid',
						__( 'Slick slider', 'envit' )   => 'slick_slider',
						__( 'Slick slider 2', 'envit' ) => 'slick_slider_2'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Thumbnail size', 'envit' ),
					'param_name' => 'thumbnail_size',
					'dependency' => array(
						'element' => 'type',
						'value'   => array( 'slick_slider_2' )
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			) );

			vc_add_params( 'vc_column_inner', array(
				array(
					'type'        => 'column_offset',
					'heading'     => esc_html__( 'Responsiveness', 'envit' ),
					'param_name'  => 'offset',
					'group'       => esc_html__( 'Width & Responsiveness', 'envit' ),
					'description' => esc_html__( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'envit' )
				)
			) );

			vc_add_params( 'vc_separator', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Type', 'envit' ),
					'param_name' => 'type',
					'value'      => array(
						esc_html__( 'Type 1', 'envit' ) => 'type_1',
						esc_html__( 'Type 2', 'envit' ) => 'type_2'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				),
			) );

			vc_add_params( 'vc_video', array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Video Width', 'envit' ),
					'param_name' => 'size'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Preview Image', 'envit' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'envit' ),
					'param_name'  => 'img_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'envit' )
				),
			) );

			vc_add_params( 'vc_wp_pages', array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			) );

			vc_add_params( 'vc_custom_heading', array(
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'envit' ),
					'param_name' => 'icon',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Icon Size (px)', 'envit' ),
					'param_name' => 'icon_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position', 'envit' ),
					'param_name' => 'icon_pos',
					'value'      => array(
						esc_html__( 'Left', 'envit' ) => '',
						esc_html__( 'Right', 'envit' ) => 'right',
						esc_html__( 'Top', 'envit' ) => 'top',
						esc_html__( 'Bottom', 'envit' ) => 'bottom'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Subtitle', 'envit' ),
					'param_name' => 'subtitle',
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Subtitle - Color', 'envit' ),
					'param_name' => 'subtitle_color',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Stripe - Position', 'envit' ),
					'param_name' => 'stripe_pos',
					'value'      => array(
						esc_html__( 'Bottom', 'envit' ) => 'bottom',
						esc_html__( 'Between Title and Subtitle', 'envit' ) => 'between',
						esc_html__( 'Hide', 'envit' ) => 'hide'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Font weight', 'envit' ),
					'param_name' => 'envit_title_font_weight',
					'value'      => array(
						esc_html__( 'Select', 'envit' )    => '',
						esc_html__( 'Thin', 'envit' )      => 100,
						esc_html__( 'Light', 'envit' )     => 300,
						esc_html__( 'Regular', 'envit' )   => 400,
						esc_html__( 'Medium', 'envit' )    => 500,
						esc_html__( 'Semi-bold', 'envit' ) => 600,
						esc_html__( 'Bold', 'envit' )      => 700,
						esc_html__( 'Black', 'envit' )     => 900
					),
					'weight'     => 1
				)
			) );

			vc_add_params( 'vc_basic_grid', array(
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Gap', 'envit' ),
					'param_name'       => 'gap',
					'value'            => array(
						esc_html__( '0px', 'envit' )  => '0',
						esc_html__( '1px', 'envit' )  => '1',
						esc_html__( '2px', 'envit' )  => '2',
						esc_html__( '3px', 'envit' )  => '3',
						esc_html__( '4px', 'envit' )  => '4',
						esc_html__( '5px', 'envit' )  => '5',
						esc_html__( '10px', 'envit' ) => '10',
						esc_html__( '15px', 'envit' ) => '15',
						esc_html__( '20px', 'envit' ) => '20',
						esc_html__( '25px', 'envit' ) => '25',
						esc_html__( '30px', 'envit' ) => '30',
						esc_html__( '35px', 'envit' ) => '35',
						esc_html__( '40px', 'envit' ) => '40',
						esc_html__( '45px', 'envit' ) => '45',
						esc_html__( '50px', 'envit' ) => '50',
						esc_html__( '55px', 'envit' ) => '55',
						esc_html__( '60px', 'envit' ) => '60',
					),
					'std'              => '30',
					'description'      => esc_html__( 'Select gap between grid elements.', 'envit' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				)
			) );

			vc_add_params( 'vc_btn', array(
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'envit' ),
					'param_name'         => 'color',
					'description'        => esc_html__( 'Select button color.', 'envit' ),
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value'              => array(
						                        esc_html__( 'Theme Style 1', 'envit' )     => 'theme_style_1',
						                        esc_html__( 'Theme Style 2', 'envit' )     => 'theme_style_2',
						                        esc_html__( 'Theme Style 3', 'envit' )     => 'theme_style_3',
						                        esc_html__( 'Theme Style 4', 'envit' )     => 'theme_style_4',
						                        esc_html__( 'Classic Grey', 'envit' )      => 'default',
						                        esc_html__( 'Classic Blue', 'envit' )      => 'primary',
						                        esc_html__( 'Classic Turquoise', 'envit' ) => 'info',
						                        esc_html__( 'Classic Green', 'envit' )     => 'success',
						                        esc_html__( 'Classic Orange', 'envit' )    => 'warning',
						                        esc_html__( 'Classic Red', 'envit' )       => 'danger',
						                        esc_html__( 'Classic Black', 'envit' )     => 'inverse',
					                        ) + getVcShared( 'colors-dashed' ),
					'std'                => 'grey',
					'dependency'         => array(
						'element'            => 'style',
						'value_not_equal_to' => array( 'custom', 'outline-custom' ),
					),
				)
			) );

		}

	}
}

if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'envit_vc_elements' );
}

if ( ! function_exists( 'envit_vc_elements' ) ) {
	function envit_vc_elements() {

		$project_categories_array = get_terms( 'project_category' );
		$project_categories       = array(
			esc_html__( 'All', 'envit' ) => 'all'
		);
		if ( $project_categories_array && ! is_wp_error( $project_categories_array ) ) {
			foreach ( $project_categories_array as $cat ) {
				$project_categories[ $cat->name ] = $cat->slug;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'Contacts', 'envit' ),
			'base'     => 'envit_contacts_widget',
			'category' => esc_html__( 'envit', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'envit' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'envit' ) => 'style_1',
						esc_html__( 'Style 2', 'envit' ) => 'style_2',
						esc_html__( 'Style 3', 'envit' ) => 'style_3'
					),
				),
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'envit' ),
					'param_name' => 'title',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Address', 'envit' ),
					'param_name' => 'address',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Phone', 'envit' ),
					'param_name' => 'phone',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_2'))
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Phone', 'envit' ),
					'param_name' => 'phones',
					'dependency' => array('element' => 'style', 'value' => array('style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'envit' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Schedule', 'envit' ),
					'param_name' => 'schedule',
					'dependency' => array('element' => 'style', 'value' => array('style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Facebook', 'envit' ),
					'param_name' => 'facebook',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Twitter', 'envit' ),
					'param_name' => 'twitter',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Linkedin', 'envit' ),
					'param_name' => 'linkedin',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Google+', 'envit' ),
					'param_name' => 'google_plus',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Skype', 'envit' ),
					'param_name' => 'skype',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'envit' ),
					'param_name'  => 'class',
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Info Box', 'envit' ),
			'base'     => 'envit_info_box',
			'category' => esc_html__( 'envit', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'envit' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Image', 'envit' ),
					'param_name' => 'image',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_4' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Image Size', 'envit' ),
					'param_name' => 'vc_image_size',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_4' )
					),
					'description' => esc_html__( 'Example: Text - full, large, medium, Number - 340x200', 'envit' ),
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Align Center', 'envit' ),
					'param_name' => 'align_center',
					'value'      => array(
						esc_html__( 'Yes', 'envit' ) => 'yes'
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'envit' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'envit' ) => 'style_1',
						esc_html__( 'Style 2', 'envit' ) => 'style_2',
						esc_html__( 'Style 3', 'envit' ) => 'style_3',
						esc_html__( 'Style 4', 'envit' ) => 'style_4',
						esc_html__( 'Style 5', 'envit' ) => 'style_5',
						esc_html__( 'Style 6', 'envit' ) => 'style_6'
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Title Icon', 'envit' ),
					'param_name' => 'title_icon',
					'value'      => '',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_3', 'style_6' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Icon - Size', 'envit' ),
					'param_name' => 'title_icon_size',
					'description' => esc_html__( 'Enter icon size in "px"', 'envit'),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_6' )
					)
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'envit' ),
					'param_name' => 'content'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'envit' ),
					'param_name' => 'link'
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Link Icon', 'envit' ),
					'param_name' => 'icon',
					'value'      => '',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_5', 'style_6' )
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Icon Box', 'envit' ),
			'base'     => 'envit_icon_box',
			'category' => esc_html__( 'envit', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'envit' ),
					'param_name' => 'box_style',
					'value'      => array(
						esc_html__( 'Style 1', 'envit' ) => 'style_1',
						esc_html__( 'Style 2', 'envit' ) => 'style_2'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Alignment', 'envit' ),
					'param_name' => 'alignment',
					'value'      => array(
						esc_html__( 'Left', 'envit' )   => 'left',
						esc_html__( 'Right', 'envit' )  => 'right',
						esc_html__( 'Center', 'envit' ) => 'center'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_2')
				),
				array(
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'envit' ),
					'param_name' => 'title'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title - Font size', 'envit' ),
					'param_name'  => 'title_font_size',
					'description' => esc_html__( 'Enter font size in px', 'envit' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title - Line Height', 'envit' ),
					'param_name'  => 'title_line_height',
					'description' => esc_html__( 'Enter line-height in px', 'envit' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'envit' ),
					'param_name' => 'title_color',
					'value'      => array(
						esc_html__( 'Base', 'envit' ) => 'base',
						esc_html__( 'Secondary', 'envit' ) => 'secondary',
						esc_html__( 'Third', 'envit' ) => 'third',
						esc_html__( 'Custom', 'envit' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'envit' ),
					'param_name' => 'title_color_custom',
					'dependency' => array('element' => 'title_color', 'value' => 'custom')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'hide_title_line',
					'value'      => array(
						esc_html__( 'Hide Title Line', 'envit' ) => 'hide_title_line'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'enable_hexagon',
					'value'      => array(
						esc_html__( 'Enable Hexagon', 'envit' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'enable_hexagon_animation',
					'value'      => array(
						esc_html__( 'Enable Hexagon Hover Animation', 'envit' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'v_align_middle',
					'value'      => array(
						esc_html__( 'Enable Middle Align', 'envit' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'envit' ),
					'param_name' => 'icon',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position', 'envit' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Icon Top', 'envit' )              => 'icon_top',
						esc_html__( 'Icon Top Transparent', 'envit' ) => 'icon_top_transparent',
						esc_html__( 'Icon Left', 'envit' )             => 'icon_left',
						esc_html__( 'Icon Left Transparent', 'envit' ) => 'icon_left_transparent'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Size', 'envit' ),
					'param_name'  => 'icon_size',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon size in px', 'envit' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'envit' ),
					'param_name' => 'icon_color',
					'value'      => array(
						esc_html__( 'Base', 'envit' ) => 'base',
						esc_html__( 'Secondary', 'envit' ) => 'secondary',
						esc_html__( 'Third', 'envit' ) => 'third',
						esc_html__( 'Custom', 'envit' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'envit' ),
					'param_name' => 'icon_color_custom',
					'dependency' => array('element' => 'icon_color', 'value' => 'custom')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Height', 'envit' ),
					'param_name'  => 'icon_height',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon height in px', 'envit' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_top', 'icon_top_transparent' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Width', 'envit' ),
					'param_name'  => 'icon_width',
					'value'       => '50',
					'description' => esc_html__( 'Enter icon width in px', 'envit' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_left', 'icon_left_transparent' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Wrapper Width', 'envit' ),
					'param_name'  => 'icon_width_wr',
					'value'       => '',
					'description' => esc_html__( 'Enter icon wrapper width in px', 'envit' ),
					'dependency'  => array(
						'element' => 'box_style',
						'value'   => array( 'style_2' )
					)
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'envit' ),
					'param_name' => 'content',
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			)
		) );

		
		vc_map( array(
			'name'        => esc_html__( 'Spacing', 'envit' ),
			'base'        => 'envit_spacing',
			'category' => esc_html__( 'envit', 'envit' ),
			'params'      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Large Screen', 'envit' ),
					'param_name' => 'lg_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Medium Screen', 'envit' ),
					'param_name' => 'md_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Small Screen', 'envit' ),
					'param_name' => 'sm_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra Small Screen', 'envit' ),
					'param_name' => 'xs_spacing'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Contact', 'envit' ),
			'base'     => 'envit_contact',
			'category' => esc_html__( 'envit', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Name', 'envit' ),
					'param_name' => 'name'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Image', 'envit' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'envit' ),
					'param_name'  => 'image_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "default" size.', 'envit' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Job', 'envit' ),
					'param_name' => 'job'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'envit' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Skype', 'envit' ),
					'param_name' => 'skype'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			)
		) );

		$envit_sidebars_array = get_posts( array( 'post_type' => 'envit_vc_sidebar', 'posts_per_page' => - 1 ) );
		$envit_sidebars       = array( esc_html__( 'Select', 'envit' ) => 0 );
		if ( $envit_sidebars_array && ! is_wp_error( $envit_sidebars_array ) ) {
			foreach ( $envit_sidebars_array as $val ) {
				$envit_sidebars[ get_the_title( $val ) ] = $val->ID;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'envit Sidebar', 'envit' ),
			'base'     => 'envit_sidebar',
			'category' => esc_html__( 'envit', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Code', 'envit' ),
					'param_name' => 'sidebar',
					'value'      => $envit_sidebars
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			)
		) );


		vc_map( array(
			'name'                    => esc_html__( 'Google Map', 'envit' ),
			'base'                    => 'envit_gmap',
			'icon'                    => 'envit_gmap',
			'as_parent'               => array( 'only' => 'envit_gmap_address' ),
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'category'                => esc_html__( 'envit', 'envit' ),
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Map Height', 'envit' ),
					'param_name'  => 'map_height',
					'value'       => '733px',
					'description' => esc_html__( 'Enter map height in px', 'envit' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Map Zoom', 'envit' ),
					'param_name' => 'map_zoom',
					'value'      => 18
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Marker Image', 'envit' ),
					'param_name' => 'marker'
				),
				array(
					'type'       => 'checkbox',
					'param_name' => 'disable_mouse_whell',
					'value'      => array(
						esc_html__( 'Disable map zoom on mouse wheel scroll', 'envit' ) => 'disable'
					)
				),
				array(
					'type'       => 'textarea_raw_html',
					'heading'    => esc_html__( 'Style Code', 'envit' ),
					'param_name' => 'gmap_style',
					'group'      => esc_html__('Map Style', 'envit')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'envit' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'envit' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Bottom Info', 'envit' ),
			'base'     => 'envit_post_bottom',
			'category' => esc_html__( 'envit Post Partials', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Comments', 'envit' ),
			'base'     => 'envit_post_comments',
			'category' => esc_html__( 'envit Post Partials', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
				)
			)
		) );
		
		vc_map( array(
			'name'     => esc_html__( 'Charts', 'envit' ),
			'base'     => 'envit_charts',
			'icon'     => 'envit_charts',
			'category' => esc_html__( 'envit', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Design', 'envit' ),
					'param_name' => 'design',
					'value'      => array(
						esc_html__( 'Line', 'envit' )   => 'line',
						esc_html__( 'Bar', 'envit' )    => 'bar',
						esc_html__( 'Circle', 'envit' ) => 'circle',
						esc_html__( 'Pie', 'envit' )    => 'pie',
					),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show legend?', 'envit' ),
					'param_name'  => 'legend',
					'description' => esc_html__( 'If checked, chart will have legend.', 'envit' ),
					'value'       => array( esc_html__( 'Yes', 'envit' ) => 'yes' ),
					'std'         => 'yes',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Legend Position', 'envit' ),
					'param_name' => 'legend_position',
					'value'      => array(
						esc_html__( 'Bottom', 'envit' ) => 'bottom',
						esc_html__( 'Right', 'envit' )  => 'right',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Width (px)', 'envit' ),
					'param_name' => 'width',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Height (px)', 'envit' ),
					'param_name' => 'height',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'X-axis values', 'envit' ),
					'param_name' => 'x_values',
					'value'      => 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'line', 'bar' )
					),
				),
				array(
					'type'       => 'param_group',
					'heading'    => esc_html__( 'Values', 'envit' ),
					'param_name' => 'values',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'line', 'bar' )
					),
					'value'      => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'One', 'envit' ),
							'y_values' => '10; 15; 20; 25; 27; 25; 23; 25',
							'color' => '#fe6c61',
						),
						array(
							'title' => esc_html__( 'Two', 'envit' ),
							'y_values' => '25; 18; 16; 17; 20; 25; 30; 35',
							'color' => '#5472d2'
						)
					) ) ),
					'params'     => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Title', 'envit' ),
							'param_name'  => 'title',
							'description' => esc_html__( 'Enter title for chart dataset.', 'envit' ),
							'admin_label' => true,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Y-axis values', 'envit' ),
							'param_name' => 'y_values'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Color', 'envit' ),
							'param_name' => 'color'
						)
					),
					'callbacks'  => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'param_group',
					'heading'    => esc_html__( 'Values', 'envit' ),
					'param_name' => 'values_circle',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'circle', 'pie' )
					),
					'value'      => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'One', 'envit' ),
							'value' => '40',
							'color' => '#fe6c61',
						),
						array(
							'title' => esc_html__( 'Two', 'envit' ),
							'value' => '30',
							'color' => '#5472d2'
						),
						array(
							'title' => esc_html__( 'Three', 'envit' ),
							'value' => '40',
							'color' => '#8d6dc4'
						)
					) ) ),
					'params'     => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Title', 'envit' ),
							'param_name'  => 'title',
							'description' => esc_html__( 'Enter title for chart dataset.', 'envit' ),
							'admin_label' => true,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Value', 'envit' ),
							'param_name' => 'value'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Color', 'envit' ),
							'param_name' => 'color'
						)
					),
					'callbacks'  => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'envit' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'About Vacancy', 'envit' ),
			'base'     => 'envit_about_vacancy',
			'category' => esc_html__( 'envit Vacancy Partials', 'envit' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'envit' ),
					'param_name' => 'css',
				)
			)
		) );
		
/*------------------------------------------------------*/
/* Services
/*------------------------------------------------------*/
	
	vc_map( array(
		'name'                      => esc_html__('envit Services', 'envit'),
		'base'                      => 'envit_services',
		'category'                  => esc_html__('envit Service Elements', 'envit'),
		'description'               => esc_html__('Display Services', 'envit'),
		'save_always' 				=> true,
		'params'                    => array(
			
			
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order', 'envit' ),
				'param_name'  => 'order',
				'description' => __( 'Ascending or descending order', 'envit' ),
				'default'	  => 'ASC',
				'value'       => array(
					esc_html__('ASC', 'envit') => 'ASC',
					esc_html__('DESC', 'envit') => 'DESC'
				)
			),
			array(
			   'type'        => 'dropdown',
			   'heading'     => esc_html__( 'Display Mode', 'envit' ),
			   'param_name'  => 'layout',
			   'description' => esc_html__( 'The layout your page children being display', 'envit' ),
			   'value'       => array(
				esc_html__('Grid Image', 'envit')     => 'grid_image',
				esc_html__('Grid Icon', 'envit') => 'grid_icon'
			   )
			),
			array(
				'type'			=> 'textfield',
				'class'			=> '',
				'heading'		=> esc_html__('Number of posts','envit'),
				'param_name'	=> 'number',
				'value'			=> '9',
				'description' 	=> 'How many post to show?',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Column', 'envit' ),
				'param_name'  => 'column',
				'description' => __( 'How many column will be display on a row?', 'envit' ),
				'value'       => array(
					esc_html__('2 Columns', 'envit') => '2',
					esc_html__('3 Columns', 'envit') => '3',
					esc_html__('4 Columns', 'envit') => '4',
					esc_html__('5 Columns', 'envit') => '5'
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'envit' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
			)
		),
	) );


/*------------------------------------------------------*/
/* Service with small image.
/*------------------------------------------------------*/

vc_map( array(



	'name'                      => esc_html__('envit Service With small images', 'envit'),
	'base'                      => 'envit_services_image',
	'category'                  => esc_html__('envit Service Elements', 'envit'),
	'description'               => esc_html__('Display services', 'envit'),
	'save_always'    			=> true,
	'params'                    => array(

		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'envit' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'envit' ),
			'default'	  => 'ASC',
			'value'       => array(
				esc_html__('ASC', 'envit') => 'ASC',
				esc_html__('DESC', 'envit') => 'DESC'
			)
		),
		array(
			'type'			=> 'posttypes',
			'heading'		=> esc_html__('Post type','envit'),
			'param_name'	=> 'posttype',
			'description' 	=> 'Select post type',
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','envit'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column', 'envit' ),
			'param_name'  => 'column',
			'description' => esc_html__( 'How many column will be display on a row?', 'envit' ),
			'value'       => array(
				esc_html__('2 Columns', 'envit') => '2',
				esc_html__('3 Columns', 'envit') => '3',
				esc_html__('4 Columns', 'envit') => '4',
				esc_html__('5 Columns', 'envit') => '5'
			)
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'postimageone',
			'heading'     => esc_html__( 'First image', 'envit' ),	
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'postimagetwo',
			'heading'     => esc_html__( 'Second image', 'envit' ),	
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'envit' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
		)
	 ),

) );


/*------------------------------------------------------*/
/* About Us
/*------------------------------------------------------*/

vc_map( array(
	'name'                      => esc_html__('About Us', 'envit'),
	'base'                      => 'envit_about_us',
	'category'                  => esc_html__('TMC Elements', 'envit'),
	'description'               => esc_html__('Display About Us', 'envit'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'     => 'attach_image',
			'param_name' => 'background_image',
			'heading'     => esc_html__( 'Background Image', 'envit' ),		
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'main_image',
			'heading'     => esc_html__( 'Left Main Image', 'envit' ),		
		),
		/* array(
			'type'     => 'attach_image',
			'param_name' => 'responsive_image',
			'heading'     => esc_html__( 'Left Responsive Image', 'envit' ),		
		), */
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'envit' ),
			'param_name'  => 'about_heading',
			'admin_label' => true,
			'value'       => 'some facts about us',
			'description' => esc_html__('Heading', 'envit')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Sub Heading', 'envit' ),
			'param_name'  => 'about_sub_heading',
			'admin_label' => true,
			'value'       => 'Donec fringilla, justo quam sodales a vehicula ipsum',
			'description' => esc_html__('Enter Sub Heading text.', 'envit')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Description', 'envit' ),
			'param_name'  => 'about_description',
			'admin_label' => true,
			'value'       => 'Rypesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley has been the industrys standard an unknown printer.',
			'description' => esc_html__('Description', 'envit')
		),

		array(
			'type'     => 'attach_image',
			'param_name' => 'first_sub_image',
			'heading'     => esc_html__( 'First Sub Image', 'envit' ),	
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('First Number','envit'),
			'param_name'	=> 'first_number',
			'value'			=> '176',
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'envit' ),
			'param_name'  => 'first_sub_heading',
			'admin_label' => true,
			'value'       => 'Projects',
			'description' => esc_html__('First Sub heading', 'envit')
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'second_sub_image',
			'heading'     => esc_html__( 'Second Sub Image', 'envit' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/feature/feature_2.png' ),		
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Second Number','envit'),
			'param_name'	=> 'second_number',
			'value'			=> '176',
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'envit' ),
			'param_name'  => 'second_sub_heading',
			'admin_label' => true,
			'value'       => 'Projects',
			'description' => esc_html__('Second Sub heading', 'envit')
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'third_sub_image',
			'heading'     => esc_html__( 'Third Sub Image', 'envit' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/feature/feature_3.png' ),		
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Third Number','envit'),
			'param_name'	=> 'third_number',
			'value'			=> '176',
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'envit' ),
			'param_name'  => 'third_sub_heading',
			'admin_label' => true,
			'value'       => 'Projects',
			'description' => esc_html__('Thrid Sub heading', 'envit')
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'envit' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
		)
	),

) );

/*------------------------------------------------------*/
/* Causes
/*------------------------------------------------------*/
	$args_c = array(
     'type'                     => 'campaign',
     'child_of'                 => 0,
     'parent'                   => '',
     'orderby'                  => 'name',
     'order'                    => 'ASC',
     'hide_empty'               => 1,
     'hierarchical'             => 1,
     'exclude'                  => '',
     'number'                   => '',
     'taxonomy'                 => 'campaign_category',
     'pad_counts'               => false ); 
 
  $categories = get_categories( $args_c );

  $cat = array();
  $cat[0] = 'All';
  foreach ($categories as $category) {
   $cat[] = $category->name;
  }
	vc_map( array(
		'name'                      => esc_html__('envit Causes', 'envit'),
		'base'                      => 'envit_causes',
		'category'                  => esc_html__('envit Causes Elements', 'envit'),
		'description'               => esc_html__('Display Causes', 'envit'),
		'save_always' 				=> true,
		'params'                    => array(
			
			
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Order', 'envit' ),
				'param_name'  => 'order',
				'description' => esc_html__( 'Ascending or descending order', 'envit' ),
				'default'	  => 'ASC',
				'value'       => array(
					esc_html__('ASC', 'envit') => 'ASC',
					esc_html__('DESC', 'envit') => 'DESC'
				)
			),
			array(
			   'type'        => 'dropdown',
			   'heading'     => esc_html__( 'Display Mode', 'envit' ),
			   'param_name'  => 'layout',
			   'description' => esc_html__( 'The layout your page children being display', 'envit' ),
			   'value'       => array(
				esc_html__('Grid', 'envit')     => 'grid',
				esc_html__('Carousel', 'envit') => 'carousel',
				esc_html__('Single', 'envit')     => 'single',
				esc_html__('Single Style Two', 'envit')     => 'single_style_two'
			   )
			),
			array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Categories List', 'envit' ),
			'param_name'  => 'categoriesname',
			'description' => esc_html__( 'Categories list', 'envit' ),
			'value'       => $cat,
			"dependency" => Array('element' => "layout", 'value' => array('single','single_style_two'))
		),
			array(
				'type'			=> 'textfield',
				'class'			=> '',
				'heading'		=> esc_html__('Number of posts','envit'),
				'param_name'	=> 'number',
				'value'			=> '9',
				'description' 	=> 'How many post to show?',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Column', 'envit' ),
				'param_name'  => 'column',
				'description' => esc_html__( 'How many column will be display on a row?', 'envit' ),
				'value'       => array(
					esc_html__('2 Columns', 'envit') => '2',
					esc_html__('3 Columns', 'envit') => '3',
					esc_html__('4 Columns', 'envit') => '4',
					esc_html__('5 Columns', 'envit') => '5'
				),
				'dependency' => Array('element' => 'layout', 'value' => array('grid'))
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__('Carousel Autoplay','envit'),
				'value'       => array( esc_html__('Yes.','envit') => 'yes' ),
				'param_name'  => 'carousel_autoplay',
				'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
			),
			
			array(
				'type'			 => 'textfield',
				'class'			 => '',
				'heading'		 => esc_html__('Carousel Autoplay Speed','envit'),
				'param_name'	 => 'carousel_autoplay_speed',
				'value'			 => '3000',
				'description'    => esc_html__( 'Carousel Autoplay Speed in millisecond', 'envit' ),
				'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
				
			),
			array(
				'type'			=> 'textfield',
				'class'			=> '',
				'heading'		=> esc_html__('Carousel Speed','envit'),
				'param_name'	=> 'carousel_speed',
				'description'    => esc_html__( 'Carousel Speed in millisecond', 'envit' ),
				'value'			=> '300',
				'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__('Donate now text','envit'),
				'param_name'	=> 'donate_now_text',
				'value'			=> 'Donate now',
				'description' 	=> 'Custom your Donate now text, e.g. Donate now, View Profile ...',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'envit' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
			)
		),
	) );

/*------------------------------------------------------*/
/* Event.
/*------------------------------------------------------*/

vc_map( array(



	'name'                      => esc_html__('envit Event', 'envit'),
	'base'                      => 'envit_event',
	'category'                  => esc_html__('envit Event Elements', 'envit'),
	'description'               => esc_html__('Display Event', 'envit'),
	'save_always'    			=> true,
	'params'                    => array(

		
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'envit' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'envit' ),
			'default'	  => 'ASC',
			'value'       => array(
				esc_html__('ASC', 'envit') => 'ASC',
				esc_html__('DESC', 'envit') => 'DESC'
			)
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'Display Mode', 'envit' ),
		   'param_name'  => 'layout',
		   'description' => esc_html__( 'The layout your page children being display', 'envit' ),
		   'value'       => array(
			esc_html__('List', 'envit') => 'list',
			esc_html__('Grid', 'envit')     => 'grid'
		   )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column', 'envit' ),
			'param_name'  => 'column',
			'description' => esc_html__( 'How many column will be display on a row?', 'envit' ),
			'value'       => array(
				esc_html__('2 Columns', 'envit') => '2',
				esc_html__('3 Columns', 'envit') => '3',
				esc_html__('4 Columns', 'envit') => '4',
				esc_html__('5 Columns', 'envit') => '5'
			),
			'dependency' => Array('element' => 'layout', 'value' => array('grid'))
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('More Details','envit'),
			'param_name'	=> 'more_details_text',
			'value'			=> 'More Details',
			'description' 	=> 'Custom your More Details text, e.g. More Details, View Profile ...',
			'dependency' => Array('element' => 'layout', 'value' => array('grid'))
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','envit'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'envit' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
		)
	 ),

) );	


/*------------------------------------------------------*/
/* News.
/*------------------------------------------------------*/

vc_map( array(



	'name'                      => esc_html__('envit News', 'envit'),
	'base'                      => 'envit_news',
	'category'                  => esc_html__('envit News Elements', 'envit'),
	'description'               => esc_html__('Display News', 'envit'),
	'save_always'    			=> true,
	'params'                    => array(

		
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'envit' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'envit' ),
			'default'	  => 'ASC',
			'value'       => array(
				esc_html__('ASC', 'envit') => 'ASC',
				esc_html__('DESC', 'envit') => 'DESC'
			)
		),
		array(
			'type'			=> 'posttypes',
			'heading'		=> esc_html__('Post type','envit'),
			'param_name'	=> 'posttype',
			'description' 	=> 'Select post type',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column', 'envit' ),
			'param_name'  => 'column',
			'description' => esc_html__( 'How many column will be display on a row?', 'envit' ),
			'value'       => array(
				esc_html__('2 Columns', 'envit') => '2',
				esc_html__('3 Columns', 'envit') => '3',
				esc_html__('4 Columns', 'envit') => '4',
				esc_html__('5 Columns', 'envit') => '5'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','envit'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'envit' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
		)
	 ),

) );


/*------------------------------------------------------*/
/* Clients.
/*------------------------------------------------------*/
$args_c = array(
     'type'                     => 'clients',
     'child_of'                 => 0,
     'parent'                   => '',
     'orderby'                  => 'name',
     'order'                    => 'ASC',
     'hide_empty'               => 1,
     'hierarchical'             => 1,
     'exclude'                  => '',
     'number'                   => '',
     'taxonomy'                 => 'clients_category',
     'pad_counts'               => false ); 
 
  $categories = get_categories( $args_c );

  $cat = array();
  $cat[0] = 'All';
  foreach ($categories as $category) {
   $cat[] = $category->name;
  }
  
vc_map( array(
	'name'                      => esc_html__('envit Clients', 'envit'),
	'base'                      => 'envit_clients',
	'category'                  => esc_html__('envit Clients Elements', 'envit'),
	'description'               => esc_html__('Display Clients', 'envit'),
	'save_always'    			=> true,
	'params'                    => array(

		
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Display Style', 'envit' ),
			'param_name'  => 'layout',
			'description' => esc_html__( 'The layout your section being display', 'envit' ),
			'value'       => array(
				esc_html__("Style One", "envit")     => "style_one",
				esc_html__("Style Two", "envit") => "style_two"
			)
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Categories List', 'envit' ),
			'param_name'  => 'categoriesname',
			'description' => esc_html__( 'Categories list', 'envit' ),
			'value'       => $cat
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'envit' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'envit' ),
			'default'	  => 'ASC',
			'value'       => array(
				esc_html__('ASC', 'envit') => 'ASC',
				esc_html__('DESC', 'envit') => 'DESC'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','envit'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'envit' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
		)
	 ),

) );

/*------------------------------------------------------*/
/* Testimonials.
/*------------------------------------------------------*/

vc_map( array(



	'name'                      => esc_html__('envit Testimonials', 'envit'),
	'base'                      => 'envit_testimonials',
	'category'                  => esc_html__('envit Testimonials Elements', 'envit'),
	'description'               => esc_html__('Display Testimonials', 'envit'),
	'save_always'    			=> true,
	'params'                    => array(

		
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'envit' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'envit' ),
			'default'	  => 'ASC',
			'value'       => array(
				esc_html__('ASC', 'envit') => 'ASC',
				esc_html__('DESC', 'envit') => 'DESC'
			)
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'Display Mode', 'envit' ),
		   'param_name'  => 'layout',
		   'description' => esc_html__( 'The layout your page children being display', 'envit' ),
		   'value'       => array(
			esc_html__('Carousel', 'envit') => 'carousel',
			esc_html__('Grid', 'envit')     => 'grid',
		   )
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','envit'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'envit' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
		)
	 ),

) );


/*------------------------------------------------------*/
/* Team
/*------------------------------------------------------*/
	
	vc_map( array(
		'name'                      => esc_html__('envit Team', 'envit'),
		'base'                      => 'envit_team',
		'category'                  => esc_html__('envit Team Elements', 'envit'),
		'description'               => esc_html__('Display Team', 'envit'),
		'save_always' 				=> true,
		'params'                    => array(
			
			
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Order', 'envit' ),
				'param_name'  => 'order',
				'description' => esc_html__( 'Ascending or descending order', 'envit' ),
				'default'	  => 'ASC',
				'value'       => array(
					esc_html__('ASC', 'envit') => 'ASC',
					esc_html__('DESC', 'envit') => 'DESC'
				)
			),
			array(
			   'type'        => 'dropdown',
			   'heading'     => esc_html__( 'Display Mode', 'envit' ),
			   'param_name'  => 'layout',
			   'description' => esc_html__( 'The layout your page children being display', 'envit' ),
			   'value'       => array(
				esc_html__('Grid', 'envit')     => 'grid',
				esc_html__('Carousel', 'envit') => 'carousel'
			   )
			),
			array(
				'type'			=> 'textfield',
				'class'			=> '',
				'heading'		=> esc_html__('Number of posts','envit'),
				'param_name'	=> 'number',
				'value'			=> '9',
				'description' 	=> 'How many post to show?',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Column', 'envit' ),
				'param_name'  => 'column',
				'description' => esc_html__( 'How many column will be display on a row?', 'envit' ),
				'value'       => array(
					esc_html__('2 Columns', 'envit') => '2',
					esc_html__('3 Columns', 'envit') => '3',
					esc_html__('4 Columns', 'envit') => '4',
					esc_html__('5 Columns', 'envit') => '5'
				),
				'dependency' => Array('element' => 'layout', 'value' => array('grid'))
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__('Carousel Autoplay','envit'),
				'value'       => array( esc_html__('Yes.','envit') => 'yes' ),
				'param_name'  => 'carousel_autoplay',
				'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
			),
			
			array(
				'type'			 => 'textfield',
				'class'			 => '',
				'heading'		 => esc_html__('Carousel Autoplay Speed','envit'),
				'param_name'	 => 'carousel_autoplay_speed',
				'value'			 => '3000',
				'description'    => esc_html__( 'Carousel Autoplay Speed in millisecond', 'envit' ),
				'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
				
			),
			array(
				'type'			=> 'textfield',
				'class'			=> '',
				'heading'		=> esc_html__('Carousel Speed','envit'),
				'param_name'	=> 'carousel_speed',
				'description'    => esc_html__( 'Carousel Speed in millisecond', 'envit' ),
				'value'			=> '300',
				'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'envit' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
			)
		),
	) );


/*------------------------------------------------------*/
/* Gallery
/*------------------------------------------------------*/
	
	vc_map( array(
		'name'                      => esc_html__('envit Gallery', 'envit'),
		'base'                      => 'envit_gallery',
		'category'                  => esc_html__('envit Gallery Elements', 'envit'),
		'description'               => esc_html__('Display Gallery', 'envit'),
		'save_always' 				=> true,
		'params'                    => array(
			
			
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Order', 'envit' ),
				'param_name'  => 'order',
				'description' => esc_html__( 'Ascending or descending order', 'envit' ),
				'default'	  => 'ASC',
				'value'       => array(
					esc_html__('ASC', 'envit') => 'ASC',
					esc_html__('DESC', 'envit') => 'DESC'
				)
			),
			array(
				'type'			=> 'posttypes',
				'heading'		=> esc_html__('Post type','envit'),
				'param_name'	=> 'posttype',
				'description' 	=> 'Select post type',
			),
			array(
			   'type'        => 'dropdown',
			   'heading'     => esc_html__( 'Display Mode', 'envit' ),
			   'param_name'  => 'layout',
			   'description' => esc_html__( 'The layout your page children being display', 'envit' ),
			   'value'       => array(
				esc_html__('Filter', 'envit')   => 'filter',
				esc_html__('Grid', 'envit')     => 'grid',
				esc_html__('Text', 'envit')     => 'text',
				esc_html__('Cobbies', 'envit')  => 'cobbies'
			   )
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__('Hide / Show Filter','envit'),
				'value'       => array( esc_html__('Yes.','envit') => 'yes' ),
				'param_name'  => 'hide_show_filter',
				'dependency' => Array('element' => 'layout', 'value' => array('filter'))
			),
			array(
				'type'     => 'attach_image',
				'param_name' => 'icon_image',
				'heading'     => esc_html__( 'Light box Icon', 'envit' ),
				'dependency' => Array('element' => 'layout', 'value' => array('text'))	
			),
			array(
				'type'			=> 'textfield',
				'class'			=> '',
				'heading'		=> esc_html__('Number of posts','envit'),
				'param_name'	=> 'number',
				'value'			=> '9',
				'description' 	=> 'How many post to show?',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Column', 'envit' ),
				'param_name'  => 'column',
				'description' => esc_html__( 'How many column will be display on a row?', 'envit' ),
				'value'       => array(
					esc_html__('2 Columns', 'envit') => '2',
					esc_html__('3 Columns', 'envit') => '3',
					esc_html__('4 Columns', 'envit') => '4',
					esc_html__('5 Columns', 'envit') => '5'
				),
				'dependency' => Array(
						'element' => 'layout',
						'value' => array('grid','filter','text')
					)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'envit' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
			)
		),
	) );
	
/*------------------------------------------------------*/
/* Contact Info
/*------------------------------------------------------*/

vc_map( array(
	'name'                      => esc_html__('Contact Info', 'envit'),
	'base'                      => 'envit_contact_info',
	'category'                  => esc_html__('envit Elements', 'envit'),
	'description'               => esc_html__('Display Contact Info', 'envit'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'envit' ),
			'param_name'  => 'contact_heading',
			'admin_label' => true,
			'value'       => 'Contact info',
			'description' => esc_html__('Heading', 'envit')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Sub Heading', 'envit' ),
			'param_name'  => 'contact_sub_heading',
			'admin_label' => true,
			'value'       => 'Have any Queries? Let us know. We will clear it for you at the best.',
			'description' => esc_html__('Enter Sub Heading text.', 'envit')
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Address Title','envit'),
			'param_name'	=> 'add_title',
			'value'			=> 'OFFICE',
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Address Text One', 'envit' ),
			'param_name'  => 'add_text_one',
			'admin_label' => true,
			'value'       => 'envit, 215, Mallin Street'
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Address Text Two', 'envit' ),
			'param_name'  => 'add_text_two',
			'admin_label' => true,
			'value'       => 'New Youk, NY 100 254'
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Email Title','envit'),
			'param_name'	=> 'eml_title',
			'value'			=> 'email',
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Email One','envit'),
			'param_name'	=> 'eml_text_one',
			'value'			=> 'info@envit.contact.com',
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Email Two','envit'),
			'param_name'	=> 'eml_text_two',
			'value'			=> 'support@envit.com',
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Phone Title','envit'),
			'param_name'	=> 'phn_title',
			'value'			=> 'phone',
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Phone Number One','envit'),
			'param_name'	=> 'phn_no_one',
			'value'			=> '+0120(123)456789',
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Phone Number Two','envit'),
			'param_name'	=> 'phn_no_two',
			'value'			=> '+0120(987)65419',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'envit' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
		)
	),

) );

/*------------------------------------------------------*/
/* Responsive Filter.
/*------------------------------------------------------*/

		vc_map( array(

						'name'                      => esc_html__('envit Filter', 'envit'),
						'base'                      => 'envit_filter',
						'category'                  => esc_html__('envit Filter Elements', 'envit'),
						'description'               => esc_html__('Display Filter', 'envit'),
						'save_always'    			=> true,
						'params'                    => array(
							
							array(
								'type'			=> 'textfield',
								'heading'		=> esc_html__('Title','envit'),
								'param_name'	=> 'fltr_title',
								'value'			=> 'Filter',
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Extra class name', 'envit' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
							)
						 ),
					)
			);

/*Single Section*/

				vc_map( array(

					'name'                      => esc_html__('Single Section', 'envit'),
					'base'                      => 'envit_single_section',
					'category'                  => esc_html__('envit Single Section Elements', 'envit'),
					'description'               => esc_html__('Section Media', 'envit'),
					'save_always'    			=> true,
					'params'                    => array(
						
						array(
								'type'        => 'dropdown',
								'heading'     => esc_html__( 'Display Style', 'envit' ),
								'param_name'  => 'layout',
								'description' => esc_html__( 'The layout for different section display', 'envit' ),
								'value'       => array(
									esc_html__("Layout One", "envit")     => "layout_one",
									esc_html__("Layout Two", "envit") => "layout_two",
									esc_html__("Layout Three", "envit") => "layout_three"
								)
							),
							array(
							'param_name' => 'body_background',
							'type'     => 'colorpicker',
							'heading'    => esc_html__('Body Background', 'envit'),
							"dependency" => Array('element' => "layout", 'value' => array('layout_one')),
							),
							array(
							'param_name' => 'customcss',
							'type'     => 'textfield',
							'heading'    => esc_html__('Custom Css', 'envit'),
							"dependency" => Array('element' => "layout", 'value' => array('layout_one')),
							),
							
						array(
							'type'     => 'attach_image',
							'param_name' => 'main_image',
							'heading'     => esc_html__( 'Professional-left-image', 'envit' ),
							"dependency" => Array('element' => "layout", 'value' => array('layout_one','layout_three'))
						),
						array(
							'type'     => 'attach_image',
							'param_name' => 'main_image_other',
							'heading'     => esc_html__( 'Professional-right-image', 'envit' ),
							"dependency" => Array('element' => "layout", 'value' => array('layout_three'))
						),
						
						array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Heading text', 'envit' ),
						'param_name'  => 'main_heading',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
						),
						array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Heading text', 'envit' ),
						'param_name'  => 'subtitle_heading',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' ),
						"dependency" => Array('element' => "layout", 'value' => array('layout_two','layout_three'))
						),					   
						array(
							'type'        => 'textarea_html',
							'heading'     => esc_html__( 'Description', 'envit' ),
							'param_name'  => 'test_description',
							'admin_label' => true,
							'value'       => '',
							'description' => esc_html__('Custom heading, allow simple HTML code.', 'envit'),			
						 ),
						
						array(
							"type" => "vc_link",
							"holder" => "div",
							"class" => "",
							"heading" => esc_html__("Read More", 'envit'),
							"param_name" => "link",
							"description" => esc_html__("Button Link.", 'envit'),
							"dependency" => Array('element' => "layout", 'value' => array('layout_one','layout_two'))
						)
					),
					
				) );

/*Custom Section*/
			
				vc_map( array(

					'name'                      => esc_html__('Custom Section', 'envit'),
					'base'                      => 'envit_custom_section',
					'category'                  => esc_html__('envit Custom Section Elements', 'envit'),
					'description'               => esc_html__('Section Media', 'envit'),
					'save_always'    			=> true,
					'params'                    => array(
						
						array(
								'type'        => 'dropdown',
								'heading'     => esc_html__( 'Display Style', 'envit' ),
								'param_name'  => 'layout',
								'description' => esc_html__( 'The layout for different section display', 'envit' ),
								'value'       => array(
									esc_html__("Dummy Text Section One", "envit") => "dummy_text_section_one",				
									esc_html__("Our Campaign Paragraph", "envit") => "our_campaign_para",
									esc_html__("Our Mission Block", "envit") => "our_mission_block",
									esc_html__("Newsletter Paragraph", "envit") => "newsletter_para",
									esc_html__("Newsletter Shortcode", "envit") => "newsletter_shortcode",
									
								)
							),
						array(
							'type'     => 'attach_image',
							'param_name' => 'main_image_one',
							'heading'     => esc_html__( 'Image', 'envit' ),
							"dependency" => Array('element' => "layout", 'value' => array('our_mission_block'))
						),
						array(
							'type'     => 'attach_image',
							'param_name' => 'main_image_two',
							'heading'     => esc_html__( 'Image Two', 'envit' ),
							"dependency" => Array('element' => "layout", 'value' => array('our_mission_block'))
						),
						array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Heading Text', 'envit' ),
						'param_name'  => 'main_heading_one',
						'description' => esc_html__( 'Heading' ),
						"dependency" => Array('element' => "layout", 'value' => array('dummy_text_section_one','our_mission_block'))
						),						
						array(
							'type'        => 'textarea',
							'heading'     => esc_html__( 'Paragraph', 'envit' ),
							'param_name'  => 'paragraph_one',
							'admin_label' => true,
							"dependency" => Array('element' => "layout", 'value' => array('dummy_text_section_one','our_campaign_para','our_mission_block','newsletter_para'))
						),						
						array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Form Id', 'envit' ),
						'param_name'  => 'newsletter_form_id',
						'description' => esc_html__( 'Heading' ),
						"dependency" => Array('element' => "layout", 'value' => array('newsletter_shortcode'))
						),	
					),
					
				) );


			
/*section helping*/
			vc_map( array(
					'name'                      => esc_html__('Helping', 'envit'),
					'base'                      => 'envit_helping',
					'category'                  => esc_html__('envit Helping Elements', 'envit'),
					'description'               => esc_html__('Helping enviornment', 'envit'),
					'save_always'    			=> true,
					'params'                    => array(
						
						array(
								'type'        => 'dropdown',
								'heading'     => esc_html__( 'Display Style', 'envit' ),
								'param_name'  => 'layout',
								'description' => esc_html__( 'The layout for different section display', 'envit' ),
								'value'       => array(
									esc_html__("Layout One", "envit")     => "layout_one",
									esc_html__("Layout Two", "envit") => "layout_two",
									esc_html__("Layout Three", "envit") => "layout_three"
									)
							),
						array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Heading text', 'envit' ),
						'param_name'  => 'maintitle_heading',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' ),
						"dependency" => Array('element' => "layout", 'value' => array('layout_one','layout_two'))
						),													
						array(
							'type'        => 'textarea_html',
							'heading'     => esc_html__( 'Description', 'envit' ),
							'param_name'  => 'content',
							'admin_label' => true,
							'value'       => '',				
						 ),
						 array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Line One', 'envit' ),
							'param_name'  => 'textfield_one',
							'admin_label' => true,
							'value'       => '',				
						 ),
						  array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Line Two', 'envit' ),
							'param_name'  => 'textfield_two',
						),
						   array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Line Three', 'envit' ),
							'param_name'  => 'textfield_three',
							"dependency" => Array('element' => "layout", 'value' => array('layout_one','layout_two'))
					    ),
						   array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Line Four', 'envit' ),
							'param_name'  => 'textfield_four',
							"dependency" => Array('element' => "layout", 'value' => array('layout_one','layout_two'))
					    ),
					),
					
				) );	

/*Join us Section*/

					vc_map( array(

					'name'                      => esc_html__('Join Us', 'envit'),
					'base'                      => 'envit_join_us',
					'category'                  => esc_html__('envit Join Us Elements', 'envit'),
					'save_always'    			=> true,
					'params'                    => array(

						array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Heading text', 'envit' ),
						'param_name'  => 'maintitle_heading',
						),
						array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Heading text', 'envit' ),
						'param_name'  => 'maintitle_heading1',
						),
						
						array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Heading text', 'envit' ),
						'param_name'  => 'subtitle_heading',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'envit' )
						),
						
						array(
							'type'        => 'textarea_html',
							'heading'     => esc_html__( 'Description', 'envit' ),
							'param_name'  => 'content',
							'admin_label' => true,
							'value'       => '',				
						 ),
						array(
							"type" => "vc_link",
							"holder" => "div",
							"class" => "",
							"heading" => esc_html__("Donate Now", 'envit'),
							"param_name" => "buttonlink",
						),
						array(
							"type" => "vc_link",
							"holder" => "div",
							"class" => "",
							"heading" => esc_html__("Join Now", 'envit'),
							"param_name" => "buttonlink2",
						)
					),
					
				) );				
	
}	
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) 
{
	class WPBakeryShortCode_envit_Animation_Block extends WPBakeryShortCodesContainer{
	}
	class WPBakeryShortCode_envit_Gmap extends WPBakeryShortCodesContainer{
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) 
{
	class WPBakeryShortCode_ENVIT_Contacts_Widget extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Info_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Icon_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Posts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Contact extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Sidebar extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Gmap_Address extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Post_Bottom extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Post_About_Author extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Post_Comments extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Charts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Spacing extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Services extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Services_Image extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_About_Us extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Causes extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Event extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_News extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Clients extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Testimonials extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Team extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Gallery extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Contact_Info extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Filter extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Single_Section extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Helping extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Join_Us extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_ENVIT_Custom_Section extends WPBakeryShortCode {
	}
}
