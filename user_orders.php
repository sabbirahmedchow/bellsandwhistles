<!doctype html>
<?php
if($_SERVER['HTTP_HOST'] == "localhost")
{
?>
<base href="http://localhost/bells&whistles/">
<?}
else
{
?> 
<base href="http://www.bellsandwhistles.com.bd/">
<?php } ?><base href="http://localhost/bells&whistles/">
<html class="no-js" lang="en-US">

<head>
  <title> My Orders || Bells and Whisltes</title>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link id="favicon" rel="icon" type="image/png" href="img/favicon.ico" />
	<!-- Google web fonts
	============================================ -->
	<link href='https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700italic,900italic,900,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Style Import CSS
	============================================ -->
	<link rel="stylesheet" type="text/css" href="css/custom-style.css" />
    <!-- Bootstrap JS
============================================ -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
       <!-- jQuery 1.12.0
    ============================================ -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      
    <!-- RS-slider CSS
	============================================ -->
	<link rel="stylesheet" type="text/css" href="lib/rs-plugin/css/settings.css" media="screen" />
	
	<!-- Modernizr JS
	============================================ -->
	<script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        .col-xs-6{padding: 0 12px 20px 0;}
    </style>
    
    <script src="js/ajax_functions.js"></script>
</head>
<?php include("header.php");
 
require_once 'classes/main.class.php'; 
$mainClsObj = mainClass ::getInstance(); 
    
$condArr = array(
     "id" => $_SESSION['user_id']
);    
    
$getUserInfo = $mainClsObj->getData("tb_customer", $condArr);    

?>
 <body>
 <div class="pages wishlist-page">
	<div class="container">
	    <div class="row">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card" style="width:1100px; margin-left:20px;">
              <div class="card-header border-transparent">
                <h1 class="card-title">My orders</h1>

                </div><br/>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Item</th>
                      <th>Price</th>
                      <th>Quantity</th>    
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td>&#2547; 100.00</td>
                      <td>
                       2
                      </td>
                       <td>
                        <span class="badge badge-success">Shipped</span>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td>&#2547; 180.00</td>
                      <td>
                        1
                      </td>
                       <td>
                        <span class="badge badge-warning">Pending</span>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td>&#2547; 400.00</td>
                      <td>
                        2
                      </td>
                       <td>
                        <span class="badge badge-danger">Delivered</span>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>Samsung Smart TV</td>
                      <td>&#2547; 1000.00</td>
                      <td>
                        3
                      </td>
                       <td>
                        <span class="badge badge-info">Processing</span>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td>&#2547; 600.00</td>
                      <td>
                        1
                      </td>
                       <td>
                       <span class="badge badge-warning">Pending</span>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td>&#2547; 3000.00</td>
                      <td>
                        1
                      </td>
                       <td>
                        <span class="badge badge-danger">Delivered</span>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td>&#2547; 350.00</td>
                      <td>
                        1
                      </td>
                       <td>
                        <span class="badge badge-success">Shipped</span>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>    
	</div>
</div>                                                      

<?php include("footer.php"); ?>
   
<!-- MeanMenu JS
============================================ -->
<script type="text/javascript" src="js/jquery.meanmenu.min.js"></script>
<!-- Slick Carousel JS
============================================ -->
<script type="text/javascript" src="js/slick.min.js"></script>
<!-- RS-Plugin JS
============================================ -->
<script type="text/javascript" src="lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>   
<script type="text/javascript" src="lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="lib/rs-plugin/rs.home.js"></script>
<!-- Scrollup JS
============================================ -->
<script type="text/javascript" src="js/jquery.scrollup.min.js"></script>
<!-- jQuery UI JS
============================================ -->
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<!-- Tree View JS
============================================ -->
<script type="text/javascript" src="js/jquery.treeview.js"></script>
<!-- Nice Scroll JS
============================================ -->
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<!-- WOW JS
============================================ -->
<script type="text/javascript" src="js/wow.min.js"></script>
<!-- Google Map APi
============================================ -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuU_0_uLMnFM-2oWod_fzC0atPZj7dHlU"></script> -->
<script>
	new WOW().init();
    
</script>
<!-- Main JS
============================================ -->
<script type="text/javascript" src="js/main.js"></script>
   
</body>

<!-- Mirrored from moonhtml.onaz.io/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:35 GMT -->
</html>