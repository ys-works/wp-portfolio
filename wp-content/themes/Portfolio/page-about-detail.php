<?php
/* Template Name: 会社情報詳細 */
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
  <div class="about-detail-wrap">
    <section class="about-detail">
      <div class="about-detail-inner">
        <?php if (is_page('history')) : ?>
          <div class="about-history-content">
            <div class="ellipse-box-group">
              <div class="ellipse-box">
                <p>2026年</p>
              </div>
              <div class="line"></div>
            </div>
            <span class="history-title">設立</span>
          </div>
        <?php else : ?>
          <div class="about-detail-content">
            <?php the_content(); ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
    <?php get_sidebar(); ?>
  </div>
</main>
<?php get_footer(); ?>