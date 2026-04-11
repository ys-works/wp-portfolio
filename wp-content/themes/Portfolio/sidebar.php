<?php
$current_template = get_page_template_slug(get_the_ID());
$is_product_detail = ($current_template === 'page-product-detail.php');
$is_about_detail   = ($current_template === 'page-about-detail.php');
?>

<aside class="sidebar">

  <!-- 製品詳細用サイドバー -->
  <?php if ($is_product_detail) : ?>
    <div class="sidebar-widget">
      <h3>商品一覧</h3>
      <?php
      $parent_term = get_term_by('name', 'Product', 'product_cat');
      $child_terms = get_terms([
        'taxonomy'   => 'product_cat',
        'parent'     => $parent_term ? $parent_term->term_id : 0,
        'hide_empty' => false,
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
      ]);

      foreach ($child_terms as $term) :
        $pages = get_posts([
          'post_type'      => 'page',
          'posts_per_page' => -1,
          'orderby'        => 'title',
          'order'          => 'ASC',
          'tax_query'      => [[
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $term->term_id,
          ]],
        ]);

        $has_current = in_array(
          get_the_ID(),
          array_column($pages, 'ID')
        );

        $toggle_id = 'product-cat-' . $term->term_id;
      ?>
        <div class="sidebar-toggle">
          <button
            class="sidebar-toggle__btn"
            aria-expanded="<?php echo $has_current ? 'true' : 'false'; ?>"
            aria-controls="<?php echo esc_attr($toggle_id); ?>">
            <?php echo esc_html($term->name); ?>
            <span class="sidebar-toggle__icon" aria-hidden="true"></span>
          </button>
          <ul
            class="sidebar-toggle__list"
            id="<?php echo esc_attr($toggle_id); ?>">
            <?php foreach ($pages as $p) :
              $is_current = ($p->ID === get_the_ID());
            ?>
              <li class="sidebar-toggle__item<?php echo $is_current ? ' current' : ''; ?>">
                <a
                  href="<?php echo get_permalink($p->ID); ?>"
                  <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
                  <?php echo esc_html($p->post_title); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

      <?php endforeach; ?>
    </div>

    <!-- 会社情報詳細用サイドバー -->
  <?php elseif ($is_about_detail) : ?>
    <div class="sidebar-widget">
      <h3>会社情報</h3>
      <?php
      $about_pages = get_posts([
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'page-about-detail.php',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
      ]);
      if ($about_pages) : foreach ($about_pages as $p) :
          $is_current = ($p->ID === get_the_ID());
      ?>
          <div class="<?php echo $is_current ? 'sidebar-item current' : 'sidebar-item'; ?>">
            <a
              href="<?php echo get_permalink($p->ID); ?>"
              <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
              <?php echo esc_html($p->post_title); ?>
            </a>
          </div>
      <?php endforeach;
      endif; ?>
    </div>

  <?php else : ?>
    <!-- アーカイブ用サイドバー（既存） -->
    <div class="sidebar-widget">
      <h3>ニュースカテゴリ</h3>
      <?php
      $terms = get_terms([
        'taxonomy'   => 'news_category',
        'hide_empty' => false,
        'orderby'    => 'parent',
      ]);
      if ($terms) :
        foreach ($terms as $term) :
          if ($term->parent !== 0) continue; ?>
          <div>
            <a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a>
          </div>
          <?php
          foreach ($terms as $child) :
            if ($child->parent !== $term->term_id) continue; ?>
            <div>
              <a href="<?php echo get_term_link($child); ?>">- <?php echo esc_html($child->name); ?></a>
            </div>
      <?php endforeach;
        endforeach;
      endif; ?>
    </div>

  <?php endif; ?>
</aside>