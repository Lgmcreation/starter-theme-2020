<?php get_header(); ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
<article  id="post-<?php the_ID(); ?>">
	<h1><?php the_title(); ?></h1>
	<div class="post-content">
		<?php the_content(); ?>
	</div>
<?php endwhile; ?><?php endif; ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>