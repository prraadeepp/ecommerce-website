<?php 
	if($current_page != 'index'){
 ?>
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
    <?php } ?> 
 <script type="text/javascript">
     $('.table').DataTable();
 	setTimeout(function(){
 		$('.alert').slideUp('slow');
    }, 5000);
   function viewThumbnail(input, thumbnail_id = ''){
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
