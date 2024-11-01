
<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );	
function nubirdz_chat_check_key($key)
{
	
	if(strlen($key) < 5 || strlen($key) > 10)
	{
		return '<div class="notice error"><p><strong>'.$key.'</strong> is invalid. Check to ensure your unique key is correct from your <a target="_blank" href="//dashboard.unmetered.chat">Dashboard</a>.</p></div>';
	}
	
	if(!ctype_alnum($key))
	{
		return '<div class="notice error"><p><strong>'.$key.'</strong> is invalid. Check to ensure your unique key is correct from your <a target="_blank" href="//dashboard.unmetered.chat">Dashboard</a>.</p></div>';
	}
	
	
	$url="check.unmetered.chat";
	$data = array('key' => $key);
	$ch = curl_init();    // initialize curl handle
	curl_setopt($ch, CURLOPT_URL, $url); // set url to post to
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
	curl_setopt($ch, CURLOPT_TIMEOUT, 4); // times out after 4s
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // add POST fields
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // turn off verification of SSL for testing
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // turn off verification of SSL for testing
	$result = curl_exec($ch); // run the whole process
	curl_close ($ch);	
	
	if($result == '{"success":false}')
	{
		return '<div class="notice error"><p><strong>'.$key.'</strong> is invalid. Have you logged in to the Admin <a target="_blank" href="//dashboard.unmetered.chat">Dashboard</a> at least once?</p></div>';
	}
}

 		
    if($_POST['nubirdz_chat_hidden'] == 'Y') {
        //Form data sent
		
		$retrieved_nonce = $_REQUEST['_wpnonce'];
if (!wp_verify_nonce($retrieved_nonce, 'nubirdz_chat_form_post' ) ) die( 'Failed security check' );
		
		
		
		$enabled = $_POST['nubirdz_chat_enabled'];
		$paid = $_POST['nubirdz_chat_paid'];
		
		if(isset($enabled) && $enabled != "on")
		{
			echo '<div class="notice error"><p>An error was encountered regarding the "enable" button. Does your browser have a tampering plugin installed?</p></div>';
			$enableTamper = true;
		}
		if(isset($paid) && $paid != "on")
		{
			echo '<div class="notice error"><p>An error was encountered regarding the "paid" button. Does your browser have a tampering plugin installed?</p></div>';
			$paidTamper = true;
		}
		
        $chatID = sanitize_text_field($_POST['nubirdz_chat_ID']);
		$check = nubirdz_chat_check_key($chatID);
		if($check == "" && !$enableTamper && !$paidTamper)
		{
			update_option('nubirdz_chat_ID', $chatID);
			update_option('nubirdz_chat_enabled', $enabled);
			update_option('nubirdz_chat_paid', $paid);
		}
		else
		{
			echo $check;
		}
 		
		
if ($enabled == "on")
		{
			$enCheck = "checked=\"checked\"";
		}
if ($paid == "on")
		{
			$paidCheck = "checked=\"checked\"";
		}
        ?>
        <div class="notice updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
		
		$chatID  = get_option('nubirdz_chat_ID');
		$enabled = get_option('nubirdz_chat_enabled');

		if ($enabled == "on")
		{
			$enCheck = "checked=\"checked\"";
		}
	}
?>
<div class="wrap">
    <?php    echo "<h2>" . __( 'UNMETERED.Chat Admin Menu') . "</h2>"; ?>
    <div id="word_notices"></div>
    <table width="100%">
    <tr valign="top">
    <td>
                <form name="nubirdz_chat_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                <?php wp_nonce_field('nubirdz_chat_form_post'); ?>
                    <input type="hidden" name="nubirdz_chat_hidden" value="Y">
                    <?php    echo "<h3>" . __( 'UNMETERED.Chat Settings', 'retsi_trdom' ) . "</h3>"; ?>
                     <p><?php _e("Enabled: " ); ?><input type="checkbox" name="nubirdz_chat_enabled" <?php echo $enCheck; ?>  size="20"></p>
                    <p><?php _e("Unique Key: " ); ?><input type="text" name="nubirdz_chat_ID" value="<?php if(ctype_alnum($chatID)){echo $chatID;} ?>" size="20">
                    <?php    echo "<h3>" . __( 'Dashboard Settings', 'retsi_trdom' ) . "</h3>"; ?>
                    </p>
                  <p><?php _e("Are you on a paid plan? (important for the proper dashboard to load) " ); ?><input type="checkbox" name="nubirdz_chat_paid" <?php echo $paidCheck; ?>  size="20"></p>
                    <p class="submit">
                    <input class="button-primary" type="submit" name="Submit" onclick="localStorage.removeItem('CloudChatE_')" value="<?php _e('Update Settings') ?>" /></form>
                    </p>
        </td>
    <td> <h3>No UNMETERED.Chat Account? No Problem!</h3><h4>Signup for FREE or upgrade to a paid account for more features!</h4>
     <table width="100" border="0" cellpadding="0">
       <tr>
         <td><form action="http://get.unmetered.chat/0/9DJIUCXJPR7P" target="_blank" method="post"><input class="button-primary" type="submit" name="Submit2" value="<?php _e('Signup Free') ?>" /></form></td>
         <td><form target="_self" action="" method="get">
     <input type="hidden" id="page" name="page" value="nubirdz_chat_compare" />
     <input class="button-primary" type="submit" name="Submit" value="<?php _e('Compare Plans') ?>" /></form></td>
     <td></td>
       </tr>
  </table>
    <br /> 10% Off Coupon Code: <strong>9DJIUCXJPR7P</strong></td>
    </tr>
    </table>
    
     
     <br />

        <br />
        <hr />

    
        </p>


<p><br />
<h2>ShortCode</h2>
<h4>[live_chat_button]</h4><img src="<?php echo plugins_url( 'images\chat_buttons.png', __FILE__ ); ?>" />
</p>

</div>