<?php get_header();?>
		<section>
			<div class="container">
				<div class="row">
					<div class="main col-xs-12 col-sm-8 col-md-8">
					<?php get_template_part( 'slider' ); ?>
					<div class="news-top">
						<div class="postone col-xs-12 col-sm-12 col-md-6">
							<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=1'); ?>
							<?php global $wp_query; $wp_query->in_the_loop = true; ?>
							<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
								<a href="<?php the_permalink();?>"><?php show_thumb(400,300,1,'c'); ?></a>
								<div class="meta">
									<span>Ngày đăng: <?php echo get_the_date();?></span>
								</div>
								<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
								<?php echo teaser(50); ?>
								<a href="<?php the_permalink();?>" class="readmore">Chi tiết  <i class="fa fa-angle-double-right"></i></a>
							<?php endwhile; ?>
						</div>
						<div class="list-post col-xs-12 col-sm-12 col-md-6">
							<ul>
								<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=5&offset=1'); ?>
								<?php global $wp_query; $wp_query->in_the_loop = true; ?>
								<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
									<li>
										<a href="<?php the_permalink();?>"><?php show_thumb(90,70,1,'c'); ?></a>
										<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
										<div class="clear"></div>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
						<div class="clear"></div>
					</div>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_qc') ) : ?><?php endif; ?>
					<div class="post">
						<h2 class="title"><i class="fa fa-slideshare"></i> <span><a href="#">Cơ hội mua đất</a></span></h2>
						<div class="content-post">
							<ul>
								<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=3&post_type=co-hoi-mua-dat'); ?>
								<?php global $wp_query; $wp_query->in_the_loop = true; ?>
								<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
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
							</ul>
							<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=8&offset=3&post_type=co-hoi-mua-dat'); ?>
							<?php global $wp_query; $wp_query->in_the_loop = true; ?>
							<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
								<div class="list-link"><a href="<?php the_permalink();?>"><i class="fa fa-angle-double-right"></i> <?php the_title();?></a></div>
							<?php endwhile; ?>
						</div>
					</div>

					<div class="post">
						<h2 class="title"><i class="fa fa-slideshare"></i> <span><a href="#">Cơ hội mua nhà</a></span></h2>
						<div class="content-post">
							<ul>
								<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=3&post_type=co-hoi-mua-nha'); ?>
								<?php global $wp_query; $wp_query->in_the_loop = true; ?>
								<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
									<li>
										<div class="col-xs-12 col-sm-3 col-md-3 img-sp">
											<a href="<?php the_permalink();?>"><?php show_thumb(450,360,1,'c'); ?></a>
											<p class="gia-sp"><?php echo types_render_field("gia-nha");?></p>
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
														<li><i class="fa fa-connectdevelop"></i> <?php echo types_render_field("dien-tich-nha");?> </li>
														<li><i class="fa fa-gg"></i> <?php echo types_render_field("loai-nha");?></li>
														<li><i class="fa fa-map-marker"></i> <?php echo types_render_field("khu-vuc-nha");?></li>
													</ul>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<div class="clear"></div>
									</li>
								<?php endwhile; ?>
							</ul>
							<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=8&offset=3&post_type=co-hoi-mua-nha'); ?>
							<?php global $wp_query; $wp_query->in_the_loop = true; ?>
							<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
								<div class="list-link"><a href="<?php the_permalink();?>"><i class="fa fa-angle-double-right"></i> <?php the_title();?></a></div>
							<?php endwhile; ?>
						</div>
					</div>	
			</div>
			<?php get_sidebar();?>
			</div>
			</div>
			
		</section>

<?php get_footer();?>