<?php
$options = get_option( 'my_setting_theme' );
if (isset($options['vtk_dv'])){ $vtk_dv = $options['vtk_dv'];}
if (isset($options['vtk_address'])){ $vtk_address = $options['vtk_address'];}
if (isset($options['vtk_phone'])){ $vtk_phone = $options['vtk_phone'];}
if (isset($options['vtk_email'])){ $vtk_email = $options['vtk_email'];}
if (isset($options['vtk_hot'])){ $vtk_hot = $options['vtk_hot'];}
?>		
		<footer>
			<div class="container">
				
				<h2><?php if ( $vtk_dv != "" ){ echo $vtk_dv; } ?></h2>
				<p>
					Địa chỉ: <?php if ( $vtk_address != "" ){ echo $vtk_address; } ?> <br>
					Mail: <?php if ( $vtk_email != "" ){ echo $vtk_email; } ?><br>
					Số điện thoại: <?php if ( $vtk_phone != "" ){ echo $vtk_phone; } ?> & <?php if ( $vtk_hot != "" ){ echo $vtk_hot; } ?>
				</p>
			</div>
			<div class="copyright">
				Bản quyền thuộc về SgNewLang.Com - Thiết kế và phát triển bởi <a href="http://huykira.net">Huy Kira</a>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>