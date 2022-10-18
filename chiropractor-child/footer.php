<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 */
        if ( is_home() ) {
            do_action('chiropractor_after_content');
        }

        if ( ! chiropractor_is_full_width_content() ) { ?>
            </div><?php
        } ?>

        <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>
	</div><!-- .site-content -->

</div><!-- .site --><?php

// if( chiropractor_is_site_boxed() ){ echo '<div class="boxed boxed-footer">'; }

// if ( is_home() ) {
//     do_action( 'chiropractor_blog_before_footer' );
// }

// if ( is_front_page() ) {
// 	do_action( 'chiropractor_before_footer' );
// }
?>
<div class="custom-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
					<ul id="menu-head-menu-right-section" class="social-navigation type-2 rt-icons">
                    <li id="menu-item-3414" class="fa fa-facebook menu-item menu-item-type-custom menu-item-object-custom menu-item-3414">
                    <a target="_blank" href="http://facebook.com/physiointhesix"><span class="screen-reader-text">Facebook</span></a></li>
                    <li id="menu-item-3415" class="fa fa-instagram menu-item menu-item-type-custom menu-item-object-custom menu-item-3415"><a target="_blank" href="https://www.instagram.com/physiointhesix/"><span class="screen-reader-text">Instagram</span></a></li>
                </ul>
                <div class="main-logo-f">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/award.png" alt="">
					 


                    <h4 class="custom-title">
                        We offer late nights and weekend appointments<br>
                        Physio in the Six Inc. has been recognized as one of the top South Etobicoke Physiotherapy Toronto practices.
                    </h4>
                    <h5 class="custom-f5">
                        Verified by <a href="https://www.opencare.com/physiotherapists/etobicoke-on/#tc24630724013">Opencare.com</a>
                    </h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 custom-logo">
                <a target="_blank" href="http://www.collegept.org/Home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer1.jpg" alt=""></a>
            </div>
            <div class="col-md-3 col-sm-6 custom-logo">
                <a target="_blank" href="http://www.physiotherapy.ca/Home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer2.jpg" alt=""></a>
            </div>
            <div class="col-md-3 col-sm-6 custom-logo">
                <a target="_blank" href="http://www.opa.on.ca/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer3.jpg" alt=""></a>
            </div>
            <div class="col-md-3 col-sm-6 custom-logo">
                <a target="_blank" href="http://pelvichealthsolutions.ca/"><img src="https://physiointhesix.com/wp-content/uploads/2020/05/rsz_new-pelvic-health-solutions-logo.png" alt=""></a>
            </div>
            <div class="col-md-3 col-sm-6 custom-logo">
                <a target="_blank" href="http://www.cmto.com/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer5.jpg" alt=""></a>
            </div>
            <div class="col-md-3 col-sm-6 custom-logo">
                <a target="_blank" href="https://www.rmtao.com/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer6.jpg" alt=""></a>
            </div>
            <div class="col-md-3 col-sm-6 custom-logo">
                <a target="_blank" href="https://oand.org/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer7.gif" alt=""></a>
            </div>
            <div class="col-md-3 col-sm-6 custom-logo">
                <a target="_blank" href="https://www.cand.ca/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer8.gif" alt=""></a>
            </div>
			 <h6>Cash, Debit, VISA/MasterCard. PHYSIO IN THE SIX INC. OFFERS DIRECT BILLING OPTIONS *Please note, we do NOT accept payment by American Express.</h6>
        </div>
    </div>
</div>

<?php
wp_footer(); ?>

</body>
</html>