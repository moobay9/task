<?php
	$this->load->view(
		'header',
		array(
			'title' => 'ログアウト',
			'css'   => array('minibox.css'),
		)
	); 
?>

<div class="container">
	<h3 class="form-signin-heading">ログアウト</h3>
	<div class="span12 well">ログアウトしました</div>
</div><!-- /container -->

<?php $this->load->view('footer'); ?>
