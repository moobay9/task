<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

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
	public function fetch_row($uid, $bool=FALSE)
	{
		if ($bool === FALSE) $this->db->select('id, name, email, icon');

		$query = $this->db->get_where('user', array('id' => $uid));

		return $query->row_array();
	}


	/**
	 * count_mail_address メールアドレスの件数を数える
	 * 
	 * @param string $email 
	 * @access public
	 * @return void
	 */
	public function count_mail_address($email)
	{
		$query = $this->db->get_where('user', array('email' => $email));

		return $query->num_rows();
	}


	/**
	 * count_name 名前の件数を数える
	 * 
	 * @param string $name 
	 * @access public
	 * @return void
	 */
	public function count_name($name)
	{
		$query = $this->db->get_where('user', array('name' => $name));

		return $query->num_rows();
	}


	/**
	 * count_account アカウントの有無を判定
	 * 
	 * @param mixed  $data 
	 * @param string $key (ID)
	 * @access public
	 * @return void
	 */
	public function count_account($data, $key=NULL)
	{
		if(is_null($key))
		{
			$where = array('email' => $data['email'], 'password' => $data['password']);
		}
		else
		{
			$where = array('id' => $key, 'password' => $data);
		}

		$query = $this->db->get_where('user', $where);

		return ($query->num_rows() === 1) ? $query->row('id') : FALSE ;
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

		$this->db->insert('user', $data);
	}


	// 更新系 ------------------------------------------------------------------

	/**
	 * update 更新
	 * 
	 * @param array  $data 
	 * @param string $uid 
	 * @access public
	 * @return void
	 */
	public function update($data, $uid)
	{
		$this->db->where('id', $uid)
				 ->update('user', $data);
	}


	/**
	 * login_update ログイン時間の打刻
	 * 
	 * @param string $uid 
	 * @access public
	 * @return void
	 */
	public function lastlogin($uid)
	{
		$this->db->where('id', $uid)
				 ->update('user', array('lastlogin' => date('YmdHis')));
	}


	// 削除系 ------------------------------------------------------------------

	/**
	 * truncate テーブルのクリア
	 * 
	 * @access public
	 * @return void
	 */
	public function truncate()
	{
		$this->db->truncate('user');
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
