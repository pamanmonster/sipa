$(document).ready(function () {
	var table;
	var colId = 0;
	var rowId = 0;
	var sto = "";
	var tableDetail;
	//datatables
	table = $("#table-data").DataTable({
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: `${base_url}asetManagement/category_list`,
			type: "POST",
		},
		columnDefs: [
			{
				targets: [0],
				orderable: false,
				className: "text-center table-success font-weight-bold",
			},
			{
				targets: [5],
				render: (data) => {
					return `
						<div class="btn-group">
							<a href="${base_url}asetManagement/category_edit/${data}" class="btn btn-sm btn-primary btn-pill">
								Edit
							</a>
							<a href="${base_url}asetManagement/category_edit/${data}/1" class="btn btn-sm btn-info btn-pill">
								Sub
							</a>
							<button class="btn btn-sm btn-danger btn-pill hapus-button" data-id="${data}">
								Hapus
							</button>
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
		let category_id = $(this).data("id");
		Swal.fire({
			icon: 'info',
			title: 'Hapus Data ini?',
			showCancelButton: true,
			confirmButtonText: 'Hapus',
		  }).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url : `${base_url}asetManagement/category_delete`,
					type : 'POST',
					dataType : 'json',
					data : {category_id},
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
