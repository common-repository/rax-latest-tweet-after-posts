<?php
/*
Plugin Name: RAX - Latest Tweet After Posts
Plugin URI: http://www.phpfreelancedevelopers.com/wordpress-rax-latest-tweets-after-posts-plugin-released/
Description: You can add Box after posts which contain Latest Tweet and Twitter follow icon set.
Version: 1.0
Author: Rakshit Patel
Author URI: http://www.phpfreelancedevelopers.com
License: GPL2
*/

/*  Copyright 2010  Rakshit Patel  (email : raxit4u2@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


	add_option("rax_twitterusername","raxit4u2"); //Enter Your Twitter Username
	add_option("rax_twittercount","3"); //Enter Your Twitter Username
	add_option("rax_twitterfollowimage","1"); //Enter Your Twitter Username
	add_option("rax_twitterbordercolor","EBEBEB"); //Enter Border color Hex code
	add_option("rax_twittertopbgcolor","4086C7"); //Enter Top Bg Color Hex Code
	add_option("rax_twitterbottombgcolor","D0E4F5"); //Enter Bottom Bg Color Hex Code

	add_action('admin_menu', 'rax_twitter_menu_options');
	
	add_action("the_content",'rax_show_twitter_options');
	
	function rax_twitter_menu_options() {
	
	  add_options_page('RAX - Latest Tweets After Post', ' RAX - Latest Tweets After Post', 'manage_options', 'rax-twitter-options', 'rax_twitter_options');
	
	}
	
	function rax_twitter_options() {
	
	  if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	  }
?>	
	  <div style="width:95%; font-size:11px; padding:3px 3px 3px 15px;">
	  <p style="font-size:20px; background-color:#4086C7; color:#FFF; width:70%; padding:2px;">Set Options for RAX - Latest Tweets After Post</p>
	  <p>
			<form method="post" action="options.php">
				<?php wp_nonce_field('update-options');?>
				<table width="100%" border="0" cellspacing="8" cellpadding="0">
                  <tr>
                  	<td width="22%" align="left" valign="top">Twitter Username : </td>
                    <td width="43%" align="left" valign="top"><input type="text" size="55" name="rax_twitterusername" id="rax_twitterusername" value="<?php echo get_option('rax_twitterusername'); ?>" /></td>
					<td width="35%" align="left" valign="top"><span style="font-size:10px; color:#333333;">(For e.g. raxit4u2)</span></td>
                  </tr>
                  <tr>
                  	<td width="22%" align="left" valign="top">Tweet Count : </td>
                    <td width="43%" align="left" valign="top"><input type="text" size="55" name="rax_twittercount" id="rax_twittercount" value="<?php echo get_option('rax_twittercount'); ?>" /></td>
					<td width="35%" align="left" valign="top"><span style="font-size:10px; color:#333333;">(For e.g. 3)</span></td>
                  </tr>
                  <tr>
                  	<td colspan="3"><h2>CSS Settings</h2></td>
                  </tr>  
                  <tr>
                  	<td align="left" valign="top">Border Color : </td>
                    <td align="left" valign="top"><input type="text" size="55" name="rax_twitterbordercolor" id="rax_twitterbordercolor" value="<?php echo get_option('rax_twitterbordercolor'); ?>" /></td>
					<td align="left" valign="top"><span style="font-size:10px; color:#333333;">(For e.g. EBEBEB (Hex Code without #)</span></td>
                  </tr>
                  <tr>
                  	<td align="left" valign="top">Top Background Color : </td>
                    <td align="left" valign="top"><input type="text" size="55" name="rax_twittertopbgcolor" id="rax_twittertopbgcolor" value="<?php echo get_option('rax_twittertopbgcolor'); ?>" /></td>
					<td align="left" valign="top"><span style="font-size:10px; color:#333333;">(For e.g. 4086C7 (Hex Code without #)</span></td>
                  </tr>
                  <tr>
                  	<td align="left" valign="top">Bottom Background Color : </td>
                    <td align="left" valign="top"><input type="text" size="55" name="rax_twitterbottombgcolor" id="rax_twitterbottombgcolor" value="<?php echo get_option('rax_twitterbottombgcolor'); ?>" /></td>
					<td align="left" valign="top"><span style="font-size:10px; color:#333333;">(For e.g. D0E4F5 (Hex Code without #)</span></td>
                  </tr>
				  <tr>
                  	<td align="left" valign="top">&nbsp;</td>
                    <td align="left" valign="top"><input type="submit" value="<?php _e('Update Options')?>" /></td>
					<td align="left" valign="top">&nbsp;</td>
                  </tr>
				</table>
				
				
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="rax_twitterusername,rax_twittercount,rax_twitterbordercolor,rax_twittertopbgcolor,rax_twitterbottombgcolor" />
			</form>
	  </p>
	  </div>
<?php				
	}

	function rax_show_twitter_options($post_content)
	{
		if( is_single() )
		{
			$post_content .= '<style type="text/css">
			div.rax-twittericon {
				width:83%;
			}
			div.rax_twittersubscribe
			{
				width:80%;
				float:left;
				border:8px solid #'.get_option('rax_twitterbordercolor').';
				background-color:#'.get_option('rax_twitterbottombgcolor').';
				margin:0;
			}
			div.rax-twitteremail-subscribe
			{
				background-color:#'.get_option('rax_twittertopbgcolor').';
				padding:10px;
			}
			div.rax-twitteremail-subscribe span
			{
				color:#FFF;
				font-size:24px;
			}
			div.rax-twitteremail-subscribe input.rax-twitterbutton
			{
				font-size:14px !important;
				padding:2px !important;
				*padding:0px;
			}
			div.rax-twitterother-subscribe
			{
				margin:10px 5px;
			}
			div.rax-twitterother-subscribe img
			{
				display:inline;
			}
			.clear
			{
				padding:0;
				margin:0;
			}
			.rax-twittercredit
			{
				width:60%;
				text-align:right;
			}
			.rax-twittercredit a
			{
				text-decoration:none;
				font-size:9px;
				color:#CCC;
			}
			.rax-twittercredit a:hover
			{
				text-decoration:none;
			}
			</style>
			<div class="clear"><!-- --></div>';

			$rax_twitterusername = get_option("rax_twitterusername"); // get twitter username
			
			$post_content .= '<div class="rax-twittericon">
					<a href="http://www.twitter.com/'.$rax_twitterusername.'"><img src="/demo/wordpress/wp-content/plugins/rax-latest-tweet-after-post/images/tweet-icon.jpg" align="right" /></a>
				</div>
				<div class="clear"><!-- --></div>
			<div class="rax_twittersubscribe">
				<div class="rax-twitteremail-subscribe">
					<span>Latest Tweets</span>
				</div>
				<div class="rax-twitterother-subscribe">';
				
				$rax_twittercount = get_option("rax_twittercount"); // get twitter username
				$format = 'json'; // set format
				$tweet = json_decode(file_get_contents("http://api.twitter.com/1/statuses/user_timeline/{$rax_twitterusername}.{$format}")); // get tweets and decode them into a variable
				$post_content .= '<ul>';
				for($rax_num=0;$rax_num<$rax_twittercount;$rax_num++) {
					$post_content .= "<li>".$tweet[$rax_num]->text."</li>"; // show latest tweet
				}
				$post_content .= '</ul>';
				$post_content .= '</div>
			</div>
			
			<div class="clear"><!-- --></div>';
		}
		
		return  $post_content;

	}
?>