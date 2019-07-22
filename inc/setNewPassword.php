<?php
include('head/head.php');
?>

<script type="text/javascript">
    $(document).ready(function() {
       $("#showForgotPass").click(function(){
           $("#forgotPass").css("display","block");
       });
       
       $("#passChange").click(function(){
       var email = $("#email").val();
       var new_pass = $("#newPass").val();
       var new_pass_again = $("#newPassRe").val();
       if(new_pass != new_pass_again)
       {
          alert("Password don't match!!");
          $("#newPass").focus();
          return false;
       }    
       var dataString = 'newPass='+new_pass+'&email='+email;
  $("#wait").html("<img src='img/ajax-loader.gif' width='20' height='20' border='0' align='center' />");
  //alert(dataString);
  $.ajax({
    type: "POST",
    url: "changePassword.php",
    data: dataString,
    
    success: function() {
        $("#wait").html('');
        //alert(res);
       alert("Password changed successfully!");
       //return false;
    },
    
    error: function() {
        $("#wait").html('');
        alert("An error occured. Please try again.");
         
        //alert("Failed");
        
    }
  });
   
       
    });
    });
	/*$(document).ready(function(){
		$('#sign_up_part').hide();
		 $(".sin_up_miles").click(function(){
			 alert(1);
			$("#sign_up_part").show();
	
				$('#sign_in_part').hide();
	
		})
		 $(".sin_up_miles").click(function(){
			 alert(2);
			$("#sign_in_part").show();
	
				$('#sign_up_part').hide();
	
		})
	});*/
</script>
<!--....................../for my account pages...............-->
 
<!--........................for product pages.............-->

<!--......................../for product pages.............-->

<!--<script type="text/javascript" src="../ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.latest.js"></script>
<script type="text/javascript" src="js/jquery.color.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#slide').cycle({
		fx:     'fade',
        speed:  'slow',
        timeout: 5000,
        pager:  '#nav',
		slideExpr: 'img' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
})
</script>
-->
</head>

<body id="index" class="index hide-left-column hide-right-column lang_en">
<!--[if IE 8]>
        <div style='clear:both;height:59px;padding:0 15px 0 15px;position:relative;z-index:10000;text-align:center;'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div>
		<![endif]-->
<div id="page">
  <div class="header-container">
    <?php include('main-menu.php');?>
  </div>
  <div class="columns-container">
    <div class="container" id="columns"> 
      <div class="row" id="slider_row">
        <div class="center_column col-xs-12" id="top_column"></div>
      </div>
      <div class="row">
        <div class="center_column col-xs-12 col-sm-9" id="center_column"> 
          
          <!-- Shopping Cart -->
          
          <h1 class="page-heading" id="cart_title">Change Password</h1>
          <div class="table_block table-responsive" id="order-detail-content">
      			<div class="opc-main-block" id="opc_new_account" style="margin:30px; color:#000000;">

    
 <div class="ads_body">
     
		<div class="ads_button_body">
        	<div class="ads_title">Enter your new password <span class="ads_require_icon"></div>
            <div class="ads_inputfield">
            	<input type="password" class="ads_only_textfield" name="newPass" id="newPass" size="53" />
            </div>
        </div><br/>
        
        <div class="ads_button_body">
        	<div class="ads_title">Retype the password:<span class="ads_require_icon"></div>
            <div class="ads_inputfield">
            	<input type="password" class="ads_only_textfield" name="newPassRe" id="newPassRe" size="53"  />
            </div>
                
        </div>
     
     
     </div><br/>
		 <div class="ads_button_body" style="margin-left:180px; width:auto; ">
            <div class="ads_submit_buttton">
                <input type="hidden" name="email" id="email" value="<?php echo $_GET['email'];?>"/>
            	<input type="submit" value="Submit" class="ads_submit" id="passChange"/>
                
            </div>		
        </div>
        
   </div>
          </div> 
        </div>
        <!-- #center_column --> 
        
        <?php
        include('sidebar.php');
		?>
      </div>
      <!-- .row --> 
    </div>
    <!-- #columns --> 
  </div>
  <!-- .columns-container --> 
  <!-- Footer -->
  <div class="footer-container">
    <?php
     include('footer.php');
	?>
  </div>
  <!-- #footer --> 
</div>
<!-- #page --> 

<!-- begin olark code -->

</body>
</html>