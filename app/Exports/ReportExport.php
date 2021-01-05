<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportExport implements WithMultipleSheets
{
    use Exportable;

    protected $lists;
    
    public function __construct(string $lists)
    {
        $this->lists = $lists;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $daftar = explode('~', $this->lists);
        $daftar = array_splice($daftar, 0, count($daftar)-1);
        
        $sheets = [];

        foreach($daftar as $item)
        {
            $sheets[] = new ReportSheetsItem($item);
        }

        return $sheets;
    }
}
