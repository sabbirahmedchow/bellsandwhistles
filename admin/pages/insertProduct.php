<?php
session_start();
$_SESSION['path'] = "http://".$_SERVER['HTTP_HOST']."/demo/";

require_once 'classes/main.class.php';
$mainClsObj = mainClass ::getInstance();
    
$table = 'tb_product'; //table name

$revised_date = date("Y-m-d");
$prod_insert_date = date("Y-m-d h:i:s");
$language = "English";

$prSpec = $_REQUEST['prod_spec'];

$prSpec1 = str_replace("&amp;", "and", $prSpec);
$prSpec2 = str_replace("andnbsp;", "\t", $prSpec1);
$prSpec3 = str_replace("<strong>", "<b>", $prSpec2);
$prSpec4 = str_replace("</strong>", "</b>", $prSpec3);
$spec = str_replace("<table>", "<table width=60%>", $prSpec4);

$brandId = $_REQUEST['brand_id'];
$catId = $_REQUEST['cat_id'];
$subCatId = $_REQUEST['subcat_id'];
$subCatPageId = $_REQUEST['subcatpage_id'];
$prodName = $_REQUEST['prod_name'];
$prodSpec = $spec;
$prodAddInfo = $_REQUEST['prod_add_info'];
$prodImg = $_REQUEST['prod_img'];
$prodMSDS = $_REQUEST['prod_msds'];
//$msdsCode = $_REQUEST['msds_code'];
$prodPrice = $_REQUEST['prod_price'];
$ebayPrice = $_REQUEST['prod_Ebayprice'];
$prodLead = $_REQUEST['prod_lead'];
$prodSize = $_REQUEST['prod_size'];
$prodMeasure = $_REQUEST['prod_measure'];
$prodSKU = $_REQUEST['prod_sku'];
$prodMilSpec = $_REQUEST['prodMilSpec'];
$prodType = $_REQUEST['prodType'];
$prodSimilar = $_REQUEST['prodSimilar'];
$prodManufac = $_REQUEST['prodManufac'];

if($_REQUEST['ebay'] != '' && $_REQUEST['ebay'] == 1)
{
//upload product in ebay
$shipMethod = '';
$shipCost = '';
$shipAddCost = '';
if($prodMeasure == 'tote')
{
   $shipMethod = "FedExExpressSaver";
   $shipCost = "102.00";
   $shipAddCost = "89.00";
}
if($prodMeasure == 'kegs' || $prodMeasure == 'pails' || $prodMeasure == 'cases')
{
   $shipMethod = "FedExHomeDelivery";
   $shipCost = "32.00";
   $shipAddCost = "16.00";
}

$sandbox = false;
$compat_level = 753;
$api_endpoint = $sandbox ? 'https://api.sandbox.ebay.com/ws/api.dll' : 'https://api.ebay.com/ws/api.dll';
$dev_id = $sandbox ? "fbbe2aaf-741a-4397-a66f-634053f76df4" : "8efa4acc-3af1-4365-bd57-a8a7abef2b48";
$app_id = $sandbox ? "TestComp-9640-4099-bb10-8071d92abbc2" : "MilesLub-fb83-4312-bb07-7ebbf75b8818";
$cert_id = $sandbox ? "52d2b8ed-cb0d-4216-a930-cc31ec91758a" : "897471cb-497c-4646-987b-77a54ba2aaa1";
$auth_token = $sandbox ? "AgAAAA**AQAAAA**aAAAAA**K2MtUg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhCpiKqA+dj6x9nY+seQ**a1UCAA**AAMAAA**ENeG0Ivzkdu8+J6VnThe8u6xipp1pxkbZy/aQDu6UsQjhKKljNwJ6cRc5MhoesmRaRBeKPyn+WjzvCdJez1MfxS6Q7T3KPwmo+lu80F6/pBVGjh7JJFyqjiebx4PaowiyjLBttH8+xcEO4pSd0RDGSv7voC1uRyrP2xWZA5tF+Nz1WItDoyCzY69nozfew+4gQmHROcGEq8GL5jJg2v2KFy1VY9kVA2kB9rRHjexDKGigdxGEMnEzf3DG40CB+xtYPiBA8XuN2pY9NPLtPbua8WY/UGXLAtfew0sSEiiHtP5fWOsj62gHq3a6rmoBseoNuvbrlX3MfaIsD0viNA9p+nLzepDzrVvKHmCPca6LOcLTwl10liqmJcaRdyjRoWSsXYNxNfvJdt0EAbhWB2nP70S7tUickbbIoIz54fkl5bc8kFj3lb0JqqvG3FVEm3Lnko+AXbpf1eWZeKnhPHZ3ixwELh6kvzjZ+7iljpYeoCW5b9PdrZ8OUiO4a0EN533vFQL8l1LtUKLGXEq5BO0xL/MMFW4TLw2L0XCs59azlMgBJ9uLQhC0qVD79VpjzOcXQ7svuQf50JQOzTBaoHUuiyLm4rMJD+yMocde9wNsdm3030+lfXSV6Mwt4xM4iqt8RWnKWBTs5YwO7wPIpItZAJgcN3eBDGYdEi3yhkvRnxBOWk+6/k4it/5KqFsmzi2uZyL7cOA02B89BX/PU/ym4tKdhdJEgoijZFIbvDE32qeN/CMoi7ififm1XwZmaiS" : "AgAAAA**AQAAAA**aAAAAA**57ymVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AGk4OkAZmGqAmdj6x9nY+seQ**MaQCAA**AAMAAA**4CaFBg6EuSseuM3UWK1lf576LVKWXmLVoDcL7Zw+xfUwsUSzaATQLY9WIdrEns0XQ0nmncY6Dw5gfjyXA4DM0Pcvo6LLOnQcTKldQFPyhQvqBLOaXjz/cYuB83GYOd2EwKCivCLep7UvzjwZWyqQC0iAGcR6dMlHnCJidnXbHnAvXDlqEwB0xQ1G3ZFKejjc08vjtuMOi7rFv8D1jYVM5Qp28wb8NYkIRvUw8duJNvL30TcCySmle9oRnih8wdcUNwJqcOeQdPAHLDyhr5OLLdFlsZcVF0sBclehm7qcPm5PASyd2anlLlK72u+DFX8E3uidvGUSYiGpww/5lU2uw2SPdDsXnMbYb6f2UP1rq+AHT+UZB3lBoOBBOYKl/id5VnKG7IEz+m9eY6RSeL7PUKUhDIvj/aJQN1dJus5jvaro/3DA1Fp8zEYkzdYONqwDFJtSJNmJTigrl2vJQfHRoR6s3djbFtf8CL/FI2SV/e4hrS8ZdSceJh34+JTOwzH4VhFaS84jDU5pTDHZtbvBlF3+YEly42P4mn4uGFdnp7qBEzGpSD73yGStnfGpDM+HnOhw9d8Mj687Am+bOY+h10sQ2VBBvVKVSx7Szmu2yK9hcXOC5cbZZK3U9IZukhbVvRtpuWTuG3nCvQPcqsdREG+QPSncfpis9+i2jCXhn7L7346yJ4rP0AweveT7K6BKZTQzoi3JsmGFYhBl+qfzJpTBei8FbO1sjRMre7yejw1gaIkJ9U2DjPk9b0maP/rw";

$site_id = 0;
  $call_name = 'AddFixedPriceItem';
  
  //$call_name = 'GetCategories';

// Create headers to send with CURL request.
$headers = array 
(
     'X-EBAY-API-COMPATIBILITY-LEVEL: ' . $compat_level,
     'X-EBAY-API-DEV-NAME: ' . $dev_id,
     'X-EBAY-API-APP-NAME: ' . $app_id,
     'X-EBAY-API-CERT-NAME: ' . $cert_id,
     'X-EBAY-API-CALL-NAME: ' . $call_name, 
     'X-EBAY-API-SITEID: ' . $site_id,
);

// Generate XML request
$xml_request = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
     <".$call_name."Request xmlns=\"urn:ebay:apis:eBLBaseComponents\">

     <RequesterCredentials>
          <eBayAuthToken>" . $auth_token . "</eBayAuthToken>
     </RequesterCredentials>
       <ErrorLanguage>en_US</ErrorLanguage>
       <WarningLevel>High</WarningLevel>
     <Item>
    <Title>".$prodName."</Title>
    <Description>".$prodSpec."</Description>
    <StartPrice>".$ebayPrice."</StartPrice>
    <ConditionID>1000</ConditionID>
    <Country>US</Country>
    <Currency>USD</Currency>
    <DispatchTimeMax>3</DispatchTimeMax>
    <ListingDuration>GTC</ListingDuration>
    <ListingType>FixedPriceItem</ListingType>
    <PaymentMethods>PayPal</PaymentMethods>
    <PayPalEmailAddress>vivanov@mileslubricants.com</PayPalEmailAddress>
    <PrimaryCategory>
      <CategoryID>57114</CategoryID>
    </PrimaryCategory>
    
    <PictureDetails>
      <GalleryType>Gallery</GalleryType>
     <PictureURL>http://www.avepetroleum.com/admin/prod_images/$prodImg</PictureURL>
    </PictureDetails>
    <PostalCode>11735</PostalCode>
 
    <Quantity>1000</Quantity>
    <ReturnPolicy>
      <ReturnsAcceptedOption>ReturnsAccepted</ReturnsAcceptedOption>
      <RefundOption>MoneyBack</RefundOption>
      <ReturnsWithinOption>Days_14</ReturnsWithinOption>
      <Description>If you are not satisfied, return the item for refund.</Description>
      <ShippingCostPaidByOption>Buyer</ShippingCostPaidByOption>
      <RestockingFeeValueOption>Percent_20</RestockingFeeValueOption>
    </ReturnPolicy>
    
    <ShippingDetails>
      
      <ShippingServiceOptions>
        <FreeShipping>false</FreeShipping>
        <ShippingServicePriority>1</ShippingServicePriority>
        <ShippingService>$shipMethod</ShippingService>
        <ShippingServiceCost currencyID='USD'>$shipCost</ShippingServiceCost>
        <ShippingServiceAdditionalCost currencyID='USD'>$shipAddCost</ShippingServiceAdditionalCost>
      </ShippingServiceOptions>
      <ShippingType>Flat</ShippingType>
    </ShippingDetails>
    
    
    <ShipToLocations>US</ShipToLocations>
    <ShipToLocations>CA</ShipToLocations>
    <ShipToLocations>UK</ShipToLocations>
    <ShipToLocations>AU</ShipToLocations>
    <ShipToLocations>GR</ShipToLocations>
    <ShipToLocations>JP</ShipToLocations>
    <ShipToLocations>CN</ShipToLocations>
    <ShipToLocations>RU</ShipToLocations>
    <ShipToLocations>MX</ShipToLocations>
    
    <Site>US</Site>
  </Item>
     </".$call_name."Request>";
//echo $xml_request."<br/><br/>";
//exit;
//return false;
// Send request to eBay and load response in $response
  $connection = curl_init();
  curl_setopt($connection, CURLOPT_URL, $api_endpoint);
  curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($connection, CURLOPT_POST, 1);
  curl_setopt($connection, CURLOPT_POSTFIELDS, $xml_request);
  curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($connection);
  //print_r($response);
  curl_close($connection);
  //echo $response;
}


$prodData = array(
       
      "name" => $prodName,
      "additional_info" => $prodAddInfo,
      "specification" => $prodSpec,
      "price" => $prodPrice,
      "lead_time" => $prodLead,
      "image_small" => $prodImg,
      "image_large" => $prodImg,
      "insert_datetime" => $prod_insert_date,
      "show_similar_product" => $prodSimilar,
      "status" => $prodType
  );

//pc_debug("Spec is: ".$prodSpec, __FILE__, __LINE__);

try {
  
  $prodId = $mainClsObj->saveData($table,$prodData);
  
} catch(Exception $e){
$is_error = 1;
echo $is_error;
}

$table = 'tb_product_msds'; //table name

$prodData = array(
    
    "product_id" => $prodId,
    "msds_code" => $msdsCode,
    "msds_doc" => $prodMSDS,
    "revised_date" => $revised_date,
    "language" => $language
);

try {
  
  $msds_id = $mainClsObj->saveData($table,$prodData);
  
} catch(Exception $e){
$is_error = 1;
echo $is_error;
}

$table = 'tb_product_attributes'; //table name

$prodData = array(
    
    "product_size" => $prodSize,
    "prod_measure" => $prodMeasure
);

try {
  
  $attr_id = $mainClsObj->saveData($table,$prodData);
  
} catch(Exception $e){
$is_error = 1;
echo $is_error;
}


$table = 'tb_product_manufacturer'; //table name

$manufacData = array(
    
    "product_id" => $prodId,
    "manufacturer" => $prodManufac
);

try {
  
  $mainClsObj->saveData($table,$manufacData);
  
} catch(Exception $e){
$is_error = 1;
echo $is_error;
}

$table = 'tb_product_milispec_relation'; //table name

$prodDataMil = array(
    
    "product_id" => $prodId,
    "mili_spec_num" => $prodMilSpec
);

try {
  
  $mainClsObj->saveData($table,$prodDataMil);
  
} catch(Exception $e){
$is_error = 1;
echo $is_error;
}



$table = 'tb_product_attributes_relation'; //table name

$prodData = array(
    
    "product_id" => $prodId,
    "attribute_id" => $attr_id
);

try {
  
  $insertRow = $mainClsObj->saveData($table,$prodData);
  
} catch(Exception $e){
$is_error = 1;
echo $is_error;
}

$table = 'tb_category_product_relation'; //table name

$prodData = array(
    
    "product_id" => $prodId,
    "brand_id" => $brandId,
    "category_id" => $catId,
    "subcategory_id" => $subCatId,
    "subcatpage_id" => $subCatPageId
);


  $insertRow = $mainClsObj->saveData($table,$prodData);
  
  

 if($_POST['gcs'] != '' && $_POST['gcs'] == 1)
 {
     
  //start sending data to google shopping
  
  // Get the user credentials
$prodLink = "http://www.milesoil.us/demo/product_details.php?prodId=".$prodId;
$imgLink = $_SESSION['path']."admin/prod_images/prod_small_img/".$prodImg;


include('GShoppingContent.php');    
$creds = Credentials::get();

// Create a client for our merchant and log in
$client = new GSC_Client($creds["merchantId"]);
$client->login($creds["email"], $creds["password"]);

// Now enter some product data

$product = new GSC_Product();
$product->setSKU("$prodSKU");
$product->setProductLink("$prodLink");
$product->setTitle("$prodName");
$product->setPrice("$prodPrice", "usd");
$product->setImageLink("$imgLink");
$product->setAdult("false");
$product->setCondition("new");
$product->setAvailability("in stock");

//$shippingService = "Speedy Shipping - Ground";
$product->addShipping("US", "NY", "0.01", "USD", "n");
$product->addTax("US", "NY", "0.00", "n");

// Finally send the data to the API
try
{
$entry = $client->insertProduct($product);
//echo('Inserted: ' . $entry->getTitle() . "\n");
}catch(Exception $e){
    return "insert failed";
}

/**
 * Credentials - Enter your own values
 *
 * @author afshar@google.com
**/
class Credentials {
    public static function get() {
        return array(
            "merchantId" => "9748608",
            "email" => "sabbirahmedchowdhury@gmail.com",
            "password" => "peachshirt263",
        );
    }
}
}

if($_POST['amp1'] != '' && $_POST['amp1'] == 1)
{
// Create DOM object and load eBay response
//  $dom = new DOMDocument();
//$dom->loadXML($response);
//
//// Parse data accordingly.
//  $ack = $dom->getElementsByTagName('Ack')->length > 0 ? $dom->getElementsByTagName('Ack')->item(0)->nodeValue : '';
//  //$eBay_official_time = $dom->getElementsByTagName('Timestamp')->length > 0 ? $dom->getElementsByTagName('Timestamp')->item(0)->nodeValue : '';
//$dom->formatOutput = true;
//$xmlStr = $dom->saveXML();
//echo $xmlStr;

//upload product to amazon mws

include_once ('amazon/Samples/config.inc.php'); 

$serviceUrl = "https://mws.amazonservices.com";

$config = array (
  'ServiceURL' => $serviceUrl,
  'ProxyHost' => null,
  'ProxyPort' => -1,
  'MaxErrorRetry' => 3,
);

$service = new MarketplaceWebService_Client(AWS_ACCESS_KEY_ID,AWS_SECRET_ACCESS_KEY,$config,APPLICATION_NAME,APPLICATION_VERSION);

$feed = <<<EOD
<?xml version="1.0" encoding="utf-8"?>
    <AmazonEnvelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="amzn-envelope.xsd">
      <Header>
        <DocumentVersion>1.01</DocumentVersion>
          <MerchantIdentifier>M_EXAMPLE_123456</MerchantIdentifier>
     </Header>
     <MessageType>Product</MessageType>
     <PurgeAndReplace>false</PurgeAndReplace>
     <Message>
      <MessageID>1</MessageID>
      <OperationType>Update</OperationType>
      <ProductImage>
        <ImageType>Main</ImageType>
        <ImageLocation>www.abcde.com/image.jpg</ImageLocation>
      </ProductImage>
     <Product>
      <SKU>$prodSKU</SKU>
      <StandardProductID>
       <Type>ASIN</Type>
       <Value>B0EXAMPLEG</Value>
      </StandardProductID>
      <ProductTaxCode>A_GEN_NOTAX</ProductTaxCode>
     <DescriptionData>
      <Title>$prodName</Title>
      <Brand>Petroleum & Lubricants</Brand>
      <Description>$prodName</Description>
      
      <MSRP currency="USD">$prodPrice</MSRP>
      <Manufacturer>Miles Petroleum Co, Inc.</Manufacturer>
      
     </DescriptionData>
     <ItemDimensions>
<Length unitOfMeasure="IN">10.51</Length>
<Width unitOfMeasure="IN">10.51</Width>
<Height unitOfMeasure="IN">1.42</Height>
</ItemDimensions>     

    </Product>
 </Message>
</AmazonEnvelope> 
EOD;

$feedHandle = @fopen('php://memory', 'rw+');
fwrite($feedHandle, $feed);
rewind($feedHandle);

$request = new MarketplaceWebService_Model_SubmitFeedRequest();
$request->setMerchant(MERCHANT_ID);
$request->setMarketplaceIdList("ATVPDKIKX0DER");
$request->setFeedType('_POST_PRODUCT_DATA_');
$request->setContentMd5(base64_encode(md5(stream_get_contents($feedHandle), true)));
rewind($feedHandle);
$request->setPurgeAndReplace(false);
$request->setFeedContent($feedHandle);

rewind($feedHandle);

invokeSubmitFeed($service, $request);

@fclose($feedHandle);

function invokeSubmitFeed(MarketplaceWebService_Interface $service, $request) 
  {
      try {
              $response = $service->submitFeed($request);
              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        SubmitFeedResponse\n");
                if ($response->isSetSubmitFeedResult()) { 
                    echo("            SubmitFeedResult\n");
                    $submitFeedResult = $response->getSubmitFeedResult();
                    if ($submitFeedResult->isSetFeedSubmissionInfo()) { 
                        echo("                FeedSubmissionInfo\n");
                        $feedSubmissionInfo = $submitFeedResult->getFeedSubmissionInfo();
                        if ($feedSubmissionInfo->isSetFeedSubmissionId()) 
                        {
                            echo("                    FeedSubmissionId\n");
                            echo("                        " . $feedSubmissionInfo->getFeedSubmissionId() . "\n");
                        }
                        if ($feedSubmissionInfo->isSetFeedType()) 
                        {
                            echo("                    FeedType\n");
                            echo("                        " . $feedSubmissionInfo->getFeedType() . "\n");
                        }
                        if ($feedSubmissionInfo->isSetSubmittedDate()) 
                        {
                            echo("                    SubmittedDate\n");
                            echo("                        " . $feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT) . "\n");
                        }
                        if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
                        {
                            echo("                    FeedProcessingStatus\n");
                            echo("                        " . $feedSubmissionInfo->getFeedProcessingStatus() . "\n");
                        }
                        if ($feedSubmissionInfo->isSetStartedProcessingDate()) 
                        {
                            echo("                    StartedProcessingDate\n");
                            echo("                        " . $feedSubmissionInfo->getStartedProcessingDate()->format(DATE_FORMAT) . "\n");
                        }
                        if ($feedSubmissionInfo->isSetCompletedProcessingDate()) 
                        {
                            echo("                    CompletedProcessingDate\n");
                            echo("                        " . $feedSubmissionInfo->getCompletedProcessingDate()->format(DATE_FORMAT) . "\n");
                        }
                    } 
                } 
                if ($response->isSetResponseMetadata()) { 
                    echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        echo("                RequestId\n");
                        echo("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                } 

                echo("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
     } catch (MarketplaceWebService_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
         echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
     }
 }

}

?>