<?php 
ob_start();
session_start();
include 'baglan.php';



if (isset($_POST['firmakaydet'])) {
	
	$site = $_POST['siteurl'];

	header("Content-type:text/plain");
	$html = file_get_contents($site);

	$kaydet=$db->prepare("INSERT INTO company SET
		cname=:cname,
		siteurl=:siteurl,
		html=:html

		");
	$insert=$kaydet->execute(array(
		'cname' => $_POST['cname'],
		'siteurl' => $_POST['siteurl'],
		'html' => $html
	));

	if ($insert) {
		Header("Location:index.php?durum=ok");
	} else {
		Header("Location:index?durum=nor");
	}

}

if ($_GET['firmasil']=='ok') {
	$sil=$db->prepare("DELETE FROM company where cid=:cid");
	$kontrol=$sil->execute(array(
		'cid'=>$_GET['cid']
	));
	if($kontrol){
		header("Location:index.php?sil=ok");
	}else{
		header("Location:index.php?sil=no");
	}
}

if (isset($_POST['firmaduzenle'])) {
	$cid=$_POST['cid'];
	
	$kaydet=$db->prepare("UPDATE company SET
		cname=:cname,
		siteurl=:siteurl
		where cid={$_POST['cid']}");
	$update=$kaydet->execute(array(
		'cname' => $_POST['cname'],
		'siteurl' => $_POST['siteurl']	
	));

	if ($update) {
		Header("Location:index.php");
	} else {
		Header("Location:firma-duzenle.php?durum=no&cid=$cid");
	}

}


if (isset($_POST['kisiekle'])) {
	$cid=$_POST['cid'];
	$kaydet=$db->prepare("INSERT INTO persons SET
		cid=:cid,
		pname=:pname,
		psurname=:psurname,
		title=:title,
		mail=:mail,
		gsm=:gsm
		");
	$insert=$kaydet->execute(array(
		'cid' => $_POST['cid'],
		'pname' => $_POST['pname'],
		'psurname' => $_POST['psurname'],
		'title' => $_POST['title'],
		'mail' => $_POST['mail'],
		'gsm' => $_POST['gsm']	
	));

	if ($insert) {
		Header("Location:firma.php?cid=$cid");
	} else {
		Header("Location:kisi-ekle.php?durum=no");
	}

}

if ($_GET['kisisil']=='ok') {
	$cid = $_GET['cid'];
	$sil=$db->prepare("DELETE FROM persons where pid=:id");
	$kontrol=$sil->execute(array(
		'id'=>$_GET['pid']
	));
	if($kontrol){
		header("Location:firma.php?cid=$cid?sil=ok");
	}else{
		header("Location:firma.php?cid=$cid?sil=no");
	}
}


if (isset($_POST['kisiduzenle'])) {
	$pid=$_POST['pid'];
	$cid=$_POST['cid'];
	$kaydet=$db->prepare("UPDATE persons SET
		cid=:cid,
		pname=:pname,
		psurname=:psurname,
		title=:title,
		mail=:mail,
		gsm=:gsm		
		where pid={$_POST['pid']}");
	$update=$kaydet->execute(array(
		'cid' => $_POST['cid'],
		'pname' => $_POST['pname'],
		'psurname' => $_POST['psurname'],
		'title' => $_POST['title'],
		'mail' => $_POST['mail'],
		'gsm' => $_POST['gsm']	
	));

	if ($update) {
		Header("Location:firma.php?cid=$cid");
	} else {
		Header("Location:kisi-duzenle.php?durum=no&pid=$pid");
	}

}




if (isset($_POST['adreskaydet'])) {

	$cid=$_POST['cid'];

	$kaydet=$db->prepare("INSERT INTO adress SET
		cid=:cid,
		name=:name,
		place_Lat=:place_Lat,
		place_Lng=:place_Lng,
		place_Location=:place_Location
		");
	$insert=$kaydet->execute(array(
		'cid' => $_POST['cid'],
		'name' => $_POST['name'],
		'place_Lat' => $_POST['place_Lat'],
		'place_Lng' => $_POST['place_Lng'],
		'place_Location' => $_POST['place_Location']
	));

	if ($insert) {
		Header("Location:firma.php?cid=$cid");
	} else {
		Header("Location:adres-ekle.php?durum=no");
	}

}

?>