document.querySelectorAll('.vendor-list__container__item__link').forEach(element => {
  element.addEventListener('mouseenter', function() {
    var dataValue = this.getAttribute('data-local');
    var dataDisplayDiv = document.getElementById('dataDisplay');
    dataDisplayDiv.innerHTML = dataValue;
    dataDisplayDiv.classList.add('visible');
  });
  
  element.addEventListener('mouseleave', function() {
    var dataDisplayDiv = document.getElementById('dataDisplay');
    dataDisplayDiv.innerHTML = '';
    dataDisplayDiv.classList.remove('visible');
  });
});

document.addEventListener('DOMContentLoaded', function() {
  // Ensure that the LocomotiveScroll instance is accessible globally
  if (typeof window.locomotiveScrollInstance !== 'undefined') {
    // Marquee function for continuous text effect
    function Marquee(selector, speed) {
      const parentSelector = document.querySelector(selector);
      const clone = parentSelector.innerHTML;
      const firstElement = parentSelector.children[0];
      let i = 0;
      parentSelector.insertAdjacentHTML('beforeend', clone);
      parentSelector.insertAdjacentHTML('beforeend', clone);

      setInterval(function() {
        firstElement.style.marginLeft = `-${i}px`;
        if (i > firstElement.clientWidth) {
          i = 0;
        }
        i += speed;
      }, 0);
    }

    // Scroll interactions for 'vendorList' and 'artisan' elements
    window.locomotiveScrollInstance.on('scroll', (args) => {
      // Handle vendor list progress
      if (args.currentElements['vendorList']) {
        let vendorListProgress = args.currentElements['vendorList'].progress;
        document.getElementById('vendor-list').style.transform = `translateY(${250 - (vendorListProgress * 500)}px)`;
      }

      // Handle artisan progress
      if (args.currentElements['artisan']) {
        let artisanProgress = args.currentElements['artisan'].progress;
        document.getElementById('artisan').style.transform = `scale(${1 + (artisanProgress / 2)})`;
      }
    });

    // Initialize Marquee
    Marquee('#marquee', 0.5);
  } else {
    console.error('LocomotiveScroll instance not found. Ensure it is initialized in global.js and is accessible globally.');
  }
});
