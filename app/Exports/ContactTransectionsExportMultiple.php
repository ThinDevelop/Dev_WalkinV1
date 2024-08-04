<?php

namespace App\Exports;

use App\Models\ContactTransection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ContactTransectionsExportMultiple implements WithMultipleSheets
{
    use Exportable;

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
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        if(!empty($this->department_id)){
            foreach ($this->department_id as $key => $department) {
                $sheets[] = new ContactTransectionsExport($this->start_date,$this->end_date,$this->conpany_id,$department, $this->type_checkin);
            }
        }
        return $sheets;

    }
}
