
<?php 
include 'inc/header.php' ;
require 'inc/session.php';
     //echo getFlash();
require '../class/banner.php';

$banner = new Banner();
$all_banner= $banner -> getBanner();
     //debugger($all_banner, true);

      ?>
    <div class="container body">
      <div class="main_container">
<?php include 'inc/sidebar.php'; ?>
        <!-- /page content -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php getFlash(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Banner Page</h3>
              </div>
              <div class="pull-right">
                <button class="btn btn-success" id="add_banner_btn" data-toggle="modal" data-target="#banner_add_modal"><i class="fa fa-plus"></i>Add Banner</button>
              </div>
             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Banner List </h2>
                   
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <th>S.N</th>
                          <th>Title</th>
                          <th>Link</th>
                          <th>Summary</th>
                           <th>Thumbnail</th>
                           <th>Status</th>
                          <th>Action</th>
                         </thead>
                         <tbody>
                          <?php 
                          if ($all_banner) {
                            foreach($all_banner as $key=> $banner_info){
                              ?>
                              <tr>
                                <td><?php echo $key+1; ?>.</td>
                                <td><?php echo $banner_info->title; ?></td>
                                <td><?php echo $banner_info->link; ?></td>
                                <td><?php echo $banner_info->summary; ?></td>
                                <td>
                                   <?php 
                                    if ($banner_info->image !="" &&file_exists(UPLOAD_DIR.'/banner/'.$banner_info->image)) {
                                      ?>
                                  <div class="img img-responsive">
                                  <img src="<?php echo UPLOAD_URL.'banner/'.$banner_info->image;?>" alt="" class="img img-thumbnail" style="max-width: 100px;" >
                                </div>
                                <?php 
                              }
                                 ?>
                                </td>
                                <td><?php echo ($banner_info->status == 1)?'Active':'Inactive'; ?></td>
                                <td>
                                 <button class="btn btn-success edit-banner" value='<?php echo json_encode($banner_info); ?>'><i class="fa fa-pencil"></i></button>
                                  <?php 
                                  $url="process/banner?id=".$banner_info->id."&act=".substr(md5($_SESSION['session_id'].'del_banner-'.$banner_info->id), 5, 15)
                                  ?>
                                  <a href="<?php echo $url; ?>" class="btn btn-danger" onclick= "return confirm('Are you sure you want to delete this banner?');"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                      <?php    
                        }
                          }
                           ?>
                           
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="banner_add_modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form action="process/banner" id="form-reset" method="post" enctype="multipart/form-data" class="form form-horizontal">
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Banner</h4>

      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="control-label col-sm-3">Title:</label>
          <div class="col-sm-8">
            <input type="text" id="title" name="title" required placeholder="Enter Title Here " class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3">Summary:</label>
        <div class="col-sm-8">
        <textarea name="summary" id="summary" rows="5" class="form-control" style="resize: none;"></textarea>
      </div></div>

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
            <label class="control-label col-sm-3">Image:</label>
            <div class="col-sm-4">
              <input type="file" name="banner_image" onchange="viewThumbnail(this)"  id="banner_image" accept="image/*">
            </div>
            <div class="col-sm-4 img-responsive">
              <img src=""  id="thumbnail_img" class="img img-thumbnail">
            </div>
        </div>
      </div>
        <div class="modal-footer">
          <input type="hidden" name="banner_id"  value="0" id="banner_id">
          <input type="hidden" name="default_img"  value="" id="banner_img">
          <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>


    </form>
        </div>
      </div>
    </div>
    
<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
  $('#add_banner_btn').click(function(){
      $('#form-reset')[0].reset();
      $('#thumbnail_img').attr('src','');
  });
  $('.table').DataTable();

  $('.edit-banner').click(function(){
    var current_tag = $(this).val();
    if (current_tag != "") {
      var banner_info = $.parseJSON(current_tag);

      $('.modal-title').html('Edit Banner');
      $('#title').val(banner_info.title);
      $('#summary').val(banner_info.summary);
      $('#link').val(banner_info.link);
      $('#status').val(banner_info.status);
      $('#thumbnail_img').attr('src','<?php echo UPLOAD_URL."banner/"; ?>'+banner_info.image);
      $('#banner_id').val(banner_info.id);
      $('#banner_img').val(banner_info.image);
      $('#banner_add_modal').modal('show');
    }else{
      alert('Banner not exits. Please reload the page.');
    }
  });
  function viewThumbnail(input){
    console.log(input.files[0]);
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function (e){
        $('#thumbnail_img').attr('src',e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }



  }
</script>
    <!-- jQuery -->
    <!-- <script type="text/javascript">
    $('#add_banner_btn').click(function(){
      $('#banner_add_modal').modal('show');
    });
  </script> -->