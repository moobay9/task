<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_temp_model extends CI_Model {

	function __construct()
	{
		parent::__construct();

		// DBクラスの初期化
		$this->load->database();
	}

	// 検索系 ------------------------------------------------------------------

	/**
	 * fetch_row 一行だけ取得
	 * 
	 * @param string $code 
	 * @param bool   $bool 
	 * @access public
	 * @return void
	 */
	public function fetch_row($id, $bool=FALSE)
	{
		if ($bool === FALSE) $this->db->select('id, user_id, email');

		$query = $this->db->get_where('mail_temp', array('id' => $id));

		return $query->row_array();
	}


	/**
	 * fetch_row_by_random ランダム文字列をキーに一行だけ取得する
	 * 
	 * @param string $random 
	 * @access public
	 * @return void
	 */
	public function fetch_row_by_random($random)
	{
		$query = $this->db->get_where('mail_temp', array('random' => $random));

		return $query->row_array();
	}


	// 挿入系 ------------------------------------------------------------------

	/**
	 * insert データの投入
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function insert($data)
	{
		$data['created'] = date('YmdHis');

		$this->db->insert('mail_temp', $data);
	}


	// 更新系 ------------------------------------------------------------------



	// 削除系 ------------------------------------------------------------------

	/**
	 * delete ユーザーのIDを元に削除
	 * 
	 * @param string $uid 
	 * @access public
	 * @return void
	 */
	public function delete($uid)
	{
		$this->db->delete('mail_temp', array('user_id' => $uid));
	}


	/**
	 * truncate テーブルのクリア
	 * 
	 * @access public
	 * @return void
	 */
	public function truncate()
	{
		$this->db->truncate('mail_temp');
	}

}

/* End of file mail_temp_model.php */
/* Location: ./application/models/mail_temp_model.php */
