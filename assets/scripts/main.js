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

  MAIN.setMenu = function()
  {
    var m = $('#icon-menu'),
        d = $('.dropdown-toggle'),
        n = $('.nav-primary'),
        w = $(window),
        b = $('body'),
        menuAction;

    function togglePos() {
      var g = 40,
          wh = w.height();
      n.each(function(i) {
        var nh = $(this).height();
        if (wh <= nh + (g * 2)) {
          $('body').addClass('is-menu-overflow');
        } else {
          $('body').removeClass('is-menu-overflow');
        }
      });
    }

    function checkHeight() {
      d.each(function() {
        var dh = $(this).height();
        if (dh > 0) {
          clearInterval(menuAction);
          togglePos();
          return;
        }
      });
    }

    function onStartTimer() {
      togglePos();
      clearInterval(menuAction);
      menuAction = setInterval(checkHeight, 100);
    }

    if (window.matchMedia('(min-width:769px)').matches) {
      d.on('click', onStartTimer);
      w.on('resize', togglePos).trigger('resize');
    }

    m.on('click', function() {
		  $(this).toggleClass('is-open');
      n.toggleClass('is-open');
      b.toggleClass('is-fixed');
	  });
  };

  MAIN.setSVGFallback = function()
  {
    if (!feature.svg) {
      $('img').each(function() {
        $(this).attr('src', $(this).attr('src').replace(/\.svg/gi,'.png'));
      });
    }
  };

  MAIN.setMaplace = function()
  {
    console.log('loaded');
    new Maplace({
      map_div: '#gmaps',
      locations: [
        {
          title: 'Asyl inc.',
          lat: 35.6937166,
          lon: 139.7607625,
          zoom: 18
        }
      ],
      map_options: {
        set_center: [35.6937166, 139.7607625],
        zoom: 17,
        scrollwheel: false
      },
      styles: {
        'Bluish': [{'stylers':[{'hue':'#007fff'},{'saturation':89}]},{'featureType':'water','stylers':[{'color':'#ffffff'}]},{'featureType':'administrative.country','elementType':'labels','stylers':[{'visibility':'off'}]}]
      }
    }).Load();
  };

  MAIN.setPageTop = function()
  {
    var p = $('.pagetop'),
        c = $('.copyright'),
        w = $(window);

    w.on('resize', function(){
      if (window.matchMedia('(min-width: 768px)').matches) {
        w.on('scroll', function(){
          t = w.scrollTop();
          if (t === 0) {
            p.hide();
            c.show();
          } else if (t >= 1) {
            p.show();
            c.hide();
          }
        }).trigger('scroll');
      } else if (window.matchMedia('(max-width: 768px)').matches) {
        p.hide();
      }
    }).trigger('resize');
  };

  MAIN.setSmoothScroll = function()
  {
    $('a[href*="#"]:not([href="#"]):not([data-toggle="collapse"])').click(function () {
      var href = $(this).attr('href'),
          target = $(href === '#' || href === '' ? 'html' : href),
          offset = -60,
          duration = 500,
          easing = 'easeInOutQuart';
      if (target.id === 'pagetop') {
        target.velocity('scroll', { duration: duration, easing: easing });
      } else {
        target.velocity('scroll', { duration: duration, easing: easing,  offset: offset });
      }
      return false;
    });
  };

  MAIN.setIas = function()
  {
    var ias = $.ias({
      container:      '.works-body',
      item:           '.works-item',
      pagination:     '.pagination',
      next:           '.nav-links .next',
      negativeMargin: 200
    });

    ias.extension(new IASSpinnerExtension({
      src: '/assets/images/loading.svg', // optionally
    }));
  };

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var ASYL = {
    'common': {
      init: function() {
        MAIN.setSVGFallback();
        MAIN.setPageTop();
        MAIN.setSmoothScroll();
        MAIN.setMenu();
      },
      finalize: function() {
      }
    },
    'home': {
      init: function() {
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
        MAIN.setMaplace();
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = ASYL;
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
