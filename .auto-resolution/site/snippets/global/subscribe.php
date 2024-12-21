<?php
  $string = $page->title();
  $lowercaseString = strtolower($string);
  $slug = str_replace(" ", "-", $lowercaseString);
?>

<form
  action="https://buttondown.email/api/emails/embed-subscribe/akukolabs"
  method="post"
  target="popupwindow"
  onsubmit="window.open('https://buttondown.email/akukolabs', 'popupwindow')"
  class="embeddable-buttondown-form"
>
  <input type="email" name="email" placeholder="Email Address" id="bd-email" aria-required="true"/>
  <?php if ($template === 'project'): ?>
    <input type="hidden" name="tag" value="<?= $page->uri() ?>" />
  <?php endif ?>
  <button class="button small" type="submit">Join Waitlist</button>
</form>