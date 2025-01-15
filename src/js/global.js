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
  const hoverableElements = document.querySelectorAll('button, a, .switcher');
  hoverableElements.forEach(element => {
    element.addEventListener('mouseenter', () => document.getElementById('customCursor').classList.add('hover-effect'));
    element.addEventListener('mouseleave', () => document.getElementById('customCursor').classList.remove('hover-effect'));
  });
}
initializeHoverEffects();

// Off-screen canvas for image sampling
const imageCache = new Map();
const offscreenCanvas = document.createElement('canvas');
const offscreenCtx = offscreenCanvas.getContext('2d');

// Configurable parameters
const samplingRadius = 1;      // Radius for image pixel sampling
const contrastThreshold = 4.5; // Example WCAG threshold

function displayP3ToRGB(colorStr) {
  const regex = /color\(display-p3\s+([\d.]+)\s+([\d.]+)\s+([\d.]+)(?:\s*\/\s*([\d.]+))?\)/;
  const match = colorStr.match(regex);
  if (!match) return null;
  let [_, r, g, b, a] = match;
  r = Math.min(255, Math.round(parseFloat(r) * 255));
  g = Math.min(255, Math.round(parseFloat(g) * 255));
  b = Math.min(255, Math.round(parseFloat(b) * 255));
  a = a ? parseFloat(a) : 1;
  return `rgba(${r}, ${g}, ${b}, ${a})`;
}

function isTransparentOrInvalidColor(color) {
  if (!color || color === 'transparent') return true;
  const rgbaMatch = color.match(/^rgba?\(([\d.]+),[\s]*([\d.]+),[\s]*([\d.]+)(?:,[\s]*([\d.]+))?\)$/);
  if (!rgbaMatch) return false;
  const alpha = rgbaMatch[4] !== undefined ? parseFloat(rgbaMatch[4]) : 1;
  return alpha < 0.1;
}

function getLightness(color) {
  const rgbaMatch = color.match(/rgba?\(([\d.]+),[\s]*([\d.]+),[\s]*([\d.]+)(?:,[\s]*([\d.]+))?\)/);
  if (!rgbaMatch) return null;
  let [_, r, g, b, a] = rgbaMatch;
  a = a !== undefined ? parseFloat(a) : 1;
  if (a < 0.1) return null;
  r = parseFloat(r) / 255;
  g = parseFloat(g) / 255;
  b = parseFloat(b) / 255;
  const max = Math.max(r,g,b);
  const min = Math.min(r,g,b);
  return (max + min) / 2;
}

function getRgbValues(color) {
  const rgbaMatch = color.match(/rgba?\(([\d.]+),[\s]*([\d.]+),[\s]*([\d.]+)(?:,[\s]*([\d.]+))?\)/);
  if (!rgbaMatch) return null;
  const [_, r, g, b] = rgbaMatch;
  return [parseFloat(r), parseFloat(g), parseFloat(b)];
}

function rgbArrayToString(r, g, b) {
  return `rgb(${r}, ${g}, ${b})`;
}

function loadImage(src) {
  return new Promise((resolve, reject) => {
    if (imageCache.has(src)) {
      resolve(imageCache.get(src));
      return;
    }
    const img = new Image();
    img.crossOrigin = 'anonymous'; 
    img.onload = () => {
      imageCache.set(src, img);
      resolve(img);
    };
    img.onerror = reject;
    img.src = src;
  });
}

function extractImageUrl(backgroundImage) {
  const urlMatch = backgroundImage.match(/url\(["']?(.*?)["']?\)/);
  return urlMatch ? urlMatch[1] : null;
}

function sampleArea(offscreenCtx, rect, x, y, radius) {
  let startX = Math.max(0, x - radius);
  let startY = Math.max(0, y - radius);
  let width = Math.min(radius * 2, rect.width - startX);
  let height = Math.min(radius * 2, rect.height - startY);

  if (width <= 0 || height <= 0) return null;

  const imageData = offscreenCtx.getImageData(startX, startY, width, height);
  const data = imageData.data;

  let totalR = 0, totalG = 0, totalB = 0, count = 0;
  for (let i = 0; i < data.length; i += 4) {
    const a = data[i+3];
    if (a > 10) {
      totalR += data[i];
      totalG += data[i+1];
      totalB += data[i+2];
      count++;
    }
  }

  if (count === 0) return null;
  const avgR = Math.round(totalR / count);
  const avgG = Math.round(totalG / count);
  const avgB = Math.round(totalB / count);
  return `rgb(${avgR}, ${avgG}, ${avgB})`;
}

function relativeLuminance(r, g, b) {
  const sr = r/255, sg = g/255, sb = b/255;
  function lum(c) {
    return (c <= 0.03928) ? (c/12.92) : ((c+0.055)/1.055)**2.4;
  }
  return 0.2126 * lum(sr) + 0.7152 * lum(sg) + 0.0722 * lum(sb);
}

function rgbToDisplayP3(r, g, b) {
  // Normalize RGB values (ensure they are between 0 and 1)
  const normalizedR = Math.min(1, Math.max(0, r / 255));
  const normalizedG = Math.min(1, Math.max(0, g / 255));
  const normalizedB = Math.min(1, Math.max(0, b / 255));

  return `color(display-p3 ${normalizedR.toFixed(5)} ${normalizedG.toFixed(5)} ${normalizedB.toFixed(5)})`;
}

function convertRgbToDisplayP3(color) {
  const rgbValues = getRgbValues(color); // Extract RGB from string
  if (!rgbValues) return null;
  const [r, g, b] = rgbValues;
  return rgbToDisplayP3(r, g, b);
}

function computeContrast(color1, color2) {
  const rgb1 = getRgbValues(color1);
  const rgb2 = getRgbValues(color2);
  if (!rgb1 || !rgb2) return null;
  const L1 = relativeLuminance(rgb1[0], rgb1[1], rgb1[2]);
  const L2 = relativeLuminance(rgb2[0], rgb2[1], rgb2[2]);
  const lighter = Math.max(L1, L2);
  const darker = Math.min(L1, L2);
  return (lighter + 0.05) / (darker + 0.05);
}

function normalizeColor(colorStr) {
  if (!colorStr) return null;
  if (colorStr.startsWith('color(display-p3')) {
    const converted = displayP3ToRGB(colorStr);
    return converted ? converted : null;
  }
  // Already rgb/rgba?
  if (colorStr.startsWith('rgb')) return colorStr;
  
  // Convert named colors etc.
  const temp = document.createElement('div');
  temp.style.color = colorStr;
  document.body.appendChild(temp);
  const computed = getComputedStyle(temp).color; // rgb/rgba
  document.body.removeChild(temp);
  return computed && computed !== 'transparent' ? computed : null;
}

async function sampleFromImgElement(el, mouseX, mouseY) {
  // el is an <img> tag
  const src = el.src;
  if (!src) return null; // no src, no sampling

  const rect = el.getBoundingClientRect();
  offscreenCanvas.width = rect.width;
  offscreenCanvas.height = rect.height;

  try {
    const img = await loadImage(src);
    offscreenCtx.clearRect(0, 0, rect.width, rect.height);
    // Draw at the displayed size
    offscreenCtx.drawImage(img, 0, 0, rect.width, rect.height);

    const relX = mouseX - rect.left;
    const relY = mouseY - rect.top;
    return sampleArea(offscreenCtx, rect, relX, relY, samplingRadius);
  } catch (err) {
    console.warn('Error loading img for sampling:', err);
    return null;
  }
}

async function sampleFromBackgroundImage(el, mouseX, mouseY, bgImage) {
  const imgUrl = extractImageUrl(bgImage);
  if (!imgUrl) return null;

  const rect = el.getBoundingClientRect();
  offscreenCanvas.width = rect.width;
  offscreenCanvas.height = rect.height;

  try {
    const img = await loadImage(imgUrl);
    offscreenCtx.clearRect(0, 0, rect.width, rect.height);
    offscreenCtx.drawImage(img, 0, 0, rect.width, rect.height);

    const relX = mouseX - rect.left;
    const relY = mouseY - rect.top;
    return sampleArea(offscreenCtx, rect, relX, relY, samplingRadius);
  } catch (err) {
    console.warn('Error loading background image for sampling:', err);
    return null;
  }
}

function initCursorContrastDetection() {
  // 1. Read data attributes
  const userBgColorRaw = document.body.dataset.bgcolor || '#ffffff';
  const userTextColorRaw = document.body.dataset.textcolor || '#000000';

  const normalizedBg = normalizeColor(userBgColorRaw) || 'rgb(255, 255, 255)';
  const normalizedText = normalizeColor(userTextColorRaw) || 'rgb(0, 0, 0)';

  // 2. Determine which is lighter/darker
  const bgLightness = getLightness(normalizedBg) ?? 1;    // Fallback to light
  const textLightness = getLightness(normalizedText) ?? 0; // Fallback to dark

  let userLightColor = normalizedText;
  let userDarkColor = normalizedBg;
  if (bgLightness > textLightness) {
    userLightColor = normalizedBg;
    userDarkColor = normalizedText;
  }

  // Grab the cursor element
  const cursor = document.getElementById('customCursor');
  if (!cursor) {
    console.warn('No element with ID "customCursor" found.');
    return;
  }

  // Grab the cursor wrapper (#customCursor element)
  const customCursor = document.getElementById('customCursor');
  if (!customCursor) {
    console.warn('No element with ID "customCursor" found.');
    return;
  }

  // Grab the actual #cursor div inside #customCursor
  const innerCursor = customCursor.querySelector('#cursor');
  if (!innerCursor) {
    console.warn('No element with ID "cursor" found inside #customCursor.');
    return;
  }

  // 3. Main mousemove sampling
  document.addEventListener('mousemove', async (e) => {
    const el = document.elementFromPoint(e.clientX, e.clientY);
    if (!el) return;

    const style = getComputedStyle(el);
    let chosenColor = null;
    let fromImageTag = false;
    let fromBackgroundImage = false;
    let imageSamplingSuccess = false;

    if (el.tagName === 'IMG') {
      fromImageTag = true;
      chosenColor = await sampleFromImgElement(el, e.clientX, e.clientY);
      if (chosenColor) imageSamplingSuccess = true;
    } else {
      const bgImage = style.backgroundImage && style.backgroundImage !== 'none' ? style.backgroundImage : null;
      if (bgImage) {
        fromBackgroundImage = true;
        chosenColor = await sampleFromBackgroundImage(el, e.clientX, e.clientY, bgImage);
        if (chosenColor) imageSamplingSuccess = true;
      }
    }

    if (!chosenColor) {
      // Fallback
      let bgColor = style.backgroundColor;
      if (isTransparentOrInvalidColor(bgColor)) bgColor = 'rgb(255, 255, 255)';
      chosenColor = normalizeColor(bgColor) || 'rgb(255, 255, 255)';
    }

    // 4. If sampled color is dark => use userLightColor; else => userDarkColor
    // Special case: invert colors for .vendor-list__container__item__link
    let cursorColor;
    let isSpecialCase = false;

    if (el.classList.contains('vendor-list__container__item__name')) {
      // Invert the default behavior
      const sampledLightness = getLightness(chosenColor);
      cursorColor = (sampledLightness !== null && sampledLightness < 0.5)
        ? userDarkColor // Use the opposite of what the default would have been
        : userLightColor;
      isSpecialCase = true;
    } else {
      // Default logic
      const sampledLightness = getLightness(chosenColor);
      cursorColor = (sampledLightness !== null && sampledLightness < 0.5)
        ? userLightColor
        : userDarkColor;
    }

    // // Apply cursor color directly (or via classes if desired)
    // cursor.style.backgroundColor = cursorColor;

    // Convert to P3 if necessary
    cursorColorP3 = convertRgbToDisplayP3(cursorColor) || cursorColor;

    // Apply the color to #cursor
    innerCursor.style.color = cursorColor; // Standard RGB
    innerCursor.style.setProperty('color', cursorColorP3); // P3 version

    // Also update the #dataDisplay background and text colors
    const dataDisplay = customCursor.querySelector('#dataDisplay');
    if (dataDisplay) {
      if (cursorColor === userLightColor) {
        // Set both RGB and P3 background colors
        dataDisplay.style.backgroundColor = userLightColor; // Standard RGB
        dataDisplay.style.setProperty('background-color', convertRgbToDisplayP3(userLightColor) || userLightColor); // P3 version

        // Set both RGB and P3 text colors
        dataDisplay.style.color = userDarkColor; // Standard RGB
        dataDisplay.style.setProperty('color', convertRgbToDisplayP3(userDarkColor) || userDarkColor); // P3 version
      } else {
        // Set both RGB and P3 background colors
        dataDisplay.style.backgroundColor = userDarkColor; // Standard RGB
        dataDisplay.style.setProperty('background-color', convertRgbToDisplayP3(userDarkColor) || userDarkColor); // P3 version

        // Set both RGB and P3 text colors
        dataDisplay.style.color = userLightColor; // Standard RGB
        dataDisplay.style.setProperty('color', convertRgbToDisplayP3(userLightColor) || userLightColor); // P3 version
      }
    }

    // Debug logging
    const contrastRatio = computeContrast(chosenColor, cursorColor);
  });
}

initCursorContrastDetection();

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

