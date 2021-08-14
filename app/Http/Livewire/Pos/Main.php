<?php

namespace App\Http\Livewire\Pos;
use App\Buku as Bk;
use App\ShopModel as Sm;
use Session;
use Livewire\Component;

class Main extends Component
{
    public $arr = [];
    public $debug = [];
    public $warning = [];
    

    protected $listeners = [
        'getcheck',
        'change_qty'
    ];
    
    public function getcheck($id, $no){
        
        $this->arr[$no][0] = [
            'id' => $id,
            'qty' => 0
        ]; 
        
        foreach($this->arr as $k => $v){
            foreach($v as $k2 => $v2){
                
                $this->warning[$k][$k2] = $v2;
                
                foreach($this->warning as $w => $z){
                    foreach($z as $a => $vs){
                        if($k != $w && $this->warning[$w][$a]['id'] == $this->arr[$k][$k2]['id']){
                            $this->arr[$no][0]['id'] = 0;
                            unset($this->arr[$no]);
                            unset($this->warning[$no]);
                            return Session::flash('message-alert', "Pilih item produk yang berbeda");
                        }
                    }
                }
            }  
        }
    }
    
    public function change_qty($qty,$no, $id){
     
        $this->arr[$no][0] = [
            'id' => $id,
            'qty' => $qty
        ];
        
        foreach($this->arr as $k => $v){
            foreach($v as $k2 => $v2){
                
                $this->warning[$k][$k2] = $v2;
                
                foreach($this->warning as $w => $z){
                    foreach($z as $a => $vs){
                        if($k != $w && $this->warning[$w][$a]['id'] == $this->arr[$k][$k2]['id']){
                            $this->arr[$no][0]['id'] = 0;
                            unset($this->arr[$no]);
                            unset($this->warning[$no]);
                            return Session::flash('message-alert', "Item buku tidak boleh sama");
                        }
                    }
                }
            }  
        }
    }
    
    public function hapus($id){
        unset($this->arr[$id]);
        unset($this->warning[$id]);
        
        foreach($this->arr as $k => $v){
            foreach($v as $w => $z){
                if($k != $id){
                    $this->arr[$k][0] = [
                        'id' => $z['id'],
                        'qty' => $z['qty']
                    ];
                }
            }
        }
        
        $this->arr = array_values($this->arr);
        $this->warning = array_values($this->warning);
    }
    
    public function render()
    {
        $data['barang'] = Sm::get()->toArray();
        $this->emit('select2');
        return view('livewire.pos.main', $data);
    }
}
