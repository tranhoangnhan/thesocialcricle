<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoicePaid extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $amount;
public $course;
public $date;
public $id_bill;
public $courseLink;

public function __construct($amount, $course, $date, $id_bill, $courseLink)
{
    $this->amount = $amount;
    $this->course = $course;
    $this->date = $date;
    $this->id_bill = $id_bill;
    $this->courseLink = $courseLink;
}
  
    public function build()
{
    $subject = 'Thông báo thanh toán thành công hóa đơn #' . $this->id_bill . ' từ ' . 'The Social Cricle';

    return $this->view('clients.emails.bill')
                ->subject($subject);
}
}
