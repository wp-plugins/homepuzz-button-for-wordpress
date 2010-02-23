<?php
/*
Plugin Name: Homepuzz Button For Wordpress
Plugin URI: http://www.homepuzz.com/blog/
Description: It adds Homepuzz button to your post/page
Version: 1.0.0	
Author: Homepuzz, Souany
Author URI: http://www.homepuzz.com/
Wordpress version supported: 2.7 and above
*/

/*  Copyright 2010  Souany  (email : souanypro@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/
define("HOMEPUZZ_BUTTON","1.0",false);
function homepuzz_url( $path = '' ) {
	global $wp_version;
	if ( version_compare( $wp_version, '2.8', '<' ) ) { // Using WordPress 2.7
		$folder = dirname( plugin_basename( __FILE__ ) );
		if ( '.' != $folder )
			$path = path_join( ltrim( $folder, '/' ), $path );

		return plugins_url( $path );
	}
	return plugins_url( $path, __FILE__ );
}
//on activation, your CAA forms options will be populated. Here a single option is used which is actually an array of multiple options
function activate_homepuzz() {

global $homepuzz_options;
	$homepuzz_options = array('rel'=> 'nofollow', 
	                           'location'=>'after',
							   'width'=>'50',
							   'height'=>'61');
	add_option('homepuzz_options',$homepuzz_options);
}	
global $homepuzz_options;	
$homepuzz_options = get_option('homepuzz_options');			  
register_activation_hook( __FILE__, 'activate_homepuzz' );

function add_homepuzz_button_automatic($content){ 
 global $homepuzz_options, $post;
 $p_title = get_the_title($post->ID);
$hurl="'http://www.homepuzz.com/button.php?u=".get_permalink( $post->ID )."&t=".str_replace(" ","+",$p_title)."'";
$homepuzz_button = '<div style="float: right; margin-left:10px;"><a href="#"><img
src="'.homepuzz_url('/images/repuzz.gif').'" style="border-width:0;border:0;border: none;" onclick="window.open('.$hurl.',\'sharer\',\'toolbar=0,status=0,width=626,height=436\');return false;" border="0" alt="Homepuzz" /></a></div>';
  if($homepuzz_options['location'] == 'before' ){
    $content = $homepuzz_button.$content;
  }
  else{
    // $content = $content.$homepuzz_button;
     $content = $homepuzz_button.$content;
  }
  return $content;
}
if ($homepuzz_options['location'] != 'manual'){
add_filter('the_content','add_homepuzz_button_automatic'); 
}

function add_homepuzz_button(){
 global $homepuzz_options, $post;
 $p_title = get_the_title($post->ID);
$hurl="'http://www.homepuzz.com/button.php?u=".get_permalink( $post->ID )."&t=".str_replace(" ","+",$p_title)."'";
$homepuzz_button = '<div style="float: right; margin-left: 10px;"><a href="#"><img
src="'.homepuzz_url('/images/repuzz.gif').'" style="border-width : 0;border : 0;border: none;" onclick="window.open('.$hurl.',\'sharer\',\'toolbar=0,status=0,width=626,height=436\');return false;" alt="Homepuzz Repuzz" width="'.$homepuzz_options['width'].'" height="'.$homepuzz_options['height'].'" border="0" /></a></div>';
 echo $homepuzz_button;
}

// function for adding settings page to wp-admin
function homepuzz_settings() {
	add_options_page('Homepuzz', 'Homepuzz', 9, basename(__FILE__), 'homepuzz_options_form');
}

function homepuzz_options_form(){ 
global $homepuzz_options;
?>
<div class="wrap">
<form method="post" action="options.php">

<?php settings_fields('homepuzz_options_group'); ?>

<h2>Homepuzz Button Options</h2> 

<table class="form-table">

<tr valign="top">
<th scope="row">Rel Attribute</th>
<td><input type="text" name="homepuzz_options[rel]" id="item_name" class="regular-text code" value="<?php echo $homepuzz_options['rel']; ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Location of the button</th>
<td><select name="homepuzz_options[location]" id="location" >
<option value="before" <?php if ($homepuzz_options['location'] == "before"){ echo "selected";}?> >Before Content</option>
<option value="after" <?php if ($homepuzz_options['location'] == "after"){ echo "selected";}?> >After Content</option>
<option value="manual" <?php if ($homepuzz_options['location'] == "manual"){ echo "selected";}?> >Manual Insertion</option>
</select>
(Use template tag <code>add_homepuzz_button();</code> for Manual Insertion)
</td>
</tr>

<tr valign="top">
<th scope="row">Icon Width</th>
<td><input type="text" name="homepuzz_options[width]" id="item_name" class="small-text" value="<?php echo $homepuzz_options['width']; ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Icon Height</th>
<td><input type="text" name="homepuzz_options[height]" id="item_name" class="small-text" value="<?php echo $homepuzz_options['height']; ?>" /></td>
</tr>

</table>

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>

</div>
<?php }

// Hook for adding admin menus
if ( is_admin() ){ // admin actions
  add_action('admin_menu', 'homepuzz_settings');
  add_action( 'admin_init', 'register_homepuzz_settings' ); 
} 
function register_homepuzz_settings() { // whitelist options
  register_setting( 'homepuzz_options_group', 'homepuzz_options' );
}

?>