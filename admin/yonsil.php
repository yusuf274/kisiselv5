<?php require_once "header.php"; ?>
<?php

$id=$_GET["id"];
?>
<div class="right_col" role="main">



    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>Yoneticiler</h3>
                    </div>

                </div>

                <div class="col-md-12 col-sm-3 col-xs-12 bg-white">

                    <div class="col-md-12 col-sm-12 col-xs-6">
                        <div>
                            <?php echo $yonetim->yonsil($baglanti,$id); ?>

                        </div>
                    </div>

                </div>

                <div class="clearfix"></div>
            </div>
        </div>

    </div>








</div>





<!-- footer content -->
<?php



require_once "footer.php"; ?>
