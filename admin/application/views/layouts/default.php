<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Real Admin - Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Real, Admin, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo asset('admin/ico/apple-touch-icon-144-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo asset('admin/ico/apple-touch-icon-114-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo asset('admin/ico/apple-touch-icon-72-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo asset('admin/ico/apple-touch-icon-57-precomposed.png') ?>">
        <link rel="shortcut icon" href="<?php echo asset('admin/ico/favicon.png') ?>">

        <title><?php echo $template['title']; ?></title>
        <?php echo $template['metadata']; ?>

          <!-- Bootstrap core CSS -->
        <link href="<?php echo asset('admin/css/bootstrap.min.css') ?>" rel="stylesheet" id="bootstrap-style">
    
        <!-- Remove following comment to add Right to Left Support or add class rtl to body -->
        <!-- <link href="assets/css/bootstrap-rtl.min.css" rel="stylesheet"> -->
        
        <link href="<?php echo asset('admin/css/jquery.mmenu.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('admin/css/simple-line-icons.css') ?>" rel="stylesheet">
        <link href="" rel="stylesheet">
        
        <!-- page css files -->
        <link href="<?php echo asset('admin/css/climacons-font.css') ?>" rel="stylesheet">

        <link href="<?php echo asset('admin/plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('admin/plugins/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
        
        <link href="<?php echo asset('admin/plugins/morris/css/morris.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('admin/plugins/daterangepicker/css/daterangepicker-bs3.css') ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo asset('admin/css/style.min.css') ?>" rel="stylesheet" id="main-style">
        <link href="<?php echo asset('admin/css/add-ons.min.css') ?>" rel="stylesheet" id="main-style">
        <link href="<?php echo asset('admin/css/font-awesome.css') ?>" rel="stylesheet" id="main-style">
        <link href="<?php echo asset('admin/css/social.css') ?>" rel="stylesheet" id="main-style">
                
        <!-- Remove following comment to add Right to Left Support or add class rtl to body -->
        <!-- <link href="assets/css/style.rtl.min.css" rel="stylesheet"> -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <link rel="stylesheet" href="<?php echo asset('node_modules/jasny-bootstrap/dist/css/jasny-bootstrap.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/select2/dist/css/select2.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker-standalone.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('node_modules/fancybox/dist/css/jquery.fancybox.css') ?>">

        <?php echo isset($template['partials']['stylesheet']) ? $template['partials']['stylesheet'] : ''; ?>

        <script src="<?php echo asset('node_modules/jquery/dist/jquery.min.js') ?>"></script>
    </head>
    <body>

        <?php echo $this->template->load_view('template/navbar'); ?> 

        <?php echo $this->template->load_view('template/sidebar'); ?>
            
        
        <div class="main">              
            <?php echo show_message() ?>

            
            <?php echo $template['body']; ?>

        </div>

        <script>
            var baseurl = '<?php echo base_url(); ?>';
            var siteurl = '<?php echo site_url(); ?>';
        </script>

        <script src="<?php echo asset('node_modules/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') ?>"></script>
        <script src="<?php echo asset('node_modules/moment/moment.js') ?>"></script>        
        <script src="<?php echo asset('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>
        <script src="<?php echo asset('node_modules/select2/dist/js/select2.min.js') ?>"></script>
        <script src="<?php echo asset('plugins/tinymce/tinymce.jquery.min.js') ?>"></script>

        <!-- start: JavaScript-->
        <!--[if !IE]>-->

        <!--<![endif]-->

        <!--[if IE]>

            <script src="assets/js/jquery-1.11.1.min.js"></script>

        <![endif]-->

        <!--[if !IE]>-->

            <script type="text/javascript">
                window.jQuery || document.write("<script src='<?php echo asset('admin/js/jquery-2.1.1.min.js') ?>'>"+"<"+"/script>");
            </script>

        <!--<![endif]-->

        <!--[if IE]>

            <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo asset('admin/js/jquery-1.11.1.min.js') ?>'>"+"<"+"/script>");
            </script>

        <![endif]-->


        <script src="<?php echo asset('admin/js/jquery.dataTables.min.js') ?>"></script>

        <script src="<?php echo asset('admin/js/jquery-migrate-1.2.1.min.js') ?>"></script>
        <script src="<?php echo asset('admin/js/bootstrap.min.js') ?>"></script>

        <script src="<?php echo asset('admin/js/pages/ui-elements.js') ?>"></script>


        <script src="<?php echo asset('admin/plugins/jquery-ui/js/jquery-ui-1.10.4.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/moment/moment.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/flot/jquery.flot.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/flot/jquery.flot.time.js') ?>"></script>
        

        <script src="<?php echo asset('admin/plugins/autosize/jquery.autosize.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/placeholder/jquery.placeholder.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/nestable/jquery.nestable.min.js') ?>"></script>

        <script src="<?php echo asset('admin/plugins/datatables/js/dataTables.bootstrap.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/raphael/raphael.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/morris/js/morris.min.js') ?>"></script>

        <script src="<?php echo asset('admin/plugins/gauge/gauge.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/daterangepicker/js/daterangepicker.min.js') ?>"></script>
        <script src="<?php echo asset('admin/plugins/wysiwyg/bootstrap-wysiwyg.min.js') ?>"></script>


        <!-- theme scripts -->
        <script src="<?php echo asset('admin/plugins/pace/pace.min.js') ?>"></script>
        <script src="<?php echo asset('admin/js/jquery.mmenu.min.js') ?>"></script>
        <script src="<?php echo asset('admin/js/core.min.js') ?>"></script>


        <!-- inline scripts related to this page -->
        <script src="<?php echo asset('admin/plugins/jquery-cookie/jquery.cookie.min.js') ?>"></script>
        <script src="<?php echo asset('admin/js/demo.min.js') ?>"></script>
        <script src="<?php echo asset('node_modules/jquery-chained/jquery.chained.remote.js') ?>"></script>
        <script src="<?php echo asset('node_modules/fancybox/dist/js/jquery.fancybox.pack.js') ?>"></script>
        <!-- end: JavaScript-->
        <script src="<?php echo asset('javascript/analytic.js') ?>"></script>
        <script src="<?php echo asset('javascript/custom.js') ?>"></script>
        <?php echo isset($template['partials']['script']) ? $template['partials']['script'] : ''; ?>
    </body>
</html>
  
