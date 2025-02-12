<?php
  // Determine project status
  $availability = $page->availability();

  $vendorList = $page->vendorlist()->toStructure();
?>

<!-- Purchase Drawer (similar to your navigation drawer) -->
<div class="purchase-drawer" id="purchaseDrawer">
  <button class="purchase-drawer__close" aria-label="Close">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.34316 4.92894C5.95263 4.53842 5.31947 4.53842 4.92894 4.92894C4.53842 5.31946 4.53842 5.95263 4.92894 6.34315L10.5858 12L4.92894 17.6569C4.53842 18.0474 4.53842 18.6806 4.92894 19.0711C5.31946 19.4616 5.95263 19.4616 6.34315 19.0711L12 13.4142L17.6569 19.0711C18.0474 19.4616 18.6806 19.4616 19.0711 19.0711C19.4616 18.6806 19.4616 18.0474 19.0711 17.6569L13.4142 12L19.0711 6.34315C19.4616 5.95263 19.4616 5.31947 19.0711 4.92894C18.6806 4.53842 18.0474 4.53842 17.6569 4.92894L12 10.5858L6.34316 4.92894Z" fill="#ECE2CD" style="fill:#ECE2CD;fill:color(display-p3 0.9255 0.8863 0.8039);fill-opacity:1;"/>
    </svg>

  </button>
  <div class="purchase-drawer__content">
    <?php if (!$page->availability()->bool()): ?>
      <!-- Waitlist Version: Show waitlist copy and form -->
      <header class="purchase-drawer__header">
        <h2>Join the waitlist</h2>
        <p>
          Thanks so much for your interest in <?= $page->title() ?>! While I'm still putting the finishing touches on it, we have a lot more in store.
        </p>
        <p>
          By joining my newsletter, you'll not only be the first to hear about this project's launch but also receive exclusive updates on our other upcoming initiatives. I appreciate your support and look forward to sharing our progress with you.
        </p>
      </header>
      <div class="waitlist-form">
      <?php snippet('dreamform/form', [
        'form' => $page->form()->toPage(),
        'attr' => [
          'row' => ['class' => 'row'],
          'column' => ['class' => 'column'],
          'field' => ['class' => 'field'],
        ]
      ]); ?>
      </div>
    <?php else: ?>
      <!-- Available Version: Show vendor list -->
      <header class="purchase-drawer__header">
        <h2>How to Buy</h2>
        <p><?= $page->title() ?> is available through a Group Buy, meaning it's produced in a limited run based on pre-orders. To make the process seamless, I've partnered with trusted regional stores worldwide, allowing you to order from a store in your region for better shipping rates and convenience.</p>
        <p>Once the Group Buy closes, production begins, and orders will be fulfilled based on the estimated timeline.</p>
      </header>
      <header class="purchase-drawer__header vendors">
        <h2>Where to Buy</h2>
        <section class="purchase-drawer__vendors">
        <ul class="vendorlist">
          <?php foreach ($vendorList as $vendor): ?>
            <li class="vendorlist__item">
              <a href="<?= $vendor->url()->isNotEmpty() ? $vendor->url() : '#' ?>" target="_blank" rel="noopener noreferrer">
                <span class="vendorlist__name"><?= $vendor->name() ?><span class="vendorlist__arrow">
                  <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <mask id="path-1-outside-1_176_13614" maskUnits="userSpaceOnUse" x="1.16602" y="1.16663" width="11" height="11" fill="black">
                  <rect fill="white" x="1.16602" y="1.16663" width="11" height="11"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4877 8.12496C10.1886 8.12496 9.94604 7.88245 9.94604 7.58329V4.01647L3.0907 10.8718C2.87916 11.0834 2.5362 11.0834 2.32467 10.8718C2.11313 10.6603 2.11313 10.3173 2.32467 10.1058L9.18046 3.24999L5.61271 3.24999C5.31356 3.24999 5.07104 3.00748 5.07104 2.70833C5.07104 2.40917 5.31356 2.16666 5.61271 2.16666L10.4817 2.16666L10.4877 2.16663C10.746 2.16663 10.9621 2.34742 11.0163 2.58936C11.0249 2.62763 11.0294 2.66743 11.0294 2.70829V2.70833V7.58329C11.0294 7.88245 10.7869 8.12496 10.4877 8.12496Z"/>
                  </mask>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4877 8.12496C10.1886 8.12496 9.94604 7.88245 9.94604 7.58329V4.01647L3.0907 10.8718C2.87916 11.0834 2.5362 11.0834 2.32467 10.8718C2.11313 10.6603 2.11313 10.3173 2.32467 10.1058L9.18046 3.24999L5.61271 3.24999C5.31356 3.24999 5.07104 3.00748 5.07104 2.70833C5.07104 2.40917 5.31356 2.16666 5.61271 2.16666L10.4817 2.16666L10.4877 2.16663C10.746 2.16663 10.9621 2.34742 11.0163 2.58936C11.0249 2.62763 11.0294 2.66743 11.0294 2.70829V2.70833V7.58329C11.0294 7.88245 10.7869 8.12496 10.4877 8.12496Z" fill="#E4D7CB" style="fill:#E4D7CB;fill:color(display-p3 0.8924 0.8434 0.7976);fill-opacity:1;"/>
                  <path d="M9.94604 4.01647H10.446V2.80936L9.59249 3.66292L9.94604 4.01647ZM3.0907 10.8718L3.44425 11.2254L3.44425 11.2254L3.0907 10.8718ZM2.32467 10.8718L1.97111 11.2254L1.97111 11.2254L2.32467 10.8718ZM2.32467 10.1058L1.97111 9.75223L2.32467 10.1058ZM9.18046 3.24999L9.53401 3.60355L10.3876 2.74999L9.18046 2.74999L9.18046 3.24999ZM5.61271 3.24999L5.61271 3.74999H5.61271L5.61271 3.24999ZM5.61271 2.16666L5.61271 2.66666L5.61271 2.16666ZM10.4817 2.16666L10.4817 2.66667L10.4844 2.66665L10.4817 2.16666ZM10.4877 2.16663L10.4877 1.66662L10.485 1.66663L10.4877 2.16663ZM11.0163 2.58936L10.5284 2.69867L10.5284 2.69867L11.0163 2.58936ZM9.44604 7.58329C9.44604 8.15859 9.91242 8.62496 10.4877 8.62496V7.62496C10.4647 7.62496 10.446 7.6063 10.446 7.58329H9.44604ZM9.44604 4.01647V7.58329H10.446V4.01647H9.44604ZM9.59249 3.66292L2.73714 10.5183L3.44425 11.2254L10.2996 4.37002L9.59249 3.66292ZM2.73715 10.5183C2.72087 10.5345 2.69449 10.5345 2.67822 10.5183L1.97111 11.2254C2.37791 11.6322 3.03746 11.6322 3.44425 11.2254L2.73715 10.5183ZM2.67822 10.5183C2.66195 10.502 2.66195 10.4756 2.67822 10.4593L1.97111 9.75223C1.56432 10.159 1.56432 10.8186 1.97111 11.2254L2.67822 10.5183ZM2.67822 10.4593L9.53401 3.60355L8.8269 2.89644L1.97111 9.75223L2.67822 10.4593ZM5.61271 3.74999L9.18046 3.74999L9.18046 2.74999L5.61271 2.74999L5.61271 3.74999ZM4.57104 2.70833C4.57104 3.28362 5.03742 3.74999 5.61271 3.74999V2.74999C5.5897 2.74999 5.57104 2.73134 5.57104 2.70833H4.57104ZM5.61271 1.66666C5.03741 1.66666 4.57104 2.13303 4.57104 2.70833H5.57104C5.57104 2.68531 5.5897 2.66666 5.61271 2.66666L5.61271 1.66666ZM10.4817 1.66666L5.61271 1.66666L5.61271 2.66666L10.4817 2.66666L10.4817 1.66666ZM10.485 1.66663L10.479 1.66667L10.4844 2.66665L10.4904 2.66662L10.485 1.66663ZM11.5042 2.48005C11.3999 2.01469 10.9851 1.66663 10.4877 1.66663V2.66663C10.4981 2.66663 10.5064 2.6698 10.5137 2.6757C10.5217 2.68219 10.5266 2.69056 10.5284 2.69867L11.5042 2.48005ZM11.5294 2.70829C11.5294 2.63042 11.5207 2.55397 11.5042 2.48005L10.5284 2.69867C10.529 2.70129 10.5294 2.70444 10.5294 2.70829H11.5294ZM11.5294 2.70833V2.70829H10.5294V2.70833H11.5294ZM11.5294 7.58329V2.70833H10.5294V7.58329H11.5294ZM10.4877 8.62496C11.063 8.62496 11.5294 8.15859 11.5294 7.58329H10.5294C10.5294 7.60631 10.5107 7.62496 10.4877 7.62496V8.62496Z" fill="#E4D7CB" style="fill:#E4D7CB;fill:color(display-p3 0.8924 0.8434 0.7976);fill-opacity:1;" mask="url(#path-1-outside-1_176_13614)"/>
                  </svg>
                </span></span>
                
                <span class="vendorlist__region"><?= $vendor->region() ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
      </header>
      <div class="divider"></div>
      
      
    <?php endif; ?>
    
  </div>
  <ul class="links">
    <?php foreach ($site->socials()->toStructure() as $social): ?>
      <li>
        <a href="<?= $social->url() ?>" target="_blank" rel="noopener noreferrer" aria-label="Follow me on <?= $social->title() ?>" title="Follow me on <?= $social->title() ?>"> 
          <?= $social->title() ?>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
</div>