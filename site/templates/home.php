<?php snippet('global/header') ?>



<section class="scroll-view">
    
  <div class="carousel">
    <?php foreach ($projects as $project): ?>
      <a href="<?= $project->url() ?>" class="block <?php if($project->first()){echo 'is-inview';}?>" data-scroll data-scroll-repeat="true" data-scroll-offset="70%, 30%">
        
        <div class="project-card" style="background-color: <?= $project->backgroundcolor() ?>">
          <div class="project-card__image__container">
            <img class="project-card__image" src="<?php echo $project->cover()->toFile()->url() ?>" alt="">
          </div>
          <div class="project-card__content">
            <div class="project-card__overlay"></div>
            <h2 class="project-card__title"><?php echo implode("<br>", explode(" ", $project->title())) ?></h2>
            <div class="project-card__description"><?php echo $project->projectintro()->kt() ?></div>
          </div>
        </div>


      </a>
    <?php endforeach ?>
      
  </div>

</section>

<?php snippet('global/footer') ?>