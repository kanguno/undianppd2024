<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use App\Models\Merchants;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegDatasExport;

class Merchant extends Component
{
    public $namamerchant='';
    public $almmerchant='';
    public $deviceid='';
    public $nopd='';
    public function render()
    {
        $datamerchants=Merchants::paginate(2);
        return view('livewire.merchants',['datamerchants' => $datamerchants])->layout('layouts.app');;
    }
    public function inputData(){
        
        // $data=Merchants::where('id',$this->id)->first();
        // if(empty($data)){
        // $nama=Str::upper($this->nama);
        // $alamat=Str::upper($this->alamat);
        // $nohp=Str::upper($this->nohp);
        // $email=Str::upper($this->email);
        // $this->validate($this->rulesDataWp());
            Merchants::create([
                'nm_merchant' => $this->namamerchant,
                'device_id' => $this->deviceid,
                'nopd' => $this->nopd,
                'alm_merchant' => $this->almmerchant,
            ]);
        // }
    }
}

