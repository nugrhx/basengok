<div class="container">
	<div class="pt-5">
		<div class="container">
			<table id="pendukungTable" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Jumlah Unduhan</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Jumlah Unduhan</th>
						<th>Download</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// Inisialisasi DataTable dengan AJAX
		$('#pendukungTable').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('pendukung/ajax_list'); ?>",
				"type": "POST"
			},
			"columns": [{
					"data": "no"
				},
				{
					"data": "nama"
				},
				{
					"data": "file",
					"render": function(data, type, row) {
						var file_extension = data.split('.').pop().toLowerCase();
						var image_extensions = ['jpg', 'jpeg', 'png', 'gif'];

						// Cek apakah file adalah gambar
						if (image_extensions.includes(file_extension)) {
							return '<img src="' + '<?php echo base_url("assets/upload/image/dtw/"); ?>' + data + '" alt="' + row.nama + '" width="50" height="50">';
						} else {
							// Jika bukan gambar, tampilkan nama file
							return data;
						}
					}
				},
				{
					"data": null,
					"render": function(data, type, row) {
						return '<a href="' + '<?php echo base_url("assets/upload/image/dtw/"); ?>' + row.file + '" class="btn btn-sm btn-primary" download>Download</a>';
					}
				}
			]
		});
	});
</script>