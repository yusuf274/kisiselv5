
<?php

ob_start();
include_once "baglan.php";


class yonetim{

    static $yetki=0;


    function sorgum($vt,$sorgu,$tercih=0){

        $al = $vt->prepare($sorgu);
        $al->execute();
        if($tercih==1):
            return $al->fetch();
        elseif($tercih==2):
            return $al;
        endif;


    }//genel sorgu

    function sifrele($veri){
        return base64_encode(gzdeflate(gzcompress(serialize($veri))));

    }
    function coz($veri){
        return unserialize(gzuncompress(gzinflate(base64_decode($veri))));
    }
    function kuladial($baglanti){
        $cookid=$_COOKIE["adminbilgi"];
        $cozduk=self::coz($cookid);
        $sorgusonuc=$baglanti->prepare("select * from admins where id=$cozduk");
        $sorgusonuc->execute();
        $sorgusonucal=$sorgusonuc->fetch();
        return $sorgusonucal["kullaniciadi"];
    }//kullanıcı adı ayarla

    function kulidal($baglanti){
        $cookid=$_COOKIE["adminbilgi"];
        $cozduk=self::coz($cookid);
        $sorgusonuc=$baglanti->prepare("select * from admins where id=$cozduk");
        $sorgusonuc->execute();
        $sorgusonucal=$sorgusonuc->fetch();
        return $sorgusonucal["id"];
    }//kullanıcı adı ayarla

    function kulyetkial($baglanti){
        $cookid=$_COOKIE["adminbilgi"];
        $cozduk=self::coz($cookid);
        $sorgusonuc=$baglanti->prepare("select * from admins where id=$cozduk");
        $sorgusonuc->execute();
        $sorgusonucal=$sorgusonuc->fetch();
        return $sorgusonucal["yetki"];
    }//kullanıcı adı ayarla




    function resimal($baglanti){

        $cookid=$_COOKIE["adminbilgi"];
        $cozduk=self::coz($cookid);
        $sorgusonuc=$baglanti->prepare("select * from admins where id=$cozduk");
        $sorgusonuc->execute();
        $sorgusonucal=$sorgusonuc->fetch();
        return $sorgusonucal["resim"];
    }//kullanıcı adı ayarla


    function giriskontrol($mail,$sifre,$baglanti)  {
        $sifrelihal=md5(sha1(md5($sifre)));
        $sor=$baglanti->prepare("select * from admins where mail='$mail' and sifre='$sifrelihal'");
        $sor->execute();

        if($sor->rowCount()==0):
            echo '
            <div class="container-fluid bg-white">
            <div class="alert alert-white border border-dark mt-5 col-md-5 mx-auto p-3 text-danger font-14 font-weight-bold">
            Bilgiler hatalı!</div>
            </div>';

            header("refresh:1,url=index.php");
        else:
            $gelendeger=$sor->fetch();




            echo '
        <div class="container-fluid bg-white">
        <div class="alert alert-white border text-center border-dark mt-5 col-md-12 mx-auto p-3 text-success font-14 font-weight-bold">
        Giriş başarılı hoşgeldiniz 
        
        </div>
        </div>';

            header("refresh:1,url=dashboard.php");

            //cookie
            $id=self::sifrele($gelendeger["id"]);


            setcookie("adminbilgi",$id, time() + 60*60*24);

        endif;
    }///giris
    function cikis($baglanti){
        $cookid=$_COOKIE["adminbilgi"];
        $cozduk=self::coz($cookid);
        self::sorgum($baglanti,"update admins set aktif=0 where id=$cozduk",0);
        setcookie("adminbilgi",$cookid, time() - 5);
        echo '<div class="alert alert-info mt-5 col-md-5 mx-auto">Cıkış başarılı!</div>';
        header("refresh:2,url=index.php");
    }//cikis
    function konrolet($sayfa){
        if(isset($_COOKIE["adminbilgi"])):
            if($sayfa=="ind"):
                header("Location:dashboard.php");
            endif;

        else:
            if($sayfa=="cot"):
                header("Location:index.php");
            endif;
        endif;

    }//cookie



    function ayarlar($baglanti) {
        $id=self::coz($_COOKIE["adminbilgi"]);
        $sonuc=self::sorgum($baglanti,"SELECT * FROM admins where id=$id",1 );
        if($_POST):

            if ($this::kulyetkial($baglanti)==0){
                ?>
                <script type="text/javascript">
                    swal("İşlem Yetkiniz Kısıtlı! Yönlendiriliyorsunuz...");


                </script>
                <?php
                header("refresh:1,url=sifreayar.php");

            }else{
                @$kulad=htmlspecialchars($_POST["kulad"]);
                @$mail=htmlspecialchars($_POST["mail"]);

                @$eskisif=htmlspecialchars($_POST["sifre"]);
                @$yenisif=htmlspecialchars($_POST["yenisifre"]);
                @$yenisif2=htmlspecialchars($_POST["yenisifre2"]);
                //eski şifreyi şifrele ve vt ile karsılastır.
                //yeni sifreler aynımı kontrol et
                //
                if($kulad=="" || $eskisif=="" || $yenisif=="" || $yenisif2==""):
                    echo '<div class="alert alert-danger mt-5">Hiçbir alan boş geçilemez.</div>';
                    header("Refresh:1; url=sifreayar.php");
                else:
                    $sifrelihal=md5(sha1(md5($eskisif)));
                    if($sonuc['sifre']!=$sifrelihal):
                        echo '<div class="alert alert-danger mt-5">Eski şifre hatalı girildi.</div>';
                        header("Refresh:1; url=sifreayar.php");
                    else:
                        if($yenisif!=$yenisif2):
                            echo '<div class="alert alert-danger mt-5">Yeni şifreler eşleşmiyor.</div>';
                            header("Refresh:1; url=sifreayar.php");
                        else:
                            $yenisifson=md5(sha1(md5($yenisif)));
                            $guncelleme=$baglanti->prepare("update admins set 
                kullaniciadi=?,sifre=?,mail=? where id=$id");
                            $guncelleme->bindParam(1,$kulad,PDO::PARAM_STR);
                            $guncelleme->bindParam(2,$yenisifson,PDO::PARAM_STR);
                            $guncelleme->bindParam(3,$mail,PDO::PARAM_STR);

                            $guncelleme->execute();
                            echo '<div class="alert alert-success mt-5">
               Bilgiler başarıyla güncellendi.Yönlendiriliyorsunuz lütfen bekleyiniz...
                </div>';
                            header("Refresh:1; url=sifreayar.php");

                        endif;
                    endif;
                endif;
            }


        else:
            ?>
            <form method="post">
                <div class="row text-center">
                    <div class="col-lg-10 mx-auto">
                        <div class="col-lg-12 mx-auto mt-2">
                            <h3 class="text-info">Şifre Ve Mail Ayar

                            </h3>
                        </div>
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-4 border-right pt-3 text-left">
                                    <span id="siteayarfont">Kullanıcı Adı</span>
                                </div>
                                <div class="col-lg-8 p-1">
                                    <input type="text" name="kulad" class="form-control" value="<?php echo $sonuc['kullaniciadi']; ?>" />
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-4 border-right pt-3 text-left">
                                    <span id="siteayarfont">Mail Adres</span>
                                </div>
                                <div class="col-lg-8 p-1">
                                    <input type="text" name="mail" class="form-control" value="<?php echo $sonuc['mail']; ?>" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-4 border-right pt-3 text-left">
                                    <span id="siteayarfont">Şifre</span>
                                </div>
                                <div class="col-lg-8 p-1">
                                    <input type="password" name="sifre" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-4 border-right pt-3 text-left">
                                    <span id="siteayarfont">Yeni Sifre</span>
                                </div>
                                <div class="col-lg-8 p-1">
                                    <input type="password" name="yenisifre" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-4 border-right pt-3 text-left">
                                    <span id="siteayarfont">Yeni Sifre Tekrar</span>
                                </div>
                                <div class="col-lg-8 p-1">
                                    <input type="password" name="yenisifre2" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto mt-2">
                            <input type="submit" name="buton" class="btn btn-info m-1" value="Değiştir" />
                        </div>
                    </div>
                </div>
            </form>
        <?php
        endif;

    }// kullanıcı yönetimi baslangıc
    function yonsil($vt,$id){

        if (!self::kulyetkial($vt)==2){
            ?>
            <script type="text/javascript">
                swal("İşlem Yetkiniz Kısıtlı! Yönlendiriliyorsunuz...");


            </script>
            <?php
            header("refresh:2,url=yoneticiayar.php");

        }else{

            self::sorgum($vt,"delete from admins where id=$id",0);
            ?>
            <script type="text/javascript">
                swal("Silme Başarılı!", "Yönleniyor", "success");

            </script>

            <?php
            header("Refresh:1; url=yonlistele.php");
        }





    }
    function yonekle($vt){

        if($_POST):

            if (!self::kulyetkial($vt)==2){
                ?>
                <script type="text/javascript">
                    swal("İşlem Yetkiniz Kısıtlı! Yönlendiriliyorsunuz...");


                </script>
                <?php
                header("refresh:2,url=yoneticiayar.php");

            }else{
                @$isim=htmlspecialchars($_POST["isim"]);

                @$kulad=htmlspecialchars($_POST["kulad"]);
                @$mail=htmlspecialchars($_POST["mail"]);
                @$yenisif=htmlspecialchars($_POST["yenisifre"]);
                @$yenisif2=htmlspecialchars($_POST["yenisifre2"]);
                @$yetki=htmlspecialchars($_POST["yetkiderece"]);
                //eski şifreyi şifrele ve vt ile karsılastır.
                //yeni sifreler aynımı kontrol et
                //
                if($kulad=="" ||  $yenisif=="" || $yenisif2==""):
                    echo '<div class="alert alert-danger mt-5">Hiçbir alan boş geçilemez.</div>';
                else:
                    $sor=$vt->prepare("select * from admins where kullaniciadi='$kulad' or mail='$mail'");
                    $sor->execute();
                    if ($sor->rowCount()){
                        ?>
                        <script type="text/javascript">
                            swal("bu kullanıcı adı veya mail adresi daha önce kayıtlı! Yönlendiriliyorsunuz...");
                        </script>

                        <?php
                        header("Refresh:2; url=yoneticiayar.php");


                    }else{
                        if($yenisif!=$yenisif2):
                            echo '<div class="alert alert-danger mt-5">Yeni şifreler eşleşmiyor.</div>';
                        else:
                            $yenisifson=md5(sha1(md5($yenisif)));
                            $ekle=$vt->prepare("insert into admins (kullaniciadi,sifre,mail,isim,yetki) values(?,?,?,?,?)");
                            $ekle->bindParam(1,$kulad,PDO::PARAM_STR);
                            $ekle->bindParam(2,$yenisifson,PDO::PARAM_STR);
                            $ekle->bindParam(3,$mail,PDO::PARAM_STR);
                            $ekle->bindParam(4,$isim,PDO::PARAM_STR);
                            $ekle->bindParam(5,$yetki,PDO::PARAM_STR);



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
            }



        else:
            ?>
            <form method="post">
                <div class="row text-center">
                    <div class="col-lg-8 mx-auto">
                        <div class="col-lg-12 mx-auto mt-2">
                            <h3 class="text-info">Yönetici Ekle

                            </h3>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-5 border-right pt-3 text-left">
                                    <span id="siteayarfont">Adınız Soyadınız</span>
                                </div>
                                <div class="col-lg-7 p-1">
                                    <input type="text" name="isim" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-5 border-right pt-3 text-left">
                                    <span id="siteayarfont">Kullanıcı Adı</span>
                                </div>
                                <div class="col-lg-7 p-1">
                                    <input type="text" name="kulad" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-5 border-right pt-3 text-left">
                                    <span id="siteayarfont">Mail Adres</span>
                                </div>
                                <div class="col-lg-7 p-1">
                                    <input type="text" name="mail" class="form-control" value="" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-5 border-right pt-3 text-left">
                                    <span id="siteayarfont">Yeni Sifre</span>
                                </div>
                                <div class="col-lg-7 p-1">
                                    <input type="password" name="yenisifre" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-5 border-right pt-3 text-left">
                                    <span id="siteayarfont">Yeni Sifre (Tekrar)</span>
                                </div>
                                <div class="col-lg-7 p-1">

                                    <input type="password" name="yenisifre2" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-5 border-right pt-3 text-left">
                                    <span id="siteayarfont">Yönetici Seviyesini Seçiniz</span>
                                </div>
                                <div class="col-lg-7 pt-2">

                                    <input class="" type="radio" id="html" name="yetkiderece" value="0">
                                    <label for="html">Yetkisiz</label>
                                    <input type="radio" id="css" name="yetkiderece" value="1">
                                    <label for="css">Admin</label>
                                    <input type="radio" id="javascript" name="yetkiderece" value="2">
                                    <label for="javascript">Adminastör</label>
                                </div>


                            </div>
                        </div>




                        <div class="col-lg-12 mx-auto mt-2">
                            <br>
                            <input type="submit" name="buton" class="btn btn-info m-1" value="Yönetici Ekle" />
                            <br><br>
                        </div>
                    </div>
                </div>
            </form>
        <?php
        endif;

    }

    function mailayar($baglanti) {
        $sonucum=$baglanti->prepare("SELECT * FROM gelenmailayar");
        $sonucum->execute();
        $sonuc=$sonucum->fetch(PDO::FETCH_ASSOC);
        if($_POST):
            if (!self::kulyetkial($baglanti)==2){
                ?>
                <script type="text/javascript">
                    swal("İşlem Yetkiniz Kısıtlı! Yönlendiriliyorsunuz...");


                </script>
                <?php
                header("refresh:2,url=mail-ayar.php");

            }else{
                $host=htmlspecialchars($_POST["host"]);
                $mailadres=htmlspecialchars($_POST["mailadres"]);
                $sifre=htmlspecialchars($_POST["sifre"]);
                $port=htmlspecialchars($_POST["port"]);
                $alicimail=htmlspecialchars($_POST["alicimail"]);
                $guncelleme=$baglanti->prepare("update gelenmailayar set 
        host=?,mailadres=?,sifre=?,port=?, aliciadres=?");
                $guncelleme->bindParam(1,$host,PDO::PARAM_STR);
                $guncelleme->bindParam(2,$mailadres,PDO::PARAM_STR);
                $guncelleme->bindParam(3,$sifre,PDO::PARAM_STR);
                $guncelleme->bindParam(4,$port,PDO::PARAM_STR);
                $guncelleme->bindParam(5,$alicimail,PDO::PARAM_STR);
                $guncelleme->execute();
                echo '<div class="alert alert-success mt-5">
        <strong>Mail ayarları</strong> başarıyla güncellendi.
        </div>';
                header("refresh:2,url=mail-ayar.php");
            }

        else:
            ?>

            <form action="mail-ayar.php" method="post">
                <div class="row text-center">
                    <div class="col-lg-6 mx-auto">
                        <div class="col-lg-12 mx-auto mt-2">
                            <h3 class="text-info">Mail Ayarları

                            </h3>
                        </div>
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-3 border-right pt-3 text-left">
                                    <span id="siteayarfont">Host</span>
                                </div>
                                <div class="col-lg-9 p-1">
                                    <input type="text" name="host" class="form-control" value="<?php echo $sonuc['host']; ?>" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-3 border-right pt-3 text-left">
                                    <span id="siteayarfont">Mail Adresi</span>
                                </div>
                                <div class="col-lg-9 p-1">
                                    <input type="text" name="mailadres" class="form-control" value="<?php echo $sonuc['mailadres'];?>" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-3 border-right pt-3 text-left">
                                    <span id="siteayarfont">Host Sifre</span>
                                </div>
                                <div class="col-lg-9 p-1">
                                    <input type="text" name="sifre" class="form-control" value="<?php echo $sonuc["sifre"];?>" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-3 border-right pt-3 text-left">
                                    <span id="siteayarfont">Port</span>
                                </div>
                                <div class="col-lg-9 p-1">
                                    <input type="text" name="port" class="form-control" value="<?php echo $sonuc["port"];?>" />
                                </div>
                            </div>
                        </div>
                        <!--ara-->
                        <div class="col-lg-12 mx-auto border">
                            <div class="row">
                                <div class="col-lg-3 border-right pt-3 text-left">
                                    <span id="siteayarfont">Alıcı Mail</span>
                                </div>
                                <div class="col-lg-9 p-1">
                                    <input type="text" name="alicimail" class="form-control" value="<?php echo $sonuc["aliciadres"];?>" />
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 mx-auto"><br>
                            <input type="submit" name="buton" class="btn btn-info m-1" value="Guncelle" />
                        </div>
                    </div>
                </div>
            </form>



        <?php
        endif;

    } //MAİL kısmı















}


?>