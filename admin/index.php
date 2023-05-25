<?php
include_once("fonksiyon/giris.php");
$yonetim = new yonetim;
$yonetim->konrolet("ind");

?>
<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Giriş Yap</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
<div class="loader"></div>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Giriş Yap</h4>
                        </div>
                        <div class="card-body">

                            <?php
                            if(!$_POST){
                                ?>
                                <form method="POST" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Mail Adresiniz</label>
                                        <input id="email" type="text" class="form-control" name="mail" tabindex="1" autofocus required value="admin">
                                        <div class="invalid-feedback">
                                            Mail Adresiniz
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Şifre</label>
                                            <div class="float-right">
                                                <a href="resetsifre.php" class="text-small">
                                                    Şifrenizi mi Unuttunuz?
                                                </a>
                                            </div>
                                        </div>
                                        <input value="123" id="password" type="password" class="form-control" name="sifre" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Şifre Boş Bırakılmaz
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Giriş Yap
                                        </button>
                                    </div>
                                </form>

                                <?php
                            }else{
                                $mail=htmlspecialchars($_POST["mail"]);
                                $sifre=htmlspecialchars($_POST["sifre"]);
                                if($mail=="" && $sifre==""):
                                    echo '
            <div class="container">
            <div class="alert alert-white border border-dark mt-5 col-md-5 mx-auto p-3 text-dark font-14 font-weight-bold">
            Bilgiler boş olamaz</div>
            </div>';
                                    header("refresh:2,url=index.php");
                                else:
                                    //vt kontrol fonksiyonu

                                    $yonetim->giriskontrol($mail,$sifre,$baglanti);
                                endif;

                            }

                            ?>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>
