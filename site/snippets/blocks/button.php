
<?php
  // Access block fields using $block->fieldname()->value()
  $buttonlabel = $block->buttonlabel()->value();
  $fullwidth = $block->fullwidth()->toBool();
  $parentTextColor = $block->parent()->backgroundColor()->value();
  $parentBackgroundColor = $block->parent()->textColor()->value();
  $buttonlink = $block->buttonlink()->value();
  $buttonClass = $buttonlink ? 'button small' : 'button small purchase-trigger';
  $buttonClass .= $fullwidth ? ' full-width' : '';
?>

<?php if ($buttonlink): ?>
  <a href="<?= $buttonlink ?>" class="<?= $buttonClass ?>" style="background-color: <?= $parentTextColor ?>; background-color: <?= toColorP3($parentTextColor) ?>; color: <?= $parentBackgroundColor ?>; color: <?= toColorP3($parentBackgroundColor) ?>;">
    <?= $buttonlabel ?>
  </a>
<?php else: ?>
  <button class="<?= $buttonClass ?>" style="background-color: <?= $parentTextColor ?>; background-color: <?= toColorP3($parentTextColor) ?>; color: <?= $parentBackgroundColor ?>; color: <?= toColorP3($parentBackgroundColor) ?>;">
    <?= $buttonlabel ?>
  </button>
<?php endif; ?>