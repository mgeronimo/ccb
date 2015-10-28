<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer{

	protected $mailer;

	protected $from = 'ccbcsmailer@gmail.com';

	protected $to;

	protected $view;

	protected $data = [];

	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}

	public function sendEmailConfirmationTo(User $user)
	{
		$this->to = $user->email;
		if($user->role <= 2)
		{
			$this->view = 'emails.verification';
		}
		else
		{
			$this->view='emails.publicuser';
		}
		$this->data = compact('user');
		$this->subject = 'Verify your account';
		$this->deliver();
	}

	public function deliver()
	{
		$this->mailer->send($this->view, $this->data, function($message){
			$message->from($this->from, 'Contact Center ng Bayan')

					->to($this->to)->subject($this->subject);
		});
	}

	public function deactivateUser(User $user)
	{
		$this->to = $user->email;
		$this->view='emails.deactivate';
		$this->data = compact('user');
		$this->subject = 'CCB Account Deactivated';
		$this->deliver();
	}

	public function activateUser(User $user)
	{
		$this->to = $user->email;
		$this->view='emails.activate';
		$this->data = compact('user');
		$this->subject = 'CCB Account Reactivated';
		$this->deliver();
	}
} 