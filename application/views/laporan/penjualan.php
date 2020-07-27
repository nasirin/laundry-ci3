<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Penjualan</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
	<h1 class="text-center">Laporan Penjualan</h1>
	<p class="text-center"><?= date('Y-m-d') ?></p>

	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Kode</td>
				<td>Pelanggan</td>
				<td>Jasa</td>
				<td>Berat</td>
				<td>Total Harga</td>
				<td>Status</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($order as $value): ?>
			<tr>
				<td><?= $value->kode_order_kiloan ?></td>
				<?php if ($value->id_member == null) { ?>
	                <td><?= $value->nama_pelanggan_kiloan ?></td>
            	<?php } else { ?>
	                <td><?= ucwords($value->nama_member) ?> <small>(member)</small></td>
	            <?php } ?>
				<td><?= $value->nama_product_kiloan ?></td>
				<td><?= $value->berat_kiloan ?></td>
				<td><?= indo_currency($value->total_harga_kiloan) ?></td>
				<td><?= $value->status_kiloan ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
		
	</table>
	
</body>
</html>