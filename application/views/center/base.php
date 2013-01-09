<?php
$this->load->view(
	'header',
	array(
		'title' => 'せんたー',
		'css'   => array('center.css'),
		'js'    => array('holder.js'),
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
	  <a class="brand" href="#">たすくん</a>
	  <div class="nav-collapse collapse">
		<form class="navbar-form pull-right">
		  <button type="submit" class="btn btn-info">お願いする</button>
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
        <img src='holder.js/48x48' class='img-rounded' />
        <span>なまえ</span>
      </div><!--/.well -->

	  <div class="well sidebar-nav">
		<ul class="nav nav-list">
		  <li class="nav-header">タスクもろもろ</li>
		  <li class="active"><a href="#"><i class="icon-list"></i>一覧</a></li>
		  <li><a href="#"><i class="icon-tags"></i> じぶんのこと</a></li>
		  <li><a href="#"><i class="icon-gift"></i> 依頼しているタスク</a></li>
		  <li><a href="#"><i class="icon-inbox"></i>お願いされたタスク</a></li>

          <li class="nav-header">仲間</li>
          <li><a href="#"><i class="icon-heart"></i>友達リスト</a></li>
          <li><a href="#"><i class="icon-flag"></i>グループ</a></li>
          <li><a href="#"><i class="icon-user"></i>友達の追加</a></li>
          <li><a href="#"><i class="icon-search"></i>新規検索</a></li>

		  <li class="nav-header">設定</li>
		  <li><a href="#"><i class="icon-envelope"></i> メールアドレス変更</a></li>
		  <li><a href="#"><i class="icon-edit"></i> パスワード変更</a></li>
		  <li><a href="#"><i class="icon-off"></i> ログアウト</a></li>
		</ul>
	  </div><!--/.well -->
	</div><!--/span-->

	<div class="span9">
	  <div class="row-fluid">

		<div class="span4">
          <div class="well">
            <h5><i class="icon-time"></i> 2012/12/27</h5>
            <p>タスクの内容がここに入ります。テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
            <p><img src='<?php echo site_url('img/sakura.jpg'); ?>' class='img-polaroid'></p>
			<hr>
            <button type='button' class='btn btn-small' data-toggle='button'><i class="icon-ok"></i> 完了</button>
            <button type='button' class='btn btn-small'><i class="icon-check"></i> 完了と非表示</button>
          </div><!--/.well-->
          <div class="alert">
            <h5><i class="icon-time"></i> なし</h5>
            <p>タスクの内容がここに入ります。テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
			<a href="#" class="visible-desktop"><i class="icon-file"></i> 添付ファイル</a>
			<hr>
            <button type='button' class='btn btn-small' data-toggle='button'><i class="icon-ok"></i> 完了</button>
            <button type='button' class='btn btn-small'><i class="icon-check"></i> 完了と非表示</button>
          </div><!--/.alert-->

          <div class="alert">task</div>
          <div class="alert">task</div>
          <div class="alert">task</div>
          <div class="alert">task</div>
          <div class="alert">task</div>
          <div class="alert">task</div>
          <div class="alert">task</div>
          <div class="alert">task</div>
		</div><!--/span-->

		<div class="span4">
          <div class="alert alert-error">
            <h5><i class="icon-user"></i> hoge さんへ</h5>
            <h5><i class="icon-time"></i> なし</h5>
            <p>タスクの内容がここに入ります。テキストテキストテキストテキストテキストテキストテキス>トテキストテキストテキスト</p>
            <hr>
            <button type='button' class='btn btn-small' data-toggle='button'><i class="icon-ok"></i> 完了</button>
            <button type='button' class='btn btn-small' data-toggle='button'><i class="icon-remove"></i> キャンセル</button>
          </div>
          <div class="alert alert-error">task</div>
          <div class="alert alert-error">task</div>
          <div class="alert alert-error">task</div>
          <div class="alert alert-error">task</div>
          <div class="alert alert-error">task</div>
          <div class="alert alert-error">task</div>
          <div class="alert alert-error">task</div>
          <div class="alert alert-error">task</div>
          <div class="alert alert-error">task</div>
		</div><!--/span-->

        <div class="span4">
          <div class="alert alert-info">
            <h5><i class="icon-user"></i> hoge さんから</h5>
            <h5><i class="icon-time"></i> なし</h5>
            <p>タスクの内容がここに入ります。テキストテキストテキストテキストテキストテキストテキス>トテキストテキストテキスト</p>
            <hr>
            <button type='button' class='btn btn-small' data-toggle='button'><i class="icon-ok"></i> 完了</button>
            <button type='button' class='btn btn-small'><i class="icon-check"></i> 完了と非表示</button>
            <button type='button' class='btn btn-small' data-toggle='button'><i class="icon-remove"></i> お断り</button>
          </div><!--/.alert-->
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
