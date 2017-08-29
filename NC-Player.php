<?php
/*
Plugin Name: 网易云音乐悬浮播放器
Plugin URI: http://www.neice.org/432.html
Version: 2.5.21
Author: YingZi
Author URI: http://www.neice.org/
Description:调用网易云音乐歌单的悬浮音乐播放器
*/

define('NCPlayer_URL', plugins_url('', __FILE__));
define('NCPlayer_PATH', dirname(__FILE__));

require NCPlayer_PATH . '/inc/option.php';
require NCPlayer_PATH . '/inc/template.php';

add_action( 'init', 'np_jquery' );
add_action( 'wp_footer', 'np_footer');

register_activation_hook(__FILE__, 'NCPlayer_plugin_activate');
add_action('admin_init', 'NCPlayer_plugin_redirect');
 
function NCPlayer_plugin_activate() {
    add_option('NCPlayer_do_activation_redirect', true);
}
 
function NCPlayer_plugin_redirect() {
    if (get_option('NCPlayer_do_activation_redirect', false)) {
        delete_option('NCPlayer_do_activation_redirect');
        wp_redirect(admin_url( 'admin.php?page=NCPlayer_options' ));
    }
}

//仪表盘添加 RSS 订阅 (为了能及时发现新版本，请保留以下代码)
if(!function_exists('yz_rss')){
	
	add_action('wp_dashboard_setup', 'yz_rss' );
	function yz_rss() {
		global $wp_meta_boxes;		
		wp_add_dashboard_widget('yz_rss', 'WWW.NeiCe.ORG', 'yz_rss_list');
	}
	
	function yz_rss_list() {?>
	<?php 
		echo '<div class="rss-widget">';
		wp_widget_rss_output('http://www.neice.org/?feed=rss2', array( 'show_author' => 0, 'show_date' => 1, 'show_summary' => 0 ));
		echo "</div>";
	}
}
?>
