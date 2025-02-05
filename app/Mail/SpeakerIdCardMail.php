<?php

namespace App\Mail;

use App\Models\Speaker;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SpeakerIdCardMail extends Mailable
{
	use Queueable, SerializesModels;

	public $speaker;
	/**
	 * Create a new message instance.
	 */
	public function __construct(Speaker $speaker)
	{
		$this->speaker = $speaker;
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'ID Card Narasumber',
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		return new Content(
			view: 'free_user.narasumber.email',
			with: [
				'speaker' => $this->speaker
			],
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, \Illuminate\Mail\Mailables\Attachment>
	 */
	public function attachments(): array
	{
		$pdf = Pdf::loadView('free_user.narasumber.pdf', ['speaker' => $this->speaker])->output();

		return [
			Attachment::fromData(fn() => $pdf, $this->speaker->name . ' - ID Card.pdf')
				->withMime('application/pdf'),
		];
	}
}
