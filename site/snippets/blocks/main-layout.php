<?php
// Initialize an array to hold the class names
$classes = ['main-layout'];

// Check if the background image toggle is enabled and add a class accordingly
if ($block->isImageBackground()->toBool()) {
    $classes[] = 'background-image';
}

// Add the class for content position
$contentPosition = $block->contentPosition()->value();
if (!empty($contentPosition)) {
    $classes[] = $contentPosition;
}

// Add the class for content order
$contentOrder = $block->contentOrder()->value();
if (!empty($contentOrder)) {
    $classes[] = $contentOrder;
}

// Convert the classes array into a space-separated string
$classString = implode(' ', $classes);

// Example string that might come from your blueprint or another source
$string = $block->effect();

// Replace 'uniqueID' with the dynamic value from $block->effectid()
$effectCode = str_replace('uniqueID', $block->effectid(), $string);

?>

<div class="<?= $classString ?>" id="">
  <?php if($image = $block->image()->toFile()): ?>
    <div class="image">
      <img id="<?= $block->effectid() ?>" src="<?= $image->url() ?>" alt="" <?= $effectCode ?>>
    </div>
  <?php endif ?>
  <?php if ($block->title()->isNotEmpty()): ?>
    <div class="content">
      <h2 class="title"><?= $block->title() ?></h2>
      <p class="text"><?= $block->text() ?></p>
    </div>
  <?php endif; ?>
</div>