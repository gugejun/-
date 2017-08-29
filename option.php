<?php
add_action('admin_menu', 'NCPlayer_menu_page');
register_activation_hook(__FILE__, 'NCPlayer_install');
register_deactivation_hook(__FILE__, 'NCPlayer_uninstall');

function NCPlayer_install(){
	add_option('ncplayer_id','332777385');
	add_option('ncplayer_name','NeiCe.ORG');
	add_option('ncplayer_tips','欢迎访问 NeiCe.ORG');
	add_option('ncplayer_auto','open');
	add_option('ncplayer_random','open');
	add_option('ncplayer_geci','open');
	add_option('ncplayer_jquery');
	add_option('ncplayer_jquery_custom','http://api.neice.org/NC_Player/js/jquery.min.js');
}

function NCPlayer_uninstall(){
	delete_option('ncplayer_id');
	delete_option('ncplayer_name');
	delete_option('ncplayer_tips');
	delete_option('ncplayer_auto');
	delete_option('ncplayer_random');
	delete_option('ncplayer_geci');
	delete_option('ncplayer_jquery');
	delete_option('ncplayer_jquery_custom');
}

function NCPlayer_menu_page(){
    add_menu_page('网易云音乐', '网易云音乐', 'administrator', 'NCPlayer_options', 'NCPlayer_options', plugins_url('NC_Player/inc/icon.gif'), 99);
}

//设置页面
function NCPlayer_options(){?>  
    <div class="NCPlayer">  
        <h2>音乐播放器</h2>
		<?php update_NCPlayer_options() ?>
        <form method="post">  
			<p>网易云音乐ID:<input type="text" class="button-prim3ary" name="ncplayer_id" value="<?php echo get_option('ncplayer_id','692839474'); ?>" onblur="if(this.value.length&lt;1)this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value=''" />（输入网易云音乐个人主页的ID）</p>
			<p>播放列表名称:<input type="text" class="button-prim3ary" name="ncplayer_name" value="<?php echo get_option('ncplayer_name','NeiCe.ORG'); ?>" onblur="if(this.value.length&lt;1)this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value=''" /></p>
			<p>访客提示内容:<input type="text" class="button-prim3ary" name="ncplayer_tips" value="<?php echo get_option('ncplayer_tips','欢迎访问 NeiCe.ORG'); ?>" onblur="if(this.value.length&lt;1)this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value=''" />（设置欢迎语，比如：欢迎访问本站。）</p>
			<p>jQuery设置:
				<input type="radio" name="ncplayer_jquery" value="CUS" <?php if(get_option('ncplayer_jquery') == "CUS") echo "checked"?> />自定义
				<input type="text" class="button-prim3ary" name="ncplayer_jquery_custom" value="<?php echo get_option('ncplayer_jquery_custom', 'http://api.neice.org/NC_Player/js/jquery.min.js')?>" onblur="if(this.value.length&lt;1)this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value=''" /> 
				<input type="radio" name="ncplayer_jquery" value="YES" <?php if(get_option('ncplayer_jquery') == "YES") echo "checked"?> />高版本(推荐)
				<input type="radio" name="ncplayer_jquery" value="LOW" <?php if(get_option('ncplayer_jquery') == "LOW") echo "checked"?> />低版本(IE6/7/8) 
				<input type="radio" name="ncplayer_jquery" value="NO" <?php if(get_option('ncplayer_jquery') != "YES" && get_option('ncplayer_jquery') != "LOW" && get_option('ncplayer_jquery') != "CUS" ) echo "checked"?> />禁用(若当前主题已经加载了jQuery库，请选择禁用)</p>
			<p>自动播放:&nbsp;&nbsp;&nbsp;<input type="checkbox"" name="ncplayer_auto" value="open" <?php checked( get_option('ncplayer_auto'), 'open' );?>  />&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;顺序播放:&nbsp;&nbsp;&nbsp;<input type="checkbox"" name="ncplayer_random" value="open" <?php checked( get_option('ncplayer_random'), 'open' );?>  />&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;显示歌词:&nbsp;&nbsp;&nbsp;<input type="checkbox"" name="ncplayer_geci" value="open" <?php checked( get_option('ncplayer_geci'), 'open' );?></p>
			<br/><br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" id="submit" value="保存设置" />  
            </p>  
        </form>  
    </div>  
<?php }

function update_NCPlayer_options(){
				if($_POST['submit']){
					$updated = false;
					if($_POST['ncplayer_id']){
						update_option('ncplayer_id',$_POST['ncplayer_id']);
						$updated = true;
					}
					if($_POST['ncplayer_name']){
						update_option('ncplayer_name',$_POST['ncplayer_name']);
						$updated = true;
					}
					if($_POST['ncplayer_tips']){
						update_option('ncplayer_tips',$_POST['ncplayer_tips']);
						$updated = true;
					}
					if($_POST['ncplayer_jquery']){
						update_option('ncplayer_jquery',$_POST['ncplayer_jquery']);
						$updated = true;
					}
					if($_POST['ncplayer_jquery_custom']){
						update_option('ncplayer_jquery_custom',$_POST['ncplayer_jquery_custom']);
						$updated = true;
					}
					if($_POST['ncplayer_auto']){
						update_option('ncplayer_auto',$_POST['ncplayer_auto']);
						}else{
						update_option('ncplayer_auto','close');
					}
					if($_POST['ncplayer_random']){
						update_option('ncplayer_random',$_POST['ncplayer_random']);
						}else{
						update_option('ncplayer_random','close');
					}
					if($_POST['ncplayer_geci']){
						update_option('ncplayer_geci',$_POST['ncplayer_geci']);
						}else{
						update_option('ncplayer_geci','close');
					}

					if($updated){
						echo '设置成功';
					}else{
						echo '保存失败';
					}
				}
			}
?>