<?php
namespace Cloud2PNG;

$logo = CLOUD2PNG_URL . 'lib/Customizer/assets/img/cloud2png-logo.svg';
$width = Helper::get_option( 'width', 'cloud2png', '0' );
$height = Helper::get_option( 'height', 'cloud2png', '0' );

$border_width = Helper::get_option( 'border_width', 'cloud2png', 0 );
$border_color = Helper::get_option( 'border_color', 'cloud2png', '#000000' );
$border_radius = Helper::get_option( 'border_radius', 'cloud2png', '0' );
?>
<body>
<style>
body {
	width: 100%;
	height: 100%;
	background-color: #ddd;
	display: flex;
	align-items: center;
	justify-content: center;
}
#cloud2png {
	width: <?php echo $width; ?>px;
	height: <?php echo $height; ?>px;
	background-color: #3399FF;
	background-clip: content-box;
	border-style: solid;
	border: 0;
	border-radius: <?php echo $border_radius; ?>px;
	box-shadow: 0 0 0 <?php printf( '%spx %s',$border_width, $border_color ); ?>;
}
</style>
<img  id="cloud2png" src="<?php echo $logo;?>" />
</body>
