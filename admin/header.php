<?php
include_once "fonksiyon/giris.php";

$yonetim = new yonetim;
$yonetim->konrolet("cot");
static $yetki=0;

?>


<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Yönetim Paneli</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">

    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        textarea.form-control {
            min-height: 200px;

        }
    </style>

</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a></li>

                </ul>
            </div>
            <ul class="navbar-nav navbar-right">

                <li class="dropdown"><a href="#" data-toggle="dropdown"
                                        class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="../<?php echo $yonetim->resimal($baglanti); ?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                    <div class="dropdown-menu dropdown-menu-right pullDown">
                        <div class="dropdown-title">Merhaba <?php echo $yonetim->kuladial($baglanti); ?></div>
                        <a href="yonprofilfoto.php" class="dropdown-item has-icon"> <i class="far
										fa-image"></i> Yönetici Resim Güncelle
                        </a> <a href="sifreayar.php" class="dropdown-item has-icon"> <i class="fa fa-lock"></i>
                            Şifre Ayar
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="cikis.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                            Çıkış
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="dashboard.php"> <span
                            class="logo-name text-job"><i class="fa fa-user"></i> AdminPanel</span>
                    </a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Menüler</li>
                    <li class="dropdown">
                        <a href="dashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Anasayfa</span></a>
                    </li>



                            <li><a class="nav-link" href="genel-ayar.php"><i class="fa fa-cogs"></i>  Genel Ayarlar</a></li>
                            <li><a class="nav-link" href="sosyalmedyaayar.php"><i class="fa fa-code"></i>  Sosyal Medya Ayarları</a></li>
                            <li><a class="nav-link" href="mail-ayar.php"><i class="fa fa-envelope"></i>  Mail Ayar</a></li>
                            <li><a class="nav-link" href="profilfoto.php"><i class="fa fa-images"></i>  Profil Foto Ayar</a></li>
                            <li><a class="nav-link" href="faviconayar.php"><i class="fa fa-images"></i>  Favicon Ayar</a></li>
                           <li><a class="nav-link" href="tasarimayar.php"><i class="fa fa-laptop-code"></i> Tasarım Ayarları</a></li>




                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fa fa-user-plus"></i><span>Yönetici Ayarları</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="yonprofilfoto.php">Yönetici Resim Ayar</a></li>
                            <li><a class="nav-link" href="sifreayar.php">Şifre Ayar</a></li>
                            <li><a class="nav-link" href="yonlistele.php">Yöneticiler</a></li>
                            <li><a class="nav-link" href="yoneticiayar.php">Yönetici Ekle</a></li>
                        </ul>
                    </li>






                </ul>
            </aside>
        </div>
        <!-- Main Content -->
        <div class="main-content">