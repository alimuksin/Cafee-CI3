<style type="text/css">
    .card-input-element {
    display: none;
}

.card-input {
    padding: 12px 16px;
    border: 2px solid #999;
    background-color: #fff;
    height: 80px;
    align-items: center;
    display: flex;
    margin-bottom: 6px;
    border-radius: 8px;
    text-align: center;
    
}

.card-input:hover {
    cursor: pointer;
}

.card-input-element:checked + .card-input{
     box-shadow: 0 0 1px 1px #27ae60;
     background-color: #cdffe2;
 }
</style>

<input type="hidden" name="amount" value="<?=$this->input->post('amount') ?>">
<input type="hidden" name="app" value="<?=$this->input->post('app') ?>">
<input type="hidden" name="amount_other" value="<?=$this->input->post('amount_other') ?>">
<input type="hidden" name="nama" value="<?=$this->input->post('nama') ?>">
<input type="hidden" name="pesan" value="<?=$this->input->post('pesan') ?>">
<input type="hidden" name="id_transaksi" value="<?=$this->input->post('id_transaksi') ?>">
<div class="row p-2">
    <?php foreach ($tp['data'] as $tp) { ?>
        <?php if ($tp['active'] == 1) { ?>
        <div class="col-6 col-md-4 mb-2">
            <label>
                <input type="radio" name="method" class="card-input-element" value="<?=$tp['code'] ?>" />
                <div class="panel card-input">
                    <img alt="<?=$tp['name'] ?>" title="<?=$tp['name'] ?>" src="<?= $tp['icon_url'] ?>" width="100%">
                </div>
            </label>
        </div>
    <?php }}?>
</div>