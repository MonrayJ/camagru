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
		if (!mkdir("./user/gallery/", 0777, true)) {
			die('Failed to create folders...');
		}
			//$dbase = new Create;
//			$pdo = new Create;
			$pdo_conn = get_connect();
//			$tb = new Usr_table;
//			$tb->create_tb($pdo_conn);
			$tb = new Gallery_table;
			$tb->create_gallery($pdo_conn);
		?>
	</body>
</html>