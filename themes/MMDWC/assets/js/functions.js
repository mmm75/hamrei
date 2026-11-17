(function ($) {
  $(document).ready(function () {
    // Start at the top except when returning through browser history
    const navigation = performance.getEntriesByType('navigation')[0];

    if (!navigation || navigation.type !== 'back_forward') {
      window.scrollTo(0, 0);
    }
    headerHomeScroll();
    headerScroll();
    initHighlightVideos();
    collectionGridSizeControls();
    collectionInfiniteScroll();
    aboutStudioSlider();
    initRellax();
    pieceSpecsAccordion();
    pieceGoBack();
    projectVideos();
    projectCarousels();
    highlightsCarousel();
    shopRowItemsCarousel();
    headerMobile();
    headerMobileHomeScroll();
    mailchimp();
  });

  function initRellax() {
    if (window.matchMedia('(max-width: 991px)').matches) {
      return;
    }

    const elements = document.querySelectorAll('.parallax');

    if (!elements.length || typeof Rellax === 'undefined') {
      return;
    }

    const rellax = new Rellax('.parallax', {
      center: true,
      round: false,
      vertical: true,
      horizontal: false,
    });

    window.addEventListener(
      'load',
      function () {
        rellax.refresh();
      },
      { once: true },
    );
  }

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

  function headerScroll() {
    const scrollHeader = document.querySelector('#header');

    if (!scrollHeader || scrollHeader.classList.contains('absolute-header')) {
      return;
    }

    scrollHeader.classList.add('header-scroll');

    let lastScrollTop = window.scrollY;

    // Always show the header when returning with Back / Forward
    window.addEventListener('pageshow', function (event) {
      const navigation = performance.getEntriesByType('navigation')[0];

      if (
        event.persisted ||
        (navigation && navigation.type === 'back_forward')
      ) {
        scrollHeader.classList.remove('is-hidden');
        lastScrollTop = window.scrollY;
      }
    });

    window.addEventListener('scroll', function () {
      const scrollTop = window.scrollY;

      if (scrollTop <= 85) {
        scrollHeader.classList.remove('is-hidden');
      } else if (scrollTop > lastScrollTop) {
        scrollHeader.classList.add('is-hidden');
      } else if (scrollTop < lastScrollTop) {
        scrollHeader.classList.remove('is-hidden');
      }

      lastScrollTop = Math.max(scrollTop, 0);
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

    // Stop if the current page does not contain the Collection grid
    if (!$grid.length) {
      return;
    }

    const storageKey = 'hamreiCollectionState';
    const currentUrl = window.location.pathname + window.location.search;

    const navigation = performance.getEntriesByType('navigation')[0];
    const isHistoryNavigation =
      navigation && navigation.type === 'back_forward';

    // Restore the Collection exactly as it was before opening a Piece
    if (isHistoryNavigation) {
      try {
        const storedState = JSON.parse(sessionStorage.getItem(storageKey));

        if (storedState && storedState.url === currentUrl) {
          $grid.html(storedState.gridHtml);

          const $currentPagination = $('#collection-pagination');

          if (storedState.paginationHtml !== null) {
            if ($currentPagination.length) {
              $currentPagination.html(storedState.paginationHtml);
            }
          } else {
            $currentPagination.remove();
          }

          requestAnimationFrame(function () {
            requestAnimationFrame(function () {
              window.scrollTo(0, storedState.scrollY);
            });
          });
        }
      } catch (error) {
        // Ignore invalid or unavailable sessionStorage
      }
    }

    // Save the complete current Collection before opening a Piece.
    // Event delegation also catches Pieces added by infinite scroll.
    $grid.on('click', '.collection-grid__image', function () {
      const $currentPagination = $('#collection-pagination');

      try {
        sessionStorage.setItem(
          storageKey,
          JSON.stringify({
            url: currentUrl,
            scrollY: window.scrollY,
            gridHtml: $grid.html(),
            paginationHtml: $currentPagination.length
              ? $currentPagination.html()
              : null,
          }),
        );
      } catch (error) {
        // Ignore unavailable sessionStorage
      }
    });

    const $pagination = $('#collection-pagination');

    // No more pages to load
    if (!$pagination.length) {
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

    if (document.readyState === 'complete') {
      observer.observe($pagination[0]);
    } else {
      window.addEventListener(
        'load',
        function () {
          observer.observe($pagination[0]);
        },
        { once: true },
      );
    }
  }

  function initHighlightVideos() {
    const videos = document.querySelectorAll('.js-highlight-video');

    if (!videos.length) {
      return;
    }

    function loadVideos() {
      videos.forEach((video) => {
        const source = video.querySelector(
          'source[data-src-mobile][data-src-desktop]',
        );

        if (!source) {
          return;
        }

        source.src =
          window.innerWidth <= 768
            ? source.dataset.srcMobile
            : source.dataset.srcDesktop;

        source.removeAttribute('data-src-mobile');
        source.removeAttribute('data-src-desktop');

        video.preload = 'auto';
        video.load();
      });

      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            const video = entry.target;

            if (entry.isIntersecting) {
              video.play().catch(() => {});
            } else {
              video.pause();
            }
          });
        },
        {
          rootMargin: '0px',
          threshold: 0.01,
        },
      );

      videos.forEach((video) => {
        observer.observe(video);
      });
    }

    if (document.readyState === 'complete') {
      loadVideos();
    } else {
      window.addEventListener('load', loadVideos, { once: true });
    }
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
    $('.piece-product-single__spec-title').on('click', function () {
      const $spec = $(this).closest('.piece-product-single__spec');
      const $content = $spec.find('.piece-product-single__spec-content');

      $spec.toggleClass('is-opened');
      $content.stop(true, true).slideToggle(150);
    });
  }

  function projectVideos() {
    $('.project-item__play').on('click', function () {
      const $button = $(this);
      const video = $button.siblings('video').get(0);

      $('.project-item__media video').each(function () {
        if (this !== video) {
          this.pause();
          this.currentTime = 0;
        }
      });

      video.controls = true;
      $button.remove();
      video.play();
    });
  }
  function projectCarousels() {
    $('.project-item__carousel').each(function () {
      new Swiper(this, {
        slidesPerView: 2.25,
        slidesPerGroup: 1,
        centeredSlides: false,
        spaceBetween: 0,
        mousewheel: false,
        grabCursor: true,
        loop: true,
        breakpoints: {
          0: {
            slidesPerView: 1.25,
          },
          991: {
            slidesPerView: 2.25,
          },
        },
      });
    });
  }

  function highlightsCarousel() {
    if (!$('.highlights__row').length) {
      return;
    }

    new Swiper('.highlights__row', {
      slidesPerView: 1,
      allowTouchMove: true,
      simulateTouch: true,
      pagination: {
        el: '.highlights__pagination',
        clickable: true,
      },
      breakpoints: {
        992: {
          slidesPerView: 3,
        },
      },
    });
  }

  function shopRowItemsCarousel() {
    if (!$('.shop-row-items__row').length) {
      return;
    }

    new Swiper('.shop-row-items__row', {
      slidesPerView: 1,
      spaceBetween: 0,
      allowTouchMove: true,
      simulateTouch: true,
      pagination: {
        el: '.shop-row-items__pagination',
        clickable: true,
      },
      breakpoints: {
        992: {
          slidesPerView: 4,
          spaceBetween: 25,
        },
      },
    });
  }

  function headerMobile() {
    const $header = $('#header-mobile');

    if (!$header.length) {
      return;
    }

    const $menuToggle = $('.header-mobile__menu-toggle');
    const $filtersToggle = $('.header-mobile__filters-toggle');
    const $gridMore = $('.header-mobile__grid-more');
    const $gridLess = $('.header-mobile__grid-less');
    const $grid = $('.collection-grid');

    let menuOpen = false;
    let filtersOpen = false;
    let gridColumns = parseInt(
      sessionStorage.getItem('hamreiMobileGridColumns'),
      10,
    );

    if (gridColumns !== 1 && gridColumns !== 2) {
      gridColumns = 1;
    }

    function updateHeader() {
      $header.toggleClass('is-menu-open', menuOpen);
      $header.toggleClass('is-filters-open', filtersOpen && !menuOpen);
      $filtersToggle.toggleClass('is-open', filtersOpen);
    }

    function updateGrid() {
      if (!$grid.length) {
        return;
      }

      $grid
        .removeClass(
          'collection-grid--mobile-1 collection-grid--mobile-2 collection-grid--mobile-3',
        )
        .addClass('collection-grid--mobile-' + gridColumns);

      sessionStorage.setItem('hamreiMobileGridColumns', gridColumns);

      $gridMore.toggleClass('disabled', gridColumns === 2);
      $gridLess.toggleClass('disabled', gridColumns === 1);
    }

    $menuToggle.on('click', function () {
      filtersOpen = false;
      menuOpen = !menuOpen;

      updateHeader();
    });

    $filtersToggle.on('click', function () {
      if (menuOpen) {
        return;
      }

      filtersOpen = !filtersOpen;
      updateHeader();
    });

    $gridMore.on('click', function () {
      if (gridColumns === 2) {
        return;
      }

      gridColumns = 2;
      updateGrid();
    });

    $gridLess.on('click', function () {
      if (gridColumns === 1) {
        return;
      }

      gridColumns = 1;
      updateGrid();
    });

    updateHeader();
    updateGrid();
  }

  function headerMobileHomeScroll() {
    const $header = $('#header-mobile');
    const $hero = $('.hero');

    if (
      !$header.length ||
      !$hero.length ||
      !$('body').hasClass('page-template-page-HOME')
    ) {
      return;
    }

    let heroBottom = $hero.offset().top + $hero.outerHeight();

    function updateHeader() {
      const scrollTop = window.scrollY;
      const isPastHero = scrollTop >= heroBottom;

      $header.toggleClass('is-home-visible', isPastHero);
    }

    $(window).on('scroll', updateHeader);

    $(window).on('resize', function () {
      heroBottom = $hero.offset().top + $hero.outerHeight();
      updateHeader();
    });

    updateHeader();
  }

  function mailchimp() {
    $('.mailchimp').each(function () {
      const $mailchimp = $(this);
      const $form = $mailchimp.find('.pfb-signup-submission');
      const $message = $mailchimp.find('.mailchimp__message');

      $form.on('submit', function (event) {
        event.preventDefault();

        $message.text('');

        $.ajax({
          type: 'POST',
          url: $form.data('ajax-url'),
          dataType: 'json',
          data: $form.serialize(),

          success: function (response) {
            if (response.success) {
              $form[0].reset();
              $message.text($form.data('success-message'));
            } else {
              $message.text($form.data('error-message'));
            }
          },

          error: function () {
            $message.text($form.data('error-message'));
          },
        });
      });
    });
  }
})(jQuery);
