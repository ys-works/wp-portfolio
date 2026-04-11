<?php
/* Template Name: 会社情報 */
get_header();
?>
<main>
  <div class="main-visual">
    <nav class="breadcrumb">
      <a href="<?php echo home_url('/'); ?>">TOP</a>
      &nbsp;&gt;&nbsp;
      <?php
      $parent_id = wp_get_post_parent_id(get_the_ID());
      if ($parent_id) : ?>
        <a href="<?php echo get_permalink($parent_id); ?>">
          <?php echo get_the_title($parent_id); ?>
        </a>
        &nbsp;&gt;&nbsp;
      <?php endif; ?>
      <span><?php the_title(); ?></span>
    </nav>
    <div class="main-visual-inner">
      <h1><?php the_title(); ?></h1>
    </div>
  </div>
  <section>
    <div class="about-inner">
      <div class="about-item js-fade-up">
        <a href="/about/greeting/">
          <h2 class="about-item-title">ご挨拶</h2>
          <div class="about-item-content">
            <img src="/wp-content/themes/Portfolio/assets/images/About/greeting.jpg" alt="ご挨拶">
          </div>
        </a>
      </div>

      <div class="about-item js-fade-up">
        <a href="/about/overview/">
          <h2 class="about-item-title">会社概要</h2>
          <div class="about-item-content">
            <img src="/wp-content/themes/Portfolio/assets/images/About/overview.jpg" alt="会社概要">
          </div>
        </a>
      </div>

      <div class="about-item js-fade-up">
        <a href="/about/history/">
          <h2 class="about-item-title">沿革</h2>
          <div class="about-item-content">
            <img src="/wp-content/themes/Portfolio/assets/images/About/history.jpg" alt="沿革">
          </div>
        </a>
      </div>

    </div>
  </section>
</main>
<?php get_footer(); ?>
