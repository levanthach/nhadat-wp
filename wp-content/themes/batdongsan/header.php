<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script>
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '750688268378229',
		      xfbml      : true,
		      version    : 'v2.0'
		    });
		  };

		  (function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "//connect.facebook.net/en_US/sdk.js";
		     fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));
		</script>
	</head>
	<body>
		<header>
			<div class="container">
				<div class="logo">
					<a href="<?php bloginfo('url'); ?>"><?php logohuy(); ?></a>
				</div>
				<form class="searchform" method="get" action="<?php bloginfo('url'); ?>/">
					<div class="search">
						<input type="text" class="s" placeholder="Từ khóa tìm kiếm.." value="<?php the_search_query(); ?>" name="s" />
						<input type="submit" class="submit" value="">
					</div>
				</form>
			</div>
		</header>
		<nav class="nav-main">
			<div class="container">
				<?php wp_nav_menu( array( 'theme_location' => 'main_nav', 'container' => 'false', 'menu_id' => 'main-nav', 'menu_class' => '') ); ?>
				<div class="clear"></div>
			</div>
		</nav>