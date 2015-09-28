<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppStatus{

	protected $mailer;

	protected $from = 'ccbcsmailer@gmail.com';

	protected $to;

	protected $view;

	protected $data = [];

	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}

	public function sendStatusChanged(User $user)
	{
		$this->to = $user->email;	
		$this->view = 'emails.statuschange';
		$this->data = compact('user');
		$this->deliver();
	}

	public function deliver()
	{
		$this->mailer->send($this->view, $this->data, function($message){
			$message->from($this->from, 'Contact Center ng Bayan')

					->to($this->to)->subject('Ticket Status Changed');
		});
	}
} 