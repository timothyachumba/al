<?php

/** @var \Kirby\Cms\Block $block */
$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$class   = $block->class(); // Add this line
$src     = null;

if ($block->location() == 'web') {
  $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
  $alt = $alt->or($image->alt());
  $src = $image->thumb([
    'format' => 'webp',
    'quality' => 94,
    'width' => 2800
  ])->url();
}

?>
<?php if ($src): ?>
<figure<?= Html::attr(['class' => $class, 'data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>>
  <?php if ($link->isNotEmpty()): ?>
  <a href="<?= Str::esc($link->toUrl()) ?>">
  <img src="<?= $src ?>" alt="<?= $alt->esc() ?>">
  </a>
  <?php else: ?>
  <img src="<?= $src ?>" alt="<?= $alt->esc() ?>">
  <?php endif ?>

  <?php if ($caption->isNotEmpty()): ?>
  <figcaption>
  <?= $caption ?>
  </figcaption>
  <?php endif ?>
</figure>
<?php endif ?>