<?php
function resizeimgtojpeg ($sourceImage, $targetImage, $forcedWidth, $forcedHeight, $keepWHRatio = true, $jpegQuality = 75, $deleteOriginal = false)
{
	if(file_exists($sourceImage))
	{
		if ($keepWHRatio == true)
		{
			$sourceSize = getimagesize($sourceImage);
	
			// For a landscape picture or a square
			if ($sourceSize[0] >= $sourceSize[1])
			{
				$finalWidth = $forcedWidth;
				$finalHeight = ($forcedWidth / $sourceSize[0]) * $sourceSize[1];
			}
			// For a potrait picture
			else
			{
				$finalWidth = ($forcedHeight / $sourceSize[1]) * $sourceSize[0];
				$finalHeight = $forcedHeight;
			}
		}
		else
		{
			$finalWidth = $forcedWidth;
			$finalHeight = $forcedHeight;
		}
		
		$sourceID = imagecreatefromstring(file_get_contents($sourceImage));
		$targetID = imagecreatetruecolor($finalWidth, $finalHeight);
		$target_pic = imagecopyresampled($targetID, $sourceID, 0, 0, 0, 0 , $finalWidth, $finalHeight, $sourceSize[0], $sourceSize[1]);
		imagejpeg($targetID, $targetImage, $jpegQuality);
		imagedestroy($targetID);
		imagedestroy($sourceID);
		
		if ($deleteOriginal && file_exists($sourceImage))
		{ unlink($sourceImage); }
			
		return true;	
	}
	
	else { return false; }
}

if($_FILES["proPic"]["name"] != '')
{    
    $filename = $_FILES["proPic"]["name"];
    $tmp_name = $_FILES["proPic"]["tmp_name"];
    
    $extensions = array('.jpg', '.jpeg');
    
    $getExt = strtolower(strrchr($filename, '.'));
    $path = "../../img/customers/" . $filename;
    
    if( !empty( $filename ))
    {
      if(in_array( $getExt, $extensions))
      {        
        move_uploaded_file($tmp_name, $path);
        @copy($path, '../../img/customers/'.$filename);
        //resizeimgtojpeg('prod_images/prod_small_img/'.$filename, 'prod_images/prod_small_img/'.$filename, 300, 175);  
      }  
      else{
        echo 'File not Supported!'; 
    }
    }
}

if($_FILES["cat_img"]["name"] != '')
{    
    $filename = $_FILES["cat_img"]["name"];
    $tmp_name = $_FILES["cat_img"]["tmp_name"];
    
    $extensions = array('.jpg', '.jpeg');
    
    $getExt = strtolower(strrchr($filename, '.'));
    $path = "../images/category-images/" . $filename;
    
    if( !empty( $filename ))
    {
      if(in_array( $getExt, $extensions))
      {        
        move_uploaded_file($tmp_name, $path);
        @copy($path, '../images/category-images/'.$filename);
        //resizeimgtojpeg('prod_images/prod_small_img/'.$filename, 'prod_images/prod_small_img/'.$filename, 300, 175);  
      }  
      else{
        echo 'File not Supported!'; 
    }
    }
}  


if($_FILES["prod_main_img"]["name"] != '')
{    
    $category = str_replace(" ", "-", $_POST['cat_parent']);
    $upload_dir = "../images/product-images/".$category."/";
    $upload_dir_sub = "../images/product-images/".$category."/thumb/";
    
    $filename = $_FILES["prod_main_img"]["name"];
    $tmp_name = $_FILES["prod_main_img"]["tmp_name"];
    
    $extensions = array('.jpg', '.jpeg');
    
    $getExt = strtolower(strrchr($filename, '.'));
    $path = $upload_dir . $filename;
    
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);  //create directory if not exist
    }
    
    if( !empty( $filename ))
    {
      if(in_array( $getExt, $extensions))
      {        
        move_uploaded_file($tmp_name, $path);
        @copy($path, $upload_dir.$filename);
        if (!file_exists($upload_dir_sub)) {
          mkdir($upload_dir_sub, 0777, true);  //create directory if not exist
        }  
        resizeimgtojpeg($upload_dir.$filename, $upload_dir_sub.$filename, 85, 108);  
          
      }  
      else{
        echo 'File not Supported!'; 
    }
    }
}  

return true;

?>