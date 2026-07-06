/* Smooth Scroll Enhancement */

// Smooth Wheel Scroll Implementation
let isScrolling = false;
let targetScrollPosition = 0;

function smoothWheelScroll(event) {
  event.preventDefault();

  const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
  const deltaY = event.deltaY || -event.wheelDelta || event.detail;

  // Constant scroll speed (pixels per millisecond)
  const pixelsPerMs = 1.2; // Fast, responsive scrolling
  targetScrollPosition = currentScrollPosition + (deltaY * 1);

  // Clamp target position to valid range
  const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
  targetScrollPosition = Math.max(0, Math.min(targetScrollPosition, maxScroll));

  if (!isScrolling) {
    isScrolling = true;
    animateScroll(currentScrollPosition, pixelsPerMs);
  }
}

function animateScroll(currentPosition, pixelsPerMs) {
  const difference = targetScrollPosition - currentPosition;

  // Calculate duration based on distance and constant speed
  const duration = Math.abs(difference) / pixelsPerMs; // milliseconds
  let startTime = null;

  // Cubic ease-out function for smooth, natural scrolling
  function easeOutCubic(t) {
    return 1 - Math.pow(1 - t, 3);
  }

  function scroll(timestamp) {
    if (!startTime) startTime = timestamp;
    const elapsed = timestamp - startTime;
    const progress = Math.min(elapsed / duration, 1);

    // Apply easing function for smooth acceleration/deceleration
    const easedProgress = easeOutCubic(progress);
    const newPosition = currentPosition + (difference * easedProgress);
    window.scrollTo(0, newPosition);

    if (progress < 1) {
      requestAnimationFrame(scroll);
    } else {
      isScrolling = false;
      // Check if there's a new scroll request
      if (Math.abs(targetScrollPosition - window.pageYOffset) > 1) {
        targetScrollPosition = window.pageYOffset;
      }
    }
  }

  requestAnimationFrame(scroll);
}

// Add wheel event listener with passive: false to allow preventDefault
window.addEventListener('wheel', smoothWheelScroll, { passive: false });

// Also handle touchpad scrolling on macOS
window.addEventListener('mousewheel', smoothWheelScroll, { passive: false });

document.addEventListener('DOMContentLoaded', function() {
  // Get all scroll-to-top buttons
  const scrollToTopBtns = document.querySelectorAll('.scroll-to-top, .scroll-to-target');

  // Show/hide scroll to top button on scroll
  let ticking = false;
  window.addEventListener('scroll', function() {
    if (!ticking) {
      window.requestAnimationFrame(function() {
        const scrollY = window.pageYOffset || document.documentElement.scrollTop;

        scrollToTopBtns.forEach(btn => {
          if (scrollY > 300) {
            btn.classList.add('show');
          } else {
            btn.classList.remove('show');
          }
        });

        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });

  // Scroll to top button click handler
  scrollToTopBtns.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      // Smooth scroll to top
      window.scrollTo({
        top: 0,
        behavior: 'smooth',
        left: 0
      });
    });
  });

  // Smooth scroll for anchor links (with debounce for performance)
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');

      // Skip if href is just '#', empty, or no hash
      if (!href || href === '#' || href === '') {
        return;
      }

      const targetElement = document.querySelector(href);

      if (targetElement) {
        e.preventDefault();

        // Smooth scroll to target element
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });

        // Optional: Update URL hash without jumping
        window.history.pushState(null, null, href);
      }
    });
  });

  // Smooth scroll for page anchors with data-scroll attribute
  document.querySelectorAll('[data-scroll]').forEach(element => {
    element.addEventListener('click', function(e) {
      e.preventDefault();
      const target = this.getAttribute('data-scroll');
      const targetElement = document.querySelector(target);

      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Handle internal navigation links for smooth scrolling
  document.querySelectorAll('a[href*="#"]').forEach(link => {
    link.addEventListener('click', function(e) {
      const href = this.getAttribute('href');

      // Only handle same-page links
      if (href.includes('#') && href.indexOf('#') > 0) {
        const hashPart = href.substring(href.indexOf('#'));
        const targetElement = document.querySelector(hashPart);

        if (targetElement) {
          e.preventDefault();
          targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      }
    });
  });
});

// Polyfill for browsers that don't support smooth scrolling
if (!('scrollBehavior' in document.documentElement.style)) {
  // Simple polyfill for smooth scroll
  function smoothScroll(element, options) {
    const startPosition = window.pageYOffset;
    const targetPosition = element.offsetTop - (options.block === 'start' ? 0 : 0);
    const distance = targetPosition - startPosition;
    const duration = 1000; // milliseconds
    let start = null;

    window.requestAnimationFrame(function scroll(timestamp) {
      if (start === null) start = timestamp;
      const elapsed = timestamp - start;
      const progress = Math.min(elapsed / duration, 1);

      // Easing function for smooth acceleration/deceleration
      const ease = progress < 0.5
        ? 2 * progress * progress
        : -1 + (4 - 2 * progress) * progress;

      window.scrollTo(0, startPosition + distance * ease);

      if (elapsed < duration) {
        window.requestAnimationFrame(scroll);
      }
    });
  }

  // Override scrollIntoView for smooth behavior
  if (Element.prototype.scrollIntoView) {
    const originalScrollIntoView = Element.prototype.scrollIntoView;
    Element.prototype.scrollIntoView = function(options) {
      if (options && options.behavior === 'smooth') {
        smoothScroll(this, options);
      } else {
        originalScrollIntoView.call(this, options);
      }
    };
  }
}
