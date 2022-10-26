<!-- <form method="post" enctype="multipart/form-data"> -->

<?php echo  form_open_multipart();
$obj = null;
if (isset($config['save'])) {
    $obj = $config['save'][0];
}

?>
<div class="form-row">

    <?php

    foreach ($fields as $key => $field) {


        $field['name'] = strtolower(trim($field['name']));


        $attributesArray = $field['attr'];
        $attributeString = '';
        foreach ($attributesArray as $name => $value) {

            if ($name == 'type' && $value == 'date') {
                $value = 'datepicker';
            }

            $attributeString .= " $name =\"$value\" ";
        }

        if (isset($obj->{$field['name']})) {
            $attributeString .= " value =\"" . $obj->{$field['name']} . "\" ";
            $field['value'] =  $obj->{$field['name']};
        }


        if (isset($obj->{$field['name'] . '_id'})) {
            $attributeString .= " value =\"" . $obj->{$field['name'] . '_id'} . "\" ";
            $field['value'] =  $obj->{$field['name'] . '_id'};
        }



        switch ($field['type']) {
            case  'text':
    ?>

                <div class="form-group <?php echo  isset($field['class']) ? $field['class'] : '' ?>">
                    <label for="<?php echo $field['name'] ?>"><?php echo lang($field['label']) ? lang($field['label']) :  $field['label'] ?></label>
                    <input class="form-control" name="form[<?php echo $field['name'] ?>]" id="<?php echo $field['name'] ?>" <?php echo $attributeString ?>>
                </div>
            <?php
                break;


            case  'section':
            ?>

                <h6 class="m-0 font-weight-bold text-primary <?php echo  isset($field['class']) ? $field['class'] : '' ?>"><?php echo lang($field['label']) ? lang($field['label']) :  $field['label'] ?></h6>

            <?php
                break;

            case  'lookup':
            ?>

                <div class="form-group <?php echo  isset($field['class']) ? $field['class'] : '' ?>">
                    <label for="<?php echo $field['name'] ?>"><?php echo lang($field['label']) ? lang($field['label']) :  $field['label'] ?></label>

                    <select class=" form-control" name="form[<?php echo $field['name'] ?>]" id="<?php echo $field['name'] ?>]" <?php echo $attributeString ?>>
                        <option value="">Search..</option>

                        <?php

                        if ($field['value']) {
                        ?>
                            <option selected="selected" value="<?php echo $field['value'] ?>"> <?php echo $obj->{$field['name']} ?></option>
                        <?php } ?>
                    </select>

                </div>
            <?php
                break;

            case  'checkbox':


                if (!empty($field['value'])) {
                    if ($field['value'] == 1) {
                        $attributeString .= ' checked="checked"';
                    }
                }


            ?>

                <div class="form-group form-check-inline <?php echo  isset($field['class']) ? $field['class'] : '' ?>">
                    <input class="form-check-input" type="checkbox" name="form[<?php echo $field['name'] ?>]" value="1" id="<?php echo $field['name'] ?>" <?php echo $attributeString ?>>
                    <label class="form-check-label" for="<?php echo $field['name'] ?>"><?php echo $field['label'] ?></label>
                </div>
            <?php
                break;
            case 'select':
            ?>

                <div class="form-group <?php echo  isset($field['class']) ? $field['class'] : '' ?>">
                    <label class="" for="<?php echo $field['name'] ?>"><?php echo $field['label'] ?></label>
                    <select class="form-control js-example-basic-single" name="form[<?php echo $field['name'] ?>]" id="<?php echo $field['name'] ?>" <?php echo $attributeString ?>>
                        <option>Default</option>
                        <?php if ($field['type']) {
                            foreach ($field['options'] as $option) {
                                $selected = '';
                                if (isset($field['value'])) {
                                    if ($field['value'] == $option['value']) {
                                        $selected = 'selected="selected"';
                                    }
                                }

                        ?>
                                <option <?php echo  $selected ?> value="<?php echo $option['value'] ?>"><?php echo $option['label'] ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>

            <?php
                break;
            case  'textarea':
            ?>

                <div class="form-group <?php echo  isset($field['class']) ? $field['class'] : '' ?>">
                    <label for="<?php echo $field['name'] ?>"><?php echo $field['label'] ?></label>
                    <textarea class="form-control" name="form[<?php echo $field['name'] ?>]" id="<?php echo $field['name'] ?>" <?php echo $attributeString ?>><?php echo isset($field['value']) ? $field['value']  : '' ?></textarea>
                </div>
    <?php
                break;
        }
    }
    ?>

</div>

<?php if (!$config['is_details']) { ?>
    <div class=" text-right">
        <a class="btn btn-danger" href="<?php echo base_url() . get_class(get_instance()) ?>">Cancel</a>
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
<?php } ?>

<?php echo form_close() ?>