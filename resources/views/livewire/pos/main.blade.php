<div>
    <div class='row'>
        <div class="col-md-12">
             @if (session()->has('message-alert'))
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        {{ session('message-alert') }}
                    </div>
                </div>
            @endif
        </div>
        <div class='col-md-4'>
            <table class='table bg-blue-dark'>
                <thead class='bg-primary text-white'>
                  <th>Item</th>
                </thead>
            </table>
        </div>

        <div class='col-md-8'>
            <table class='table text-center'>
                <thead class='bg-primary text-white'>
                    <th style="width:50px;">No</th>
                    <th style="width:200px;">Nama Item</th>
                    <th style="width:50px;">Qty</th>
                    <th style="width:20px;"><i class="fa fa-trash-o" aria-hidden="true"></i></th>
                </thead>
                
                <tbody>
                <?php 
                $z = 1;
                
               for($i = 0; $i < count($arr) + 1; $i++){
                  
                    ?>
                <tr>
                    <td>{{$z++}}</td>
                    <td>
                        <select name="country" class="js-example-basic-single" style="width:100px;" attr-no="{{$i}}">
                            <option value="0">Pilih Buku</option>
                            <?php foreach($buku as $k => $v){ 
                              
                                    if(!empty($arr[$i]) && $arr[$i][0]['id'] == $v['id']){
                                ?>
                            <option value="{{$v['id']}}" selected>{{$v['judul']}}</option>
                                   <?php } else { ?>
                            <option value="{{$v['id']}}">{{$v['judul']}}</option>
                            <?php }} ?>
                        </select>
                    </td>
                    <td>
                     <input class="form-control" type="text" wire:change="change_qty($event.target.value)" value="0">
                    </td>
                    <?php if(!empty($arr[$i])){ ?>
                    <td><button class="btn btn-danger" wire:click="hapus({{$i}})">x</td>
                    <?php } else { ?>
                    <td><p>Silahkan Tambah buku dengan memilih buku</p></td>
                 <?php }} print_r($hs); ?>
                <tr>
               
                
                </tbody>
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        //$('.js-example-basic-single').select2();
        

            window.initSelectCompanyDrop=()=>{
                $('.js-example-basic-single').select2({
                    placeholder: 'Pilih buku'});
            }
            initSelectCompanyDrop();
       
                $(document).on('change', '.js-example-basic-single', function (e) {
                    var nos = $(this).attr('attr-no');
                    livewire.emit('getcheck', e.target.value, nos);
                });
            
            window.livewire.on('select2',()=>{
                initSelectCompanyDrop();
            });
    });
    </script>
</div>
