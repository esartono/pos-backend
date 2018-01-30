<?php

namespace App\Events;

use Mail;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class SendMailEvent extends Event
{
    use SerializesModels;

    protected $recipients;
    protected $subject;
    protected $template;
    protected $data;

    /**
     * @var sender
     */
    private $sender;

    /**
     * @var bcc
     */
    private $bcc;

    /**
     * @var fromAddress
     */
    private $fromAddress;

    /**
     * @var fromName
     */
    private $fromName;

    /**
     * Create a new event instance.
     *
     * @param $recipients
     * @param $subject
     * @param $template
     * @param $data
     * @param null $bcc
     */
    public function __construct($recipients, $subject, $template, $data, $bcc = null)
    {
        $this->recipients   = $recipients;
        $this->subject      = $subject;
        $this->template     = $template;
        $this->data         = $data;
        $this->fromAddress  = config('mail.from.address');
        $this->fromName     = config('mail.from.name');
        $this->bcc          = $bcc;
    }

    public function handle()
    {
        Mail::send($this->template, ['data'=> $this->data], function ($message) {
            if ($this->fromAddress && $this->fromName) {
                $message->from($this->fromAddress, $this->fromName);
            }
            $message->to($this->recipients)->subject($this->subject);

            if ($this->bcc) {
                $message->bcc($this->bcc);
            }
        });
    }
}
