<?php

namespace App\Mail;

use App\Models\Guest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuestIdCardMail extends Mailable
{
	use Queueable, SerializesModels;

	public $guest;
	/**
	 * Create a new message instance.
	 */
	public function __construct(Guest $guest)
	{
		$this->guest = $guest;
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'ID Card Tamu',
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		return new Content(
			view: 'free_user.tamu.email',
			with: [
				'guest' => $this->guest,
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
		$pdf = Pdf::loadView('free_user.tamu.pdf', ['guest' => $this->guest])->output();

		return [
			Attachment::fromData(fn() => $pdf, $this->guest->name . ' - ID Card.pdf')
				->withMime('application/pdf'),
		];
	}
}
