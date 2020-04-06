<?php get_header();?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
	<section>
		<div class="container">
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
			<div class="row">
				<div class="main col-xs-12 col-sm-8 col-md-8">
					<div class="single-post">
						<p class="canhbao">Trang không tồn tại</p>
					</div>
				</div>
				<?php get_sidebar();?>
			</div>
		</div>
	</section>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer();?>