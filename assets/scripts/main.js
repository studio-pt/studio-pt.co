/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference $ with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  var MAIN = {};

  MAIN.setCoverVideo = function()
  {
    var wh = $(window).height();
    var ct = $('.cover-label, .cover-down');
    var cp = $('.cover-poster');
    var v = $('.cover-poster > video');
    var vpc = $('#vpc'), vsp = $('#vsp');

    if (window.matchMedia('(max-width:768px)').matches) {
      try {
        vsp[0].play();
      } catch (e) {
        console.log("vsp play error");
      }
      vsp.on('canplay', function(){
        if (vsp.is(':hidden')) {
          vsp.css('display','inline-block');
        }
        if (ct.is(':hidden')) {
          ct.show();
        }
      });
      //console.log("vsp done");
    } else if (window.matchMedia('(min-width:769px)').matches) {
      vpc.on('canplay', function(){
        if (vpc.is(':hidden')) {
          vpc.css('display','block');
        }
        if (ct.is(':hidden')) {
          ct.show();
        }
      });
      try {
        vpc[0].play();
      } catch (e) {
        console.log("vpc play error");
      }
      //console.log("vpc done");
    }

    if (feature.touch && window.matchMedia('(max-width:768px)').matches) {
      cp.css('height', wh);
    }
  };

  MAIN.setSVGFallback = function()
  {
    if (!feature.svg) {
      $('img').each(function() {
        $(this).attr('src', $(this).attr('src').replace(/\.svg/gi,'.png'));
      });
    }
  };

  MAIN.setMenu = function()
  {
    var m = $('#icon-menu'),
        n = $('.nav-primary'),
        w = $(window),
        b = $('body');

    m.on('click', function() {
		  $(this).toggleClass('is-open');
      n.toggleClass('is-open');
      b.toggleClass('is-fixed');
	  });
  };

  MAIN.setPageScroll = function()
  {
    $('a[href*="#"]:not([href="#"])').click(function () {
      var href = $(this).attr('href'),
          target = $(href === '#' || href === '' ? 'html' : href),
          duration = 500,
          easing = 'easeInOutQuart';
      target.velocity('scroll', { duration: duration, easing: easing });
      return false;
    });
  };

  MAIN.setCoverScroll = function()
  {
    $('.cover-trigger').click(function () {
      var href = $(this).attr('data-href'),
          target = $(href === '#' || href === '' ? 'html' : href),
          duration = 500,
          easing = 'easeInOutQuart';
      target.velocity('scroll', { duration: duration, easing: easing });
      return false;
    });

      $(window).on('scroll', function() {
        var t = $(this).scrollTop() / 10;
        $('.cover-down').css({'opacity': 1 - (t / 100)});
        //if (!feature.touch) {
          $('.cover-label > img').css({
            'transform': 'rotateX(' + t + 'deg) rotateY(' + t + 'deg) rotateZ(' + t + 'deg)',
            'opacity': 1 - (t / 100)
          });
        //}
      });
  };

  MAIN.setIas = function()
  {
    var ias = $.ias({
      container:      '.works-body',
      item:           '.works-item',
      pagination:     '.pagination',
      next:           '.nav-links .next',
      negativeMargin: 600
    });

    ias.extension(new IASSpinnerExtension({
      src: '/assets/images/loading.svg'
    }));

    ias.extension(new IASTriggerExtension({
    text: 'More'
    }));
  };

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var HOEDOWN = {
    'common': {
      init: function() {
        MAIN.setSVGFallback();
        MAIN.setMenu();
        // MAIN.setPageScroll();
      },
      finalize: function() {
      }
    },
    'home': {
      init: function() {
        MAIN.setCoverVideo();
        MAIN.setCoverScroll();
        MAIN.setIas();
      },
      finalize: function() {
      }
    },
    'post_type_archive': {
      finalize: function() {
        MAIN.setIas();
      }
    },
    'single_works': {
      finalize: function() {
        MAIN.setIas();
      }
    },
    'contact': {
      init: function() {
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = HOEDOWN;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})($); // Fully reference $ after this point.
