<?php
include_once 'inc/conn.php';
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-min.css">
    <title>Moda Sare</title>
</head>

<body>
    <!--  Login Form  -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Moda Sare</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">YÖNETİM PANELİ</h3>
                        <?php
                        if ($_POST) {
                            $userName = $_POST['user'];
                            $passWord = $_POST['pass']; // md5($_POST['pass']); MD5 şfireleme için

                            if ($userName != "" and $passWord != "") {

                                $KullaniciKontrol = $db->prepare("SELECT * FROM admin WHERE adminUser=? and adminPass=?");

                                $KullaniciKontrol->execute([$userName, $passWord]);
                                $KullaniciKontrolSayisi = $KullaniciKontrol->rowCount(); // gelen kayıtları sayısını aldık
                                if ($KullaniciKontrolSayisi > 0) {
                                    session_start();
                                    $_SESSION['isLogin'] = true;

                                    echo ('<div class="alert alert-success">Giriş başarılı, yönlendiriliyorsunuz...</div>');

                                    header("refresh:1,url=/Gate.php");
                                } else {
                                    echo ('<div class="alert alert-danger">Bu bilgilere ait kullanıcı bulunamadı</div>');
                                }
                            }
                        } else {
                            //echo ('<div class="alert alert-danger">Lütfen bilgilerinizi giriniz</div>');
                        }

                        ?>

                        <!-- FORM START -->
                        <form method="post" class="login-form">
                            <div class="form-group">
                                <input type="text" name="user" class="form-control rounded-left" placeholder="Kullanıcı Adı">
                            </div>
                            <div class="form-group">
                                <input type="password" name="pass" class="form-control rounded-left" placeholder="Parola">
                            </div>
                            <!-- 
                                <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Beni Hatırla
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#">Şifremi Unuttum</a>
                                </div>
                            </div>
                         -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Giriş</button>
                            </div>
                        </form>
                        <!-- FORM END -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>