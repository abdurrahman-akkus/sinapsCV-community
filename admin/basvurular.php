<?php require_once 'inc-functions.php'; 
session_start();
@$yetki=$_SESSION["yetki"]; 

if(@$_SESSION ["girisKontrol"]!=1) {
   
    header("Location: index.php?i=hack");
}
if($yetki<2) {
   
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

    <title>Başvurular</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.v3.3.7.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/fontawesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS KAYNAK=https://datatables.net/ -->
    <link href="../css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../css/dataTables.responsive.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php 
    @$id=intval(@$_GET["id"]);
        if(@$_GET["is"]=="is_active")
        {
            if($_GET["drm"]==1)
            {
                $durum=0;
            }
            else
            {
                $durum=1;
            }
            $aktif=$db->prepare("UPDATE general SET is_active = :a WHERE id=:i");
            $aktif->bindValue(":a", $durum, PDO::PARAM_INT);
            $aktif->bindValue(":i", $id, PDO::PARAM_INT );
            if($aktif->execute())
            {
                header("Location: basvurular.php?i=ekle");
            }
            else
            {
                header("Location: basvurular.php?i=hata");
            }
        }
        if(@$_GET["is"] == "sil")
        {
            
            $silme=$db -> prepare("DELETE FROM general WHERE id = :i");
            $silme->bindValue(":i", $id, PDO::PARAM_INT );
            if($silme->execute())
            {
                header("Location: basvurular.php?i=ekle");
            }
            else
            {
                header("Location: basvurular.php?i=hata");
            }
        }

    ?>

    <div id="wrapper">

        <?php
            require_once('inc_menu.php');
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Başvurular</h1>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="overflow-y: all;">
                            <button id="senkronize" class="btn btn-primary" style="margin-right: 15px;" onclick="raporuTablola()"><i class="fas fa-sync-alt"></i> <span>Yenile</span></button>
                            <button class="btn btn-primary" style="margin-right: 15px;" onclick="tumunuDaralt()"><i class="far fa-minus-square"></i> Daralt</button>
                            <button class="btn btn-primary" style="margin-right: 15px;" onclick="tumunuGenislet()"><i class="far fa-plus-square"></i> Genişlet</button>
                            <?php
                                if(@$_GET["i"]=="ekle")
                                {
                                    echo "<span class='text-success'>Ekleme İşlemi Tamamlandı</span>";
                                }
                                elseif(@$_GET["i"]=="hata")
                                {
                                    echo "<span class='text-danger'>Ekleme İşleminde Hata Oluştu</span>";
                                }  
                            ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body tablo-container">
                            
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
    <!-- DataTables JavaScript -->
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
    <script src="../js/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/json_gridify.js"></script>
    <script src="../js/basvurular.js"></script>

    <style>
        .tablo-container {
            overflow: auto;
        }
        .custom-input {
  border-left: 3px solid #284768;
  border-right: 3px solid #284768;
  /*border-bottom: 2px solid #284768;*/
  border-radius: 5rem;
  min-width: 10rem;
  width: 10rem;
}

.custom-input:focus ~ .floating-label,
.custom-input:not(:placeholder-shown):not(:focus) ~ .floating-label,
.custom-input:focus ~ .floating-label-lg,
.custom-input:not(:placeholder-shown):not(:focus) ~ .floating-label-lg {
  top: -0.4rem;
  left: calc(1rem + 3px);
  font-size: 0.8rem;
  font-weight: 600;
  opacity: 1;
  height: 1rem;
  line-height: 0.8rem;
  padding-top: 0px;
  padding-right: 5px;
  padding-bottom: 0px;
  padding-left: 5px;
  background-color: #284768;
  border-radius: 10px;
  color: white;
  border: 1px solid #284768;
}

.floating-label,
.floating-label-lg {
  color: #777777;
  background-color: transparent;
  position: absolute;
  pointer-events: none;
  left: 0;
  top: 0;
  transition: 0.2s ease all;
}

.floating-label {
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
}

.floating-label-lg {
  height: calc(1.5em + 1rem + 2px);
  padding: 0.5rem 1rem;
  font-size: 1.25rem;
  line-height: 1.5;
}

.input-container {
  position: relative;
}
.gridify-table td{
    text-align: center;
}

#check_list {
    padding:1rem;
    background:aliceblue;
    color:#337ab7;
}

#check_list h3 {
    text-align:center;
}

#check_list ul {
    list-style:none;
    overflow:scroll;
    max-height:50vh;
}


.dataTables_wrapper .row:first-child {
    position: absolute;
    left: 15px;
    width: 100%;
    padding-left: 10px;
    padding-right: 10px;

}

.dataTables_wrapper .row:nth-child(2) {
    padding-top:15px;
    padding-bottom:30px;
}

.dataTables_wrapper .row:last-child::before {
    width:100%;
    height:1px;
    color:red;
}
.dataTables_wrapper .row:last-child {
    position: absolute;
    left: 15px;
    bottom:37px;
    width: 100%;
    padding-left: 10px;
    padding-right: 10px;
}

    </style>

</body>

</html>
