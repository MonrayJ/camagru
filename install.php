<?php
	include_once 'create.class.php';
	include_once 'user/config.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php
			//$dbase = new Create;
//			$pdo = new Create;
			$pdo_conn = get_connect();
			$tb = new Usr_table;
			$tb->create_tb($pdo_conn);
		?>
	</body>
</html>