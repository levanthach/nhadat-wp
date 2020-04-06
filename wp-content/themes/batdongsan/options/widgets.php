<?php 
/********************************************************************
//wid get sản phẩm nổi bật trang chủ
********************************************************************/
class category_posts_top_widget extends WP_Widget {
  function category_posts_top_widget() {
    $widget_ops = array( 'classname' => 'category_posts_top_widget', 'description' => 'Display specific category posts in the sidebar' ); // Widget Settings
    $control_ops = array( 'id_base' => 'category_posts_top_widget' ); // Widget Control Settings
    $this->WP_Widget( 'category_posts_top_widget', 'Sản phẩm nổi bật', $widget_ops, $control_ops ); // Create the widget
  }
    function widget($args, $instance) {
      extract( $args );
      $title    = apply_filters('widget_title', $instance['title']); // the widget title
      $postsnumber    = $instance['postsnumber'];
?>
<?php 
if ( !defined('ABSPATH') )
  die('-1');

echo $before_widget;

if ( ! empty( $title ) )
  echo $before_title . $title . $after_title;
?>
    <div class="row">
        <?php $args = array( 'post_type' => 'product','posts_per_page' => $postsnumber, 'meta_key' => '_featured','meta_value' => 'yes',); ?>
        <?php $getposts = new WP_query( $args);?>
        <?php global $wp_query; $wp_query->in_the_loop = true; ?>
        <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
        <?php global $product; ?>
          <div class="item-product col-xs-12 col-sm-4 col-md-3">
                 <div class="content-item">
                  <a href="<?php the_permalink();?>"><?php show_thumb(175,180,1,'c'); ?></a>
                  <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                  <p class="price"><?php echo $product->get_price_html(); ?></p>
                  <div class="addcart">
                      <button type="submit" class="add_to_cart_button product_type_<?php echo $product->product_type; ?> btn-warning btn" data-product_id="<?php echo $product->id; ?>"> Mua hàng</button>
                  </div>
                 </div>
              </div>
        <?php endwhile; ?>
    </div>
      <?php echo $after_widget; ?>          
<?php } 

    function update($new_instance, $old_instance) {
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['postsnumber'] = strip_tags($new_instance['postsnumber']);
      return $instance;
    }
  function form($instance) {
  $defaults = array( 'title' => 'Category Posts', 'cp_id' => 'Category ID' , 'mau' =>'do' );
  $instance = wp_parse_args( (array) $instance, $defaults ); ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
     <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('postsnumber'); ?>"><?php _e('Số lượng sản phẩm: '); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('postsnumber'); ?>" name="<?php echo $this->get_field_name('postsnumber'); ?>" type="text" value="<?php echo $instance['postsnumber']; ?>" />
    </p>
    <?php }
}
  add_action('widgets_init', create_function('', 'return register_widget("category_posts_top_widget");'));
  ?>


  <?php 
/********************************************************************
//wid get sản phẩm giảm giá trang chủ
********************************************************************/
class product_sale_widget extends WP_Widget {
  function product_sale_widget() {
    $widget_ops = array( 'classname' => 'product_sale_widget', 'description' => 'Display specific category posts in the sidebar' ); // Widget Settings
    $control_ops = array( 'id_base' => 'product_sale_widget' ); // Widget Control Settings
    $this->WP_Widget( 'product_sale_widget', 'Sản phẩm giảm giá', $widget_ops, $control_ops ); // Create the widget
  }
    function widget($args, $instance) {
      extract( $args );
      $title    = apply_filters('widget_title', $instance['title']); // the widget title
      $postsnumber    = $instance['postsnumber'];
?>
<?php 
if ( !defined('ABSPATH') )
  die('-1');

echo $before_widget;

if ( ! empty( $title ) )
  echo $before_title . $title . $after_title;
?>
    <div class="row">
      <?php $args = array( 'post_type' => 'product','posts_per_page' => $postsnumber, 'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'           => '_sale_price',
                'value'         => 0,
                'compare'       => '>',
                'type'          => 'numeric'
            )
        ) ); ?>
      <?php $getposts = new WP_query( $args);?>
      <?php global $wp_query; $wp_query->in_the_loop = true; ?>
      <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
      <?php global $product; ?>
        <div class="item-product col-xs-12 col-sm-4 col-md-3">
               <div class="content-item">
                <a href="<?php the_permalink();?>"><?php show_thumb(175,180,1,'c'); ?></a>
                <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                <p class="price"><?php echo $product->get_price_html(); ?></p>
                <div class="addcart">
                      <button type="submit" class="add_to_cart_button product_type_<?php echo $product->product_type; ?> btn-warning btn" data-product_id="<?php echo $product->id; ?>"> Mua hàng</button>
                  </div>
               </div>
            </div>
      <?php endwhile; ?>
    </div>
      <?php echo $after_widget; ?>          
<?php } 

    function update($new_instance, $old_instance) {
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['postsnumber'] = strip_tags($new_instance['postsnumber']);
      return $instance;
    }
  function form($instance) {
  $defaults = array( 'title' => 'Category Posts', 'cp_id' => 'Category ID' , 'mau' =>'do' );
  $instance = wp_parse_args( (array) $instance, $defaults ); ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
     <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('postsnumber'); ?>"><?php _e('Số lượng sản phẩm: '); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('postsnumber'); ?>" name="<?php echo $this->get_field_name('postsnumber'); ?>" type="text" value="<?php echo $instance['postsnumber']; ?>" />
    </p>
    <?php }
}
  add_action('widgets_init', create_function('', 'return register_widget("product_sale_widget");'));
  ?>