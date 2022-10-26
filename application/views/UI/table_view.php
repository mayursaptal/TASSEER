<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <?php foreach ($fields as $field) {
                    if (isset($field['hideColumn']) && $field['hideColumn']) {
                        continue;
                    }
                ?>
                    <th><?php echo lang($field['label']) ? lang($field['label']) :  $field['label'] ?></th>
                <?php } ?>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <?php foreach ($fields as $field) {
                    if (isset($field['hideColumn']) && $field['hideColumn']) {
                        continue;
                    }
                ?>
                    <th><?php echo lang($field['label']) ? lang($field['label']) :  $field['label'] ?></th>
                <?php } ?>

                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
</div>