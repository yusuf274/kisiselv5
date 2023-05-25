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
    $baslikrenk = $_POST["baslikrenk"];
    $isimrenk = $_POST["isimrenk"];
    $alticerikrenk= $_POST["alticerikrenk"];
    $iconrenk = $_POST["iconrenk"];
    $iletisimbilgirenk = $_POST["iletisimbilgirenk"];
    $altmenurenk= $_POST["altmenurenk"];
    $activerenk= $_POST["activerenk"];




    $ayarkaydet = $baglanti->prepare("update tasarimayar set 
baslikrenk='$baslikrenk',
isimrenk='$isimrenk',
alticerikrenk='$alticerikrenk',                  
iconrenk='$iconrenk',
iletisimbilgirenk='$iletisimbilgirenk',
altmenurenk='$altmenurenk',
activerenk='$activerenk'");
    $ayarkaydet->execute();

    if ($ayarkaydet) {

        ?>
        <script type="text/javascript">
            swal("Kayıt Başarılı!", "Yönleniyor", "success");

        </script>
        <?php


    }
    else {

        ?>
        <script type="text/javascript">
            swal("hata  var işlem başarısız!");


        </script>
        <?php

    }

}


}


$ayaral=$baglanti->prepare("select * from tasarimayar");
$ayaral->execute();
$ayarson=$ayaral->fetch();


?>

<div class="col-12 col-md-6 col-lg-6">
    <div class="card">
        <form method="post">
            <div class="card-header">
                <h4>Tasarım Ayarları</h4>
            </div>
            <div class="card-body">


                <div class="form-group">
                    <label>Başlık renkler</label>
                    <input name="baslikrenk" type="color" class="form-control" required="" value="<?php echo $ayarson["baslikrenk"]; ?>">
                </div>

                <div class="form-group">
                    <label>İsim renk</label>
                    <input name="isimrenk" type="color" class="form-control" required="" value="<?php echo $ayarson["isimrenk"]; ?>">
                </div>
                <div class="form-group">

                    <label>Kişi Alan renk</label>
                    <input name="alticerikrenk" type="color" class="form-control" required="" value="<?php echo $ayarson["alticerikrenk"]; ?>">
                </div>


                <div class="form-group">
                    <label>İcon renk</label>
                    <input name="iconrenk" type="color" class="form-control" required="" value="<?php echo $ayarson["iconrenk"]; ?>">
                </div>

                <div class="form-group">
                    <label>İletisim bilgi renk</label>
                    <input name="iletisimbilgirenk" type="color" class="form-control" required="" value="<?php echo $ayarson["iletisimbilgirenk"]; ?>">
                </div>

                <div class="form-group">
                    <label>Altmenu renk</label>
                    <input name="altmenurenk" type="color" class="form-control" required="" value="<?php echo $ayarson["altmenurenk"]; ?>">
                </div>

                <div class="form-group">
                    <label>Active renk</label>
                    <input name="activerenk" type="color" class="form-control" required="" value="<?php echo $ayarson["activerenk"]; ?>">
                </div>





            </div>
            <div class="card-footer text-right">
                <button type="submit" name="genelayarkaydet" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>

