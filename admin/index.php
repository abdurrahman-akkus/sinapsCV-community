<?php 

session_start(); 
if(@$_SESSION ["girisKontrol"]==1) {
   
    header("Location: anasayfa.php");
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<title>Sinaps IK·Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../img/sinapsCV_logo.svg"/>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.v3.3.7.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
	<link href="../css/fontawesome.min.css" rel="stylesheet" type="text/css">
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
<!--===============================================================================================-->	
<!--===============================================================================================-->
<!--===============================================================================================-->
<!--===============================================================================================-->	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/index-util.css">
	<link rel="stylesheet" type="text/css" href="../css/index-main.css">
<!--===============================================================================================-->
</head>
<body style="position:relative">
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../img/background.png');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="">
					<img src="../img/sinapsCV_logo.svg" class="login100-form-logo" >

					<span class="login100-form-title p-b-34 p-t-27">
						Sinaps İnsan Kaynakları
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Kullanıcı Adı bilgisi boş geçilemez...">
						<input class="input100" type="text" name="username" placeholder="Kullanıcı Adı">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input " data-validate="Şifre bilgisi boş geçilemez...">
						<input class="input100" type="password" name="password" placeholder="Şifre">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>


					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="submit" value="Giriş">
							
					</div>

				</form>
			</div>
		</div>
	</div>

        <!-- jQuery -->
        <script src="../js/jquery-3.4.0.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.v3.3.7.min.js"></script>


<?php 
require_once('inc-functions.php');

if(@$_POST ["submit"]) {
	$kadi=$_POST["username"];
	$sfre=$_POST["password"];
	$cek=$db->prepare("SELECT * FROM users WHERE username=:kadi AND password=:sfre");
	$cek->bindValue(":kadi", $kadi, PDO::PARAM_STR);
	$cek->bindValue(":sfre", $sfre, PDO::PARAM_STR);
	$row=$cek->execute();

	if($row= $cek->fetch(PDO::FETCH_ASSOC)){
		$vt_kadi=$row["username"];
		$vt_password=$row["password"]; 
		$ytk=$row["yetki"];
		if($kadi == $vt_kadi && $sfre == $vt_password)
		{
		$_SESSION ["girisKontrol"] = 1; //giriş yapmış.
		$_SESSION["username"] = $_POST ["username"];
		$_SESSION ["yetki"] = $ytk;
		echo " <p style = 'text-align : center; color: black';> Giriş Başarılı </p>" ;
		header("Location: anasayfa.php?usr=$vt_kadi&ytk=$ytk");
		return true;
		}
		else{
		echo " <p style = 'position:absolute;bottom:0;width:100%;z-index:9999;text-align : center; color: red';> Kullanıcı adı veya parola yanlış girildi </p>" ;
		return false;
		}
	}else{
		echo " <p style = 'position:absolute;bottom:0;width:100%;z-index:9999;text-align : center; color: red';> Kullanıcı adı veya parola yanlış girildi </p>" ;
		return false;
		}
}else {
	if(@$_GET["i"] == "cikis") 
	{
	
	echo " <p style = 'position:absolute;bottom:0;width:100%;z-index:9999;text-align : center; color: green';> Başarı ile Çıkış Yaptınız </p>" ;
	}
	elseif (@$_GET["i"] == "hack") {
	# code...
	echo " <p style = 'position:absolute;bottom:0;width:100%;z-index:9999;text-align : center; color:red';> Öncelikle giriş yapmalısınız. </p>" ;
	}
}




 ?>

</body>
</html>