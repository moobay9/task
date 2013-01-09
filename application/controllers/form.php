<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// ライブラリのロード
		$this->load->library('session');

		// デバッグ
		//$this->output->enable_profiler(TRUE);
	}


	/**
	 * index 入力フォームの表示
	 * 
	 * @access public
	 * @return void
	 */
	public function index()
	{
		// ヘルパーのロード
		$this->load->helper('form');

		// コンフィグの読み込み
		$this->config->load('enquete');
		$enq = $this->config->item('enquete');

		// セッションデータ
		$sess = $this->session->all_userdata();

		if(isset($sess['name']))
		{
			unset($sess['session_id']);
			unset($sess['ip_address']);
			unset($sess['user_agent']);
			unset($sess['last_activity']);
			unset($sess['user_data']);
			$data = $sess;
		}
		else
		{
			$data = NULL;
		}
		// ビューの表示
		$this->load->view('form/index', array('enq' => $enq, 'data' => $data));

		// セッションの破棄
		$this->session->sess_destroy();
	}


	/**
	 * confirm 確認画面
	 * 
	 * @access public
	 * @return void
	 */
	public function confirm()
	{
		// ライブラリのロード
		$this->load->library('form_validation');

		// バリデーションを通過した場合にデータを返す
		if( ! $this->form_validation->run('inquiry'))
		{
			// ビューの再表示
			$this->index();
		}
		else
		{
			// ヘルパーのロード
			$this->load->helper('string');

			// コンフィグの読み込み
			$this->config->load('enquete');
			$enq = $this->config->item('enquete');

			// ポストデータの取得とチケットの追加
			$data = $this->input->post();
			$data['ticket'] = random_string('alnum', 20);
			unset($data['submit']);

			// セッションへの登録
			$this->session->set_userdata($data);

			// ビューの表示
			$this->load->view('form/confirm', array('enq' => $enq, 'data' => $data));
		}
	}


	/**
	 * send 送信処理
	 * 
	 * @access public
	 * @return void
	 */
	public function send()
	{
		// チケットの確認
		if($this->input->post('ticket') === $this->session->userdata('ticket'))
		{
			// ライブラリのロード
			$this->load->library('email');

			// 設定の読み込み
			$this->config->load('email_setting');
			$this->config->load('enquete');
			$internal = $this->config->item('internal');
			$enq = $this->config->item('enquete');

			// データの取得
			$data = array('enq' => $enq, 'post' => $this->session->all_userdata());

			// メールの送信処理
			$this->email->from($internal['from'], $internal['name']);
			$this->email->to($data['post']['email']);
			$this->email->subject($this->load->view('form/mail_internal_subject.php', '', TRUE));
			$this->email->message($this->load->view('form/mail_internal_body.php', $data, TRUE));
			$this->email->send();

			// ビューの表示
			$this->load->view('form/send');

			// セッションの破棄
			$this->session->sess_destroy();
		}
		else
		{
			// エラー画面表示
			$this->load->view('form/error');
		}
	}


	public function sreset()
	{
		$this->session->sess_destroy();
	}
}
/* End of file form.php */
/* Location: ./application/controllers/form.php */
