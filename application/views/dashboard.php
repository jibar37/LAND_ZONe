<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>LAND ZONe</title>

    <style>
		html, body, #container /*, and all other map parent selectors*/ {
		height: 100%;
		overflow: hidden;
		width: 100%;
		}
		#map {
		width: auto;
		height: 100%;
		}
		#refreshButton {
		position: absolute;
		top: 20px;
		right: 20px;
		padding: 10px;
		z-index: 400;
		}
    </style>

</head>
<body>
    
    <div id="map"></div>
	<div id="refreshButton" data-toggle="buttons">
		<label class="btn btn-secondary active">
			<input type="radio" name="options" id="option1" autocomplete="off" checked> Active
		</label>
		<label class="btn btn-secondary">
			<input type="radio" name="options" id="option2" autocomplete="off"> Radio
		</label>
		<label class="btn btn-secondary">
			<input type="radio" name="options" id="option3" autocomplete="off"> Radio
		</label>
	</div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script type ='module' src='assets/Main.js'></script>
</body>
</html>