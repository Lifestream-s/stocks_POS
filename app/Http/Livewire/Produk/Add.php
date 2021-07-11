<?php

namespace App\Http\Livewire\Produk;

use Livewire\Component;
use App\produk_model as pm;

class Add extends Component
{
    public $kode_produk;
    public $nama_produk;
   
    
     protected $rules = [
        'kode_produk' => 'required|min:6',
        'nama_produk' => 'required|min:6',
    ];
     
    public function save_product(){
        $this->validate();
        
         // Jika eksekusi gagal
        try{
            \DB::beginTransaction();
            
            pm::create([
                'kode_product' => $this->kode_produk,
                'nama_product' => $this->nama_produk,
                'qty_product' => 0
            ]);
            
            \DB::commit();
            
             session()->flash('message', 'Penambahan Produk telah berhasil.');
             
        } catch (Exception $ex) {
            dd($ex);
            \DB::rollback();
        }
    }
    
    public function render()
    {
        return view('livewire.produk.add');
    }
}
