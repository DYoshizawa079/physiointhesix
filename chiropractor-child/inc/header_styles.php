<?php
if ( ! function_exists( 'chiropractor_is_current_header' ) ) :
function chiropractor_is_current_header( $current_page_header, $headers_array ) {
    if ( !empty ( $GLOBALS['wp_customize'] ) ) {
        global $wp_customize;
        $post_values = $wp_customize->unsanitized_post_values();
        if( !empty($post_values['main_menu_style']) ) {
            $current_page_header = $post_values['main_menu_style'];
        }
    }

    return $current_page_header && array_key_exists( $current_page_header, $headers_array );
}
endif;

if ( ! function_exists( 'chiropractor_header_logo_big' ) ) :
function chiropractor_header_logo_big( $logo_url )
{
    if ( !empty ( $GLOBALS['wp_customize'] ) ) {
        global $wp_customize;
        $post_values = $wp_customize->unsanitized_post_values();
        if( isset($post_values['header_logo_big']) ) {
            $logo_url = $post_values['header_logo_big'];
        }
    }

    return esc_url($logo_url);
}
endif;
add_filter('chiropractor_header_logo_big', 'chiropractor_header_logo_big');

if ( ! function_exists( 'chiropractor_logo_site_name' ) ) :
function chiropractor_logo_site_name( $site_name, $is_site_name = true )
{
	if ( !empty ( $GLOBALS['wp_customize'] ) ) {
		global $wp_customize;
		$post_values = $wp_customize->unsanitized_post_values();
		if( isset($post_values['blogname']) && $is_site_name ) {
			$site_name = $post_values['blogname'];
		}
		if( isset($post_values['blogdescription']) && $is_site_name ) {
			$site_name = $post_values['blogdescription'];
		}
	}

	return $site_name;
}
endif;
add_filter('chiropractor_logo_site_name', 'chiropractor_logo_site_name');

if ( ! function_exists( 'chiropractor_get_header_styles' ) ) :
/**
 * Forming a Header Array for Customizer
 *
 * Creates the array to fill selects in metabox and theme options.
 *
 * @param	bool	is_metabox
 * @return	array
 */
function chiropractor_get_header_styles( $is_metabox = false ){
    $headers_array1 = apply_filters('chiropractor_headers_array1', false);
    $headers_array2 = apply_filters('chiropractor_headers_array2', false);
    $headers_array3 = apply_filters('chiropractor_headers_array3', false);
    $headers_array4 = apply_filters('chiropractor_headers_array4', false);
    $headers_list = array(
        'header1' => 'Default Header',
    );

    for($i = 1; $i <= 4; $i++) {
        if( is_array( ${'headers_array' . $i} ) ) {
            $headers_list += ${'headers_array' . $i};
        }
    }

    if( $is_metabox ) {
        array_unshift( $headers_list, array('value' => 'default', 'label' => 'Default Header') );
    }

    return $headers_list;
}
endif;

if ( ! function_exists( 'chiropractor_print_header' ) ) :
/**
 * Form function call to print header depending on settings
 *
 * Calls function to print out selected header
 *
 * @param	string	header_id
 * @param   array   theme_options
 */
function chiropractor_print_header($header_id, $theme_options) {

    if( empty($header_id) || $header_id == 'default' ) {
        $header_id = chiropractor_set($theme_options, 'default_header_style');
    }

    $header_func = 'chiropractor_'.$header_id;

    if( function_exists($header_func) ) {
        $header_func($theme_options);
    } else {
        chiropractor_header1($theme_options);
    }
}
endif;

if ( ! function_exists( 'chiropractor_header1' ) ) :
/**
 *
 * Add as many header styles as you need. Don't forget to add them to array in chiropractor_get_header_styles
 *
 */

function chiropractor_header1($theme_options) { ?>
    <div class="logo-bar style1">

        <div id="menu-strip" class="menu-strip header-sticky <?php if ( ! is_front_page() ) { echo 'slim'; } ?>">
            <div class="head-menu-left <?php
                if( get_theme_mod('header_use_logo') ) { echo ' use-big-logo-on-mobile'; }
				if( ! get_theme_mod('header_logo_small') ) { echo ' absent-small-logo'; }
                if( ! get_theme_mod('header_logo_big') ) { echo ' absent-big-logo'; }
				?>">
                <div class="head-menu-left-inner"><?php

                    // Customizer checkbox 'Use Big Logo (on mobile)'
                    if( get_theme_mod('header_use_logo') ) { ?>
                        <a class="homelink" href="<?php echo esc_url( get_site_url() ); ?>">
                        <img alt="<?php esc_attr_e( 'Logo', 'chiropractor' ) ?>" class="logo logo_big" src="<?php echo esc_url( apply_filters('chiropractor_header_logo_big', $theme_options['header_logo_big']) ); ?>" />
                        <img alt="<?php esc_attr_e( 'Logo', 'chiropractor' ) ?>" class="logo logo_small" src="<?php echo esc_url( apply_filters('chiropractor_header_logo_big', $theme_options['header_logo_small']) ); ?>" />
                        </a>
                    <?php
                    } else { ?>
	                    <a class="homelink" href="<?php echo esc_url( get_site_url() ); ?>">
                        <img alt="<?php esc_attr_e( 'Logo', 'chiropractor' ) ?>" class="logo logo_big" src="<?php echo esc_url( apply_filters('chiropractor_header_logo_big', $theme_options['header_logo_big']) ); ?>" />
                        <div class="logo-back"></div>
                        <img alt="<?php esc_attr_e( 'Logo', 'chiropractor' ) ?>" class="logo logo_small" src="<?php echo esc_url( apply_filters('chiropractor_header_logo_big', $theme_options['header_logo_small']) ); ?>" />
	                    </a>

                        <?php if( ! get_theme_mod('header_logo_big') ) { ?>
                        <div class="menu-title">
                            <div class="menu-title-inner">
                                <div class="blogdescr"><?php
                                    $site_description = apply_filters( "chiropractor_logo_site_name", get_bloginfo( 'description', 'display' ) );
                                    if ( ! empty( $site_description ) ) {
                                        $site_description = chiropractor_excerpt_chat( $site_description, 20, false, true, false, false );
                                        echo esc_attr( $site_description );
                                    } ?>
                                </div>

                                <div class="blogname"><a href="<?php echo esc_url( get_site_url() ); ?>"><?php
                                    $site_name = apply_filters( "chiropractor_logo_site_name", get_bloginfo( 'name', 'display' ) );
                                    if ( ! empty( $site_name ) ) {
                                        $site_name = chiropractor_excerpt_chat( $site_name, 20, false, true, false, false );
                                        echo esc_attr( $site_name );
                                    } ?></a>
                                </div>
                            </div>
                        </div><?php }
                    } ?>
                </div>
            </div>

            <div class="social-search h">
                <div class="relwraper h">
                    <div class="social-search-inner centered-vertical">
                        <div class="top clearfix">

                            <div class="social pull-right"><?php
                                if( $theme_options['hide_social_icons'] == '' ) {
                                    if ( has_nav_menu( 'social' ) ) {
                                        wp_nav_menu(
                                            array(
                                                'menu_class' => 'social-navigation type-2 rt-icons',
                                                'container' => false, /* classes for container */
                                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                'link_before'     => '<span class="screen-reader-text">',
                                                'link_after'      => '</span>',
                                                'theme_location' => 'social', /* we have two menus here we use our header menu as social navigation */
                                                'depth' => 0 /* in depth of 3 we'r using dropdown menu */

                                            )
                                        );
                                    }
                                } ?>
                            </div>

                            <div class="phone pull-right"><?php
                                $top_phone = chiropractor_excerpt_chat( chiropractor_get_customizer_option('top_phone'), 30, false, true, false );
                                if ( ! empty( $top_phone ) ) {
                                    $parts = explode(':', $top_phone);
                                    if(!empty($parts[1])){
                                        $top_phone = '<span>' . $parts[0] . '</span>' . $parts[1];
                                    }
                                    $top_phone_result = wp_kses( $top_phone, chiropractor_kses_list() );
                                    echo $top_phone_result;
                                } ?>
                            </div>
                        </div>

                        <div class="bottom"><?php
                            esc_html_e('Contact Us at','chiropractor');
                            $top_email = chiropractor_excerpt_chat( chiropractor_get_customizer_option('top_email'), 30, false, true, false, $use_paragraph = false );
                            $top_email_result = esc_html( $top_email );
                            ?>
                            <a href="mailto:<?php echo $top_email_result; ?>">
                                <?php echo $top_email_result ; ?>
                            </a>
                        </div>

                    </div>
                </div>
            </div><?php

            if (has_nav_menu( 'primary' )) { ?>
                <nav class="main-nav" style="float: none;"><?php
                    wp_nav_menu(
                        array(
                            'container' => false, /* classes for container */
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'theme_location' => 'primary', /* we have two menus here we use our header menu as primery navigation */
                            'depth' => 0, /* in depth of 3 we'r using dropdown menu */
                            'walker' => new CHIROPRACTOR_Bootstrap_walker()

                        )
                    ); ?>
                </nav>
                <div class="nav-button">
                <div class="mobile-menu-title q-contacts" id="q-contacts"><i class="fa fa-rocket"></i></div>
                <select class="mobile-menu">
                    <!-- <option value="" selected><?php esc_html_e(' - - Main Navigation - - ', 'chiropractor') ?></option> -->
                </select>
                <div class="mobile-menu-title"><i class="fa fa-bars"></i></div>
                </div><?php
            } else { ?>
                <nav class="main-nav" style="float: none;">
                    <div class="create-menu"><?php esc_html_e('You don\'t have a menu. Please create one ','chiropractor') ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ) ?>wp-admin/nav-menus.php"><?php esc_html_e('HERE','chiropractor') ?></a>
                    </div>
                </nav>
                <div class="nav-button"><?php esc_html_e('Please create menu', 'chiropractor') ?></div><?php
            } ?>

        </div>

        <div id="option-drop" class="option-drop option-drop-sticky">
            <ul class="other-op">
                <?php if ( isset($top_phone_result) ): ?>
                <li class="phone"><i class="fa fa-mobile"></i><span><?php echo $top_phone_result; ?></span></li>
                <?php endif; ?>
                <?php if ( isset($top_email_result) ): ?>
                <li><i class="fa fa-envelope-o"></i><span><a href="mailto:<?php echo $top_email_result; ?>" class="mail-menu"><?php echo $top_email_result; ?></a></span></li>
                <?php endif; ?>
                <?php if( false == $theme_options['hide_social_icons'] ): ?>
                <li><!--i class="fa fa-globe"></i-->
                    <span>
                    <?php if ( has_nav_menu( 'social' ) ) {
                        wp_nav_menu(
                            array(
                                //'container' => false, /* classes for container */
                                'theme_location' => 'social', /* we have two menus here we use our header menu as social navigation */
                                'depth' => 0 /* in depth of 3 we'r using dropdown menu */
                            )
                        );
                    } ?>
                    </span>
                </li>
                <?php endif; ?>
                <!--tc: additional feature (for future development) -->
                <!--li><i class="fa fa-map-marker"></i><span>2699 Barnes Street, Orlando, FL 32809</span></li-->
            </ul>
        </div>
    </div><?php
}
endif;