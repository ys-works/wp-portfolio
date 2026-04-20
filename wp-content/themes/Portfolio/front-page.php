<?php get_header(); ?>
<main>
  <div class="scroll-controls">
    <button id="btn-up" class="nav-btn">PageUp</button>
    <button id="btn-down" class="nav-btn">PageDown</button>
  </div>
  <div class="hero">
    <div class="hero-inner">
      <div class="title">
        <h1>Protfolio</h1>
      </div>
      <video autoplay loop muted playsinline>
        <source src="<?php echo get_template_directory_uri(); ?>/assets/images/movie/top_hero.webm" type="video/webm">
        <source src="<?php echo get_template_directory_uri(); ?>/assets/images/movie/top_hero.mp4" type="video/mp4">
        ご使用のブラウザは動画再生に対応していません。
      </video>
      <button class="video-toggle">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/pause.svg" alt="pause">
      </button>
    </div>
  </div>

  <div class="content-wrap">
    <section class="product panel">
      <div class="section-inner-left js-expand-bg">
        <h2 class="js-fade-up">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product.svg" alt="Product">
        </h2>
        <p class="js-fade-up">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste adipisci obcaecati iusto. Quas quis earum beatae eveniet esse? Soluta odio amet fugiat doloremque quod illo culpa sit praesentium numquam dolor?</p>
        <a class="js-fade-up" href="/product">製品一覧</a>
      </div>
      <div class="section-inner-right">
        <video class="js-scale-up" autoplay loop muted playsinline>
          <source src="<?php echo get_template_directory_uri(); ?>/assets/images/movie/product.webm" type="video/webm">
          <source src="<?php echo get_template_directory_uri(); ?>/assets/images/movie/product.mp4" type="video/mp4">
          ご使用のブラウザは動画再生に対応していません。
        </video>
      </div>
    </section>

    <section class="about panel">
      <div class="section-inner-left">
        <img class="js-scale-up" src="<?php echo get_template_directory_uri(); ?>/assets/images/About_image.jpg" alt="About">
      </div>
      <div class="section-inner-right js-expand-bg">
        <h2 class="js-fade-up"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/About.svg" alt="About"></h2>
        <p class="js-fade-up">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad fuga vel sit doloremque voluptas laborum. Dolor facilis recusandae ex quis. </p>
        <a class="js-fade-up" href="/about">会社案内</a>
      </div>
    </section>

    <section class="news panel">
      <div class="section-inner">
        <h2><img src="<?php echo get_template_directory_uri(); ?>/assets/images/News.svg" alt="News"></h2>
        <div class="news-list">
          <?php
          $args = [
            'post_type'      => 'news',
            'posts_per_page' => 5,
            'post_status'    => 'publish',
          ];
          $news_query = new WP_Query($args);
          if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post(); ?>

              <div class="news-item js-fade-up-first">
                <span class="news-date"><?php echo get_the_date('Y.m.d'); ?></span>
                <a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <span class="news-cat">
                  <?php
                  $terms = get_the_terms(get_the_ID(), 'news_category');
                  if ($terms) :
                    foreach ($terms as $term) :
                      echo '<span class="cat-label">' . esc_html($term->name) . '</span>';
                    endforeach;
                  endif;
                  ?>
                </span>
              </div>

          <?php endwhile;
            wp_reset_postdata();
          endif; ?>
        </div>
        <div class="section-link js-fade-up-first">
          <a href="/news">ニュース一覧</a>
        </div>
      </div>
    </section>

  </div>
</main>
<?php get_footer(); ?>