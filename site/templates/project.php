<?php snippet('global/header') ?>

<section class="scroll-view">
    
  <div class="carousel">
    
    <?php foreach ($page->layout()->toLayouts() as $layout): ?>
      <div class="block layout <?= $layout->attrs()->class() ?> <?= $layout->attrs()->backgroundcolor() ?> <?= $layout->attrs()->textcolor() ?>" id="<?= $layout->id() ?>">
        <?php foreach ($layout->columns() as $column): ?>
        <div class="column" style="--span:<?= $column->span() ?>">
          <?php foreach ($column->blocks() as $block): ?>
            <div class="item">
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