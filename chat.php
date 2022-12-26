<?php

        require_once('config.php');

	if(isset($_POST['nick'])){
		$uid = uniqid();
		setcookie(CHATTER_COOKIE, @openssl_encrypt(strip_tags($_POST['nick'])."\xf1".$uid, 'aes-128-cbc', ENCRYPT_KEY));
	}

?>
<html>
        <head>
                <title><?php echo SITE_TITLE;?></title>
                <link rel='stylesheet' href='<?php echo CSS_FILE;?>'>
        <head>
        <body>
                <center>
                <h1 id='title'><?php echo SITE_TITLE;?></h1>
                <div id='content-block'>
			<form action='msg.php?action=0' target='messages-box' method='POST'>
				<input name='msg' type='text' placeholder='Digite aqui!' required>
				<button type='submit'>Enviar</button>
			</form>
			<iframe id='iframe' src='queue.php' name='messages-box'></iframe>
			<script>
        			window.setInterval(function() {
            				reloadIFrame()
        			}, 5000);

        			function reloadIFrame() {
            				document.getElementById('iframe').contentWindow.location.reload();
        			}
    			</script>
                </div>
                </center>
                <footer>
                        <a href='https://github.com/nocapitalismdev/orchat'>orchat</a> Copyright © 2022-2023 nocapitalismdev
                </footer>
        </body>
</html>

