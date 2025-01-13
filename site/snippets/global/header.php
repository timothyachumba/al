<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $site->title() ?> | <?php echo $page->title() ?></title>
  <?php snippet('seo/head'); ?>
  <?php echo css('../dist/assets/styles.css') ?>
  <?php snippet('favicon') ?>
  <meta name="p:domain_verify" content="641f43e6f4d7185dc36822cb6df2c17a"/>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-1YF7Q6FZDP"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-1YF7Q6FZDP');
  </script>
</head>
<?php
$backgroundColor = $page->backgroundcolor()->isNotEmpty() ? $page->backgroundcolor() : '#171717';
$textColor = $page->textcolor()->isNotEmpty() ? $page->textcolor() : '#EBE8E3';
?>
<body class="<?= $template ?>" data-bgcolor="<?= $backgroundColor ?>" data-textcolor="<?= $textColor ?>">
<div id="customCursor">
  <div id="cursor">
    <div id="dataDisplay"></div> <!-- Additional div for displaying data -->
  </div>
</div>
<?php snippet('global/navigation') ?>
<div data-scroll-container>
  