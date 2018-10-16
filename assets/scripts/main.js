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

(function ($) {

  var MAIN = {};

  MAIN.setMenu = function () {
    var m = $('#icon-menu'),
      d = $('.dropdown-toggle'),
      n = $('.nav-primary'),
      w = $(window),
      b = $('body');

    m.on('click', function () {
      $(this).toggleClass('is-open');
      n.toggleClass('is-open');
      b.toggleClass('is-fixed');
      return false;
    });

    d.on('click', function () {
      $(this).parent('.dropdown').toggleClass('open');
      return false;
    });
  };

  MAIN.setIas = function () {
    var ias = $.ias({
      container: '.works-body',
      item: '.works-item',
      pagination: '.pagination',
      next: '.nav-links .next',
      negativeMargin: 600
    });

    ias.extension(new IASSpinnerExtension({
      src: '/assets/images/loading.svg'
    }));

    ias.extension(new IASTriggerExtension({
      text: 'More'
    }));
  };

  MAIN.setIasArticle = function () {
    var ias = $.ias({
      container: '.entry-container',
      item: '.entry-body',
      pagination: '.pagination',
      next: '.next-works',
      negativeMargin: 600
    });

    ias.extension(new IASSpinnerExtension({
      src: '/assets/images/loading.svg'
    }));

    ias.extension(new IASTriggerExtension({
      text: 'Next'
    }));
  };

  MAIN.setVideo = function () {
    var i = $('.item-video');
    i.each(function () {
      console.log('setVideo');
      var v = $(this).find('video');
      v.on('click', function () {
        if ($(this)[0].paused) {
          $(this)[0].play();
        } else {
          $(this)[0].pause();
        }
      });
    });
  };

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var STUDIOPT = {
    'common': {
      init: function () {
        MAIN.setMenu();
      },
      finalize: function () {
      }
    },
    'home': {
      init: function () {
        MAIN.setIas();
      },
      finalize: function () {
      }
    },
    'post_type_archive': {
      finalize: function () {
        MAIN.setIas();
      }
    },
    'single_works': {
      finalize: function () {
        MAIN.setIasArticle();
        MAIN.setVideo();
      }
    },
    'contact': {
      init: function () {
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function (func, funcname, args) {
      var fire;
      var namespace = STUDIOPT;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function () {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
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
