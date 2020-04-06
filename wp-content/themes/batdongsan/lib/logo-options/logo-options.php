<?php
function logo_get_default_options() {
	$options = array(
		'logo' => ''
	);
	return $options;
}


function logo_options_init() {
     $logo_options = get_option( 'theme_logo_options' );
	 
	 // Are our options saved in the DB?
     if ( false === $logo_options ) {
		  // If not, we'll save our default options
          $logo_options = logo_get_default_options();
		  add_option( 'theme_logo_options', $logo_options );
     }
	 
     // In other case we don't need to update the DB
}
// Initialize Theme options
add_action( 'after_setup_theme', 'logo_options_init' );

function logo_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		// Now we'll replace the 'Insert into Post Button inside Thickbox' 
		add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
	}
}
add_action( 'admin_init', 'logo_options_setup' );

function replace_thickbox_text($translated_text, $text ) {	
	if ( 'Insert into Post' == $text ) {
		$referer = strpos( wp_get_referer(), 'logo-settings' );
		if ( $referer != '' ) {
			return __('Chọn hình này làm Logo!', 'logo' );
		}
	}

	return $translated_text;
}

// Add "Logo Options" link to the "Appearance" menu
function logo_menu_options() {
	//add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
     add_theme_page('Logo Options', 'Logo Options', 'edit_theme_options', 'logo-settings', 'logo_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'logo_menu_options');

function logo_admin_options_page() {
	?>
		<!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes 
		for a good WP Admin Panel viewing and are predefined by WP CSS -->
		
		
		
		<div class="wrap">
			
			<div id="icon-themes" class="icon32"><br /></div>
		
			<h2><?php _e( 'Logo Options', 'logo' ); ?></h2>
			
			<!-- If we have any error by submiting the form, they will appear here -->
			<?php settings_errors( 'logo-settings-errors' ); ?>
			
			<form id="form-logo-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
					settings_fields('theme_logo_options');
					do_settings_sections('logo');
				?>
			
				<p class="submit">
					<input name="theme_logo_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'logo'); ?>" />
					<input name="theme_logo_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'logo'); ?>" />		
				</p>
			
			</form>
			
		</div>
	<?php
}

function logo_options_validate( $input ) {
	$default_options = logo_get_default_options();
	$valid_input = $default_options;
	
	$logo_options = get_option('theme_logo_options');
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_logo = ! empty($input['delete_logo']) ? true : false;
	
	if ( $submit ) {
		if ( $logo_options['logo'] != $input['logo']  && $logo_options['logo'] != '' )
			delete_image( $logo_options['logo'] );
		
		$valid_input['logo'] = $input['logo'];
	}
	elseif ( $reset ) {
		delete_image( $logo_options['logo'] );
		$valid_input['logo'] = $default_options['logo'];
	}
	elseif ( $delete_logo ) {
		delete_image( $logo_options['logo'] );
		$valid_input['logo'] = '';
	}
	
	return $valid_input;
}

function delete_image( $image_url ) {
	global $wpdb;
	
	// We need to get the image's meta ID..
	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
	$results = $wpdb -> get_results($query);

	// And delete them (if more than one attachment is in the Library
	foreach ( $results as $row ) {
		wp_delete_attachment( $row -> ID );
	}	
}

/********************* JAVASCRIPT ******************************/
function logo_options_enqueue_scripts() {
	wp_register_script( 'logo-upload', get_template_directory_uri() .'/lib/logo-options/js/logo-upload.js', array('jquery','media-upload','thickbox') );	

	if ( 'appearance_page_logo-settings' == get_current_screen() -> id ) {
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('logo-upload');
		
	}
	
}
add_action('admin_enqueue_scripts', 'logo_options_enqueue_scripts');


function logo_options_settings_init() {
	register_setting( 'theme_logo_options', 'theme_logo_options', 'logo_options_validate' );
	
	// Add a form section for the Logo
	add_settings_section('logo_settings_header', __( 'Logo Options', 'logo' ), 'logo_settings_header_text', 'logo');
	
	// Add Logo uploader
	add_settings_field('logo_setting_logo',  __( 'Logo', 'logo' ), 'logo_setting_logo', 'logo', 'logo_settings_header');
	
	// Add Current Image Preview 
	add_settings_field('logo_setting_logo_preview',  __( 'Logo Preview', 'logo' ), 'logo_setting_logo_preview', 'logo', 'logo_settings_header');
}
add_action( 'admin_init', 'logo_options_settings_init' );

function logo_setting_logo_preview() {
	$logo_options = get_option( 'theme_logo_options' );  ?>
	
		<img src="<?php echo esc_url( $logo_options['logo'] ); ?>" />
	
	<?php
}

function logo_settings_header_text() {
	?>
		<p><?php _e( 'Manage Logo Options for Logo Theme.', 'logo' ); ?></p>
	<?php
}

function logo_setting_logo() {
	$logo_options = get_option( 'theme_logo_options' );
	?>
		<input type="hidden" id="logo_url" name="theme_logo_options[logo]" value="<?php echo esc_url( $logo_options['logo'] ); ?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'logo' ); ?>" />
		<?php if ( '' != $logo_options['logo'] ): ?>
			<input id="delete_logo_button" name="theme_logo_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'logo' ); ?></span>
	<?php
}

function logohuy() {
	$logo_options = get_option( 'theme_logo_options' );  ?>
	
		<img src="<?php echo esc_url( $logo_options['logo'] ); ?>" />
	
	<?php
}

?>