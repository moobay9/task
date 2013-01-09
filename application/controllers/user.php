<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
	 * change_name 名前の変更
	 * 
	 * @access public
	 * @return void
	 */
	public function change_name()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// ビューの表示
		$this->load->view('user/change_name');
	}


	/**
	 * change_name_action 名前の変更処理
	 * 
	 * @access public
	 * @return void
	 */
	public function change_name_action()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// バリデーション
		if ($this->form_validation->run('user_change_name_action') === FALSE)
		{
			// バリデーション失敗
			$this->change_name();
		}
		else
		{
			// モデルのロード
			$this->load->model('user_model');

			// POST データの取得
			$data = $this->input->post();

			// 名前の変更処理
			$this->user_model->update(
				array('name' => $data['name']),
				$this->session->userdata('uid')
			);

			// 成功ビューの表示
			$this->load->view('user/change_name_action');
		}
	}


	/**
	 * change_icon アイコンの変更
	 * 
	 * @access public
	 * @return void
	 */
	public function change_icon()
	{
		// モデルのロード
		$this->load->model('user_model');

		// ユーザー情報の取得
		$user_data = $this->user_model->fetch_row($this->user_id);

		// ビューの表示
		$this->load->view('user/change_icon', array('data' => $user_data));
	}


	/**
	 * change_icon_action 切り抜き画面の表示
	 * 
	 * @access public
	 * @return void
	 */
	public function change_icon_action()
	{
		// ライブラリのロード
		$config = array(
			'upload_path'   => './tmp',
			'allowed_types' => 'gif|jpg|jpeg|png',
			'encrypt_name'  => TRUE,
		);

		$this->load->library('upload', $config);

		// アップロード処理
		if ( ! $this->upload->do_upload('icon'))
		{
			print_r($this->upload->display_errors());

			$this->change_icon();
		}
		else
		{
			// モデルのロード
			$this->load->model('image_model');

			// アップロード結果の取得
			$data = array('up' => $this->upload->data());

			// 画像の横幅が 800px 以上の場合はリサイズ
			if ($data['up']['image_width'] > 800)
			{
				$height = round(($data['up']['image_height'] / $data['up']['image_width']) * 800);
				$this->image_model->resize('./tmp/'. $data['up']['file_name'], 800, $height);
			}
			
			$this->load->view('user/change_icon_action', $data);
		}
	}


	/**
	 * change_icon_crop アイコンの生成
	 * 
	 * @access public
	 * @return void
	 */
	public function change_icon_crop()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// バリデーション
		if ($this->form_validation->run('user_change_icon_crop') === FALSE)
		{
			// バリデーション失敗
			echo 'ERROR';
		}
		else
		{
			// モデルのロード
			$this->load->model(array('user_model', 'image_model'));

			// POST データの取得
			$data = $this->input->post();

			// 画像の切り抜き
			$config = array(
				'source_image' => './tmp/'. $data['filename'],
				'x_axis'       => $data['crop_x'],
				'y_axis'       => $data['crop_y'],
				'width'        => $data['crop_w'],
				'height'       => $data['crop_h'],
			);

			$this->image_model->crop($config);

			// 画像のアイコン化
			$this->image_model->create_icon('./tmp/'. $data['filename']);

			// 古いアイコンと使用したテンポラリの削除
			unlink('./tmp/'. $data['filename']);

			$row = $this->user_model->fetch_row($this->session->userdata('uid'));

			if ($row['icon']) unlink('./icon/'. $row['icon']);

			// アイコンの変更処理
			$this->user_model->update(
				array('icon' => $data['filename']),
				$this->session->userdata('uid')
			);

			// 成功ビューの表示
			$this->load->view('user/change_icon_crop', array('icon' => $data['filename']));
		}
	}


	/**
	 * change_icon_delete アイコン変更途中のゴミファイルを削除
	 * 
	 * @access public
	 * @return void
	 */
	public function change_icon_delete()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// バリデーション
		if ($this->form_validation->run('user_change_icon_delete') === TRUE)
		{
			// POST データの取得
			$filename = $this->input->post('filename');

			// 削除
			unlink('./tmp/'. $filename);
		}

		$this->load->view('user/change_icon_delete');
	}


	/**
	 * change_email メールアドレスの変更
	 * 
	 * @access public
	 * @return void
	 */
	public function change_email()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// ビューの表示
		$this->load->view('user/change_email');
	}


	/**
	 * change_email_action メールアドレスの変更先へメールの送信
	 * 
	 * @access public
	 * @return void
	 */
	public function change_email_action()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// バリデーション
		if ($this->form_validation->run('user_change_email') === FALSE)
		{
			// 失敗
			$this->change_email();
		}
		else
		{
			// ライブラリのロード
			$this->load->library('email');

			// モデルのロード
			$this->load->model('mail_temp_model');

			// ヘルーパーのロード
			$this->load->helper('string');

			// データの取得
			$post = $this->input->post();

			// データベースへ登録
			$data = array(
				'user_id' => $this->user_id,
				'email'   => $post['email'],
				'random'  => random_string('alnum', 50),
			);

			$this->mail_temp_model->insert($data);

			// メールの送信処理
			$this->email->from('info@hoshiuta.net');
			$this->email->to($post['email']);
			$this->email->subject($this->load->view('user/mail_change_subject', '', TRUE));
			$this->email->message($this->load->view('user/mail_change_body', $data, TRUE));
			$this->email->send();

			// 成功ビューの表示
			$this->load->view('user/change_email_action');
		}
	}

}
/* End of file user.php */
/* Location: ./application/controllers/user.php */
