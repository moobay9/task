<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	// 登録
	'auth_register_authorize' => array(
		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'required|trim|valid_email|dup_email|xss_clean',
		),
		array(
			'field' => 'name',
			'label' => '登録名',
			'rules' => 'required|trim|dup_name|xss_clean',
		),
		array(
			'field' => 'password',
			'label' => 'パスワード',
			'rules' => 'required|trim|min_length[6]|max_length[12]|alpha_dash|xss_clean',
		),
	), // 登録ここまで

	// ログイン
	'auth_login_authorize' => array(
		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'required|trim|valid_email|xss_clean',
		),
		array(
			'field' => 'password',
			'label' => 'パスワード',
			'rules' => 'required|trim|min_length[6]|max_length[12]|alpha_dash|xss_clean',
		),
	), // ログインここまで

	// パスワード変更
	'auth_change_password_action' => array(
		array(
			'field' => 'now_password',
			'label' => '現在のパスワード',
			'rules' => 'required|trim|min_length[6]|max_length[12]|'.
					   'alpha_dash|match_password|xss_clean',
		),
		array(
			'field' => 'new_password',
			'label' => '新しいパスワード',
			'rules' => 'required|trim|min_length[6]|max_length[12]|alpha_dash|xss_clean',
		),
		array(
			'field' => 'confirm',
			'label' => '新しいパスワード（確認）',
			'rules' => 'required|matches[new_password]|xss_clean',
		),
	), // パスワード変更ここまで

	// グループ追加
	'group_add_action' => array(
		array(
			'field' => 'name',
			'label' => 'グループ名',
			'rules' => 'required|trim|xss_clean',
		),
	), // グループ追加ここまで

	// 登録名変更
	'user_change_name_action' => array(
		array(
			'field' => 'name',
			'label' => '登録名',
			'rules' => 'required|trim|dup_name|xss_clean',
		),
	), // 登録名変更ここまで

	// 画像サイズの切り抜き
	'user_change_icon_crop' => array(
		array(
			'field' => 'filename',
			'label' => 'ファイル名',
			'rules' => 'required|trim|alpha_dot|xss_clean',
		),
		array(
			'field' => 'crop_w',
			'label' => '幅',
			'rules' => 'required|trim|is_natural_no_zero|xss_clean',
		),
		array(
			'field' => 'crop_h',
			'label' => '高さ',
			'rules' => 'required|trim|is_natural_no_zero|xss_clean',
		),
		array(
			'field' => 'crop_x',
			'label' => '始点（横）',
			'rules' => 'required|trim|is_natural|xss_clean',
		),
		array(
			'field' => 'crop_y',
			'label' => '始点（縦）',
			'rules' => 'required|trim|is_natural|xss_clean',
		),
	), // 画像サイズの切り抜き ここまで

	// 画像編集のキャンセル
	'user_change_icon_delete' => array(
		array(
			'field' => 'filename',
			'label' => 'ファイル名',
			'rules' => 'required|trim|alpha_dot|xss_clean',
		),
	), // 画像編集のキャンセル ここまで 

	// メールアドレス変更
	'user_change_email' => array(
		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'required|trim|valid_email|dup_email|xss_clean',
		),
	),// メールアドレス変更 ここまで

);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */
