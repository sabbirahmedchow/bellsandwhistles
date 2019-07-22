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
  <title> My Account || Bells and Whisltes</title>
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
    
    <script>
          $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function(){
                readURL(this);
                var cust_image = $('.file-upload').val().substring($('.file-upload').val().lastIndexOf("\\") + 1, $('.file-upload').val().length); 
                var dataString = 'cust_image='+cust_image;
                $(".avatar").html("<img src='img/ajax-loader.gif' width='50' height='50' border='0' align='center' />");
                $.ajax({
                type: "POST",
                url: "insertCustomerPicture.php",
                data: dataString,

                success: function(str) {
                    
                  $('.avatar').html(" ");
                  
                }
              });
            });
        });  
    </script>
    <script src="js/ajax_functions.js"></script>
</head>
<?php include("header.php");
 
require_once 'classes/main.class.php'; 
$mainClsObj = mainClass ::getInstance(); 
    
$condArr = array(
     "id" => $_SESSION['user_id']
);    
    
$getUserInfo = $mainClsObj->getData("tb_customer", $condArr);    

$name = explode(" ", $getUserInfo[0]['name']); 
    
$condArrOrder = array(
     "customer_id" => $_SESSION['user_id']
);    
    
$getTotalOrders = $mainClsObj->countData("tb_order_customer", $condArrOrder);
$getAllOrders = $mainClsObj->getData("tb_order_customer", $condArrOrder); 
    

foreach($getAllOrders as $orders)
{
    $condArrPayment = array(

          "id" => $orders['order_id'],
          "status" => "Processing"
    ); 

     $getTotalPaymentDue[] = $mainClsObj->getData("tb_order", $condArrPayment);
}
 $totalDue = 0;
 
 foreach($getTotalPaymentDue as $payDue)
 {
     $totalDue = $totalDue + $payDue[0]['product_price']; 
 }

?>
 <body>
 <div class="pages wishlist-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="cart-page-container wishlist-page-container fix">    
                  <div class="container bootstrap snippet">
                    <div class="row">
                        <div class="col-sm-10"><h1>Welcome, <?php echo $getUserInfo[0]['name'];?></h1></div>
    	
    </div>
    <p>&nbsp;</p>                  
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        <?php if($getUserInfo[0]['pro_pic'] == "")
        {
        ?>    
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <?php 
        }
        else
        {
        ?>
        <img src="img/customers/<?php echo $getUserInfo[0]['pro_pic'];?>" class="avatar img-circle img-thumbnail" alt="avatar">
        <?php } ?>  
        <h6>Upload a different photo...</h6><br/>
        <form id="propic" enctype="multipart/form-data" action="uploadImg.php" method="post">  
         <input type="file" class="text-center center-block file-upload" id="proPic" name="proPic">
        </form>    
      </div></hr><br>

                    
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Orders</strong></span> <?php echo $getTotalOrders;?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Payment(Paid)</strong></span> 0.00</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Payment(Due)</strong></span> <?php echo $totalDue;?></li>
            
          </ul> 
                  
        </div><!--/col-3-->
    	<div class="col-sm-9">
            
              
          <div class="tab-content">
            <div class="tab-pane active" id="home" style="width: 90%; ">
               
                  <form class="form" action="#" method="post" id="registrationForm">
                        <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="first_name"><h4>First name</h4></label>
                                  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $name[0];?>" title="enter your first name if any.">
                              </div>
                          </div>
                          <div class="form-group">

                              <div class="col-xs-6">
                                <label for="last_name"><h4>Last name</h4></label>
                                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $name[1];?>" title="enter your last name if any.">
                              </div>
                          </div>
                    
                          <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="phone"><h4>Phone</h4></label>
                                  <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" value="<?php echo $getUserInfo[0]['phone'];?>" title="enter your phone number if any.">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-xs-6">
                                 <label for="mobile"><h4>Mobile</h4></label>
                                  <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $getUserInfo[0]['mobile'];?>" placeholder="enter mobile number" title="enter your mobile number if any.">
                              </div>
                          </div>
                      
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" value="<?php echo $getUserInfo[0]['email'];?>" placeholder="you@email.com" title="enter your email." disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Location</h4></label>
                              <input type="email" class="form-control" id="location" value="<?php echo $getUserInfo[0]['location'];?>" placeholder="somewhere" title="enter a location">
                          </div>
                      </div>
                      <br/>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Verify</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit" id="btnSubmitUser"> Save</button>
                               	<button class="btn btn-lg" type="reset"> Reset</button>
                                <span id="confirm"></span>
                            </div>
                      </div>
              	</form>
              
              <hr>
              
             </div><!--/tab-pane-->
           
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
   </div>
			</div>
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
    
    <script type="text/javascript" src="js/ajax.form.js" ></script>
        <script>
                    $(function(){
                        
                        $('#proPic').on({
                           
                            change: function(){
                                 
                                 $('#propic').ajaxForm({target: '#result'}).submit();
                                }
                        });
                        
                    });
    </script>  
</body>

<!-- Mirrored from moonhtml.onaz.io/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:35 GMT -->
</html>