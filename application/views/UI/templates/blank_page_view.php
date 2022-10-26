<?php
$CI = &get_instance();
include(VIEWPATH . 'UI/header_view.php');
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">


        <?php

        echo $content;

        ?>

    </div>
    <!-- End of Main Content -->

<?php
    include(VIEWPATH . 'UI/footer_view.php');
