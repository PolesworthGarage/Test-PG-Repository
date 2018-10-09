jQuery(".param_table").on('click', '.del', function () {
    if (jQuery(this).prevAll('input.parameter').first().val() != "" && jQuery('.param_table .parameters_td').find('input').length > 1) {
        jQuery(this).prevAll('input.parameter').first().remove();
        jQuery(this).prev('div.param_plus').remove();
        jQuery(this).next('br').remove();
        jQuery(this).remove();
    }
});
jQuery(".contTable").on('click', '.del', function () {
    if (jQuery(this).prevAll('input.parameter').first().val() != "" && jQuery(this).closest('td').find('input').length > 1) {
        jQuery(this).prevAll('input.parameter').first().remove();
        jQuery(this).prev('div.param_plus').remove();
        jQuery(this).remove();
    }
});
jQuery(document).on('click', '.param_table .param_plus', function () {
    jQuery('.param_table .parameters_td').find('input[value=""]').attr('value', jQuery('.param_table .parameters_td input').last().val());
    if (jQuery('.param_table .parameters_td').find('input[value=""]').length < 1) {
        jQuery('.param_table .parameters_td').append('<input type="text" class="parameter" name="' + jQuery('.param_table .parameters_td input').last().attr('name') + '" value=""/><div class="del"></div><br>');
    }
});
jQuery(document).on('click', '.contTable .param_plus', function () {
    var param_td = jQuery(this).closest('tr').prev('tr').find('.td_params');
    if (param_td.find('input[value=""]').length < 1) {
        param_td.append('<input type="text" class="parameter" name="' + param_td.find('input').last().attr('name') + '" value=""/><div class="del"></div>');
    }
});
jQuery(document).on('change', '.parameter', function () {
    jQuery(this).attr('value', jQuery(this).val());
});
jQuery(document).on('keydown', 'form input.parameter', function (event) {
    if (event.keyCode == 13) {
        event.preventDefault();
        jQuery(this).change();
        return false;
    }
});
if(jQuery('.td_params').length<=0){
    is_checked = jQuery('input[name="tax_input[cont_category][]"]').is(':checked');
    if(is_checked){
        get_parameter('.selectit input[name="tax_input[cont_category][]"]');
    }
}

jQuery('input[name="tax_input[cont_category][]"]').on('change', function () {
    get_parameter(this);
});
function get_parameter(element){
    console.log(jQuery(element));
    var ischecked = jQuery(element).is(':checked');
    if (ischecked) {
        var cats = [];
        var forCat = jQuery(element).val();
        console.log(forCat);
        jQuery('input[name="tax_input[cont_category][]"]:checked').each(function () {
            if (forCat == jQuery(this).val())
                return;
            cats.push(jQuery(this).val());
        });
        var data = {
            action: 'get_cat_param',
            cats: cats,
            forCat: forCat
        };

        jQuery.post(staff_ajaxurl, data, function (response) {
            jQuery('table.contTable').append(response);
        });
    } else {
        var cats = [];
        var forCat = jQuery(element).val();
        jQuery('input[name="tax_input[cont_category][]"]:checked').each(function () {
            if (forCat == jQuery(this).val())
                return;
            cats.push(jQuery(this).val());
        });
        var data = {
            action: 'get_cat_param',
            cats: cats,
            forCat: jQuery(element).val(),
            unCheck: true
        };

        jQuery.post(staff_ajaxurl, data, function (response) {
            var res = JSON.parse(response);
            for (var key in res) {
                if (res.hasOwnProperty(key)) {
                    var tr = jQuery('table.contTable td:contains("' + res[key] + '")').parent('tr');
                    tr.next('tr').remove();
                    tr.remove();
                }
            }
        });
    }
}

jQuery('#cont_tabs').tabs();
if (typeof (localStorage.currentItem) !== "undefined") {
    var current_item = localStorage.currentItem;
    jQuery("#cont_tabs > div").css("display", "none");
    jQuery(current_item).css("display", "block");
    jQuery("#cont_tabs #cont_theme_ul li").removeClass("ui-state-active");
    jQuery('#cont_tabs #cont_theme_ul li a[href="' + current_item + '"]').parent('li').addClass("ui-state-active");
} else {
    jQuery('#general').css("display", "block");
    jQuery('#cont_tabs #cont_theme_ul li:first-child').addClass("ui-state-active");
}

jQuery("#cont_theme_ul li a").each(function (indx, element) {
    jQuery(element).click(function () {
        if (typeof (Storage) !== "undefined") {
            localStorage.currentItem = jQuery(element).attr("href");
        }
        jQuery("#cont_tabs > div").css("display", "none");
        jQuery(localStorage.currentItem).css("display", "block");
        jQuery('#cont_tabs #cont_theme_ul li').removeClass("ui-state-active");
        jQuery(element).parent().addClass("ui-state-active");
    });
});

jQuery('.deleteMess').on('click', function () {
    if (confirm("Are you sure you want to delete ?")) {
        var data = {
            action: 'del_mess',
            id: jQuery(this).attr('mess-id'),
        };
        jQuery.post(staff_ajaxurl, data, function (response) {
            if (response = 'true') {
                location.reload();
            } else {
                jQuery(this).click();
            }

        });
    } else {
    }

});

jQuery('body').on('click', '.cont_theme_activate', function () {
    var data = {
        action: 'activate_theme',
        id: jQuery(this).attr('theme-id'),
    };
    jQuery.post(staff_ajaxurl, data, function (id) {
        jQuery('.cont_theme_enable').replaceWith('<a href="#" class="cont_theme_activate" theme-id="' + jQuery('.cont_theme_enable').attr('theme-id') + '">Activate</a>');
        jQuery('.cont_theme_activate[theme-id="' + id + '"]').replaceWith("<p class ='cont_theme_enable' theme-id='" + id + "' style='color:green;'>Active</p>");
    });
    return false;
});

jQuery("#messageDialog").dialog({
    autoOpen: false,
    resizable: false,
    position: {my: "top", at: "top", of: document},
    minWidth: 600
});
jQuery('.viewMess').on('click', function (e) {
    e.preventDefault();
    var data = {
        action: 'view_mess',
        id: jQuery(this).attr('mess-id'),
    };
    jQuery.post(staff_ajaxurl, data, function (response) {
        jQuery("#messageDialog").html(response);
    });
    jQuery("#messageDialog").dialog('open');
});
jQuery('input.sc_color').colorpicker({
    displayIndicator: false,
    displayPointer: false,
    transparentColor: true
});
jQuery('input.sc_color').on('change.color', function (event, color) {
    jQuery(this).css('background-color', color);
});
jQuery('.sc_color').each(function () {
    jQuery(this).css("background-color", jQuery(this).val());
});
jQuery("#mess_date_from_filter, #mess_date_to_filter").datetimepicker({
    timepicker: false,
    format: 'Y-m-d',
    scrollInput: false,
    closeOnDateSelect: true
});

/*---- GO_TO_TOP ----*/
jQuery( window ).scroll(function() {
    var height = jQuery(window).scrollTop();
    if(height > 400){
        jQuery('#go_to_top').css('display', 'inline');
    }
    else {
        jQuery('#go_to_top').css('display', 'none');
    }
});
jQuery('#go_to_top').click(function(){
    jQuery("html, body").animate({ scrollTop: 0 }, 1000);
    return false;
});

/*---- Upload "No Image" ----*/
jQuery(document).ready(function() {
    var uploadID = '';

    jQuery('.sc_upload-button').click(function() {
        uploadID = jQuery(this).prev('input');
        formfield = jQuery('.upload').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });
    if ((jQuery('.sc_upload-button').length > 0)){
        window.send_to_editor = function(html) {
            imgurl = jQuery('img',html).attr('src');
            if(typeof imgurl =='undefined'){ imgurl = jQuery(html).attr('src');}
            console.log(uploadID);
            uploadID.val(imgurl);
            tb_remove();
        };
    }


    if(jQuery('.delete_demo_data').length > 0){
        var delete_demo_data = jQuery('.delete_demo_data');
        delete_demo_data.click(function(){
            jQuery('.demo_loader').css({'display':'inline-block'});
            var data = {
                action: 'delete_demo_data',
                delete: true,
            };
            jQuery.post(staff_ajaxurl, data, function (response) {
                jQuery('.d_demo_data').html('<h3>Demo data has been deleted</h3>')
            });


        });
    }

    //custom url

    var custom_url = jQuery("#custom_url");
    var default_url = jQuery("#default_url");
    var team_url_tr = jQuery("#team_url_tr");
    var team_url_checked = default_url.attr( "checked" );
    if(team_url_checked==="checked"){
        team_url_tr.css({
            'display':'table-row'
        });
    }
    default_url.change(function () {
        team_url_tr.css({
            'display':'table-row'
        });
    });
    custom_url.change(function () {
        team_url_tr.css({
            'display':'none'
        });
    });

});



