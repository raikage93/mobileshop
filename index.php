<?php
ob_start();
session_start();
define('TEMPLATE', true);
include_once('config/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Home</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/cart.css">
<link rel="stylesheet" href="css/category.css">
<link rel="stylesheet" href="css/product.css">
<link rel="stylesheet" href="css/search.css">
<link rel="stylesheet" href="css/success.css">
<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.js"></script>
</head>
<body>

<!--	Header	-->
<div id="header">
	<div class="container">
    	<div class="row">
        	<!--	Logo	-->
            <?php include_once('modules/logo/logo.php');?>
            <!--	End Logo	-->
            <!--	Search	-->
            <?php include_once('modules/search/search_box.php');?>
            <!--	End Search	-->
            <!--	Cart	-->
            <?php include_once('modules/cart/cart_notify.php');?>
            <!--	End Cart	-->
        </div>
    </div>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu">
    	<span class="navbar-toggler-icon"></span>
    </button>
</div>
<!--	End Header	-->

<!--	Body	-->
<div id="body">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12">
            	<!--	Menu	-->
                <?php include_once('modules/category/menu.php');?>
                <!--	End Menu	-->
            </div>
        </div>
        <div class="row">
        	<div id="main" class="col-lg-8 col-md-12 col-sm-12">
            	<!--	Slider	-->
                <?php include_once('modules/slide/slide.php');?>
                <!--	End Slider	-->
                
				<?php
                if(isset($_GET['page_layout'])){
					switch($_GET['page_layout']){
						case 'category': include_once('modules/category/category.php'); break;
						case 'search': include_once('modules/search/search.php'); break;
						case 'product': include_once('modules/products/product.php'); break;
						case 'cart': include_once('modules/cart/cart.php'); break;
						case 'success': include_once('modules/cart/success.php'); break;
					}
				}
				else{
					include_once('modules/products/featured.php');
					include_once('modules/products/latest.php');
				}
				?>
                
            </div>
            
            <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
            	<!--	Banner	-->
                <?php include_once('modules/banners/banner.php');?>
                <!--	End Banner	-->
            </div>
        </div>
    </div>
</div>
<!--	End Body	-->

<div id="footer-top">
	<div class="container">
    	<div class="row">
        	<!--	Logo Footer	-->
            <?php include_once('modules/logo/logo_footer.php');?>
            <!--	End Logo Footer	-->
            <!--	Address	-->
            <?php include_once('modules/address/address.php');?>
            <!--	End Address	-->
            <!--	Service	-->
            <?php include_once('modules/services/service.php');?>
            <!--	End Service	-->
            <!--	Hotline	-->
            <?php include_once('modules/hotline/hotline.php');?>
            <!--	End Hotline	-->
        </div>
    </div>
</div>

<!--	Footer	-->
<div id="footer-bottom">
	<div class="container">
    	<div class="row">
        	<!--	Footer	-->
            <?php include_once('modules/footer/footer.php');?>
            <!--	End Footer	-->
        </div>
    </div>
</div>
<!--	End Footer	-->













</body>
</html>
