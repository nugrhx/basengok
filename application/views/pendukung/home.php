<div class="container">
	<div class="pt-5">
		<div class="container">
			<table id="table" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- jQuery v3.6.0-->
<script src="<?= base_url('assets'); ?>/vendor/plugins/jquery/jquery.min.js"></script>

<!-- Tambahkan script DataTables dan fungsi download -->
<script>
	$(document).ready(function() {
		$('#table').DataTable({
			"processing": true,
			"serverSide": false,
			"ajax": {
				"url": "<?php echo base_url('home/pendukung_get_data'); ?>", // Ganti dengan URL method controller
				"type": "GET"
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
						// Menggunakan row.id_pen untuk ID unik
						return '<a href="' + data + '" class="btn btn-primary download-btn" data-id="' + row.id_pen + '" target="_blank">Download</a>';
					}
				}
			]
		});

		$('#search').on('keyup', function() {
			table.search(this.value).draw();
		});
	});
</script>