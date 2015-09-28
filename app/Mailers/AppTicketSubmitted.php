<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppTicketSubmitted{

	protected $mailer;

	protected $from = 'ccbcsmailer@gmail.com';

	protected $to;

	protected $view;

	protected $data = [];

	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}

	public function sendSubmittedEmail(User $user)
	{
		$this->to = $user->email;		
		$this->view = 'emails.ticketsubmitted';
		$this->data = compact('user');
		$this->deliver();
	}

	public function deliver()
	{
		$this->mailer->send($this->view, $this->data, function($message){
			$message->from($this->from, 'Contact Center ng Bayan')

					->to($this->to)->subject('Submitted Ticket');
		});
	}
} 