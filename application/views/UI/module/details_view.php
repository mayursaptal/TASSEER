<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> <?php echo  singular(get_class($CI)) ?> #<?php echo $id ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row ">
                <!-- <div class="col-md-8">
                    <h6 class="m-0 font-weight-bold text-primary">Add <?php echo singular(get_class($CI)) ?></h6>
                </div> -->
                <div class="col-md-12 text-right">
                    <a class="btn btn-danger" href="<?php echo base_url() . get_class(get_instance()) ?>">Back</a>
                </div>
            </div>

        </div>
        <div class="card-body">

            <?php echo $form_html ?>
        </div>
    </div>
</div>

<!-- /.container-fluid -->