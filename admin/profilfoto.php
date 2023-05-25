<?php require_once "header.php"; ?>

<?php

$rastgeledeger=rand(1,9000);
$rastgeledeger2=rand(1,9000);
$kulyetki=$yonetim->kulyetkial($baglanti);


if (isset($_POST['ayarkaydet'])) {

    if (!$kulyetki==2) {
        ?>
        <script type="text/javascript">
            swal("İşlem Yetkiniz Kısıtlı!");


        </script>
        <?php
    }else{

        if($_FILES["resimyol"]["name"]==""){
            ?>
            <script type="text/javascript">
                swal("Dosya Boş Olamaz");


            </script>
            <?php

        }
        else{
            if($_FILES["resimyol"]["size"]>(1024*1024*5)){
                ?>
                <script type="text/javascript">
                    swal("Dosya boyutu 5 mb den büyük olamaz");


                </script>
                <?php


            }
            else{
                $izinverilen=array("image/png", "image/jpeg");
                if(!in_array($_FILES["resimyol"]["type"],$izinverilen)){
                    ?>
                    <script type="text/javascript">
                        swal("izin veriren uzantı değil");


                    </script>
                    <?php

                }
                else{
                    $dosyayaeris = $baglanti->prepare("select * from ayar");
                    $dosyayaeris->execute();
                    $dosyayaerisal = $dosyayaeris->fetch();
                    $resimyolu=$dosyayaerisal["resimyol"];

                    unlink("../$resimyolu");

                    $yenidosyayol='../images/'.$rastgeledeger.$_FILES["resimyol"]["name"];

                    $veritabaniicin='images/'.$rastgeledeger.$_FILES["resimyol"]["name"];

                    move_uploaded_file($_FILES["resimyol"]["tmp_name"],$yenidosyayol);



                    $resimiguncelle=$baglanti->prepare("update ayar set resimyol='$veritabaniicin'");
                    $resimiguncelle->execute();

                    ?>
                    <script type="text/javascript">
                        swal("Kayıt Başarılı!", "Yönleniyor", "success");

                    </script>
                    <?php



                }

            }

        }
    }






}





$ayarcek = $baglanti->prepare('SELECT * from ayar');
$ayarcek->execute();
$ayarlar = $ayarcek->fetch();




?>


    <!-- page content -->
    <div class="col-md-12">
        <div class="card">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="card-header">
                            <h2>Profil Resim Ayarlar</h2>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="card-body">

                            <p class="text-danger">*Lütfen 400px genişlik 400px yüksekliğinde foto yükleyiniz.kare formatına yakın </p>
                            <br>


                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Profil Resimi <span class="required">*</span>
                                    </label>


                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <img style="width: 200px;height: 200px" class=""  src="../<?php echo $ayarlar["resimyol"]; ?>">
                                        <br><br>

                                        <input name="resimyol" class="form-control" type="file">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">

                                        <button name="ayarkaydet" type="submit" class="btn btn-success">Güncelle</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- /page content -->




    <!-- footer content -->
<?php



require_once "footer.php"; ?>