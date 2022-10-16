</div>
<div class="container-fluid ">
    <div class="list-group ">
        <?php foreach ($data as $key => $value) { ?>
            <?php if ($key != $this->session->userdata('username')) { ?>
                <?php if ($value['level'] != "2") { ?>
                    <div class="row">
                        <a class="col-sm-8 list-group-item list-group-item-action text-primary">
                            <span data-feather="user"></span>
                            <?php echo ($key); ?>
                        </a>
                        <a onclick="del('?username=<?php echo ($key); ?>')" class="btn btn-danger btn-lg active" style="height:100%;">
                            <span data-feather="trash-2"></span>
                            Delete
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>
</main>