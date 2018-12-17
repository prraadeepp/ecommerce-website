
<?php 
include 'inc/header.php' ;
require 'inc/session.php';
require_once '../config/function.php';
require_once '../class/database.php';
require_once '../class/category.php';
require_once '../class/product.php';

$cat_info = new Category();
  $all_category_info = $cat_info -> getAllParentCats(); 
 //
//debugger($_GET,true);
$act = "add";
if (isset($_GET['id'],$_GET['act']) && $_GET['id'] ==!"" && $_GET['act'] == !"") {
  if ($_GET['act'] == substr(md5($_SESSION['session_id']."edit-product".$_GET['id']), 5,15)) {
    $act= "edit";
    $id = (int)$_GET['id'];
     $product = new Product();
      $product_info = $product->getProductById($id);
        $cat_id = $product_info[0]->cat_id;
       $category_info = $cat_info -> getCategoryById($cat_id); 
       $pc_id = $category_info[0]->id;
       $child_info = $cat_info-> getChildByParentId($pc_id);
      // debugger($child_info,true);
     // debugger($product_info[0]->cat_id,true);
     // debugger($product_info,true);
      if (!$product_info) {
        setFlash("error","Invalid product Id.");
        @header('location:product');
        exit;
      }
    
  }else{
    setFlash("error","Invalid token number!");
    @header('location:product');
    exit;
  }
}
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
                <h3>Product <?php echo ucfirst($act); ?> Page</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo ucfirst($act); ?> Product</h2>
                   
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <form action="process/product" method="post" enctype="multipart/form-data" class="form form-horizontal">
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Product Title:</label>
                         <div class="col-sm-8">
                           <input class="form-control" type="text" name="title" placeholder="Enter the title of the product..." value="<?php echo (isset($product_info[0]->title)) ? $product_info[0]->title :''; ?>">
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Summary:</label>
                         <div class="col-sm-8">
                           <textarea  class="form-control" style="resize: none;" rows ="6" type="text" name="summary"  value=""><?php echo (isset($product_info[0]->summary)) ? $product_info[0]->summary :'';?></textarea>
                           </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Description:</label>
                         <div class="col-sm-8">
                           <textarea  class="form-control" style="resize: none;" rows ="6" type="text" name="description" id="description"  value=""><?php echo (isset($product_info[0]->description)) ? html_entity_decode($product_info[0]->description) :'';?></textarea>
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Category:</label>
                         <div class="col-sm-8">
                           <select class="form-control" name="cat_id" id="cat_id">
                             
                             <?php 
                            // if($product_info){
                             
                             if ($category_info) {
                               
                                 ?>
                                 <option selected value="<?php echo $category_info[0]->id; ?>"><?php echo $category_info[0]->title; ?></option>
                                 <?php
                                 }else{
                                  ?>
                                  <option selected value="0">--Select Any One--</option>
                                  <?php }

                                  if($all_category_info){
                                  foreach($all_category_info as $parent){
                                  ?>
                                  <option value="<?php echo $parent->id;?>"><?php echo ($parent->title); ?></option>
                                  <?php
                                  }
                                }
                            
                                
                             
                              ?>

                           </select>
                         </div>
                       </div>

                        <div class="form-group <?php echo (isset($product_info[0]->child_cat_id) && !empty($product_info[0]->child_cat_id))? '' :'hidden'; ?>" id="child_cat_div">
                          <label for="" class="col-sm-3 control-label">Child Category:</label>
                          <div class="col-sm-8">
                            <select name="child_cat_id" id="child_cat_id" class="form-control">
                              <option value="<?php echo isset($child_info)? $child_info[0]->id :''; ?>" selected > <?php echo $child_info[0]->title; ?></option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                         <label class="col-sm-3 control-label">Price NRS:</label>
                         <div class="col-sm-8">
                           <input class="form-control" type="number" name="price" id="price" placeholder="Enter the price of the product..." value="<?php echo (isset($product_info[0]->price)) ? $product_info[0]->price :'';?>">
                         </div>
                       </div>

                        <div class="form-group">
                         <label class="col-sm-3 control-label">Discount:</label>
                         <div class="col-sm-8">
                           <input class="form-control" type="number" name="discount" id="discount" placeholder="Enter the discount of the product..." value="<?php echo (isset($product_info[0]->discount)) ? $product_info[0]->discount :'';?>">
                         </div>
                       </div>
                       
                        <div class="form-group">
                         <label class="col-sm-3 control-label">Brand:</label>
                         <div class="col-sm-8">
                           <input class="form-control" type="text" name="brand" id="brand" placeholder="Enter the brand of the product..." value="<?php echo (isset($product_info[0]->brand)) ? $product_info[0]->brand :'';?>">
                         </div>
                       </div>

                        <div class="form-group">
                         <label class="col-sm-3 control-label">Size:</label>
                         <div class="col-sm-8">
                           <input class="form-control" type="text" name="size" id="size" placeholder="Enter the size of the product..." value="<?php echo (isset($product_info[0]->size)) ? $product_info[0]->size :'';?>">
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Color:</label>
                         <div class="col-sm-8">
                           <input class="form-control" type="text" name="color" id="color" placeholder="Enter the color of the product..." value="<?php echo (isset($product_info[0]->color)) ? $product_info[0]->color :'';?>">
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Availability:</label>
                         <div class="col-sm-8">
                          <select class="form-control" name="status" id="status" > 
                          <option value="1" selected>Available</option>
                          <option value="0">Unavailable</option>
                          <option value="2">Stock not found</option>
                          </select>
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Image:</label>
                         <div class="col-sm-8">
                          <input type="file" name="product_image[]" id="product_image" onchange="viewThumbnail(this)"  multiple accept="image/*">
                         </div>
                         <div class="col-sm-4">
                            <img src="" id="thumbnail_img" alt="" class="img img-thumbnail">
                            <input type="hidden" name="default_img" id="default_img" value="<?php echo $product_info[0]->images; ?>">
                         </div>
                         
                       
                          <?php 
                         
                         if (isset($product_info[0]->images) && $product_info[0]->images !="")  {
                             $pre_images=explode(",", $product_info[0]->images);
                             //print_r($pre_images);
                              //echo file_exists(UPLOAD_URL.'product/'.$pre_images[0]);
                            //if(file_exists(UPLOAD_URL.'product/'.$pre_images[0])){
                            //echo UPLOAD_URL.'product/'.$pre_images[0];
                            $i=0;

                            while($i<1){
                              ?>
                              <div class="col-sm-3 img_responsive">
                              
                              <img src="<?php echo UPLOAD_URL.'product/'.$pre_images[$i]; ?>" class="img img-thumbnail">
                              </div>
                              <?php
                              $i++;
                            }
                          
                          } ?>
                         
                         
                       </div>

                       <div class="form-group">
                       <label class="col-sm-3 control-label"></label>
                       <a href="product.php" type="reset" class="btn btn-danger"><i class="fa fa-trash"></i>Cancel</a>
                       <button class="btn btn-success"><i class="fa fa-submit"></i>Submit</button>
                       <input type="hidden" name="pro_id" value="<?php echo (isset($product_info[0]->id))?$product_info[0]->id:''; ?>">
                       </div>

                     </form>
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
     <script type="text/javascript" src="<?php echo CMS_TINYMCE.'tinymce.min.js'; ?>"> </script>
     <script type="text/javascript">
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
     
  $('#cat_id').change(function(){
    var cat_id = $('#cat_id').val();
    $.post('inc/api', {category_id: cat_id, act: "<?php echo substr(md5('get-child-cat-'.$_SESSION['session_id']), 5, 15); ?>"}, function(data){
      var option_tag = '<option value="" selected disabled>-- Select Any One--</option>';
      if (data != 0) {
        var child_data = $.parseJSON(data);//converts json string to javascript's object array
        $.each(child_data, function(key, value){
          option_tag += '<option value ="'+value.id+'">'+value.title+'</option>';
        });
        $('#child_cat_id').html(option_tag);
        $('#child_cat_div').removeClass('hidden');

      }else{
        $('#child_cat_id').html(option_tag);
        $('#child_cat_div').addClass('hidden');
      }
    });



  });




     </script>

