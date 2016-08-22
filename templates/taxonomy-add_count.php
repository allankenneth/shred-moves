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

	<h1>ADD Counts</h1>

<?php echo $term ?>
<?php while ( have_posts() ) : the_post(); ?>
<div><a href="<?php the_permalink() ?>"> <?php the_title() ?></a></div>
<?php endwhile; ?>
</div>

</div>
</div>
</div>
<?php get_footer() ?>
