(function ($) {
  $(document).ready(function () {
    headerHomeScroll();
  });

  function headerHomeScroll() {
    const $header = $('#header');

    if (!$header.hasClass('absolute-header')) {
      return;
    }

    let headerTop = $header.offset().top;

    $(window).on('scroll', function () {
      if ($(window).scrollTop() >= headerTop) {
        $header.removeClass('absolute-header');
      } else {
        $header.addClass('absolute-header');
      }
    });

    $(window).on('resize', function () {
      $header.addClass('absolute-header');
      headerTop = $header.offset().top;

      if ($(window).scrollTop() >= headerTop) {
        $header.removeClass('absolute-header');
      }
    });
  }
})(jQuery);
