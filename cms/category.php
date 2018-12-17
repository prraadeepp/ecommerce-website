
<?php include 'inc/header.php' ;
require 'inc/session.php';
require '../class/category.php';
$category = new Category();

$parent_cats = $category->getAllParentCats();
$all_category = $category->getAllCategory();
//debugger($all_category,true);
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
                <h3>Category Page</h3>
              </div>
              <div class="pull-right">
                <button class="btn btn-success" id="add_category_btn" data-toggle="modal" data-target="#cat_add_modal"><i class="fa fa-plus"></i>Add Category</button>
              </div>
             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Category Lists</h2>
                   
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <table class="table table-bordered table-hover">
                        <thead>
                          <th>S.N</th>
                          <th>Title</th>
                          <th>Thumbnail</th>
                          <th>Is Parent</th>
                          <th>Show in Menu</th>
                          <th>Show in </br> Home Tab</th>
                          <th>Status</th>
                          <th>Action</th>
                         </thead>
                         <tbody>
                          <?php 
                          if($all_category){
                            foreach($all_category as $key => $cat_info){
                                ?>
                                <tr>
                                  <td> <?php echo $key+1; ?> </td>
                                  <td><?php echo $cat_info->title; ?></td>
                                  
                                  <td>
                                    <?php 
                                    if ($cat_info->featured_image !="" &&file_exists(UPLOAD_DIR.'/category/'.$cat_info->featured_image)) {
                                      ?>
                                      <div class="img img-responsive">
                                        <img src="<?php echo UPLOAD_URL.'category/'.$cat_info->featured_image;?>" class="img img-thumbnail" style="width:150px;">
                                      </div>
                                      <?php
                                    } 
                                    ?>
                                  </td>
                                  <td><?php echo ($cat_info->is_parent == 1) ? 'Yes': 'No'; ?></td>
                                  <td><?php echo ($cat_info->show_in_menu == 1) ? 'Yes':'No'; ?></td>
                                   <td><?php echo ($cat_info->show_in_home_tab == 1) ? 'Yes':'No'; ?></td>
                                 
                                  <td><?php echo ($cat_info->status == 1) ? 'Active':'Inactive'; ?></td>
                                  <td>
                                    <a href="javascript:;"  class='btn btn-link' onclick='editCategory(<?php echo json_encode($cat_info); ?>)'><i class="fa fa-pencil"></i>Edit</a>
                                    <?php 
                                    $url = "process/category?id=".$cat_info->id."&act=".substr(md5($_SESSION['session_id'].'del-cat-'.$cat_info->id), 3, 15);
                                     ?>
                                     <a href="<?php echo $url; ?>" onclick= "return confirm('Are you sure you want to delete this category?');" class='btn btn-link'>
                                       <i class="fa fa-trash"></i>Delete
                                     </a>
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="cat_add_modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form action="process/category" id="form-reset" method="post" enctype="multipart/form-data" class="form form-horizontal">
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-sm-3 control-label">Title:</label>
          <div class="col-sm-8">
            <input type="text" required class="form-control" placeholder="Enter Category Title" name="title" id="title">
          </div>
        </div>
         <div class="form-group">
          <label class="col-sm-3 control-label">Summary:</label>
          <div class="col-sm-8">
           <textarea class="form-control" id="summary" name="summary" rows="6" style="resize: none;" ></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Status:</label>
          <div class="col-sm-8">
            <select name="status" id="status" required class="form-control">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Is Parent:</label>
          <div class="col-sm-8">
            <input type="checkbox" name="is_parent" id="is_parent" checked value="1">Yes
          </div>
        </div>
        <div class="form-group hidden" id="parent_cat_div">
          <label class="control-label col-sm-3">Parent Category:</label>
        <div class="col-sm-8">
          <select class="form-control" name="parent_id" id="parent_id">
            <option value="" selected disabled> --Select Any One--</option>
           <?php 
              if ($parent_cats) {
                foreach ($parent_cats as $cats ) {
                  ?>
                  <option value="<?php echo $cats->id; ?>"><?php echo $cats->title; ?></option>
                  <?php
                }
              }
            ?>
          
          </select>
        </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Show in Menu:</label>
          <div class="col-sm-8">
            <input type="checkbox"  id="show_in_menu" name="show_in_menu" checked value="1">Yes
          </div>

        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Show in Home Tab:</label>
          <div class="col-sm-8">
            <input type="checkbox" id="show_in_home_tab" name="show_in_home_tab" checked value="1">Yes
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Featured Image:</label>
          <div class="col-sm-4">
            <input type="file" name="featured_image" alt="" accept="image/*" id="image_uploader" onchange="viewThumbnail(this)">
          </div>
          <div class="col-sm-4">
            <img src="" id="thumbnail_img" alt="" class="img img-thumbnail">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="category_id"  value="" id="category_id">
          <input type="hidden" name="default_img"  value="" id="default_img">
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>
</div>
<?php include 'inc/footer.php'; ?>
    <!-- jQuery -->
    <script type="text/javascript">
       $('#add_category_btn').click(function(){
              $('#form-reset')[0].reset();
              $('#thumbnail_img').attr('src','');
          });

 function editCategory(cat_info){

      console.log(cat_info);
      $('.modal-title').html('Edit Category');
      $('#title').val(cat_info.title);
      $('#summary').val(cat_info.summary);
      $('#status').val(cat_info.status);
      $('#thumbnail_img').attr('src','<?php echo UPLOAD_URL."category/"; ?>'+cat_info.featured_image);
     
     if(cat_info.is_parent == 0){
      $('#is_parent').prop('checked', false);
      $('#parent_cat_div').removeClass('hidden');
      $('#parent_id').val(cat_info.parent_id);
     }
       
       if(cat_info.show_in_home_tab == 0){
       $('#show_in_home_tab').prop('checked', false);
       }

       if(cat_info.show_in_menu == 0){
        $('#show_in_menu').prop('checked', false);
       }
       $('#category_id').val(cat_info.id);
       $('#default_img').val(cat_info.featured_image);
        $('#cat_add_modal').modal('show');
    }

  

     $('#is_parent').click(function(){
      var checked = $('#is_parent').prop('checked');
      if(checked == true){
        $('#parent_cat_div').addClass('hidden');

      }else{
        $('#parent_cat_div').removeClass('hidden');
      }
     });

    </script>