<?php
error_reporting(0);
$b = $brg->row_array();
$data = array();
foreach ($this->cart->contents() as $items) {
    $data[$items['brg']] = $items['qty'];
}
?>


<div class="form-group row">
    <label class="col-sm-3 col-form-label">Kode Barang</label>
    <div class="col-sm-3">
        <input type="text" value="<?php echo $b['kode_barang']; ?>" class="form-control" readonly>
    </div>
    <label class="col-sm-3 col-form-label text-right">Stok</label>
    <div class="col-sm-3">
        <input type="text" value="<?php if (($b['stok'] - $data[$b['kode_barang']]) < 0) {
                                        echo '';
                                    } else {
                                        echo $b['stok'] - $data[$b['kode_barang']];
                                    } ?>" class="form-control" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Jumlah</label>
    <div class="col-sm-3">
        <input type="number" name="qty" value="1" min="0.01" step=".01" class="form-control " required>
    </div>
    <label class="col-sm-3 col-form-label text-right">Satuan</label>
    <div class="col-sm-3">
        <input type="text" name="satuan" value="<?php echo $b['satuan']; ?>" class="form-control" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Keterangan (Barang) </label>
    <div class="col-sm-9">
        <textarea name="ket" class="form-control form-control-sm"></textarea>
    </div>
</div>
<button type="submit" class="btn btn-sm btn-primary">Ok</button>