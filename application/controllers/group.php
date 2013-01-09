<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

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
	 * index グループ総合画面の表示
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
		$this->load->view('group/index', array('userdata' => $userdata));
	}


	/**
	 * add グループ追加画面表示
	 * 
	 * @access public
	 * @return void
	 */
	public function add()
	{
		// ライブラリのロード
		$this->load->library('form_validation');	

		// ビューの表示
		$this->load->view('group/add');
	}


	/**
	 * add_action 追加
	 * 
	 * @access public
	 * @return void
	 */
	public function add_action()
	{
		// ライブラリのロード
		$this->load->library('form_validation');	

		// バリデーション
		if ($this->form_validation->run('group_add_action') === FALSE)
		{
			// バリデーション失敗
			$this->add();
		}
		else
		{
			// モデルのロード
			$this->load->model('group_model');

			// データの登録
			$data = array(
				'name' => $this->input->post('name'),
				'owner_id' => $this->user_id,
			);

			$this->group_model->insert($data);

			// ビューの表示
			$this->load->view('group/add_action');
		}
	}

}
/* End of file group.php */
/* Location: ./application/controllers/group.php */
