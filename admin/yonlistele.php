<?php include_once "header.php"; ?>


<?php





$ayaral=$baglanti->prepare("select * from admins");
$ayaral->execute();


?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Yönetici Listesi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr>

                            <th>isim</th>
                            <th>Mail</th>
                            <th>Kullanıcı Adı</th>
                            <th>Yetki Türü</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($veriler=$ayaral->fetch(PDO::FETCH_ASSOC)){


                            ?>
                            <tr>

                                <td><?php echo $veriler["isim"]?></td>
                                <td class="align-middle">
                                    <?php echo $veriler["mail"]?>
                                </td>

                                <td><?php echo $veriler["kullaniciadi"]?></td>
                                <td>
                                    <?php
                                    if ($veriler["yetki"]==2){
                                        ?>
                                        <div class="badge badge-success badge-shadow">Adminastor</div>
                                        <?php
                                    }else if($veriler["yetki"]==1){
                                        ?>
                                        <div class="badge badge-warning badge-shadow">Admin</div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="badge badge-danger badge-shadow">Yetkisiz</div>
                                        <?php
                                    }

                                    ?>
                                </td>
                                <td>
                                    <a href="yonduzenle.php?id=<?php echo $veriler["id"]?>" class="btn btn-warning"><i class="fa fa-edit"></i> Düzenle</a>
                                    <a href="yonsil.php?id=<?php echo $veriler["id"]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Sil</a>
                                </td>
                            </tr>

                            <?php
                        } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>
