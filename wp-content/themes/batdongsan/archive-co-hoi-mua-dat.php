<?php get_header();?>
	<section>
		<div class="container">
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
			<div class="row">
				<div class="main col-xs-12 col-sm-8 col-md-8">
					<div class="and-post">
							<div class="post">
								<div class="content-post">
									<ul>
									<?php if (have_posts()) : ?>
									<?php while (have_posts()) : the_post(); ?>
										<li>
											<div class="col-xs-12 col-sm-3 col-md-3 img-sp">
												<a href="<?php the_permalink();?>"><?php show_thumb(450,360,1,'c'); ?></a>
												<p class="gia-sp"><?php echo types_render_field("gia-dat");?></p>
											</div>
											<div class="col-xs-12 col-sm-9 col-md-9">
												<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
												<div class="meta">
													<span><?php echo get_the_date();?></span>
												</div>
												<div class="rew">
													<div class="col-xs-12 col-sm-7 col-md-8 ppp">
														<?php echo teaser(40); ?>
													</div>
													<div class="info-post col-xs-12 col-sm-5 col-md-4">
														<ul>
															<li><i class="fa fa-connectdevelop"></i> <?php echo types_render_field("dien-tich-dat");?> </li>
															<li><i class="fa fa-gg"></i> <?php echo types_render_field("loai-dat");?></li>
															<li><i class="fa fa-map-marker"></i> <?php echo types_render_field("khu-vuc");?></li>
														</ul>
													</div>
													<div class="clear"></div>
												</div>
											</div>
											<div class="clear"></div>
										</li>
									<?php endwhile; ?>
									<?php endif; ?>
									</ul>
								</div>
							</div>
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
				<?php get_sidebar();?>
			</div>
		</div>
	</section>
<?php get_footer();?>