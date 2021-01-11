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
			'rules' => 'required|min_length[4]|max_length[64]|valid_email|isUniqueEmail[email]',
			'errors' => [
				'required' => 'ใส่อีเมล',
				'min_length' => 'อีเมลขั้นต่ำ 4 ตัวอักษร',
				'max_length' => 'อีเมลสูงสุด 64 ตัวอักษร',
				'valid_email' => 'ใส่อีเมลที่ถูกต้อง',
				'isUniqueEmail' => 'อีเมลนี้ถูกใช้งานแล้ว',
			]
		],
		'username' => [
			'rules' => 'required|min_length[4]|max_length[64]|isUniqueUsername[username]',
			'errors' => [
				'required' => 'ใส่ชื่อผู้ใช้',
				'min_length' => 'ชื่อผู้ใช้ขั้นต่ำ 4 ตัวอักษร',
				'max_length' => 'ชื่อผู้ใช้สูงสุด 64 ตัวอักษร',
				'isUniqueUsername' => 'ชื่อผู้ใช้ถูกใช้งานแล้ว',
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
	
	public $signinWithFacebook = [
		'facebook_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ Facebook id',
			]
		],
		'access_token' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ Facebook access token',
			]
		],
		'firstname' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ชื่อจริง',
			]
		],
		'lastname' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่นามสกุล',
			]
		],
		'email' => [
			'rules' => 'required|valid_email',
			'errors' => [
				'required' => 'ใส่อีเมล',
				'valid_email' => 'ใส่อีเมลที่ถูกต้อง',
			]
		],
	];
	public $signinWithGoogle = [
		'google_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ Google id',
			]
		],
		'id_token' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ Google id token',
			]
		],
		'firstname' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ชื่อจริง',
			]
		],
		'lastname' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่นามสกุล',
			]
		],
		'email' => [
			'rules' => 'required|valid_email',
			'errors' => [
				'required' => 'ใส่อีเมล',
				'valid_email' => 'ใส่อีเมลที่ถูกต้อง',
			]
		],
	];

	
	//--------------------------------------------------------------------
	// User
	//--------------------------------------------------------------------
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
	public $userUpdateDetail = [
		'user_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่เลขผู้ใช้',
			]
		],
		'address' => [
			'rules' => 'max_length[512]',
			'errors' => [
				'max_length' => 'ที่อยู่สูงสุด 512 ตัวอักษร',
			]
		],
		'phone' => [
			'rules' => 'max_length[64]',
			'errors' => [
				'max_length' => 'เบอร์โทรศัพท์สูงสุด 64 ตัวอักษร',
			]
		],
		'title' => [
			'rules' => 'max_length[256]',
			'errors' => [
				'max_length' => 'ตำแหน่งสูงสุด 256 ตัวอักษร',
			]
		],
		'company' => [
			'rules' => 'max_length[256]',
			'errors' => [
				'max_length' => 'บริษัทสูงสุด 256 ตัวอักษร',
			]
		],
		'company_address' => [
			'rules' => 'max_length[512]',
			'errors' => [
				'max_length' => 'ที่อยู่บริษัทสูงสุด 512 ตัวอักษร',
			]
		],
		'company_phone' => [
			'rules' => 'max_length[64]',
			'errors' => [
				'max_length' => 'เบอร์โทรบริษัทสูงสุด 64 ตัวอักษร',
			]
		],
	];
	public $userUpdatePassword = [
		'password' => [
			'rules' => 'required|min_length[6]|max_length[64]|isPasswordVerified[id,password]',
			'errors' => [
				'required' => 'รหัสผ่านไม่ถูกต้อง',
				'min_length' => 'รหัสผ่านไม่ถูกต้อง',
				'max_length' => 'รหัสผ่านไม่ถูกต้อง',
				'isPasswordVerified' => 'รหัสผ่านไม่ถูกต้อง',
			]
		],
		'new_password' => [
			'rules' => 'required|min_length[6]|max_length[64]',
			'errors' => [
				'required' => 'ใส่รหัสผ่านใหม่',
				'min_length' => 'รหัสผ่านใหม่ขั้นต่ำ 6 ตัวอักษร',
				'max_length' => 'รหัสผ่านใหม่สูงสุด 64 ตัวอักษร',
			]
		],
		'new_password_confirm' => [
			'rules' => 'required|matches[new_password]',
			'errors' => [
				'required' => 'ใส่ยืนยันรหัสผ่าน',
				'matches' => 'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่านใหม่',
			]
		],
	];
	public $userUpdatePasswordWithoutPassword = [
		'new_password' => [
			'rules' => 'required|min_length[6]|max_length[64]',
			'errors' => [
				'required' => 'ใส่รหัสผ่านใหม่',
				'min_length' => 'รหัสผ่านใหม่ขั้นต่ำ 6 ตัวอักษร',
				'max_length' => 'รหัสผ่านใหม่สูงสุด 64 ตัวอักษร',
			]
		],
		'new_password_confirm' => [
			'rules' => 'required|matches[new_password]',
			'errors' => [
				'required' => 'ใส่ยืนยันรหัสผ่าน',
				'matches' => 'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่านใหม่',
			]
		],
	];

	public $trafficCreate = [
		'url' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ Url',
			]
		],
		'ip' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ IP Address',
			]
		],
	];

	
	//--------------------------------------------------------------------
	// Admin User
	//--------------------------------------------------------------------
	public $adminUserUpdate = [
		'id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกผู้ใช้',
			]
		],
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
	public $adminUserUpdatePassword = [
		'id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกผู้ใช้',
			]
		],
		'new_password' => [
			'rules' => 'required|min_length[6]|max_length[64]',
			'errors' => [
				'required' => 'ใส่รหัสผ่านใหม่',
				'min_length' => 'รหัสผ่านใหม่ขั้นต่ำ 6 ตัวอักษร',
				'max_length' => 'รหัสผ่านใหม่สูงสุด 64 ตัวอักษร',
			]
		],
		'new_password_confirm' => [
			'rules' => 'required|matches[new_password]',
			'errors' => [
				'required' => 'ใส่ยืนยันรหัสผ่าน',
				'matches' => 'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่านใหม่',
			]
		],
	];
	public $adminUserDelete = [
		'id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกผู้ใช้',
			]
		],
	];

	public $adminTrafficReport = [
		'type' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'ใส่ประเภทรายงาน',
			]
		],
	];

	
	//--------------------------------------------------------------------
	// SuperAdmin User
	//--------------------------------------------------------------------
	public $sadminUserRoleCreate = [
		'name' => [
			'rules' => 'required|max_length[128]|is_unique[user_roles.name,id,{id}]',
			'errors' => [
				'required' => 'ใส่ชื่อตำเเหน่ง',
				'max_length' => 'ชื่อตำเเหน่งสูงสุด 128 ตัวอักษร',
				'is_unique' => 'ชื่อตำเเหน่งซ้ำในระบบ',
			]
		],
	];
	public $sadminUserRoleUpdate = [
		'id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกตำแน่งผู้ใช้',
			]
		],
		'name' => [
			'rules' => 'required|max_length[128]|is_unique[user_roles.name,id,{id}]',
			'errors' => [
				'required' => 'ใส่ชื่อตำเเหน่ง',
				'max_length' => 'ชื่อตำเเหน่งสูงสุด 128 ตัวอักษร',
				'is_unique' => 'ชื่อตำเเหน่งซ้ำในระบบ',
			]
		],
	];
	public $sadminUserRoleDelete = [
		'id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกตำแหน่งผู้ใช้',
			]
		],
	];

	public $sadminModuleCreate = [
		'name' => [
			'rules' => 'required|max_length[256]|is_unique[modules.name,id,{id}]',
			'errors' => [
				'required' => 'ใส่ชื่อโมดูล',
				'max_length' => 'ชื่อโมดูลสูงสุด 256 ตัวอักษร',
				'is_unique' => 'ชื่อโมดูลซ้ำในระบบ',
			]
		],
		'code' => [
			'rules' => 'required|max_length[64]|is_unique[modules.code,id,{id}]',
			'errors' => [
				'required' => 'ใส่โมดูลโค๊ด',
				'max_length' => 'โมดูลโค๊ดสูงสุด 64 ตัวอักษร',
				'is_unique' => 'โมดูลโค๊ดซ้ำในระบบ',
			]
		],
	];
	public $sadminModuleUpdate = [
		'id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกโมดูล',
			]
		],
		'name' => [
			'rules' => 'required|max_length[256]|is_unique[modules.name,id,{id}]',
			'errors' => [
				'required' => 'ใส่ชื่อโมดูล',
				'max_length' => 'ชื่อโมดูลสูงสุด 256 ตัวอักษร',
				'is_unique' => 'ชื่อโมดูลซ้ำในระบบ',
			]
		],
	];
	public $sadminModuleDelete = [
		'id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกโมดูล',
			]
		],
	];

	public $sadminRolePermissionsUpdate = [
		'module_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกโมดูล',
			]
		],
		'role_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'เลือกตำแน่งผู้ใช้',
			]
		],
	];

}
