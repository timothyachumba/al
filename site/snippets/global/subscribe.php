<?php if (!$launched): ?>
      <?php snippet('dreamform/form', [
        'form' => $page->form()->toPage(),
        'attr' => [
          'row' => ['class' => 'row'],
          'column' => ['class' => 'column'],
          'field' => ['class' => 'field'],
        ]
      ]); ?>
    <?php else: ?>
      <button id="scrollButton" class="project-hero__header__timing"><?= $timing ?></button>
    <?php endif; ?>