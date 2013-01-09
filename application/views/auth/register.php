<?php
	$this->load->view(
		'header',
		array(
			'title' => 'ユーザー登録',
			'css'   => array('minibox.css'),
		)
	); 
?>

<div class="container">

  <?php echo form_open('auth/register_authorize', array('class' => 'form-signin')); ?> 
	<h3 class="form-signin-heading">新規アカウント作成</h3>
	<input type="text" name="email" class="input-block-level" placeholder="メールアドレス" value="<?php echo set_value('email'); ?>" />
	<input type="text" name="name" class="input-block-level" placeholder="ニックネーム" value="<?php echo set_value('name'); ?>" />
	<input type="password" name="password" class="input-block-level" placeholder="パスワード">
    <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?> 
	<button class="btn btn-large btn-primary" type="submit">登録</button>
  </form>

</div> <!-- /container -->

<?php $this->load->view('footer'); ?>
