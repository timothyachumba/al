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

    <div class="block layout the-designer bg-foreground t-neutral <?= $page->uri() ?>">
      <div class="portrait" style="-webkit-mask-image: url('<?= $site->image('me.png')->thumb(['width' => 600, 'format' => 'webp', 'quality' => 96])->url() ?>'); mask-image: url('<?= $site->image('me.png')->thumb(['width' => 600, 'format' => 'webp', 'quality' => 96])->url() ?>'); -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat; -webkit-mask-size: cover; mask-size: cover;">
        </div>
      <div class="bio">
        <h2>The Designer</h2>
        <p>Hi, I'm Timothy, the designer behind Akuko Labs. I'm usually designing digital experiences at tech companies but in my free time I like to pour my love for well crafted products into all things mechanical keyboards. Thanks for taking the time to look at some of the things I'm working on.</p>
        <div class="divider"></div>
        <?php snippet('global/subscribe') ?>
        <p>Be the first to know about updates on this and all other projects i am working on.</p>
        <div class="divider"></div>
        <ul class="links">
          <?php foreach ($site->socials()->toStructure() as $social): ?>
            <li>
              <a href="<?= $social->url() ?>" target="_blank" rel="noopener noreferrer" aria-label="Follow me on <?= $social->title() ?>" title="Follow me on <?= $social->title() ?>"> 
                <?= $social->title() ?>
              </a>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
      
    </div>

          
  </div>

</section>

<?php snippet('global/footer') ?>