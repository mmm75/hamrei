(function ($) {
  $(document).ready(function () {
    // Always start the page at the top on initial load
    window.scrollTo(0, 0);

    headerHomeScroll();
    collectionGridSizeControls();
    collectionInfiniteScroll();
    aboutStudioSlider();
    pieceSpecsAccordion();
    pieceGoBack();
  });

  function headerHomeScroll() {
    const $header = $('#header');

    // Stop if the current page does not use an absolute header
    if (!$header.hasClass('absolute-header')) {
      return;
    }

    // Store the initial vertical position of the header
    let headerTop = $header.offset().top;

    // Switch the header from absolute to regular positioning when scrolling past it
    $(window).on('scroll', function () {
      if ($(window).scrollTop() >= headerTop) {
        $header.removeClass('absolute-header');
      } else {
        $header.addClass('absolute-header');
      }
    });

    // Recalculate the header position when the viewport size changes
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

    // Stop if the current page does not contain the Collection grid
    if (!$grid.length) {
      return;
    }

    // Restore the grid size selected during the current browsing session
    const storedGridSize = sessionStorage.getItem('collectionGridSize');

    if (storedGridSize && ['2', '3', '4'].includes(storedGridSize)) {
      $grid
        .removeClass('collection-grid--2 collection-grid--3 collection-grid--4')
        .addClass('collection-grid--' + storedGridSize);
    }

    // Disable controls when the grid reaches its minimum or maximum size
    function updateControls() {
      $more.toggleClass('disabled', $grid.hasClass('collection-grid--4'));
      $less.toggleClass('disabled', $grid.hasClass('collection-grid--2'));
    }

    // Save the current grid size for the current browsing session
    function storeGridSize() {
      if ($grid.hasClass('collection-grid--4')) {
        sessionStorage.setItem('collectionGridSize', '4');
      } else if ($grid.hasClass('collection-grid--3')) {
        sessionStorage.setItem('collectionGridSize', '3');
      } else {
        sessionStorage.setItem('collectionGridSize', '2');
      }
    }

    // Increase the number of columns: 2 → 3 → 4
    $more.on('click', function () {
      if ($grid.hasClass('collection-grid--2')) {
        $grid.removeClass('collection-grid--2').addClass('collection-grid--3');
      } else if ($grid.hasClass('collection-grid--3')) {
        $grid.removeClass('collection-grid--3').addClass('collection-grid--4');
      }

      storeGridSize();
      updateControls();
    });

    // Decrease the number of columns: 4 → 3 → 2
    $less.on('click', function () {
      if ($grid.hasClass('collection-grid--4')) {
        $grid.removeClass('collection-grid--4').addClass('collection-grid--3');
      } else if ($grid.hasClass('collection-grid--3')) {
        $grid.removeClass('collection-grid--3').addClass('collection-grid--2');
      }

      storeGridSize();
      updateControls();
    });

    // Set the initial state of the controls and reveal the grid
    updateControls();
    $grid.addClass('is-ready');
  }

  function collectionInfiniteScroll() {
    const $grid = $('#collection-grid');
    const $pagination = $('#collection-pagination');

    // Stop if the current page does not contain the Collection grid or pagination
    if (!$grid.length || !$pagination.length) {
      return;
    }

    // Prevent multiple page requests from running at the same time
    let loading = false;

    // Watch the hidden pagination element and load the next page before reaching it
    const observer = new IntersectionObserver(
      function (entries) {
        if (!entries[0].isIntersecting || loading) {
          return;
        }

        // Get the native WordPress next-page URL
        const $nextLink = $pagination.find('a');

        // Stop observing when there are no more pages
        if (!$nextLink.length) {
          observer.disconnect();
          return;
        }

        loading = true;

        // Load the next native WordPress archive page
        $.get($nextLink.attr('href'), function (response) {
          const $response = $(response);

          // Extract only the Collection items from the returned page
          const $items = $response.find(
            '#collection-grid .collection-grid__item',
          );

          // Get the next native pagination link from the returned page
          const $nextPageLink = $response.find('#collection-pagination a');

          // Append the new items to the existing grid
          $grid.append($items);

          if ($nextPageLink.length) {
            // Replace the pagination URL with the following WordPress page
            $pagination.html($nextPageLink);
          } else {
            // Remove pagination and stop observing after the final page
            $pagination.remove();
            observer.disconnect();
          }
        }).always(function () {
          // Allow another request once the current one has finished
          loading = false;
        });
      },
      {
        // Start loading before the pagination element reaches the viewport
        rootMargin: '0px 0px 200% 0px',
      },
    );

    // Start watching the hidden native pagination element
    observer.observe($pagination[0]);
  }

  function aboutStudioSlider() {
    const slider = document.querySelector('.about__section-2-slider');

    // Stop if the current page does not contain the Studio slider
    if (!slider) {
      return;
    }

    // Initialize the Studio image slider
    new Swiper(slider, {
      slidesPerView: 1,
      loop: true,
      effect: 'fade',
      speed: 600,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });
  }

  function pieceGoBack() {
    const $back = $('.piece-subnav__back');

    if (!$back.length) {
      return;
    }

    $back.on('click', function (e) {
      const collectionUrl = $(this).data('collection-url');
      const referrer = document.referrer;

      if (referrer) {
        try {
          const referrerUrl = new URL(referrer);

          if (referrerUrl.origin === window.location.origin) {
            e.preventDefault();
            window.history.back();
            return;
          }
        } catch (error) {
          // Keep the Collection URL as fallback
        }
      }

      window.location.href = collectionUrl;
    });
  }

  function pieceSpecsAccordion() {
    $('.piece-single__spec-title').on('click', function () {
      const $spec = $(this).closest('.piece-single__spec');
      const $content = $spec.find('.piece-single__spec-content');

      $spec.toggleClass('is-opened');
      $content.stop(true, true).slideToggle(150);
    });
  }
})(jQuery);
