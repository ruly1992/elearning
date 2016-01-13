<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Model\Reminder as Reminder;

class Reset extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			keepValidationErrors();

			$this->template->set_layout('reset');
	        $this->template->build('reset');
		} else {
			$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

			$credentials = [
				'email' => set_value('email'),
			];

			$user 	= sentinel()->findUserByCredentials($credentials);

			if ($user) {
				$code = (new Reminder)->createCode($user);
				$mail = new PHPMailer;

				$mail->isSMTP();                            // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  			// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                     // Enable SMTP authentication
				$mail->Username = 'sandroid.san@gmail.com'; // SMTP username
				$mail->Password = 'santusakil19';           // SMTP password
				$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                          // TCP port to connect to
				$mail->setFrom('admin@admin.com', 'Admin Desa Membangun');
				$mail->addAddress($email);     				// Add a recipient
				$mail->isHTML(true);

				$url = '<a href = "http://localhost/elearning/auth/reset/check_user/'.$code->user_id.'/'.$code->code.'">Reset Password</a>';

				$mail->Subject = 'Reset Password Aku Desa Membangun';
				$mail->Body    = '<center>
							        <table cellspacing="0" cellpadding="0" border="0" style="border-radius:4px;margin:0;padding:0;width:100%;max-width:664px;border:1px solid #dadedf">
							                <tbody>
							                        <tr>
							                                <td style="padding:20px 20px 17px 40px;background-color:#f5f6f7;border-bottom:1px solid #dadedf">
							                                        <table cellspacing="0" cellpadding="0" border="0" style="padding:0;width:100%;margin:0;text-align:left">
							                                                <tbody>
							                                                        <tr>
							                                                                <td style="width:80px">
							                                                                        <img height="50" src="http://122.200.145.178/public/images/logo.png" class="CToWUd">
							                                                                </td>
							                                                        </tr>
							                                                </tbody>
							                                        </table>
							                                </td>
							                        </tr>
							                        <tr>
							                                <td style="padding:36px 40px 40px 40px;font-size:18px;color:#47515d;border-bottom:1px solid #dadedf;font-family:Arial,Verdana,sans-serif;text-align:left">
							                                        Hi '.$email.'<br><br>                                                        
							                                        Anda menerima email ini karena ada permintaan untuk memperbarui kata sandi anda.
							                                        Klik tautan dibawah.
							                                        <br><br>
							                                        '.$url.'
							                                        <br><br>
							                                        Jika anda tidak meminta ini, abaikan.
							                                        <br><br>
							                                       -Admin Desa Membangun-
							                                </td>
							                        </tr>
							                </tbody>
							        </table>
							</center>';
				
				if (!$mail->send()) {
    				set_message_error('Email gagal dikirim');

					$this->template->set_layout('reset');
		        	$this->template->build('reset');
				} else {
				   	set_message_success('Silahkan cek email anda untuk reset password');

					$this->template->set_layout('reset');
		        	$this->template->build('reset');
				}				
			} else {
				set_message_error('Maaf email tidak terdaftar');

				$this->template->set_layout('reset');
	        	$this->template->build('reset');
			}
		}
	}

	public function check_user($user_id, $code)
	{
		$user 		= sentinel()->findUserById($user_id);
		$reminder 	= (new Reminder)->exists($user);
		
		if ($reminder) {
			$data['id'] 	= $user_id;
			$data['code']	= $code;
			
			$this->template->set_layout('form_reset');
	        $this->template->build('form_reset', $data);

		} else {
			set_message_error('Maaf link reset telah kadaluarsa');

			$this->template->set_layout('reset');
        	$this->template->build('reset');
		}
	}

	public function reset_password($user_id, $code)
	{
		$this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]');
		$this->form_validation->set_rules('password_confirmation', 'New Password Confirmation', 'required|min_length[6]|matches[password]');

		if ($this->form_validation->run() == FALSE) {
			set_message_error(validation_errors());

			$data['id'] 	= $user_id;
			$data['code']	= $code;
			
			$this->template->set_layout('form_reset');
	        $this->template->build('form_reset', $data);
		} else {
			
			// $id 		 	= $user_id;
			$user 			= sentinel()->findUserById($user_id);
			$password 		= set_value('password');

			// $user 			= sentinel()->update($id, $password);	
			$completed		= (new Reminder)->complete($user, $code, $password);	

			if ($completed) {
				set_message_success('Password anda berhasil diubah, silahkan login kembali');

				redirect(home_url('auth/login'),'refresh');

			} else {
				set_message_error('Gagal memperbaharui password anda, silahkan dicoba lagi');

				$this->template->set_layout('form_reset');
	        	redirect('reset','refresh');
			}
		}
	}
}

/* End of file Reset.php */
/* Location: ./application/controllers/Reset.php */