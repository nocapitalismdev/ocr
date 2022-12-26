<?php

	require_once('config.php');

	$decrypted_cookie = openssl_decrypt(@$_COOKIE[CHATTER_COOKIE], 'aes-128-cbc', ENCRYPT_KEY);
	$uid = explode("\xf1", $decrypted_cookie)[1];
	$nick = explode("\xf1", $decrypted_cookie)[0];

	if(empty(@$_COOKIE[CHATTER_COOKIE]) or !$decrypted_cookie):
		die(ERROR[0]);
	endif;

	$queue = apcu_fetch('queue');

	if(!$queue){
		apcu_store('queue', $decrypted_cookie);
	}elseif($queue != false and (string)$queue != $decrypted_cookie){
		$match_uid = explode("\xf1", $queue)[1];
		$match_nick = explode("\xf1", $queue)[0];
		$file = CHAT_TMP_DIR.$uid.$match_uid;
		$handle = fopen($file, "a");
			fwrite($handle, '');
		fclose($handle);
		setcookie('actualchat', $uid.$match_uid);
		header('Location: msg.php?action=1');
	}elseif($queue != false and (string)$queue == $decrypted_cookie){
		$chats_dir = scandir(CHAT_TMP_DIR);
		foreach($chats_dir as $key=>$value){
			if(strpos($value, $uid)){
				apcu_delete('queue');
				setcookie('actualchat', $value);
				header('Location: msg.php?action=1');
			}
		}
		echo "Aguardando...";
	}
