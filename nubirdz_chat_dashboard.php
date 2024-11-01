<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); 

function nubirdz_chat_dashboard_source()
{
	$chatID  = get_option('nubirdz_chat_ID');
	$paid	= get_option('nubirdz_chat_paid');
	if(ctype_alnum($chatID) && $paid != "on")
	{
		return "http://free.unmetered.chat/".$chatID;
	}
	elseif(ctype_alnum($chatID) && $paid == "on")
	{
		return "http://dashboard.unmetered.chat/".$chatID;
	}
}

?>


        <div class="wrap">
       <iframe src="<?php echo nubirdz_chat_dashboard_source(); ?>" style="position: absolute; height: 100%; width: 100%; border: none"></iframe>

</div>