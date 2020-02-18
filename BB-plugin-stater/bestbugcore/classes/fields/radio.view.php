<div <?php if(isset($field['tab'])&&!empty($field['tab'])): echo esc_html('tab=tab tab-element='.$field['tab']['element'].' tab-value='.implode(',', $field['tab']['value']));  endif;?> class="bb-field-row" data-dependency="<?php echo ($dependency!='')?'true':'false' ?>" data-element="<?php if($dependency!='') echo esc_attr($field['dependency']['element']) ?>" data-value="<?php  if($dependency!='') echo esc_attr(implode(',', $field['dependency']['value'])) ?>">
    <div class="bb-label">
        <label>
            <?php if(!empty($field['heading'])) esc_html_e($field['heading']) ?>
        </label>
    </div>
    <div class="bb-field">
        <?php foreach ($field['value'] as $value => $text) { ?>
            <label class="bb-radio">
                <input  type="radio" name="<?php echo esc_attr($field['param_name']) ?>" value="<?php echo esc_attr($value) ?>" <?php if($value == $field['std']) echo 'checked'; ?>>
                <?php echo esc_html($text) ?>
            </label>
        <?php } ?>
    </div>
    <div class="bb-desc">
        <?php if(!empty($field['description'])) echo bb_esc_html($field['description']) ?>
    </div>
</div>