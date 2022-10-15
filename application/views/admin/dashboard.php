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
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-secondary text-primary">Save</button>
        <button class="btn btn-sm btn-outline-secondary text-danger">Cancel</button>
    </div>

    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
    </button>
</div>
</div>
<!-- <div id="changeMap" data-toggle="buttons">
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
            </div> -->
<div id="map">

    <div class="card" style="height: 100vh;">
    </div>
</div>
</main>
</div>
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
    // document.getElementById("tambah").onclick = function() {
    //     //mapStyle('outdoors-v11');
    //     tambah();
    // };
    document.getElementById("edit").onclick = function() {
        //mapStyle('outdoors-v11');
        edit();
    };
</script>