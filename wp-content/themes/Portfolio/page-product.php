<?php
/* Template Name: 製品一覧 */
get_header(); ?>
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

  <div class="product-wrap">
    <?php
    $parent_term = get_term_by('slug', 'product', 'product_cat');

    if ($parent_term) :
      $parent_id = $parent_term->term_id;

      $child_categories = get_terms(array(
        'taxonomy'   => 'product_cat',
        'parent'     => $parent_id,
        'hide_empty' => true,
        'orderby'    => 'term_order',
        'order'      => 'ASC'
      ));

      if ($child_categories && !is_wp_error($child_categories)) :
        foreach ($child_categories as $category) :

          $products = get_posts(array(
            'post_type'      => 'page',
            'posts_per_page' => -1,
            'tax_query'      => array(
              array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $category->term_id,
              ),
            ),
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
          ));

          if ($products) :
    ?>
            <section class="product-category" id="cat-<?php echo esc_attr($category->slug); ?>">
              <h2 class="category-title js-fade-up-first">
                <?php echo esc_html($category->name); ?>
              </h2>

              <?php if ($category->description) : ?>
                <p class="category-description js-fade-up-first"><?php echo esc_html($category->description); ?></p>
              <?php endif; ?>

              <div class="product-grid">
                <?php foreach ($products as $product) : ?>
                  <div class="product-item js-fade-up-first">
                    <a class="js-fade-up-first" href="<?php echo get_permalink($product->ID); ?>"href="<?php echo get_permalink($product->ID); ?>" class="product-link">

                      <?php if (has_post_thumbnail($product->ID)) : ?>
                        <div class="product-image js-fade-up-first">
                          <?php echo get_the_post_thumbnail($product->ID, 'medium'); ?>
                        </div>
                      <?php else : ?>
                        <div class="product-image no-image">
                          <span>画像準備中</span>
                        </div>
                      <?php endif; ?>

                      <div class="product-info">
                        <h3 class="product-title js-fade-up-first"><?php echo esc_html($product->post_title); ?></h3>

                        <p class="product-excerpt js-fade-up-first">
                          <?php
                          echo esc_html(wp_trim_words(
                            $product->post_excerpt ?: $product->post_content,
                            40,
                            '…'
                          ));
                          ?>
                        </p>
                      </div>

                    </a>
                  </div>
                <?php endforeach; ?>
              </div>

            </section>

    <?php
          endif;
        endforeach;
      else :
        echo '<p>カテゴリーが見つかりません。</p>';
      endif;
    else :
      echo '<p>親カテゴリー「product」が見つかりません。</p>';
    endif;
    ?>

  </div>
</main>
<?php get_footer(); ?>