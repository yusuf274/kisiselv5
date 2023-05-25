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
    $facebook = $_POST["facebook"];
    $instagram = $_POST["instagram"];
    $youtube= $_POST["youtube"];
    $linkedin = $_POST["linkedin"];
    $twitter = $_POST["twitter"];




    $guncelle=$baglanti->prepare("Update sosyalmedya set facebook=?,instagram=?,youtube=?,linkedin=?,twitter=?");
    $guncelle->bindParam(1,$facebook,PDO::PARAM_STR);
    $guncelle->bindParam(2,$instagram,PDO::PARAM_STR);
    $guncelle->bindParam(3,$youtube,PDO::PARAM_STR);
    $guncelle->bindParam(4,$linkedin,PDO::PARAM_STR);
    $guncelle->bindParam(5,$twitter,PDO::PARAM_STR);
    $guncelle->execute();

    if ($guncelle->rowCount()) {

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


$ayaral=$baglanti->prepare("select * from sosyalmedya");
$ayaral->execute();
$ayarson=$ayaral->fetch();


?>

<div class="col-12 col-md-8 col-lg-9">
    <div class="card">
        <form method="post">
            <div class="card-header">
                <h4>Sosyal Medya Ayarlar</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>facebook</label>
                    <input name="facebook" type="text" class="form-control" required="" value="<?php echo $ayarson["facebook"]; ?>">
                </div>

                <div class="form-group">
                    <label>instagram</label>
                    <input name="instagram" type="text" class="form-control"  value="<?php echo $ayarson["instagram"]; ?>">
                </div>

                <div class="form-group">
                    <label>youtube</label>
                    <input name="youtube" type="text" class="form-control" value="<?php echo $ayarson["youtube"]; ?>">
                </div>

                <div class="form-group">
                    <label>linkedin</label>
                    <input name="linkedin" type="text" class="form-control"  value="<?php echo $ayarson["linkedin"]; ?>">
                </div>

                <div class="form-group">
                    <label>twitter</label>
                    <input name="twitter" type="text" class="form-control"  value="<?php echo $ayarson["twitter"]; ?>">
                </div>



            </div>
            <div class="card-footer text-right">
                <button name="genelayarkaydet" type="submit" class="btn btn-primary">Güncelle</button>
            </div>
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>

