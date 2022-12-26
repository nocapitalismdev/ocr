<?php

        require_once('config.php');

	$chat_file = @$_COOKIE['actualchat'];
        $decrypted_cookie = openssl_decrypt(@$_COOKIE[CHATTER_COOKIE], 'aes-128-cbc', ENCRYPT_KEY);
        $uid = explode("\xf1", $decrypted_cookie)[1];
        $nick = explode("\xf1", $decrypted_cookie)[0];

	if(empty(@$_COOKIE[CHATTER_COOKIE]) or !$decrypted_cookie){
                die(ERROR[0]);
        }
        if(!str_starts_with($chat_file, $uid) and !str_ends_with($chat_file, $uid)){
        	die(ERROR[1]);
        }


	switch(@$_GET['action']){
		case 0:
			$msg = strip_tags($_POST['msg']);
			$enc_msg = openssl_encrypt($msg, 'aes-128-cbc', ENCRYPT_KEY);
			$file = CHAT_TMP_DIR.$chat_file;
                	$handle = fopen($file, "a");
                        	fwrite($handle, $uid."\xf6".$nick."\xf6".$enc_msg."\xf2");
                	fclose($handle);
			echo $enc_msg.'<br>'.$msg;
			header('Location: msg.php?action=1');
		break;

		case 1:
			$match_nick = str_replace($uid, '', $chat_file);

			echo 'Conectado com <b>'.$match_nick.'</b><br><br>';

			//Show Messages
			$raw_msg = file_get_contents(CHAT_TMP_DIR.$chat_file);
			$exp_msg = array_values(array_filter(array_reverse(explode("\xf2", $raw_msg))));
			foreach($exp_msg as $msg){
				$data = explode("\xf6", $msg);
				echo '<br><b>'.@$data[1].': </b>'.openssl_decrypt(@$data[2], 'aes-128-cbc', ENCRYPT_KEY);
			}
		break;
	}
