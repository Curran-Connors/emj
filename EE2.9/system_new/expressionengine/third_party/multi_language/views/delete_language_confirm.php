<?=form_open('C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'.AMP.'method=delete_language')?>
<input type="hidden" name="field" value="<?=$field?>" />

<p><strong><?=lang('language_remove_question')?></strong></p>

<p><?=$field?></p>

<p class="notice"><?=lang('action_can_not_be_undone')?></p>

<p><?=form_submit('submit', lang('delete'), 'class="submit"')?></p>

</form>