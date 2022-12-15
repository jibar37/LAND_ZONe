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
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
	<h5 class="my-0  font-weight-bold">LAND ZONe</h5>

	<nav class="my-2 my-md-0 mr-md-3">
		<a class="p-2 text-dark" href="#">About Us</a>
	</nav>

	<h5 class="nav-item dropdown my-0 mr-md-auto font-weight-normal">

		<form action=<?php echo (base_url('dashboard/signIn')); ?> method="post">
			<?php if ($username != "") : ?>
				<?php if ($status == "0") : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:inline-block">
						<p style="font-size: 15px;margin:0px">User ini telah dibekukan silahkan hubungi admin.</p>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-5px">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php else : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:inline-block">
						<p style="font-size: 15px;margin:0px">Username atau Password salah.</p>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-5px">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
			<?php endif ?>
			<div class="form-row">
				<div class="col">
					<input type="text" class="form-control" name="username" id="username" placeholder="Username" value=<?php echo ($username) ?>>
				</div>
				<div class="col">
					<input type="password" class="form-control" name="password" id="password" placeholder="Password">
				</div>
				<div class="col">
					<button type="submit" class="btn btn-primary">Sign in</button>
				</div>

			</div>


		</form>
	</h5>
	<nav class="my-2 my-md-0 mr-md-3">
		<button class="btn btn-outline-success btn-sm" name="options" id="streets-v11" autocomplete="off"> STREET
		</button>
		<button type="button" class="btn btn-outline-success btn-sm" name="options" id="satellite-v9" autocomplete="off"> SATELITE
		</button>
		<button type="button" class="btn btn-outline-success btn-sm" name="options" id="outdoors-v11" autocomplete="off"> OUTDOORS
		</button>
	</nav>
</div>

<div id="map" class="card" style="height:86%">
	<!-- <div> -->
</div>



<script type='module'></script>
<script type="text/javascript">
	function edit1() {
		edit();
	}
</script>