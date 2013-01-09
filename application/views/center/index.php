<?php
$this->load->view(
	'header',
	array(
		'title' => 'せんたー',
		'css'   => array('center.css', 'datepicker.css'),
		'js'    => array('holder.js', 'jquery.center.js', 'bootstrap-datepicker.js', '/locales/bootstrap-datepicker.ja.js'),
	)
);
?>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container-fluid">
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </a>
	  <a class="brand page_reload" href="#">たすくん</a>
	  <div class="nav-collapse collapse">
		<form class="navbar-form pull-right">
		  <button type="button" class="btn btn-info" id="lnk__task-add">タスク登録</button>
		</form>
		<!--
		<ul class="nav">
		  <li class="active"><a href="#">Home</a></li>
		  <li><a href="#about">About</a></li>
		  <li><a href="#contact">Contact</a></li>
		</ul>
		-->
	  </div><!--/.nav-collapse -->
	</div><!--/.container-fluid-->
  </div><!--/.navbar-inner-->
</div><!--/.navbar-->


<div class="container-fluid">
  <div class="row-fluid">
	<div class="span3"> 

      <div class="well well-small">
        <div class="media">
          <?php if($userdata['icon']): ?>
          <a href="#" class="pull-left"><img src="<?php echo site_url('icon/'. $userdata['icon']); ?>" class="media-object img-rounded"></a>
          <?php else :?>
          <a href="#" class="pull-left"><img src="<?php echo site_url('img/noimage.png');?>" class="media-object img-rounded"></a>
          <?php endif?>
          <div class="media-body top-add">
            <h4 class="media-heading"><?php echo htmlspecialchars($userdata['name']); ?></h4>
            <?php echo htmlspecialchars($userdata['email']); ?>
          </div><!--/.media-body-->
        </div><!--/.media-->
      </div><!--/.well -->

	  <div class="well sidebar-nav">
		<ul class="nav nav-list">
		  <li class="nav-header">タスクもろもろ</li>
		  <li class="active"><a href="#" id="lnk__center-tasklists"><i class="icon-list"></i>一覧</a></li>
		  <li><a href="#"><i class="icon-star"></i> じぶんのToDo</a></li>
		  <li><a href="#"><i class="icon-gift"></i> 依頼しているタスク</a></li>
		  <li><a href="#"><i class="icon-inbox"></i> お願いされたタスク</a></li>

          <li class="nav-header">仲間</li>
          <li><a href="#"><i class="icon-user"></i>友達の追加</a></li>
          <li><a href="#" id="lnk__friend-index"><i class="icon-heart"></i>友達リスト</a></li>
          <li><a href="#" id="lnk__group-index"><i class="icon-flag"></i>グループ</a></li>
          <li><a href="#"><i class="icon-search"></i>新規検索</a></li>

		  <li class="nav-header">設定</li>
		  <li><a href="#" id="lnk__user-change_email"><i class="icon-envelope"></i> メールアドレス変更</a></li>
		  <li><a href="#" id="lnk__auth-change_password"><i class="icon-edit"></i> パスワード変更</a></li>
		  <li><a href="#" id="lnk__user-change_name"><i class="icon-tag"></i> 登録名変更</a></li>
		  <li class="visible-desktop"><a href="#" id="lnk__user-change_icon"><i class="icon-picture"></i> アイコン変更</a></li>
		  <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="icon-off"></i> ログアウト</a></li>
		</ul>
	  </div><!--/.well -->
	</div><!--/span-->

	<div class="span9" id="main-field">

	  <div class="row-fluid">
		<div class="span12">
          now loading...
        </div><!--/span-->
	  </div><!--/row-->

	</div><!--/span-->
  </div><!--/row-->

  <hr />

  <footer>
    <p>&copy; Moobay9 2012</p>
  </footer>
</div><!--/.fluid-container-->

<?php $this->load->view('footer'); ?>
