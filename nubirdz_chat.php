<?php
   /*
   Plugin Name: UNMETERED Chat
   Plugin URI: http://nubirdz.com
   Description: This plugin provides integration of live chat by UNMETERED.IO to your website
   Version: 1.2
   Author: Nubirdz Computers Inc.
   Author URI: http://www.nubirdz.com
   License: GPL2
   */
   defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
   function nubirdz_chat_code_insert()
   {
	   if(get_option('nubirdz_chat_enabled') == "on")
	   {
	   $chatID  = get_option('nubirdz_chat_ID');
	   ?>
	   <script type="text/javascript">
	   $=window.jQuery;
(function($){$.ls={e:localStorage,n:'CloudChatE_'};$.ls.g=$.ls.e.getItem($.ls.n);if($.ls.g&&$.ls.g.length>10){$("body").append($.ls.g)}else{$.get("//embed.unmetered.chat/<?php echo $chatID?>",function(d){$.ls.e.setItem($.ls.n,d);$("body").append(d)})}})(jQuery)
</script>
	   <?php
	   }
	   
   }
   
   function nubirdz_chat_admin() 
   {
	   include('nubirdz_chat_admin.php');
   }
   
   function nubirdz_chat_help() 
   {
	   include('nubirdz_chat_help.php');
   }
   
   function nubirdz_chat_dashboard() 
   {
	   include('nubirdz_chat_dashboard.php');
   }
   
   function nubirdz_chat_compare() 
   {
	   include('nubirdz_chat_compare.php');
   }
   
   function nubirdz_chat_admin_actions() 
   {
	    add_menu_page( 'UNMETERED.Chat', 'Chat Config', 'manage_options', 'nubirdz_chat_config', 'nubirdz_chat_admin' );
		add_submenu_page('nubirdz_chat_config',"Dashboard", "Chat Dashboard", 'manage_options', "nubirdz_chat_dashboard", "nubirdz_chat_dashboard");
		add_submenu_page('nubirdz_chat_config',"Help", "Chat Help", 'manage_options', "nubirdz_chat_help_page", "nubirdz_chat_help");
		add_submenu_page('nubirdz_chat_config',"Compare Plans", "Compare Chat Plans", 'manage_options', "nubirdz_chat_compare", "nubirdz_chat_compare");
   }
   
   function nubirdz_chat_button()
   {
	   if(get_option('nubirdz_chat_enabled') == "on")
	   {
	   $insert = '<div class="CloudChat-launcher mm-chat-toggle mmbg-small-2"><span class="title">Questions?</span><span class="faces"><i class="chi-emo-coffee"></i></span><div class="foot"><span class="status">Leave a <b>Message</b></span></div></div>';
	   
	   return $insert;
	   }
   }
     

	function nubirdz_chat_activate()
	{
    	register_uninstall_hook( __FILE__, 'nubirdz_chat_uninstall' );
	}

 

	function nubirdz_chat_uninstall()
	{
    	 delete_option('nubirdz_chat_ID');
		 delete_option('nubirdz_chat_enabled');
	}
	
	

	wp_enqueue_script('jQuery');
	
	add_action( 'admin_enqueue_scripts', 'nubirdz_chat_admin_enqueue' );
   add_action('admin_menu', 'nubirdz_chat_admin_actions');
   add_action("wp_print_footer_scripts", "nubirdz_chat_code_insert");
   add_shortcode( 'live_chat_button', 'nubirdz_chat_button');
   register_activation_hook( __FILE__, 'nubirdz_chat_activate' );
   
   
   
 
   
?>