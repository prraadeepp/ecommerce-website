<?php 
    require '../config/config.php';
    require '../config/function.php';
    require '../class/database.php';
    $current_page = getCurrentPage();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo ADMIN_PAGE_TITLE;?> | <?php echo ($current_page == 'index') ? 'Login' : ucfirst($current_page);?> </title>

    <!-- Bootstrap -->
    <link href="<?php echo CMS_VENDORS;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo CMS_VENDORS;?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo CMS_VENDORS;?>nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo CMS_CSS;?>custom.min.css" rel="stylesheet">
  </head>
  <body class="<?php echo ($current_page == 'index') ? 'login' : 'nav-md'; ?>">