(function ($) {
  $(window).on('load', function () {
    overrideWooCommerceScroll();
  });

  function overrideWooCommerceScroll() {
    $.scroll_to_notices = function () {
      $('html, body').animate(
        {
          scrollTop: 0,
        },
        300,
      );
    };
  }
})(jQuery);
