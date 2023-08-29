$(document).ready(function () {
	var table;
	//datatables
	table = $("#table-data").DataTable({
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: "tag_list",
			type: "POST",
		},
		columnDefs: [
			{
				targets: [0],
				orderable: false,
				className: "text-center table-success font-weight-bold",
			},
			{
				targets: [2],
				render: (data) => {
					return `
						<div class="btn-group">
							<a href="${base_url}/asetManagement/tag_edit/${data}" class="btn btn-sm btn-primary btn-pill">
								Edit
							</a>
							<a href="${base_url}/asetManagement/tag_edit/${data}/1" class="btn btn-sm btn-info btn-pill">
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
		let tag_id = $(this).data("id");
		Swal.fire({
			icon: 'info',
			title: 'Hapus Data ini?',
			showCancelButton: true,
			confirmButtonText: 'Hapus',
		  }).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url : 'tag_delete',
					type : 'POST',
					dataType : 'json',
					data : {tag_id},
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
