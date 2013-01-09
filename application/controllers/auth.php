<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// ライブラリのロード
		$this->load->library('session');

		// デバッグ
		//$this->output->enable_profiler(TRUE);
	}


	/**
	 * chks チェックセッション
	 * 
	 * ログイン状態を返す
	 * 
	 * @access public
	 * @return json
	 */
	public function chks(){
		// ログイン状態（セッション有）ではないときログイン画面へ移動
		$user_id = $this->session->userdata('uid');

		// JSON で返す宣言
		$this->output->set_content_type('application/json');
		
		// 返却
		$this->output->set_output(json_encode(
			array('status' => ($user_id === FALSE) ? 'NG' : 'OK'))) ;
	}


	/**
	 * login ログイン
	 * 
	 * @access public
	 * @param bool $bool 
	 * @return void
	 */
	public function login($bool=TRUE)
	{
		// ログイン状態のときは移動
		$user_id = $this->session->userdata('uid');
		if ($user_id !== FALSE) redirect('center'); 

		// ヘルパーのロード
		$this->load->helper('form');

		// ログイン用ビューの表示
		if($bool===TRUE)
		{
			$this->load->view('auth/login');
		}
		else
		{
			$this->load->view(
				'auth/login',
				array('err_msg' => 'メールアドレスまたはパスワードが一致しません')
			);
		}
	}


	/**
	 * logout ログアウト
	 * 
	 * @access public
	 * @return void
	 */
	public function logout()
	{
		// セッションの削除
		$this->session->sess_destroy();

		// ビューの表示
		$this->load->view('auth/logout');
	}


	/**
	 * regist 登録画面の表示
	 * 
	 * @access public
	 * @return void
	 */
	public function register()
	{
		// ヘルパーのロード
		$this->load->helper('form');

		// ビューの表示
		$this->load->view('auth/register');
	}


	/**
	 * register_authorize 新規登録の認証
	 * 
	 * @access public
	 * @return void
	 */
	public function register_authorize()
	{
		// ライブラリのロード
		$this->load->library('form_validation');
				
		// バリデーション
		if ($this->form_validation->run('auth_register_authorize') === FALSE)
		{
			// エラーを返す
			$this->register();
		}
		else
		{
			// 成功のときはDB登録
			// モデルのロード
			$this->load->model('user_model');

			// POST データの取得
			$data = $this->input->post();

			// パスワードの暗号化
			$data['password'] = $this->string_to_hash($data['password']);

			// DB登録
			$this->user_model->insert($data);

			// ビューの表示か遷移のどちらか
			redirect('center');
		}
	}


	/**
	 * login_authorize ログイン認証
	 * 
	 * @access public
	 * @return void
	 */
	public function login_authorize()
	{
		// ライブラリのロード
		$this->load->library(array('form_validation', 'session'));

		// バリデーション
		if ($this->form_validation->run('auth_login_authorize') === FALSE)
		{
			// エラーを返す
			$this->login();
		}
		else
		{
			// 認証処理
			// モデルのロード
			$this->load->model('user_model');

			// POST データの取得
			$data = $this->input->post();

			// パスワードの暗号化
			$data['password'] = $this->string_to_hash($data['password']);

			// 認証
			$auth = $this->user_model->count_account($data);
			if ($auth === FALSE)
			{
				// 認証エラー
				$this->login(FALSE);
			}
			else
			{
				// セッションへ追加
				$this->session->set_userdata('uid', $auth);

				// ログイン時間の打刻
				$this->user_model->lastlogin($auth);

				// リダイレクト
				redirect('center');
			}
		}
	}


	/**
	 * change_password パスワード変更ビューの表示
	 * 
	 * @access public
	 * @return void
	 */
	public function change_password()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// ビューの表示
		$this->load->view('auth/change_password');
	}


	/**
	 * change_password_action パスワード変更処理
	 * 
	 * @access public
	 * @return void
	 */
	public function change_password_action()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// バリデーション
		if ($this->form_validation->run('auth_change_password_action') === FALSE)
		{
			// バリデーション失敗
			$this->change_password();
		}
		else
		{
			// モデルのロード
			$this->load->model('user_model');

			// POST データの取得
			$data = $this->input->post();
			unset($data['confirm']);

			// パスワードの変更処理
			$this->user_model->update(
				array('password' => $this->string_to_hash($data['new_password'])),
				$this->session->userdata('uid')
			);

			// 成功ビューの表示
			$this->load->view('auth/change_password_action');
		}
	}

	/**
	 * new_email 新しいメールアドレスの認証
	 * 
	 * @param string $random 
	 * @access public
	 * @return void
	 */
	public function new_email($random=NULL)
	{
		// 引数がついてきていない場合はログイン画面へ遷移
		if (is_null($random))
		{
			redirect('login');
		}
		else
		{
			// ライブラリのロード
			$this->load->library('form_validation');

			// モデルのロード
			$this->load->model(array('user_model', 'mail_temp_model'));

			// 変更データの取得
			$user_data = $this->mail_temp_model->fetch_row_by_random($random);

			// テンポラリーデータの削除
			$this->mail_temp_model->delete($user_data['user_id']);

			// 新しいメールアドレスの登録
			$data = array('email' => $user_data['email']);
			$this->user_model->update($data, $user_data['user_id']);

			// 完了ビューの表示
			$this->load->view('auth/new_email');
		}
	}


	// Protected Functions -----------------------------------------------------

	/**
	 * string_to_hash 暗号化キーを元に文字列をハッシュ化する
	 * 
	 * @param string $str 
	 * @access protected
	 * @return string
	 */
	protected function string_to_hash($str)
	{
		return hash('sha512', config_item('encryption_key'). $str);
	}

}
/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
