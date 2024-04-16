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
    <svg class="a" viewBox="0 0 218 300" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M88.4365 0C78.2578 0 68.9526 5.75088 64.4006 14.855L2.83706 137.982C0.971325 141.714 0 145.828 0 150V273.127C0 287.969 12.0314 300 26.873 300C41.7145 300 53.7459 287.969 53.7459 273.127V238.436H164.169V273.127C164.169 287.969 176.201 300 191.042 300C205.884 300 217.915 287.969 217.915 273.127V150C217.915 145.828 216.944 141.714 215.078 137.982L153.515 14.855C148.963 5.75088 139.658 0 129.479 0H88.4365ZM164.169 184.69V156.344L112.87 53.7459H105.045L53.7459 156.344V184.69H164.169Z" fill="#F1B313" style="fill:#F1B313;fill:color(display-p3 0.9458 0.7021 0.0751);fill-opacity:1;"/>
    </svg>
    
    <svg class="p" viewBox="0 0 218 300" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M0 26.873C0 12.0314 12.0314 0 26.873 0H150C187.509 0 217.915 30.4067 217.915 67.9153V108.958C217.915 146.466 187.509 176.873 150 176.873H53.7459V273.127C53.7459 287.969 41.7145 300 26.873 300C12.0314 300 0 287.969 0 273.127V26.873ZM53.7459 123.127H150C157.826 123.127 164.169 116.783 164.169 108.958V67.9153C164.169 60.0898 157.826 53.7459 150 53.7459H53.7459V123.127Z" fill="#F1B313" style="fill:#F1B313;fill:color(display-p3 0.9458 0.7021 0.0751);fill-opacity:1;"/>
    </svg>


    <div class="project-hero__image__fill" style="background-image: url('<?= $image->url() ?>')"></div>
  </div> 
</div>