<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $meta['title'] ?></h5>
                <h6 class="card-subtitle text-muted"><?= $meta['subtitle'] ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Produk</label>
                                <input type="text" class="form-control" name="product_name" value="<?= $listData['product_name']; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Varian</label>
                                <input type="text" class="form-control" name="product_tipe" value="<?= $listData['product_tipe']; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Diskon (dalam Persen)</label>
                                <input type="text" class="form-control" name="promo_discount" value="<?= $listData['promo_discount']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="text" class="form-control" name="promo_price" value="<?= $listData['promo_price']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mulai</label>
                                <input type="date" class="form-control" name="promo_start" value="<?= $listData['promo_start']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Selesai</label>
                                <input type="date" class="form-control" name="promo_end" value="<?= $listData['promo_end']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea type="text" class="form-control" name="promo_desc" value="<?= $listData['promo_desc']; ?>"></textarea>
                            </div>
                            <div class="text-right">
                                <input type="submit" class="btn btn-pill btn-primary" value="Simpan" />
                                <input type="reset" class="btn btn-pill btn-danger" value="Reset">
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>