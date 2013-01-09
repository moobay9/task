<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Center extends CI_Controller {

	// インスタンス変数の宣言
	private $user_id ;

	public function __construct()
	{
		parent::__construct();

		// ライブラリのロード
		$this->load->library('session');

		// ログイン状態（セッション有）ではないときログイン画面へ移動
		$user_id = $this->session->userdata('uid');

		if ($user_id === FALSE)
		{
			// セッション切れの警告画面を表示
			$this->load->view('nosession');
		}
		else
		{
			$this->user_id = $user_id;
		}

		// デバッグ
		//$this->output->enable_profiler(TRUE);
	}


	/**
	 * index トップ画面の表示
	 * 
	 * @access public
	 * @return void
	 */
	public function index()
	{
		// モデルのロード
		$this->load->model('user_model');

		// ユーザー情報の取得
		$userdata = $this->user_model->fetch_row($this->user_id);

		// ビューの表示
		$this->load->view('center/index', array('userdata' => $userdata));
	}


	public function tasklists()
	{
		// ビューの表示
		$this->load->view('center/lists');
	}

}
/* End of file center.php */
/* Location: ./application/controllers/center.php */
