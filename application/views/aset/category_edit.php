<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $meta['title'] ?></h5>
                <h6 class="card-subtitle text-muted"><?= $meta['subtitle'] ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" class="form-control" name="category" value="<?= $category['category']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" class="form-control" name="category_kode" value="<?= $category['category_kode']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Kategori</label>
                        <textarea type="text" class="form-control" name="category_description"><?= $category['category_description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode Penghitungan (Bulan)</label>
                        <input type="text" class="form-control" name="dep_calc_interval" value="<?= $category['dep_calc_interval']; ?>">
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Active</label>
                        <div class="col-sm-10">
                            <label class="form-check m-0">
                                <input type="checkbox" class="form-check-input" name="active" true-value="1" false-value="0" value="<?= $category['active']; ?>">
                            </label>
                        </div>
                    </div>
                    <div class="text-right">
                        <input type="submit" class="btn btn-pill btn-primary" value="Simpan"/>
                        <input type="reset" class="btn btn-pill btn-danger" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>