<div class="sidebar col-xs-12 col-sm-4 col-md-4">
	<div class="widger">
		<h3 class="title"><span><i class="fa fa-bars"></i> Được quan tâm</span></h3>
		<div class="content-w">
			<div class="postmot">
				<?php 
				$args = array(
					'posts_per_page' => 1,
					'meta_key' => 'views',
				    'orderby' => 'meta_value_num',
				);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<a href="<?php the_permalink();?>"><?php show_thumb(400,250,1,'c'); ?></a>
					<div class="mot">
						<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<p><?php echo get_the_date();?></p>
					</div>
				<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
			<ul>
				<?php 
				$args = array(
					'posts_per_page' => 5,
					'meta_key' => 'views',
				    'orderby' => 'meta_value_num',
				    'offset' => 1
				);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<li>
						<a href="<?php the_permalink();?>"><?php show_thumb(90,70,1,'c'); ?></a>
						<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<div class="meta">
							<span><?php echo get_the_date();?></span>
							<span>lượt xem: <?php echo getpostviews( get_the_ID() ); ?></span>
						</div>
						<div class="clear"></div>
					</li>
				<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</ul>
		</div>
		<div class="clear"></div>
	</div>

	<div role="tabpanel">
	    <!-- Nav tabs -->
	    <ul class="nav nav-tabs" role="tablist">
	        <li role="presentation" class="active">
	            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Phong thủy</a>
	        </li>
	        <li role="presentation">
	            <a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">Nhà đẹp</a>
	        </li>
	    </ul>
	
	    <!-- Tab panes -->
	    <div class="tab-content">
	        <div role="tabpanel" class="tab-pane active" id="home">
	        	<ul>
	        		<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=5&cat=5'); ?>
					<?php global $wp_query; $wp_query->in_the_loop = true; ?>
					<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
						<li>
							<a href="<?php the_permalink();?>"><?php show_thumb(90,70,1,'c'); ?></a>
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<div class="meta">
								<span><?php echo get_the_date();?></span>
							</div>
							<div class="clear"></div>
						</li>
					<?php endwhile; ?>
	        	</ul>
	        </div>
	        <div role="tabpanel" class="tab-pane" id="tab">
				<ul>
	        		<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=5&cat=4'); ?>
					<?php global $wp_query; $wp_query->in_the_loop = true; ?>
					<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
						<li>
							<a href="<?php the_permalink();?>"><?php show_thumb(90,70,1,'c'); ?></a>
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<div class="meta">
								<span><?php echo get_the_date();?></span>
							</div>
							<div class="clear"></div>
						</li>
					<?php endwhile; ?>
	        	</ul>
	        </div>
	    </div>
<?php
$options = get_option( 'my_setting_theme' );
if (isset($options['vtk_fan'])){ $vtk_fan = $options['vtk_fan'];}
?>
	    <div class="widger">
			<h3 class="title"><span><i class="fa fa-bars"></i> Fan page facebook</span></h3>
			<div class="content-w">
				<div class="fb-page" data-href="<?php if ( $vtk_fan != "" ){ echo $vtk_fan; } ?>" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
			</div>
		</div>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar') ) : ?><?php endif; ?>
	</div>
</div>