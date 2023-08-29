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
						<a class="btn btn-primary buttons-copy buttons-html5" href="category_edit">
							<span>Add Category</span>
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
										<th width="10">No</th>
										<th>Kode</th>
										<th>Kategori</th>
										<th>Periode Penghitungan</th>
										<th>Active</th>
										<th width="10"></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
