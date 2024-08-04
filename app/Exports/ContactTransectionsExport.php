<?php

namespace App\Exports;

use App\Models\ContactTransection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Helper;

class ContactTransectionsExport extends DefaultValueBinder implements
        FromQuery,WithTitle,WithMapping,WithHeadings,ShouldAutoSize, WithEvents,WithColumnFormatting,WithCustomValueBinder
{
    use Exportable;


    private $month;
    private $year;

    private $start_date;
    private $end_date;
    private $conpany_id;
    private $department_id;
    private $type_checkin;

    public function __construct(string $start_date, string $end_date, int $conpany_id, array $department_id, string $type_checkin = "checkin")
    {
        $this->start_date  = $start_date;
        $this->end_date  = $end_date;
        $this->conpany_id = $conpany_id;
        $this->department_id = $department_id;
        $this->type_checkin  = $type_checkin;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        if($this->department_id['id'] == ''){
            return ContactTransection::query()
                ->with('getCompany','getDepartment','getObjective')
                ->where('company_id','=',$this->conpany_id)
                ->whereBetween('checkin_time', [$this->start_date, $this->end_date])
                ->where(function($query) {
                    if ($this->type_checkin == "parking") {
                        $query->whereNotNull('vechicle_cost_types_id');
                        $query->where('vehicel_registration', '!=', '');
                        $query->where('status', 1);
                    }
                    // if ($this->type_checkin == "checkin") {
                    //     $query->whereNull('vechicle_cost_types_id');
                    // } elseif ($this->type_checkin == "parking") {
                    //     $query->where(function($where2){
                    //         $where2->whereNotNull('vechicle_cost_types_id');
                    //         $where2->where('status', 1);
                    //     });
                    //     $query->orWhere(function($where2){
                    //         $where2->where('status', 0);
                    //         $where2->where('contact_transection.vehicel_registration', '!=', '');
                    //     });
                    // }
                });
        }else{
            return ContactTransection::query()
                ->with('getCompany','getDepartment','getObjective')
                ->where('company_id','=',$this->conpany_id)
                ->where(function($query) {
                    if ($this->type_checkin == "parking") {
                        $query->whereNotNull('vechicle_cost_types_id');
                        $query->where('vehicel_registration', '!=', '');
                        $query->where('status', 1);
                    }
                    // if ($this->type_checkin == "checkin") {
                    //     $query->whereNull('vechicle_cost_types_id');
                    // } elseif ($this->type_checkin == "parking") {
                    //     $query->where(function($where2){
                    //         $where2->whereNotNull('vechicle_cost_types_id');
                    //         $where2->orWhere('status', 1);
                    //     });
                    //     $query->orWhere(function($where2){
                    //         $where2->orWhere('status', 0);
                    //         $where2->orWhere('contact_transection.vehicel_registration', '!=', '');
                    //     });
                    // }
                })
                ->where('department_id','=',$this->department_id['id'])
                ->whereBetween('checkin_time', [$this->start_date, $this->end_date]);
        }

        // return ContactTransection::query()
        //     ->with('getCompany','getDepartment','getObjective')
        //     ->where('company_id', '=', $this->conpany_id)
        //     ->where(function($query) {
        //         if ($this->type_checkin == "checkin") {
        //             $query->where('vehicel_registration', '=', "");
        //         } elseif ($this->type_checkin == "parking") {
        //             $query->where('vehicel_registration', '!=', "");
        //         }
        //     })
        //     ->whereBetween('checkin_time', [$this->start_date, $this->end_date])
        //     ->get();

    }
    public function map($contactTransection): array
    {
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        if($contactTransection->company_id == 11 ){
            $department = $contactTransection->person_contact;
            $idcard = $contactTransection->idcard;
        }else{
            $department = isset($contactTransection->getDepartment) ? $contactTransection->getDepartment->name : '';
            $idcard = $contactTransection->idcard;
        }

        if (is_numeric($idcard) && strlen($idcard) == 13) {
            $formattedIdCard = substr($idcard, 0, 1) . '-' . substr($idcard, 1, 2) . 'XX-' . str_repeat('X', 5) . '-' . substr($idcard, 10, 2) . '-' . substr($idcard, 12, 1);
        } else {
            $formattedIdCard = '-----';
        }
        $paymentMethod = ($contactTransection->payment_id == 1) ? "Qr Code" : (($contactTransection->payment_id == 2) ? "เงินสด" : "");

        return [
            [
                $contactTransection->getCompany->name,
                (string) $department,
                isset($contactTransection->getObjective) ? $contactTransection->getObjective->name : '',
                (string) $contactTransection->contact_code,
                (string) $formattedIdCard,
                $contactTransection->fullname,
                ''.$contactTransection->vehicel_registration,
                // $contactTransection->gender,
                // $contactTransection->birth_date,
                $contactTransection->address,
                // $contactTransection->temperature,
                $contactTransection->checkin_time,
                $contactTransection->checkout_time,
                !empty($contactTransection->checkout_time) ? Helper::dateDiff($contactTransection->checkin_time,$contactTransection->checkout_time):'-',
                $contactTransection->status == 0  ? "เข้า" : "ออก",
                $paymentMethod,
                $contactTransection->price_amount,
            ],
        ];
    }

//     public function drawings()
// {
//     // $drawing = new Drawing();
//     // $drawing->setName('Logo');
//     // $drawing->setDescription('This is my logo');
//     // $drawing->setPath(public_path('/img/logo.jpg'));
//     // $drawing->setHeight(50);
//     // $drawing->setCoordinates('B3');
//     //
//     // $drawing2 = new Drawing();
//     // $drawing2->setName('Other image');
//     // $drawing2->setDescription('This is a second image');
//     // $drawing2->setPath(public_path('/img/other.jpg'));
//     // $drawing2->setHeight(120);
//     // $drawing2->setCoordinates('G2');
//     //
//     // return [$drawing, $drawing2];
// }

    /**
     * @return string
     */
    public function title(): string
    {
        if(strlen($this->department_id['name']) >= 30){
            $title_name = mb_substr($this->department_id['name'], 0, 20, "utf-8");
            $title_name .= '..';
            return $title_name;
        }else{
            return 'แผนก' . mb_substr($this->department_id['name'], 0, 20, "utf-8");
        }
    }

    public function headings(): array
    {
        if($this->conpany_id == 11){
            $department_txt = 'ที่มาติดต่อ';
        }else{
            $department_txt = 'แผนกที่มาติดต่อ';
        }

        return [
            "บริษัท",
            $department_txt,
            "วัตถุประสงค์",
            "หมายเลขอ้างอิงผู้ติดต่อ",
            "หมายเลขบัตร",
            "ชื่อ - นามสกุล",
            "ทะเบียนรถ",
            // "เพศ",
            // "วันเกิด",
            "ที่อยู่",
            // "อุณหภูมิ",
            "วันที่/เวลาเข้า",
            "วันที่/เวลาออก",
            "เวลาอยู่รวมทั้งหมด",
            "สถานะ",
            "ช่องทางการชำระเงิน",
            "จำนวน",
        ];
    }
        /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:L1'; // All headers
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => ['argb' => 'FFFF0000']
                    ],
                ];

                $event->sheet
                    ->getDelegate()
                    ->getStyle('A1:'.$event->sheet->getDelegate()->getHighestColumn().'1')
                    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('D5D5D5')->applyFromArray($styleArray);

            },
        ];
    }

        /**
     * @return array
     */
    public function columnFormats(): array
    {
        //PHPExcel_Cell_DataType::TYPE_STRING
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
        ];
    }



    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'D') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        if ($cell->getColumn() == 'E') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }


}
