<?php get_header(); ?>
<main>
  <?php if (!is_front_page() && !is_home()): ?>
    <nav class="breadcrumb">
      <div class="breadcrumb-inner">
        <a href="<?php echo home_url('/'); ?>">TOP</a>

        <?php if (is_post_type_archive('news') || is_singular('news')): ?>
          &nbsp;&gt;&nbsp;<a href="<?php echo get_post_type_archive_link('news'); ?>">ニュース一覧</a>
        <?php endif; ?>

        <?php if (is_singular('news')): ?>
          &nbsp;&gt;&nbsp;<span><?php the_title(); ?></span>
        <?php elseif (is_archive() && !is_post_type_archive()): ?>
          &nbsp;&gt;&nbsp;<span><?php the_archive_title(); ?></span>
        <?php endif; ?>
      </div>
    </nav>
  <?php endif; ?>

  <div class="content-news">
    <div class="title">
      <h1>ニュース一覧</h1>
    </div>
    <div class="news-list">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <article>
            <time class="news-date" datetime="<?php echo get_the_date('Y.m.d'); ?>">
              <?php echo get_the_date(); ?>
            </time>
            <h2 class="news-title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
          </article>
        <?php endwhile; ?>
        <div class="pagination">
          <?php
          echo paginate_links(array(
            'prev_text' => '前へ',
            'next_text' => '次へ',
          ));
          ?>
        </div>
      <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
</main>
<?php get_footer(); ?>