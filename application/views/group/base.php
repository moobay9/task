<?php
$this->load->view(
	'header',
	array(
		'title' => 'ぐるーぷ',
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
      span3
    </div><!--/span-->

    <div class="span9">

      <div class="alert">所属しているグループがありません</div>

      <ul class="nav nav-tabs">
        <li class="active"><a href="#group1" data-toggle="tab"><i class="icon-star"></i> グループ１</a></li>
        <li><a href="#group2" data-toggle="tab">グループ２</a></li>
        <li><a href="#group3" data-toggle="tab">グループ３</a></li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane fade in active" id="group1">

          <div class="media">
            <a href="#" class="pull-left"><img class="media-object" data-src="holder.js/64x64" alt="" /></a>
            <div class="media-body top-add">
              <h4 class="media-heading">なまえ</h4>
              <button class="btn btn-mini">グループから外す</button>
            </div>
          </div><!--/.media-->
          <div class="media">
            <a href="#" class="pull-left"><img class="media-object" data-src="holder.js/64x64" alt="" /></a>
            <div class="media-body top-add">
              <h4 class="media-heading">なまえ</h4>
              <button class="btn btn-mini">グループから外す</button>
            </div>
          </div><!--/.media-->
          <div class="media">
            <a href="#" class="pull-left"><img class="media-object" data-src="holder.js/64x64" alt="" /></a>
            <div class="media-body top-add">
              <h4 class="media-heading">なまえ</h4>
              <button class="btn btn-mini">グループから外す</button>
            </div>
          </div><!--/.media-->

        </div><!--/#group1-->

        <div class="tab-pane fade" id="group2">

          <div class="media">
            <a href="#" class="pull-left"><img class="media-object" data-src="holder.js/64x64" alt="" /></a>
            <div class="media-body top-add">
              <h4 class="media-heading">なまえ</h4>
            </div>
          </div><!--/.media-->

        </div><!--/#group2-->

        <div class="tab-pane fade" id="group3">
          <div class="alert alert-info">仮データ３</div>
        </div><!--/#group3-->

      </div><!--/.tab-content-->
    </div><!--/span-->
  </div><!--/row-->

</div><!--/.fluid-container-->

<?php $this->load->view('footer'); ?>
