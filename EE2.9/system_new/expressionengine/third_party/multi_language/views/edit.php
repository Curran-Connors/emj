<?=form_open('C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'.AMP.'method=update')?>
<input type="hidden" name="phrase_id" value="<?=$phrase_id?>" />
<input type="hidden" name="cur_phrase_index" value="<?=$phrase_index?>" />

<?php
$custom_table_template = $cp_table_template;

$this->table->set_template($custom_table_template);
$this->table->set_heading(lang('language'), lang('value'));

foreach ($fields as $key => $val)
{
	if ($key != 'phrase_id')
	{
		if (!$phrase_id)
		{
			$key = $val;
			$val = '';		
		}
		
		if ($key == 'phrase_index')
		{
			$field_title = '<strong class="notice">*</strong> '.lang($key);		
			$input_field = form_input(array('name' => $key, 'value' => $val));
			$input_field .= '<br/>Required field. No spaces. Underscores and dashes allowed.';
		}		
		
		else
		{
			$field_title = lang($key);		
			$input_field = form_textarea(array('name' => $key, 'value' => $val));
		}
		
		$this->table->add_row($field_title, $input_field);
	}
}

echo $this->table->generate();
?>

<?=form_submit('submit', lang('submit'), 'class="submit"')?>

</form>