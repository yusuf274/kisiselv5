<?php include_once "header.php"; ?>
<?php
$yondetayidsi=$_GET["id"];
$yetkiduzey=$yonetim->kulyetkial($baglanti);

if (isset($_POST['ayarkaydet'])) :

    if (!$yetkiduzey==2){
        ?>
        <script type="text/javascript">
            swal("İşlem Yetkiniz Kısıtlı! Yönlendiriliyorsunuz...");


        </script>
        <?php
        header("refresh:2,url=yonlistele.php");

    }else{
        @$isim=htmlspecialchars($_POST["isim"]);

        @$kulad=htmlspecialchars($_POST["kulad"]);
        @$mail=htmlspecialchars($_POST["mail"]);
        @$yetki=htmlspecialchars($_POST["yetkiderece"]);
        //eski şifreyi şifrele ve vt ile karsılastır.
        //yeni sifreler aynımı kontrol et
        //
        if($kulad=="" ||  $mail=="" || $yetki==""):
            echo '<div class="alert alert-danger mt-5">Hiçbir alan boş geçilemez.</div>';
            header("Refresh:1; url=yonlistele.php");

        else:
            $ekle=$baglanti->prepare("Update admins set kullaniciadi=?,mail=?,isim=?,yetki=? WHERE id=$yondetayidsi");
            $ekle->bindParam(1,$kulad,PDO::PARAM_STR);
            $ekle->bindParam(2,$mail,PDO::PARAM_STR);
            $ekle->bindParam(3,$isim,PDO::PARAM_STR);
            $ekle->bindParam(4,$yetki,PDO::PARAM_STR);
            $ekle->execute();

            ?>
            <script type="text/javascript">
                swal("Kayıt Başarılı!", "Yönleniyor", "success");

            </script>

            <?php

            header("Refresh:1; url=yonlistele.php");




        endif;
    }



endif;
$yondetayal=$baglanti->prepare("select * from admins where id=$yondetayidsi");
$yondetayal->execute();
$sonucal=$yondetayal->fetch(PDO::FETCH_ASSOC);
?>

<div class="col-12 col-md-8 col-lg-9">


    <div class="card">

        <div class="col-md-12 col-sm-3 col-xs-12">

            <div class="col-md-12 col-sm-12 col-xs-6">
                <div>
                    <form method="post">
                        <div class="row text-center">
                            <div class="col-lg-8 mx-auto">
                                <div class="col-lg-12 mx-auto mt-2">
                                    <h3 class="text-info">Yönetici Duzenle

                                    </h3>
                                    <p class="text-danger">Bu ayar'da kullanıcı mail ve kullanıcı adını değiştirmek tavsiye edilmez! </p>
                                </div>

                                <div class="col-lg-12 mx-auto border">
                                    <div class="row">
                                        <div class="col-lg-5 border-right pt-3 text-left">
                                            <span id="siteayarfont">Adınız Soyadınız</span>
                                        </div>
                                        <div class="col-lg-7 p-1">
                                            <input type="text" name="isim" class="form-control" value="<?php echo $sonucal["isim"]?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mx-auto border">
                                    <div class="row">
                                        <div class="col-lg-5 border-right pt-3 text-left">
                                            <span id="siteayarfont">Kullanıcı Adı</span>
                                        </div>
                                        <div class="col-lg-7 p-1">
                                            <input type="text" name="kulad" class="form-control" value="<?php echo $sonucal["kullaniciadi"]?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mx-auto border">
                                    <div class="row">
                                        <div class="col-lg-5 border-right pt-3 text-left">
                                            <span id="siteayarfont">Mail Adres</span>
                                        </div>
                                        <div class="col-lg-7 p-1">
                                            <input type="text" name="mail" value="<?php echo $sonucal["mail"]?>" class="form-control" value="" />
                                        </div>
                                    </div>
                                </div>
                                <!--ara-->



                                <div class="col-lg-12 mx-auto border">
                                    <div class="row">
                                        <div class="col-lg-5 border-right pt-3 text-left">
                                            <span id="siteayarfont">Yönetici Seviyesini Seçiniz</span>
                                        </div>
                                        <div class="col-lg-7 pt-2">
                                            <?php
                                            if ($sonucal["yetki"]==2){
                                                ?>
                                                <input type="radio" checked id="javascript" name="yetkiderece" value="2">
                                                <label for="javascript">Adminastör</label>

                                                <?php
                                            }else if($sonucal["yetki"]==1){
                                                ?>
                                                <input type="radio" id="javascript" name="yetkiderece" value="2">
                                                <label for="javascript">Adminastör</label>
                                                <input class="" type="radio" id="html" name="yetkiderece" value="0">
                                                <label for="html">Yetkisiz</label>
                                                <input type="radio" checked id="css" name="yetkiderece" value="1">
                                                <label for="css">Admin</label>
                                                <?php
                                            }else{
                                                ?>
                                                <input type="radio" id="javascript" name="yetkiderece" value="2">
                                                <label for="javascript">Adminastör</label>
                                                <input class="" checked type="radio" id="html" name="yetkiderece" value="0">
                                                <label for="html">Yetkisiz</label>
                                                <input type="radio" id="css" name="yetkiderece" value="1">
                                                <label for="css">Admin</label>
                                                <?php
                                            }
                                            ?>



                                        </div>


                                    </div>
                                </div>


                                <div class="col-lg-12 mx-auto mt-2">
                                    <br>
                                    <input type="submit" name="ayarkaydet" class="btn btn-info m-1" value="Güncelle" />
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>












</div>


<?php include_once "footer.php"; ?>

