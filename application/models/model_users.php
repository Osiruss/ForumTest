<?php 

class Model_Users extends MY_Model {
	protected $_table_name = 'users';
	protected $_primary_key = 'user_id';
	protected $_primary_filter = 'intval';
	//protected $_order_by = 'posted_on';
	public $rules = array(
		'username'=> array(
			'field'=>'username',
			'label'=>'Username',
			'rules'=>'trim|required'
			),
		'pass'=> array(
			'field'=>'password',
			'label'=>'Password',
			'rules'=>'trim|required'
			),
		);
	public $reg_rules = array(
		'username'=> array(
			'field'=>'username',
			'label'=>'Username',
			'rules'=>'trim|alpha_numeric|min_length[5]|max_length[15]|required|callback_username_check'
			),
		'password'=> array(
			'field'=>'password',
			'label'=>'Password',
			'rules'=>'trim|alpha_numeric|min_length[5]|max_length[15]|required|matches[password2]'
			),
		'password2'=> array(
			'field'=>'password2',
			'label'=>'Password 2',
			'rules'=>'trim|alpha_numeric|min_length[5]|max_length[15]|required'
			),
		'email'=> array(
			'field'=>'email',
			'label'=>'Email',
			'rules'=>'trim|required|valid_email|callback_email_check'
			)
		);

	public function login($arr) {
		$user = $this->get_by(array(
			'username'=> $arr['username']
			), true);
		$u = $p = $a = false;
		
		if (count($user)) {
			$u = true;
		}
		if ($u && $this->encrypt->decode($user->pass) === $arr['password']) {
			$p = true;
		}
		if ($u && $p && $user->active == 1) {
			$a = true;
		}

		if (!$u || !$p ) {
			$this->session->set_flashdata('error', '<p class="error">Incorrect login details.</p>');
			return false;
		} elseif (!$a) {
			$this->data->resend = '<p class="error">Your account has not been activated. Please check your inbox for the confirmation link.</p>';
			$this->data->resend .= '<form method="post" action="#">';
			$this->data->resend .= '<input type="submit" value="RESEND ACTIVATION EMAIL">';
			$this->data->resend .= '<input type="hidden" name="resend_activation" value="1">';
			$this->data->resend .= '<input type="hidden" name="username" value="'.$this->input->post('username').'">';
			$this->data->resend .= '</form>';
			return false;
		}

		if ($u && $p && $a) {
			$data = array(
				'id'=>$user->user_id,
				'username'=>$user->username,
				'email'=>$user->email,
				'loggedin'=>true
				);
			$this->session->set_userdata($data);
			return true;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
	}

	public function loggedin() {
		return (bool) $this->session->userdata('loggedin');
	}

	public function is_admin() {
		if (isset($this->session->userdata()['id']) && $uid = $this->session->userdata('id')) {
			return $this->get($uid)->group_id == 1 ? true : false;
		} else {
			return false;
		}
	}

	public function get_user_id() {
		if ($this->loggedin()) {
			return $this->session->userdata('id');
		} else {
			return false;
		}
	}

	public function hash($password) {
		return $this->encrypt->encode($password);
	}

	public function create_thumb($uid) {
		$config['upload_path'] = 'img/temp/';
		$config['allowed_types'] = 'jpg|png|gif';
		$config['max_size'] = '100';
		$this->load->library('upload',$config);

		//if upload is not sucessful, display errors
		if (!$this->upload->do_upload('avatar')) {
			$this->data->error = $this->upload->display_errors();
			return false;
		} else {
			//get information on image
			$data = $this->upload->data();

			//set relevant information for storage and settings of information
			$config['image_library'] = 'gd2';
			$config['source_image']	= './img/temp/'.$data['file_name'];
			$config['new_image']	= './img/thumb/'.$uid.$data['file_ext'];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	= 200;
			$config['height']	= 200;
	 		$this->load->library('image_lib', $config); 

	 		//get files in thumb directory
			$dir = scandir('./img/thumb');

			//for every image in thumb dir
			for ($i=0; $i < count($dir); $i++) { 

				//extract id from filename
				$f = str_replace(array('_thumb','.jpg','.png','.gif'), '', $dir[$i]);

				//if filename id matches user_id, delete said file
				//this is to prevent duplicate files for the same user with different extensions
				if ($f == $uid) {
					unlink('./img/thumb/'.$dir[$i]);
				}
			}	 		

			if ( ! $this->image_lib->resize()) {
			    $this->data->error = $this->image_lib->display_errors();
			    return false;
			} else {
				unlink('./img/temp/'.$data['file_name']);
				$this->save(array('avatar'=>$uid.'_thumb'.$data['file_ext']), $uid);
				return true;
			}
		}
	}

	public function update_activity($uid) {
		//update users last_active field
		if ($uid !== false) {
			$this->db->query("UPDATE users SET last_active = NOW() WHERE user_id=".$uid);
		}
	}
}