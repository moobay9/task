<?php
	$this->load->view(
		'header',
		array(
			'title' => 'メールアドレス変更',
			'css'   => array('minibox.css'),
		)
	); 
?>

<div class="container">
	<h3 class="form-signin-heading">メールアドレス変更の確認</h3>
	<div class="span12 well">メールアドレスを認証しました</div>
</div><!-- /container -->

<?php $this->load->view('footer'); ?>
