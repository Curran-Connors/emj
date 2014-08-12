<div id="add_language" style="display: none;">
<?=form_open('C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'.AMP.'method=add_language')?>
New Language Code: <input type="text" name="language_code" style="width: 50%;" /> 
(en, es, it, <a href="http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes" target="_blank">more ISO 639-1 codes</a>)
<?=form_submit('submit', lang('submit'), 'class="submit"')?>
<br/><br/>
</form>
</div>

<?php 
$this->table->set_template($cp_table_template);
$this->table->set_heading($field_headings);

foreach ($phrases as $phrase) 
{
	$row = array();
	
	foreach ($fields as $field)
	{
		if ($field == 'phrase_index')
		{
			$row[] = '<a href="'.BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'.AMP.'method=edit'.AMP.'phrase_id='.$phrase->phrase_id.'">'.$phrase->phrase_index.'</a>';
		}
		
		else
		{			
			$row[] = lang($phrase->$field);
		}
	}
	
	$row[] = '<a href="'.BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'.AMP.'method=delete_confirm'.AMP.'phrase_id='.$phrase->phrase_id.'">'.lang('delete').'</a>';
	
	$this->table->add_row($row);
}

echo $this->table->generate();

?>


<script type="text/javascript">
$("#mainContent .rightNav .button:first a").click(function() 
{	
	$("#add_language").toggle();
});
</script>