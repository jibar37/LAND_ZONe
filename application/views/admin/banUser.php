</div>
<div class="container-fluid ">
    <div class="list-group ">
        <?php foreach ($data as $key => $value) { ?>
            <?php if ($key != $this->session->userdata('username')) { ?>
                <?php if ($value['status'] != "0") { ?>
                    <?php if ($value['level'] != "2") { ?>
                        <div class="row">
                            <a class="col-sm-8 list-group-item list-group-item-action text-primary">
                                <span data-feather="user"></span>
                                <?php echo ($key); ?>
                            </a>
                            <a onclick="ban('?username=<?php echo ($key); ?>')" class="btn btn-danger btn-lg active" style="height:100%;">
                                <span data-feather="user-x"></span>
                                BAN
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>
</main>