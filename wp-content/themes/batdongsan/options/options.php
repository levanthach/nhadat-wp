<?php
// create custom plugin settings menu
add_action('admin_menu', 'my_setting_theme');

function my_setting_theme() {

	//create new top-level menu
	add_menu_page('HK Theme Option', 'HK Option', 'administrator', 'hk_options', 'my_settings_page',get_stylesheet_directory_uri('stylesheet_directory')."/ico.png");
	
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'my-settings-group', 'my_setting_theme' );
	register_setting( 'my-settings-group', 'some_other_option' );
	register_setting( 'my-settings-group', 'option_etc' );
}

function my_settings_page() {
	$options = get_option( 'my_setting_theme' );
?>
<div class="wrap">
<h2>Cài đặt Website</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'my-settings-group' ); ?>
    <?php do_settings_sections( 'my-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Đơn vị chủ quản</th>
            <td><input type="text" size="80" name="my_setting_theme[vtk_dv]" value="<?php echo $options['vtk_dv']; ?>" /></td>
        </tr>

        <tr valign="top">
        	<th scope="row">Địa chỉ</th>
        	<td><input type="text" size="80" name="my_setting_theme[vtk_address]" value="<?php echo $options['vtk_address']; ?>" /></td>
        </tr>
		
        <tr valign="top">
        	<th scope="row">Điện thoại</th>
        	<td><input type="text" size="80" name="my_setting_theme[vtk_phone]" value="<?php echo $options['vtk_phone']; ?>" /></td>
        </tr>

         <tr valign="top">
            <th scope="row">Hot line</th>
            <td><input type="text" size="80" name="my_setting_theme[vtk_hot]" value="<?php echo $options['vtk_hot']; ?>" /></td>
        </tr>

        <tr valign="top">
        	<th scope="row">Email</th>
        	<td><input type="text" size="80" name="my_setting_theme[vtk_email]" value="<?php echo $options['vtk_email']; ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row">Fanpage facebook</th>
            <td><input type="text" size="80" name="my_setting_theme[vtk_fan]" value="<?php echo $options['vtk_fan']; ?>" /></td>
        </tr>
		
    </table>
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>