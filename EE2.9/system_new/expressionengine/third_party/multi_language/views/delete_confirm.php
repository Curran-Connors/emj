<?=form_open('C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'.AMP.'method=delete_phrase')?>
<input type="hidden" name="phrase_id" value="<?=$phrase_id?>" />

<p><strong><?=lang('phrase_delete_question')?></strong></p>

<p><?=$phrase_index?></p>

<p class="notice"><?=lang('action_can_not_be_undone')?></p>

<p><?=form_submit('submit', lang('delete'), 'class="submit"')?></p>

</form>