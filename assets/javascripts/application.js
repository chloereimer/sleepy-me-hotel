SleepyMe = {};

SleepyMe.initializeStickyFooter = function(){

  $(window).resize(function(){

    htmlHeight = $('html').height();
    viewportHeight = $(window).height();

    if ($('.site-footer').hasClass('sticky-bottom')) {
      htmlHeight += $('.site-footer').outerHeight()
    }

    if (viewportHeight > htmlHeight) {
      $('.site-footer').addClass('sticky-bottom')
    } else {
      $('.site-footer').removeClass('sticky-bottom')
    }

  });

  $(window).resize();
  
};
