<?php
  // Access block fields using $block->fieldname()->value()
  $tagline = $block->tagline()->value();
  $image = $block->image()->toFile()->thumb(['width' => 2500, 'format' => 'webp', 'quality' => 96]);
  $timing = $block->timing()->value();
  $launched = $block->launched()->value();
?>

<div class="project-hero aperture-hero">
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
    <div class="top">
      <div class="switcher">
        <div class="options normal-colors">
          <span>Regular</span>
          <span>Ortholinear</span>
        </div>
        <div class="slider">
          <div class="active-options">
            <span>Regular</span>
            <span>Ortholinear</span>
            
          </div>
          <?php echo var_dump(extension_loaded('imagick')); ?>
        </div>
      </div>
      <div class="project-hero__project-name"><span>AP-1<span></div>  
    </div>
    <div class="outline-layouts">
      <div class="regular-layout">
       <?php snippet('blocks/regular-layout') ?>
      </div>
      <div class="ortholinear-layout" style="display:none;">
        <?php snippet('blocks/ortholinear-layout') ?>
      </div>
    </div>
    
  </div> 
</div>
