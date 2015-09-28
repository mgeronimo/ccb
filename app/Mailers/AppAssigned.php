<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppAssigned{

	protected $mailer;

	protected $from = 'ccbcsmailer@gmail.com';

	protected $to;

	protected $view;

	protected $data = [];

	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}

	public function sendStatus(User $user)
	{
		$this->to = $user->email;	
		$this->view = 'emails.statusassign';
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