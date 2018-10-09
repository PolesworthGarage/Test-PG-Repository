<h2 class="nav-tab-wrapper">
    <a class="nav-tab" href="edit.php?post_type=contact&page=cont_option&tab=cont_option">Global options</a>
    <a class="nav-tab nav-tab-active" href="edit.php?post_type=contact&page=cont_option&tab=mess_option">Message Options</a>
    <a class="nav-tab " href="edit.php?post_type=contact&page=cont_option&tab=custom_css">Custom CSS</a>
</h2>
<table>
    <tbody>
<!--        <tr>-->
<!--            <td width="100%" style="font-size:14px; font-weight:bold">-->
<!--                This section allows you to configure the Message Options.-->
<!--            </td>-->
<!--        </tr>-->
        <tr>
            <td>
                <h2> Team WD - Message Options</h2>
            </td>
        </tr>
    </tbody>
</table>
<form action="options.php" method="post" id="adminForm" name="adminForm" class="form-table">
    <?php settings_fields('mess_option'); ?>
    <?php do_settings_sections('mess_option'); ?>
    <table style="min-width:500px" class="paramlist" cellspacing="1">
        <tr>
            <?php
            $check = "";
                if (esc_attr(get_option('enable_message')) == 1){
                    $check = ' checked="checked" ';
                }
            ?>
            <th scope="row"><?php echo " Send Message";?></th>
            <td class="paramlist_value">
                <input type="radio" name="enable_message" id="enable_message0" value="0"  <?php
               if($check==""):?>
                       checked="checked"
                <?php endif;?>/>
                <label for="enable_message0"><?php echo 'Off';?></label>
                <input type="radio" name="enable_message" id="enable_message1" value="1" <?php
                echo $check;
                ?>   />
                <label for="enable_message1"><?php echo 'On';?></label>
            </td>
            </td>
        </tr>
        <tr>
            <?php
            $check = "";
                if (esc_attr(get_option('show_email')) == 1){
                    $check = ' checked="checked" ';
                }
            ?>
            <th scope="row"><?php echo " 'Email' Field";?></th>
            <td class="paramlist_value">
                <input type="radio" name="show_email" id="show_email0" value="0"  <?php
                if($check==""):?>
                       checked="checked"
                <?php endif;?> />
                <label for="show_email0"><?php echo 'Off';?></label>
                <input type="radio" name="show_email" id="show_email1" value="1" <?php
                echo $check;
                ?>   />
                <label for="show_email1"><?php echo 'On';?></label>
            </td>
            </td>
        </tr>
        <tr>
            <?php
            $check = "";
                if (esc_attr(get_option('show_name')) == 1){
                    $check = ' checked="checked" ';
                }
            ?>
            <th scope="row"><?php echo " 'Name' Field";?></th>
            <td class="paramlist_value">
                <input type="radio" name="show_name" id="show_name0" value="0"  <?php
                if($check==""):?>
                       checked="checked"
                <?php endif;?> />
                <label for="show_name0"><?php echo 'Off';?></label>
                <input type="radio" name="show_name" id="show_name1" value="1" <?php
                echo $check;
                ?>   />
                <label for="show_name1"><?php echo 'On';?></label>
            </td>
            </td>
        </tr>
        <tr>
            <?php
            $check = "";
                if (esc_attr(get_option('show_phone')) == 1){
                    $check = ' checked="checked" ';
                }
            ?>
            <th scope="row"><?php echo " 'Phone' Field";?></th>
            <td class="paramlist_value">
                <input type="radio" name="show_phone" id="show_phone0" value="0"  <?php
                if($check==""):?>
                       checked="checked"
                <?php endif;?> />
                <label for="show_phone0"><?php echo 'Off';?></label>
                <input type="radio" name="show_phone" id="show_phone1" value="1" <?php
                echo $check;
                ?>   />
                <label for="show_phone1"><?php echo 'On';?></label>
            </td>
            </td>
        </tr>
        <tr>
            <?php
            $check = "";
                if (esc_attr(get_option('show_cont_pref')) == 1){
                    $check = ' checked="checked" ';
                }
            ?>
            <th scope="row"><?php echo " 'Contact Preferences' Field";?></th>
            <td class="paramlist_value">
                <input type="radio" name="show_cont_pref" id="show_cont_pref0" value="0"  <?php
                if($check==""):?>
                       checked="checked"
                <?php endif;?> />
                <label for="show_cont_pref0"><?php echo 'Off';?></label>
                <input type="radio" name="show_cont_pref" id="show_cont_pref1" value="1" <?php
                       echo $check;
                       ?>   />
                <label for="show_cont_pref1"><?php echo 'On';?></label>
            </td>
            </td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>