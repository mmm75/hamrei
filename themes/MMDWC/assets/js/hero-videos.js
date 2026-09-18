(function ($) {
  // Lisbon time formatter used for the visible time in the Hero
  const heroTimeFormatter = new Intl.DateTimeFormat('en-US', {
    timeZone: 'Europe/Lisbon',
    hour: 'numeric',
    minute: '2-digit',
    hour12: true,
  });

  // Lisbon time formatter used internally to determine the current video slot
  const heroSlotFormatter = new Intl.DateTimeFormat('en-GB', {
    timeZone: 'Europe/Lisbon',
    hour: '2-digit',
    minute: '2-digit',
    hour12: false,
  });

  $(document).ready(function () {
    heroLisbonTime();
    heroVideoPreload();
    heroVideoWatchTimeSlot();
  });

  function runEveryMinute(callback) {
    const now = new Date();
    const delay = 60000 - (now.getSeconds() * 1000 + now.getMilliseconds());

    setTimeout(function () {
      callback();
      setInterval(callback, 60000);
    }, delay);
  }

  function heroLisbonTime() {
    const $time = $('.hero__time');

    // Stop if the page does not contain the Hero time
    if (!$time.length) {
      return;
    }

    function updateTime() {
      // Get the current Lisbon time and display it in the Hero
      const time = heroTimeFormatter.format(new Date());
      $time.text(time);
    }

    // Display immediately, then update at the exact start of every minute
    updateTime();
    runEveryMinute(updateTime);
  }

  function heroVideoPreload() {
    const $video = $('#video');

    // Stop if the page does not contain a Hero video
    if (!$video.length) {
      return;
    }

    // Wait until the current Hero video is actually playing
    $video.one('playing', function () {
      function preloadAfterDelay() {
        // Give the page 5 extra seconds before loading the next video
        setTimeout(function () {
          preloadNextHeroVideo();
        }, 5000);
      }

      // Wait until all initial page resources have finished loading
      if (document.readyState === 'complete') {
        preloadAfterDelay();
      } else {
        $(window).one('load', preloadAfterDelay);
      }
    });
  }

  function preloadNextHeroVideo() {
    const $video = $('#video');

    // Ask WordPress only for the video belonging to the next time slot
    $.post(
      hamreiHero.ajaxUrl,
      {
        action: 'hamrei_get_next_hero_video',
      },
      function (response) {
        // Stop if WordPress could not return a valid video URL
        if (!response.success || !response.data.url) {
          return;
        }

        // Create an invisible video element to preload the next video
        const nextVideo = document.createElement('video');
        nextVideo.preload = 'auto';
        nextVideo.src = response.data.url;
        nextVideo.load();

        // Store the URL so it is ready when the time slot changes
        $video.data('next-video-url', response.data.url);
      },
    );
  }

  function heroVideoWatchTimeSlot() {
    const $video = $('#video');

    // Stop if the page does not contain a Hero video
    if (!$video.length) {
      return;
    }

    // Remember the time slot active when the page loads
    let currentSlot = getHeroVideoSlot();

    // Check at the exact start of every minute if Lisbon has entered a new time slot
    runEveryMinute(function () {
      const newSlot = getHeroVideoSlot();

      // Do nothing while we remain in the same time slot
      if (newSlot === currentSlot) {
        return;
      }

      // Retrieve the next video URL that was preloaded earlier
      const nextVideoUrl = $video.data('next-video-url');

      if (!nextVideoUrl) {
        return;
      }

      // Replace the current Hero video without reloading the page
      $video.find('source').attr('src', nextVideoUrl);
      $video[0].load();
      $video[0].play();

      // The new time slot is now active
      currentSlot = newSlot;

      // The preloaded video is now the current video
      $video.removeData('next-video-url');

      // Wait 5 seconds before preparing the following time slot
      setTimeout(function () {
        preloadNextHeroVideo();
      }, 5000);
    });
  }

  function getHeroVideoSlot() {
    // Get the current Lisbon time in 24-hour format for slot comparisons
    const time = heroSlotFormatter.format(new Date());
    let currentSlot = hamreiHero.schedule[0].slot;

    // Find the current slot using the schedule defined in PHP
    for (const slot of hamreiHero.schedule) {
      if (time >= slot.start) {
        currentSlot = slot.slot;
      } else {
        break;
      }
    }

    return currentSlot;
  }
})(jQuery);
