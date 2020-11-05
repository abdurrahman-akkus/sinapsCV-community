<?php 

session_start(); 
if(@$_SESSION ["girisKontrol"]==1) {
   
    header("Location: anasayfa.php");
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BEYBO İnsan Kaynakları</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.v3.3.7.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/fontawesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lütfen Giriş Yapın</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Kullanıcı Adı" name="username" type="text" autofocus required="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Şifre" name="password" type="password" value="" required="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Beni Hatırla
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Giriş" class="btn btn-lg btn-success btn-block">
                            
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        header("Location: anasayfa.php?usr=$vt_kadi&ytk=$ytk");
        return true;
        }
        else{
        echo " <p style = 'text-align : center; color: red';> Kullanıcı adı veya parola yanlış girildi </p>" ;
        return false;
        }
    }   
    else{
        echo " <p style = 'text-align : center; color: red';> Kullanıcı adı veya parola yanlış girildi </p>" ;
        return false;
        }
}

if(@$_GET["i"] == "cikis") 
{

    echo " <p style = 'text-align : center; color: green';> Başarı ile Çıkış Yaptınız </p>" ;
}
elseif (@$_GET["i"] == "hack") {
    # code...
    echo " <p style = 'text-align : center; color:red';> Öncelikle giriş yapmalısınız. </p>" ;
}


     ?>

    <!-- jQuery -->
    <script src="../js/jquery-3.4.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.v3.3.7.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
