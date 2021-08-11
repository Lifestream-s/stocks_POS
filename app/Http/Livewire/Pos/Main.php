<?php

namespace App\Http\Livewire\Pos;
use App\Buku as Bk;
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
                            return Session::flash('message-alert', "Item buku tidak boleh sama");
                        }
                    }
                }
            }
            
           
        }
        
        
//        if (array_key_exists("qty", $this->arr[$no][0])) {
//            unset($this->arr[$no][0]['qty']);  
//        }       
//        
//        $ambil_arr_sama = array_unique($this->arr, SORT_REGULAR);
//        $ambil_key = array_diff_key($this->arr, $ambil_arr_sama);
//       
//        $this->sama = $ambil_key;
//        
//        if($this->sama){
//            $this->arr[$no][0]['id'] = 0;
//            unset($this->arr[$no]);
//            return Session::flash('message-alert', "Item buku tidak boleh sama");
//        }
    }
    
    public function change_qty($qty,$no, $id){
     
        $this->arr[$no][0] = [
            'id' => $id,
            'qty' => $qty
        ];

//        if (array_key_exists("qty", $this->arr[$no][0])) {
//            $this->baru[$no][0] = $this->arr[$no][0];
//            unset($this->arr[$no][0]['qty']);  
//        }       
//        
//        $ambil_arr_sama = array_unique($this->arr, SORT_REGULAR);
//        $ambil_key = array_diff_key($this->arr, $ambil_arr_sama);
//       
//        $this->sama = $ambil_key;
//        
//        if($this->sama){
//            $this->arr[$no][0]['id'] = 0;
//            unset($this->arr[$no]);
//            return Session::flash('message-alert', "Item buku tidak boleh sama");
//        }
//        
//        
//        return $this->sama;
    }
    
    public function hapus($id){
        unset($this->arr[$id]);
        $this->arr = array_values($this->arr);
    }
    
    public function render()
    {
        $data['buku'] = Bk::get()->toArray();
        $this->emit('select2');
        return view('livewire.pos.main', $data);
    }
}
