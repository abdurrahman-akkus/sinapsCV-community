<?php 
require_once 'inc-functions.php';

session_start();
@$yetki=$_SESSION["yetki"]; 


if(@$_SESSION ["girisKontrol"]!=1) {
   
    header("Location: index.php?i=hack");
}
if($yetki<3) {
   
    header("Location: anasayfa.php");
}?>
<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    


    <title>Yeni Kullanıcı</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.v3.3.7.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/fontawesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php 
require_once'inc-functions.php';

if(@$_POST["submit"]){


$k_adi = htmlspecialchars($_POST["k_adi"],ENT_QUOTES, 'UTF-8');
$k_sifre = htmlspecialchars($_POST["k_sifre"],ENT_QUOTES, 'UTF-8');
$yetki = htmlspecialchars($_POST["yetki"],ENT_QUOTES, 'UTF-8');
$aktif = htmlspecialchars($_POST["aktif"],ENT_QUOTES, 'UTF-8');


$ek = $db -> prepare ("INSERT INTO users (username,password,yetki,aktif_mi) VALUES (:k_adi,:k_sifre,:yetki,:aktif)");
$ek->bindValue(":k_adi",$k_adi,PDO::PARAM_STR);
$ek->bindValue(":k_sifre",$k_sifre,PDO::PARAM_STR);
$ek->bindValue(":yetki",$yetki,PDO::PARAM_INT);
$ek->bindValue(":aktif",$aktif,PDO::PARAM_INT);


if($ek->execute()){

    header("Location: kllnclar.php?i=ekle");
} else{
    header("Location: kllnclar.php?i=hata");
}


}


?>



    <div id="wrapper">

        <?php
            require_once('inc_menu.php')
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Yeni Kullanıcı Ekle</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="basvurular.php">< Geri Dön</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action ="" method='POST'enctype="multipart/form-data">
                                        
                                        <div class="form-group">
                                            <label>Kullanıcı Adı</label>
                                            <input class="form-control" name="k_adi" placeholder="Kullanıcı Adı">
                                        </div>

                                        <div class="form-group">
                                            <label>Şifre</label>
                                            <input class="form-control" name="k_sifre"  placeholder="********">
                                        </div>
                                        <div class="form-group">
                                            <label>Yetki</label>
                                            <textarea class="form-control" name="yetki" placeholder="" id="mytextarea" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Durum</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" value="1" checked>Aktif
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" value="0">Pasif
                                                </label>
                                            </div>
                                            
                                        </div>
                                       
                                      
                                      <input type="submit" name="submit" value="Kaydet" class="btn btn-default">
                                      
                                        <button type="reset" class="btn btn-default">Temizle</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery-3.4.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.v3.3.7.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.min.js"></script>
 <!--<script>
          tinymce.init({
            selector: '#mytextarea'
          });
  </script>-->

</body>

</html>
