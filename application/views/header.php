<?php echo doctype('html5'); ?> 
<html lang='ja'>
<head>

<title>
<?php echo (isset($title)) ? $title : $this->router->method; ?> 
</title>

<link rel='stylesheet' type='text/css' media='all' href='<?php echo site_url('css/bootstrap.min.css'); ?>' media='screen' />
<link rel='stylesheet' type='text/css' media='all' href='<?php echo site_url('css/bootstrap-responsive.min.css'); ?>' media='screen' />
<link rel='stylesheet' type='text/css' media='all' href='<?php echo site_url('css/jquery.Jcrop.css'); ?>' media='screen' />
<?php if(isset($css)): foreach($css as $valcss): ?>
<link rel='stylesheet' type='text/css' media='all' href='<?php echo site_url('css/'. $valcss); ?>' media='screen' />
<?php endforeach; endif; ?>

<script type='text/javascript' src='<?php echo site_url('js/jquery.min.js'); ?>'></script>
<script type='text/javascript' src='<?php echo site_url('js/bootstrap.min.js'); ?>'></script>
<?php if(isset($js)): foreach($js as $valjs): ?>
<script type='text/javascript' src='<?php echo site_url('js/'. $valjs); ?>'></script>
<?php endforeach; endif; ?>

</head>
<body>
