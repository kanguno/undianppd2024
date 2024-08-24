<?php

namespace App\Exports;
use App\Models\Merchants;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MerchantDatasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Merchants::All();
        //
    }
    public function headings(): array
    {
        return [
            'ID',
            'Device ID',
            'NOPD',
            'Nama Merchant',
            'Alamat Merchant',
        ];
    }
}
