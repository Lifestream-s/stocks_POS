<div>
    <div class='container'>
        <div class="row">
            <div class="text-center">
                <h2>Point Of Sale</h2>
                <hr>
                <p style="font-size:20px;">Transaksi</p>
            </div>
        </div>
        
        <div class="col-md-12">
             @if (session()->has('message-alert'))
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        {{ session('message-alert') }}
                    </div>
                </div>
            @endif
        </div>
        
        <div class="row">
            <div class='col-md-4'>
                <table class='table bg-blue-dark'>
                    <thead class='bg-primary text-white'>
                      <th>Item</th>
                    </thead>
                </table>
            </div>

            <div class='col-md-8'>
                <table class='table table-responsive table-fixed text-center'>
                    <thead class='bg-primary text-white'>
                        <th>No</th>
                        <th>Nama Item</th>
                        <th>Qty</th>
                        <th><i class="fa fa-trash-o" aria-hidden="true"></i></th>
                    </thead>

                    <tbody>
                    <?php 
                    $z = 1;

                   for($i = 0; $i < count($arr) + 1; $i++){

                        ?>
                    <tr>
                        <td>{{$z++}}</td>
                        <td>
                            <select class="buku-pilih" style="width:100px;" attr-no="{{$i}}">
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
                            <?php if(!empty($arr[$i]) && $arr[$i][0]['id']){ 
                                $value = 0;
                                if($arr[$i][0]['qty'] > 0){
                                    $value = $arr[$i][0]['qty'];
                                } else {
                                    $value = 0;
                                }
                                ?>
                                <input class="form-control" type="text" wire:change="change_qty($event.target.value, {{$i}}, {{$arr[$i][0]['id']}})" value="{{$value}}">
                            <?php } ?>
                        <?php if(!empty($arr[$i])){ ?>
                        <td><button class="btn btn-danger" wire:click="hapus({{$i}})">x</td>
                        <?php } else { ?>
                        <td><p>Silahkan Tambah buku dengan memilih buku</p></td>
                     <?php }} ?>
                    <tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        //$('.js-example-basic-single').select2();
        

            window.initSelectBuku=()=>{
                $('.buku-pilih').select2({
                    placeholder: 'Pilih buku'});
            }
            initSelectBuku();
       
                $(document).on('change', '.buku-pilih', function (e) {
                    var nos = $(this).attr('attr-no');
                    livewire.emit('getcheck', e.target.value, nos);
                });
            
            window.livewire.on('select2',()=>{
                initSelectBuku();
            });
    });
    </script>
</div>
