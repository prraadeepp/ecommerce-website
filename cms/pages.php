
<?php 
include 'inc/header.php' ;
require 'inc/session.php';
//require '../class/database.php';
require_once '../class/pages.php';

$pages = new Pages();
$page_info=$pages-> getAllPages();
//debugger($page_info, true);
      ?>

    <div class="container body">
      <div class="main_container">
        <!-- /page content -->
<?php include 'inc/sidebar.php'; ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php getFlash();?>
            <div class="page-title">
              <div class="title_left">
                <h3> Page Management</h3>
              </div>
              
                 <div class="pull-right">
                <button class="btn btn-success" id="add_pages_btn" data-toggle="modal" data-target="#pages_add_modal"><i class="fa fa-plus"></i>Add Pages</button>
              </div>
              
             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Pages</h2>
                   
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <table class="table table-bordered table-hover">
                       <thead>
                         <th>S.N</th>
                         <th>Title</th>
                         <th>Summary</th>
                         <th>Image</th>
                         <th>Status</th>
                         <th>Action</th>

                       </thead>
                       <tbody>
                        <?php 
                        if ($page_info) {
                          foreach ($page_info as $key => $pg_info) {
                            ?>
                            <tr>
                              <td><?php echo $key+1;  ?></td>
                              <td><?php echo $pg_info->title; ?></td>
                              <td><?php echo $pg_info->summary; ?></td>
                              <td>
                                   <?php 
                                    if ($pg_info->image !="" &&file_exists(UPLOAD_DIR.'/pages/'.$pg_info->image)) {
                                      ?>
                                  <div class="img img-responsive">
                                  <img src="<?php echo UPLOAD_URL.'pages/'.$pg_info->image;?>" alt="" class="img img-thumbnail" style="max-width: 100px;" >
                                </div>
                                <?php 
                              }
                                 ?>
                                </td>
                              <td><?php echo ($pg_info->status == 1)?'Active':'Inactive'; ?></td>
                                <td>
                                 <button class="btn btn-success edit-page" value='<?php echo json_encode($pg_info); ?>'><i class="fa fa-pencil"></i></button>
                                  <?php 
                                  $url="process/pages?id=".$pg_info->id."&act=".substr(md5($_SESSION['session_id'].'del_page-'.$pg_info->id), 5, 15)
                                  ?>
                                  <a href="<?php echo $url; ?>" class="btn btn-danger" onclick= "return confirm('Are you sure you want to delete this page?');"><i class="fa fa-trash"></i></a>
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="pages_add_modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form action="process/pages" id="form-reset" method="post" enctype="multipart/form-data" class="form form-horizontal">

        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Pages</h4>
      </div>
      <div class="modal-content">
          <div class="form-group">
            <label class="col-sm-3 control-label">Title:</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" name="title" id="title">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Summary:</label>
            <div class="col-sm-8">
              <textarea class="form-control"  rows="5" name="summary" id="summary"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Description:</label>
            <div class="col-sm-8">
              <textarea type="text" class="form-control" name="description" id="description" rows="8" style="resize: vertical;" value=""></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Image:</label>
            <div class="col-sm-4">
              <input type="file" name="image" id="image" accept="image/*" onchange="viewThumbnail(this)">
            </div>
             <div class="col-sm-4 img-responsive">
              <img src="" alt="" id="thumbnail_img" class="img img-thumbnail">
            </div>
            
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Status:</label>
            <div class="col-sm-8">
              <select name="status" id="status"  class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>


      </div>
      <div class="modal-footer">
         <input type="hidden" name="pages_id"  value="" id="pages_id">
          <input type="hidden" name="default_img"  value="" id="pages_img">
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>
</div>
<?php include 'inc/footer.php'; ?>



    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo CMS_TINYMCE.'tinymce.min.js'; ?>"> </script>
<script type="text/javascript">
  $('#add_pages_btn').click(function(){
      $('#form-reset')[0].reset();
      $('#thumbnail_img').attr('src','');
  });

  $('.edit-page').click(function(){
    var current_tag = $(this).val();
    if (current_tag != "") {
      var page_info = $.parseJSON(current_tag);

      $('.modal-title').html('Edit Page');
      $('#title').val(page_info.title);
      $('#summary').val(page_info.summary);
      $('#status').val(page_info.status);
      $('#thumbnail_img').attr('src','<?php echo UPLOAD_URL."pages/"; ?>'+page_info.image);
      $('#description').val(page_info.description);
      $('#pages_id').val(page_info.id);
      $('#pages_img').val(page_info.image);
      $('#pages_add_modal').modal('show');
    }else{
      alert('Page not exits. Please reload the page.');
  }
  });

    tinymce.init({
        selector:'#description',
        theme: 'modern',
  plugins: 'print preview  searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount   imagetools    contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
        });
    
  

</script>

