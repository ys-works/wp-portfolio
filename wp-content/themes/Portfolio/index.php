<?php get_header(); ?>

<main>
  <?php
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();
      ?>
      <article>
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
      </article>
      <?php
    }
  }
  ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>