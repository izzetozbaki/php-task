<?php 
try {
	$db=new PDO("mysql:host=localhost;dbname=question;charset=utf8",'root','12345678');	
	//echo "Veritabanı bağlantısı başarılı";
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>