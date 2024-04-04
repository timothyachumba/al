<nav class="global-navigation <?= $page->uri() ?>">
  <div class="logo">
    <!-- Use an <a> tag with aria-label for the logo -->
    <a href="<?= $site->url() ?>" aria-label="Site Logo">
      <?php if ($site->logo()->toFile()): ?>
        <?= svg($site->logo()->toFile()) ?>
      <?php endif ?>
    </a>
  </div>
  <ul class="social">
    <!-- Include aria-labels for social media links -->
    <?php foreach ($site->socials()->toStructure() as $social): ?>
      <li>
        <a href="<?= $social->url() ?>" target="_blank" rel="noopener noreferrer" aria-label="Follow me on <?= $social->title() ?>" title="Follow me on <?= $social->title() ?>"> 
          <?= svg($social->icon()->toFile()) ?>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
  <!-- Convert subscribe div to a button -->
  <a class="subscribe-button button small" href="<?= $site->newsletter() ?>" target="_blank" rel="noopener noreferrer" aria-label="Subscribe to get updates on releases" title="Subscribe to get updates on releases">Get Updates</a>
  <!-- Convert nav-button div to a button -->
  <button class="nav-button">
    <div class="nav-button__lines">
      <span class="nav-button__line"></span>
      <span class="nav-button__line"></span>
      <span class="nav-button__line"></span>
    </div>
  </button>
</nav>
<div class="nav-project-drawer">
  <ul>
    <!-- Ensure project links are descriptive and accessible -->
    <?php foreach ($site->children()->filterBy('template', 'project') as $project): ?>
      <li class="nav-project-drawer__item">
        <a href="<?= $project->url() ?>" rel="noopener noreferrer" aria-label="Learn more about <?= $project->title() ?>">
          <div class="nav-project-drawer__item__image" style="background-image:url('<?= $project->cover()->toFile()->thumb(['width' => 600, 'format' => 'webp', 'quality' => 96])->url() ?>')">
          </div>
          <div class="nav-project-drawer__item__title" style="background-color:<?= $project->backgroundcolor() ?>;color:<?= $project->textcolor() ?>">
              <?= $project->title() ?>
            </div> 
        </a>
      </li>
    <?php endforeach ?>
  </ul>
</div>
