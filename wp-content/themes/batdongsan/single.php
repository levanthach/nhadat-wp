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
							<?php the_category();?>
							<span><?php echo get_the_date();?></span>
							<span>Lượt xem: <?php echo getpostviews( get_the_ID() ); ?></span>
							<a class="social">
								<div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" data-width="100%" data-mobile="Auto-detected"></div>
								 <script src="https://apis.google.com/js/platform.js" async defer></script>
	  							 <g:plusone></g:plusone>
							</a>
						</div>
						<article class="post-content"><?php the_content();?></article>
						<?php setpostview( get_the_ID() ); ?>
						<div class="related-post">
							<h3 class="title-rela"><span>Bài viết liên quan</span></h3>
							<div class="content-related">
								<ul>
									<?php foreach((get_the_category()) as $category) { 
										$cat_id = $category->cat_ID; }
										$args = array ( 'post_status' => 'publish',
														'category__in' => $cat_id,
														'post__not_in' => array($post->ID),
														'showposts' => 10,
														);
									?>
									<?php $related_post = new WP_query($args); ?>
									<?php //print_r($related_post); ?>
									<?php if ( $related_post->have_posts()) : ?>
										<?php while ( $related_post->have_posts() ): ?>
											<?php $related_post->the_post(); ?>
											<li>
												<h4><a href="<?php the_permalink();?>"><i class="fa fa-angle-double-right"></i> <?php the_title();?></a></h4>
											</li>
										<?php endwhile; else : ?>
										<p class="canhbao">Rất tiêc! Chưa có bài viết liên quan</p>
									<?php endif; ?>
								</ul>
							</div>
						</div>
						<div class="comment">
							<div class="fb-comments" data-href="<?php the_permalink();?>" data-width="100%" data-numposts="3"></div>
						</div>
					</div>
				</div>
				<?php get_sidebar();?>
			</div>
		</div>
	</section>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer();?>