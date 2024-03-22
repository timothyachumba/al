import LocomotiveScroll from 'locomotive-scroll'
import fitty from 'fitty'

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
      direction: 'horizontal'
    },
    smartphone: {
      smooth: true,
      direction: 'vertical'
    }
  })
  
  


  function updateScrollDirection () {
    const scrollDirection = html.getAttribute('data-scroll-direction')
    const isVertical = scrollDirection === 'vertical'
    const isHorizontal = scrollDirection === 'horizontal'
    const shouldChangeToHorizontal = isVertical && windowWidth > breakpoint
    const shouldChangeToVertical = isHorizontal && windowWidth <= breakpoint

    if (shouldChangeToHorizontal || shouldChangeToVertical) {
      scroll.destroy()
      scroll.init()
      console.log(`make ${shouldChangeToHorizontal ? 'horizontal' : 'vertical'}`)
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

  function Marquee (selector, speed) {
    const parentSelector = document.querySelector(selector)
    const clone = parentSelector.innerHTML
    const firstElement = parentSelector.children[0]
    let i = 0
    console.log(firstElement)
    parentSelector.insertAdjacentHTML('beforeend', clone)
    parentSelector.insertAdjacentHTML('beforeend', clone)

    setInterval(function () {
      firstElement.style.marginLeft = `-${i}px`
      if (i > firstElement.clientWidth) {
        i = 0
      }
      i = i + speed
    }, 0)
  }


  Marquee('#marquee', 0.5)

  window.addEventListener('resize', debounce(handleResize))

  updateScrollDirection()
  checkContentSize()
  scroll.init()
  


});
