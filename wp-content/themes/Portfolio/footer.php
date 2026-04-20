<footer>
  <div class="footer-wrap">
    <div class="footer-container-up">
      <div class="footer-links">
        <?php
        $product_page = get_page_by_path('product');
        if ($product_page) : ?>
          <ul>
            <li><a href="<?php echo get_permalink($product_page->ID); ?>">Product</a></li>
          </ul>
        <?php endif; ?>
        <?php footer_nav_links('about'); ?>
        <?php footer_nav_news(); ?>
        <ul>
          <ul>
            <?php $contact_page = get_page_by_path('inquiry'); ?>
            <?php if ($contact_page) : ?>
              <li><a href="<?php echo get_permalink($contact_page->ID); ?>">Contact</a></li>
            <?php endif; ?>
            <li class="external-link">
              <a href="https://ys-works-portforio-next.vercel.app/" target="_blank" rel="noopener noreferrer">花粉情報</a>
            </li>
          </ul>

      </div>
    </div>
    <div class="footer-container-bottom">
      <div class="footer-logo">
        <a href="<?php bloginfo('url'); ?>">Portfolio</a>
      </div>
      <ul>
        <li><a href="<?php echo get_permalink(get_page_by_path('privacy-policy')->ID); ?>">Privacy Policy</a></li>
      </ul>
    </div>
    <div class="copy-wrap">
      <p class="copyright">&copy; 2026 Portforio. All rights reserved.</p>
    </div>
  </div>
  <?php wp_footer(); ?>
</footer>
</body>

</html>