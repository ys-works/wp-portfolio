<?php get_header(); ?>
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
  <div class="section-wrap">
    <section>
      <?php the_content(); ?>
    </section>
  </div>

  <?php // お問い合わせ用
  if (is_page('inquiry')) : ?>
    <div class="inquiry-form-wrap">
      <?php while (have_posts()) : the_post(); ?>
        <section class="page-inquiry">
          <?php the_content(); ?>
        </section>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>