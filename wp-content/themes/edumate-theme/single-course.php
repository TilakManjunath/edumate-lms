<?php get_header(); ?>
<article>
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>

    <p><strong>Duration:</strong> <?php echo get_post_meta(get_the_ID(), '_duration', true); ?></p>
    <p><strong>Difficulty:</strong> <?php echo get_post_meta(get_the_ID(), '_difficulty', true); ?></p>

    <button>Enroll Now</button> <!-- Future: connect to login/enroll logic -->
</article>
<?php get_footer(); ?>
