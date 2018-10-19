<?php
	include_once 'db_crea_conn.class.php';
	include_once 'usr_tb_crea.class.php'
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
			$pdo = new Connect;
			$pdo_conn = $pdo->connect();
			Usr_table::createTb($pdo_conn);
		?>
	</body>
</html>