<?php include_once "header.php"; ?>


<?php
$kulyetki=$yonetim->kulyetkial($baglanti);

    if (isset($_POST['genelayarkaydet'])) {
        if (!$kulyetki==2){
            ?>
            <script type="text/javascript">
                swal("İşlem Yetkiniz Kısıtlı!");


            </script>
            <?php
        }else{
            $isim = $_POST["isim"];
            $alan = $_POST["alan"];
            $hakkimda = $_POST["hakkimda"];
            $telefon = $_POST["telefon"];
            $telefonlink = $_POST["telefonlink"];
            $whatsapp = $_POST["whatsapp"];
            $whatsapplink = $_POST["whatsapplink"];
            $adres = $_POST["adres"];


            $mail = $_POST["mail"];
            $maillink = $_POST["maillink"];
            $google_analytic = $_POST["google_analytic"];
            $google_dogrulama = $_POST["google_dogrulama"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $keywords = $_POST["keywords"];
            $copyright = $_POST["copyright"];
            $websitelink=$_POST["websitelink"];



            $guncelle=$baglanti->prepare("Update ayar set isim=?,alan=?,hakkimda=?,telefon=?,telefonlink=?,whatsapp=?,whatsapplink=?,adres=?,mail=?,maillink=?,google_analytic=?,google_dogrulama=?,title=?,description=?,keywords=?,copyright=?,websitelink=?");
            $guncelle->bindParam(1,$isim,PDO::PARAM_STR);
            $guncelle->bindParam(2,$alan,PDO::PARAM_STR);
            $guncelle->bindParam(3,$hakkimda,PDO::PARAM_STR);
            $guncelle->bindParam(4,$telefon,PDO::PARAM_STR);
            $guncelle->bindParam(5,$telefonlink,PDO::PARAM_STR);
            $guncelle->bindParam(6,$whatsapp,PDO::PARAM_STR);
            $guncelle->bindParam(7,$whatsapplink,PDO::PARAM_STR);
            $guncelle->bindParam(8,$adres,PDO::PARAM_STR);
            $guncelle->bindParam(9,$mail,PDO::PARAM_STR);
            $guncelle->bindParam(10,$maillink,PDO::PARAM_STR);

            $guncelle->bindParam(11,$google_analytic,PDO::PARAM_STR);
            $guncelle->bindParam(12,$google_dogrulama,PDO::PARAM_STR);

            $guncelle->bindParam(13,$title,PDO::PARAM_STR);
            $guncelle->bindParam(14,$description,PDO::PARAM_STR);
            $guncelle->bindParam(15,$keywords,PDO::PARAM_STR);
            $guncelle->bindParam(16,$copyright,PDO::PARAM_STR);
            $guncelle->bindParam(17,$websitelink,PDO::PARAM_STR);



            $guncelle->execute();


            if ($guncelle) {

                ?>
                <script type="text/javascript">
                    swal("Kayıt Başarılı!", "Yönleniyor", "success");

                </script>
                <?php


            }
            else {

                ?>
                <script type="text/javascript">
                    swal("Hata var işlem başarısız hata devam ederse yazılımcıya bilgi iletiniz...");


                </script>
                <?php


            }
        }



    }





$ayaral=$baglanti->prepare("select * from ayar");
$ayaral->execute();
$ayarson=$ayaral->fetch();


?>

<div class="col-12 col-md-8 col-lg-9">
    <div class="card">
        <form method="post">
            <div class="card-header">
                <h4>Genel Ayarlar</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>İsim</label>
                    <input name="isim" type="text" class="form-control" required="" value="<?php echo $ayarson["isim"]; ?>">
                </div>
                <div class="form-group">
                    <label>Alan</label>
                    <input name="alan" type="text" class="form-control" required="" value="<?php echo $ayarson["alan"]; ?>">
                </div>

                <div class="form-group">
                    <label>Websitelink(https://siteadiniz.com şeklinde ekleyiniz)</label>
                    <input name="websitelink" type="text" class="form-control" required="" value="<?php echo $ayarson["websitelink"]; ?>">
                </div>



                <div class="form-group">
                    <label>Telefon</label>
                    <input name="telefon" type="text" class="form-control" required="" value="<?php echo $ayarson["telefon"]; ?>">
                </div>

                <div class="form-group">
                    <label>Telefon Link</label>
                    <input name="telefonlink" type="text" class="form-control" required="" value="<?php echo $ayarson["telefonlink"]; ?>">
                </div>

                <div class="form-group">
                    <label>Whatsapp</label>
                    <input name="whatsapp" type="text" class="form-control" required="" value="<?php echo $ayarson["whatsapp"]; ?>">
                </div>

                <div class="form-group">
                    <label>WhatsApp Link</label>
                    <input name="whatsapplink" type="text" class="form-control" required="" value="<?php echo $ayarson["whatsapplink"]; ?>">
                </div>



                <div class="form-group">
                    <label>Whatsapp İconunda Görüntülenen yazı</label>
                    <input name="whatsappmetin" type="text" class="form-control" required="" value="<?php echo $ayarson["whatsappmetin"]; ?>">
                </div>


                <div class="form-group">
                    <label>Adres</label>
                    <input name="adres" type="text" class="form-control" required="" value="<?php echo $ayarson["adres"]; ?>">
                </div>

                <div class="form-group">
                    <label>Mail</label>
                    <input name="mail" type="text" class="form-control" required="" value="<?php echo $ayarson["mail"]; ?>">
                </div>



                <div class="form-group">
                    <label>Maillink</label>
                    <input name="maillink" type="text" class="form-control" required="" value="<?php echo $ayarson["maillink"]; ?>">
                </div>



                <div class="form-group mb-0">
                    <label>Hakkımda</label>
                    <textarea name="hakkimda" class="summernote"><?php echo $ayarson["hakkimda"]; ?></textarea>
                </div>


                <div class="form-group">
                    <label>Copyright</label>
                    <input name="copyright" type="text" class="form-control" required="" value="<?php echo $ayarson["copyright"]; ?>">
                </div>




                <div class="form-group mb-0">
                    <label>Google Doğrulama</label>
                    <textarea name="google_dogrulama" class="form-control"><?php echo $ayarson["google_dogrulama"]; ?></textarea>
                </div>

                <div class="form-group mb-0">
                    <label>Google Analytic</label>
                    <textarea name="google_analytic" class="form-control"><?php echo $ayarson["google_analytic"]; ?></textarea>
                </div>



                <div class="form-group">
                    <label>Title</label>
                    <input name="title" type="text" class="form-control" required="" value="<?php echo $ayarson["title"]; ?>">
                </div>

                <div class="form-group mb-0">
                    <label>description</label>
                    <textarea name="description" class="form-control"><?php echo $ayarson["description"]; ?></textarea>
                </div>


                <div class="form-group mb-0">
                    <label>Keywords</label>
                    <textarea name="keywords" class="form-control"><?php echo $ayarson["keywords"]; ?></textarea>
                </div>


            </div>
            <div class="card-footer text-right">
                <button type="submit" name="genelayarkaydet" class="btn btn-primary">Güncelle</button>
            </div>
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>
