<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Category</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="m-0 font-weight-bold text-primary">Category</h6>
                </div>
                <div class="col-md-4 text-right">
                    <a href="<?php echo base_url() ?>PicklistCategory/add">
                        <button class="btn btn-primary">Add</button>
                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <?php 
            include(VIEWPATH.'/UI/table_view.php')
            ?>
        </div>
    </div>

</div>


<!-- /.container-fluid -->