<?php snippet('global/header') ?>
<div class="content-container">
  <div class="content">
    <?php

    $action = get('action');
    $title = '';
    $body = '';

    switch ($action) {
      case 'confirm':
        $title = 'Almost in the Lab!';
        $body = 'Thanks for signing up for Lab Notes! Just one more step—check your email and confirm your subscription. Once you’re in, I’ll share behind-the-scenes updates, new designs, and stories from the creative process.';
        break;
      case 'subscribe':
        $title = 'Welcome to Lab Notes!';
        $body = 'You’re officially part of the Akuko Labs journey! I’m excited to share what I’m working on—from keycap concepts to design experiments. Thanks for joining; your support means the world to me.';
        break;
      case 'alreadysubscribed':
        $title = 'You’re Already in the Lab!';
        $body = 'Looks like you’re already subscribed to Lab Notes. That’s awesome! Stay tuned for updates, or check out the latest designs I’ve been working on.';
        break;
      case 'unsubscribed':
        $title = 'You’ve Left the Lab';
        $body = 'You’ve successfully unsubscribed from Lab Notes. I’ll miss having you along for the ride, but if you ever want to reconnect, you’re always welcome back.';
        break;
      default:
        go($page->children()->listed()->first()?->url() ?? 'home');
        break;
    }

    if ($title && $body) {
      echo snippet('onboarding', ['title' => $title, 'body' => $body]);
    }
    ?>
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
  </div>
</div>
<?php snippet('global/footer') ?>