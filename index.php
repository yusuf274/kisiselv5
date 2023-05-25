<?php
include_once ("admin/fonksiyon/baglan.php");


$ayaral=$baglanti->prepare("select * from ayar");
$ayaral->execute();
$ayarsonuc=$ayaral->fetch(PDO::FETCH_ASSOC);


$renkal=$baglanti->prepare("select * from tasarimayar");
$renkal->execute();
$renksonuc=$renkal->fetch(PDO::FETCH_ASSOC);


$linkal=$baglanti->prepare("select * from sosyalmedya");
$linkal->execute();
$sosyalmedyalarsonuc=$linkal->fetch(PDO::FETCH_ASSOC);



?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo $ayarsonuc["faviconyol"]; ?>" type="image/x-icon" />

    <title><?php echo $ayarsonuc["title"]; ?></title>
    <meta name="description" content="<?php echo $ayarsonuc["description"]; ?>">
    <meta name="keywords" content="<?php echo $ayarsonuc["keywords"]; ?>">
    <meta name="author" content="<?php echo $ayarsonuc["isim"]; ?>">

    <?php

    echo $ayarsonuc["google_dogrulama"];
    echo $ayarsonuc["google_analytic"];
    ?>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/icon.css">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .iletisimbody i{
            color: <?php echo $renksonuc["iconrenk"]; ?>;
        }
        .nav-link{
            color: <?php echo $renksonuc["altmenurenk"]; ?>;
        }


        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: <?php echo $renksonuc["activerenk"]; ?>;
        }
         a{
            letter-spacing: 1px;
            color: <?php echo $renksonuc["iletisimbilgirenk"]; ?>;
            text-decoration: none;

        }
    </style>

</head>
<body>

<div class="container pt-5">
    <div class="row">
        <div class="col-lg-6 col-md-10 mx-auto">
            <div class="card animate__animated animate__zoomIn">

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active animate__animated animate__zoomIn" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <div class="card-header text-center">
                            <h1 class="text-center kisiselresim pt-2">
                                <img style="width: 35%" class="card-img" src="<?php echo $ayarsonuc["resimyol"]; ?>" alt="avatar">
                            </h1>

                            <h1 style="color: <?php echo $renksonuc["isimrenk"]; ?>" class="text-center mt-3"><?php echo $ayarsonuc["isim"]; ?></h1>
                            <h4 style="color: <?php echo $renksonuc["alticerikrenk"]; ?>" class="text-center mt-2"><?php echo $ayarsonuc["alan"]; ?></h4>
                            <hr class="altcizgi">
                        </div>

                        <div class="card-body">

                            <div class="container mt-3 mb-5">
                                <div class="row">
                                    <div class="col-md-10 col-sm-10 col-11 mx-auto">

                                        <?php
                                        if (!$sosyalmedyalarsonuc["instagram"]==""){
                                            ?>
                                            <div class="button">
                                                <a target="_blank" href="<?php echo $sosyalmedyalarsonuc["instagram"]; ?>">
                                                    <div class="icon">
                                                        <i class="fab fa-instagram"></i>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }

                                        if (!$sosyalmedyalarsonuc["facebook"]==""){
                                            ?>
                                            <div class="button">
                                                <a target="_blank" href="<?php echo $sosyalmedyalarsonuc["facebook"]; ?>">
                                                    <div class="icon">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }

                                        if (!$sosyalmedyalarsonuc["twitter"]==""){
                                            ?>
                                            <div class="button">
                                                <a target="_blank" href="<?php echo $sosyalmedyalarsonuc["twitter"]; ?>">
                                                    <div class="icon">
                                                        <i class="fab fa-twitter"></i>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }



                                        if (!$sosyalmedyalarsonuc["linkedin"]==""){
                                            ?>
                                            <div class="button">
                                                <a target="_blank" href="<?php echo $sosyalmedyalarsonuc["linkedin"]; ?>">
                                                    <div class="icon">
                                                        <i class="fab fa-linkedin"></i>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }

                                        if (!$sosyalmedyalarsonuc["youtube"]==""){
                                            ?>
                                            <div class="button">
                                                <a target="_blank" href="<?php echo $sosyalmedyalarsonuc["youtube"]; ?>">
                                                    <div class="icon">
                                                        <i class="fab fa-youtube"></i>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }




                                        ?>



                                    </div>

                                </div>
                            </div>



                        </div>


                    </div>
                    <!---Hakkımda Panel-->
                    <div class="tab-pane fade animate__animated animate__zoomIn" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 mt-3 col-6 kisiselresim">
                                        <img style="width: 100%" class="card-img" src="<?php echo $ayarsonuc["resimyol"]; ?>" alt="avatar">

                                    </div>
                                    <div class="col-md-9 mt-3 col-6">
                                        <h1 style="color: <?php echo $renksonuc["isimrenk"]; ?>" class=" mt-3"><?php echo $ayarsonuc["isim"]; ?></h1>
                                        <h4 style="color: <?php echo $renksonuc["alticerikrenk"]; ?>" class=" mt-2"><?php echo $ayarsonuc["alan"]; ?></h4>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <h4 style="color: <?php echo $renksonuc["baslikrenk"]; ?>">Hakkımda</h4>
                            <p><?php echo substr($ayarsonuc["hakkimda"],0,500); ?><span id="readLess">. . .</span><span id="readMore"><?php echo substr($ayarsonuc["hakkimda"],500,1000); ?></span>
                            </p>
                            <a style="cursor: pointer;text-decoration: underline" onclick="readMore()" id="morebtn">Daha Fazlası</a>

                        </div>
                    </div>
                    <!--İletişim-->
                    <div class="tab-pane fade animate__animated animate__zoomIn" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 col-6 mt-3 kisiselresim">
                                        <img style="width: 100%" class="card-img" src="<?php echo $ayarsonuc["resimyol"]; ?>" alt="avatar">

                                    </div>
                                    <div class="col-md-9 col-6 mt-3">
                                        <h1 style="color: <?php echo $renksonuc["isimrenk"]; ?>" class=" mt-3"><?php echo $ayarsonuc["isim"]; ?></h1>
                                        <h4 style="color: <?php echo $renksonuc["alticerikrenk"]; ?>" class=" mt-2"><?php echo $ayarsonuc["alan"]; ?></h4>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-body iletisimbody">

                            <div class="container">
                                <h4 style="color: <?php echo $renksonuc["baslikrenk"]; ?>">İletişim Bilgilerim</h4>

                                <div class="row iletisimlinkler mt-2">
                                    <div class="col-md-1 col-1 mt-3">
                                        <i style="font-size: 25px" class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="col-md-11 col-11 mt-3">
                                        <a href=""> <?php echo $ayarsonuc["adres"]; ?></a>
                                    </div>


                                    <div class="col-md-1 col-1 mt-3">
                                        <i style="font-size: 25px" class="fa-solid fa-phone"></i>
                                    </div>
                                    <div class="col-md-11 col-11 mt-3">
                                        <a href="<?php echo $ayarsonuc["telefonlink"]; ?>"> <?php echo $ayarsonuc["telefon"]; ?></a>
                                    </div>


                                    <div class="col-md-1 col-1 mt-3">
                                        <i style="font-size: 25px" class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="col-md-11 col-11 mt-3">
                                        <a href="<?php echo $ayarsonuc["maillink"]; ?>"> <?php echo $ayarsonuc["mail"]; ?></a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="card-footer text-center">
                    <ul class="nav nav-pills linkrenkayar" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a style="cursor: pointer" class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="" role="tab" aria-controls="pills-home" aria-selected="true">Anasayfa</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a style="cursor: pointer" class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="" role="tab" aria-controls="pills-profile" aria-selected="false">Hakkımda</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a style="cursor: pointer" class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="" role="tab" aria-controls="pills-contact" aria-selected="false">İletişim</a>
                        </li>
                    </ul>
                </div>





            </div>
        </div>
    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    function readMore() {
        let readLess = document.getElementById("readLess");
        let readMore = document.getElementById("readMore");
        let moreBtn = document.getElementById("morebtn");
        if (readLess.style.display === "none") {
            readLess.style.display = "inline";
            moreBtn.innerHTML = "Daha Fazlası";
            readMore.style.display = "none";
        } else {
            readLess.style.display = "none";
            moreBtn.innerHTML = "Daha Fazlası Gizle";
            readMore.style.display = "inline";
        }
    }
</script>
</body>
</html>
