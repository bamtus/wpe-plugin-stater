<div class="bb-field-row bb-field-tab">
    <ul class="bb-field-tab-ul">
        <?php
        foreach ($field['value'] as $key => $value) {
            ?>
                <li class="bb-field-tab-li">
                <input  id="<?php echo esc_attr($field['param_name'].'_'.$key) ?>" type="radio" class="bb-tab-parent" name="<?php echo esc_attr($field['param_name']) ?>"  value="<?php echo esc_attr($key);?>" <?php if($key==$field['std']): echo esc_html('checked'); endif;?>>
                <label for="<?php echo esc_attr($field['param_name'].'_'.$key) ?>">
                    <?php echo esc_html($value);?>
                </label>
                </li>
            <?php
        }
        ?>
    </ul>
</div>