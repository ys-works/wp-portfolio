<?php
function mytheme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'mytheme_setup');

function mytheme_scripts()
{
  wp_enqueue_style('mytheme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mytheme_scripts');

remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

function my_theme_enqueue_styles()
{
  clearstatcache();
  $dir_uri = get_template_directory_uri() . '/assets/css/';
  $dir_path = get_template_directory() . '/assets/css/';
  $get_ver = function ($filename) use ($dir_path) {
    return file_exists($dir_path . $filename) ? filemtime($dir_path . $filename) : '1.0';
  };

  wp_enqueue_style('my-theme-common',      $dir_uri . 'common.css',      [], $get_ver('common.css'));
  wp_enqueue_style('my-theme-header',      $dir_uri . 'header.css',      ['my-theme-common'], $get_ver('header.css'));
  wp_enqueue_style('my-theme-footer',      $dir_uri . 'footer.css',      ['my-theme-common'], $get_ver('footer.css'));
  wp_enqueue_style('my-theme-archive',     $dir_uri . 'archive.css',     ['my-theme-common'], $get_ver('archive.css'));
  wp_enqueue_style('my-theme-article',     $dir_uri . 'article.css',     ['my-theme-common'], $get_ver('article.css'));
  wp_enqueue_style('my-theme-custom-post', $dir_uri . 'custom-post.css', ['my-theme-common'], $get_ver('custom-post.css'));
  wp_enqueue_style('my-theme-page',        $dir_uri . 'page.css',        ['my-theme-common'], $get_ver('page.css'));
  wp_enqueue_style('my-theme-responsive',  $dir_uri . 'responsive.css',  ['my-theme-header', 'my-theme-footer', 'my-theme-article', 'my-theme-page'], $get_ver('responsive.css'));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function mytheme_enqueue_scripts()
{
  wp_enqueue_script(
    'custom',
    get_template_directory_uri() . '/assets/js/custom.js',
    array(),
    null,
    true
  );

  wp_enqueue_script(
    'up-down-button',
    get_template_directory_uri() . '/assets/js/UpDownButton.js',
    array(),
    null,
    true
  );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

function enqueue_font_awesome_kit()
{
  wp_enqueue_script('font-awesome-kit', 'https://kit.fontawesome.com/0bb16e2950.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome_kit');

function my_custom_post_types()
{
  register_post_type('news', [
    'label'        => 'ニュース',
    'public'       => true,
    'has_archive'  => true,
    'rewrite'      => ['slug' => 'news'],
    'supports'     => ['title', 'editor', 'thumbnail'],
    'show_in_rest' => true,
  ]);
}
add_action('init', 'my_custom_post_types');

register_taxonomy('news_category', 'news', [
  'label'        => 'ニュースカテゴリー',
  'hierarchical' => true,
  'show_in_rest' => true,
  'rewrite'      => ['slug' => 'news-category'],
]);

function change_news_posts_per_page($query)
{
  if (!is_admin() && $query->is_main_query() && (is_home() || is_archive())) {
    $query->set('posts_per_page', 5);
    $query->set('orderby', 'date');
    $query->set('order', 'DESC');
  }
}
add_action('pre_get_posts', 'change_news_posts_per_page');

add_filter('document_title_parts', 'custom_news_type_title');
function custom_news_type_title($title)
{
  if (is_post_type_archive('news')) {
    $title['title'] = 'ニュース一覧';
  }
  return $title;
}

function register_product_taxonomy() {
    $labels = array(
        'name'              => 'カテゴリー',
        'singular_name'     => 'カテゴリー',
        'search_items'      => 'カテゴリーを検索',
        'all_items'         => 'すべてのカテゴリー',
        'edit_item'         => 'カテゴリーを編集',
        'add_new_item'      => 'カテゴリーを追加',
        'menu_name'         => 'カテゴリー',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
    );

    register_taxonomy('product_cat', array('page'), $args);
}
add_action('init', 'register_product_taxonomy');
