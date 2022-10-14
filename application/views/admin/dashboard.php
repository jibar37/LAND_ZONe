<nav class="navbar navbar-dark sticky-top bg-white flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-secondary font-weight-bold" href="#">LAND ZONe</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="btn text-danger btn-outline-danger" href=<?php echo base_url("admin/signOut") ?>>Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href=<?php echo base_url("admin") ?>>
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="edit"></span>
                            Edit
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="users"></span>
                            Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="layers"></span>
                            Integrations
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Saved reports</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Current month
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Last quarter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Social engagement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Year-end sale
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-outline-secondary text-primary">Save</button>
                        <button class="btn btn-sm btn-outline-secondary text-danger">Cancel</button>
                    </div>
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