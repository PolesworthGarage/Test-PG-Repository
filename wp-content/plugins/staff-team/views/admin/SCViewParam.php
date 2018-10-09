<?php
    $edit = FALSE;
    if(isset($data))
        $edit =  TRUE;
    $data[] = '';
?>
<style>
<?php if($edit):?>
.param_table .parameter{
    width:80% !important;
}
<?php endif;?>
div.del{
    background: url('<?php echo SC_URL."/images/param_del.png";?>');
    background-size: contain;
}
div.param_plus{
    background: url('<?php echo SC_URL."/images/param_plus.png";?>');
    background-size: contain;
}
</style>
<table class="param_table form-table">
    <tr>
        <?php if(!$edit): ?>
			<td><?php echo 'Parameters';?></td>
        <?php else:?>
			<th scope="row"><?php echo 'Parameters';?></th>
        <?php endif;?>
        <td class="parameters_td">
            <?php
            foreach ($data as $key => $item):?>
				<input type="text" class="parameter" name="param[]" value="<?php echo $item;?>"/>
				<div class="del"></div> <br>
            <?php endforeach; ?>
        </td>
    </tr>
    <tr>
        <td> </td>
        <td class="td_param_plus">
            <div class="param_plus"></div>
        </td>
    </tr>
</table>
