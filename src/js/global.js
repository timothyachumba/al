import LocomotiveScroll from 'locomotive-scroll';

// Util function to debounce any function calls
function debounce(func, wait = 150) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Load event: Checks if images are loaded and fades in the document
function initializeOnLoad() {
  const images = document.images;
  const totalImages = images.length;
  let imagesLoaded = 0;

  function imageLoaded() {
    imagesLoaded++;
    if (imagesLoaded === totalImages) {
      fadeInDocument();
    }
  }

  Array.from(images).forEach(img => {
    if (img.complete) {
      imageLoaded();
    } else {
      img.addEventListener('load', imageLoaded);
      img.addEventListener('error', imageLoaded); // handle broken images
    }
  });

  if (imagesLoaded === totalImages) {
    fadeInDocument();
  }

  function fadeInDocument() {
    document.body.style.opacity = '1';
  }
}
window.addEventListener('load', initializeOnLoad);

// Mouse move event: Moves the custom cursor based on mouse coordinates
function initializeMouseMove() {
  document.addEventListener('mousemove', e => {
    const cursor = document.getElementById('customCursor');
    cursor.style.transform = `translate(${e.pageX - 10}px, ${e.pageY - 10}px)`;
  });
}
initializeMouseMove();

// Adds or removes hover class for specified elements
function initializeHoverEffects() {
  const hoverableElements = document.querySelectorAll('button, a');
  hoverableElements.forEach(element => {
    element.addEventListener('mouseenter', () => document.getElementById('customCursor').classList.add('hover-effect'));
    element.addEventListener('mouseleave', () => document.getElementById('customCursor').classList.remove('hover-effect'));
  });
}
initializeHoverEffects();

// Converts Display P3 colors to RGB
function displayP3ToRGB(p3) {
  const matches = p3.match(/display-p3 ([\d.]+) ([\d.]+) ([\d.]+)(?: \/ ([\d.]+))?/);
  if (!matches) return null;
  let [_, r, g, b, a] = matches.map(Number);
  r = Math.min(255, Math.round(r * 255));
  g = Math.min(255, Math.round(g * 255));
  b = Math.min(255, Math.round(b * 255));
  a = a ? Math.min(1, a).toFixed(2) : 1;
  return `rgba(${r}, ${g}, ${b}, ${a})`;
}

// Finds the background color of an element, considering parent elements
function findBackgroundColor(element) {
  if (!element || element.tagName === 'BODY') return 'rgb(255, 255, 255)';

  let bgColor = getComputedStyle(element).backgroundColor;
  if (bgColor.startsWith('color(display-p3')) bgColor = displayP3ToRGB(bgColor);

  if (bgColor === 'transparent' || bgColor.includes('rgba') && bgColor.endsWith(', 0)')) {
    return findBackgroundColor(element.parentElement);
  }
  return bgColor;
}

// Calculates the lightness of an RGB color
function getLightness(rgb) {
  if (!rgb || rgb === 'transparent' || rgb.includes('rgba') && parseFloat(rgb.split(',')[3]) < 0.1) return null;
  let [r, g, b] = rgb.match(/\d+/g).map(Number);
  [r, g, b] = [r / 255, g / 255, b / 255];
  let max = Math.max(r, g, b), min = Math.min(r, g, b);
  return (max + min) / 2;
}

// Adjust cursor style based on the background color lightness
function adjustCursorOnBackground() {
  document.body.addEventListener('mouseover', e => {
    const bgColor = findBackgroundColor(e.target);
    const lightness = getLightness(bgColor);
    const cursor = document.getElementById('customCursor');

    if (lightness !== null) {
      cursor.classList.toggle('light', lightness < 0.5);
      cursor.classList.toggle('dark', lightness >= 0.5);
    }
  });
}
adjustCursorOnBackground();

// Additional event listeners and initializations
document.addEventListener('DOMContentLoaded', () => {
  let locomotiveScrollInstance = null; // Added to keep track of the Locomotive Scroll instance

  function initializeStylesAndColors() {
    const root = document.documentElement;
    const body = document.body;
    const backgroundColor = body?.dataset.bgcolor || '#FFFFFF';
    const textColor = body?.dataset.textcolor || '#000000';

    const hexToP3 = hex => {
      const aRgbHex = hex.replace("#", "").match(/.{1,2}/g);
      const aRgb = aRgbHex.map(val => (parseInt(val, 16) / 255).toFixed(2));
      return `color(display-p3 ${aRgb.join(" ")})`;
    };

    root.style.setProperty('--backgroundColor', backgroundColor);
    root.style.setProperty('--textColor', textColor);
    root.style.setProperty('--backgroundColorP3', hexToP3(backgroundColor));
    root.style.setProperty('--textColorP3', hexToP3(textColor));
  }

  function setupNavigationToggle() {
    const triggerDiv = document.querySelector('.nav-button');
    const targetDiv = document.querySelector('.nav-project-drawer');

    triggerDiv.addEventListener('click', () => {
      triggerDiv.classList.toggle('active');
      targetDiv.classList.toggle('active');
    });
  }

  // Updated to include conditional initialization based on viewport width
  function initializeLocomotiveScroll() {
    window.locomotiveScrollInstance = new LocomotiveScroll({
      el: document.querySelector('[data-scroll-container]'),
      smooth: true,
      direction: 'horizontal',
      inertia: 1,
      getSpeed: true,
      getDirection: true,
      gestureDirection: 'both',
      reloadOnContextChange: true,
      touchMultiplier: 2,
      smoothMobile: 0,
      tablet: {
        smooth: true,
        direction: 'horizontal',
        breakpoint: 768
      },
      smartphone: {
        smooth: !0,
        direction: 'vertical',
        breakpoint: 480
      }
    });
  }

  // New function to manage enabling/disabling Locomotive Scroll based on viewport width
  function manageLocomotiveScrollInit() {
    const mediaQuery = window.matchMedia('(min-width: 768px)');

    const handleMediaQueryChange = e => {
      if (e.matches) {
        if (!locomotiveScrollInstance) {
          initializeLocomotiveScroll();
        }
      } else {
        if (locomotiveScrollInstance) {
          locomotiveScrollInstance.destroy();
          locomotiveScrollInstance = null;
        }
      }
    };

    // Listen for changes
    mediaQuery.addListener(handleMediaQueryChange);

    // Initial check
    handleMediaQueryChange(mediaQuery);
  }

  function handleResizeEvents() {
    const checkContentSize = () => {
      // Your existing logic
    };

    window.addEventListener('resize', debounce(() => {
      checkContentSize();
    }));
  }

  initializeStylesAndColors();
  setupNavigationToggle();
  manageLocomotiveScrollInit(); // Updated to use the new function
  handleResizeEvents();
});

