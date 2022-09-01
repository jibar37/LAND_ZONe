<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href=assets/tambahan.css />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<title>LAND ZONe</title>

</head>

<body>
	<div id="offline" class="off">
		<div class="alert alert-danger" role="alert">
			You are <b style="color:red;">OFFLINE</b>
			<br>
			Please Turn On Internet Connection To Run Website
		</div>
	</div>
	<div id="online" class="on">
		<div class="alert alert-success" role="alert">
			<b style="color:green">ONLINE</style=>
		</div>
	</div>
	<div id="map"></div>
	<div>
		<div id="changeMap" data-toggle="buttons">
			<label id="streets-v11" class="btn btn-secondary active">
				<input type="radio" name="options" id="streets-v11" autocomplete="off" checked> STREET
			</label>
			<label id="satellite-v9" class="btn btn-secondary">
				<input type="radio" name="options" id="satellite-v9" autocomplete="off"> SATELITE
			</label>
			<label id="outdoors-v11" class="btn btn-secondary">
				<input type="radio" name="options" id="outdoors-v11" autocomplete="off"> OUTDOORS
			</label>
			<label id="tambah" class="btn btn-secondary">
				<input type="radio" name="options" id="tambah" autocomplete="off"> TAMBAH
			</label>
			<label id="edit" class="btn btn-secondary">
				<input type="radio" name="options" id="edit" autocomplete="off"> EDIT
			</label>

		</div>

	</div>
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

	<script type='module' src='assets/Main.js'></script>
	<script type="text/javascript">
		function edit1() {
			edit();
		}
	</script>
	<script type="module">
		import {
			mapStyle,
			tambah,
			edit,
		} from "<?php echo base_url(); ?>assets/Main.js";
		document.getElementById("satellite-v9").onclick = function() {
			mapStyle('satellite-v9');

		};
		document.getElementById("streets-v11").onclick = function() {
			mapStyle('streets-v11');

		};
		document.getElementById("outdoors-v11").onclick = function() {
			mapStyle('outdoors-v11');

		};
		document.getElementById("tambah").onclick = function() {
			//mapStyle('outdoors-v11');
			tambah();
		};
		document.getElementById("edit").onclick = function() {
			//mapStyle('outdoors-v11');
			edit();
		};
		let off = document.getElementById("offline");
		let on = document.getElementById("online");
		window.addEventListener('offline', (e) => {
			console.log('offline');
			off.style.display = 'block';
			on.style.display = 'none';

		});

		window.addEventListener('online', function() {
			console.log('online');
			let hidden = document.getElementById("offline");
			off.style.display = 'none';
			on.style.display = 'block';
		});
	</script>
</body>

</html>