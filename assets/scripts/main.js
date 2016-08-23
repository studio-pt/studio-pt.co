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

  MAIN.setFreewall = function()
  {
    var init = true;
    var wall = new Freewall('.posts');

    var opt = {
      gutter : 30,
      screen : {
        breakpoint: 768
      }
    };

    if (feature.css3Dtransform) {
      $('html').addClass('css3Dtransform');
      var sr = new ScrollReveal({
        scale: 1,
        distance: '0',
        duration: 500,
        easing: 'cubic-bezier(0.165, 0.84, 0.44, 1)',
        mobile: false
      });
    }

    var cellSize = function(containerWidth) {
      var colNum;
      var single = $('body').hasClass('single');

      if (containerWidth < opt.screen.breakpoint) {
        colNum = 2;
        wall.container.attr("class", "posts-sm");
      } else {
        if (single) {
          colNum = 5;
        } else {
          colNum = 4;
        }
        wall.container.attr("class", "posts-lg");
      }
      return (containerWidth / colNum) - opt.gutter;
    };

    wall.container.imagesLoaded(function() {
      wall.reset({
        selector: '.post-item',
        cellW: cellSize,
        cellH: 'auto',
        gutterX: opt.gutter,
        gutterY: opt.gutter,
        cacheSize: false,
        animate: false,
        onResize: function (container) {
          if (window.matchMedia('(max-width: 767px)').matches){
            container.attr('class', 'posts posts-sm');
          } else {
            container.attr('class', 'posts posts-lg');
          }
          wall.fitWidth();
        }
      });
      wall.fitWidth();
      if (feature.css3Dtransform && init) {
        sr.reveal('.post-item');
        init = false;
      }
    });

    var ias = $.ias({
      container:      '.posts',
      item:           '.post-item',
      pagination:     '.pagination',
      next:           '.nav-links .next',
      negativeMargin: 1024
    });

    ias.extension(new IASSpinnerExtension({
      src: '/assets/images/loading.svg', // optionally
    }));

    ias.on('rendered', function(items) {
      $(items).imagesLoaded(function() {
        wall.fitWidth();
        if (feature.css3Dtransform) {
          sr.sync();
        }
      });
    });
  };

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var ASYL = {
    'common': {
      init: function() {
        MAIN.setSVGFallback();
        MAIN.setPageTop();
        MAIN.setSmoothScroll();
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
        //MAIN.setFreewall();
      }
    },
    'single_works': {
      finalize: function() {
        //MAIN.setFreewall();
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
