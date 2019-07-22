$(document).ready(function(){
//alert("dhukse");


$("#submitCat").click(function()
{
 //alert("dhukse");
 if($('#cat_name').val() == '')
 {
     $("#errorMsg").css("display","inline");
     return false;
 }    
 var cat_name = $('#cat_name').val();
 var cat_parent = $('#cat_parent').val();
 var cat_image = $('#cat_img').val().substring($('#cat_img').val().lastIndexOf("\\") + 1, $('#cat_img').val().length);    
 
 var dataString = 'cat_name='+ cat_name+'&cat_parent='+ cat_parent+'&cat_image='+ cat_image;
 
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='../../img/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "insertCategory.php",
    data: dataString,
    
    success: function(res) {
        //window.alert(res);
      $('#cat').val('');
      $('#confirm').html("<span class=\"notification n-success\">Category Added Successfully</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
return false;
});

$("#submitSubCat").click(function()
{
 //alert("dhukse");
 if($('#subcat').val() == '')
           {
              
              $("#errorMsg1").css("display","inline");
              return false;
           }   
           if($('#cat option:selected').val() == '')
           {
              
              $("#errorMsg2").css("display","inline");
              return false;
           }   
 var subcat_name = $('#subcat').val();
 var cat_id = $('#cat option:selected').val();
 
 var dataString = 'subcat_name='+subcat_name+'&cat_id='+ cat_id;
 //alert(dataString);
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='images/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "insertSubCategory.php",
    data: dataString,
    
    success: function() {
      $('#subcat').val('');
      $('#confirm').html("<span class=\"notification n-success\">Sub Category Added Successfully</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
return false;
});


$("#submitProd").click(function()
{


 if($('#cat_parent option:selected').val() == '')
 {
    $("#cat_parent").focus();
    return false;
 }
 if($('#subCat option:selected').val() == '')
 {
              
    $("#subCat").focus();
    return false;
 }   
// if($('#sub_cat option:selected').val() == '')
// {
//              
//    $("#errorMsg2").css("display","inline");
//    $("#sub_cat").focus();
//    return false;
// }  
     
 if($("#prod_name").val() == '')
 {
              
    $("#prod_name").focus();
    return false;
 } 

if($(".textarea1").val() == '')
 {
     
    $(".textarea1").focus();
    return false;
 } 

if($(".textarea2").val() == '')
 {
              
    $(".textarea2").focus();
    return false;
 }    
 
if($('#prod_quantity').val() == '')
 {
              
    $("#prod_quantity").focus();
    return false;
 }
    
if($('#currPrice').val() == '')
 {
              
    $("#currPrice").focus();
    return false;
 }
  
if($('#prod_main_img').val() == '')
 {
              
    $("#prod_main_img").focus();
    return false;
 }
 if($('#prod_sub_img1').val() == '')
 {
              
    $("#prod_sub_img1").focus();
    return false;
 }

 if($('#prod_sub_img1').val() == '')
 {
              
    $("#prod_sub_img1").focus();
    return false;
 }   
    
 if($('#prod_sub_img2').val() == '')
 {
              
    $("#prod_sub_img2").focus();
    return false;
 }

 if($('#prod_sub_img3').val() == '')
 {
              
    $("#prod_sub_img3").focus();
    return false;
 } 
    
 if($('#prod_home_img').val() == '')
 {
              
    $("#prod_home_img").focus();
    return false;
 }    
 
 if($('#prod_type').val() == '')
 {
              
    $("#prod_type").focus();
    return false;
 }
 if($('#prod_tags').val() == '')
 {
              
    $("#prod_tags").focus();
    return false;
 }
 
 var prodPPrice = " ";
 var prodSize = " ";
 var prodColor = " ";    
 var catId = $('#cat_parent option:selected').val();
 var subcatId = $('#subCat option:selected').val();
    
 var prodName = $('#prod_name').val();
 var prodSDesc = encodeURIComponent($('#sDesc').val());
 var prodLDesc = encodeURIComponent($('#lDesc').val());
 var prodQuantity = $('#prod_quantity').val();
 var prodCPrice = $('#currPrice').val();
 if($('#prevPrice').val() != " ")
 {
   prodPPrice = $('#prevPrice').val();    
 }
 var prodMImg = document.getElementById("prod_main_img").files[0].name;
 var prodSImg1 = document.getElementById("prod_sub_img1").files[0].name;
 var prodSImg2 = document.getElementById("prod_sub_img2").files[0].name;
 var prodSImg3 = document.getElementById("prod_sub_img3").files[0].name;    
 var prodHImg = document.getElementById("prod_home_img").files[0].name;
 var prodType = $('#prod_type option:selected').val();
 if($('#prod_size').val() != " ")
 {
   prodSize = $('#prod_size').val();
 }
 if($('#prod_color').val() != " ")
 {
   prodColor = $('#prod_color').val();
 }
 var prodTags = $('#prod_tags').val();
 
 
 var dataString = 'cat_id='+catId+'&subcat_id='+subcatId+'&subcat_id='+ subcatId+'&prod_name='+ prodName+'&prodSDesc='+ prodSDesc+'&prodLDesc='+ prodLDesc+'&prodQuantity='+ prodQuantity+'&prodCPrice='+ prodCPrice+'&prodPPrice='+ prodPPrice+'&prodMImg='+ prodMImg+'&prodSImg1='+ prodSImg1+'&prodSImg2='+ prodSImg2+'&prodSImg3='+ prodSImg3+'&prodHImg='+ prodHImg+'&prodSize='+ prodSize+'&prodColor='+ prodColor+'&prodTags='+prodTags;
 window.alert(dataString);
 return false;
 $("html, body").animate({scrollTop: 0}, 1000);
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='images/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "insertProduct.php",
    data: dataString,
    
    success: function(str) {
        $('#prodform')[0].reset();
        //alert(str);
        //$('#form').trigger("reset");
      //$('#subcat').val('');
      $('#confirm').html("<span class=\"notification n-success\">Product has been uploaded successfully</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
return false;
});

$("#editProduct").click(function()
{
 
 if($('#brand_id option:selected').val() == '')
 {
              
    $("#errorMsg0").css("display","inline");
    $("#brand_id").focus();
    return false;
 }
// if($('#cat option:selected').val() == '')
// {
//              
//    $("#errorMsg1").css("display","inline");
//    $("#cat").focus();
//    return false;
// }   
// if($('#sub_cat option:selected').val() == '')
// {
//              
//    $("#errorMsg2").css("display","inline");
//    $("#sub_cat").focus();
//    return false;
// }   
 if($('#prod_name').val() == '')
 {
              
    $("#errorMsg3").css("display","inline");
    $("#prod_name").focus();
    return false;
 } 
if($('#prod_spec').val() == '')
 {
              
    $("#errorMsg4").css("display","inline");
    $("#prod_spec").focus();
    return false;
 }  
 if($('#prod_additional_info').val() == '')
 {
              
    $("#errorMsg5").css("display","inline");
    $("#prod_additional_info").focus();
    return false;
 }
 if($('#prod_img').val() == '')
 {
              
    $("#errorMsg6").css("display","inline");
    $("#prod_img").focus();
    return false;
 }
 if($('#prod_msds').val() == '')
 {
              
    $("#errorMsg7").css("display","inline");
    $("#prod_img").focus();
    return false;
 }
 if($('#prod_size').val() == '')
 {
              
    $("#errorMsg8").css("display","inline");
    $("#prod_size").focus();
    return false;
 }
 if($('#prod_quant').val() == '')
 {
              
    $("#errorMsg9").css("display","inline");
    $("#prod_quant").focus();
    return false;
 }
// if($('#prod_sku').val() == '')
// {
//              
//    $("#errorMsg10").css("display","inline");
//    $("#prod_sku").focus();
//    return false;
// }
 
 var gcs = ''; var amp = ''; var ebay = '';
 var brandId = $('#brand_id option:selected').val();
 var catId = $('#cat option:selected').val();
 var subcatId = $('#sub_cat option:selected').val();
 var subcatPageId = $('#sub_cat_page option:selected').val();
 var prodName = $('#prod_name').val();
 var prodSpec = $('#prod_spec').val();
 var prodAddInfo = $('#prod_additional_info').val();
 if($('#prod_img').val() != '')
 {
  var prodImg = document.getElementById("prod_img").files[0].name;
  
 }
 else
 {
   var prodImg = $('#productImg').val();  
 }    
 if($('#prod_msds').val() != '')
 {
   var prodMSDS = document.getElementById("prod_msds").files[0].name;
 }
 else
 {
   var prodMSDS = $('#productMSDS').val();  
 } 
 //var msdsCode = $('#msds_code').val();
 var prodSize = $('#prod_size').val();
 var prodPrice = $('#prod_price').val();
 var prodMeasure = $('#prod_measure').val();
 var prodSKU = $('#prod_sku').val();
 var prodMilSpec = $('#prod_milspec').val();
 var prodSimilar = $('#is_similar_prod:checked').val();
 //var prodManufac = $('#manufac:checked').val();
 var prodID = $('#product_id').val();
 //alert($('#gcs').is(':checked'));
  var prodManufac = " "; 
 var i;
 var n = $("#rightValues option").length;
 
 var array = $("#rightValues option");
 for(i=0;i<n;i++)
 {
  prodManufac +=  array.eq(i).val();
  prodManufac += ',';
 }
 prodManufac = prodManufac.substring(0, prodManufac.length - 1);
 
 var dataString = 'brand_id='+brandId+'&cat_id='+catId+'&subcat_id='+ subcatId+'&subcatpage_id='+ subcatPageId+'&prod_name='+ prodName+'&prod_spec='+ prodSpec+'&prod_add_info='+ prodAddInfo+'&prod_img='+ prodImg+'&prod_msds='+ prodMSDS+'&prod_price='+ prodPrice+'&prod_size='+ prodSize+'&prod_measure='+ prodMeasure+'&prod_sku='+ prodSKU+'&prodMilSpec='+ prodMilSpec+'&prodSimilar='+prodSimilar+'&prodManufac='+prodManufac+'&gcs='+gcs+'&amp1='+amp+'&ebay='+ebay+'&prodId='+prodID;
 //alert(dataString);
 //return false;
 $("html, body").animate({scrollTop: 0}, 1000);
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='images/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "updateProduct.php",
    data: dataString,
    
    success: function() {
        $('#prodform')[0].reset();
        
        //$('#form').trigger("reset");
      //$('#subcat').val('');
      $('#confirm').html("<span class=\"notification n-success\">Product has been updated successfully</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
return false;
});


$("#submitManufac").click(function()
{
 //alert("dhukse");
 if($('#name').val() == '')
 {
              
    $("#errorMsg1").css("display","inline");
    $("#name").focus();
    return false;
 } 
if($('#addr').val() == '')
 {
              
    $("#errorMsg2").css("display","inline");
    $("#addr").focus();
    return false;
 }  
 if($('#city').val() == '')
 {
              
    $("#errorMsg3").css("display","inline");
    $("#city").focus();
    return false;
 }
 if($('#state').val() == '')
 {
              
    $("#errorMsg4").css("display","inline");
    $("#state").focus();
    return false;
 }
 if($('#zip').val() == '')
 {
              
    $("#errorMsg5").css("display","inline");
    $("#zip").focus();
    return false;
 }
 if($('#phone').val() == '')
 {
              
    $("#errorMsg6").css("display","inline");
    $("#phone").focus();
    return false;
 }
 
 
 var manufacName = $('#name').val();
 var address = $('#addr').val();
 var city = $('#city').val();
 var state = $('#state').val();
 var zip = $('#zip').val();
 var phone = $('#phone').val();
 
 var dataString = 'manufacName='+ manufacName+'&address='+ address+'&city='+ city+'&state='+ state+'&zip='+ zip+'&phone='+ phone;
 //alert(dataString);
 //return false;
 $("html, body").animate({scrollTop: 0}, 1000);
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='images/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "insertManufacturer.php",
    data: dataString,
    
    success: function() {
        $('#addCategory')[0].reset();
        
        //$('#form').trigger("reset");
      //$('#subcat').val('');
      $('#confirm').html("<span class=\"notification n-success\">Manufacturer has been added successfully</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
return false;
});


$("#submitRate").click(function()
{
 //alert("dhukse");
 if($('#manufac').val() == '')
  {
   $("#errorMsg2").css("display","inline");
   return false;
  }
 if($('#price_rate').val() == '')
  {
   $("#errorMsg").css("display","inline");
   return false;
  } 
  
 var manufac_name = $('#manufac').val();
 var rate = $('#price_rate').val();
 var rateType = $('#typ').val();
 
 var dataString = 'manufac_name='+ manufac_name+'&rate='+ rate+'&rateType='+ rateType;
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='images/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "changePriceRate.php",
    data: dataString,
    
    success: function() {
        
      $('#manufac').val('');
      $('#price_rate').val('');
      
      $('#confirm').html("<span class=\"notification n-success\">Price rate updated successfully</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
return false;
});

$("#submitLeadTime").click(function()
{
 //alert("dhukse");
 if($('#brand').val() == '')
  {
   $("#errorMsg2").css("display","inline");
   return false;
  }
 if($('#lead_time').val() == '')
  {
   $("#errorMsg").css("display","inline");
   return false;
  } 
  
 var brand = $('#brand').val();
 var lead_time = $('#lead_time').val();
 
 var dataString = 'brand='+ brand+'&lead_time='+ lead_time;
 alert(dataString);
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='images/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "changeLeadTimeByBrand.php",
    data: dataString,
    
    success: function() {
        
      $('#brand').val('');
      $('#lead_time').val('');
      
      $('#confirm').html("<span class=\"notification n-success\">Lead Time updated successfully</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
return false;
});


$("#submitMeta").click(function()
{
 //alert("dhukse");
 if($('#page').val() == '')
  {
   $("#errorMsg1").css("display","inline");
   return false;
  }
 if($('#title').val() == '')
  {
   $("#errorMsg2").css("display","inline");
   return false;
  } 
 if($('#keys').val() == '')
  {
   $("#errorMsg3").css("display","inline");
   return false;
  } 
if($('#desc').val() == '')
  {
   $("#errorMsg4").css("display","inline");
   return false;
  } 

 var page_name = $('#page').val();
 var title = $('#title').val();
 var keys = $('#keys').val();
 var description = $('#desc').val();
 
 var dataString = 'page_name='+ page_name+'&title='+ title+'&keys='+ keys+'&description='+ description;
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='images/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "insertMetaData.php",
    data: dataString,
    
    success: function() {
        
      $('#title').val('');
      $('#keys').val('');
      $('#desc').val('');
      
      $('#confirm').html("<span class=\"notification n-success\">Meta data added successfully</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
    }
  });
return false;
});

$("#submitBrandWeb").click(function()
{
 //alert("dhukse");
 if($('#brand option:selected').val() == '')
           {
              
              $("#errorMsg").css("display","inline");
              return false;
           }   
           if($('#web option:selected').val() == '')
           {
              
              $("#errorMsg1").css("display","inline");
              return false;
           }   
 var brand = $('#brand option:selected').val();
 var site_id = $('#web option:selected').val();
 
 var dataString = 'brand='+brand+'&site_id='+ site_id;
 //alert(dataString);
 $("#confirm").html("<p style='height:100%; margin-left:100px;' align='center'><img src='images/ajax-loader.gif' width='50' height='50' border='0' align='center' /></p>");
  $.ajax({
    type: "POST",
    url: "insertBrand.php",
    data: dataString,
    
    success: function() {
      $('#subcat').val('');
      $('#confirm').html("<span class=\"notification n-success\">Process Successfull</span>")
      .hide()
      .fadeIn(1500, function() {
        
      });
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

$( "#cat_parent" ).change(function() 
{ 

var dataString = 'cat_id='+this.value;
 //alert(dataString);
  $.ajax({
    type: "POST",
    url: "selSubcategory.php",
    data: dataString,
    
    success: function(result) {
      $('#loadSubCat').html(result);
     }
  });
return false;

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

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/?/g, '&nbsp;').replace(/?/g, '&deg;');
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

 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
