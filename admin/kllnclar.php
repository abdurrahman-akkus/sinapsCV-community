<?php require_once 'inc-functions.php'; 

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

    <title>Yorumlar</title>

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
        if(@$_GET["is"]=="aktif")
        {
            if($_GET["drm"]==1)
            {
                $durum=0;
            }
            else
            {
                $durum=1;
            }
            $aktif=$db->prepare("UPDATE users SET aktif_mi = :a WHERE id=:i");
            $aktif->bindValue(":a", $durum, PDO::PARAM_INT);
            $aktif->bindValue(":i", $id, PDO::PARAM_INT );
            if($aktif->execute())
            {
                header("Location: kllnclar.php?i=ekle");
            }
            else
            {
                header("Location: kllnclar.php?i=hata");
            }
        }
        if(@$_GET["is"] == "sil")
        {
            
            $silme=$db -> prepare("DELETE FROM users WHERE id = :i");
            $silme->bindValue(":i", $id, PDO::PARAM_INT );
            if($silme->execute())
            {
                header("Location: kllnclar.php?i=ekle");
            }
            else
            {
                header("Location: kllnclar.php?i=hata");
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
                    <h1 class="page-header">Kullancılar</h1>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="kllnc_ekle.php" class="btn btn-primary" style="margin-right: 15px; ">Yeni Kullanıcı +</a>
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
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kullanıcı Adı</th>
                                        <th>Şifre</th>
                                        <th>Yetki</th>
                                        <th>Aktiflik</th>
                                        <th>Araçlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $cek = $db->prepare("SELECT * FROM users ORDER BY id DESC");
                                        $cek->execute();
                                        while ($row=$cek->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                            <tr class="odd gradeX">
                                            <td><?= $row["id"] ?></td>
                                            <td><?= $row["username"] ?></td>
                                            <td><?= $row["password"] ?></td>
                                            <td class="center"><?= $row["yetki"] ?></td>                                <td class="center">
                                                <?php if($row["aktif_mi"]==1) 
                                                { ?>
                                                    <a href="kllnclar.php?is=aktif&id=<?= $row["id"] ?>&drm=<?= $row["aktif_mi"]?>" onclick="return confirm('Aktiflik Durumu Değişsin mi?')" class="btn btn-success btn-xs" style="margin-right: 15px; ">Aktif</a>
                                                <?php
                                                }
                                                else
                                                { ?>
                                                    <a href="kllnclar.php?is=aktif&id=<?= $row["id"] ?>&drm=<?= $row["aktif_mi"]?>" onclick="return confirm('Aktiflik Durumu Değişsin mi?')" class="btn btn-danger btn-xs" style="margin-right: 15px; ">Pasif</a>
                                            <?php    } ?>
                                            </td>
                                            <td class="center">
                                                <a href="kllnc_duzenle.php?id=<?= $row["id"]?>" class="btn btn-warning btn-xs" style="margin-right: 15px; ">Düzenle</a>
                                                <a href="kllnclar.php?is=sil&id=<?= $row["id"] ?>" onclick="return confirm('Silmek İstediğinizden Emin Misiniz?')" class="btn btn-danger btn-xs" style="margin-right: 15px; ">Sil</a></td>
                                        </tr>                                          
                                    <?php }
                                    ?>
                                                                  
                                </tbody>
                            </table>
                            
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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
