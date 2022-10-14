<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href=assets/tambahan.css />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<title>LAND ZONe</title>

</head> -->
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
	<h5 class="my-0  font-weight-bold">LAND ZONe</h5>

	<nav class="my-2 my-md-0 mr-md-3">
		<a class="p-2 text-dark" href="#">About Us</a>

	</nav>

	<h3 class="nav-item dropdown my-0 mr-md-auto font-weight-normal">
		<a class="btn btn-outline-primary" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			LOGIN
		</a>
		<form class="dropdown-menu p-4" action="<?php echo base_url('admin'); ?>" method="post">
			<div class="form-group">
				<label for="username">Username</label>
				<input class="form-control" id="username" placeholder="Username">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-primary">Sign in</button>
		</form>
	</h3>
	<nav class="my-2 my-md-0 mr-md-3">
		<button class="btn btn-outline-success btn-sm" name="options" id="streets-v11" autocomplete="off"> STREET
		</button>
		<button type="button" class="btn btn-outline-success btn-sm" name="options" id="satellite-v9" autocomplete="off"> SATELITE
		</button>
		<button type="button" class="btn btn-outline-success btn-sm" name="options" id="outdoors-v11" autocomplete="off"> OUTDOORS
		</button>
		<!-- <button type="button" class="btn btn-outline-success" name="options" id="tambah" autocomplete="off"> TAMBAH
		</button>
		<button type="button" class="btn btn-outline-success" name="options" id="edit" autocomplete="off"> EDIT
		</button> -->
	</nav>
</div>

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

<div id="map">
</div>



<script type='module'></script>
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