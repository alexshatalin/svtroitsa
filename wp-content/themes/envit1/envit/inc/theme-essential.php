<?php
/**
 * Changing the Title Of comment form
 */

 function envit_form_before() {
    ob_start();
}
add_action( 'comment_form_before', 'envit_form_before' );

function envit_form_after() 
{
    $html = ob_get_clean();
    $html = preg_replace(
        '/<h3 id="reply-title" class="comment-reply-title"(.*)>(.*)<\/h3>/',
        '<h5 id="reply-title" class="h5 as tt-featured-title font-20" \1>\2</h5>',
        $html
    );
    echo $html;
}
add_action( 'comment_form_after', 'envit_form_after' );
 
 /**
 * Changing the view for user viewing comment form
 */ 
function envit_comments_defaults( $defaults ) {
 global $post;

  $defaults = array(
					'fields' => apply_filters('comment_form_default_fields', array(
					'author' => '<div class="row"><div class="col-sm-6"><input id="author" class="simple-input" name="author" type="text"  size="30" required/><div class="emptySpace-xs20"></div></div>',
					'email' => '<div class="col-sm-6"><input id="email" name="email" class="simple-input" type="text"  size="30" required/></div></div>',
					'url' => '')),
					'comment_field' => '<div class="emptySpace20"></div><textarea id="comment" placeholder="Enter Your Comment" class="simple-input" name="comment" cols="45" rows="8" required></textarea><div class="emptySpace30"></div>' ,
					'comment_notes_after' => '',											
					);

  return $defaults;
}
add_filter( 'comment_form_defaults', 'envit_comments_defaults' );

// Comment Section
function envit_wp_move_comment_field_to_bottom( $fields )
{
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'envit_wp_move_comment_field_to_bottom' );

// To Add Place holders
add_filter( 'comment_form_default_fields', 'envit_wp_comment_placeholders' );
function envit_wp_comment_placeholders( $fields )
{
    $fields['author'] = str_replace('<input','<input placeholder="'.esc_html__('Enter Your Name','envit'). '"', $fields['author'] );	
	$fields['email'] = str_replace('<input','<input placeholder="'. esc_html__('Enter Your Email','envit'). '"',$fields['email']);	
    return $fields;
}
add_filter( 'comment_form_defaults', 'envit_wp_textarea_insert' );

function envit_wp_textarea_insert( $fields )
{
	$fields['comment_field'] = str_replace('<textarea','<textarea',$fields['comment_field']);	
    return $fields;
}
// To remove Website field
function envit_alter_comment_form_fields($fields){
    $fields['url'] = '';  //removes website field
    return $fields;
}
add_filter('comment_form_default_fields','envit_alter_comment_form_fields');

if ( ! function_exists( 'envit_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own envit_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
function envit_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php esc_html__( 'Pingback:', 'envit' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'envit' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
         break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	
			<div class="comment commentBox">
				<div class="commentContent">
					<div class="imgWrapper">
						 <?php echo get_avatar( $comment, 60 ); ?>
					</div>
					<?php 
						printf( '<a class="fn">%1$s</a> %2$s',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'envit' ) . '</span>' : ''
                        );
					
  					if ( '0' == $comment->comment_approved ) : ?>
						<div class="simple-text">
							<?php esc_html__( 'Your comment is awaiting moderation.', 'envit' ); ?>
						</div>
					<?php endif; ?>
						<div class="simple-text">
							<?php comment_text(); ?>
						</div>
				</div>
				<div class="commentTime small">
				<?php 
					printf( '<p class="pull-left"><time datetime="%2$s">%3$s</time></p>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            sprintf( __( '%1$s', 'envit' ), get_comment_date() )
                        );
						comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'envit' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        edit_comment_link( __( 'Edit', 'envit' ), '<span class="edit-link">', '</span>' );
				?>
				</div>
			</div>
    <?php
        break;
    endswitch; // end comment_type check
}
endif;

// Header Function
if ( ! function_exists( 'envit_get_header' ) ) 
{
	function envit_get_header() 
	{
		$header = '';
		return get_header( $header );
	}
}
function envit_header_layout($header_style)
{	
	switch($header_style) {	
		case 'envit_header_4':
			get_template_part( 'inc/headers/header_style4' );
			break;
		case 'envit_header_3':
			get_template_part( 'inc/headers/header_style3' );
			break;
		case 'envit_header_2':
			get_template_part( 'inc/headers/header_style2' );
			break;
		default:
			get_template_part( 'inc/headers/header_style1' );
			break; 
		} 	
}
if ( ! function_exists( 'envit_get_header_style' ) ) 
{
	function envit_get_header_style() 
	{
		global $envit_option;
		
		if(!empty($envit_option['header_style'])) 
		{
			$header_style = $envit_option['header_style'];
		}		
		else 
		{
			$header_style= 'envit_header_1';
		}
		return $header_style;
	}
}

if ( ! function_exists( 'envit_get_socials' ) ) 
{
	function envit_get_socials( $type = 'header_socials' ) 
	{
		global $envit_option;
		$socials_array  = array();
		$socials_enable = $envit_option['enable_social'];
		
		if($socials_enable)
		{
			if(isset($envit_option['facebook-value']) && $envit_option['facebook-value'] != '')
			{
				$socials_array['facebook'] = $envit_option['facebook-value'];
			}
			if(isset($envit_option['twitter-value']) && $envit_option['twitter-value'] != '')
			{
				$socials_array['twitter'] = $envit_option['twitter-value'];				
			}	
			if(isset($envit_option['google-value']) && $envit_option['google-value'] != '')
			{
				$socials_array['google-plus'] = $envit_option['google-value'];
			}										
			if(isset($envit_option['linkedin-value']) && $envit_option['linkedin-value'] != '')
			{
				$socials_array['linkedin'] = $envit_option['linkedin-value'];
			}				
			if(isset($envit_option['pinterest-value']) && $envit_option['pinterest-value'] != '')
			{
				$socials_array['pinterest'] = $envit_option['pinterest-value'];
			}
			if(isset($envit_option['instagram-value']) && $envit_option['instagram-value'] != '')
			{
				$socials_array['instagram'] = $envit_option['instagram-value'];
			}								
			if(isset($envit_option['yelp-value']) && $envit_option['yelp-value'] != '')
			{
				$socials_array['yelp'] = $envit_option['yelp-value'];
			}				
			if(isset($envit_option['foursquare-value']) && $envit_option['foursquare-value'] != '')
			{
				$socials_array['foursquare'] = $envit_option['foursquare-value'];
			}									
			if(isset($envit_option['flickr-value']) && $envit_option['flickr-value'] != '')
			{
				$socials_array['flickr'] = $envit_option['flickr-value'];
			}	
			if(isset($envit_option['youtube-value']) && $envit_option['youtube-value'] != '')
			{
				$socials_array['youtube'] = $envit_option['youtube-value'];
			}				
			if(isset($envit_option['email-value']) && $envit_option['email-value'] != '')
			{
				$socials_array['email'] = $envit_option['email-value'];
			}			
			if(isset($envit_option['rss-value']) && $envit_option['rss-value'] != '')
			{
				$socials_array['rss'] = $envit_option['rss-value'];
			}	
				return $socials_array;
		}
	}
}

function envit_header_page_title()
{
	$post_id        = get_the_ID();
	global $envit_option;
	global $post;
	$tmc_post_type = get_post_type($post);
	$page_for_posts = get_option( 'page_for_posts' );
	if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) 
	{
		$post_id = $page_for_posts;
	}
	
		if(get_post_type() == 'page')
		{
			$sideBar 			= get_post_meta(get_the_ID(), 'sidebar', true );
			$attachment 		= get_post_meta(get_the_ID(), 'header-image', true );
			$HidePageTitle 		= get_post_meta(get_the_ID(), 'hide-page-title', true );
			$PageHeaderTitle 	= get_post_meta(get_the_ID(), 'page-header-title', true );
			$hideBreadcrumb 	= get_post_meta(get_the_ID(), 'hide-breadcrumb', true );
			$titleAlignment 	= get_post_meta(get_the_ID(), 'title-alignment', true );
			$titlePaddingTop 	= get_post_meta(get_the_ID(), 'title-padding-top', true );
			$titlePaddingBottom = get_post_meta(get_the_ID(), 'title-padding-bottom', true );
			$titleColor 		= get_post_meta(get_the_ID(), 'header_color', true );
		}
		elseif( get_post_type() == 'services')
		{
			
			$attachment 		= get_post_meta(get_the_ID(), 'service-header-image', true );
			$HidePageTitle 		= get_post_meta(get_the_ID(), 'service-hide-page-title', true );
			$PageHeaderTitle 	= get_post_meta(get_the_ID(), 'service-header-title', true );
			$hideBreadcrumb 	= get_post_meta(get_the_ID(), 'service-hide-breadcrumb', true );
			$titleAlignment 	= get_post_meta(get_the_ID(), 'service-title-alignment', true );
			$titlePaddingTop 	= get_post_meta(get_the_ID(), 'service-title-padding-top', true );
			$titlePaddingBottom = get_post_meta(get_the_ID(), 'service-title-padding-bottom', true );
			
		}
		elseif(get_post_type() == 'team')
		{
			$attachment 		= get_post_meta(get_the_ID(), 'team-header-image', true );
			$HidePageTitle 		= get_post_meta(get_the_ID(), 'team-hide-page-title', true );
			$PageHeaderTitle	= get_post_meta(get_the_ID(), 'team-header-title', true );
			$hideBreadcrumb 	= get_post_meta(get_the_ID(), 'team-hide-breadcrumb', true );
			$titleAlignment 	= get_post_meta(get_the_ID(), 'team-title-alignment', true );
			$titlePaddingTop 	= get_post_meta(get_the_ID(), 'team-title-padding-top', true );
			$titlePaddingBottom = get_post_meta(get_the_ID(), 'team-title-padding-bottom', true );
			
		}
		elseif(get_post_type() == 'post')
		{
			if(is_single())
			{
				$attachment 		= get_post_meta(get_the_ID(), 'post-header-image', true );
				$HidePageTitle 		= get_post_meta(get_the_ID(), 'post-hide-page-title', true );
				$PageHeaderTitle	= get_post_meta(get_the_ID(), 'post-header-title', true );
				$hideBreadcrumb 	= get_post_meta(get_the_ID(), 'post-hide-breadcrumb', true );
				$titleAlignment 	= get_post_meta(get_the_ID(), 'post-title-alignment', true );
				$titlePaddingTop 	= get_post_meta(get_the_ID(), 'post-title-padding-top', true );
				$titlePaddingBottom = get_post_meta(get_the_ID(), 'post-title-padding-bottom', true );
				
			}
			else
			{
				$attachment 		= '';
				$HidePageTitle 		= '';
				$PageHeaderTitle 	= '';
				$hideBreadcrumb 	= '';
				$titleAlignment 	= '';
				$titlePaddingTop 	= '';
				$titlePaddingBottom = '';
			}
		}
		else
		{
			$attachment 		= '';
			$HidePageTitle 		= '';
			$PageHeaderTitle 	= '';
			$hideBreadcrumb 	= '';
			$titleAlignment 	= '';
			$titlePaddingTop 	= '';
			$titlePaddingBottom = '';
		}
		 
		$image = wp_get_attachment_image_src( $attachment, 'full' );
		if($titlePaddingTop)
		{
			$titlePaddingTop = ' padding-top:'. $titlePaddingTop .';';
		}
		if($titlePaddingBottom)
		{
			$titlePaddingBottom = ' padding-bottom:'. $titlePaddingBottom .';';
		}
		if($titleAlignment == 'left')
		{
			$titleAlignment = ' text-align:'. $titleAlignment .'';;
		}
		if($titleAlignment == 'center')
		{
			$titleAlignment = ' text-align:'. $titleAlignment .';';
		}
		if($titleAlignment == 'right')
		{
			$titleAlignment = ' text-align:'. $titleAlignment .';';
		}
		$innerheader = '';
		$innerImage = backgroundStyle('title_background');
		if(isset($envit_option['bg_switch']) && $envit_option['bg_switch'] == '1')
		{
			if(!empty($image[0]))
			{
				$innerheader = $image[0];
			}
			elseif(!empty($innerImage))
			{
				$innerheader = implode('', $innerImage);
			}
			if(get_post_type() == 'post')
			{	
				if(!is_single())
				{
					$innerImage = backgroundStyle('blog_image');
					$innerheader = implode('', $innerImage);
				}
			}
		}
	    if(isset($envit_option['tilebar_layout']) && $envit_option['tilebar_layout'] == '1')
		{
			$innerheader = '';
		}
		if (  class_exists( 'Redux' ) )
		{
			if(isset($envit_option['titlebar_full_switch']) && $envit_option['titlebar_full_switch'] == '1')
			{
			?>
			<div class="banner" style="<?php echo esc_attr($innerheader); echo esc_attr($titlePaddingTop); echo esc_attr($titlePaddingBottom); echo esc_attr($titleAlignment); ?>">
				<div class="container">
					<div class="cellpadding">
						<?php 	
						if(isset($envit_option['title_switch']) && $envit_option['title_switch'] == '1')
						{
							if($HidePageTitle != 'yes')
							{
								if($PageHeaderTitle != '')
								{ ?>
									<h2 class="banner-title"><?php echo esc_attr($PageHeaderTitle); ?></h2>
								<?php 
								}
								elseif(get_post_type() == 'post')
								{ 
									if(!empty($envit_option['blog_title']))
									{ ?>
										<h2 class="banner-title"><?php echo esc_attr($envit_option['blog_title']); ?></h2>
							<?php 	}
									else 
									{ ?>
										<h2 class="banner-title"><?php echo envit_page_title( false ); ?></h2>
								<?php
									}  
								} 
								else
								{ ?>
									<h2 class="banner-title"><?php echo envit_page_title( false ); ?></h2>
							<?php 
								} 	
							} 
						}
						if(class_exists( 'Redux' ) )
						{
							if (isset($envit_option['breadcrumb_switch']) && $envit_option['breadcrumb_switch'] == '1' && $hideBreadcrumb != 'yes')
							{ ?>
								<div class="breadcrumb">
									<div class="breadblock">
										<?php envit_breadcrumbs(); ?>
									</div>
								</div>
						<?php
							}
						} ?>
					</div>
				</div>
			</div>
<?php 		}	
		}
		else
		{ ?>
			<div class="banner" style="background-image:url(<?php echo esc_url($innerheader); ?>)">
				<div class="container">
					<div class="cellpadding">
						<h2 class="banner-title"><?php echo envit_page_title( false ); ?></h2>
						<div class="breadcrumb">
							<div class="breadblock">
								<?php envit_breadcrumbs(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>	
		<?php 
		} 
}
if ( ! function_exists( 'envit_page_title' ) ) 
{
	function envit_page_title( $display = true ) 
	{
		global $wp_locale;

		$title    = '';
		// If there is a post
		if ( is_single() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) || is_front_page() ) 
		{
			$title = single_post_title( '', false );
		}

		if ( is_home() ) 
		{
			if ( ! get_option( 'page_for_posts' ) ) 
			{
				$title = $single_posts;
			}
		}

		// If there's a post type archive
		if ( is_post_type_archive() ) 
		{
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) ) 
			{
				$post_type = reset( $post_type );
			}
			$post_type_object = get_post_type_object( $post_type );
			if ( ! $post_type_object->has_archive ) 
			{
				$title = post_type_archive_title( '', false );
			}
		}

		// If there's a category or tag
		if ( is_category() || is_tag() ) 
		{
			$title = single_term_title( '', false );
		}

		// If there's a taxonomy
		if ( is_tax() ) 
		{
			$term = get_queried_object();
			if ( $term ) 
			{
				$tax   = get_taxonomy( $term->taxonomy );
				$title = single_term_title( '', false );
			}
		}

		// If there's an author
		if ( is_author() && ! is_post_type_archive() ) 
		{
			$author = get_queried_object();
			if ( $author ) 
			{
				$title = $author->display_name;
			}
		}
		
		// If it's a search
		if ( is_search() ) 
		{
			$title = esc_html__( 'Search Results', 'envit' );
		}

		// If it's a 404 page
		if ( is_404() ) 
		{
			$title = esc_html__( 'Page not found', 'envit' );
		}

		if ( $display ) 
		{
			echo esc_html( $title );
		} 
		else 
		{
			return esc_html( $title );
		}
	}
}

if ( ! function_exists( 'envit_breadcrumbs' ) )
{
	function envit_breadcrumbs()
	{
		if(function_exists('bcn_display')) 
			bcn_display(); 
	}
}

if ( ! function_exists( 'envit_get_structure' ) )
{	
	function envit_get_structure( $sidebar_id, $sidebar_type, $sidebar_position, $layout = false )
	{

		$output                   = array();
		$output['content_before'] = $output['content_after'] = $output['sidebar_before'] = $output['sidebar_after'] = '';
		$output['class']          = 'posts_list';

		if ( $sidebar_type == 'vc' ) 
		{
			if ( $sidebar_id ) 
			{
				$sidebar = get_post( $sidebar_id );
			}
		} 
		else 
		{
			if ( $sidebar_id ) 
			{
				$sidebar = true;
			}
		}

		if ( isset( $sidebar ) ) 
		{
			$output['class'] .= ' with_sidebar';
		}

		if ( $sidebar_position == 'right' && isset( $sidebar ) ) 
		{
			$output['content_before'] .= '<div class="row">';
			$output['content_before'] .= '<div class="col-sm-12 col-md-9 default_section pull-left">';
			$output['content_before'] .= '<div class="mainBlogContent right-sidebar">';

			$output['content_after'] .= '</div>';
			$output['content_after'] .= '</div>'; // col
			$output['sidebar_before'] .= '<div class="col-sm-12 col-md-3 pull-right default_section_sidebar">';
			// .sidebar-area
			$output['sidebar_after'] .= '</div>'; // col
			$output['sidebar_after'] .= '</div>'; // row
		}
		if ( $sidebar_position == 'left' && isset( $sidebar ) ) 
		{
			$output['content_before'] .= '<div class="row blogs-area">';
			$output['content_before'] .= '<div class="col-sm-12 col-md-9 blog_section pull-right">';
			$output['content_before'] .= '<div class="mainBlogContent left-sidebar">';

			$output['content_after'] .= '</div>';
			$output['content_after'] .= '</div>'; // col
			$output['sidebar_before'] .= '<div class="col-sm-12 col-md-3 pull-left">';
			// .sidebar-area
			$output['sidebar_after'] .= '</div>'; // col
			$output['sidebar_after'] .= '</div>'; // section
		}
		return $output;
	}
}