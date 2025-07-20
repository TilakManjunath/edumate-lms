<?php get_header(); ?>
<h2>Browse Courses</h2>
<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <div>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php the_excerpt(); ?>
    </div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
