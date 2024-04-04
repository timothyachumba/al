<?php
  function formatText($text) {
      // Remove dashes and capitalize the first letter of each word
      $formattedText = ucwords(str_replace('-', ' ', $text));
      return $formattedText;
  }
?>

<div class="ticker-wrapper">
  <div class="ticker" id="marquee">
    <div>
      <?php foreach ($block->details()->split() as $detail): ?>
        <span><?= formatText($detail) ?> •&nbsp;</span>
      <?php endforeach ?>
    </div>
  </div>
</div>