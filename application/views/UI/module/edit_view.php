<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit <?php echo singular(get_class($CI)) ?> #<?php echo $id ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-1">
                    <span><i class="fas fa-angle-left"></i></span>
                </div>
                <div class="col-md-10 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit <?php echo singular(get_class($CI)) ?> #<?php echo $id ?></h6>
                </div>

                <div class="col-md-1 text-right">
                    <span><i class="fas fa-angle-right"></i></span>
                </div>
            </div>

        </div>
        <div class="card-body">

            <?php echo $form_html ?>
        </div>
    </div>
</div>

<!-- /.container-fluid -->