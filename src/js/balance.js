document.addEventListener('DOMContentLoaded', function() {
  const box = document.querySelector('.project-hero__image__container img');
  const logo = document.querySelector('.project-hero__image__container svg');

  document.addEventListener('mousemove', function(e) {
    const mouseX = e.clientX; // Mouse X position
    const mouseY = e.clientY; // Mouse Y position
    const windowWidth = window.innerWidth / 2; // Half of window width
    const windowHeight = window.innerHeight / 2; // Half of window height

    // Calculate difference between mouse position and center of the screen
    const diffX = (windowWidth - mouseX) / 40;
    const diffY = (windowHeight - mouseY) / 40;

    const diffX2 = (windowWidth - mouseX) / 80;
    const diffY2 = (windowHeight - mouseY) / 80;

    // Apply the transformation
    box.style.transform = `translate(${diffX}px, ${diffY}px)`;
    logo.style.transform = `translate(${diffX2}px, ${diffY2}px)`;
  });
});