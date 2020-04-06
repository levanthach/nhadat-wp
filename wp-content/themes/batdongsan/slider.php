<div class="slider">
	<div id="carousel-id" class="carousel slide" data-ride="carousel">
	    <div class="carousel-inner">
	    	<?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=1&post_type=slider'); ?>
			<?php global $wp_query; $wp_query->in_the_loop = true; ?>
			<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
				<div class="item active">
	           		 <a href="<?php echo get_post_meta( $post->ID, '_link_img', true );?>"><?php show_thumb(750,300,1,'c'); ?></a>
	        	</div>
			<?php endwhile; ?>
			
	        <?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=4&offset=1&post_type=slider'); ?>
			<?php global $wp_query; $wp_query->in_the_loop = true; ?>
			<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
				<div class="item">
		            <a href="<?php echo get_post_meta( $post->ID, '_link_img', true );?>"><?php show_thumb(750,300,1,'c'); ?></a>
		        </div>
			<?php endwhile; ?>
	    </div>
	    <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	    <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
</div>