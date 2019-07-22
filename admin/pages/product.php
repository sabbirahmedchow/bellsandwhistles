<?php 
session_start();
if(isset($_GET['logout']))
{
    session_destroy();
    header("location: login.php");
}
?>
<?php
if(isset($_SESSION['user_email']) && $_SESSION['user_email'] == "admin@bellsandwhistles.com.bd")
{
  require_once '../classes/main.class.php';
  $mainClsObj = mainClass ::getInstance(); 
    
  $condArr = array(
     "parent" => 0
  );    
    
  $getAllCategory = $mainClsObj->getData("tb_category", $condArr);
      
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Welcome to Admin Panel || Bells and Whistles</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../js/ajax.form.js" ></script>
        <script>
                    $(function(){
                        
                        $('#prod_main_img').on({
                            
                            change: function(){
                                 
                                 $('#prodform').ajaxForm({target: '#result'}).submit();
                                }
                        });
                        
                    });
    </script>
    <script type="text/javascript" src="../js/functions.js" ></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      
      <span class="brand-text font-weight-light"><img src="../images/footer-logo-new.png" border='0' width='235px' alt="Bells and Whistles" /></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Welcome, Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
        
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-plus-square-o"></i>
              <p>
                Category
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/500.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manage Categories</p>
                </a>
              </li>
            </ul> 
          </li>
            
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Products
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manage Products</p>
                </a>
              </li> 
            </ul>    
           </li>
            
           <li class="nav-item">
            <a href="https://adminlte.io/docs" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>Manage Customers</p>
            </a>
          </li> 
        
          <li class="nav-item">
            <a href="?logout=y" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>Logout</p>
            </a>
          </li>      
          
        </ul>
      </nav>
    
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <section class="content">
      <div class="container-fluid">
        
  <div class="card card-primary" style="width:850px; top:20px; margin:40px 350px; padding:10px;">
              <div class="card-header">
                <h3 class="card-title">Add a Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="prodform" enctype="multipart/form-data" action="uploadImg.php" method="post">
                  <p id="confirm" style="text-align: center; font-size:14px;"></p>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Select Category</label>
                    <div class="form-group">
                    <select class="form-control" id="cat_parent" name="cat_parent">
                      <option value="">Select</option>
                      <?php
                       foreach($getAllCategory as $category)
                       {
                       ?>       
                      <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                  </div>
                    
                  <div class="form-group">
                    <label for="exampleInputPassword1">Select SubCategory</label>
                    <div class="form-group" id="loadSubCat">
                     <select class="form-control" id="subCat" name="subCat">
                      <option value="">Select</option>
                     </select>         
                    </div>
                  </div>    
                    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Product Name" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Short Description</label>
                    <div class="card-body pad">
                      <div class="mb-3">
                        <textarea class="textarea1" placeholder="Place some text here"
                                  style="width: 100%;  font-size: 14px; border: 1px solid #dddddd; padding: 10px;" name="sDesc" id="sDesc"></textarea>
                      </div>
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Long Description</label>
                    <div class="card-body pad">
                      <div class="mb-3">
                        <textarea class="textarea2" placeholder="Place some text here"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="lDesc" id="lDesc"></textarea>
                      </div>
                     
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="text" class="form-control" id="prod_quantity" name="prod_quantity" placeholder="Product Quantity" required>
                  </div>  
                    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Current Price</label>
                     <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">&#2547;</span>
                      </div>
                      <input type="text" class="form-control" name="currPrice" id="currPrice">
                      
                    </div>
                  </div> 
                    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Previous Price(Optional)</label>
                     <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">&#2547;</span>
                      </div>
                      <input type="text" class="form-control" name="prevPrice" id="prevPrice">
                      
                    </div>
                  </div>     
                    
                  <div class="form-group">
                    <label for="exampleInputFile">Product Main Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="prod_main_img" id="prod_main_img">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label for="exampleInputFile">Product Sub Image1</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="prod_sub_img1" id="prod_sub_img1">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>   
                
                  <div class="form-group">
                    <label for="exampleInputFile">Product Sub Image2</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="prod_sub_img2" id="prod_sub_img2">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>    
                    
                  <div class="form-group">
                    <label for="exampleInputFile">Product Sub Image3</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="prod_sub_img3" id="prod_sub_img3">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label for="exampleInputFile">Product Home Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="prod_home_img" id="prod_home_img">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>    
                    
                  <div class="form-group">
                    <label for="exampleInputPassword1">Product Type</label>
                    <div class="form-group">
                    <select class="form-control" id="prod_type" name="prod_type">
                      <option value="New Arrival">New Arrival</option>
                      <option value="Best Seller">Best Seller</option>
                      <option value="Most Wanted">Most Wanted</option>
                      
                    </select>
                  </div>
                  </div>   
                    
                <div class="form-group">
                    <label for="exampleInputEmail1">Tags(seperated by comma)</label>
                    <input type="text" class="form-control" id="prod_tags" name="prod_tags" placeholder="Product Tags" required>
                  </div>         
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="submitProd" class="btn btn-primary">Add Product</button>
                </div>
              </form>
            </div>
            
          </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer" style="width:100%;">
    
    <strong>Copyright &copy; 2019 <a href="#">Bells and Whistles</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="../plugins/chartjs-old/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="../dist/js/pages/dashboard2.js"></script>
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    
    // bootstrap WYSIHTML5 - text editor

    $('.textarea1').wysihtml5({
      toolbar: { fa: true }
    })
     $('.textarea2').wysihtml5({
      toolbar: { fa: true }
    })
  })
</script>
</body>
</html>
<?php
}
else
{
     header("location: login.php");
}
?>