<?php
include_once("fonksiyon/giris.php");
$yonetim = new yonetim;
$yonetim->konrolet("ind");

?>
<!DOCTYPE html>
<html lang="tr">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Şifre Değiştirme </title>
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
                            <h4>Şifremi Değiştirme</h4>
                        </div>
                        <div class="card-body">

                            <?php $kod=trim($_GET['kod']);

if (!$kod){
    echo "sıfırlama kodu hatalı girildi";
}
else{
    ?>
    <form method="POST" class="needs-validation" novalidate="">
        <div class="form-group">
            <label for="email">Mail Adresiniz</label>
            <input id="email" type="text" class="form-control" name="mail" tabindex="1" autofocus>
        </div>

        <div class="form-group">
            <label for="sifre">Şifre</label>
            <input id="sifre" type="password" class="form-control" name="sifre" tabindex="1" autofocus>
        </div>

        <div class="form-group">
            <label for="sifre2">Şifre Tekrar</label>
            <input id="sifre2" type="password" class="form-control" name="sifre2" tabindex="1" autofocus>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Gönder
            </button>
        </div>
        <div id="mesajsonuc"></div>

    </form>

    <?php


    if ($_POST){
        $mail=trim($_POST['mail']);
        $sifre=trim($_POST['sifre']);
        $sifre2=trim($_POST['sifre2']);

        if ($mail==""){
            echo "<p class='text-danger'>Boş Alan Bırakmayınız</p>";
        }
        else{

            if ($sifre != $sifre2){
                echo "<p class='text-danger'>şifreleriniz uyuşmuyor</p>";
            }
            else{
                $yeni=md5(sha1(md5($sifre)));

                $varmi=$baglanti->prepare("select * from  kullanicilar where sifre_sifirlama=:k and mail=:e ");
                $varmi->execute([':k' => $kod,':e'=>$mail]);
                if ($varmi->rowCount()){

                    $sifreguncelle=$baglanti->prepare("update kullanicilar set sifre_sifirlama=:sifirla,  sifre=:s where sifre_sifirlama=:k and mail=:e");
                    $sifreguncelle->execute([':sifirla'=>"",':s'=>$yeni,':k'=>$kod,':e'=>$mail]);
                    if ($sifreguncelle){
                        echo "<h3 class='text-success'>şifreniz başarıyla güncellenmiştir</h3>";

                        header("Refresh:1; url=index.php");

                    }
                    else{
                        echo "<p class='text-danger'>veritabanında bir hata oldu şifre güncellenmedi</p>";
                    }
                    header("Refresh:1; url=index.php");


                }
                else{
                    echo "<p class='text-danger'>girilen bilgilere göre bir kayıt bulunamadı</p>";
                }
                header("Refresh:1; url=index.php");


            }



        }

    }

    ?>


    <?php

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

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<script>

    $(document).ready (function (e){
        $("#gonderbtn").click(function(){
            $.ajax({
                type:"POST",
                url:'fonksiyon/mail/gonder.php',
                data:$('#mailform').serialize(),
                success: function(donen){
                    $('#mailform').trigger("reset");
//$('#formtutucu').fadeOut(500);
                    $('#mesajsonuc').show(500).html(donen);
                },
            });});
    });
</script>

</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>

