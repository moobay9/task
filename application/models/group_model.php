<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model {

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
	public function fetch_row($gid, $bool=FALSE)
	{
		if ($bool === FALSE) $this->db->select('id, owner_id, name');

		$query = $this->db->get_where('group', array('id' => $gid));

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

		$this->db->insert('group', $data);
	}


	// 更新系 ------------------------------------------------------------------



	// 削除系 ------------------------------------------------------------------

	/**
	 * truncate テーブルのクリア
	 * 
	 * @access public
	 * @return void
	 */
	public function truncate()
	{
		$this->db->truncate('group');
	}

}

/* End of file group_model.php */
/* Location: ./application/models/group_model.php */
