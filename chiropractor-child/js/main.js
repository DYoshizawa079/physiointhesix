(function($){
    "use strict";
    jQuery(document).ready(function($) {
		
		// Preloader
        $('#status').fadeOut();
        $('#preloader').delay(200).fadeOut(200);

        document.documentElement.className='js';

        // prettyPhoto
        var pPhoto = $("a.prettyPhoto");
        if(pPhoto.length){
            pPhoto.prettyPhoto({
                animation_speed:'normal',
                slideshow:3000,
                autoplay_slideshow: false,
                social_tools: false
            });
        }

        /*** Navigation in responsive layouts
         --------------------------------------------------- ****/
        var $menu = $('.main-nav > ul'),
            optionsList = '';

        if( $menu.length ) {
            $menu.find('li').each(function () {
                var $this = $(this),
                    $anchor = $this.children('a'),
                    depth = $this.parents('ul').length - 1,
                    indent = '';

                if (depth) {
                    while (depth > 0) {
                        indent += ' -- ';
                        depth--;
                    }
                }

                optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
            }).end().parent().parent().parent().parent().parent().find('.nav-button select').append( optionsList );
        }

        $('.mobile-menu').on('change', function () {
            window.location = $(this).val();
        });

        // 'Quick Contacts' (Rocket button)
        $("#q-contacts").click(function(){
            $("#option-drop").slideToggle();
        });

        // Sticky Top Menu

        if ($().sticky) {
            $('.header-sticky').sticky({topSpacing: 0});

            // Quick Contacts menu dropdown
            $('.option-drop-sticky').sticky({topSpacing: 80});
        }

        // Scroll totop button
        var toTop = $('#to-top');
        $(window).scroll(function () {
            if ($(this).scrollTop() > 1) {
                toTop.css({bottom: '11px'});
            } else {
                toTop.css({bottom: '-100px'});
            }
        });
        toTop.click(function () {
            $('html, body').animate({scrollTop: '0px'}, 800);
            return false;
        });

        // Post controls
        $('.pctrl-social-btn').click(function () {
            $(this).closest('.post-controls').toggleClass('active');
        });

        // Main page Contacts
        $('.wpcf7-form-control-wrap.text-date-picker')
            .addClass('iconed-field-right rt2 rt2-icon-calender');
        $('select.wpcf7-form-control.app-time').parent()
            .addClass('custom-select-app-time custom-select-right rt2 rt2-icon-time2');

        // Hide thumbnail above video
        var $video_thumb = $('.video-container .post-thumbnail');
        $video_thumb.closest('.recent-posts__media').bind('click', false);
        $video_thumb.click( function () {
            $(this).hide();
            $(this).closest( '.video-container').find('.video-icon').hide();
            //$(this).closest( '.hentry').find('.featured').hide();
        });
        $video_thumb.parent().find('.video-icon').click( function () {
            $(this).hide();
            $(this).closest( '.video-container').find('.post-thumbnail').hide();
            //$(this).closest( '.hentry').find('.featured').hide();
        });

        // EDD product price position
        $('.edd_downloads_list .edd_download_inner').each( function () {
            var $product_title = $(this).find('.edd_download_title');
            if( $product_title.length ) {
                $(this).find('.edd_price_class').detach().insertAfter($(this).find($product_title));
            }
        });
        $('.widget_edd_product_details').each( function () {
            var $product_title = $(this).find('h3');
            if( $product_title.length ){
                $(this).find('.edd_price_class').detach().insertAfter( $product_title );
            }
        });

        // EDD responsive
        var $edd_list = $('.shop-loop .edd_downloads_list > *');
        $(window).on('load resize', function () {
            $edd_list = $($edd_list.selector);
            $edd_list.filter('div[style="clear:both;"], .edd_list_divider').remove();
            $edd_list = $($edd_list.selector);
            var $wv = viewport().width;
            switch (true) {
                case ( $wv < 783 ) :
                    $edd_list.after('<span class="edd_list_divider"></span>');
                    break;
                case ( $wv >= 783 && $wv < 1240 ) :
                    $edd_list.filter(':odd').after('<span class="edd_list_divider"></span>');
                    break;
                case ( $wv >= 1240 ) :
                    $edd_list.filter(':nth-child(3n)').after('<span class="edd_list_divider"></span>');
                    break;
            }
        });

        // Top Slider buttons
        $('.ts-btn.ts-appointment').click(function () {
            $( location ).attr( 'href', $('body').attr('data-url') + '/appointment/');
        });

        $('.ts-btn.ts-testimonials').click(function () {
            if ( $('#testimonials').length ) {
                $( location ).attr( 'href', $('body').attr('data-url') + '#testimonials');
            } else {
                $( location ).attr( 'href', $('body').attr('data-url') + '/contact/');
            }
        });

        $('.ts-btn.ts-about').click(function () {
            $( location ).attr( 'href', $('body').attr('data-url') + '/contact/');
        });

        // 404
        $('.error-404 .search-form .search-field')
            .wrap('<div class="iconed-field-right alt rt2 rt2-icon-pen2 go-home-field"></div>');

        $('.error404 .search-form').attr('name', 'errorform');
        var go_home_field = $('.go-home-field');
        go_home_field.click(function (e) {
            if ( ( e.offsetX + 45 > go_home_field.width() ) && ( e.offsetX < go_home_field.width() - 13 ) ) {
                document.forms.errorform.submit();
            }
        });

        $('.go-home').click(function () {
            $( location ).attr( 'href', $('body').attr('data-url') );
        });

        // mailchimp icon clickable
        $('form.mc4wp-form').attr('name', 'mc4wpform');
        var mc4wp_form_iconed = $('form.mc4wp-form .iconed-field-right');
        mc4wp_form_iconed.click(function (e) {
            if ( ( e.offsetX + 61 > mc4wp_form_iconed.width() ) && ( e.offsetX < mc4wp_form_iconed.width() - 39 ) ) {
                document.forms.mc4wpform.submit();
            }
        });

        // Remove main menu hints
        $('.main-nav .menu-item a').removeAttr('title');

        // Custom Select
        $('.special-side select,' +
            '.widget_archive select,' +
            '.widget_categories select,' +
            '#edd_profile_editor_form select')
            .wrap('<div class="custom-select-right rt2 rt2-icon-chevron-small-down w"></div>');


        /**
         *  Extended
         */

        // Active class for iconed fields if focused/unfocused
        $( '.iconed-field-left input, .iconed-field-left textarea, .iconed-field-right input, .iconed-field-right textarea' )
            .on('focus blur', function() {
                $(this).parent().toggleClass('active');
        });

        // .disabled & .textarea classes for iconed elements
        var elem_enabled = true;
        $('.iconed-button-left,' +
            '.iconed-button-right,' +
            '.iconed-field-left,' +
            '.iconed-field-right,' +
            '.custom-select-left,' +
            '.custom-select-right').each( function () {

            var disElem = $(this).find(
                'input[disabled],' +
                'textarea[disabled],' +
                'select[disabled]');
            if( disElem.length ){
                $(this).addClass('disabled');
                elem_enabled = false;
            } else {
                elem_enabled = true;
            }

            disElem = $(this).find('textarea');
            if( disElem.length ){
                $(this).addClass('textarea');
            }

            if( elem_enabled ) {
                $(this).on('mouseenter', function () {
                    $(this).addClass('hover');
                });
                $(this).on('mouseleave', function () {
                    $(this).removeClass('hover');
                });
            }

        });

        //hidding menu elements that do not fit in menu width
        window.menuHideExtraElements = function() {
            var wrapperWidth = jQuery('.main-nav ul').width();
            var summaryWidth = 155;
            var $liElements = jQuery('.main-nav > ul > li');
            $liElements.each(function(index) {
				// Get full width of each LI element
                summaryWidth += jQuery(this).outerWidth(true);
                if(summaryWidth > wrapperWidth) {
                    $liElements.removeClass('md-hidden');
                    var $newLi = jQuery('<li id="more-li"><a><i class="fa fa-bars"></i></a><ul class="sub-menu"></ul></li>');
					jQuery($liElements[index+1]).before($newLi);
					var $extraLiElements = $liElements.filter(':gt('+(index-1)+')');
                    $extraLiElements.clone().appendTo($newLi.find('ul'));
                    $extraLiElements.addClass('md-hidden');
                    return false;
                }
            });
        }
        menuHideExtraElements();
        jQuery(window).on('resize', function() {
            jQuery('#more-li').remove();
            menuHideExtraElements();
        });
    });

    jQuery(window).load(function () {

        // Sticky Sidebar
        var stickyParentRow = $(".post-container > .row > .col-sm-8"),
            stickySidebar = $(".sidebar-sticky");

        function detachSidebar() {
            if( 768 > $(window).width() ) {
                stickySidebar.trigger("sticky_kit:detach");
            }
        }
        function stickyAdminBarFix() {
            var window_w = $(window).width();
            if ( $('body').hasClass('admin-bar') ) {
                if( 768 < window_w ) {
                    return 32;
                }
            }
            return 0;
        }

        if( stickyParentRow.length && ( viewport().width >= 768 ) ) {
            stickySidebar.stick_in_parent({
                offset_top: stickyAdminBarFix(),
                parent: ".content-area",
                spacer: false
            }).on("sticky_kit:bottom", function () {
                $(this).parent().css("position", "static")
            }).on("sticky_kit:unbottom", function () {
                $(this).parent().css("position", "relative")
            });
            detachSidebar();
        }


        //Placeholder cleaning on focus
        var $ph = $('input[type="search"],' +
            ' input[type="text"],' +
            ' input[type="url"],' +
            ' input[type="number"],' +
            ' input[type="email"],' +
            ' input[type="tel"],' +
            ' textarea');
        $ph.each(function() {
            $(this).data('holder',$(this).attr('placeholder'));

            $(this).focusin(function(){
                $(this).attr('placeholder','');
            });
            $(this).focusout(function(){
                $(this).attr('placeholder',$(this).data('holder'));
            });

        });

        // Gallery Owl Carousel initiation
        $('.owl-gallery').owlCarousel({
            //rtl:true,
            margin:0,
            items:1,
            loop:true,
            autoHeight : true,
            navText: [
                "<i class='rt2 rt2-icon-chevron-thin-left'></i>",
                "<i class='rt2 rt2-icon-chevron-thin-right'></i>"
            ],
            responsiveClass:true,
            responsiveBaseElement:".footer",
            responsive:{
                0:{
                    dots:false,
                    nav: false
                },
                955:{
                    dots:true,
                    nav: true
                }
            }
        });

        // portfolio-categories active by default
        $('.categories-item.all').addClass('active');


    });

    $( window ).resize(function() {

        // video-container size adjustment
        $('.owl-carousel .video-container iframe').each( function() {
            $( this ).height( $( this ).outerWidth() * 0.666667 );
        });
    });

    $(window).on('load scroll', function() {

        // Make menu-strip slim on scroll.
        var scroll_top = $( window ).scrollTop();
        if( scroll_top < 34 ){
            $('body.home .menu-strip').removeClass('slim');
        }
        if( scroll_top != 0 ){
            $('.is-sticky .menu-strip').addClass('slim');
        }
    });

})(jQuery);


// Viewport dimensions granting scrollbars
function viewport() {
    "use strict";
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

