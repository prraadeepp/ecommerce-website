
<?php include 'inc/header.php' ;
require 'inc/session.php';
require '../class/login_register.php';
$login = new LoginRegister();
$login_customers = $login->getAllLoginInfo();
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
                <h3>User Management Page</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>LoggedIn Users Account List Table</h2>
                   
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <table class="table table-bordered table-hover">
                      <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Added Date</th>
                      </thead>
                       <tbody>
                        <?php foreach($login_customers as $key => $logged_in){ ?>
                           <tr>
                           <td><?php echo $logged_in->first_name; ?></td>
                           <td><?php echo $logged_in->last_name; ?></td>
                           <td><?php echo $logged_in->gender; ?></td>
                           <td><?php echo $logged_in->email; ?></td>
                           <td><?php echo $logged_in->added_date; ?></td>
                         </tr>
                       <?php } ?>
                        
                       </tbody>
                     </table>
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
<?php include 'inc/footer.php'; ?>
    <!-- jQuery -->
    