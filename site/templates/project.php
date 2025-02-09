<?php snippet('global/header') ?>

<section class="scroll-view">
    
  <div class="carousel" data-scroll>
    
   <?php
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

      function toColorP3($hex) {
          $rgb = hexToRgb($hex);
          return "color(display-p3 {$rgb[0]} {$rgb[1]} {$rgb[2]})";
      }
      ?>

      <?php foreach ($page->layout()->toLayouts() as $layout): ?>
          <?php 
          // Get attributes
          $bgColor = $layout->attrs()->backgroundcolor()->toString();
          $customBg = $layout->attrs()->backgroundcolor_custom()->or(false);
          
          $textColor = $layout->attrs()->textcolor()->toString();
          $customText = $layout->attrs()->textcolor_custom()->or(false);
          
          // Convert custom colors to P3 format
          $bgColorP3 = $customBg ? toColorP3($customBg) : null;
          $textColorP3 = $customText ? toColorP3($customText) : null;

          // Determine class names (only if NOT custom)
          $bgClass = ($bgColor !== 'custom') ? $bgColor : '';
          $textClass = ($textColor !== 'custom') ? $textColor : '';

          // Determine inline styles (only if custom)
          $inlineStyle = '';
          if ($bgColor === 'custom' && $customBg) {
              $inlineStyle .= "background: {$customBg}; background: {$bgColorP3}; ";
          }
          if ($textColor === 'custom' && $customText) {
              $inlineStyle .= "color: {$customText}; color: {$textColorP3}; ";
          }

          $GLOBALS['layoutBgColor'] = $customBg ? $customBg : $bgColor; // Store the background color globally
          ?>

          <div 
              class="block layout <?= $page->uri() ?> <?= $layout->attrs()->class() ?> <?= $bgClass ?> <?= $textClass ?>" 
              id="<?= $layout->id() ?>" 
              data-scroll 
              style="<?= $inlineStyle ?>"
          >
              <?php foreach ($layout->columns() as $column): ?>
                  <div class="column" data-scroll style="--span:<?= $column->span() ?>">
                      <?php foreach ($column->blocks() as $block): ?>
                          <div class="item" data-scroll>
                              <?= $block->toHtml() ?>
                          </div>
                      <?php endforeach ?>
                  </div>
              <?php endforeach ?>
          </div>
      <?php endforeach ?>

    <?php snippet('global/about') ?>
      
    </div>

          
  </div>

</section>



<?php snippet('global/footer') ?>