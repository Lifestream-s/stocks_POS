<div class="row p-2">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    
    <form wire:submit.prevent="save_product"> 
        <div class="mb-3">
            <label>Kode Produk</label>
            <input class="form-control" type='text' wire:model="kode_produk" id="kode_produk" />

            @error('kode_produk')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-3">
            <label>Nama Produk</label>
            <input class="form-control" type='text' wire:model='nama_produk' id="nama_produk" />
            @error('nama_produk') <span>{{ $message }}</span> @enderror
        </div>
        
        <div class="col-md-12">  
            <button class="btn btn-success">Save</button>
        </div>
    </form>
</div>
