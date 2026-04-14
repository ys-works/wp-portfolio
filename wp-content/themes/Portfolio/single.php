<?php get_header(); ?>
<main>
  <?php if (!is_front_page() && !is_home()): ?>
    <nav class="breadcrumb">
      <div class="breadcrumb-inner">
        <a href="<?php echo home_url('/'); ?>">TOP</a>

        <?php
        // 現在の投稿タイプを取得
        $post_type = get_post_type();

        // 投稿タイプが「ニュース」の場合のパンくず
        if ($post_type === 'news'):
        ?>
          &nbsp;&gt;&nbsp;<a href="<?php echo get_post_type_archive_link('news'); ?>">ニュース一覧</a>

          <?php
          // ニュースのカテゴリ（タクソノミー）を取得して表示
          $terms = get_the_terms(get_the_ID(), 'news_category');
          if ($terms && ! is_wp_error($terms)):
            $term = $terms[0]; // 最初のカテゴリを取得
          ?>
            &nbsp;&gt;&nbsp;<a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a>
          <?php endif; ?>

          &nbsp;&gt;&nbsp;<span><?php the_title(); ?></span>

        <?php else: ?>
          <!-- 通常の投稿（ブログなど）の場合のパンくず -->
          <?php
          $categories = get_the_category();
          if ($categories) :
            $cat = $categories[0];
          ?>
            &nbsp;&gt;&nbsp;<a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->name; ?></a>
          <?php endif; ?>

          &nbsp;&gt;&nbsp;<span><?php the_title(); ?></span>
        <?php endif; ?>
      </div>
    </nav>
  <?php endif; ?>

  <div class="content-single">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article class="article-body">
          <h1><?php the_title(); ?></h1>

          <div class="meta">
            <time datetime="<?php the_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>

            <?php if ($post_type === 'news'): ?>
              <!-- ニュースの場合：カスタムタクソノミーのカテゴリを表示 -->
              <?php the_terms(get_the_ID(), 'news_category'); ?>
            <?php else: ?>
              <!-- 通常投稿の場合：通常のカテゴリを表示 -->
              <?php the_category(', '); ?>
            <?php endif; ?>
          </div>

          <div class="entry-content">
            <?php the_content(); ?>
          </div>
        </article>

    <?php endwhile;
    endif; ?>
  </div>

  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>