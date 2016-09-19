<?php get_header() ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="section">
<div class="container">
	<div class="row">

	<div class="col-md-6">
		<?php //wp_list_categories(array('title_li'=>'','taxonomy'=>'skill_level')) ?>
		<ol class="breadcrumb">
			<li><a href="/reference">Reference Home</a></li>
			<li><a href="/reference/freestyle">Footbag Freestyle</a></li>
			<li><a href="/reference/freestyle/moves">Move List</a></li>
			<li><?php the_terms( $post->ID, 'skill_level', ' ', ', ', ' ' ); ?></li>
		</ol>
	</div>

	<div class="col-md-6">
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
<input type="hidden" name="post_type" value="moves" >
<input type="text" name="s" id="s" class="">	
<input type="submit" id="searchsubmit" value="Move Search" />
</form>
<hr>

	</div>
	<div style="clear:both" class="clearfix"></div>
	<div class="col-md-6">

		<h1><?php the_title() ?></h1>
		<?php 
		$video = get_post_meta($post->ID, 'Video', true); 
		if($video) echo footbag_video_embed($video);
		?>
		<div class="movedesc">
		<?php the_content() ?>
		</div>
		<hr>
		<?php $supple = get_post_meta($post->ID, 'SupplementalVideos', true); ?>
		<?php if($supple): ?>
		<?php $supvids = explode(',',$supple); ?>
		<h2>More Videos</h2>
		<div class="row">
			<?php foreach($supvids as $supvid): ?>
			<div class="col-xs-6 col-md-6">
				<?php echo footbag_video_embed($supvid); ?>
			</div>
			<?php endforeach ?>
		</div>
		<?php endif; ?>
	</div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
<div class="card card-block text-md-center">
<div class="card-text addcount"><?php the_terms( $post->ID, 'adds', '', ', ', ' ' ); ?> <small>ADDs</small></div>
<?php $addcats = get_post_meta($post->ID, 'AddBreakDown', true); ?>
<?php if($addcats): ?>
<div class="addcats card-text">
	<a href="/reference/freestyle/additional-degrees-of-difficulty/"><?php echo $addcats ?></a>
</div>
<?php endif; ?>
<?php $jobs = get_post_meta($post->ID, 'JobsNotation', true); ?>
<?php if($jobs): ?>
<div class="jobsnotation card-text">
	<a href="/reference/freestyle/jobs-notation"><?php echo $jobs ?></a>
</div>
<?php endif; ?>
	</div>
</div>
	<?php $relatedmoves = get_post_meta($post->ID, 'RelatedTo', true) ?>
	<?php if($relatedmoves): ?>
	<div class="col-md-6">
		<div class="card">
		<div class="card-block">
		<h3 class="card-title">Related to</h3>
		</div>
		<?php $relatedargs = array('title_li' => '', 'include' => $relatedmoves, 'post_type' => 'moves',) ?>
		<?php $reld = get_pages($relatedargs) ?>
		<ul class="list-group list-group-flush">
			<?php foreach($reld as $relmov): ?>
				<a class="list-group-item" href="<?php echo the_permalink($relmov->ID); ?>">
					<?php echo $relmov->post_title; ?>
				</a>
			<?php endforeach; ?>
		 </ul>
		</div>
	</div>
	<?php endif; ?>
	<div class="col-md-6">
	<?php $record = get_post_meta($post->ID, 'Consecutive Record', true); ?>
	<?php if($record): ?>
	<?php $recdeets = explode('||', $record); ?>
	<div class="card moverecord">
	<div class="card-block recordcount">
		<h3 class="card-title">World Record</h3> 
		<div class="card-text">

			<?php echo footbag_video_embed($recdeets[2]) ?>
			<?php echo $recdeets[0] ?>
			<?php echo $recdeets[1] ?>
		</div>
	</div>
	</div>
	<?php endif; ?>
	</div>
	<div class="col-md-6">
	<?php $inventor = get_post_meta($post->ID, 'Inventor', true); ?>
	<?php if($inventor): ?>
	<div class="card card-block moveinventor">
	<h3 class="card-title">Inventor</h3> 
	<div class="card-text"><?php echo $inventor ?></div>
	</div>
	<?php endif; ?>
	</div>

</div>

		<div><?php edit_post_link( __( 'Edit' )); ?></div>
		<div><?php //the_meta() ?></div>
	</div>
</div></div>
<?php endwhile; ?>
</div>
</div>
</div>
<?php get_footer() ?>
