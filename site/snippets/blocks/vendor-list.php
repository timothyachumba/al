  <div class="vendor-list">
    <span>Vendor List</span>
    <div class="vendor-list__container" id="vendor-list">
      <?php foreach ($block->vendorlist()->toStructure() as $vendor): ?>
        <a href="<?= $vendor->url() ?>" class="vendor-list__container__item__link">
          <h3 class="vendor-list__container__item__name" data-hover-text="<?= $vendor->name() ?>"><?= $vendor->name() ?></h3>
        </a>
      <?php endforeach ?>
    </div>
    <span>Vendor List</span>
  </div>