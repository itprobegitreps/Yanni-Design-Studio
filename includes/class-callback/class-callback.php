<?php
/**
* Класс содержит функции-обработчики AJAX-запросов
*/
class CCallback{
	
	public static $CLBK = Array();
	
	static function router(){
		
		if(isset($_REQUEST)&&!empty($_REQUEST)&&method_exists("CCallback", $_REQUEST['method']."Clbk")){
		
			$methodName = $_REQUEST['method']."Clbk";
			self::$methodName($_REQUEST['params']);
			self::retJson();
		}else{
			self::retJson(Array("error"=>"PHP Callback.router::invalid arguments"));
		}
	}
	
	static function retJson(){
	
		if(!is_array(self::$CLBK)){

			self::$CLBK['status'] = 'false';
		}
		
		echo json_encode(self::$CLBK);
	}

	static function sendEmailClbk($PARAMS)
	{
		global $wpdb;

		$content = "";

		foreach ($PARAMS['mail_data'] as $key => $value) {
			$content .= $key . ": " . $value . "\r\n";
		}

		$emails = $wpdb->get_results( "SELECT email FROM " . $wpdb->prefix . "email_galeries" );

		foreach($emails as $email)
		{
			mail($email->email,'Email from site Yanni', $content);
		}
		
	}
}
?>
