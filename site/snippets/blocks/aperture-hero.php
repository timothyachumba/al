<?php
  // Access block fields using $block->fieldname()->value()
  $tagline = $block->tagline()->value();
  $image = $block->image()->toFile()->thumb(['width' => 2500, 'format' => 'webp', 'quality' => 96]);
  $timing = $block->timing()->value();
?>

<div class="project-hero aperture-hero">
  <div class="project-hero__header">
    <p class="project-hero__header__tag">
      <?= $tagline ?>
    </p>
    <?php snippet('global/subscribe') ?>
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
