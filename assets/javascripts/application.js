SleepyMe = {};

SleepyMe.initializeStickyFooter = function(){

  console.log('inside initializeStickyFooter');

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

    console.log('inside window resize');

  });

  $(window).resize();

  console.log('after resize');
  
};