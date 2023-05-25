<?php



class kurumsal {


    public function __construct()
    {
        try {
            $baglanti=new PDO("mysql:host=localhost;dbname=demokisiselv5;charset=utf8","root","");
            $baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }


        $ayaral=$baglanti->prepare("select * from ayar");
        $ayaral->execute();
        $ayarson=$ayaral->fetch();

        $this->isim=$ayarson["isim"];
        $this->alan=$ayarson["alan"];
        $this->hakkimda=$ayarson["hakkimda"];
        $this->telefon=$ayarson["telefon"];
        $this->telefonlink=$ayarson["telefonlink"];

        $this->adres=$ayarson["adres"];
        $this->mail=$ayarson["mail"];
        $this->maillink=$ayarson["maillink"];

        $this->baslikrenk=$ayarson["baslikrenk"];
        $this->isimrenk=$ayarson["isimrenk"];
        $this->alticerikrenk=$ayarson["alticerikrenk"];
        $this->iconrenk=$ayarson["iconrenk"];
        $this->iletisimbilgirenk=$ayarson["iletisimbilgirenk"];
        $this->altmenurenk=$ayarson["altmenurenk"];
        $this->activerenk=$ayarson["activerenk"];
        $this->google_analytic=$ayarson["google_analytic"];
        $this->google_dogrulama=$ayarson["google_dogrulama"];
        $this->resimyol=$ayarson["resimyol"];



        $linkal=$baglanti->prepare("select * from sosyalmedya");
        $linkal->execute();
        $linkson=$linkal->fetch();

        $this->facebook=$linkson["facebook"];
        $this->instagram=$linkson["instagram"];
        $this->youtube=$linkson["youtube"];
        $this->linkedin=$linkson["linkedin"];
        $this->twitter=$linkson["twitter"];








    }





}







?>




