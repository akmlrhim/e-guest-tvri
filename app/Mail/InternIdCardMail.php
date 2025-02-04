<?php

namespace App\Mail;

use App\Models\Intern;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class InternIdCardMail extends Mailable
{
	use Queueable, SerializesModels;

	public $intern;
	/**
	 * Create a new message instance.
	 */
	public function __construct(Intern $intern)
	{
		$this->intern = $intern;
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'Intern Id Card Mail',
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		return new Content(
			view: 'free_user.magang.email',
			with: [
				'intern' => $this->intern,
			]
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, \Illuminate\Mail\Mailables\Attachment>
	 */
	public function attachments(): array
	{
		$pdf = Pdf::loadView('free_user.magang.pdf', ['intern' => $this->intern])->output();

		return [
			Attachment::fromData(fn() => $pdf, $this->intern->name . ' - ID Card.pdf')
				->withMime('application/pdf'),
		];
	}
}
