<?php get_header();?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
	<section>
		<div class="container">
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
			<div class="row">
				<div class="main col-xs-12 col-sm-8 col-md-8">
					<div class="single-post">
						<h2 class="title-post"><?php the_title();?></h2>
						<div class="meta">
							<a class="social">
								<div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" data-width="100%" data-mobile="Auto-detected"></div>
								 <script src="https://apis.google.com/js/platform.js" async defer></script>
	  							 <g:plusone></g:plusone>
							</a>
						</div>
						<article class="post-content"><?php the_content();?></article>
					</div>
				</div>
				<?php get_sidebar();?>
			</div>
		</div>
	</section>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer();?>