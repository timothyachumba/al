const switcher = document.querySelector('.switcher')
const options = document.querySelectorAll('.options.normal-colors span')
const slider = document.querySelector('.slider')
const activeOptions = slider.querySelector('.active-options')

// Layout containers
const regularLayout = document.querySelector('.regular-layout')
const ortholinearLayout = document.querySelector('.ortholinear-layout')

// Utility to sync widths of active and normal options
function syncWidths() {
  const normalWidth = switcher.querySelector('.normal-colors').offsetWidth
  activeOptions.style.width = `${normalWidth}px`
}

// Function to toggle layouts based on selected option
function toggleLayouts(selectedOption) {
  if (selectedOption.textContent.trim() === 'Regular') {
    regularLayout.style.display = 'block'
    ortholinearLayout.style.display = 'none'
  } else if (selectedOption.textContent.trim() === 'Ortholinear') {
    regularLayout.style.display = 'none'
    ortholinearLayout.style.display = 'block'
  }
}

// Function to position the slider and active options
function positionSlider(selectedOption) {
  const switcherRect = switcher.getBoundingClientRect()
  const selectedRect = selectedOption.getBoundingClientRect()

  // Sync widths
  syncWidths()

  // Check if the first option is selected
  if (selectedOption === options[0]) {
    slider.style.transform = `translateX(0)`
    slider.style.width = `${selectedRect.width}px`
    activeOptions.style.transform = `translateX(0)`
    toggleLayouts(selectedOption)
    return
  }

  // Calculate the transform distance
  const left = selectedRect.left - switcherRect.left
  const width = selectedRect.width

  // Move slider and set its width
  slider.style.transform = `translateX(${left}px)`
  slider.style.width = `${width}px`

  // Move active options in the opposite direction
  activeOptions.style.transform = `translateX(${-left}px)`

  // Toggle layouts
  toggleLayouts(selectedOption)
}

// Toggle between the two options
function toggleSwitch() {
  const activeOption = document.querySelector('.options .active') || options[0]
  const nextOption = activeOption === options[0] ? options[1] : options[0]
  positionSlider(nextOption)
  options.forEach(opt => opt.classList.remove('active'))
  nextOption.classList.add('active')
}

// Initialize slider on load
window.addEventListener('DOMContentLoaded', () => {
  const selectedOption = document.querySelector('.options .active') || options[0]
  positionSlider(selectedOption)
})

// Handle clicks to toggle between options
switcher.addEventListener('click', toggleSwitch)

// Recalculate dimensions on window resize
window.addEventListener('resize', () => {
  syncWidths() // Keep widths consistent on resize
  const selectedOption = document.querySelector('.options .active') || options[0]
  positionSlider(selectedOption)
})

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

    // Function to scroll to vendor section
    function scrollToVendor() {
        // Get the target element
        const vendorSection = document.querySelector('#vendor-list-wrapper');

        // Scroll to the vendor section
        window.locomotiveScrollInstance.scrollTo(vendorSection);
    }

    // Add event listener to the button
    const scrollButton = document.getElementById('scrollButton');
    scrollButton.addEventListener('click', scrollToVendor);
    
  } else {
    console.log('LocomotiveScroll instance not found. Ensure it is initialized in global.js and is accessible globally.');
    function scrollToVendor() {
        // Get the target element
        const vendorSection = document.querySelector('#vendor-list-wrapper');

        // Scroll to the vendor section
      vendorSection.scrollIntoView({ behavior: 'smooth' });
      console.log('hello');
    }

    const scrollButton = document.getElementById('scrollButton');
    scrollButton.addEventListener('click', scrollToVendor);
    
  }

  


});
