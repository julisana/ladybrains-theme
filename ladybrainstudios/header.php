<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package OneEngine
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <!-- Title
	================================================== -->
	<title><?php bloginfo('name'); ?><?php if(is_front_page()){ echo ' - ' .get_bloginfo('description');} else echo wp_title(); ?>
    </title>
    <!-- Title / End -->
    
    <!-- Meta
	================================================== -->
	<meta name="description" content="<?php echo oneengine_option( 'meta_description' );?>">
    <meta name="keywords" content="<?php echo oneengine_option( 'meta_keyword' ); ?>">
	<meta name="author" content="<?php echo oneengine_option( 'meta_author' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Meta / End -->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo oneengine_option('favicon', false, 'url'); ?>">
    <link rel="icon" type="image/png" href="<?php echo oneengine_option('favicon', false, 'url'); ?>" />
	<link rel="apple-touch-icon" href="<?php echo oneengine_option('touch_icon', false, 'url'); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo oneengine_option('touch_icon_72', false, 'url'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo oneengine_option('touch_icon_144', false, 'url'); ?>">
    <!-- Favicons / End -->
    
    <noscript>
    	<style>
        	#portfolio_list div.item a div.hover {
				top: 0px;
				left: -100%;
				-webkit-transition: all 0.3s ease;
				-moz-transition: all 0.3s ease-in-out;
				-o-transition: all 0.3s ease-in-out;
				-ms-transition: all 0.3s ease-in-out;
				transition: all 0.3s ease-in-out;
			}
			#portfolio_list div.item a:hover div.hover{
				left: 0px;
			}
        </style>
    </noscript>
    
	<?php
    //loads comment reply JS on single posts and pages
    if ( is_single()) wp_enqueue_script( 'comment-reply' ); 
    ?>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Preloading
    ======================================================================== -->
	<div class="mask-color">
        <div id="preview-area">
            <div class="spinner">
              <div class="dot1"></div>
              <div class="dot2"></div>
            </div>
        </div>
    </div>
	<!-- Preloading / End -->
    <?php if( is_front_page() ){ ?>
    <!-- Slider
    ======================================================================== -->
    <div class="slider-wrapper">
    	<?php oe_main_slider(); ?>
    </div>
    <!-- Slider / End -->
    
    <!-- Header
    ======================================================================== -->
    <header id="header">
    	<div class="container" >
        	<div class="row">
            	<div class="col-md-3 col-xs-3"></div>
                
            	<div class="col-md-9 col-xs-9">
                    <!-- Menu
                    ======================================================================== --> 
                    <nav id="main-menu-top">
                          <?php
                              wp_nav_menu(array( 
                                  'container' => false,
								  'container_class' => 'menu',
								  'menu_class' => 'main-menu',
								  'menu_id'         => 'menu-res',
								  'theme_location' => 'main_nav',
								  'before' => '',
								  'after' => '',
								  'link_before' => '',
								  'link_after' => '',
								  'fallback_cb' => false,
                              ));      
                          ?>
                    </nav>
                    <!-- Menu / End -->
                    
                    <nav class="menu-responsive"> 
                    </nav>
                </div>
        	</div>
        </div>
    </header>
	<!-- Header / End -->

	<?php } ?>
<!-- Blog Header
======================================================================== -->
<div class="blog-header-wrapper">
    <?php 
        $color      = oneengine_option('header_blog_color'); 
        $img        = oneengine_option('header_blog_img', false, 'url');
        $repeat     = oneengine_option('header_blog_repeat');
        $parallax   = oneengine_option('header_blog_parallax');
        $cover      = oneengine_option('header_blog_cover'); 
        
        $bg_repeat  = '';
        if( $repeat == 1 || $repeat == true){
            $bg_repeat = 'background-repeat:no-repeat;';
        }else $bg_repeat = 'background-repeat:repeat;';
        
        $bg_cover = '';
        if( $cover == 1 || $cover == true){
            $bg_cover = 'background-size:cover;';
        }else $bg_cover = '';
        
        $bg_img = '';
        if( $img ){
            $bg_img = 'background-image:url('.oneengine_option('header_blog_img', false, 'url').');';
        }else $bg_img = '';
        
        $img        = ( ! empty ( $img ) )      ? ''.$bg_img.'' : '';
        $color      = ( ! empty ( $color ) )    ? 'background-color:'. $color .';' : '';
        $repeat     = ( ! empty ( $repeat ) )   ? ''. $bg_repeat .';' : '';
        $cover      = ( ! empty ( $cover ) )    ? ''. $bg_cover .'' : '';
        $parallax   = ( ! empty ( $parallax ) ) ? 'background-attachment: fixed;': '';
        
        
        /** Style Container */
        $style = ( 
            ! empty( $img ) ||
            ! empty( $color ) || 
            ! empty( $repeat ) ||
            ! empty( $cover ) ||
            ! empty( $parallax ) ) ? 
                sprintf( '%s %s %s %s %s', $img, $color, $repeat, $cover, $parallax ) : '';
        $css = '';
        if ( ! empty( $style ) ) {          
            $css = 'style="'. $style .'" ';
        }
    ?>
    <div class="blog-header-img" <?php echo $css ?>></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12"></div>
            
            <?php 
                $color_title        = oneengine_option('header_blog_title_color'); 
                $color_sub_title    = oneengine_option('header_blog_subtitle_color');
                    
                $color_title        = ( ! empty ( $color_title ) )      ? 'color:'. $color_title .';' : '';
                $color_sub_title    = ( ! empty ( $color_sub_title ) )  ? 'color:'. $color_sub_title .';' : '';
                
                /** Style Container */
                $title_color = ( 
                    ! empty( $color_title ) ) ? 
                        sprintf( '%s', $color_title) : '';
                $css_title_color = '';
                if ( ! empty( $title_color ) ) {            
                    $css_title_color = 'style="'. $title_color .'" ';
                }
                
                $sub_title_color = ( 
                    ! empty( $color_sub_title ) ) ? 
                        sprintf( '%s', $color_sub_title) : '';
                $css_sub_title_color = '';
                if ( ! empty( $sub_title_color ) ) {            
                    $css_sub_title_color = 'style="'. $sub_title_color .'" ';
                }
            ?>
            <div class="animation-wrapper col-md-12">
                <div class="heading-title-wrapper blog-page">
                    <h2 class="title" <?php echo $css_title_color ?>>
                        <!-- Logo
                        ======================================================================== -->
                        <div calss="logo-wrapper">
                            <div class="logo">
                                 <a href="<?php echo home_url(); ?>">
                                    <?php 
                                        $top = $left = $width = '' ;
                                        if( oneengine_option('logo_top') != '' )$top    = 'top:'.oneengine_option('logo_top').'px;' ;
                                        if( oneengine_option('logo_left') != '' )$left  = 'left:'.oneengine_option('logo_left').'px;';
                                        if( oneengine_option('logo_width') != '' )$width = 'width:'.oneengine_option('logo_width').'px;';
                                        if( oneengine_option('custom_logo', false, 'url') !== '' ){
                                            echo '<div class="logo-wrapper" style="'.$width.$left.$top.'"><img src="'. oneengine_option('custom_logo', false, 'url') .'" alt="'.oneengine_option('header_blog_title').'" /></div>';
                                        }else{
                                    ?>
                                    <?php echo oneengine_option('header_blog_title') ?>
                                    <?php } ?>
                                 </a>
                            </div>  
                        </div>
                        <!-- Logo / End -->
                    </h2>
                    <span class="sub-title" <?php echo $css_sub_title_color ?>><?php echo oneengine_option('header_blog_subtitle') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Blog Header -->
<div class="clearfix"></div>
