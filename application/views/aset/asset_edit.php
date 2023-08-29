<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $meta['title'] ?></h5>
                <h6 class="card-subtitle text-muted"><?= $meta['subtitle'] ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" class="form-control" name="form_kode" value="<?= $form_kode; ?>">
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" name="category_id" value="<?= $listData['category_id']; ?>">
                            <?php foreach($listDataCategory as $cat): ?>
                                <option value="<?= $cat[0] ?>"><?= $cat[1] ?>. <?= $cat[2] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" name="asset_kode" value="<?= $listData['asset_kode']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="asset_name" value="<?= $listData['asset_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control" name="asset_description"><?= $listData['asset_description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NUP</label>
                        <input type="text" class="form-control" name="asset_nup" value="<?= $listData['asset_nup']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merk</label>
                        <input type="text" class="form-control" name="asset_merk" value="<?= $listData['asset_merk']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Perolehan</label>
                        <input type="date" class="form-control" name="asset_ac_date" value="<?= $listData['asset_ac_date']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai Perolehan</label>
                        <input type="text" class="form-control" name="asset_ac_value" value="<?= $listData['asset_ac_value']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Masa Manfaat</label>
                        <input type="text" class="form-control" name="asset_lifespan" value="<?= $listData['asset_lifespan']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai Penyusutan</label>
                        <input type="text" class="form-control" name="asset_dep_value" value="<?= $listData['asset_dep_value']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kondisi</label>
                        <input type="text" class="form-control" name="asset_condition" value="<?= $listData['asset_condition']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai Buku</label>
                        <input type="text" class="form-control" name="asset_book_value" value="<?= $listData['asset_book_value']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Produk</label>
                        <div>
                            <input id="fileupload" type="file" name="files" accept="image/*"  data-url="<?= base_url('asetManagement/file_upload') ?>" class="d-none">
                            <div id="dropzone" class="fade well">Drop files here</div>
                            <div id="photo-preview" class="mt-3">
                                <?php foreach($listData['file_name'] as $file): ?>
                                    <img src="<?= base_url('/upload/photo/' . $file) ?>" class="photo-thumb me-3"/>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <input type="submit" class="btn btn-pill btn-primary" value="Simpan" />
                        <input type="reset" class="btn btn-pill btn-danger" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    #dropzone {
        background: palegreen;
        width: 100%;
        height: 100px;
        line-height: 100px;
        text-align: center;
        font-weight: bold;
    }

    #dropzone.in {
        width: 100%;
        height: 100px;
        line-height: 100px;
        font-size: larger;
    }

    #dropzone.hover {
        background: lawngreen;
    }

    #dropzone.fade {
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -ms-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;
        opacity: 1;
    }
    .photo-thumb {
        width: 150px;
        height: 150px;
        object-fit: cover;
        object-position: center;
    }
</style>