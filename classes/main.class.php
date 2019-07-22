<?php
error_reporting(1);
session_start();
require_once('SimpleConfig.php');
require_once('mysqldatabase.php');
require_once('mysqlresultset.php');
require_once('class.phpmailer.php');

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

SimpleConfig::setFile('D:/xampp/htdocs/bells&whistles/connection/config.php');

    
     //SimpleConfig::setFile('E:/wamp/www/milesoil/html_new1/connection/config.php');
     
    class mainClass {

        public $connection;
        public $db;
        public $config;

        private static $instance;
        
        /**
         * 
         */
        private function __construct(){
            $this->config = SimpleConfig :: getInstance();
            $this->db = MySqlDatabase :: getInstance();
            $this->connection = $this->db->connect($this->config->host, $this->config->user, $this->config->password,$this->config->database,true);
        } // __construct

        /**
         *
         * @return type 
         */
        public static function getInstance(){
            if (!isset(self::$instance)) {
                self::$instance = new mainClass;
            }
            return self::$instance;
        } // getInstance

        /**
         * 
         */
        public function closeConnection(){
            mysql_close($this->connection);
        }
        
         function generateRegistrationCode($length=9, $strength=8) {
            $vowels = 'aeuy';
            $consonants = 'bdghjmnpqrstvz';
            if ($strength & 1) {
                    $consonants .= 'BDGHJLMNPQRSTVWXZ';
            }
            if ($strength & 2) {
                    $vowels .= "AEUY";
            }
            if ($strength & 4) {
                    $consonants .= '23456789';
            }
            if ($strength & 8) {
                    $consonants .= '@#$%';
            }

            $code = '';
            $alt = time() % 2;
            for ($i = 0; $i < $length; $i++) {
                    if ($alt == 1) {
                            $code .= $consonants[(rand() % strlen($consonants))];
                            $alt = 0;
                    } else {
                            $code .= $vowels[(rand() % strlen($vowels))];
                            $alt = 1;
                    }
            }
            return $code;
        }
        
        
         public function getUserInformation($userEmail){
            $rows = array(); 
            $sql = "select * from tb_customer where email = '$userEmail'";
            //pc_debug("SQL = $sql",__FILE__,__LINE__);
            $result = mysql_query($sql);
            $res = mysql_fetch_array($result);
            //$full_name = $res['first_name']." ".$res['last_name'];
            array_push($rows,$res);
            return $rows;
        }
        
		
		/**
		* CHECK USER
		* VALID OR NOT
		*/
        public function isValidUser($userEmail,$password){
            $password = md5($password);
            $sql = "select count(*) from tb_customer where email =  '$userEmail' and password = '$password'";
            //pc_debug("SQL = $sql",__FILE__,__LINE__);
            $result = $this->db->fetchOne($sql);
            if($result == 1)
            {
                $sql = "select count(*) from tb_customer where email =  '$userEmail' and password = '$password' and is_active = 1";
                $result_active = $this->db->fetchOne($sql);
                if($result_active == 1)
                {
                  return $result_active;
                }
                else
                {
                    $result_active = "not active user";
                    return $result_active;
                }
            }
            return $result;
        }
        
        
        
        /* Insert Data SQL */
		public function build_sql_insert($table, $data) {
			$key = array_keys($data);
			$val = array_values($data);
			$sql = "insert into $table (" . implode(', ', $key) . ") " . "values ('" . implode("', '", $val) . "')";
		        //$sql = "insert into $table ($key)values ($val))";
			return($sql);
		}
		
		/* Update Data SQL */
		public function build_sql_update($table, $dataArr,$conditionArr) {
			$key = array_keys($dataArr);
			$val = array_values($dataArr);
			$sql = "update $table set";
			
			for($i=0; $i<sizeof($dataArr);$i++){
				if($i>0){
					$sql .= ",";
				}
				$sql .= " ".$key[$i]."='".$val[$i]."'";
			}
			
			if($conditionArr != NULL){
				$condition_key = array_keys($conditionArr);
				$condition_val = array_values($conditionArr);
				
				$sql .= " where";
				for($j=0; $j<sizeof($conditionArr);$j++){
					if($j>0){
						$sql .= " and";
					}
					$sql .= " ".$condition_key[$j]."='".$condition_val[$j]."'";
				}
			}
			
			return($sql);
		}
		
		/* Get Data SQL */
		public function build_sql_get($table, $conditionArr=NULL, $orderArr=NULL, $relationTableArr=NULL ) {
			
			
			// inner join
			if($relationTableArr != NULL){  //array('tb'=>'re')
				$count = 0;
				$sql = "select tb.*";
				
				foreach($relationTableArr as $key => $val){ //$key = relation table name ## $val = column name
					$count = $count + 1;
					$sql .= ", rtb_$count.*"; // For multiple inner join selection
				}
				 
				$sql .= " from $table tb";
				
				$count = 0;
				$prev_count = 0;
				foreach($relationTableArr as $key => $val){
					
					$searchRelationTable = strrev(strtok(strrev($key),'_'));
					$count = $count + 1;
					
					if($count == 1 || $searchRelationTable === 'relation'){
						$sql .= " inner join " . $key . " rtb_$count on rtb_$count." . $val . " = tb." . $val;
					} else {
						$prev_count = $count-1;
						$sql .= " inner join " . $key . " rtb_$count on rtb_$count." . $val . " = rtb_$prev_count." . $val;
						
					}
					
				}
			} else {
				$sql = "select * from $table";
			}
			
			// where clause
			if($conditionArr != NULL){
				$condition_key = array_keys($conditionArr);
				$condition_val = array_values($conditionArr);
				
				$sql .= " tb where";
				for($j=0; $j<sizeof($conditionArr);$j++){
					if($j>0){
						$sql .= " and";
					}
					$sql .= " tb.".$condition_key[$j]."='".$condition_val[$j]."'";
				}
			}
			
			//order by
			if($orderArr != NULL){
				$order_key = array_keys($orderArr);
				$order_val = array_values($orderArr);
				
				$sql .= " order by";
				for($j=0; $j<sizeof($orderArr);$j++){
					if($j>0){
						$sql .= ", ";
					}
					//pc_debug("order ## $order_key[$j]",__FILE__,__LINE__);
					$sql .= " tb.".$order_key[$j]." ".$order_val[$j];
				}
			}
			//echo $sql;
			return($sql);
		}
		
		/* Count Data SQL */
		public function build_sql_count($table, $conditionArr=NULL, $orderArr=NULL, $relationTableArr=NULL ) {
			
			
			// inner join
			if($relationTableArr != NULL){  //array('tb'=>'re')
				$count = 0;
				$sql = "select count(tb.*)";
				$sql .= " from $table tb";
				
				$count = 0;
				$prev_count = 0;
				foreach($relationTableArr as $key => $val){
					
					$searchRelationTable = strrev(strtok(strrev($key),'_'));
					$count = $count + 1;
					
					if($count == 1 || $searchRelationTable === 'relation'){
						$sql .= " inner join " . $key . " rtb_$count on rtb_$count." . $val . " = tb." . $val;
					} else {
						$prev_count = $count-1;
						$sql .= " inner join " . $key . " rtb_$count on rtb_$count." . $val . " = rtb_$prev_count." . $val;
					}
					
				}
			} else {
				$sql = "select count(*) from $table";
			}
			
			// where clause
			if($conditionArr != NULL){
				$condition_key = array_keys($conditionArr);
				$condition_val = array_values($conditionArr);
				
				$sql .= " where";
				for($j=0; $j<sizeof($conditionArr);$j++){
					if($j>0){
						$sql .= " and";
					}
					$sql .= " ".$condition_key[$j]."='".$condition_val[$j]."'";
				}
			}
			
			//order by
			if($orderArr != NULL){
				$order_key = array_keys($orderArr);
				$order_val = array_values($orderArr);
				
				$sql .= " order by";
				for($j=0; $j<sizeof($conditionArr);$j++){
					if($j>0){
						$sql .= ", ";
					}
					$sql .= " ".$order_key[$j]." ".$order_val[$j];
				}
			}
			
			return($sql);
		}
		
		/**************************************************************************************************************************************/
		/**************************************************************************************************************************************/
		
		/* Insert Data*/
		public function saveData($table,$dataArr,$relationTableArr=NULL,$column_name=NULL){
			
			$sql = $this->build_sql_insert($table,$dataArr);
			//pc_debug("SQL # $sql",__FILE__,__LINE__);
			$result = $this->db->insert($sql);
			$insert_id = mysql_insert_id();
			//pc_debug("insert Id ## $insertId",__FILE__,__LINE__);
			
			if($relationTableArr != NULL && $column_name != NULL){
				
				foreach($relationTableArr as $relationTable => $relationRow){
					foreach($relationRow as $relationColumn => $relationDataArr){
						foreach($relationDataArr as $relationData){
							$dataArrList = array(); // restructured array for each element
							$dataArrList[$column_name] = $insert_id;
							$dataArrList[$relationColumn] = $relationData;
							
							//print_r($dataArrList);
							
							$sql = $this->build_sql_insert($relationTable,$dataArrList);
							pc_debug("SQL # $sql",__FILE__,__LINE__);
							$result = $this->db->insert($sql);
						}
					}
				}
				//exit;
			}
			
			return $insert_id;
		}
		
		/* Update Data*/
		public function updateData($table,$dataArr,$conditionArr=NULL){   //,$relationTableArr=NULL
			
			$sql = $this->build_sql_update($table,$dataArr,$conditionArr);
			//pc_debug("SQL # $sql",__FILE__,__LINE__);
			$result = $this->db->update($sql);
		}
		
		/* Get Data*/
		public function getData($table,$conditionArr=NULL,$orderArr=NULL,$relationTableArr=NULL){
			
			$sql = $this->build_sql_get($table,$conditionArr,$orderArr,$relationTableArr);
			//pc_debug("SQL # $sql",__FILE__,__LINE__);
			$result = $this->db->query($sql);
				
			$rows = array();			
			while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
				array_push($rows,$row);			
			}
			if(sizeof($rows) > 0){
				return $rows;
			}else {
				return false;
			}
		}
		
		/* Count Data*/
		public function countData($table,$conditionArr=NULL,$orderArr=NULL,$relationTableArr=NULL){
            $sql = $this->build_sql_count($table,$conditionArr,$orderArr,$relationTableArr);
            	$result1 = $this->db->fetchOne($sql);
                        //$rows = mysql_num_rows($result1);
            return $result1;
        } 
        
        
        
        public function generateRand($str)
        {
           $characters = '1234567890';
           $string = '';
           for ($i = 0; $i < $str; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];

         }
         return $string;
        }
        
        public function sendRegisterEmailConfirm($userId, $uMail, $code)
        {
            
            $subject = "Confirm your registration with Bells and Whistles";
            $body = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 30px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .block-rounded {
      border-radius: 5px;
      border: 1px solid #e5e5e5;
      vertical-align: top;
    }

    .button {
      padding: 55px 0 0;
    }

    .info-block {
      padding: 0 20px;
      width: 260px;
    }

    .mini-block-container {
      padding: 30px 50px;
      width: 500px;
    }

    .mini-block {
      background-color: #ffffff;
      width: 498px;
      border: 1px solid #cccccc;
      border-radius: 5px;
      padding: 60px 75px;
    }

    .block-rounded {
      width: 260px;
    }

    .info-img {
      width: 258px;
      border-radius: 5px 5px 0 0;
    }

    .force-width-img {
      width: 480px;
      height: 1px !important;
    }

    .force-width-full {
      width: 600px;
      height: 1px !important;
    }

    .user-img img {
      width: 82px;
      border-radius: 5px;
      border: 1px solid #cccccc;
    }

    .user-img {
      width: 92px;
      text-align: left;
    }

    .user-msg {
      width: 236px;
      font-size: 14px;
      text-align: left;
      font-style: italic;
    }

    .code-block {
      padding: 10px 0;
      border: 1px solid #cccccc;
      width: 20px;
      color: #4d4d4d;
      font-weight: bold;
      font-size: 18px;
    }

     .mini-img {
      padding: 5px;
      width: 140px;
    }

    .mini-img img {
      border-radius: 5px;
      width: 140px;
    }

    .mini-imgs {
      padding: 25px 0 30px;
    }

    .progress-bar {
      padding: 0 15px 0;
    }

    .step {
      vertical-align: top;
    }

    .step img {
      width: 109px;
      height: 78px;
    }

    .active {
      font-weight: bold;

    }

  </style>

  <style type="text/css" media="screen">
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type="text/css" media="screen">
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: &#39;Oxygen&#39;, &#39;Helvetica Neue&#39;, &#39;Arial&#39;, &#39;sans-serif&#39; !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*="container-for-gmail-android"] {
        min-width: 290px !important;
        width: 100% !important;
      }

      table[class="w320"] {
        width: 320px !important;
      }

      td[class*="mobile-header-padding-left"] {
        width: 160px !important;
      }

      img[class="force-width-gmail"] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      td[class="mobile-block"] {
        display: block !important;
      }

      td[class="mini-img"],
      td[class="mini-img"] img{
        width: 150px !important;
      }

      td[class*="mobile-header-padding-left"] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*="mobile-header-padding-right"] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class="header-lg"] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class="header-md"] {
        font-size: 18px !important;
        padding-bottom: 5px !important;
      }

      td[class="content-padding"] {
        padding: 5px 0 30px !important;
      }

       td[class="button"] {
        padding: 5px !important;
      }

      td[class*="free-text"] {
        padding: 10px 18px 30px !important;
      }

      img[class="force-width-img"],
      img[class="force-width-full"] {
        display: none !important;
      }

      td[class="info-block"] {
        display: block !important;
        width: 280px !important;
        padding-bottom: 40px !important;
      }

      td[class="info-img"],
      img[class="info-img"] {
        width: 278px !important;
      }

      td[class="mini-block-container"] {
        padding: 8px 20px !important;
        width: 280px !important;
      }

      td[class="mini-block"] {
        padding: 20px 0 !important;
      }

      td[class*="step"] img {
        width: 86px !important;
        height: 62px !important;
      }

      td[class="progress-bar"] {
        padding: 0 11px 25px;
      }

      td[class="user-img"] {
        display: block !important;
        text-align: center !important;
        width: 100% !important;
        padding-bottom: 10px;
      }

      td[class="user-msg"] {
        display: block !important;
        padding-bottom: 20px;
      }
    }
  </style>
</head>

<body bgcolor="#f7f7f7">
<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%">
  <tr>
    <td align="left" valign="top" width="100%" style="background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;">
      <center>
       <img src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" class="force-width-gmail">
        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
          <tr>
            <td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
            <!--[if gte mso 9]>
            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:80px; v-text-anchor:middle;">
              <v:fill type="tile" src="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" color="#ffffff" />
              <v:textbox inset="0,0,0,0">
            <![endif]-->
              <center>
                <table cellpadding="0" cellspacing="0" width="600" class="w320">
                  <tr>
                    <td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
                      <a href="http://www.bellsandwhistles.com.bd" target="_blank"><img src="http://www.bellsandwhistles.com.bd/img/logo.png" alt="Bells and Whistles" title="Bells and Whistles" width="280" border="0" align="center" /></a>
                    </td>
                    <td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;">
                      <a href=""><img width="44" height="47" src="http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif" alt="twitter" /></a>
                      <a href=""><img width="38" height="47" src="http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif" alt="facebook" /></a>
                      
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
              Almost done!
            </td>
          </tr>
          <tr>
            <td class="free-text">
              There&#39;s one last step until your account is 100% ready. We need you to verify your email.
            </td>
          </tr>
          <tr>
            <td class="mini-block-container">
              <table cellspacing="0" cellpadding="0" width="100%"  style="border-collapse:separate !important;">
                <tr>
                  <td class="mini-block">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td class="progress-bar">
                          <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>

                              <!-- STEP ONE -->
                              <td class="step">
                                <img src="http://s3.amazonaws.com/swu-filepicker/0oYLLViRBKv7a0Lzh6vC_v3_03.jpg" alt="step one" /><br />
                                Create Account
                              </td>

                               <!-- STEP TWO -->
                              <td class="step active">
                                <img src="http://s3.amazonaws.com/swu-filepicker/YL3H3V5bRyGuy6pess9T_v33_04.jpg" alt="step one" /><br />
                                Verify Email
                              </td>

                               <!-- STEP THREE -->
                              <td class="step">
                                <img src="http://s3.amazonaws.com/swu-filepicker/YSTlgtgaTSa897tPTUhl_v3_05.jpg" alt="step one" />
                                Complete
                              </td>

                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td class="button">
                          <div><!--[if mso]>
                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#ff6f6f">
                              <w:anchorlock/>
                              <center style="color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">Update Account</center>
                            </v:roundrect>
                          <![endif]--><a href="http://www.bellsandwhistles.com.bd/confirmUser?customer='.$userId.'&code='.$code.'" target="_blank"
                          style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:&#39;Cabin&#39;, Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Verify Account</a></div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>

  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td style="padding: 25px 0 25px">
              <strong>Bells and Whistles.</strong><br />
              Road # 30, House # 16, Sector # 07, Uttara, Dhaka <br />
              Bangladesh <br /><br />
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
</table>
</body>
</html>';
            //$body = '<table border="0" width="100%" cellspacing="5" cellpadding="4">
            //<tr><td align="left"><img src="http://www.bellsandwhistles.com.bd/img/logo.png" alt="Bells and Whistles" title="Bells and Whistles" width="358" height="44" border="0" align="left" /></td></tr>
            //<tr><td>&nbsp;</td></tr>
            //<tr><td> Thank you for registering with us.</td></tr>
            //<tr><td>Click the link to confirm your registration: 
            //<a href="http://www.bellsandwhistles.com.bd/confirmUser?customer='.$userId.'&code='.$code.'" target="_blank">Confirm Registration</a></td></tr>
            //</table>';
            
           $mail = new PHPMailer();
            
            

           $mail->Host = 'smppout.secureserver.net';
           $mail->Port = 80;
            
           $mail->SetFrom("info@bellsandwhistles.com.bd", "Bells and Whistles");
           $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test


    //        error_log("mail address is =$address");

            // $mail->AddAddress($address, "Mahbubur Rahman");
            //$mail->AddAddress($address);
            $mail->AddAddress("$uMail");
            try {
    //            error_log("Subject is (2nd Time) = $subject");
                $mail->Subject = (string)$subject;
    //            error_log("Subject is (3rd Time)= $subject");
                $mail->MsgHTML($body);
                $mail->Send();  
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
                echo $e->getMessage(); //Boring error messages from anything else!
            }

           return true;       
        }
        
        
        public function insertOrderWithAddress($postData)
        {
          extract($postData, EXTR_PREFIX_SAME, "wddx");
          //extract($cookieData, EXTR_PREFIX_SAME, "wddx"); 
          
          $sql = "INSERT INTO tb_billing values('','$bill_f_name','$bill_l_name','$bill_addr1','$bill_addr2','$bill_city','$bill_state','$bill_zip','$bill_phone')";  
          mysql_query($sql);
          return false;    
          $last_billing_id = mysql_insert_id();
                    
          $sql = "INSERT INTO tb_user_shipping_address values('','$ship_f_name','$ship_l_name','$ship_addr1','$ship_addr2','$ship_city','$ship_state','$ship_zip','$ship_phone')";  
          mysql_query($sql);
          $last_shipping_id = mysql_insert_id();
          
          for($j=1; $j<=$NumberOrdered; $j++)
          {
           $orders = $_COOKIE['Order_'.$j];
           $prodType[] = $_COOKIE['ship_'.$j];
           $data = explode("|", $orders);
           for($i=0; $i<1; $i++)
           {
            $prod_name[] = $data[3];
            $prod_quant[] = $data[1];
            $prod_unit_price[] = $data[2];
            $prod_manufac[] = $data[6];
           }
          }
          $orderId = $this->generateRand(12);
          $taxrate = $_COOKIE['taxRate'];
          for($x=0; $x<sizeof($prod_name); $x++)
          {
            $datetime = date('Y-m-d h:i:s');
            //$amount  = $TotalAmount/$prod_quant[$x];
            $amount = $prod_unit_price[$x] - ($prod_unit_price[$x] * ($_COOKIE['discount'] / 100));
            $sql = "INSERT INTO tb_order values('', '$orderId', '', '$datetime', $prod_manufac[$x], '$prod_name[$x]', '$prod_quant[$x]', '$prodType[$x]', '$amount', 'Order Received', 0, 0, 2, '$sp_inst', 'Select', $taxrate)";
            mysql_query($sql);
            //$lastId[] = mysql_insert_id();
            
            $sql = "INSERT INTO tb_order_billing_relation values('$orderId',$last_billing_id)";
            mysql_query($sql);  
            
            $sql = "INSERT INTO tb_order_shipping_relation values('$orderId',$last_shipping_id)";
            mysql_query($sql);
            
            $sql = "INSERT INTO tb_user_order_relation values($_SESSION[user_id],'$orderId')";
            mysql_query($sql);
              
          }
                           
          return $orderId;
          
        }        
        
        public function orderComplete($transId,$orderId)
        {
           if($transId != '')
           {    
            $sql = "UPDATE tb_order SET transaction_id='$transId', order_placed=1 where order_id='$orderId'";
           }
           else
           {
            $sql = "UPDATE tb_order SET order_placed=1 where order_id='$orderId'";   
           }    
           mysql_query($sql);
           $sql1 = "UPDATE tb_user_estimate SET completed=1 where order_id='$orderId'";   
           mysql_query($sql1);
        }   
        
        public function search($srch)
        {
            $rows=array();
            $sql = "select * from tb_product where name LIKE '%$srch%' OR specification LIKE '%$srch%'";
            $r = mysql_query($sql);
            while($res = mysql_fetch_array($r))
            {
              array_push($rows,$res);  
            }    
            return $rows;
        }
        
       public function sendOrderMailAdmin($trans_id, $billingInfo, $shippingAddrInfo, $shippingLabel, $freightInfo, $ShippingInfo, $sp_inst)
       {
         //extract($arrData, EXTR_PREFIX_SAME, "wddx");
        $i=1;    
        $taxFile = '';
        $disTxt = '';
        for($j=1; $j<=$_COOKIE['NumberOrdered']; $j++)
        {
         $data = explode("|", $_COOKIE['Order_'.$j]);
         for($i=0; $i<1; $i++)
         {

           $prod_name[] = $data[3];
           $prod_quant[] = $data[1];
           $prod_unit_price[] = $data[2];
         }
        }
        if($_COOKIE['discount'] != '')
        {
           $disTxt = "(".$_COOKIE['discount']."% discount)";  
        }
        //get the tax file based on order id
        $sql = "select * from tb_order_tax_file where order_id=".$_SESSION['order_id'];
        $r = mysql_query($sql);
        $res = mysql_fetch_array($r);
        $taxFile = $res['tax_file'];
        
        $subject = "Purchase Order Information from Ave Petroleum";
        $body = '<table border="0" width="100%" cellspacing="5" cellpadding="4">
        <tr><td align="left"><img src="img/logo.png" alt="AVE Petroleum" title="AVE Petroleum" width="420" height="113" border="0" align="left" /></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td align="left"><b>AVE Petroleum</b><br/>sponsored by MILES LUBRICANTS LLC<br/>66 MARINE STREET<br/>FARMINGDALE, NY 11735<br/>(877)683-8086<br/>support@avepetroleum.com<br/>www.avepetroleum.com</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>A new purchase order has been placed. Please find below the detail information.</td></tr>
        </table>
        <p>&nbsp;</p>
        <table border="0" width="100%" cellspacing="5" cellpadding="4">
         <tr><td><h3 style="color:#4e90ba; font-family: century-gothic, san-serif, helvetica, arial; font-size:24px;"><b>INVOICE</b></h3></td></tr>
         <tr>
           <td><h3>CUSTOMER INFORMATION</h3><br/>'.$_SESSION['user_full_name'].'<br/>'.$_SESSION['user_company'].','.$_SESSION['user_address'].','.$_SESSION['user_city'].','.$_SESSION['user_state'].','.$_SESSION['user_zip'].','.$_SESSION['user_phone'].','.$_SESSION['user_email'].'</td>
           <td><h3>BILL TO</h3><br/>'.$billingInfo[0]['billing_first_name']." ".$billingInfo[0]['billing_last_name'].'<br/>'.$billingInfo[0]['bill_to_address'].','.$billingInfo[0]['bill_to_city'].','.$billingInfo[0]['bill_to_state'].','.$billingInfo[0]['bill_to_zip'].','.$billingInfo[0]['bill_to_phone'].'</td>    
           <td><h3>SHIP TO</h3><br/>'.$shippingAddrInfo[0]['ship_first_name']." ".$shippingAddrInfo[0]['ship_last_name'].'<br/>'.$shippingAddrInfo[0]['ship_to_address'].','.$shippingAddrInfo[0]['ship_to_city'].','.$shippingAddrInfo[0]['ship_to_state'].','.$shippingAddrInfo[0]['ship_to_zip'].','.$shippingAddrInfo[0]['ship_to_phone'].'</td>
        </tr>
        </table>
        <table border="0" width="100%" cellspacing="5" cellpadding="4">
        <tr style="padding:6px; background:#dce9f1;"><td><b>PRODUCT</b></td><td><b>QTY</b></td><td><b>RATE</b></td><td><b>AMOUNT</b></td></tr>';
         $a = 0;
         $b = 0;
         $prodWeight = 0;
         $subtotal = 0;
         $shipping = 0;
         $totAmnt = 0;
            for($x=0; $x<sizeof($prod_name); $x++)
            {
             $shimAmnt = 0;
             $total = 0;
             $i = $i + $x;
             $prodType = $_COOKIE['ship_'.$i];  
             $discount = $prod_unit_price[$x] - ($prod_unit_price[$x] * ($_COOKIE['discount'] / 100));    
             $total = $prod_quant[$x] * $discount;
             $body .='<tr><td>'.$prod_name[$x].'</td><td>'.$prod_quant[$x].' '.$prodType.'</td><td>'.$discount.'</td><td> '.$total.' &nbsp;'. $disTxt.'</td></tr>';
             if($_COOKIE['product_weights'][$x] != '')
             {
                 $prodWeight = $_COOKIE['product_weights'][$x];
             }    
             else
             {
                $prodWeight = $_COOKIE['shipping_weight'][$x]; 
             }    
                if($prodWeight == 0)
                {
                    $body.="<tr><td>Same Shipment Carrier</td></tr>";
                }    
                else if($prodWeight < 151)
                //if($ShippingInfo[$a]['shipping_option_name'] != '')
                {    
                    $body .='<tr><td><b>SHIP VIA</b><br/> '.$ShippingInfo[$a]['shipping_option_name'].'</td><td>&nbsp;</td><td>'.$ShippingInfo[$a]['shipping_option_cost'].'</td><td> '.$ShippingInfo[$a]['shipping_option_cost'].'</td></tr>';
                    $shimAmnt = $ShippingInfo[$a]['shipping_option_cost'];
                    $a++;
                    
                }
                else
                {
                  $body .='<tr><td><b>SHIP VIA</b><br/> '.$freightInfo[$b]['freight_name'].'</td><td>&nbsp;</td><td>'.$freightInfo[$b]['freight_cost'].'</td><td> '.$freightInfo[$b]['freight_cost'].'</td></tr>'; 
                  $shimAmnt = $freightInfo[$b]['freight_cost'];
                  $b++;
                } 
            if($sp_inst != '') { $body .='<tr><td colspan="2"><b>Special Instruction:'.$sp_inst.'</td></tr>'; } 
            
            $body .='<tr><td colspan="4">&nbsp;</td></tr>'; 
            
            $subtotal = $subtotal + $total;
            $shipping = $shipping + $shimAmnt;
            
            }
            $totAmnt = $subtotal + $shipping + $_COOKIE["taxRate"];
            
            $body .='<tr><td>&nbsp;</td><td align="left"><b>SUBTOTAL</b></td><td>&nbsp;</td><td>'.$subtotal.'</td></tr>
                    <tr><td>&nbsp;</td><td align="left"><b>SHIPPING</b></td><td>&nbsp;</td><td>'.$shipping.'</td></tr>
                    <tr><td>&nbsp;</td><td align="left"><b>TAX</b></td><td>&nbsp;</td><td>'.$_COOKIE["taxRate"].'</td></tr>    
                    <tr><td>&nbsp;</td><td align="left"><b>TOTAL</b></td><td>&nbsp;</td><td>$'.$totAmnt.'</td></tr>';
                        
         $body .='</table><br/>';
         
         
         $body .='<b>Order ID:</b> '.$_SESSION['order_id'].'<br/>';
         $body .='<b>Transaction ID:</b> '.$trans_id.'<br/><br/>';
         
         $body .='<br/>Thank You.<br/> AVE Petroleum';
      
        $mail             = new PHPMailer();

        //$mail->IsSMTP(); // telling the class to use SMTP

        //ready for attachment
        
        for($c=0; $c<sizeof($shippingLabel); $c++)
        {
            $mail->AddAttachment("/home/vivanov/public_html/".$shippingLabel[$c]);
        }
        if($taxFile != '')
        {
            $mail->AddAttachment("/home/vivanov/public_html/exmptFile/".$taxFile);
        }
        // Advanced setup with fall-back SMTP Server
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";  
        //$mail->SMTPKeepAlive = true;
        $mail->Host = 'smppout.secureserver.net';
        $mail->Port = 80;
//        $mail->User = "support@milesoil.us";
//        $mail->Password = "Miles2013@";

        $mail->SetFrom("support@avepetroleum.com", "AVE Petroleum");
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

                
//        error_log("mail address is =$address");
        
        // $mail->AddAddress($address, "Mahbubur Rahman");
        //$mail->AddAddress($address);
        $mail->AddAddress("sahmed@mileslubricants.com");
        $mail->AddAddress("vivanov@milesoil.com");
        $mail->AddAddress("noor@mileslubricants.com");
        $mail->AddAddress("russell@mileslubricants.com");
        $mail->AddAddress("mivanova@mileslubricants.com");
        $mail->AddAddress("vivanov@mileslubricants.com");
        
//        error_log("Subject is = $subject");
//        error_log("Body is = $body");
        try {
//            error_log("Subject is (2nd Time) = $subject");
            $mail->Subject = (string)$subject;
//            error_log("Subject is (3rd Time)= $subject");
            $mail->MsgHTML($body);
               
             
            
            $mail->Send();  
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }

       return true;   
    }
    
      public function sendMailtoAdmin($products, $shipping, $billing, $customer)
       {
         //extract($arrData, EXTR_PREFIX_SAME, "wddx");
        
        $subject = "A new order has been placed for Bells and Whistles.";
        $body= '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  
  <style type="text/css">
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }

    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type="text/css" media="screen">
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type="text/css" media="screen">
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: &#39;Oxygen&#39;, &#39;Helvetica Neue&#39;, &#39;Arial&#39;, &#39;sans-serif&#39; !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*="container-for-gmail-android"] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class="force-width-gmail"] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class="w320"] {
        width: 320px !important;
      }

      td[class*="mobile-header-padding-left"] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*="mobile-header-padding-right"] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class="header-lg"] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class="content-padding"] {
        padding: 5px 0 5px !important;
      }

       td[class="button"] {
        padding: 5px 5px 30px !important;
      }

      td[class*="free-text"] {
        padding: 10px 18px 30px !important;
      }

      td[class~="mobile-hide-img"] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~="item"] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~="quantity"] {
        width: 50px !important;
      }

      td[class~="price"] {
        width: 90px !important;
      }

      td[class="item-table"] {
        padding: 30px 20px !important;
      }

      td[class="mini-container-left"],
      td[class="mini-container-right"] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }

    }
  </style>
</head>

<body bgcolor="#f7f7f7">
<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%">
  <tr>
    <td align="left" valign="top" width="100%" style="background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;">
      <center>
      <img src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" class="force-width-gmail">
        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
          <tr>
            <td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
            <!--[if gte mso 9]>
            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:80px; v-text-anchor:middle;">
              <v:fill type="tile" src="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" color="#ffffff" />
              <v:textbox inset="0,0,0,0">
            <![endif]-->
              <center>
                <table cellpadding="0" cellspacing="0" width="600" class="w320">
                  <tr>
                    <td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
                      <a href="http://www.bellsandwhistles.com.bd" target="_blank"><img src="http://www.bellsandwhistles.com.bd/img/logo.png" alt="Bells and Whistles" title="Bells and Whistles" width="280" border="0" align="center" /></a>
                    </td>
                    <td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;">
                      <a href="#"><img width="44" height="47" src="http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif" alt="twitter" /></a>
                      <a href="#"><img width="38" height="47" src="http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif" alt="facebook" /></a>
                      
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
              Purchase Order for Bells and Whistles
            </td>
          </tr>
          <tr><td>&nbsp;</td></tr>
          <tr>
            <td class="w320">
              <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td class="mini-container-left">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td class="mini-block-padding">
                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                            <tr>
                              <td class="mini-block">
                                <span class="header-sm">Billing Address</span><br />
                                Jane Doe <br />
                                123 Street <br />
                                Victoria, BC <br />
                                Canada
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td class="mini-container-left">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td class="mini-block-padding">
                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                            <tr>
                              <td class="mini-block">
                                <span class="header-sm">Shipping Address</span><br />
                                Jane Doe <br />
                                123 Street <br />
                                Victoria, BC <br />
                                Canada
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>    
                 
                </tr>
              </table>
            </td>
          </tr>
            
            
          <tr>
            <td class="w320">
              <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                   <td class="mini-container-right">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td class="mini-block-padding">
                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                            <tr>
                              <td class="mini-block">
                                <span class="header-sm">Customer Information</span><br />
                                Jane Doe <br />
                                123 Street <br />
                                Victoria, BC <br />
                                Canada
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td class="mini-container-right">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td class="mini-block-padding">
                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                            <tr>
                              <td class="mini-block">
                                <div style="width: 80%; float: left;">
                                <span class="header-sm">Date Ordered</span><br />
                                January 12, 2015 
                                </div>     
                                <div style="width: 20%; float: right;">   
                                <span class="header-sm">Order</span> <br />
                                #12342
                                </div> 
                                <br/><br/><br/>
                                <span class="header-sm">Payment Method</span> <br />
                                Cash on Delivery  
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>    
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;">
      <center>
        <table cellpadding="0" cellspacing="0" width="600" class="w320">
            <tr>
              <td class="item-table">
                <table cellspacing="0" cellpadding="0" width="100%">
                  <tr>
                    <td class="title-dark" width="300">
                       Item
                    </td>
                    <td class="title-dark" width="163">
                      Qty
                    </td>
                    <td class="title-dark" width="97">
                      Total
                    </td>
                  </tr>


                  <tr>
                    <td class="item-col item">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td class="mobile-hide-img">
                            <a href=""><img width="110" height="92" src="http://s3.amazonaws.com/swu-filepicker/RPezUIwPRv8pjatAAH1E_item_images_19.jpg" alt="item1"></a>
                          </td>
                          <td class="product">
                            <span style="color: #4d4d4d; font-weight:bold;">Golden Earings</span> <br />
                            Hot city looks
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class="item-col quantity">
                      1
                    </td>
                    <td class="item-col">
                      $3.50
                    </td>
                  </tr>


                  <tr>
                    <td class="item-col item">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td class="mobile-hide-img">
                            <a href=""><img width="110" height="92" src="http://s3.amazonaws.com/swu-filepicker/9wRy50HQTg2CTyZA5Ozi_item_images_16.jpg" alt="item2"></a>
                          </td>
                          <td class="product">
                            <span style="color: #4d4d4d; font-weight: bold;">Pink Shoes</span> <br />
                            Newest styles
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class="item-col quantity">
                      1
                    </td>
                    <td class="item-col price">
                      $10.50
                    </td>
                  </tr>


                  <tr>
                    <td class="item-col item mobile-row-padding"></td>
                    <td class="item-col quantity"></td>
                    <td class="item-col price"></td>
                  </tr>


                  <tr>
                    <td class="item-col item">
                    </td>
                    <td class="item-col quantity" style="text-align:right; padding-right: 10px; border-top: 1px solid #cccccc;">
                      <span class="total-space">Subtotal</span> <br />
                      <span class="total-space">Tax</span>  <br />
                      <span class="total-space">Shipping</span> <br />
                      <span class="total-space" style="font-weight: bold; color: #4d4d4d">Total</span>
                    </td>
                    <td class="item-col price" style="text-align: left; border-top: 1px solid #cccccc;">
                      <span class="total-space">$13.02</span> <br />
                      <span class="total-space">$0.75</span>  <br />
                      <span class="total-space">$1.00</span>  <br />
                      <span class="total-space" style="font-weight:bold; color: #4d4d4d">$15.77</span>
                    </td>
                  </tr>  
                </table>
              </td>
            </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td style="padding: 25px 0 25px">
              <strong>Bells and Whistles.</strong><br />
              Road # 30, House # 16, Sector # 07, Uttara, Dhaka <br />
              Bangladesh <br /><br />
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>';
      
      $sendTo = $_SESSION['user_email'];
        //$sendTo = "sabbir@riseuplabs.com";
     error_log("SendTo = $sendTo");

        $mail             = new PHPMailer();

        //$mail->IsSMTP(); // telling the class to use SMTP

        //ready for attachment
        
               
        // Advanced setup with fall-back SMTP Server
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";  
        //$mail->SMTPKeepAlive = true;
        $mail->Host = 'smppout.secureserver.net';
        $mail->Port = 80;
//        $mail->User = "support@milesoil.us";
//        $mail->Password = "Miles2013@";

        $mail->SetFrom("support@avepetroleum.com", "AVE Petroleum");
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $address = "";
        
        if($sendTo != null){
            $address = $sendTo;
        } 
        
//        error_log("mail address is =$address");
        
        // $mail->AddAddress($address, "Mahbubur Rahman");
        $mail->AddAddress($address);
        //$mail->AddAddress("sabbirahmedchowdhury@gmail.com");
        
//        error_log("Subject is = $subject");
//        error_log("Body is = $body");
        try {
//            error_log("Subject is (2nd Time) = $subject");
            $mail->Subject = (string)$subject;
//            error_log("Subject is (3rd Time)= $subject");
            $mail->MsgHTML($body);
               
             
            
            $mail->Send();  
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }

       return true;   
    }
    
    public function sendOrderMailFreight($trans_id, $billingInfo, $shippingInfo, $freightInfo)
       {
         //extract($arrData, EXTR_PREFIX_SAME, "wddx");
        $i=1;    
        $disTxt = '';
        for($j=1; $j<=$_COOKIE['NumberOrdered']; $j++)
        {
         $data = explode("|", $_COOKIE['Order_'.$j]);
         for($i=0; $i<1; $i++)
         {

           $prod_name[] = $data[3];
           $prod_quant[] = $data[1];
           $prod_unit_price[] = $data[2];
         }
        }
        if($_COOKIE['discount'] != '')
        {
           $disTxt = "(".$_COOKIE['discount']."% discount)";  
        }    
        $subject = "Purchase Order Information from AVE Petroleum";
        $body = 'Dear '.$_SESSION['user_full_name'].'<br/><br/> Thank you for your purchase from AVE Petroleum. Below is the purchase detail for your consideration. Please keep this email for your future refernce.<br/>
            
         <table border="0"><tr><td><h3>Customer Information</h3></td></tr>
         <tr><td><b> Customer Name:</b></td><td>'.$_SESSION['user_full_name'].'</td></tr>
         <tr><td><b> Customer Address:</b></td><td>'.$_SESSION['user_address'].'</td></tr> 
         <tr><td><b> Customer City:</b></td><td>'.$_SESSION['user_city'].'</td></tr> 
         <tr><td><b> Customer State:</b></td><td>'.$_SESSION['user_state'].'</td></tr>     
         <tr><td><b> Customer Zip:</b></td><td>'.$_SESSION['user_zip'].'</td></tr>     
         <tr><td><b> Customer Phone:</b></td><td>'.$_SESSION['user_phone'].'</td></tr>     
         <tr><td><b> Customer Email:</b></td><td>'.$_SESSION['user_email'].'</td></tr>   
         </table><br/>    
         
         <table border="0"><tr><td><h3>Product Information</h3></td></tr>';
         
           for($x=0; $x<sizeof($prod_name); $x++)
           {
             $i = $i + $x;
             $prodType = $_COOKIE['ship_'.$i];  
             $discount = $prod_unit_price[$x] - ($prod_unit_price[$x] * ($_COOKIE['discount'] / 100));    
             $body .='<tr><td><b> Product Name:</b></td><td>'.$prod_name[$x].'</td></tr>
            <tr><td><b> Product Quantity:</b></td><td>'.$prod_quant[$x].' '.$prodType.'</td></tr> 
            <tr><td><b> Product Unit Price:</b></td><td> $'.$discount.' USD &nbsp;'. $disTxt.'</td></tr>';
            $body .='<tr><td><b>Freight Company:</b></td><td>'.$freightInfo[$x]['freight_name'].'</td></tr>';
            $body .='<tr><td><b>Freight Cost:</b></td><td> $'.$freightInfo[$x]['freight_cost'].' USD</td></tr>';    
            $body .='<tr><td colspan="2">&nbsp;</td></tr>'; 
            }     
         
         $body .='</table><br/>';
         
         $body .='<table border="0"><tr><td><h3>Billing Information</h3></td></tr>
         <tr><td><b> Billing Name:</b></td><td>'.$billingInfo[0]['billing_first_name']." ".$billingInfo[0]['billing_last_name'].'</td></tr>
         <tr><td><b> Billing Address:</b></td><td>'.$billingInfo[0]['bill_to_address'].'</td></tr> 
         <tr><td><b> Billing City:</b></td><td>'.$billingInfo[0]['bill_to_city'].'</td></tr> 
         <tr><td><b> Billing State:</b></td><td>'.$billingInfo[0]['bill_to_state'].'</td></tr>     
         <tr><td><b> Billing Zip:</b></td><td>'.$billingInfo[0]['bill_to_zip'].'</td></tr>     
         <tr><td><b> Billing Phone:</b></td><td>'.$billingInfo[0]['bill_to_phone'].'</td></tr>     
         </table><br/>';   
         
         $body .='<table border="0"><tr><td><h3>Shipping Information</h3></td></tr>
         <tr><td><b> Shipping Name:</b></td><td>'.$shippingInfo[0]['ship_first_name']." ".$shippingInfo[0]['ship_last_name'].'</td></tr>
         <tr><td><b> Shipping Address:</b></td><td>'.$shippingInfo[0]['ship_to_address'].'</td></tr> 
         <tr><td><b> Shipping City:</b></td><td>'.$shippingInfo[0]['ship_to_city'].'</td></tr> 
         <tr><td><b> Shipping State:</b></td><td>'.$shippingInfo[0]['ship_to_state'].'</td></tr>     
         <tr><td><b> Shipping Zip:</b></td><td>'.$shippingInfo[0]['ship_to_zip'].'</td></tr>     
         <tr><td><b> Shipping Phone:</b></td><td>'.$shippingInfo[0]['ship_to_phone'].'</td></tr>     
         </table><br/>';
         
         
         $body .='<b>Order ID:</b> '.$_SESSION['order_id'].'<br/>';
         $body .='<b>Transaction ID:</b> '.$trans_id.'<br/><br/>';
         
         $body .='<br/>Thank You.<br/> AVE Petroleum';
      
      $sendTo = $_SESSION['user_email'];
        //$sendTo = "sabbir@riseuplabs.com";
     error_log("SendTo = $sendTo");

        $mail             = new PHPMailer();

        //$mail->IsSMTP(); // telling the class to use SMTP

        
        
        // Advanced setup with fall-back SMTP Server
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";  
        //$mail->SMTPKeepAlive = true;
        $mail->Host = 'smppout.secureserver.net';
        $mail->Port = 80;
//        $mail->User = "support@milesoil.us";
//        $mail->Password = "Miles2013@";

        $mail->SetFrom("support@avepetroleum.com", "AVE Petroleum");
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $address = "";
        
        if($sendTo != null){
            $address = $sendTo;
        } 
        
//        error_log("mail address is =$address");
        
        // $mail->AddAddress($address, "Mahbubur Rahman");
        $mail->AddAddress($address);
        $mail->AddAddress("sabbirahmedchowdhury@gmail.com");
        
//        error_log("Subject is = $subject");
//        error_log("Body is = $body");
        try {
//            error_log("Subject is (2nd Time) = $subject");
            $mail->Subject = (string)$subject;
//            error_log("Subject is (3rd Time)= $subject");
            $mail->MsgHTML($body);
               
             
            
            $mail->Send();  
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }

       return true;   
    }
    
    
    public function sendOrderMailTerm($order_id, $billingInfo, $shippingInfo)
       {
         //extract($arrData, EXTR_PREFIX_SAME, "wddx");
        $i=1;    
        $disTxt = '';
        for($j=1; $j<=$_COOKIE['NumberOrdered']; $j++)
        {
         $data = explode("|", $_COOKIE['Order_'.$j]);
         for($i=0; $i<1; $i++)
         {

           $prod_name[] = $data[3];
           $prod_quant[] = $data[1];
           $prod_unit_price[] = $data[2];
         }
        }
        if($_COOKIE['discount'] != '')
        {
           $disTxt = "(".$_COOKIE['discount']."% discount)";  
        }    
        $subject = "Purchase Order Information from AVE Petroleum";
        $body = 'Dear '.$_SESSION['user_full_name'].'<br/><br/> Thank you for your purchase from AVE Petroleum. Below is the purchase detail for your consideration. Please keep this email for your future reference.<br/>
            
         <table border="0"><tr><td><h3>Customer Information</h3></td></tr>
         <tr><td><b> Customer Name:</b></td><td>'.$_SESSION['user_full_name'].'</td></tr>
         <tr><td><b> Customer Address:</b></td><td>'.$_SESSION['user_address'].'</td></tr> 
         <tr><td><b> Customer City:</b></td><td>'.$_SESSION['user_city'].'</td></tr> 
         <tr><td><b> Customer State:</b></td><td>'.$_SESSION['user_state'].'</td></tr>     
         <tr><td><b> Customer Zip:</b></td><td>'.$_SESSION['user_zip'].'</td></tr>     
         <tr><td><b> Customer Phone:</b></td><td>'.$_SESSION['user_phone'].'</td></tr>     
         <tr><td><b> Customer Email:</b></td><td>'.$_SESSION['user_email'].'</td></tr>   
         </table><br/>    
         
         <table border="0"><tr><td><h3>Product Information</h3></td></tr>';
         for($x=0; $x<sizeof($prod_name); $x++)
         {
          $i = $i + $x;
          $prodType = $_COOKIE['ship_'.$i];  
          $discount = $prod_unit_price[$x] - ($prod_unit_price[$x] * ($_COOKIE['discount'] / 100));    
          $body .='<tr><td><b> Product Name:</b></td><td>'.$prod_name[$x].'</td></tr>
         <tr><td><b> Product Quantity:</b></td><td>'.$prod_quant[$x].' '.$prodType.'</td></tr> 
         <tr><td><b> Product Unit Price:</b></td><td> $'.$discount.' USD &nbsp;'. $disTxt.'</td></tr>
         <tr><td colspan="2">&nbsp;</td></tr>'; 
         }   
         $body .='</table><br/>';
         
         $body .='<table border="0"><tr><td><h3>Billing Information</h3></td></tr>
         <tr><td><b> Billing Name:</b></td><td>'.$billingInfo[0]['billing_first_name']." ".$billingInfo[0]['billing_last_name'].'</td></tr>
         <tr><td><b> Billing Address:</b></td><td>'.$billingInfo[0]['bill_to_address'].'</td></tr> 
         <tr><td><b> Billing City:</b></td><td>'.$billingInfo[0]['bill_to_city'].'</td></tr> 
         <tr><td><b> Billing State:</b></td><td>'.$billingInfo[0]['bill_to_state'].'</td></tr>     
         <tr><td><b> Billing Zip:</b></td><td>'.$billingInfo[0]['bill_to_zip'].'</td></tr>     
         <tr><td><b> Billing Phone:</b></td><td>'.$billingInfo[0]['bill_to_phone'].'</td></tr>     
         </table><br/>';   
         
         $body .='<table border="0"><tr><td><h3>Shipping Information</h3></td></tr>
         <tr><td><b> Shipping Name:</b></td><td>'.$shippingInfo[0]['ship_first_name']." ".$shippingInfo[0]['ship_last_name'].'</td></tr>
         <tr><td><b> Shipping Address:</b></td><td>'.$shippingInfo[0]['ship_to_address'].'</td></tr> 
         <tr><td><b> Shipping City:</b></td><td>'.$shippingInfo[0]['ship_to_city'].'</td></tr> 
         <tr><td><b> Shipping State:</b></td><td>'.$shippingInfo[0]['ship_to_state'].'</td></tr>     
         <tr><td><b> Shipping Zip:</b></td><td>'.$shippingInfo[0]['ship_to_zip'].'</td></tr>     
         <tr><td><b> Shipping Phone:</b></td><td>'.$shippingInfo[0]['ship_to_phone'].'</td></tr>     
         </table><br/>';
         
         $body .='<b>Order ID:</b> '.$order_id.'<br/>';
         
         
         $body .='<br/>Thank You.<br/> AVE Petroleum';
      
      $sendTo = $_SESSION['user_email'];
        //$sendTo = "sabbir@riseuplabs.com";
     error_log("SendTo = $sendTo");

        $mail             = new PHPMailer();

        //$mail->IsSMTP(); // telling the class to use SMTP

        
        
        // Advanced setup with fall-back SMTP Server
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";  
        //$mail->SMTPKeepAlive = true;
        $mail->Host = 'smppout.secureserver.net';
        $mail->Port = 80;
//        $mail->User = "support@milesoil.us";
//        $mail->Password = "Miles2013@";

        $mail->SetFrom("support@avepetroleum.com", "AVE Petroleum");
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $address = "";
        
        if($sendTo != null){
            $address = $sendTo;
        } 
        
//        error_log("mail address is =$address");
        
        // $mail->AddAddress($address, "Mahbubur Rahman");
        $mail->AddAddress($address);
        $mail->AddAddress("sabbirahmedchowdhury@gmail.com");
        
//        error_log("Subject is = $subject");
//        error_log("Body is = $body");
        try {
//            error_log("Subject is (2nd Time) = $subject");
            $mail->Subject = (string)$subject;
//            error_log("Subject is (3rd Time)= $subject");
            $mail->MsgHTML($body);
               
             
            
            $mail->Send();  
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }

       return true;   
    }
    
    function getNumPallets($quantity, $prodType)
    {
       if($prodType == "cases")
       {
        $quant = $quantity/50;
        $pallet = ceil($quant);
       }  
       if($prodType == "kegs")
       {
        $quant = $quantity/9;
        $pallet = ceil($quant);
       }  
       if($prodType == "pails")
       {    
        $quant = $quantity/36;
        $pallet = ceil($quant);
       }  
       if($prodType == "drums")
       {    
        $pallet = ceil($quantity/4);  
       } 
       if($prodType == "tote275")
       {    
        $quant = $quantity/1;
        $pallet = $quant;  
       }    
       if($prodType == "tote330")
       {    
        $quant = $quantity/1;
        $pallet = $quant;  
       }    
       return $pallet;
    } 
    
     function freightCalc($originZip, $destZip,$weight,$pallets)
     {
       $url="http://jpexweb.myvnc.com/JpeWs/JpeWs.asmx";

        $simple='<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <GetRates xmlns="http://jpxpress.com/">
              <userName>milespetro</userName>
              <password>0298678</password>
              <rateAccount>0298678</rateAccount>
              <payee>shipper</payee>
              <paymentMethod>COLLECT</paymentMethod>
              <originZip>'.$originZip.'</originZip>
              <destZip>'.$destZip.'</destZip>
              <parameters>
                <RateParameter>
                  <Weight>'.$weight.'</Weight>
                  <Class>0650</Class>
                  <Pallets>'.$pallets.'</Pallets>
                </RateParameter>
               </parameters>
              <isCod>0</isCod>
            </GetRates>
          </soap:Body>
        </soap:Envelope>'; 
        
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url); 
        //curl_setopt($tuCurl, CURLOPT_PORT , 443); 
        curl_setopt($tuCurl, CURLOPT_VERBOSE, 0); 
        curl_setopt($tuCurl, CURLOPT_HEADER, 0); 
        curl_setopt($tuCurl, CURLOPT_SSLVERSION, 3); 
        curl_setopt($tuCurl, CURLOPT_SSLCERT, getcwd() . "/client.pem"); 
        curl_setopt($tuCurl, CURLOPT_SSLKEY, getcwd() . "/keyout.pem"); 
        curl_setopt($tuCurl, CURLOPT_CAINFO, getcwd() . "/ca.pem"); 
        curl_setopt($tuCurl, CURLOPT_POST, 1); 
        curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, 1); 
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $simple); 
        curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf-8","SOAPAction: http://jpxpress.com/GetRates", "Content-length: ".strlen($simple))); 

        $tuData = curl_exec($tuCurl); 
        if(!curl_errno($tuCurl)){ 
          $info = curl_getinfo($tuCurl); 
          //echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']; 
        } else { 
          echo 'Curl error: ' . curl_error($tuCurl); 
        } 

        curl_close($tuCurl); 
        //echo $tuData; 

        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $tuData);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $responseArray = json_decode($json,true);
        //
        //echo "<pre>";
        //print_r($responseArray);
        //echo "</pre>";
        if(sizeof($responseArray[soapBody][GetRatesResponse][GetRatesResult][ErrorMessage]) == 0)
        {    
          $totRate = ($responseArray[soapBody][GetRatesResponse][GetRatesResult][Amount][decimal][0] + $responseArray[soapBody][GetRatesResponse][GetRatesResult][FdAmt]);
          return $totRate;
        }
        else
        {
            //echo $responseArray[soapBody][GetRatesResponse][GetRatesResult][ErrorMessage];
            return 0;
        }    

     }
     
     public function getFreightQuotes($originZip, $destZip, $weight, $pallets)
     {
         $url="http://b2b.Freightquote.com/WebService/QuoteService.asmx";

        $simple='<?xml version="1.0" encoding="utf-8"?> 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"> 
<soap:Body> 
  <GetRatingEngineQuote xmlns="http://tempuri.org/">   
   <request> 
     <CustomerId>63815754</CustomerId>  
     <QuoteType>B2B</QuoteType> 
     <ServiceType>LTL</ServiceType> 
   <QuoteShipment> 
     <IsBlind>false</IsBlind> 
     <SortAndSegregate>false</SortAndSegregate> 
   <ShipmentLocations> 
   <Location> 
     <LocationType>Origin</LocationType> 
     <RequiresArrivalNotification>false</RequiresArrivalNotification> 
     <HasDeliveryAppointment>false</HasDeliveryAppointment> 
     <IsLimitedAccess>false</IsLimitedAccess> 
     <HasLoadingDock>false</HasLoadingDock> 
     <IsConstructionSite>false</IsConstructionSite> 
     <RequiresInsideDelivery>false</RequiresInsideDelivery> 
     <IsTradeShow>false</IsTradeShow> 
     <IsResidential>false</IsResidential> 
     <RequiresLiftgate>false</RequiresLiftgate> 	 
 
   <LocationAddress> 
     <PostalCode>'.$originZip.'</PostalCode> 
     <CountryCode>US</CountryCode> 
   </LocationAddress> 
   <AdditionalServices /> 
   </Location> 
  
   <Location> 
     <LocationType>Destination</LocationType> 
     <RequiresArrivalNotification>false</RequiresArrivalNotification> 
     <HasDeliveryAppointment>false</HasDeliveryAppointment> 
     <IsLimitedAccess>false</IsLimitedAccess> 
     <HasLoadingDock>false</HasLoadingDock> 
     <IsConstructionSite>false</IsConstructionSite> 
     <RequiresInsideDelivery>false</RequiresInsideDelivery> 
     <IsTradeShow>false</IsTradeShow> 
     <IsResidential>false</IsResidential> 
     <RequiresLiftgate>false</RequiresLiftgate> 

   <LocationAddress> 
      <PostalCode>'.$destZip.'</PostalCode> 
      <CountryCode>US</CountryCode> 
   </LocationAddress> 
   <AdditionalServices /> 
   </Location> 
   </ShipmentLocations> 

   <ShipmentProducts> 
   <Product> 
      <Class>65</Class> 
      <Weight>'.$weight.'</Weight> 
      <Length>0</Length> 
      <Width>0</Width> 
      <Height>0</Height> 
      <ProductDescription>Books</ProductDescription> 
      <PackageType>Pallets_48x40</PackageType> 
      <IsStackable>false</IsStackable> 
      <DeclaredValue>0</DeclaredValue> 
      <CommodityType>GeneralMerchandise</CommodityType> 
      <ContentType>NewCommercialGoods</ContentType> 
      <IsHazardousMaterial>false</IsHazardousMaterial> 
   <NMFC /> 

     <DimWeight>0</DimWeight> 
     <EstimatedWeight>0</EstimatedWeight> 
     <PieceCount>'.$pallets.'</PieceCount> 
      
   </Product> 
   </ShipmentProducts> 
   <ShipmentContacts /> 
   </QuoteShipment> 
   </request> 
   
   <user> 
     <Name>vivanov@milesoil.com</Name> 
     <Password>Miles2009</Password> 
   </user> 
   </GetRatingEngineQuote> 
</soap:Body> 
</soap:Envelope>'; 
        //echo $simple;
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url); 
        //curl_setopt($tuCurl, CURLOPT_PORT , 443); 
        curl_setopt($tuCurl, CURLOPT_VERBOSE, 0); 
        curl_setopt($tuCurl, CURLOPT_HEADER, 0); 
        curl_setopt($tuCurl, CURLOPT_SSLVERSION, 3); 
        curl_setopt($tuCurl, CURLOPT_SSLCERT, getcwd() . "/client.pem"); 
        curl_setopt($tuCurl, CURLOPT_SSLKEY, getcwd() . "/keyout.pem"); 
        curl_setopt($tuCurl, CURLOPT_CAINFO, getcwd() . "/ca.pem"); 
        curl_setopt($tuCurl, CURLOPT_POST, 1); 
        curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, 1); 
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $simple); 
        curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf-8","SOAPAction: http://tempuri.org/GetRatingEngineQuote", "Content-length: ".strlen($simple))); 

        $tuData = curl_exec($tuCurl); 
        if(!curl_errno($tuCurl)){ 
          $info = curl_getinfo($tuCurl); 
          //echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']; 
        } else { 
          echo 'Curl error: ' . curl_error($tuCurl); 
        } 
        curl_close($tuCurl);
       //echo $tuData; 
       $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $tuData);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $responseArray = json_decode($json,true);
        
        $rows = array();
        $totalQuote = 0;
        
//         echo"<pre>";
//        print_r($responseArray);
//        echo"</pre>";
        
        for($i=0; $i<sizeof($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption]); $i++)
        {
            if(strpos($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierName], "Fedex") === false && strpos($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierName], "FedEx") === false && strpos($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierName], "Central Transport") === false && strpos($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierName], "Central Transport") === false)
            {        
             array_push($rows,$responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierName]);
                
            for($j=0; $j<sizeof($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierAccessorials][Accessorial]); $j++)
            {
              if (count($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierAccessorials][Accessorial]) == count($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierAccessorials][Accessorial], COUNT_RECURSIVE) && $responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierAccessorials][Accessorial][AccessorialId] == 158) 
              {    
                 $totalQuote = $responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][QuoteAmount] + $responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierAccessorials][Accessorial][AccessorialCharge];
              }
              else if($responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierAccessorials][Accessorial][$j][AccessorialId] == 158 && $responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierAccessorials][Accessorial][$j][AccessorialId] != '')
              {
                 $totalQuote = $responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][QuoteAmount] + $responseArray[soapBody][GetRatingEngineQuoteResponse][GetRatingEngineQuoteResult][QuoteCarrierOptions][CarrierOption][$i][CarrierAccessorials][Accessorial][$j][AccessorialCharge];  
              }
            }
            //echo $totalQuote;
            array_push($rows,$totalQuote);
           }        
       }
//       echo"<pre>";
//        print_r($rows);
//        echo"</pre>";
        return $rows;
//        
        
     }        
     
     public function getUserPass($email)
     {
       $sql = "select * from tb_user where email='$email'";
       $r=mysql_query($sql);
       //$cnt = ;
       //$res = mysql_fetch_array($r);
       if(mysql_num_rows($r) > 0)
       {
           return 1;
       }    
       else
       {
          return 0; 
       }    
     }
     
     public function changeUserPass($email,$newPass)
     {
        $pass = md5($newPass);
        $sql = "update tb_user set password='$pass' where email='$email'";
        $r = mysql_query($sql);
        return true;
     } 
     
     public function getOrderByUser($userId)
     {
        $rows=array();
        $sql = "select distinct order_id from tb_user_order_relation where user_id = $userId";
        $r = mysql_query($sql);
        while($res = mysql_fetch_array($r))
        {
         array_push($rows,$res);  
        }  
        return $rows;
     }
     public function getIdByOrderId($orderId)
     {
        $rows=array();
        $sql = "select id from tb_order where order_id='$orderId'";
        $r = mysql_query($sql);
        $res = mysql_fetch_array($r);
          
        return $res['id'];  
     }
     public function getOrdersById($orderId)
     {
        $rows=array();
        $sql = "select * from tb_order where order_id='$orderId'";
        $r = mysql_query($sql);
        while($res = mysql_fetch_array($r))
        {
         array_push($rows,$res);  
        }  
        return $rows;
     }
     
    public  function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    }
    return $num.'th';
  }
  
   public function getOrderListFirstMenufac($orderId, $firstManuFacId)
   {
       $rows = array();
       $sql = "SELECT * FROM tb_order WHERE order_id = '$orderId' ORDER BY manufacturer_id=$firstManuFacId desc";
       $r = mysql_query($sql);
        while($res = mysql_fetch_array($r))
        {
         array_push($rows,$res);  
        }  
        return $rows;
   }        
   
   
   public function sendOrderMailEstimate($trans_id, $billingInfo, $shippingAddrInfo, $shippingInfo, $orderarr)
       {
         //extract($arrData, EXTR_PREFIX_SAME, "wddx");
        $i=1;    
        $disTxt = '';
        for($j=0; $j<=sizeof($orderarr); $j++)
        {
         
           $prod_name[] = $orderarr[$j]['order_product'];
           $prod_quant[] = $orderarr[$j]['order_quantity'];
           $prod_unit_price[] = $orderarr[$j]['order_total'];
           $prod_type[] = $orderarr[$j]['order_prod_measure'];
        }
        
          
        $subject = "Purchase Order Information from AVE Petroleum";
        $body = 'Dear '.$_SESSION['user_full_name'].'<br/><br/> Thank you for your purchase from AVE Petroleum. Below is the purchase detail for your consideration. Please keep this email for your future reference.<br/>
            
         <table border="0"><tr><td><h3>Customer Information</h3></td></tr>
         <tr><td><b> Customer Name:</b></td><td>'.$_SESSION['user_full_name'].'</td></tr>
         <tr><td><b> Customer Address:</b></td><td>'.$_SESSION['user_address'].'</td></tr> 
         <tr><td><b> Customer City:</b></td><td>'.$_SESSION['user_city'].'</td></tr> 
         <tr><td><b> Customer State:</b></td><td>'.$_SESSION['user_state'].'</td></tr>     
         <tr><td><b> Customer Zip:</b></td><td>'.$_SESSION['user_zip'].'</td></tr>     
         <tr><td><b> Customer Phone:</b></td><td>'.$_SESSION['user_phone'].'</td></tr>     
         <tr><td><b> Customer Email:</b></td><td>'.$_SESSION['user_email'].'</td></tr>   
         </table><br/>    
         
         <table border="0"><tr><td><h3>Product Information</h3></td></tr>';
         $a = 0;
         $b = 0;
            for($x=0; $x<sizeof($prod_name); $x++)
            {
             $i = $i + $x;
             //$prodType = $_COOKIE['ship_'.$i];  
             //$discount = $prod_unit_price[$x] - ($prod_unit_price[$x] * ($_COOKIE['discount'] / 100));    
             $body .='<tr><td><b> Product Name:</b></td><td>'.$prod_name[$x].'</td></tr>
            <tr><td><b> Product Quantity:</b></td><td>'.$prod_quant[$x].' '.$prod_type[$x].'</td></tr> 
            <tr><td><b> Product Unit Price:</b></td><td> $'.$prod_unit_price[$x].' USD &nbsp;'. $disTxt.'</td></tr>';
            if($shippingInfo[$x]['shipping_option_name'] != '')
            { 
             $shipCost =  $shippingInfo[$x]['shipping_option_cost'] * 1.1;  
             $body .='<tr><td><b>Shipping Option:</b></td><td> '.$shippingInfo[$x]['shipping_option_name'].'</td></tr>
             <tr><td><b>Shipping Cost:</b></td><td> $'.$shipCost.' USD</td></tr>';
            }  
            else
            {
              $shipCost =  $shippingInfo[$x]['freight_cost'] * 1.1;   
              $body .='<tr><td><b>Shipping Option:</b></td><td> '.$shippingInfo[$x]['freight_name'].'</td></tr>
             <tr><td><b>Shipping Cost:</b></td><td> $'.$shipCost.' USD</td></tr>';  
            }    
         $body .='</table><br/>';
         
         $body .='<table border="0"><tr><td><h3>Billing Information</h3></td></tr>
         <tr><td><b> Billing Name:</b></td><td>'.$billingInfo[0]['billing_first_name']." ".$billingInfo[0]['billing_last_name'].'</td></tr>
         <tr><td><b> Billing Address:</b></td><td>'.$billingInfo[0]['bill_to_address'].'</td></tr> 
         <tr><td><b> Billing City:</b></td><td>'.$billingInfo[0]['bill_to_city'].'</td></tr> 
         <tr><td><b> Billing State:</b></td><td>'.$billingInfo[0]['bill_to_state'].'</td></tr>     
         <tr><td><b> Billing Zip:</b></td><td>'.$billingInfo[0]['bill_to_zip'].'</td></tr>     
         <tr><td><b> Billing Phone:</b></td><td>'.$billingInfo[0]['bill_to_phone'].'</td></tr>     
         </table><br/>';   
         
         $body .='<table border="0"><tr><td><h3>Shipping Information</h3></td></tr>
         <tr><td><b> Shipping Name:</b></td><td>'.$shippingAddrInfo[0]['ship_first_name']." ".$shippingAddrInfo[0]['ship_last_name'].'</td></tr>
         <tr><td><b> Shipping Address:</b></td><td>'.$shippingAddrInfo[0]['ship_to_address'].'</td></tr> 
         <tr><td><b> Shipping City:</b></td><td>'.$shippingAddrInfo[0]['ship_to_city'].'</td></tr> 
         <tr><td><b> Shipping State:</b></td><td>'.$shippingAddrInfo[0]['ship_to_state'].'</td></tr>     
         <tr><td><b> Shipping Zip:</b></td><td>'.$shippingAddrInfo[0]['ship_to_zip'].'</td></tr>     
         <tr><td><b> Shipping Phone:</b></td><td>'.$shippingAddrInfo[0]['ship_to_phone'].'</td></tr>     
         </table><br/>';
         
         
         $body .='<b>Order ID:</b> '.$shippingInfo[0]['order_id'].'<br/>';
         $body .='<b>Transaction ID:</b> '.$trans_id.'<br/><br/>';
         
         $body .='<br/>Thank You.<br/> AVE Petroleum';
      
      $sendTo = $_SESSION['user_email'];
      
      return $body;
      return;
        //$sendTo = "sabbir@riseuplabs.com";
     error_log("SendTo = $sendTo");

        $mail             = new PHPMailer();

        //$mail->IsSMTP(); // telling the class to use SMTP

        //ready for attachment
        
               
        // Advanced setup with fall-back SMTP Server
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";  
        //$mail->SMTPKeepAlive = true;
        $mail->Host = 'smppout.secureserver.net';
        $mail->Port = 80;
//        $mail->User = "support@milesoil.us";
//        $mail->Password = "Miles2013@";

        $mail->SetFrom("support@avepetroleum.com", "AVE Petroleum");
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $address = "";
        
        if($sendTo != null){
            $address = $sendTo;
        } 
        
//        error_log("mail address is =$address");
        
        // $mail->AddAddress($address, "Mahbubur Rahman");
        $mail->AddAddress($address);
        //$mail->AddAddress("sabbirahmedchowdhury@gmail.com");
        
//        error_log("Subject is = $subject");
//        error_log("Body is = $body");
        try {
//            error_log("Subject is (2nd Time) = $subject");
            $mail->Subject = (string)$subject;
//            error_log("Subject is (3rd Time)= $subject");
            $mail->MsgHTML($body);
               
             
            
            $mail->Send();  
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }

       return true;   
    }
       }
       
       
       public function sendOrderMailAdminEstimate($trans_id, $billingInfo, $shippingAddrInfo, $shippingLabel, $shippingInfo, $orderarr)
       {
         //extract($arrData, EXTR_PREFIX_SAME, "wddx");
        $i=1;    
        $disTxt = '';
        for($j=0; $j<=sizeof($orderarr); $j++)
        {
         
           $prod_name[] = $orderarr[$j]['order_product'];
           $prod_quant[] = $orderarr[$j]['order_quantity'];
           $prod_unit_price[] = $orderarr[$j]['order_total'];
           $prod_type[] = $orderarr[$j]['order_prod_measure'];
        }
        
        $subject = "Purchase Order Information from AVE Petroleum";
        $body = 'A new purchase order has been placed. Please find below the detail information.<br/>
            
         <table border="0"><tr><td><h3>Customer Information</h3></td></tr>
         <tr><td><b> Customer Name:</b></td><td>'.$_SESSION['user_full_name'].'</td></tr>
         <tr><td><b> Customer Address:</b></td><td>'.$_SESSION['user_address'].'</td></tr> 
         <tr><td><b> Customer City:</b></td><td>'.$_SESSION['user_city'].'</td></tr> 
         <tr><td><b> Customer State:</b></td><td>'.$_SESSION['user_state'].'</td></tr>     
         <tr><td><b> Customer Zip:</b></td><td>'.$_SESSION['user_zip'].'</td></tr>     
         <tr><td><b> Customer Phone:</b></td><td>'.$_SESSION['user_phone'].'</td></tr>     
         <tr><td><b> Customer Email:</b></td><td>'.$_SESSION['user_email'].'</td></tr>   
         </table><br/>    
         
         <table border="0"><tr><td><h3>Product Information</h3></td></tr>';
         $a = 0;
         $b = 0;
         $prodWeight = 0;
            for($x=0; $x<sizeof($prod_name); $x++)
            {
             $i = $i + $x;
             //$prodType = $_COOKIE['ship_'.$i];  
             //$discount = $prod_unit_price[$x] - ($prod_unit_price[$x] * ($_COOKIE['discount'] / 100));    
             $body .='<tr><td><b> Product Name:</b></td><td>'.$prod_name[$x].'</td></tr>
            <tr><td><b> Product Quantity:</b></td><td>'.$prod_quant[$x].' '.$prod_type[$x].'</td></tr> 
            <tr><td><b> Product Unit Price:</b></td><td> $'.$prod_unit_price[$x].' USD &nbsp;'. $disTxt.'</td></tr>';
            if($shippingInfo[$x]['shipping_option_name'] != '')
            { 
             $shipCost =  $shippingInfo[$x]['shipping_option_cost'] * 1.1;  
             $body .='<tr><td><b>Shipping Option:</b></td><td> '.$shippingInfo[$x]['shipping_option_name'].'</td></tr>
             <tr><td><b>Shipping Cost:</b></td><td> $'.$shipCost.' USD</td></tr>';
            }  
            else
            {
              $shipCost =  $shippingInfo[$x]['freight_cost'] * 1.1;   
              $body .='<tr><td><b>Shipping Option:</b></td><td> '.$shippingInfo[$x]['freight_name'].'</td></tr>
             <tr><td><b>Shipping Cost:</b></td><td> $'.$shipCost.' USD</td></tr>';  
            }        
            $body .='<tr><td colspan="2">&nbsp;</td></tr>'; 
            }  
         
         
         $body .='</table><br/>';
         
         $body .='<table border="0"><tr><td><h3>Billing Information</h3></td></tr>
         <tr><td><b> Billing Name:</b></td><td>'.$billingInfo[0]['billing_first_name']." ".$billingInfo[0]['billing_last_name'].'</td></tr>
         <tr><td><b> Billing Address:</b></td><td>'.$billingInfo[0]['bill_to_address'].'</td></tr> 
         <tr><td><b> Billing City:</b></td><td>'.$billingInfo[0]['bill_to_city'].'</td></tr> 
         <tr><td><b> Billing State:</b></td><td>'.$billingInfo[0]['bill_to_state'].'</td></tr>     
         <tr><td><b> Billing Zip:</b></td><td>'.$billingInfo[0]['bill_to_zip'].'</td></tr>     
         <tr><td><b> Billing Phone:</b></td><td>'.$billingInfo[0]['bill_to_phone'].'</td></tr>     
         </table><br/>';   
         
         $body .='<table border="0"><tr><td><h3>Shipping Information</h3></td></tr>
         <tr><td><b> Shipping Name:</b></td><td>'.$shippingAddrInfo[0]['ship_first_name']." ".$shippingAddrInfo[0]['ship_last_name'].'</td></tr>
         <tr><td><b> Shipping Address:</b></td><td>'.$shippingAddrInfo[0]['ship_to_address'].'</td></tr> 
         <tr><td><b> Shipping City:</b></td><td>'.$shippingAddrInfo[0]['ship_to_city'].'</td></tr> 
         <tr><td><b> Shipping State:</b></td><td>'.$shippingAddrInfo[0]['ship_to_state'].'</td></tr>     
         <tr><td><b> Shipping Zip:</b></td><td>'.$shippingAddrInfo[0]['ship_to_zip'].'</td></tr>     
         <tr><td><b> Shipping Phone:</b></td><td>'.$shippingAddrInfo[0]['ship_to_phone'].'</td></tr>     
         </table><br/>';
         
         $body .='<b>Order ID:</b> '.$shippingInfo[0]['order_id'].'<br/>';
         $body .='<b>Transaction ID:</b> '.$trans_id.'<br/><br/>';
         
         $body .='<br/>Thank You.<br/> AVE Petroleum';
      
        $mail             = new PHPMailer();

        //$mail->IsSMTP(); // telling the class to use SMTP

        //ready for attachment
        
        for($c=0; $c<sizeof($shippingLabel); $c++)
        {
            $mail->AddAttachment("/home/vivanov/public_html/".$shippingLabel[$c]);
        }
        
        // Advanced setup with fall-back SMTP Server
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";  
        //$mail->SMTPKeepAlive = true;
        $mail->Host = 'smppout.secureserver.net';
        $mail->Port = 80;
//        $mail->User = "support@milesoil.us";
//        $mail->Password = "Miles2013@";

        $mail->SetFrom("support@avepetroleum.com", "AVE Petroleum");
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

                
//        error_log("mail address is =$address");
        
         $mail->AddAddress("sabbirahmedchowdhury@gmail.com");
        //$mail->AddAddress($address);
        $mail->AddAddress("vivanov@milesoil.com");
        $mail->AddAddress("vivanov@mileslubricants.com");
        $mail->AddAddress("sahmed@mileslubricants.com");
//        error_log("Subject is = $subject");
//        error_log("Body is = $body");
        try {
//            error_log("Subject is (2nd Time) = $subject");
            $mail->Subject = (string)$subject;
//            error_log("Subject is (3rd Time)= $subject");
            $mail->MsgHTML($body);
               
             
            
            $mail->Send();  
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }

       return true;   
     }
     
     public function getShortestZipBasedOnLocation($manufacArr, $destZip)
     {
         $manufacZip = array();
        
         for($i=0; $i<sizeof($manufacArr); $i++)
         {
            $distances = array(); 
            if(strlen($manufacArr[$i]) > 1)
            {
                $getManufacIds = explode(",", $manufacArr[$i]);
                //print_r($getManufacIds);
                for($j=0; $j<sizeof($getManufacIds); $j++)
                {
                   $condArr = array(
                      "manufacturer_id" => $getManufacIds[$j] 
                   ); 
                   
                   $getManufacZip = $this->getData("tb_manufacturer", $condArr);
                   $distance = $this->getDistance($getManufacZip[0]['zip'], $destZip, "K");
                   $distances[] = round($distance,2);
                  
                }
                //print_r($distances);
                $minDistZip = min($distances);
                $key = array_search("$minDistZip", $distances);
                array_push($manufacZip, $getManufacIds[$key]);
                
            } 
            else
            {
               array_push($manufacZip, $manufacArr[$i]); 
            }    
                
         }
         return $manufacZip;
         
     }
     
    public function getLnt($zip){
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        $result1[]=$result['results'][0];
        $result2[]=$result1[0]['geometry'];
        $result3[]=$result2[0]['location'];
        return $result3[0];
      }

public function getDistance($zip1, $zip2, $unit){
        $first_lat = $this->getLnt($zip1);
        $next_lat = $this->getLnt($zip2);
        $lat1 = $first_lat['lat'];
        $lon1 = $first_lat['lng'];
        $lat2 = $next_lat['lat'];
        $lon2 = $next_lat['lng']; 
        $theta=$lon1-$lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K"){
        return ($miles * 1.609344)." ".$unit;
        }
        else if ($unit =="N"){
        return ($miles * 0.8684)." ".$unit;
        }
        else{
        return $miles." ".$unit;
        }

     }
     
public function getTaxByZip($destZip)
{
   $taxRate = 0;
   $zipArr = array(
       "zip" => $destZip
   ); 
   $getTaxRate = $this->getData("tb_csv_rate", $zipArr);
//   if(!empty($getTaxRate))
//   {
//      $taxRate = $getTaxRate[0]['combined_rate'];
//   }    
   return $getTaxRate;
}
    
    }  // Wallpaper Class



?>
