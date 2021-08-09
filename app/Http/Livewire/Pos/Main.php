<?php

namespace App\Http\Livewire\Pos;
use App\Buku as Bk;
use Livewire\Component;

class Main extends Component
{
    public $arr = [];
    public $listen = 1;
    
    protected $listeners = [
        'getcheck',
    ];
    
    public function getcheck($id, $no){
        
        $this->arr[$no][0] = $id;
    }
    
    public function hapus($id){
        unset($this->arr[$id]);
    }
    
    public function render()
    {
        $data['buku'] = Bk::get()->toArray();
        $this->emit('select2');
        return view('livewire.pos.main', $data);
    }
}
