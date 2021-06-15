<?php

namespace Modules\Register\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Register\Entities\Form;
use Modules\Register\Services\CollateralService;

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

        $collateral = new CollateralService($form);
        $rate = $collateral->findRangeRate();

        if($form->files()->count()>0) {
            $files = $form->files()->get();
            foreach ($files as $file) {
                $path = public_path('assets/register/').$file->name;
                $this->attach($path);
            }
        }

        return $this->markdown('register::mails.personal-notified')
            ->replyTo($form->email, $form->company)
            ->subject(setting('theme::company-name', locale()).' - '.$form->id.' no.lu Taşıt Tanıma Sistemi Başvurusu')
            ->with(compact('form', 'rate'));
    }
}
