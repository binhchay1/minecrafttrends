(function($) {
  "use strict";

  var windowOn = $(window);


  // Home tabs
  $('.tabs .tab-links a').on('click', function(e) {
      var currentAttrValue = $(this).attr('href');

      // Show/Hide Tabs
      $('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();

      // Change/remove current tab to active
      $(this).parent('li').addClass('active').siblings().removeClass('active');

      e.preventDefault();
  });



//  Preloader

      $('#preloader').fadeOut('slow', function() {
        $(this).remove();
    });


// --======== Scroll to #wrapper-content ========-- //

document.querySelectorAll('a[href*="#wrapper-content"]').forEach(anchor => {
    
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});


  // Social sidebar tabs
  $('.socialtabs .tab-links a').on('click', function(e) {

      var currentAttrValue = $(this).attr('href');

      // Show/Hide Tabs
      $('.socialtabs ' + currentAttrValue).fadeIn(400).siblings().hide();

      // Change/remove current tab to active
      $(this).parent('li').addClass('active').siblings().removeClass('active');

      e.preventDefault();
  });


  // Game tabs
  $('#gametabs .tab-links a').on('click', function(e) {
      var currentAttrValue = $(this).attr('href');

      // Show/Hide Tabs
      $('#gametabs ' + currentAttrValue).fadeIn(400).siblings().hide();

      // Change/remove current tab to active
      $(this).parent('li').addClass('active').siblings().removeClass('active');

      e.preventDefault();
  });


  //Responsive iframe - HTML Games
  $('.td-embed-container').fitFrame();


  // Lights On / Off
  $('embed, iframe').allofthelights({
      'is_responsive': false,
      'switch_selector': 'td-light-off',
      'callback_turn_off': function() {
          $("h1, #content-arcade .widget-title, .td-game-ad-space").addClass('light');
      },
      'callback_turn_on': function() {
          $("h1, #content-arcade .widget-title, .td-game-ad-space").removeClass('light');
      }
  });


  // Full screen
  $('#full-screen').click(function(e) {
    $('.fitframe-wrap iframe').toggleClass('fullscreen');
    $('#full-screen').toggleClass('fixx');
});


  // hover class for module 8
  $('.td-post-details-8').hover(
      function() {
          $(this).addClass('no-shape')
      },
      function() {
          $(this).removeClass('no-shape')
      }
  )

  // search toggle
  $(".click-search").click(function() {
      $(".td-expand").slideToggle(0);
  });

  // Newsticker
  jQuery(".modern-ticker").modernTicker({
      effect: "slide",
      scrollType: "continuous",
      scrollStart: "inside",
      scrollInterval: 20,
      transitionTime: 300,
      linksEnabled: true,
      pauseOnHover: true,
      autoplay: true
  });

  // Flexslider
  $('.flexslider').flexslider({
      animation: "fade",
      slideshow: true,
      slideshowSpeed: 4000,
      animationSpeed: 600,
      pauseOnHover: true,
      useCSS: false,
      prevText: "<i class='fas fa-chevron-left'></i>",
      nextText: "<i class='fas fa-chevron-right'></i>"
  });

  // Facebook Like box
  (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.async = true;
      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=170983219647466&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // making fitvids to work only on max-width: 767px

  $(window).resize(function() {
      if (window.matchMedia('(max-width: 767px)')) {
          $(".showfitvids").fitVids();
      }
  });


  // Reponsive game video iframe https://gist.github.com/aarongustafson/1313517
  function adjustIframes() {

      $('.myarcade-video iframe').each(function() {
          var
              $this = $(this),
              proportion = $this.data('proportion'),
              w = $this.attr('width'),
              actual_w = $this.width();

          if (!proportion) {
              proportion = $this.attr('height') / w;
              $this.data('proportion', proportion);
          }

          if (actual_w != w) {
              $this.css('height', Math.round(actual_w * proportion) + 'px');
          }
      });
  }
  $(window).on('resize load', adjustIframes);



  // FitVids - Target content div.
  $("#homepage-wrap, #widgets, #content").fitVids();

  // Vertical Ticker
  $('#vertical-ticker').totemticker({
      row_height: '133px',
      speed: 500,
      interval: 5000
  });

  // Owl Carousel Sidebar
  $("#owl-sidebar").owlCarousel({
      slideSpeed: 300,
      paginationSpeed: 500,
      autoPlay: 4000,
      singleItem: true
  });

  $("#owl-home").owlCarousel({
      items: 3,
      slideSpeed: 300,
      paginationSpeed: 500,
      autoPlay: 2000,
      navigation: false,
      pagination: false,
      stopOnHover: true,
      goToFirstSpeed: 2000
  });

  $("#owl-home-carousel").owlCarousel({
      items: 1,
      autoPlay: true,
      navigation: true,
    //   autoWidth: true,
      pagination: false,
      navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
      goToFirstSpeed: 2000,
      margin:50,
      loop: true,
      stagePadding: 310,
      center: true,
      responsive : {
        // breakpoint from 0 up
        0 : {
            items: 1,
            stagePadding: 0,
        },
        // breakpoint from 768 up
        768 : {
            items: 1,
        }
    }

  });

  
  // Sticky menu
  $(".td-sticky").sticky({
      topSpacing: 0
  });

  $(".sticky-active").sticky({
      topSpacing: 0
  });


// Sticky Sidebar
if ($(".td-sticky")[0]) { //different topspacing if menu is stiky
    $('.td-sidebar-sticky').stickybar({
        topSpacing: 90, // Space between element and top of the viewport
        zIndex: 1, // z-index
        stopper: "#td-sticky-stopper" // Id, class, or number value
    });
} else {
    $('.td-sidebar-sticky').stickybar({
        topSpacing: 35, // Space between element and top of the viewport
        zIndex: 100, // z-index
        stopper: "#td-sticky-stopper" // Id, class, or number value
    });
}
    

  /**
   * Copyright 2012, Digital Fusion
   * Licensed under the MIT license.
   * http://teamdf.com/jquery-plugins/license/
   *
   * @author Sam Sehnert
   * @desc A small plugin that checks whether elements are within
   *     the user visible viewport of a web browser.
   *     only accounts for vertical position, not horizontal.
   */

  $.fn.visible = function(partial) {

      var $t = $(this),
          $w = $(window),
          viewTop = $w.scrollTop(),
          viewBottom = viewTop + $w.height(),
          _top = $t.offset().top,
          _bottom = _top + $t.height(),
          compareTop = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;

      return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };


  // Fly-in effect
  var win = $(window);

  var allMods = $(".td-fly-in");

  // Already visible modules
  allMods.each(function(i, el) {

      if ($(el).visible(true)) {
          $(el).addClass("already-visible");
      }

  });

  win.scroll(function(event) {

      allMods.each(function(i, el) {

          var el = $(el);

          if (el.visible(true)) {
              el.addClass("td-fly-in-effect");
          } else {
              el.removeClass("td-fly-in already-visible");
          }

      });

  });

  // Nicescroll for SEO block
  $("#td-seo-block").niceScroll({
      cursorwidth: 15,
      railpadding: {
          top: 0,
          right: 0,
          left: 0,
          bottom: 0
      },
      cursorborder: 0,
      scrollspeed: 2500,
      background: "#F1F2F7",
      cursorborderradius: 0,
      cursorcolor: "#63676C",
      autohidemode: false,
      cursorfixedheight: 20,
      horizrailenabled: false
  });

  // Scrolling to the Top and Bottom: http://tympanus.net/codrops/2010/01/03/scrolling-to-the-top-and-bottom-with-jquery/


  $('#scroll_up').fadeIn('slow');
  $('#scroll_down').fadeIn('slow');

  $(window).bind('scrollstart', function() {
      $('#scroll_up,#scroll_down').stop().animate({
          'opacity': '1'
      });
  });
  $(window).bind('scrollstop', function() {
      $('#scroll_up,#scroll_down').stop().animate({
          'opacity': '0'
      });
  });

  $('#scroll_down').click(
      function(e) {
          $('html, body').animate({
              scrollTop: $(document).height()
          }, 800);
      }
  );
  $('#scroll_up').click(
      function(e) {
          $('html, body').animate({
              scrollTop: '0px'
          }, 800);
      }
  );


  // Add a class to all linked images to initialize magnific popup
  $('img').parent('.td-content-inner-single a, .td-screens-popup a').addClass('td-popup-image');
  // disable magnific popup for linked images that have td-no-lightbox class
  $('img').parent('.td-no-lightbox, .td-no-lightbox a').removeClass('td-popup-image');



  // Initializing Magnific Popup
  if ($('.td-lightbox-feat').length) {
      $('.post-entry, .td-screens-popup').magnificPopup({
          delegate: '.td-popup-image', // child items selector, by clicking on it popup will open
          type: 'image',
          gallery: {
              enabled: true
          },
          zoom: {
              enabled: true,
              duration: 300,
              opener: function(element) {
                  return element.find("img");
              }
          },
      });
  }


  // Mobile Menu
  $('#top-menu .open-menu').on('click', function() {
      $('body').addClass('mobile-menu-active');
      $('#mobile-menu-background').addClass('menu-active');
      $('#mobile-menu').addClass('menu-active');
  });

  $('#close-menu').on('click', function() {
      $('body').removeClass('mobile-menu-active');
      $('#mobile-menu-background').removeClass('menu-active');
      $('#mobile-menu').removeClass('menu-active');
  });

  $('#mobile-navigation .menu-item.menu-item-has-children').on('click', function(e) {
      e.stopPropagation();
      $(this).toggleClass('sub-menu-active');
      $(this).find('ul.sub-menu:first').toggleClass('sub-menu-active');
  });


// fade out scroll to top

  windowOn.on('scroll', function() {
    var scroll = $(window).scrollTop();
    if (scroll < 100) {
        $(".scrollpage").fadeOut();
    } else {
        $(".scrollpage").fadeIn();
    }
});

// Autohide menu when scrolling 
jQuery(document).ready(function($){
	var mainHeader = $('.td-auto-hide-header'),
		secondaryNavigation = $('.cd-secondary-nav'),
		//this applies only if secondary nav is below intro section
		belowNavHeroContent = $('.sub-nav-hero'),
		headerHeight = mainHeader.height();
	
	//set scrolling variables
	var scrolling = false,
		previousTop = 0,
		currentTop = 0,
		scrollDelta = 10,
		scrollOffset = 150;

	mainHeader.on('click', '.nav-trigger', function(event){
		// open primary navigation on mobile
		event.preventDefault();
		mainHeader.toggleClass('nav-open');
	});

	$(window).on('scroll', function(){
		if( !scrolling ) {
			scrolling = true;
			(!window.requestAnimationFrame)
				? setTimeout(autoHideHeader, 250)
				: requestAnimationFrame(autoHideHeader);
		}
	});

	$(window).on('resize', function(){
		headerHeight = mainHeader.height();
	});

	function autoHideHeader() {
		var currentTop = $(window).scrollTop();

		( belowNavHeroContent.length > 0 ) 
			? checkStickyNavigation(currentTop) // secondary navigation below intro
			: checkSimpleNavigation(currentTop);

	   	previousTop = currentTop;
		scrolling = false;
	}

	function checkSimpleNavigation(currentTop) {
		//there's no secondary nav or secondary nav is below primary nav
	    if (previousTop - currentTop > scrollDelta) {
	    	//if scrolling up...
	    	mainHeader.removeClass('is-hidden');
	    } else if( currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
	    	//if scrolling down...
	    	mainHeader.addClass('is-hidden');
	    }
	}

	function checkStickyNavigation(currentTop) {
		//secondary nav below intro section - sticky secondary nav
		var secondaryNavOffsetTop = belowNavHeroContent.offset().top - secondaryNavigation.height() - mainHeader.height();
		
		if (previousTop >= currentTop ) {
	    	//if scrolling up... 
	    	if( currentTop < secondaryNavOffsetTop ) {
	    		//secondary nav is not fixed
	    		mainHeader.removeClass('is-hidden');
	    		secondaryNavigation.removeClass('fixed slide-up');
	    		belowNavHeroContent.removeClass('secondary-nav-fixed');
	    	} else if( previousTop - currentTop > scrollDelta ) {
	    		//secondary nav is fixed
	    		mainHeader.removeClass('is-hidden');
	    		secondaryNavigation.removeClass('slide-up').addClass('fixed'); 
	    		belowNavHeroContent.addClass('secondary-nav-fixed');
	    	}
	    	
	    } else {
	    	//if scrolling down...	
	 	  	if( currentTop > secondaryNavOffsetTop + scrollOffset ) {
	 	  		//hide primary nav
	    		mainHeader.addClass('is-hidden');
	    		secondaryNavigation.addClass('fixed slide-up');
	    		belowNavHeroContent.addClass('secondary-nav-fixed');
	    	} else if( currentTop > secondaryNavOffsetTop ) {
	    		//once the secondary nav is fixed, do not hide primary nav if you haven't scrolled more than scrollOffset 
	    		mainHeader.removeClass('is-hidden');
	    		secondaryNavigation.addClass('fixed').removeClass('slide-up');
	    		belowNavHeroContent.addClass('secondary-nav-fixed');
	    	}

	    }
	}
});


  // qtip2 tooltip
  $('div[title!=""]').qtip({

      position: {
          effect: false,
          my: 'center left', // Position my top left...
          at: 'center right', // at the bottom right of...
          target: 'mouse', // Track the mouse as the positioning target
          adjust: {
              x: 60,
              y: 40
          } // Offset it slightly from under the mouse
      }

  });


})(jQuery);