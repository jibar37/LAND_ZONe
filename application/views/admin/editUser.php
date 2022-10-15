</div>
<div class="container-fluid ">
    <div class="list-group ">
        <?php foreach ($data as $key => $value) { ?>
            <a href="?username=<?php echo ($key); ?>" class="list-group-item list-group-item-action text-primary">
                <span data-feather="user"></span>
                <?php echo ($key); ?>
            </a>
        <?php } ?>
    </div>
</div>
</main>
</div>
</div>