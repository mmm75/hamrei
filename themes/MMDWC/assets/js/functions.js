(function ($) {
  $(document).ready(function () {
    window.scrollTo(0, 0);
    headerHomeScroll();
    collectionGridSizeControls();
    collectionInfiniteScroll();
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

  function collectionGridSizeControls() {
    const $grid = $('#collection-grid');
    const $more = $('.collection-nav__grid-control--more');
    const $less = $('.collection-nav__grid-control--less');

    function updateControls() {
      $more.toggleClass('disabled', $grid.hasClass('collection-grid--4'));
      $less.toggleClass('disabled', $grid.hasClass('collection-grid--2'));
    }

    $more.on('click', function () {
      if ($grid.hasClass('collection-grid--2')) {
        $grid.removeClass('collection-grid--2').addClass('collection-grid--3');
      } else if ($grid.hasClass('collection-grid--3')) {
        $grid.removeClass('collection-grid--3').addClass('collection-grid--4');
      }

      updateControls();
    });

    $less.on('click', function () {
      if ($grid.hasClass('collection-grid--4')) {
        $grid.removeClass('collection-grid--4').addClass('collection-grid--3');
      } else if ($grid.hasClass('collection-grid--3')) {
        $grid.removeClass('collection-grid--3').addClass('collection-grid--2');
      }

      updateControls();
    });

    updateControls();
  }
  function collectionInfiniteScroll() {
    const $grid = $('#collection-grid');
    const $pagination = $('#collection-pagination');

    if (!$grid.length || !$pagination.length) {
      return;
    }

    let loading = false;

    const observer = new IntersectionObserver(
      function (entries) {
        if (!entries[0].isIntersecting || loading) {
          return;
        }

        const $nextLink = $pagination.find('a');

        if (!$nextLink.length) {
          observer.disconnect();
          return;
        }

        loading = true;

        $.get($nextLink.attr('href'), function (response) {
          const $response = $(response);
          const $items = $response.find(
            '#collection-grid .collection-grid__item',
          );
          const $nextPageLink = $response.find('#collection-pagination a');

          $grid.append($items);

          if ($nextPageLink.length) {
            $pagination.html($nextPageLink);
          } else {
            $pagination.remove();
            observer.disconnect();
          }
        }).always(function () {
          loading = false;
        });
      },
      {
        rootMargin: '0px 0px 200% 0px',
      },
    );

    observer.observe($pagination[0]);
  }
})(jQuery);
