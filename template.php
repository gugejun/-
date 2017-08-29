<?php

function np_jquery() {  
    if ( !is_admin() && get_option(ncplayer_jquery) =='YES') {
        wp_deregister_script( 'jquery' );
        wp_register_script('jquery','//cdn.bootcss.com/jquery/3.1.1/jquery.min.js','' ,'3.1.1' ,false);
        wp_enqueue_script('jquery');  
    }
    if ( !is_admin() && get_option(ncplayer_jquery) =='LOW') {
        wp_deregister_script( 'jquery' );
        wp_register_script('jquery','//cdn.bootcss.com/jquery/1.12.4/jquery.min.js','' ,'1.12.4' ,false);
        wp_enqueue_script('jquery');  
    }
    if ( !is_admin() && get_option(ncplayer_jquery) =='CUS') {
        wp_deregister_script( 'jquery' );
        wp_register_script('jquery',get_option(ncplayer_jquery_custom),'' ,'custom' ,false);
        wp_enqueue_script('jquery');  
    }
}

function np_footer(){
	$id = get_option(ncplayer_id);
	$name = get_option(ncplayer_name);
	$geci = get_option(ncplayer_geci);
	$auto = get_option(ncplayer_auto);
	$random = get_option(ncplayer_random);
	$tips = get_option(ncplayer_tips);

	echo '<script>user="' . $id . '";name="' . $name . '";auto="' . $auto . '";random="' .$random. '";geci="' . $geci . '";welcome="open";tips="' . $tips . '";ver="2.5.21";</script>';
	echo '<script language="javascript"  src="http://api.neice.org/NC_Player/music.js"></script>';
	
}

?>