<h2 class="nav-tab-wrapper">
    <a class="nav-tab nav-tab-active" href="edit.php?post_type=contact&page=cont_option&tab=cont_option">Global options</a>
    <a class="nav-tab " href="edit.php?post_type=contact&page=cont_option&tab=mess_option">Message Options</a>
    <a class="nav-tab " href="edit.php?post_type=contact&page=cont_option&tab=custom_css">Custom CSS</a>
</h2>
<table>

<!--    <tr>-->
<!--        <td width="100%" style="font-size:14px; font-weight:bold"><a href="https://web-dorado.com/wordpress-team-wd/installing.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a><br />-->
<!--            This section allows you to configure the global options. <a href="https://web-dorado.com/wordpress-team-wd/installing.html" target="_blank" style="color:blue; text-decoration:none;">More...</a></td>-->
<!--    </tr>-->
    <tr>
        <td>
            <h2> Team WD - Global Options</h2>
        </td>
    </tr>
</table>
<form action="options.php" method="post" name="adminForm" id="adminForm" class="form-table">
    <?php settings_fields('cont_option'); ?>
    <?php do_settings_sections('cont_option'); ?>
    <table style="min-width:500px">
        <tbody>
            <tr>
                <?php
                $check = "";
                if (esc_attr(get_option('choose_category')) == 1){
                    $check = ' checked="checked" ';
                }
                ?>
                <th scope="row"><?php echo 'Search Contact on frontend by category';?>:</th>
                <td class="paramlist_value">
                    <input type="radio" name="choose_category" id="paramsenable_review0" value="0"  <?php
                if($check==""):?>
                       checked="checked"
                <?php endif;?> />
                    <label for="paramsenable_review0"><?php echo 'Off';?></label>
                    <input type="radio" name="choose_category" id="paramsenable_review1" value="1" <?php
                echo $check;
                ?>   />
                    <label for="paramsenable_review1"><?php echo 'On';?></label>
                </td>
            </tr>
            <tr>
                <?php
                $check = ' checked="checked" ';
                if (esc_attr(get_option('name_search')) != 1){
                    $check = '';
                }
                ?>
                <th scope="row"><?php echo 'Search Contact ';?>:</th>
                <td class="paramlist_value">
                    <input type="radio" name="name_search" id="paramsname_search0" value="0"  <?php
                 if($check==""):?>
                       checked="checked"
                <?php endif;?> />
                    <label for="paramsname_search0"><?php echo 'Off';?></label>
                    <input type="radio" name="name_search" id="paramsname_search1" value="1" <?php
                echo $check;
                ?>   />
                    <label for="paramsname_search1"><?php echo 'On';?></label>
                </td>
            </tr>
            <tr>
                <?php
                $check = ' checked="checked" ';
                if (esc_attr(get_option('lightbox')) != 1){
                    $check = '';
                }
                ?>
                <th scope="row"><?php echo 'Image View in Lightbox ';?>:</th>
                <td class="paramlist_value">
                    <input type="radio" name="lightbox" id="paramsname_search3" value="0"  <?php
                 if($check==""):?>
                       checked="checked"
                <?php endif;?> />
                    <label for="paramsname_search3"><?php echo 'Off';?></label>
                    <input type="radio" name="lightbox" id="paramsname_search4" value="1" <?php
                echo $check;
                ?>   />
                    <label for="paramsname_search4"><?php echo 'On';?></label>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo 'Slug ';?>:</th>
                <td>
                    <input type="text" name="team_slug" value="<?php echo get_option('team_slug');?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?php
        $delete_demo_data = get_option('delete_demo_data');
        if($delete_demo_data && isset($delete_demo_data)){
            echo'
                 <div class="d_demo_data">
                    <input type="button" name="delete_demo_data" class="delete_demo_data button button-default" value="Delete demo data">
                    <img style="display: none;" class="demo_loader" src="'. SC_URL.'/images/loader.gif">
                 </div>
                    ';
        }
    ?>

    <?php submit_button(); ?>
</form>