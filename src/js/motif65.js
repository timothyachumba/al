// // Function to update the width and height on window resize
// function updateParentDimensions() {
//   // Select the parent element
//   const parentDiv = document.querySelector('.image-wrapper');
//   if (!parentDiv) return; // Prevent null reference

//   // Get its dimensions
//   const parentWidth = parentDiv.offsetWidth;
//   const parentHeight = parentDiv.offsetHeight;

//   // Set these as CSS variables on the :root
//   document.documentElement.style.setProperty('--parent-width', `${parentWidth}px`);
//   document.documentElement.style.setProperty('--parent-height', `${parentHeight}px`);
// }

// // Call the function initially
// updateParentDimensions();

// // Add event listener to update dimensions on window resize
// window.addEventListener('resize', updateParentDimensions);

// // Marquee function for continuous text effect
// function Marquee(selector, speed) {
//   const parentSelector = document.querySelector(selector);
//   if (!parentSelector) return;

//   const clone = parentSelector.innerHTML;
//   const firstElement = parentSelector.children[0];
//   let i = 0;
//   parentSelector.insertAdjacentHTML('beforeend', clone);
//   parentSelector.insertAdjacentHTML('beforeend', clone);

//   setInterval(function() {
//     firstElement.style.marginLeft = `-${i}px`;
//     if (i > firstElement.clientWidth) {
//       i = 0;
//     }
//     i += speed;
//   }, 20); // Set a 20ms interval
// }

// document.addEventListener('DOMContentLoaded', function() {
//   // Initialize Marquee regardless of LocomotiveScroll
//   Marquee('#marquee', 0.5);

//   // Ensure that the LocomotiveScroll instance is accessible globally
//   if (typeof window.locomotiveScrollInstance !== 'undefined') {
//     // Scroll interactions for 'vendorList' and 'artisan' elements
//     window.locomotiveScrollInstance.on('scroll', (args) => {
//       // Handle vendor list progress
//       if (args.currentElements['vendorList']) {
//         let vendorListProgress = args.currentElements['vendorList'].progress;
//         document.getElementById('vendor-list').style.transform = `translateY(${250 - (vendorListProgress * 500)}px)`;
//       }

//       // Handle artisan progress
//       if (args.currentElements['artisan']) {
//         let artisanProgress = args.currentElements['artisan'].progress;
//         document.getElementById('artisan').style.transform = `scale(${1 + (artisanProgress / 2)})`;
//       }
//     });

//     // Function to scroll to vendor section using LocomotiveScroll
//     function scrollToVendor() {
//       // Get the target element
//       const vendorSection = document.querySelector('#vendor-list-wrapper');

//       // Scroll to the vendor section
//       window.locomotiveScrollInstance.scrollTo(vendorSection);
//     }

//     // Add event listener to the button
//     const scrollButton = document.getElementById('scrollButton');
//     if (scrollButton) {
//       scrollButton.addEventListener('click', scrollToVendor);
//     }
    
//   } else {
//     console.log('LocomotiveScroll instance not found. Ensuring Marquee still works.');

//     // Function to scroll to vendor section without LocomotiveScroll
//     function scrollToVendor() {
//       // Get the target element
//       const vendorSection = document.querySelector('#vendor-list-wrapper');

//       // Scroll to the vendor section smoothly
//       vendorSection.scrollIntoView({ behavior: 'smooth' });
//       console.log('Scrolled to vendor section without LocomotiveScroll.');
//     }

//     // Add event listener to the button
//     const scrollButton = document.getElementById('scrollButton');
//     if (scrollButton) {
//       scrollButton.addEventListener('click', scrollToVendor);
//     }
//   }
// });
