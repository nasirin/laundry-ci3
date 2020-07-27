<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Iventory</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
	<h1 class="text-center">Laporan Iventory</h1>
	<p class="text-center"><?= date('Y-m-d') ?></p>

	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Kode</td>
				<td>Nama</td>
				<td>Varian</td>
				<td>Ukuran</td>
				<td>Suplier</td>
				<td>Harga</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($inventory as $value): ?>
			<tr>
				<td><?= $value->kode_inventory ?></td>
				<td><?= $value->nama_barang ?></td>
				<td><?= $value->varian_inventory ?></td>
				<td><?= $value->quantity_inventory ?></td>
				<td><?= $value->supplier_inventory ?></td>
				<td><?= indo_currency($value->harga_beli) ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
		
	</table>
	
</body>
</html>