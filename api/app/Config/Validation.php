<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
		\App\Validation\UserAuth::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];


	//--------------------------------------------------------------------
	// Auth
	//--------------------------------------------------------------------

	// Sign In
	public $signin = [
		'username' => [
			'rules' => 'required|max_length[64]',
			'errors' => [
				'required' => 'ใส่ชื่อผู้ใช้หรืออีเมล',
				'max_length' => 'ชื่อผู้ใช้สูงสุด 64 ตัวอักษร',
			]
		],
		'password' => [
			'rules' => 'required|max_length[64]|validateUser[username, password]',
			'errors' => [
				'required' => 'ใส่รหัสผ่าน',
				'max_length' => 'รหัสผ่านสูงสุด 64 ตัวอักษร',
				'validateUser' => 'ไม่พบผู้ใช้ในระบบ',
			]
		],
	];

	// Sign Up
	public $signup = [
		'firstname' => [
			'rules' => 'required|min_length[3]|max_length[64]',
			'errors' => [
				'required' => 'ใส่ชื่อจริง',
				'min_length' => 'ชื่อจริงขั้นต่ำ 3 ตัวอักษร',
				'max_length' => 'ชื่อจริงสูงสุด 64 ตัวอักษร',
			]
		],
		'lastname' => [
			'rules' => 'required|min_length[3]|max_length[64]',
			'errors' => [
				'required' => 'ใส่นามสกุล',
				'min_length' => 'นามสกุลขั้นต่ำ 3 ตัวอักษร',
				'max_length' => 'นามสกุลสูงสุด 64 ตัวอักษร',
			]
		],
		'email' => [
			'rules' => 'required|min_length[4]|max_length[64]|valid_email|isUniqureEmail[email]',
			'errors' => [
				'required' => 'ใส่อีเมล',
				'min_length' => 'อีเมลขั้นต่ำ 4 ตัวอักษร',
				'max_length' => 'อีเมลสูงสุด 64 ตัวอักษร',
				'valid_email' => 'ใส่อีเมลที่ถูกต้อง',
				'isUniqureEmail' => 'อีเมลนี้ถูกใช้งานแล้ว',
			]
		],
		'username' => [
			'rules' => 'required|min_length[4]|max_length[64]|isUniqureUsername[username]',
			'errors' => [
				'required' => 'ใส่ชื่อผู้ใช้',
				'min_length' => 'ชื่อผู้ใช้ขั้นต่ำ 4 ตัวอักษร',
				'max_length' => 'ชื่อผู้ใช้สูงสุด 64 ตัวอักษร',
				'isUniqureUsername' => 'ชื่อผู้ใช้ถูกใช้งานแล้ว',
			]
		],
		'password' => [
			'rules' => 'required|min_length[6]|max_length[64]',
			'errors' => [
				'required' => 'ใส่รหัสผ่าน',
				'min_length' => 'รหัสผ่านขั้นต่ำ 6 ตัวอักษร',
				'max_length' => 'รหัสผ่านสูงสุด 64 ตัวอักษร',
			]
		],
		'password_confirm' => [
			'rules' => 'required|matches[password]',
			'errors' => [
				'required' => 'ใส่ยืนยันรหัสผ่าน',
				'matches' => 'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่าน',
			]
		],
	];

	// Forget Password
	public $forgetPassword = [
		'email' => [
			'rules' => 'required|max_length[64]|valid_email|validateForgetPassword[email]',
			'errors' => [
				'required' => 'ใส่อีเมล',
				'max_length' => 'อีเมลสูงสุด 64 ตัวอักษร',
				'valid_email' => 'ใส่อีเมลที่ถูกต้อง',
				'validateForgetPassword' => 'ไม่พบผู้ใช้ในระบบ',
			]
		],
	];

	// Set New Password
	public $setNewPassword = [
		'password_new' => [
			'rules' => 'required|min_length[6]|max_length[64]',
			'errors' => [
				'required' => 'ใส่รหัสผ่านใหม่',
				'min_length' => 'รหัสผ่านใหม่ขั้นต่ำ 6 ตัวอักษร',
				'max_length' => 'รหัสผ่านใหม่สูงสุด 64 ตัวอักษร',
			]
		],
		'password_confirm' => [
			'rules' => 'required|matches[password_new]',
			'errors' => [
				'required' => 'ใส่ยืนยันรหัสผ่าน',
				'matches' => 'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่านใหม่',
			]
		],
	];

	
	//--------------------------------------------------------------------
	// User
	//--------------------------------------------------------------------

	// User Update
	public $userUpdate = [
		'firstname' => [
			'rules' => 'required|min_length[3]|max_length[64]',
			'errors' => [
				'required' => 'ใส่ชื่อจริง',
				'min_length' => 'ชื่อจริงขั้นต่ำ 3 ตัวอักษร',
				'max_length' => 'ชื่อจริงสูงสุด 64 ตัวอักษร',
			]
		],
		'lastname' => [
			'rules' => 'required|min_length[3]|max_length[64]',
			'errors' => [
				'required' => 'ใส่นามสกุล',
				'min_length' => 'นามสกุลขั้นต่ำ 3 ตัวอักษร',
				'max_length' => 'นามสกุลสูงสุด 64 ตัวอักษร',
			]
		],
		'email' => [
			'rules' => 'required|min_length[4]|max_length[64]|valid_email|is_unique[users.email,id,{id}]',
			'errors' => [
				'required' => 'ใส่อีเมล',
				'min_length' => 'อีเมลขั้นต่ำ 4 ตัวอักษร',
				'max_length' => 'อีเมลสูงสุด 64 ตัวอักษร',
				'valid_email' => 'ใส่อีเมลที่ถูกต้อง',
				'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
			]
		],
		'username' => [
			'rules' => 'required|min_length[4]|max_length[64]|is_unique[users.username,id,{id}]',
			'errors' => [
				'required' => 'ใส่ชื่อผู้ใช้',
				'min_length' => 'ชื่อผู้ใช้ขั้นต่ำ 4 ตัวอักษร',
				'max_length' => 'ชื่อผู้ใช้สูงสุด 64 ตัวอักษร',
				'is_unique' => 'ชื่อผู้ใช้ถูกใช้งานแล้ว',
			]
		],
	];

	// User Role Update
	public $userRoleUpdate = [
		'role_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกประเภทผู้ใช้',
			]
		],
	];

}
