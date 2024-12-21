  </div>

  <script nomodule src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.6.0/polyfill.min.js" crossorigin="anonymous" async></script>
  <script nomodule src="https://polyfill.io/v3/polyfill.min.js?features=Object.assign%2CElement.prototype.append%2CNodeList.prototype.forEach%2CCustomEvent%2Csmoothscroll" crossorigin="anonymous" async></script>
  
  <?php snippet('seo/schemas'); ?>
  <script src="https://unpkg.com/htmx.org@1.9.11" integrity="sha384-0gxUXCCR8yv9FM2b+U3FDbsKthCI66oH5IA9fHppQq9DDMHuMauqq1ZHBpJxQ0J0" crossorigin="anonymous"></script>
  <?php echo js('../dist/assets/global.js'); ?>
  <?php if ($template === 'project'): ?>
    <?php echo js('../dist/assets/project.js'); ?>
  <?php endif; ?>
  <?php echo js('../dist/assets/' . $page->uri() . '.js'); ?>

  </body>
  </html>
