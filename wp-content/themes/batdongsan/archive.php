<?php get_header();?>
	<section>
		<div class="container">
			<div class="row">
				<div class="main col-xs-12 col-sm-8 col-md-8">
					<div class="single-post category-post">
						<div class="row">
							<?php if (have_posts()) : ?>
							<?php while (have_posts()) : the_post(); ?>
								<div class="list-post-cate">
									<div class="col-xs-12 col-sm-3 col-md-4 img-cate">
										<a href="<?php the_permalink();?>"><?php show_thumb(450,360,1,'c'); ?></a>
									</div>
									<div class="col-xs-12 col-sm-9 col-md-8 info-cat-post">
										<h2 class="title-post"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
										<div class="meta">
											<?php the_category();?>
											<span><?php echo get_the_date();?></span>
										</div>
										<?php echo teaser(40); ?>
									</div>
									<div class="clear"></div>
								</div>
							<?php endwhile; ?>
							<?php endif; ?>
							<div class="quatrang">
							<?php
								global $wp_query;
								$big = 999999999;
								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'prev_text'    => __('« Mới hơn'),
									'next_text'    => __('Tiếp theo »'),
									'current' => max( 1, get_query_var('paged') ),
									'total' => $wp_query->max_num_pages
									) );
							  ?>
							 </div>
						</div>
						
					</div>
				</div>
				<?php get_sidebar();?>
			</div>
		</div>
	</section>
<?php get_footer();?>