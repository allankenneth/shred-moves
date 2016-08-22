<?php get_header() ?>
<div class="section">
<div class="container">
<div class="row">
	<div class="col-md-12">
		<a href="/freestyle">Footbag Freestyle</a>
		<h1>Moves List</h1>
	</div>
	<div class="col-md-3">
	<?php wp_list_categories(array('taxonomy'=>'skill_level')); ?>
	</div>
	<div class="col-md-6">
<?php
global $query_string;
query_posts( $query_string . '&posts_per_page=20' );
?>
<?php while ( have_posts() ) : the_post(); ?>
	<div><a href="<?php the_permalink() ?>"><?php the_title() ?><br>
	<?php the_post_thumbnail() ?></a></div>
<?php endwhile; ?>
<?php 
	// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );
?>
	</div>
</div>
</div>
</div>
<?php get_footer() ?>
