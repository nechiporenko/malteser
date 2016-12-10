<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

if($_POST){
	$json = array(); // response array
	
	//site re-captcha secret key
	$secret = '6LcywA0UAAAAAL4FkaAfK0HPAc--HSBggiNYNa-z';
	//get verify response data
	$response = $_POST["captcha"];
	$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
	$captcha_success=json_decode($verify);
	
	if ($captcha_success->success == false) {
		//This user was not verified by recaptcha.
		$json['error'] = 'Напевно, ви - робот?';
		echo json_encode($json);
		die();
	}
	else if ($captcha_success->success == true) {
		//This user is verified by recaptcha
		$name = trim(strip_tags($_POST['of_name']));
		$email = trim(strip_tags($_POST['of_mail']));
		$service = trim(strip_tags($_POST['of_service']));
		$phone = trim(strip_tags($_POST['of_phone']));
		$msg = wp_strip_all_tags($_POST['of_msg']);
		//additional check
		if(empty($name) || empty($email)){
			$json['error'] = 'Заповніть перші два поля форми!'; 
			echo json_encode($json);
			die();
		}
		if(!is_email($email)){
			$json['error'] = 'Не вірний email!'; 
			echo json_encode($json);
			die();
		}
		//send data to email
		$to = array("s.nechiporenko@gmail.com");	
		$what = "<p>З сайту надійшло нове замовлення!</p>";
		$what .= "<p>Ім'я: " . $name . "</p>";
		$what .= "<p>Эл. пошта: " . $email . "</p>";
		$what .= "<p>Послуга: " . $service . "</p>";
		$what .= "<p>Телефон: " . $phone . "</p>";
		$what .= "<p>Повідомлення:</p><p>" . $msg . "</p>";
		$subj = 'Нове замовлення з сайта malteser.com.ua!';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$mailit = wp_mail($to, $subj, $what, $headers);
		
		$json['error'] = 0;
		echo json_encode($json);
	}
} else {
	echo 'GET LOST!';
}

?>
