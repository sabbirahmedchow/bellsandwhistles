$(document).ready(function(){
//alert("dhukse");
$("#btnSignUp").click(function()
{
 //alert("dhukse");
if($('#fullname').val() == '')
 {
    $("#fullname").focus();
    return false;
 }
  var fullName = $('#fullname').val();
    
 if($('#email').val() == '')
 {
    $("#email").focus();
    return false;
 }    
  var email = $('#email').val();
    
if($('#password').val() == '')
 {
    $("#password").focus();
    return false;
 }
    
 if($('#conf_pass').val() == '')
 {
    $("#conf_pass").focus();
    return false;
 }    
 
 if($('#password').val() != $('#conf_pass').val())
 {
    $('#confirm').html("<span class=\"notification n-success\" style='color:red; margin-bottom:6px;'>Password and Confirm Password is not the same.</span>");
    $("#conf_pass").focus();
    return false;
 }
 else
 {
   var password = $('#password').val(); 
 }
 
  //alert($("#terms").attr('checked'));
 if($('input[name="toc"]:checked').length == 0)
 {
    alert("Please accept our terms of service");
    return false;
 }    
 
 var dataString = 'name='+ fullName +'&email='+email+'&password='+password;
 $("#confirm").html("<p align='center'><img src='img/ajax-loader.gif' width='20' height='20' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "./inc/insertUser.php",
    data: dataString,
    
    success: function(res) {
       
      if(res == "")
      {
          $('#confirm').html("<span class=\"notification n-success\" style='color:green; margin-bottom:6px;'>We have sent you a link in your email. Click the link and confirm your registration.</span>")
          .hide()
          .fadeIn(2500, function() {
        
         });
      }    
     else
     {    
      
          $('#confirm').html("<span class=\"notification n-success\" style='color:red; margin-bottom:6px;'>"+ res +"</span>")
          .hide()
          .fadeIn(2500, function() {
        
         });
      
     }
    }
  });
return false;
});


$("#subRegEdit").click(function()
{
 //alert("dhukse");
 if($('#f_name').val() == '')
 {
    $("#f_name").css("border","1px solid red");
    $("#f_name").focus();
    return false;
 }
 else
 {
    $("#f_name").css("border","1px solid #ddd"); 
    var fName = $('#f_name').val();
 }    
 if($('#l_name').val() == '')
 {
    $("#l_name").css("border","1px solid red");
    $("#l_name").focus();
    return false;
 }
 else
 {
    $("#l_name").css("border","1px solid #ddd"); 
    var lName = $('#l_name').val();
 }
 
 if($('#comp_name').val() == '')
 {
    $("#comp_name").css("border","1px solid red");
    $("#comp_name").focus();
    return false;
 }
 else
 {
    $("#comp_name").css("border","1px solid #ddd"); 
    var CompName = $('#comp_name').val();
 }
 if($('#addr').val() == '')
 {
    $("#addr").css("border","1px solid red");
    $("#addr").focus();
    return false;
 }
 else
 {
    $("#addr").css("border","1px solid #ddd"); 
    var address = $('#addr').val();
 }
 if($('#city').val() == '')
 {
    $("#city").css("border","1px solid red");
    $("#city").focus();
    return false;
 }
 else
 {
    $("#city").css("border","1px solid #ddd"); 
    var city = $('#city').val();
 }
 if($('#state').val() == '')
 {
    $("#state").css("border","1px solid red");
    $("#state").focus();
    return false;
 }
 else
 {
    $("#state").css("border","1px solid #ddd"); 
    var state = $('#state').val();
 }
 if($('#zip').val() == '')
 {
    $("#zip").css("border","1px solid red");
    $("#zip").focus();
    return false;
 }
 else
 {
    $("#zip").css("border","1px solid #ddd"); 
    var zip = $('#zip').val();
 }
 if($('#phone').val() == '')
 {
    $("#phone").css("border","1px solid red");
    $("#phone").focus();
    return false;
 }
 else
 {
    $("#phone").css("border","1px solid #ddd"); 
    var phone = $('#phone').val();
 }
 if($('#email').val() == '')
 {
    $("#email").css("border","1px solid red");
    $("#email").focus();
    return false;
 }
 else
 {
    $("#email").css("border","1px solid #ddd"); 
    var email = $('#email').val();
 }
 if($('#password').val() != '')
 {
    var pass = $('#password').val();
    
 }
 
 if($('#password').val() != $('#conf_pass').val())
 {
    $("#txtConfPass").css("display","inline");
    $("#conf_pass").focus();
    return false;
 }
 else
 {
   $("#txtConfPass").css("display","none"); 
 }
 
  //alert($("#terms").attr('checked'));
 if($("#terms").attr('checked') != 'checked')
 {
    alert("Please accept our terms of service");
    return false;
 }    
 var user_id = $('#userId').val();
 var dataString = 'fName='+ fName+'&lName='+lName+'&comName='+CompName+'&address='+address+'&city='+city+'&state='+state+'&zip='+zip+'&phone='+phone+'&email='+email+'&userId='+user_id+'&password='+pass;
 //alert(dataString);
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='img/ajax-loader.gif' width='20' height='20' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "updateUser.php",
    data: dataString,
    
    success: function(res) {
        //alert(res);
      if(res != '')
      {
          $("html, body").animate({scrollTop: 0}, 1000);
          $('#confirm').html("<span class=\"notification n-success\" style='color:red; margin-bottom:6px; text-align:center;'>"+res+"</span>")
          .hide()
          .fadeIn(2500, function() {
        
         });
      }    
     else
     {    
      $("html, body").animate({scrollTop: 0}, 1000);   
      $('#confirm').html("<span class=\"notification n-success\" style='margin-bottom:6px; text-align:center;'><b>Your information updated successfully.</b></span>")
      .hide()
      .fadeIn(2500, function() {
        
      });
     }
    }
  });
return false;
});


$("#loginBtn").click(function()
{
 //alert("dhukse");
    
 if($('#inputEmail3').val() == '')
 {
     $("#inputEmail3").focus();
     return false;
 }  
    
 if(!validateEmail($('#inputEmail3').val())) 
 {
    window.alert("Please enter a valid email address."); 
 }
 
 if($('#inputPassword3').val() == '')
 {
    $("#inputPassword3").focus();
    return false;
 }   
 
 var userName = $('#inputEmail3').val();
 var userPass = $('#inputPassword3').val();
 var addStr ='';
 
    
 var dataString = 'username='+userName+'&pass='+ userPass+addStr;
 //alert(dataString);
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='../img/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "../inc/check_access.php",
    data: dataString,
    
    success: function(res) {
     // window.alert(res);
      //return false;
      if(res == 1)
      {
         location.href="index.php";
      }    
      else
      {    
        $('#confirm').html("<span class=\"notification n-success\" style='color:red; margin-bottom:6px; text-align:center;'>"+res+"</span>")
      }
         
    }
  });
return false;
});

$("#learning1").click(function()
{
 //alert("dhukse");
 setTimeout(function()
 {
  $("#smallRight").load("add_learning_materials.php");
 }, 2000);

 $("#smallRight").html("<p style='height:100%; margin-left:100px;'><img src='../images/loading.gif' width='287' height='141' border='0' align='center' /></p>");

});


$("#orders").click(function()
{
 //alert("dhukse");
 setTimeout(function()
 {
  $("#smallRight").load("orders.php");
 }, 2000);

 $("#smallRight").html("<p style='height:100%; margin-left:100px;'><img src='../images/loading.gif' width='287' height='141' border='0' align='center' /></p>");

});

$("#orders1").click(function()
{
 //alert("dhukse");
 setTimeout(function()
 {
  $("#smallRight").load("orders.php");
 }, 2000);

 $("#smallRight").html("<p style='height:100%; margin-left:100px;'><img src='../images/loading.gif' width='287' height='141' border='0' align='center' /></p>");

});


$("#ra_files").click(function()
{
 //alert("dhukse");
 setTimeout(function()
 {
  $("#smallRight").load("ra_files.php");
 }, 2000);

 $("#smallRight").html("<p style='height:100%; margin-left:100px;'><img src='../images/loading.gif' width='287' height='141' border='0' align='center' /></p>");

});

$("#ra_files1").click(function()
{
 //alert("dhukse");
 setTimeout(function()
 {
  $("#smallRight").load("ra_files.php");
 }, 2000);

 $("#smallRight").html("<p style='height:100%; margin-left:100px;'><img src='../images/loading.gif' width='287' height='141' border='0' align='center' /></p>");

});

$("#discount").click(function()
{
 //alert("dhukse");
 setTimeout(function()
 {
  $("#smallRight").load("discounts.php");
 }, 2000);

 $("#smallRight").html("<p style='height:100%; margin-left:100px;'><img src='../images/loading.gif' width='287' height='141' border='0' align='center' /></p>");

});

$("#videos").click(function()
{
 //alert("dhukse");
 setTimeout(function()
 {
  $("#smallRight").load("lc_videos.php");
 }, 2000);

 $("#smallRight").html("<p style='height:100%; margin-left:100px;'><img src='../images/loading.gif' width='287' height='141' border='0' align='center' /></p>");

});

$("#videos1").click(function()
{
 //alert("dhukse");
 setTimeout(function()
 {
  $("#smallRight").load("lc_videos.php");
 }, 2000);

 $("#smallRight").html("<p style='height:100%; margin-left:100px;'><img src='../images/loading.gif' width='287' height='141' border='0' align='center' /></p>");

});


$("#iPhone").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByPlatform.php?pId=2");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});
$("#iPad").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByPlatform.php?pId=3");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});
$("#google").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByPlatform.php?pId=4");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});
$("#Facebook").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByPlatform.php?pId=5");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});
$("#Windows").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByPlatform.php?pId=6");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});
$("#Symbian").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByPlatform.php?pId=7");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});

$("#Action").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByCategory.php?cId=1");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});

$("#Arcade").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByCategory.php?cId=2");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});

$("#Social").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByCategory.php?cId=3");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});

$("#Puzzle").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByCategory.php?cId=4");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});

$("#Fun").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByCategory.php?cId=5");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});

$("#Adventure").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByCategory.php?cId=6");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});

$("#Shooting").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByCategory.php?cId=7");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});

$("#Racing").click(function()
{
 //alert("dsddd");
 setTimeout(function()
 {
  $("#gameListing").load("gameByCategory.php?cId=8");
 }, 2000);

 $("#gameListing").html("<p style='height:100%; margin:200px 0 0 400px;'><img src='images/loading1.gif' width='100' height='100' border='0' align='center' /></p>");

});


  //Go to checkout page
 $("#checkout-btn").on("click", function(){ //when user clicks on cart box
    
    var productInCart =  $(this).val();
  $.ajax({
    type: "GET",
    url: "./inc/isLoggedIn.php",
    
    success: function(result) {
        
      if(result == 1)
      {
       
        if(productInCart > 0)
        {
            //$(this).addClass("active");
          //$(this).parent('li').prevAll('li').find('a').addClass("active");
        $('.cart-page-tablist ul li a[href="#check-out"]').addClass("active");
          $("#check-out").css("display", "block");
          $("#order-complete").css("display", "none"); 
          $("#shopping-cart").css("display", "none"); 

           //$('.cart-page-tablist').parent('li').nextAll('li').find('a').removeClass("active");
        }
        else
        {
          window.alert("Insert product in your cart before you proceed to checkout.");       
          $("#check-out").css("display", "none");
          $("#order-complete").css("display", "none"); 
          $("#shopping-cart").css("display", "block"); 
          //$('.cart-page-tablist ul li a').removeClass("active");

        }
      }
      else
      {
         location.href = "./login.php";
      }
    }
  });
     
    
    
     
});
    
// Go to order complete page
$(".place-order-btn").on("click", function(){ //when user clicks on cart box
    
    if($("#fName").val() == "First Name *")
    {
        window.alert("Please insert your billing first name.");
        $("#fName").focus()
        return false;
    }
    if($("#lName").val() == "Last Name *")
    {
        window.alert("Please insert your billing last name.");
        $("#lName").focus()
        return false;
    }
    if($("#email").val() == "Email Address *")
    {
        window.alert("Please insert your billing email address.");
        $("#email").focus()
        return false;
    }
    if(!validateEmail($("#email").val()))
    {
        window.alert("Please insert a valid email address");
        $("#email").focus()
        return false;     
    }
    if($("#phone").val() == "Phone *")
    {
        window.alert("Please insert your billing phone number.");
        $("#phone").focus()
        return false;
    }
    if($("#zip").val() == "Postcode *")
    {
        window.alert("Please insert your billing zip code.");
        $("#zip").focus()
        return false;
    }
    if($("#address").val() == "Address *")
    {
        window.alert("Please insert your billing address.");
        $("#address").focus()
        return false;
    }
    else
    {
      var payment = $("button[class='select-btn']").attr("value");
    $("#shipping-details").attr("action", "./inc/saveOrder.php?payment="+payment); 
    $.each ( $('#billing-details input, #billing-details select, #billing-details textarea').serializeArray(), function ( i, obj ) {
      $('<input type="hidden">').prop( obj ).appendTo( $('#shipping-details') );
    });  //copy data from one form to another     
     $("#shipping-details").submit();
    }
  
});    
});

function checkLCVideosForm(frm)
{
 
  //alert("ssds");
  var title = $('#learning_video_title').val();
  var video = $('#learning_video_url').val();
  var dataString = 'title='+ title + '&video=' + video ;
  //alert(dataString);

  $.ajax({
    type: "POST",
    url: "insertLCVideo.php",
    data: dataString,
    success: function() {
   
      $('#message1').html("<font color='red'><b>Video added successfully</b></font>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
  return false;
}


function checkLearningForm(frm)
{
  //alert('sdasd');
  if(frm.learning_title.value == '')
  {
    alert("Title field is empty");
    frm.learning_title.focus();
    return false;
  }
  if(frm.desc.value == '')
  {
    alert("Description field is empty");
    frm.desc.focus();
    return false;
  }
 
  var title = $('#learning_title').val();
  var desc = $('#desc').val();
  var dataString = 'title='+ title + '&desc=' + desc ;
  //alert (dataString);

  $.ajax({
    type: "POST",
    url: "insertLC.php",
    data: dataString,
    success: function() {
   
      $('#message').html("<font color='red'><b>Learning Info added successfully</b></font>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
  return false;
}

function changeStatus(str, orderId)
{
  var status = str;
  var order_id = orderId;
  
  var dataString = 'status='+status+"&orderId="+order_id;
  $.ajax({
    type: "POST",
    url: "changeStatus.php",
    data: dataString,
    success: function() {
   
      $('#message').html("<font color='red'><b>Status changed successfully</b></font>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
  return false;
}

// Shopping Cart Functions

function addtoCart(name, price, color, thumb)
{
  var name = name;
  var price = price;
  var color = color;
  var thumb = thumb;
    
     var dataString = 'product_name='+name+'&product_price='+price+"&product_color="+color+"&product_thumb="+thumb+"&action=1";
     $("#cart-load").html('<img src="img/ajax-loader.gif">');
     //window.alert(dataString);
    $.ajax({ //make ajax request to cart_process.php
		url: "./inc/cart_process.php",
		type: "POST",
		//dataType:"json", //expect json value from server
		data: dataString,
	success: function() {
     
    $(".cart-number").load( "./inc/cart_process.php?total_product=1");
	    
    $("#cart-load").load( "./inc/cart_process.php?load_cart=1");
    
     window.alert("Item added to the cart.");
    }
  });
return true;
	//e.preventDefault();
}

function removeItem(pName) {
	
    if (confirm("Do you really want to delete this product?")) {
    
    $(this).load("./inc/cart_process.php?product_remove="+pName);
	
	
    }
    else
        {
            return false;
        }
    $(".cart-number").load( "./inc/cart_process.php?total_product=1");
	$("#cart-load").load( "./inc/cart_process.php?load_cart=1");
}

function checkCartISEmpty(productInCart)
{
   
    if(productInCart > 0)
    {
      $('.cart-page-tablist ul li a').addClass("active");
      //$("#check-out").css("display", "block");
        
    }
    else
    {
      window.alert("Insert product in your cart before you proceed to checkout.");       
      $("#check-out").css("display", "none");
      $("#order-complete").css("display", "none"); 
      $("#shopping-cart").css("display", "block"); 
      $('.cart-page-tablist ul li a').removeClass("active");
          
    }
}

 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}


