<nav class="my-2 my-md-0 mr-md-3">
    <button class="btn btn-outline-success btn-sm" name="options" id="streets-v11" autocomplete="off"> STREET
    </button>
    <button type="button" class="btn btn-outline-success btn-sm" name="options" id="satellite-v9" autocomplete="off"> SATELITE
    </button>
    <button type="button" class="btn btn-outline-success btn-sm" name="options" id="outdoors-v11" autocomplete="off"> OUTDOORS
    </button>

</nav>




</div>
<?php if ($this->session->userdata('level') == "3") { ?>
    <div id="map" class="card" style="height:130%">
        <!-- <div> -->
    </div>
<?php } else { ?>
    <div id="map" class="card" style="height:85%">
        <!-- <div> -->
    </div>
<?php } ?>
</main>
</div>
</div>