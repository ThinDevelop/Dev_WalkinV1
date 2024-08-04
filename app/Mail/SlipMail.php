<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SlipMail extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $appointment;
    public $date_appointment_formatted;
    public $pdfOutput;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company, $appointment, $date_appointment_formatted, $pdfOutput)
    {
        $this->company = $company;
        $this->appointment = $appointment;
        $this->date_appointment_formatted = $date_appointment_formatted;
        $this->pdfOutput = $pdfOutput;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // ค่าของบริษัทที่อาจเป็น null
        $companyName = $this->company->name ?? '';
        
        // ค่าของวันที่นัดหมายที่อาจเป็น null
        $appointmentDate = $this->date_appointment_formatted ?? '0000-00-00';
        
        // สร้างหัวข้ออีเมล
        if($companyName) {
            $subject = '[Walkin] - แจ้งเตือนการนัดหมายเข้า ' . ($companyName !== '' ? $companyName : '');
        } else {
            $subject = '[Walkin] - แจ้งเตือนการนัดหมายเข้าตึก';
        }
        
        // สร้างชื่อไฟล์ PDF
        $pdfFileName = 'appointment_' . ($appointmentDate !== '' ? $appointmentDate : '0000-00-00') . '.pdf';

        return $this->subject($subject)
            ->view('admin.appointment.form_email')
            ->with('appointment', $this->appointment)
            ->attachData($this->pdfOutput, $pdfFileName, [
                'mime' => 'application/pdf',
            ]);
    }
}
