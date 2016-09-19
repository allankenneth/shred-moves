<?php get_header() ?>
<div class="section">
<div class="container">
<div class="row">
        <div class="col-md-12">
                <ol class="breadcrumb">
                
                <li><a href="/reference">Reference Home</a></li>
                <li><a href="/reference/freestyle">Freestyle</a></li>
                <li><a href="/reference/freestyle/moves">Moves List</a></li>
                </ol>
        </div>
        <div class="col-md-3">
        <?php wp_list_categories(array('taxonomy'=>'skill_level')); ?>
        </div>
        <div class="col-md-6">

	<h1><?php echo $term ?> ADD Moves</h1>

<?php while ( have_posts() ) : the_post(); ?>
<div><a href="<?php the_permalink() ?>"> <?php the_title() ?></a></div>
<?php endwhile; ?>
</div>

</div>
</div>
</div>
<?php get_footer() ?>
