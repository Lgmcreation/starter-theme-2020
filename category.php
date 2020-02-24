<?php get_header();?>
<?php if(have_posts()) : while(have_posts()) : the_post();?>
<h1><?php single_cat_title( '', true ); ?></h1>
<?php echo category_description();?>
 <?php endwhile; endif;?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>