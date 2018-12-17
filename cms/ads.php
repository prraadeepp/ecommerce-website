
<?php include 'inc/header.php' ;
require 'inc/session.php';
//debugger($_SESSION,true);
    require '../class/ads.php';
    $ads = new Ads();
    $ads_info = $ads->getAllAds();
    //debugger($ads_info,true);
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
                <h3>Ads Page</h3></div>
                <div class="pull-right">
                <button class="btn btn-success " id="add_ads_btn" data-toggle="modal" data-target="#ads_add_modal"><i class="fa fa-plus"></i>Add ads</button>
                   </div>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ads Lists</h2>
                   
                    <div class="clearfix">
                      <table class="table table-bordered table-hover">
                        
                        <thead>
                          <th>S.N</th>
                          <th>Title</th>
                          <th>Image</th>
                          <th>Link</th>
                          <th>Show From</th>
                          <th>Show Until</th>
                          <th>Status</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          
                          <?php
                           if (isset($ads_info) && $ads_info !="") {
                            foreach ($ads_info as $key => $info_ads) {
                                ?>
                                <tr>
                                  <td><?php echo $key+1; ?></td>
                                  <td><?php echo $info_ads->title; ?></td>
                                  <td>
                                   <?php 
                                    if ($info_ads->image !="" && file_exists(UPLOAD_DIR.'/adv/'.$info_ads->image)) {
                                      ?>
                                  <div class="img img-responsive">
                                  <img src="<?php echo UPLOAD_URL.'adv/'.$info_ads->image;?>"  class="img img-thumbnail" style="width: 100px; height: 100px;" >
                                </div>
                                <?php 
                              }
                                 ?>
                                </td>
                                <td><?php echo $info_ads->link; ?></td>
                                <td><?php echo $info_ads->date_from; ?></td>
                                <td><?php echo $info_ads->date_to; ?></td>
                                <td><?php echo ($info_ads->status == 1)?'Active':'Inactive'; ?></td>
                                <td>
                                 <button class="btn btn-success edit-ads" value='<?php echo json_encode($info_ads); ?>'><i class="fa fa-pencil"></i></button>
                                  <?php 
                                  $url="process/ads?id=".$info_ads->id."&act=".substr(md5($_SESSION['session_id'].'del_ads-'.$info_ads->id), 5, 15)
                                  ?>
                                  <a href="<?php echo $url; ?>" class="btn btn-danger" onclick= "return confirm('Are you sure you want to delete this ads?');"><i class="fa fa-trash"></i></a>
                                </td>
                                </tr>
                                <?php
                              }  
                          } ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="x_content">
                     
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="ads_add_modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form action="process/ads" method="post" enctype="multipart/form-data" class="form form-horizontal">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Ads</h4>
            </div>
            <div class="modal-body">
              
               <div class="form-group">
          <label class="control-label col-sm-3">Title:</label>
          <div class="col-sm-8">
            <input type="text" id="title" name="title" required placeholder="Enter Title Here " class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Link:</label>
          <div class="col-sm-8">
            <input type="url" name="link" id="link" placeholder="Enter Url. " class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Status</label>
          <div class="col-sm-8">
            <select name="status" required id="status" class="form-control">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>

        
        <div class="form-group">
          <label class="control-label col-sm-3">Show From:</label>
          
          <div class="col-sm-4">
            <input type="date" name="date_from" value="" id="date_from" class="form-control">
          </div>
          <div class="col-sm-4 hidden" id="show_from">
            <input type="input" readonly name="pre_date_from" value="0000-00-00" id="pre_date_from" class="form-control">
          </div>
        </div>

        
         <div class="form-group">
          <label class="control-label col-sm-3">Show Until:</label>
          <div class="col-sm-4">
            <input type="date" name="date_to" value="" id="date_to" class="form-control">
          </div>
          <div class="col-sm-4 hidden" id="show_until">
            <input type="input"  readonly name="pre_date_to" value="0000-00-00" id="pre_date_to" class="form-control">
          </div>
        </div>
        
         <div class="form-group">
            <label class="control-label col-sm-3">Image:</label>
            <div class="col-sm-4">
              <input type="file" name="ads_image" onchange="viewThumbnail(this)"  id="ads_image" accept="image/*">
            </div>
            <div class="col-sm-4 img-responsive">
              <img src=""  id="thumbnail_img" class="img img-thumbnail">
            </div>
        </div>
           
            <div class="modal-footer">
              <input type="hidden" name="ads_id"  value="" id="ads_id">
              <input type="hidden" name="default_img"  value="" id="ads_img">
              <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php include 'inc/footer.php'; ?>
    <!-- jQuery -->
    <script type="text/javascript">
      
       $('.edit-ads').click(function(){
    var current_tag = $(this).val();
    if (current_tag != "") {
      var ads_info = $.parseJSON(current_tag);

      $('.modal-title').html('Edit Ads');
      $('#title').val(ads_info.title);
     
      //$('#summary').val(banner_info.summary);
      $('#link').val(ads_info.link);
      $('#status').val(ads_info.status);
      $('#thumbnail_img').attr('src','<?php echo UPLOAD_URL."ads/"; ?>'+ads_info.image);
      $('#ads_id').val(ads_info.id);
      $('#ads_img').val(ads_info.image);
      $('#show_until').removeClass('hidden');
      $('#show_from').removeClass('hidden');
       $('#pre_date_from').val(ads_info.date_from);
      $('#pre_date_to').val(ads_info.date_to);
      $('#ads_add_modal').modal('show');
    }else{
      alert('Banner not exits. Please reload the page.');
    }
  });

    </script>