<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex justify-content-between align-items-start">
					<div>
						<h5 class="card-title"><?= $meta['title'] ?></h5>
                		<h6 class="card-subtitle text-muted"><?= $meta['subtitle'] ?></h6>
					</div>
					<div class="dt-buttons btn-group flex-wrap">
						<a class="btn btn-primary buttons-copy buttons-html5" href="asetManagement/asset_edit">
							<span>Add Aset</span>
						</a>
						<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="datatables-buttons" type="button"><span>Print</span></button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div id="datatables-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
					<div class="row dt-row">
						<div class="col-sm-12">
							<table id="table-data" class="table table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th></th>
										<th>Kode Barang</th>
										<th>Nama Barang</th>
										<th>Kategori</th>
										<th>NUP</th>
										<th>Merk</th>
										<th>Nilai Perolehan</th>
										<th>Kondisi</th>
										<th>Nilai Penyusutan</th>
										<th></th>
									</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<style>
	.photo-thumb-sm {
        width: 45px;
        height: 45px;
        object-fit: cover;
        object-position: center;
    }
</style>