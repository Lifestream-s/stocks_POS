<?php

namespace App\Http\Livewire\Pos;
use App\Buku as Bk;
use Session;
use Livewire\Component;

class Main extends Component
{
    public $arr = [];
    public $baru = [];
    public $sama = [];
    public $listen = 1;
    
    protected $listeners = [
        'getcheck',
    ];
    
    public function getcheck($id, $no){
              
        $this->arr[$no][0] = $id;
         
        $unique = array_unique($this->arr, SORT_REGULAR);
        $diffCellUniq = array_diff_key($this->arr, $unique);
        
        $this->sama = $diffCellUniq;
        
        if($this->sama){
            $this->arr[$no][0] = 0;
            unset($this->arr[$no]);
            return Session::flash('message-alert', "Item buku tidak boleh sama");
        }
    }
    
    public function hapus($id){
        unset($this->arr[$id]);
        
        $this->baru = array_values($this->arr);
        $this->arr = $this->baru;
        return $this->arr;
    }
    
    public function render()
    {
        $data['buku'] = Bk::get()->toArray();
        $this->emit('select2');
        return view('livewire.pos.main', $data);
    }
}
