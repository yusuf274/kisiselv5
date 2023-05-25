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
    <title>Şifre Sıfırlama</title>
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
                            <h4>Şifremi Unuttum</h4>
                        </div>
                        <div class="card-body">


                                <form id="mailform" method="POST" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Mail Adresiniz</label>
                                        <input id="email" type="text" class="form-control" name="mail" tabindex="1" autofocus>
                                        <div class="invalid-feedback">
                                            Kulanıcı Adı Giriniz
                                        </div>
                                    </div>
                                    <div id="mesajsonuc"></div>


                                    <div class="form-group">
                                        <input id="gonderbtn" type="button" class="btn btn-primary btn-lg btn-block" tabindex="4" value="Gönder">

                                    </div>
                                    <div id="mesajsonuc"></div>
                                </form>




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
            $("#gonderbtn").val("gönderiliyor...");

            $.ajax({
                type:"POST",
                url:'fonksiyon/mail/gonder.php',
                data:$('#mailform').serialize(),
                success: function(donen){
                    $('#mailform').trigger("reset");
//$('#formtutucu').fadeOut(500);
                    $('#mesajsonuc').show(500).html(donen);
                    $("#gonderbtn").val("Gönder");

                },
            });});
    });
</script>

</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>

