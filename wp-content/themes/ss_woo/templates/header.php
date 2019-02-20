<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 9:46 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $ssWootemp;
$logo       = get_theme_mod( '_logo' );
$nav_header = $ssWootemp->render( 'nav', array( 'is_top' => true ) );
$nav_footer = $ssWootemp->render( 'nav', array( 'is_top' => false ) );
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php wp_head(); ?>
</head>

<body class="animsition <?php echo is_admin_bar_showing() ? "admin_bar" : ""; ?>">

<!-- header fixed -->
<div class="wrap_header fixed-header2 trans-0-4">
    <!-- Logo -->
    <a href="index.html" class="logo">
		<?php echo $logo ? "<img src=\"" . wp_get_attachment_image_url( $logo, 'medium' ) . "\" alt=\"" . get_bloginfo( 'name' ) . "\">" : get_bloginfo( 'name' ); ?>
    </a>

    <!-- Menu -->
    <div class="wrap_menu">
        <nav class="menu">
			<?php echo $nav_header; ?>
        </nav>
    </div>

    <!-- Header Icon -->
    <div class="header-icons">
        <a href="#" class="header-wrapicon1 dis-block">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-header-01.png"
                 class="header-icon1" alt="ICON">
        </a>

        <span class="linedivide1"></span>

        <div class="wadtc header-wrapicon2">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-header-02.png"
                 class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="ccount header-icons-noti">0</span>

            <!-- Header cart noti -->
            <div class="header-cart header-dropdown">
                <ul class="header-cart-wrapitem">
                </ul>

                <div class="header-cart-total">
                </div>

                <div class="header-cart-buttons">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- top noti -->
<div class="flex-c-m size22 bg0 s-text21 pos-relative">
    20% off everything!
    <a href="product.html" class="s-text22 hov6 p-l-5">
        Shop Now
    </a>

    <button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
        <i class="fa fa-remove fs-13" aria-hidden="true"></i>
    </button>
</div>

<!-- Header -->
<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2">
            <div class="topbar-social">
                <a href="#" class="topbar-social-item fa fa-facebook"></a>
                <a href="#" class="topbar-social-item fa fa-instagram"></a>
                <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>

            <!-- Logo2 -->
            <a href="index.html" class="logo2">
				<?php echo $logo ? "<img src=\"" . wp_get_attachment_image_url( $logo, 'medium' ) . "\" alt=\"" . get_bloginfo( 'name' ) . "\">" : get_bloginfo( 'name' ); ?>
            </a>

            <div class="topbar-child2">
					<span class="topbar-email">
						fashe@example.com
					</span>

                <div class="topbar-language rs1-select2">
                    <select class="selection-1" name="time">
                        <option>USD</option>
                        <option>EUR</option>
                    </select>
                </div>

                <!--  -->
                <a href="#" class="header-wrapicon1 dis-block m-l-30">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-header-01.png"
                         class="header-icon1" alt="ICON">
                </a>

                <span class="linedivide1"></span>

                <div class="wadtc header-wrapicon2 m-r-13">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-header-02.png"
                         class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="ccount header-icons-noti">0</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                        </ul>

                        <div class="header-cart-total">
                        </div>

                        <div class="header-cart-buttons">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap_header">

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
					<?php echo $nav_header; ?>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">

            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="index.html" class="logo-mobile">
			<?php echo $logo ? "<img src=\"" . wp_get_attachment_image_url( $logo, 'medium' ) . "\" alt=\"" . get_bloginfo( 'name' ) . "\">" : get_bloginfo( 'name' ); ?>
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <a href="#" class="header-wrapicon1 dis-block">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-header-01.png"
                         class="header-icon1" alt="ICON">
                </a>

                <span class="linedivide2"></span>

                <div class="wadtc header-wrapicon2">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-header-02.png"
                         class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="ccount header-icons-noti">0</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                        </ul>

                        <div class="header-cart-total">
                        </div>

                        <div class="header-cart-buttons">
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu">
        <nav class="side-menu">
            <ul class="main-menu">
                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
							<span class="topbar-email">
								fashe@example.com
							</span>

                        <div class="topbar-language rs1-select2">
                            <select class="selection-1" name="time">
                                <option>USD</option>
                                <option>EUR</option>
                            </select>
                        </div>
                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="#" class="topbar-social-item fa fa-facebook"></a>
                        <a href="#" class="topbar-social-item fa fa-instagram"></a>
                        <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                        <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                        <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                    </div>
                </li>

                <li class="item-menu-mobile">
                    <a href="index.html">Home</a>
                    <ul class="sub-menu">
                        <li><a href="index.html">Homepage V1</a></li>
                        <li><a href="home-02.html">Homepage V2</a></li>
                        <li><a href="home-03.html">Homepage V3</a></li>
                    </ul>
                    <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                </li>

                <li class="item-menu-mobile">
                    <a href="product.html">Shop</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="product.html">Sale</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="cart.html">Features</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="blog.html">Blog</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="about.html">About</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
