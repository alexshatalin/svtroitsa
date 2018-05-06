var shuffleme = (function( jQuery ) {
  'use strict';
  var jQuerygrid = jQuery('#grid'), //locate what we want to sort 
      jQueryfilterOptions = jQuery('.portfolio-sorting li'),  //locate the filter categories
      jQuerysizer = jQuerygrid.find('.shuffle_sizer'),    //sizer stores the size of the items

  init = function() {

    // None of these need to be executed synchronously
    setTimeout(function() {
      listen();
      setupFilters();
    }, 100);

    // instantiate the plugin
    jQuerygrid.shuffle({
      itemSelector: '[class*="col-"]',
      sizer: jQuerysizer    
    });
  },

      

  // Set up button clicks
  setupFilters = function() {
    var jQuerybtns = jQueryfilterOptions.children();
    jQuerybtns.on('click', function(e) {
      e.preventDefault();
      var jQuerythis = jQuery(this),
          isActive = jQuerythis.hasClass( 'active' ),
          group = isActive ? 'all' : jQuerythis.data('group');

      // Hide current label, show current label in title
      if ( !isActive ) {
        jQuery('.portfolio-sorting li a').removeClass('active');
      }

      jQuerythis.toggleClass('active');

      // Filter elements
      jQuerygrid.shuffle( 'shuffle', group );
    });

    jQuerybtns = null;
  },

  // Re layout shuffle when images load. This is only needed
  // below 768 pixels because the .picture-item height is auto and therefore
  // the height of the picture-item is dependent on the image
  // I recommend using imagesloaded to determine when an image is loaded
  // but that doesn't support IE7
  listen = function() {
    var debouncedLayout = jQuery.throttle( 300, function() {
      jQuerygrid.shuffle('update');
    });

    // Get all images inside shuffle
    jQuerygrid.find('img').each(function() {
      var proxyImage;

      // Image already loaded
      if ( this.complete && this.naturalWidth !== undefined ) {
        return;
      }

      // If none of the checks above matched, simulate loading on detached element.
      proxyImage = new Image();
      jQuery( proxyImage ).on('load', function() {
        jQuery(this).off('load');
        debouncedLayout();
      });

      proxyImage.src = this.src;
    });

    // Because this method doesn't seem to be perfect.
    setTimeout(function() {
      debouncedLayout();
    }, 500);
  };      

  return {
    init: init
  };
}( jQuery ));

jQuery(document).ready(function()
{
  shuffleme.init(); //filter portfolio
});