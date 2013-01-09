<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_Model {


	function __construct()
	{
		parent::__construct();

		// ライブラリのロード
		$this->load->library('image_lib', array('image_library' => 'gd2'));
	}


	/**
	 * resize 画像のリサイズ
	 * 
	 * 標準でアイコン化
	 * 
	 * @param string $file 
	 * @param int $width 
	 * @param int $height 
	 * @access public
	 * @return void
	 */
	public function resize($file, $width=64, $height=64)
	{
		$config = array(
			'source_image'   => $file,
			'width'          => $width,
			'height'         => $height,
			'maintain_ratio' => FALSE,
		);

		$this->image_lib->initialize($config);
		$bl = $this->image_lib->resize();

		return ($bl) ? TRUE : $this->image_lib->display_errors();
	}


	/**
	 * crop 画像の切り抜き
	 * 
	 * @param array $param 
	 * @access public
	 * @return mixed
	 */
	public function crop($param)
	{
		$param['maintain_ratio'] = FALSE;

		$this->image_lib->initialize($param);
		$bl = $this->image_lib->crop();

		return ($bl) ? TRUE : $this->image_lib->display_errors();
	}


	public function create_icon($file)
	{
		$config = array(
			'source_image' => $file,
			'new_image'    => './icon/',
			'width'        => 64,
			'height'       => 64,
			'create_thumb' => TRUE,
			'thumb_marker' => '',
		);

		$this->image_lib->initialize($config);
		$bl = $this->image_lib->resize();

		return ($bl) ? TRUE : $this->image_lib->display_errors();
	}

}

/* End of file image_model.php */
/* Location: ./application/models/image_model.php */
