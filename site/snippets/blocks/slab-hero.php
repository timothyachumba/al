<?php
  // Access block fields using $block->fieldname()->value()
  $tagline = $block->tagline()->value();
  $image = $block->image()->toFile()->thumb(['width' => 2500, 'format' => 'webp', 'quality' => 96]);
  $timing = $block->timing()->value();
?>

<div class="project-hero slab-hero">
  <div class="project-hero__header">
    <p class="project-hero__header__tag">
      <?= $tagline ?>
    </p>
    <?php snippet('global/subscribe') ?>
  </div>
  <div class="project-hero__image">

    <div 
      class="project-hero__image__glass" 
      tlg-fluted-glass-canvas 
      tlg-fluted-glass-mode="mouse" 
      tlg-fluted-glass-segments="40" 
      tlg-fluted-glass-overlay="50" 
      tlg-fluted-glass-motion="0.4">
      <img tlg-fluted-glass-image src="<?= $image->url() ?>" alt="<?= $image->alt() ?>">
    </div>

  </div>
</div>

<script defer type="importmap"> { "imports": { "three": "https://cdn.jsdelivr.net/npm/three@0.165.0/build/three.module.min.js"} } </script>
<script defer type="module" src="https://cdn.jsdelivr.net/gh/the-lazy-god/tlg-fluted-glass@v2.0.0/tlg-fluted-glass.min.js"></script>