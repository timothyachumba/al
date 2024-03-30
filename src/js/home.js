import LocomotiveScroll from 'locomotive-scroll'

document.addEventListener('DOMContentLoaded', function() {
  // Add loaded class to body
  document.querySelector('body').classList.add('loaded')

  // Set root styles
  const root = document.documentElement;
  const body = document.body;
  const backgroundColor = body?.dataset.bgcolor || '#FFFFFF'; // Default white
  const textColor = body?.dataset.textcolor || '#000000'; // Default black
  root.style.setProperty('--backgroundColor', backgroundColor);
  root.style.setProperty('--textColor', textColor);

  const hexToP3 = (string) => {
    const aRgbHex = string.replace("#", "").match(/.{1,2}/g);
    const aRgb = [
        (parseInt(aRgbHex[0], 16) / 255).toFixed(2),
        (parseInt(aRgbHex[1], 16) / 255).toFixed(2),
        (parseInt(aRgbHex[2], 16) / 255).toFixed(2),
    ];
    return `color(display-p3 ${aRgb.join(" ")})`;
  }

  root.style.setProperty('--backgroundColorP3', hexToP3(backgroundColor));
  root.style.setProperty('--textColorP3', hexToP3(textColor));

  // Navigation toggle functionality
  var triggerDiv = document.getElementsByClassName('nav-button')[0];
  var targetDiv = document.getElementsByClassName('nav-project-drawer')[0];

  triggerDiv.addEventListener('click', function() {
    if (targetDiv.classList.contains('active')) {
      targetDiv.classList.remove('active');
      triggerDiv.classList.remove('active');
    } else {
      triggerDiv.classList.add('active');
      targetDiv.classList.add('active');
    }
  });

  const scroll = new LocomotiveScroll({
    el: document.querySelector('[data-scroll-container]'),
    smooth: true,
    direction: 'horizontal',
    inertia: 0.6,
    getSpeed: true,
    getDirection: true,
    gestureDirection: 'both',
    touchMultiplier: 3,
    tablet: {
      smooth: true,
      direction: 'horizontal',
      breakpoint: 768
    },
    smartphone: {
      smooth: true,
      direction: 'vertical',
      breakpoint: 480
    }
  })

  function checkContentSize () {
    const carouselWidth = carousel.offsetWidth
    const aboutWidth = about.offsetWidth
    const contentWidth = carouselWidth + aboutWidth

    if (windowWidth > contentWidth && !carousel.classList.contains('full-width')) {
      carousel.classList.add('full-width')
    } else if (windowWidth <= contentWidth && carousel.classList.contains('full-width')) {
      carousel.classList.remove('full-width')
    }
  }

  function updateScrollDirection () {
    const scrollDirection = html.getAttribute('data-scroll-direction')
    const isVertical = scrollDirection === 'vertical'
    const isHorizontal = scrollDirection === 'horizontal'
    const shouldChangeToHorizontal = isVertical && windowWidth > breakpoint
    const shouldChangeToVertical = isHorizontal && windowWidth <= breakpoint

    if (shouldChangeToHorizontal || shouldChangeToVertical) {
      scroll.destroy()
      scroll.init()
    }
    scroll.update()
  }

  function handleResize () {
    windowWidth = window.innerWidth
    updateScrollDirection()
    updateProjectDescriptionDivs()
    checkContentSize()
    scroll.update()
  }

  // Debounce function
  function debounce (func, wait = 150) {
    let timeout
    return function () {
      const context = this; const args = arguments
      clearTimeout(timeout)
      timeout = setTimeout(() => func.apply(context, args), wait)
    }
  }

function adjustImagesScaleToFitParent() {
    const images = document.querySelectorAll('.project-card__image'); // Select all scalable images
    
    images.forEach((image) => {
        const parentContainer = image.parentElement; // Get the image's parent container
        
        // Scale the parent container instead of the image
        scaleParentContainer(parentContainer);
    });

    function scaleParentContainer(parent) {
        const parentHeight = parent.offsetHeight; // Get current height of the parent
        
        // Define the start and end points for the interpolation
        const startScale = 2.5; // Scale factor at 500px
        const endScale = 1.4; // Scale factor at 1050px
        const startHeight = 500;
        const endHeight = 800;
        
        // Calculate scale factor based on the parent's height
        const scaleFactor = startScale + (endScale - startScale) * (parentHeight - startHeight) / (endHeight - startHeight);
        
        // Clamp the scale factor to the min and max values to prevent scaling beyond the intended range
        const clampedScaleFactor = Math.max(Math.min(scaleFactor, startScale), endScale);
        
        // Apply the scale to the parent container
        parent.style.transform = `scale(${clampedScaleFactor})`;
    }
}

  // Initial adjustment for all images
  // qaàqjustImagesScaleToFitParent();    q11q111tggttg66
  window.addEventListener('resize', debounce(handleResize), adjustImagesScaleToFitParent)

  updateProjectDescriptionDivs()
  updateScrollDirection()
  checkContentSize()
  scroll.init()

  

  

});
