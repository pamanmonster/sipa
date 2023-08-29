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
			url: `${base_url}/auth/user_list`,
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
                    $ret = ``;
                    data.forEach(element => {
                        $ret += `<span class="badge bg-primary me-1">${element.description}</span>`;  
                    });
					return $ret;
				},
			},
			{
				targets: [7],
				render: (data) => {
					return `
						<div class="">
							<a href="${base_url}auth/edit_user/${data}" class="btn btn-sm btn-primary mr-2 rounded">
								<i class="fa fa-pencil-alt"></i>
							</a>
							<button class="btn btn-sm btn-danger hapus-button rounded" data-id="${data}">
								<i class="fa fa-trash-alt"></i>
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
		let id = $(this).data("id");
		Swal.fire({
			icon: 'info',
			title: 'Hapus Data ini?',
			showCancelButton: true,
			confirmButtonText: 'Hapus',
		  }).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url : 'user_delete',
					type : 'POST',
					dataType : 'json',
					data : {id},
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
