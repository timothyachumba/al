<?php
// Initialize an array to hold the class names

$buttonEnabled = $block->buttonEnabled()->toBool(); // Assuming this is the field to check if the button is enabled
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

if ($buttonEnabled) {
  $classes[] = 'with-button';
}

// Convert the classes array into a space-separated string
$classString = implode(' ', $classes);

// Example string that might come from your blueprint or another source
$string = $block->effect();

// Replace 'uniqueID' with the dynamic value from $block->effectid()
$effectCode = str_replace('uniqueID', $block->effectid(), $string);

if (!function_exists('hexToRgb')) {
    function hexToRgb($hex) {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        $r = hexdec(substr($hex, 0, 2)) / 255;
        $g = hexdec(substr($hex, 2, 2)) / 255;
        $b = hexdec(substr($hex, 4, 2)) / 255;
        return [$r, $g, $b];
    }
}

if (!function_exists('toColorP3')) {
    function toColorP3($hex) {
        $rgb = hexToRgb($hex);
        return "color(display-p3 {$rgb[0]} {$rgb[1]} {$rgb[2]})";
    }
}

$backgroundColor = $block->backgroundColor()->toString();
$globalbgColor = $GLOBALS['layoutBgColor'] ?? '#000000'; // Default fallback

?>

<div class="<?= $classString ?> " id="" <?= $backgroundColor ? 'style="background-color: ' . toColorP3($backgroundColor) . '"' : '' ?>>
  <?php if($image = $block->image()->toFile()): ?>
  <div class="image">
    <img id="<?= $block->effectid() ?>" src="<?= $image->thumb(['width' => 2800, 'format' => 'webp', 'quality' => 96])->url() ?>" alt="" <?= $effectCode ?>>
  </div>
  <?php endif ?>
  <?php if ($block->title()->isNotEmpty()): ?>
    <?php if ($buttonEnabled): ?>
      <div class="content">
        <div class="content-stack">
        <h2 class="title"><?= $block->title() ?></h2>
        <p class="text"><?= $block->text() ?></p>
        </div>
        <button class="button small purchase-trigger" style="color: <?= $globalbgColor ?>;">
          <?= $block->buttonlabel() ?>
        </button>
      </div>
    <?php else: ?>
      <div class="content">
        <h2 class="title"><?= $block->title() ?></h2>
        <p class="text"><?= $block->text() ?></p>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>