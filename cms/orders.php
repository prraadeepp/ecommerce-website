
<?php include 'inc/header.php' ;
require 'inc/session.php'; 
require '../class/login_register.php';
require '../class/customer_info.php';
require '../class/customer_order.php';

$cus_login = new LoginRegister();
$customer_login = $cus_login->getAllLoginInfo();
//debugger($customer_login);
$login_id=$customer_login[0]->id;
$cus_info = new Customer_info();
$customer_cus_info = $cus_info->getCustomerById($login_id);
//debugger($customer_c_info);
//$customer_info = $cus_info->getAllInfo();
//debugger($customer_info,true);

$cus_order = new Customer_order();
//$customer_cus_order = $cus_order->getAllOrderByCInfoId($customer_cus_info[0]->id);
//debugger($customer_c_order,true);
//$customer_order = $cus_order->getAllOrderByCInfoId($customer_info[1]->id);
//debugger($_SESSION,true);
      ?>
    <div class="container body">
      <div class="main_container">
<?php include 'inc/sidebar.php'; ?>
        <!-- /page content -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php getFlash();?>
            <div class="page-title">
              <div class="title_left">
                <h3>Order Management Page</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Order List Table</h2>
                   
                   
                    <div class="clearfix"></div>
                  </div>
          <div class="x_content">

                    <?php  foreach($customer_login as $key => $login) {
                       $customer_c_info = $cus_info->getCustomerById($login->id);
                      if($customer_c_info){
                     ?>
                        <h2>Account Holder:<?php echo " ".$login->first_name." ".$login->last_name; ?>
                           </h2>
                           <h2>Email Address:<?php echo " ".$login->email; ?></h2>
                       <h3 style=" padding-top:5px; padding-bottom: 5px;margin-top: 5px;" align="center">Cusotmer Info And Ordered Product Info
                          </h3>

            <div class="row table_prop">
                <?php 
                    // $customer_c_info = $cus_info->getCustomerById($login->id);
                     foreach($customer_c_info as $key => $info) { ?>
                     <h3><button onclick="removeAll(<?php echo $info->id; ?>);" >Remove</button></h3> 
                    <div class="row"> 
                    <div class="pull-left">
                     <table style="max-width: 300px;"  class="table table-bordered table-hover">
                      <thead>
                       

                      </thead>
                     
                       
                   
                   <tbody>
                      <tr>
                        <th>Customer Email</th>
                        <td><?php echo $info->email; ?></td>
                      </tr>
                       <tr>
                         <th>Address</th>
                         <td><?php echo $info->address; ?></td>
                       </tr>
                       <tr>
                         <th>City</th>
                         <td><?php echo $info->city; ?></td>
                       </tr>
                       <tr>
                         <th>Country</th>
                         <td><?php echo $info->country; ?></td>
                       </tr>
                       <tr>
                         <th>Zip Code</th>
                         <td><?php echo $info->zip_code; ?></td>
                       </tr>
                       <tr>
                         <th>Telephone</th>
                         <td><?php echo $info->telephone; ?></td>
                       </tr>
                     </tbody>
                     </table></div>
                     <div class="pull-left">
                     <table style="max-width: 772px;" class="table table-bordered table-hover">

                       <thead>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total Amount</th>
                         <th>Actual Amount<br>With VAT</th>
                         <th>Added Date</th>
                         <th>Status</th>
                       </thead>
                      <tbody>
                        <?php $customer_c_order = $cus_order->getAllOrderByCInfoId($info->id);
                              foreach($customer_c_order as $key => $order) { ?>
                       <tr>
                         <td><?php echo $order->product_name; ?></td>
                          <td><?php echo $order->product_price ?></td>
                           <td><?php echo $order->quantity; ?></td>
                            <td><?php echo $order->total_amount; ?></td>
                             <td><?php echo $order->amount_with_vat; ?></td>
                              <td><?php echo $order->added_date; ?></td>
                              <td><?php  if($order->status ==1){echo 'Left to be delivered <button onclick="delivered('.$order->id.');"><i class="fa fa-check-circle"></i></button>';}else{echo 'Delivered     <button onclick="removeOrder('.$order->id.');"><i class="fa fa-trash"></i></button>';} ?></td>
                       </tr>
                      <?php } ?>
                       </tbody>
                     </table></div>
                   </div>
                    <hr >
                <?php  } ?>
            </div>
                   <hr style="border: 2px solid red;">
                     <?php } } ?>
                   
          </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- footer content -->
        <?php include 'inc/copy.php'; ?>
        <!-- /footer content -->
      </div>
    </div>

<script src="<?php echo CMS_VENDORS;?>jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo CMS_VENDORS;?>bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo CMS_VENDORS;?>fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo CMS_VENDORS;?>nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo CMS_JS;?>custom.min.js"></script>
    
     <script src="<?php echo CMS_JS;?>jquery.dataTables.min.js"></script>
 <script type="text/javascript">
    // $('.table').DataTable();
    // $('.table_prop').DataTable();
    function removeAll(cusinfo_id){
      $.post('inc/api1.php',{customer_id:cusinfo_id, act:"<?php echo substr(md5('remove-all-order'), 3,15); ?>"},function(res){
        
        document.location.href = document.location.href;
      });
    }

    function delivered(pro_order_id){
      $.post('inc/api1.php',{order_id:pro_order_id, act:"<?php echo substr(md5('deliverd-this-order'), 3,15); ?>"},function(res){
        //alert(res);
        document.location.href = document.location.href;
      });
    }

    function removeOrder(order_id){
      $.post('inc/api.php',{order_id:order_id, act:"<?php echo substr(md5('remove-this-order'), 3,15); ?>"},function(res){
       // alert(res);
        document.location.href = document.location.href;
      });
    }

  setTimeout(function(){
    $('.alert').slideUp('slow');
    }, 5000);
   function viewThumbnail(input, thumbnail_id = 'thumbnail_img'){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#'+thumbnail_id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
   }
 </script>
  </body>
</html>

    <!-- jQuery -->
    