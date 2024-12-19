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
</head>
<?php
$backgroundColor = $page->backgroundcolor()->isNotEmpty() ? $page->backgroundcolor() : '#000000';
$textColor = $page->textcolor()->isNotEmpty() ? $page->textcolor() : '#ffffff';
?>
<body class="<?= $template ?>" data-bgcolor="<?= $backgroundColor ?>" data-textcolor="<?= $textColor ?>">
<div id="customCursor">
  <div id="cursor">
    <div id="dataDisplay"></div> <!-- Additional div for displaying data -->
  </div>
</div>
<?php snippet('global/navigation') ?>
<div data-scroll-container>
  