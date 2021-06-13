<?php

namespace Modules\Register\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Register\Entities\Form;

class FormPersonalNotified extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Form
     */
    private $form;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $form = $this->form;

        return $this->markdown('register::mails.form-notified')
            ->replyTo($form->email, $form->company)
            ->subject(setting('themes::company-name', locale()).' - '.$form->id.' no.lu Taşıt Tanıma Sistemi Başvurusu')
            ->with(compact('form'));
    }
}
