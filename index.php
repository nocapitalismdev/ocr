<?php

	require_once('config.php');

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
			<h4 id="subtitle"><?php echo SITE_SUBTITLE;?></h4>
			<br>
			<p>Nós somos um site de chat aleatório. Nosso sistema é feito 100% em PHP e é de código aberto. Confira nosso código <a href='https://github.com/nocapitalismdev/orchat'>aqui</a>.</p>
			<br>
			<form method='post' action='chat.php'>
				<input placeholder='Insira um nickname' name='nick'><button type='submit'>Ir</button>
			</form>
		</div>
		</center>
		<footer>
			<a href='https://github.com/nocapitalismdev/orchat'>orchat</a> Copyright © 2022-2023 nocapitalismdev
		</footer>
	</body>
</html>
