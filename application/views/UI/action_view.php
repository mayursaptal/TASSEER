<?php
$CI = get_instance();
?>
<div class="dropdown ">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="<?php echo base_url() . get_class($CI) ?>/details/<?php echo $uuid ?>">Details</a>
        <a class="dropdown-item" href="<?php echo base_url() . get_class($CI) ?>/edit/<?php echo $uuid ?>">Edit</a>
        <a class="dropdown-item" href="<?php echo base_url() . get_class($CI) ?>/delete/<?php echo $uuid ?>">Delete</a>
    </div>
</div>