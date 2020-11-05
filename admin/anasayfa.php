<?php
require_once 'inc-functions.php';
session_start();

if(@$_SESSION ["girisKontrol"]!=1) {
   
    header("Location: index.php?i=hack");
}
    
    $satir = $db->prepare("SELECT * from general");
    $satir->execute();
    $satr_sayi = $satir->rowCount();
    $yazr = $db->prepare("SELECT distinct firmayetkilisi from general");
    $yazr->execute();
    $yazr_sayi = $yazr->rowCount();
    $yrm = $db->prepare("SELECT * from yorumlar");
    $yrm->execute();
    $yrm_sayi = $yrm->rowCount();
    $msj = $db->prepare("SELECT * from iletisim");
    $msj->execute();
    $msj_sayi = $msj->rowCount(); 
    $klln = $db->prepare("SELECT * from users");
    $klln->execute();
    $kllnc_sayi = $klln->rowCount();  
    @$kllnc=$_SESSION["username"];                   
    @$yetki=$_SESSION["yetki"];                   
?>
<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yönetim Paneli</title>


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

    
    <div id="wrapper">

        
        <!-- Navigation -->
        <?php
         require_once 'inc_menu.php';
        ?>
        

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Hoşgeldin <?php echo "$kllnc"; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
            <?php if($yetki>1)  
                        { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                <i class="fab fa-wpforms fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $satr_sayi ?></div>
                                    <div>Başvuru Sayısı</div>
                                </div>
                            </div>
                        </div>
                        <a href="basvurular.php">
                            <div class="panel-footer">
                                <span class="pull-left">Detaylar</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php }
                        if($yetki>2)
                        { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info ">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $kllnc_sayi ?></div>
                                    <div>Kullanıcılar</div>
                                </div>
                            </div>
                        </div>                    
                        <a href="kllnclar.php">
                            <div class="panel-footer">
                                <span class="pull-left">Detaylar</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    <?php  } ?>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="../js/jquery-3.4.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
