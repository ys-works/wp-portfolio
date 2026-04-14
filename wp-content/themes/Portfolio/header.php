<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>
  id="<?php
      if (is_front_page() || is_home()) {
        echo 'top';
      } elseif (is_page()) {
        echo 'page';
      } elseif (is_single()) {
        echo 'single';
      } else {
        echo 'other';
      }
      ?>">
  <header>
    <div class="header-wrap">
      <div class="logo"><a href="<?php bloginfo('url'); ?>">Portforio</a></div>
      <nav>
        <ul>
          <li><a href="/product/" class="nav-link nav-product"><span>Product</span></a></li>
          <li><a href="/about/" class="nav-link nav-about"><span>About</span></a></li>
          <li><a href="/news/" class="nav-link nav-news"><span>News</span></a></li>
          <li><a href="/inquiry/" class="nav-link nav-contact"><span>Contact</span></a></li>
        </ul>
      </nav>
    </div>
  </header>