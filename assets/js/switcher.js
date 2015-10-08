// Style Switcher http://sam.zoy.org/wtfpl/
/*global Cookies:false */

(function($) {
  'use strict';

  var $body = $('body');
  var $navbar = $body.find('> .navbar').eq(0);
  var $colors = $('[id^=switcher-color]');
  var $navbarDefault = $('#switcher-navbar-default').tooltip({
                         title: '.navbar-inverse',
                         placement: 'bottom',
                         delay: 200
                       });
  var $CSSLink = $('link[href*="assets/css/bootstrap"]');
  var rootPath = $CSSLink[0].href
                   .replace(location.protocol + '//' + location.host, '')
                   .replace(/assets\/css.*/, '');
  var cookieOptions = {path: rootPath, expires: 2592000 /* 30 days*/};

  setupEvents();
  restoreSettings();

  function setupEvents() {

    $colors.click(function() {
      var $this = $(this);
      var newColor = $this.data('color');

      if ($this.hasClass('active')) {
        return;
      }

      changeColor(newColor);

      Cookies.set('color', newColor, cookieOptions);
    });

    $navbarDefault.click(function() {
      var tooltipTitle, navbarDefault;

      $navbar.toggleClass('navbar-inverse').toggleClass('navbar-default');
      if (!$navbar.hasClass('navbar-inverse')) {
        tooltipTitle = 'navbar-inverse';
        navbarDefault = 'y';
      } else {
        tooltipTitle = 'navbar-default';
        navbarDefault = 'n';
      }
      $(this).attr('data-original-title', tooltipTitle);
      Cookies.set('navbarDefault', navbarDefault, cookieOptions);
    });

  }

  function changeColor(newColor) {
    var fileName, bodyClass;
    var $color = $('#switcher-color-' + newColor);

    if (newColor === 'default') {
      fileName = 'bootstrap.css';
    } else {
      fileName = 'bootstrap-' + newColor + '.css';
      bodyClass = 'color-' + newColor;
    }
    $CSSLink.attr('href', rootPath + 'assets/css/' + fileName);

    $colors.find('.fa-check').attr('class', 'fa fa-square');
    $color.siblings('.active').removeClass('active');
    $color.addClass('active').find('.fa').attr('class', 'fa fa-check');

    $body.removeClass('color-red color-green');
    if (bodyClass) {
      $body.addClass(bodyClass);
    }
  }

  function restoreSettings() {
    var defaults = {
      navbarDefault: 'y',
      color: 'default'
    };
    var navbarDefault = Cookies.get('navbarDefault') || defaults.navbarDefault;
    var color = Cookies.get('color') || defaults.color;

    if (navbarDefault !== defaults.navbarDefault) {
      $navbarDefault.click();
    }
    if (color !== defaults.color) {
      changeColor(color);
    }
  }
})(jQuery);
