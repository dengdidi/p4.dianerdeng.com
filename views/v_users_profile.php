<center>
	<h2><?=$user->first_name?>'s Profile</h2>
	
	<h4>
	<?=$user->first_name?> <?=$user->last_name?>
	<br>
	<?=$user->email?>
	</h4>
	
	<br>
	Currently logged in @ <?=$_SERVER['REMOTE_ADDR']?>
</center>
