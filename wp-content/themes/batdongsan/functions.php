<?php
require get_template_directory() . '/options/options.php';
require_once('lib/logo-options/logo-options.php');

/********************************************************************
//remove tag width & height in post
********************************************************************/
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
/********************************************************************
//Ản link post type ko cần thiết
********************************************************************/
add_action('admin_head', 'wpds_custom_admin_post_css');
function wpds_custom_admin_post_css() {
    global $post_type;
    if ($post_type == 'slider') {
        echo "<style>#edit-slug-box {display:none;}</style>";
    }
}
/********************************************************************
//config excerpt length
********************************************************************/
function custom_excerpt_length( $length ) {
	return 300;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/********************************************************************
//Allow HTML tags in Widget title
********************************************************************/
function html_widget_title( $var) {
	$var = (str_replace( '[', '<', $var ));
	$var = (str_replace( ']', '>', $var ));
	$var = (str_replace( '__', '"', $var ));

	return $var ;
}
add_filter( 'widget_title', 'html_widget_title' );

/********************************************************************
//register short code url
********************************************************************/
add_filter('widget_text', 'do_shortcode');
// [url_base]
function url_base_function() {
	return get_bloginfo( "url" );
}
add_shortcode('url_base', 'url_base_function');


/********************************************************************
//register my menu in theme
********************************************************************/
add_action( 'init', 'register_my_menus' );
function register_my_menus(){
	register_nav_menus(
	array(
		'main_nav' => 'Main Nav',
		'cat_nav' => 'Menu sản phẩm',
		)
	);
}

/********************************************************************
//REGISTER SIDEBAR
********************************************************************/
if (function_exists('register_sidebar')){
	register_sidebar(array(
	'name'=> 'Sidebar',
	'id' => 'sidebar',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div></div>',
	'before_title' => '<h3 class="title"><span><i class="fa fa-bars"></i> ',
	'after_title' => '</span></h3><div class="content-w">'
	));
}

if (function_exists('register_sidebar')){
	register_sidebar(array(
	'name'=> 'Banner Quảng cáo',
	'id' => 'sidebar_qc',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => ''
	));
}


/********************************************************************
local php date
********************************************************************/
function localize_date($locale) {
	if ($locale == 'vi') {
		$nameday=date("l");
		
		switch ($nameday) {
		case "Saturday":
		$nameday="Thứ bảy";
		break;
		case "Sunday":
		$nameday="Chủ nhật";
		break;
		case "Monday":
		$nameday="Thứ hai";
		break;
		case "Tuesday":
		$nameday="Thứ ba";
		break;
		case "Wednesday":
		$nameday="Thứ tư";
		break;
		case "Thursday":
		$nameday="Thứ năm";
		break;
		case "Friday":
		$nameday="Thứ sáu";
		break;
		}
	echo "$nameday, ".date('d/m/Y');
	} else {
		echo date('D, d/m/Y');
	}
}


/********************************************************************
global teaser function
********************************************************************/
function teaser($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'[...]';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt.'...';
}

/********************************************************************
Post Views
********************************************************************/
function setpostview($postID){
    $count_key ='views';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function getpostviews($postID){
    $count_key ='views';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}


/********************************************************************
get link img post
********************************************************************/
function get_link_img_post(){
	global $post;
	preg_match_all('/src="(.*)"/Us',get_the_content(),$matches);
	$link_img_post = $matches[1];
	return $link_img_post;
}

/********************************************************************
check link thumbnail
********************************************************************/
function check_link_thumb($post_id) {
	$img_customfield = get_post_meta($post_id, 'thumb', true);
	$img_attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	
	// get thumbnail
	if ($img_customfield) {
		$link_thumb = $img_customfield;
	} elseif ($img_attachment_image) {
		$link_thumb = $img_attachment_image[0];
	} else {
		$link_thumb = "";
	}
	return $link_thumb;
}

/********************************************************************
get link thumbnail
********************************************************************/
function get_link_thumb($post_id) {
	$img_customfield = get_post_meta($post_id, 'thumb', true);
	$img_attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	$img_uploads = get_children( array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID', 'numberposts' => 1) );
	
	$post_content = get_post_field('post_content', $post_id);
	$img_post = preg_match_all('/\< *[img][^\>]*src *= *[\"\']{0,1}([^\"\'\ >]*)/',$post_content,$matches);
	$img_default = get_bloginfo('template_directory').'/images/no-thumb.png';
	
	// get thumbnail
	if ($img_customfield) {
		$link_thumb = $img_customfield;
	} elseif ($img_attachment_image) {
		$link_thumb = $img_attachment_image[0];
	} elseif ($img_uploads == true) {
		foreach($img_uploads as $id => $attachment) {
			$img = wp_get_attachment_image_src($id, 'full');
			$link_thumb = $img[0];
		}
	} elseif (count($matches[1]) > 0) {
		$link_thumb = $matches[1][0];
	} else {
		$link_thumb = $img_default;
	}
	return $link_thumb;
}

/********************************************************************
creating thumbnails (no permalink to story, image only)
********************************************************************/
function show_thumb($w,$h,$zc,$cropfrom) {
	global $post;
	$img_customfield = get_post_meta($post->ID, 'thumb', true);
	$img_attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	$img_uploads = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID', 'numberposts' => 1) );
	$img_post = preg_match_all('/\< *[img][^\>]*src *= *[\"\']{0,1}([^\"\'\ >]*)/',get_the_content(),$matches);
	$img_default = get_bloginfo('template_directory').'/images/no-thumb.png';

	$thumbnail = 'thumbnail.php';
	
	// get thumbnail
	if ($img_customfield) {
		print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($img_customfield).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'"/>';
	} elseif ($img_attachment_image) {
		print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($img_attachment_image[0]).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'"/>';
	} elseif ($img_uploads == true) {
		foreach($img_uploads as $id => $attachment) {
			$img = wp_get_attachment_image_src($id, 'full');
			print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($img[0]).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'" />';
		}
	} elseif (count($matches[1]) > 0) {
		print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($matches[1][0]).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'" />';
	} else {
		print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($img_default).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'" />';
	}
}

/********************************************************************
link js & CSS
********************************************************************/
function vtk_scripts() {
  wp_enqueue_style('bootstrap.min', get_template_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css', array(), '' );
  wp_enqueue_style('font-awesome.min', get_template_directory_uri() . '/lib/font-awesome/css/font-awesome.css', array(), '' );
  wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), '' );
  wp_enqueue_style('reponsive', get_template_directory_uri() . '/css/reponsive.css', array(), '' );
  wp_enqueue_style('editor-style', get_template_directory_uri() . '/css/editor-style.css', array(), '' );

  wp_enqueue_script('jquery.min', get_template_directory_uri() . '/js/jquery.js', array(), '', true );
  wp_enqueue_script('bootstrap.min', get_template_directory_uri() . '/lib/bootstrap/js/bootstrap.min.js', array(), '', true );
  wp_enqueue_script('vtk-custom', get_template_directory_uri() . '/js/custom.js', array(), '', true );

}
add_action( 'wp_enqueue_scripts', 'vtk_scripts' );

/********************************************************************
custom post_type slider
********************************************************************/
add_theme_support( 'post-thumbnails' );
function tao_custom_post_type()
{
    $label = array(
        'name' => 'Ảnh slider', 
        'slider' => 'slider' 
    );
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type đăng slider', //Mô tả của post type
        'supports' => array(
            'title',
            'thumbnail'
        ), //Các tính năng được hỗ trợ trong post type
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, false thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-images-alt', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => true, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
    register_post_type('slider', $args);
}

add_action('init', 'tao_custom_post_type');
/********************************************************************
custom meta box link slider
********************************************************************/
function vtk_meta_box()
{
 add_meta_box( 'thong-tin', 'Thông tin slider ảnh', 'vtk_thongtin_output', 'slider' );
}
add_action( 'add_meta_boxes', 'vtk_meta_box' );
 
function vtk_thongtin_output( $post )
{
 $link_img = get_post_meta( $post->ID, '_link_img', true );
 echo ( '<label for="link_img">Link ảnh slider: </label>' );
 echo ('<input type="text" id="link_img" name="link_img" value="'.esc_attr( $link_img ).'" />');
}
 
function vtk_thongtin_save( $post_id )
{
 $link_img = sanitize_text_field( $_POST['link_img'] );
 update_post_meta( $post_id, '_link_img', $link_img );
}
add_action( 'save_post', 'vtk_thongtin_save' );


?>
