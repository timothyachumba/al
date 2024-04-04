  <div class="vendor-list">
    <span class="section-title">Where to Buy</span>
    <div class="vendor-list__container" id="vendor-list" data-scroll data-scroll-id="vendorList">
      <?php foreach ($block->vendorlist()->toStructure() as $vendor): ?>
        <a href="<?= $vendor->url() ?>" class="vendor-list__container__item__link">
          <h3 class="vendor-list__container__item__name" data-hover-text="<?= $vendor->name() ?>"><?= $vendor->name() ?></h3>
        </a>
      <?php endforeach ?>
      <?php foreach ($block->vendorlist()->toStructure() as $vendor): ?>
        <a href="<?= $vendor->url() ?>" class="vendor-list__container__item__link">
          <h3 class="vendor-list__container__item__name" data-hover-text="<?= $vendor->name() ?>"><?= $vendor->name() ?></h3>
        </a>
      <?php endforeach ?>
      <?php foreach ($block->vendorlist()->toStructure() as $vendor): ?>
        <a href="<?= $vendor->url() ?>" class="vendor-list__container__item__link">
          <h3 class="vendor-list__container__item__name" data-hover-text="<?= $vendor->name() ?>"><?= $vendor->name() ?></h3>
        </a>
      <?php endforeach ?>
    </div>
    <span class="section-title">Vendor List</span>
  </div>