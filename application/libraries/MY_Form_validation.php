<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	/**
	 * constructor
	 */
	public function __construct($rules = array())
	{
		parent::__construct($rules);
	}


	/**
	 * match_password 登録されているパスワードが一致するかをチェックする
	 * 
	 * ！要セッション！
	 * 
	 * @param string $str 
	 * @access public
	 * @return bool
	 */
	public function match_password($str)
	{
		// モデルのロード
		$CI =& get_instance();
		$CI->load->model('user_model');

		// ライブラリのロード
		$CI->load->library('session');

		// 結果の取得
		$result = $CI->user_model->count_account(
						$this->string_to_hash($str),
						$CI->session->userdata('uid')
				  );

		return ($result === FALSE) ? FALSE : TRUE ;
	}


	/**
	 * dup_email メールアドレスの重複をチェックする
	 * 
	 * @param string $str 
	 * @access public
	 * @return bool
	 */
	public function dup_email($str)
	{
		// モデルのロード
		$CI =& get_instance();
		$CI->load->model('user_model');

		$result = (int) $CI->user_model->count_mail_address($str);

		return ($result === 0) ? TRUE : FALSE ;
	}


	/**
	 * alpha_dot 英数字とドットだけが使われているかどうか
	 * 
	 * @param string $str 
	 * @access public
	 * @return bool
	 */
	public function alpha_dot($str)
	{
		return ( ! preg_match("/^([a-z0-9\.])+$/i", $str)) ? FALSE : TRUE;
	}


	/**
	 * dup_name 名前の重複をチェックする
	 * 
	 * @param string $str 
	 * @access public
	 * @return bool
	 */
	public function dup_name($str)
	{
		// モデルのロード
		$CI =& get_instance();
		$CI->load->model('user_model');

		$result = (int) $CI->user_model->count_name($str);

		return ($result === 0) ? TRUE : FALSE ;
	}


	/**
	 * conv_onebyte 全角を半角に変換する（英数字のみ） 
	 * 
	 * @param string $str 
	 * @access public
	 * @return string
	 */
	public function conv_onebyte($str)
	{
		return mb_convert_kana($str,'a');
	}


	/**
	 * conv_kanji_num 漢数字を半角英数字に変換する
	 * 
	 * @param string $str 
	 * @access public
	 * @return string
	 */
	public function conv_kanji_num($str)
	{
		$str = str_replace('〇', '0', $str);
		$str = str_replace('一', '1', $str);
		$str = str_replace('二', '2', $str);
		$str = str_replace('三', '3', $str);
		$str = str_replace('四', '4', $str);
		$str = str_replace('五', '5', $str);
		$str = str_replace('六', '6', $str);
		$str = str_replace('七', '7', $str);
		$str = str_replace('八', '8', $str);
		$str = str_replace('九', '9', $str);

		return $str ;
	}


	/**
	 * remove_hyphen ハイフンの削除
	 * 
	 * @param string $str 
	 * @access public
	 * @return string
	 */
	public function remove_hyphen($str)
	{
		$hyphens = array('-', '一', 'ー', '−');

		return str_replace($hyphens, '', $str);
	}


	/**
	 * remove_space 空白の削除
	 * 
	 * @param string $str 
	 * @access public
	 * @return string
	 */
	public function remove_space($str)
	{
		return $str = str_replace(array(' ','　'), '', $str);
	}


	/**
	 * hiragana ひらがなのバリデーション
	 * 
	 * @param string $str 
	 * @access public
	 * @return bool
	 */
	public function hiragana($str)
	{
		return (bool) preg_match('/^[ぁ-ゞ]+$/u', $str);
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
/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */
