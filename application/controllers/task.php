<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

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
	}


	/**
	 * index 登録フォーム表示
	 * 
	 * @access public
	 * @return void
	 */
	public function add()
	{
		// ライブラリのロード
		$this->load->library('form_validation');
		$this->load->view('task/add');
	}



}
/* End of file task.php */
/* Location: ./application/controllers/task.php */
