<?php
  // Access block fields using $block->fieldname()->value()
  $tagline = $block->tagline()->value();
  $image = $block->image()->toFile()->thumb(['width' => 2500, 'format' => 'webp', 'quality' => 96]);
  $timing = $block->timing()->value();
  $launched = $block->launched()->value();
?>

<div class="project-hero slab-hero">
  <div class="project-hero__header">
    <p class="project-hero__header__tag">
      <?= $tagline ?>
    </p>
    <?php if (!$launched): ?>
      <?php snippet('dreamform/form', [
        'form' => $page->form()->toPage(),
        'attr' => [
          'row' => ['class' => 'row'],
          'column' => ['class' => 'column'],
          'field' => ['class' => 'field'],
        ]
      ]); ?>
    <?php else: ?>
      <button id="scrollButton" class="project-hero__header__timing"><?= $timing ?></button>
    <?php endif; ?>
  </div>
  <div class="project-hero__image">
    <img data-scroll data-scroll-speed="-1" src="<?= $image->url() ?>" alt="<?= $image->alt() ?>">
  </div>
</div>
