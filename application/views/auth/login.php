<?php
	$this->load->view(
		'header',
		array(
			'title' => 'ログイン',
			'css'   => array('minibox.css'),
		)
	); 
?>

<div class="container">

  <?php echo form_open('auth/login_authorize', array('class' => 'form-signin')); ?> 
	<h3 class="form-signin-heading">ログイン</h3>
	<input type="text" name="email" class="input-block-level" placeholder="メールアドレス" value="<?php echo set_value('email'); ?>" />
	<input type="password" name="password" class="input-block-level" placeholder="パスワード">
    <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?> 
	<?php if(isset($err_msg)):?>
	<div class="alert alert-error"><?php echo $err_msg; ?></div>
	<?php endif; ?>
	<button class="btn btn-large btn-primary" type="submit">認証</button>
  </form>

</div> <!-- /container -->

<?php $this->load->view('footer'); ?>
