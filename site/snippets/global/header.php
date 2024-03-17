<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $site->title() ?> | <?php echo $page->title() ?></title>
  <?php snippet('seo/head'); ?>
  <?php echo css('../dist/assets/styles.css') ?>
  <?php snippet('favicon') ?>
</head>
<?php
$backgroundColor = $page->backgroundcolor()->isNotEmpty() ? $page->backgroundcolor() : '#000000';
$textColor = $page->textcolor()->isNotEmpty() ? $page->textcolor() : '#ffffff';
?>
<body class="<?= $template ?>" data-bgcolor="<?= $backgroundColor ?>" data-textcolor="<?= $textColor ?>">
<?php snippet('global/navigation') ?>
<div data-scroll-container>
  