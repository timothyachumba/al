<?php
  // Access block fields using $block->fieldname()->value()
  $tagline = $block->tagline()->value();
  $images = $block->images()->toStructure(); // Assuming a structured field for images
?>

<div class="project-hero motif-hero">
  <div class="project-hero__header">
    <p class="project-hero__header__tag">
      <?= $tagline ?>
    </p>
    <?php snippet('global/subscribe') ?>
  </div>
  <div class="project-hero__image">
    <div class="motif-grid">
      <div class="motif-grid__row motif-grid__row--top">
        <?php
        $row1Images = $images->slice(0, 2); // First two images
        foreach ($row1Images as $image) :
          $image2d = $image->image2d()->toFile();
          $image3d = $image->image3d()->toFile();
        ?>
        <div class="motif-grid__item">
          <div class="image-container">
            <div class="image-wrapper">
              <img class="image-2d" src="<?= $image2d->url() ?>" alt="2D Image">
              <img class="image-3d" src="<?= $image3d->url() ?>" alt="3D Image">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="motif-grid__row motif-grid__row--bottom">
        <?php
        $row2Images = $images->slice(2, 3); // Next three images
        foreach ($row2Images as $image) :
          $image2d = $image->image2d()->toFile();
          $image3d = $image->image3d()->toFile();
        ?>
        <div class="motif-grid__item">
          <div class="image-container">
            <div class="image-wrapper">
              <img class="image-2d" src="<?= $image2d->url() ?>" alt="2D Image">
              <img class="image-3d" src="<?= $image3d->url() ?>" alt="3D Image">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div> 
</div>