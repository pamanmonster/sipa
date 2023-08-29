$(document).ready(function () {
	var table;
	//datatables
	table = $("#table-data").DataTable({
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: `${base_url}asetManagement/asset_list`,
			type: "POST",
		},
		columnDefs: [
			{
				targets: [0],
				orderable: false,
				className: "text-center table-success font-weight-bold",
			},
			{
				targets: [1],
				render: (data) => {
					return `
						<img class="photo-thumb-sm rounded" src="${base_url}upload/photo/${data}" />
					`;
				},
			},
			{
				targets: [9],
				render: (data) => {
					return `
						<div class="btn-group">
							<a href="${base_url}asetManagement/asset_edit/${data}" class="btn btn-sm btn-primary btn-pill">
								Edit
							</a>
							<button class="btn btn-sm btn-danger btn-pill hapus-button" data-id="${data}">
								Hapus
							</button>
							<a href="${base_url}asetManagement/asset_promo/${data}" class="btn btn-sm btn-success btn-pill">
								Promo
							</a>
						</div>
					`;
				},
			}
		],
		paging: true,
		searching: true,
		info: true,
	});

	$('#table-data tbody').on( 'click', '.hapus-button', function (a) {
		let asset_id = $(this).data("id");
		Swal.fire({
			icon: 'info',
			title: 'Hapus Data ini?',
			showCancelButton: true,
			confirmButtonText: 'Hapus',
		  }).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url : `${base_url}asetManagement/asset_delete`,
					type : 'POST',
					dataType : 'json',
					data : {asset_id},
				}).then(function(resp) {
					Swal.fire('Data dihapus!', '', 'success');
					table.ajax.reload();	
				});

			} else if (result.isDenied) {
			  Swal.fire('Changes are not saved', '', 'info')
			}
		});
    });
});
