<?php
/** @var \Kirby\Cms\Block $block */
$images = $block->images()->toFiles();
$autoplay = $block->autoplay()->isTrue();
$delay = $block->delay()->or(3000);
?>

<?php if ($images && $images->isNotEmpty()): ?>
<div class="slideshow" data-autoplay="<?= $autoplay ? 'true' : 'false' ?>" data-delay="<?= $delay ?>">
  <?php foreach ($images as $image): ?>
    <div class="slideshow-slide">
      <img src="<?= $image->thumb(['width' => 1800, 'format' => 'webp', 'quality' => 96])->url() ?>" alt="<?= $image->alt() ?>">
    </div>
  <?php endforeach ?>
</div>
<?php endif ?>

<script>
  document.addEventListener('DOMContentLoaded', () => {
  const slideshows = document.querySelectorAll('.slideshow');

  slideshows.forEach(slideshow => {
    const slides = Array.from(slideshow.querySelectorAll('.slideshow-slide'));
    const delay = parseInt(slideshow.dataset.delay, 10) || 3000;
    let currentIndex = 0;

    // Apply necessary styles directly via JS
    slideshow.style.position = 'relative';
    slideshow.style.width = '100%';
    slideshow.style.maxWidth = '800px';
    slideshow.style.height = 'auto';
    slideshow.style.margin = '0 auto';

    slides.forEach(slide => {
      slide.style.position = 'absolute';
      slide.style.top = '0';
      slide.style.left = '0';
      slide.style.width = '100%';
      slide.style.height = '100%';
      slide.style.opacity = '0';
      slide.style.transition = 'opacity 1s ease';
    });

    // Show the first slide initially
    slides[currentIndex].style.opacity = '1';

    const showNextSlide = () => {
      // Hide the current slide
      slides[currentIndex].style.opacity = '0';

      // Move to the next slide (loop back if at the end)
      currentIndex = (currentIndex + 1) % slides.length;

      // Show the next slide
      slides[currentIndex].style.opacity = '1';
    };

    // Start the slideshow
    setInterval(showNextSlide, delay);
  });
});
</script> 