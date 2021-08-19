<?php

function smartcontentprotector_adminpage() {
    ?>
    <style type="text/css">
        #gif,#gif1,#gif2,#gif3
        {
            width:100%;
            height:100%;
            display:none;
            margin-left: 393px;
        }

        #result,#result1,#result2,#result3
        {
            display:none;
            border-color:#e8426d;
            background-color:#FFFFFF;
            color:#e8426d;
            border: solid;
            width:160px;
            text-align: center;
            margin-left: 389px;
        }

        #resets1
        {
            background-color:#2687b2;
            display:none;
            border-color:#FFFF00;
            border-width:thick;
            width:160px;
        }



    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('#submit_general').click(function($)
            {
                jQuery('#gif').css("display", "block");


            });
        });
        function submitgeneral() {
            jQuery.ajax({type: 'POST', url: 'options.php', data: jQuery('#form_general').serialize(), success: function(response) {


                    jQuery('#gif').css("display", "none");
                    jQuery('#result').css("display", "block");
                    jQuery('#result').html("Settings Saved");
                    jQuery('#result').fadeOut(2500, "linear");
                }});

            return false;
        }

    </script>
    <?php if (get_option('smart_content_protector_close_button') == '1') { ?>
        <style type="text/css">
            ul li#form {
                display:none;
            }
        </style>
    <?php } ?>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('#submit_popup').click(function($)
            {
                jQuery('#gif1').css("display", "block");
                //jQuery('#result1').animate({'opacity':'1'});

            });
            jQuery('#submit_popup_mac').click(function($)
            {
                jQuery('#gif3').css("display", "block");
                //jQuery('#result1').animate({'opacity':'1'});

            });
        });
        function submittextprotection() {
            jQuery.ajax({type: 'POST', url: 'options.php', data: jQuery('#form_popup').serialize(), success: function(response) {

                    //$('#fff').find('.form_result').html(response);
                    jQuery('#gif1').css("display", "none");
                    jQuery('#result1').css("display", "block");
                    jQuery('#result1').html("Settings Saved W.P.L.O.C.K.E.R...C.O.M.");
                    jQuery('#result1').fadeOut(2500, "linear");
                }});

            return false;
        }
        function submittextprotectionformac() {
            jQuery.ajax({type: 'POST', url: 'options.php', data: jQuery('#form_popup_mac').serialize(), success: function(response) {

                    jQuery('#gif3').css("display", "none");
                    jQuery('#result3').css("display", "block");
                    jQuery('#result3').html("Settings Saved");
                    jQuery('#result3').fadeOut(2500, "linear");
                }});

            return false;
        }

    </script>
    <script type="text/javascript">

        function show() {
            //document.getElementById('show').style.display = 'block';
            jQuery("tr.show").css("display", "table-row");
        }
        function hide() {
            //document.getElementById('show').style.display = 'none';
            jQuery("tr.show").css("display", "none");
        }
        function cateid_show() {
            //document.getElementByClass('page_id').style.display = 'table-row';
            jQuery("tr.cate_id").css("display", "table-row");
            jQuery("tr.page_id").css("display", "none");
        }
         
        function pageid_show() {
            //document.getElementByClass('page_id').style.display = 'table-row';
            jQuery("tr.page_id").css("display", "table-row");
           jQuery("tr.cusomname_id").css("display", "none");
        }
        
        
         function cutom_show() {
            //document.getElementByClass('page_id').style.display = 'table-row';
            jQuery("tr.cusomname_id").css("display", "table-row");
           jQuery("tr.page_id").css("display", "none");
        }
        
        
        
        function pageid_hide() {
            //document.getElementByClass('page_id').style.display = 'none';
            jQuery("tr.page_id").css("display", "none");
            jQuery("tr.cusomname_id").css("display", "none");
        }
        
        function page_role_id_hide() {
             jQuery("tr.page_role_id").css("display","none");

        }
          function page_role_id_show() {
             jQuery("tr.page_role_id").css("display","table-row");

        }

        function checkAll(formname, checktoggle)
        {
            var checkboxes = new Array();
            checkboxes = document.forms[formname].getElementsByTagName('input');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type === 'checkbox') {
                    checkboxes[i].checked = checktoggle;
                }
            }
        }
    </script>
    <script type="text/javascript">
        var checkDisplay = function(check, form) { //check ID, form ID
            form = document.getElementById(form), check = document.getElementById(check);
            check.onclick = function() {
                form.style.display = (this.checked) ? "none" : "block";

            };
            check.onclick();
        };
    </script>
    <?php if ((get_option('smart_content_protector_homepage') == '1') || (get_option('smart_content_protector_homepage') == '50') || (get_option('smart_content_protector_homepage') == '2') || (get_option('smart_content_protector_homepage') == '4') || (get_option('smart_content_protector_homepage') == '5')|| (get_option('smart_content_protector_homepage') == '6')) { ?>
        <style type="text/css">
            tr.page_id {
                display:none;
            }
               tr.cusomname_id {
                display:none;
            
             
            
            
        </style>
    <?php } if (get_option('smart_content_protector_homepage') == '3') { ?>
        <style type="text/css">
            tr.page_id {
                display:table-row;
            }
             tr.cusomname_id {
                display:none;
            }
            
            
        </style>
        <!-- Version 4.2 -->
    <?php }if (get_option('smart_content_protector_homepage') == '7') {   ?>
         <style type="text/css">
            tr.cusomname_id {
                display:table-row;
            }
            
             tr.page_id {
                display:none;
            }
        </style>
        
    <?php  } ?> 
   
        
        <?php if (get_option("smart_content_protector_member")=='1') { ?>
        <style type="text/css">
            tr.page_role_id {
                display:none;
            }
            </style>

        <?php } else {
            ?>
            <style type="text/css">
                tr.page_role_id {
                    display:table-row;
                }
                </style>

            <?php }  ?>
        


       
    <?php if (get_option('plagiarism_prevent_user_highlight') == '1') { ?>
        <style type="text/css">
            tr#context_Alert{display:table-row;}
        </style>
    <?php } else { ?>
        <style type="text/css">
            tr#context_Alert{display:none;}
        </style>
    <?php } ?>


    <?php if (get_option('smart_content_protector_selecting_text') == '15') { ?>
        <style type="text/css">
            tr#sc_text_message{display:table-row;}
        </style>
    <?php } else { ?>
        <style type="text/css">
            tr#sc_text_message{display: none;}
        </style>

    <?php } ?>
    <?php if (get_option('plagiarism_prevent_user_highlight') == '1') { ?>
        <style type="text/css">
            tr#smart_radio{display:block;}
        </style>
    <?php } else { ?>
        <style type="text/css">
            #smart_radio{display: none;}
        </style>

    <?php } ?>


    <script type="text/javascript">
        jQuery(document).ready(function($)
        {
            jQuery('#enable_alert').click(function()
            {
                if (this.checked)
                    jQuery('#alert_message').css("display", "table-row");
                else
                    jQuery('#alert_message').css("display", "none");
            });

            jQuery('#enable_alert_printscr').click(function() {
                if (this.checked)
                    jQuery('#alert_message_print_screen').css("display", 'table-row');
                else
                    jQuery('#alert_message_print_screen').css("display", 'none');
            });

            jQuery('.enable_empty_source').click(function() {
                if (this.checked)
                    jQuery('#empty_line_option').css('display', 'table-row');
                else
                    jQuery('#empty_line_option').css('display', 'none');
            });
            jQuery('.enable_empty_source').click(function() {
                if (this.checked)
                    jQuery('#empty_lines_view_source').css('display', 'table-row');
                else
                    jQuery('#empty_lines_view_source').css('display', 'none');
            });




            jQuery('#enable_js_disable_error').click(function() {
                if (this.checked)
                    jQuery('#enable_js_disable_error_msg').css("display", 'table-row');
                else
                    jQuery('#enable_js_disable_error_msg').css("display", 'none');
            });
             jQuery('#enable_js_disable_relaod').click(function() {
                if (this.checked)
                    jQuery('#enable_js_disable_error_reload').css("display", 'table-row');
                else
                    jQuery('#enable_js_disable_error_reload').css("display", 'none');
            });


            jQuery('#enable_append_link').click(function()
            {
                if (this.checked)
                    jQuery('#message_area').css("display", "table-row");
                else
                    jQuery('#message_area').css("display", "none");
            });
            /* Version 4.2  */
            jQuery('#smart_content_protector_selecting_text').click(function()
            {
                if (this.checked)
                    jQuery('#sc_text_message').css("display", "table-row");
                else
                    jQuery('#sc_text_message').css("display", "none");
            });

            jQuery('#smart_context_menu').click(function()
            {
                if (this.checked)
                    jQuery('#context_Alert').css("display", "table-row");
                else
                    jQuery('#context_Alert').css("display", "none");
            });
            jQuery('#smart_context_menu').click(function()
            {
                if (this.checked)
                    jQuery('#smart_radio').css("display", "block");
                else
                    jQuery('#smart_radio').css("display", "none");
            });
            jQuery('#smart_content_protect_ip').click(function()
            {
                if (this.checked)
                    jQuery('#scipcapture').css("display", "block");
                else
                    jQuery('#scipcapture').css("display", "none");
            });
        });



    </script>
    <?php if (get_option('smart_content_protector_alert') == '1') { ?>
        <style type="text/css">
            tr#alert_message {
                display:table-row;
            }
        </style>
    <?php } else { ?>
        <style type="text/css">
            tr#alert_message {
                display:none;
            }
        </style>
    <?php } ?>
    <?php if (get_option('smart_content_protector_ip') == '17') { ?>
        <style type="text/css">
            div#scipcapture {
                display:inline;
            }
        </style>
    <?php } else { ?>
        <style type="text/css">
            div#scipcapture {
                display:none;
            }
        </style>
    <?php } ?>

    <?php if (get_option('smart_content_enable_print_screen') == '1') {
        ?>
        <style type="text/css">
            tr#alert_message_print_screen {
                display:table-row;
            }
        </style>
    <?php } else {
        ?>
        <style type="text/css">
            tr#alert_message_print_screen {
                display:none;
            }
        </style>
        <?php
    }
    ?>
    <?php
    if (get_option('smart_content_enable_view_source') == '1') {
        ?>
        <style type="text/css">
            tr#empty_line_option

            {
                display:table-row;
            }
        </style>
        <?php
    } else {
        ?>
        <style type="text/css">
            tr#empty_line_option

            {
                display:none;
            }
        </style>
        <?php
    }
    ?>
    <?php
    if (get_option('smart_content_enable_view_source') == '1') {
        ?>
        <style type="text/css">
            tr#empty_lines_view_source

            {
                display:table-row;
            }
        </style>
        <?php
    } else {
        ?>
        <style type="text/css">
            tr#empty_lines_view_source

            {
                display:none;
            }
        </style>
        <?php
    }
    ?>




    <?php if (get_option('smart_content_enable_js_disable_error') == '1') {
        ?>
        <style type="text/css">
            tr#enable_js_disable_error_msg {
                display:table-row;
            }
        </style>
    <?php } else {
        ?>
        <style type="text/css">
            tr#enable_js_disable_error_msg {
                display:none;
            }
        </style>
        <?php
    }
    ?>
        
        
        <?php if (get_option('smart_content_enable_js_disable_reload') == 'reload') {
        ?>
        <style type="text/css">
            tr#enable_js_disable_error_reload {
                display:table-row;
            }
        </style>
    <?php } else {
        ?>
        <style type="text/css">
            tr#enable_js_disable_error_reload {
                display:none;
            }
        </style>
        <?php
    }
    ?>
        
        
    <?php if (get_option('smart_content_protector_textarea') == '1') {
        ?>
        <style type="text/css">
            tr#message_area {
                display:table-row;
            }
        </style>
    <?php } else { ?>
        <style type="text/css">
            tr#message_area {
                display:none;
            }
        </style>
    <?php } ?>



    <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <!--<link href = "<?php echo WP_CONTENT_URL; ?>/plugins/smartcontentprotector/css/adminstyle.css" type = "text/css" rel = "stylesheet"/>-->
    <div class = "wrap">
        <?php
        $bpageheader = true;
        if ($bpageheader == true) {
            ?>
            <div class="ic"></div>            
        <?php } ?>
        <div class="left">

            <div class="metabox-holder4">
                <div class="postbox4">
                    <h3>General Settings</h3>
                    <div class="inside4">
                        <form id="form_general" onsubmit="return submitgeneral();" >
                            <?php settings_fields('smart_content_protector_general_settings'); ?>
                            <?php
                            $option = get_option('smart_content_protector_disable');
                            $member = get_option('smart_content_protector_member');
                            $non_member = get_option('smart_content_protector_non_member');
                            $display = get_option('smart_content_protector_homepage');
                            $enablealert = get_option('smart_content_protector_alert');
                            $getarrayofuserdata = get_userdata(get_current_user_id());
                            ?>
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th>
                                            <label>Disable this Plugin</label> 
                                        </th>
                                        <td>
                                            <input type="checkbox" class="checkbox_general" name="smart_content_protector_disable" value="1"<?php checked('1', $option); ?>/>
                                        </td>   
                                    </tr>

                                    <tr>
                                        <th>
                                            <label>Protect Content From</label>
                                        </th>
                                        <td>
                                           <input class="cbu" type="radio"    name="smart_content_protector_member" onclick="page_role_id_hide();"  value="1"<?php checked('1', $member); ?>/><label>&nbsp;All Members</label><br/>
                                        
                                           <input class="cbu" type="radio"    name="smart_content_protector_member" onclick="page_role_id_show();"  value="3"<?php checked('3', $member); ?>/><label>&nbsp;Select Members by User Roles</label><br/>
                               
                                           <input class="cbu" type="checkbox" name="smart_content_protector_non_member" value="2"<?php checked('2', $non_member); ?>/><label>&nbsp;Guest</label><br/>
                                        </td>                           
                                    </tr>
                                           <tr class="page_role_id">
                                    <th><label>User Roles</label></th>
                                    <td>
                                       <?php
                                           global $wp_roles;
                                        //var_dump($wp_roles->role_names);
                                        foreach($wp_roles->role_names as $key => $value)
                                      {  
                                      ?>
                            <input class="cbu" type="checkbox" name="smart_content_protector_<?php echo $key; ?>" value="<?php echo $key;?>"<?php checked($key, get_option("smart_content_protector_$key")); ?>/><label>&nbsp;<?php echo $value;?></label><br/>
                               
                            <?php
                                }
                                           ?>
                               </td>
                                </tr>
                                    <tr>
                                        <th>
                                            <label>Content Protect For</label>
                                        </th>
                                        <td>
                                            <input type="radio" name="smart_content_protector_homepage" onclick="pageid_hide();" value="2"<?php checked('2', $display); ?>/><label>&nbsp;All Pages/Posts (Including Home Page)</label><br/>
                                            <input type="radio" name="smart_content_protector_homepage" onclick="pageid_hide();" value="50"<?php checked("50", $display); ?>/><label>&nbsp;All Pages/Posts (Excluding Home Page)</label><br/>
                                            <input type="radio" name="smart_content_protector_homepage" onclick="pageid_hide();" value="1"<?php checked('1', $display); ?>/><label>&nbsp;Homepage</label><br/>
                                            <input type='radio' name='smart_content_protector_homepage' onclick='pageid_hide();' value='4'<?php checked('4', $display); ?>/><label>&nbsp;All Pages</label><br/>
                                            <input type="radio" name="smart_content_protector_homepage" onclick='pageid_hide();' value='5'<?php checked('5', $display); ?>/><label>&nbsp;All Posts</label><br/>
                                            <input type="radio" name="smart_content_protector_homepage" onclick="pageid_show();" value="3"<?php checked('3', $display); ?>/><label>&nbsp;Custom Pages/Posts</label><br/>
<!--                                            //version 5.1 categories-->
                                             <input type="radio" name="smart_content_protector_homepage" onclick='pageid_hide();' value='6'<?php checked('6', $display); ?>/><label>&nbsp;All Categories</label><br/>
                                            <input type="radio" name="smart_content_protector_homepage" onclick='cutom_show();' value='7'<?php checked('7', $display); ?>/><label>&nbsp;Custom Categories</label><br/>
                                        </td>
                                    </tr>

                                     <tr class="cusomname_id">
                                        <th>
                                            <label>Category  ID or Name Seperated by commas</label>
                                        </th>
                                        <td>
                                             <textarea rows="3" cols="25" name="smart_content_protector_cutompa_id"><?php echo get_option('smart_content_protector_cutompa_id'); ?></textarea><input type="radio" name="smart_content_protector_page_include_cutom_exclude" value="1"<?php checked('1', get_option('smart_content_protector_page_include_cutom_exclude')); ?>/><label>Include</label>&nbsp;<input type="radio" name="smart_content_protector_page_include_cutom_exclude" value="2"<?php checked('2', get_option('smart_content_protector_page_include_cutom_exclude')); ?>/><label>Exclude</label><br/><br/>
                                        
                                            </td>
                                    </tr>
                                    
                                    
                                    <tr class="page_id">
                                        <th>
                                            <label>Page ID or Name Seperated by commas</label>
                                        </th>
                                        <td>
                                             <textarea rows="3" cols="25" name="smart_content_protector_page_id" ><?php echo get_option('smart_content_protector_page_id'); ?></textarea><input type="radio" name="smart_content_protector_page_include_exclude" value="1"<?php checked('1', get_option('smart_content_protector_page_include_exclude')); ?>/><label>Include</label>&nbsp;<input type="radio" name="smart_content_protector_page_include_exclude" value="2"<?php checked('2', get_option('smart_content_protector_page_include_exclude')); ?>/><label>Exclude</label><br/><br/>
                                        
                                            </td>
                                    </tr>
                                    <tr class="page_id">
                                        <th><label>Post ID or Name Seperated by commas</label>
                                        <td>
                                            <textarea rows="3" cols="25" name="smart_content_protector_post_id"><?php echo get_option('smart_content_protector_post_id'); ?></textarea><input type="radio" name="smart_content_protector_post_include_exclude" value="1"<?php checked('1', get_option('smart_content_protector_post_include_exclude')); ?>/><label>Include</label>&nbsp;<input type="radio" name="smart_content_protector_post_include_exclude" value="2"<?php checked('2', get_option('smart_content_protector_post_include_exclude')); ?>/><label>Exclude</label><br/><br/>
                                      </td>
                                    </tr>        

                                    <tr>
                                        <th>
                                            <label>Enable Right Click for Internal Hyperlink</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" name="smart_content_enable_right_click_link1" value="51"<?php checked('51', get_option('smart_content_enable_right_click_link1')); ?>/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            <label>Enable Right Click for External Hyperlink</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" name="smart_content_enable_right_click_link2" value="52"<?php checked('52', get_option('smart_content_enable_right_click_link2')); ?>/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>   
                                            <label>Enable Text Highlight (Text Selection)</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" name='plagiarism_prevent_user_highlight'id="smart_context_menu" value='1'<?php checked('1', get_option('plagiarism_prevent_user_highlight')); ?>/>
                                        </td>                            
                                    </tr>
                                    <!--                                <div id="smart_radio">
                                                                        <input type="radio" name="smart_content_protector_radio" style="margin-left:393px;" onclick="pageid_hide();" value="18"<?php checked('18', $display); ?>/><label>&nbsp;Do Nothing</label><br/>
                                                                        <input type="radio" name="smart_content_protector_radio" id="smart_content_protector_selecting_text" style="margin-left:393px;" onclick="pageid_hide();" value="19"<?php checked('19', $display); ?>/><label>&nbsp;Alert message</label><br/>
                                                                        <input type='radio' name="smart_content_protector_radio" style='margin-left:393px;' onclick='pageid_hide();' value='20'<?php checked('20', $display); ?>/><label>&nbsp;Record Ip address</label><br/>
                                                                         </div>-->
                                    <!--                                 version 4.2 -->

                                    <tr id="context_Alert">
                                        <th>
                                            <label for="text"> Enable Alert Message on CTRL+C / Mouse Copy </label>
                                        </th>
                                        <td>
                                            <input type="checkbox" name="smart_content_protector_selecting_text" id="smart_content_protector_selecting_text" value="15"<?php checked('15', get_option('smart_content_protector_selecting_text')); ?>>
                                        </td>
                                    </tr>

                                    <tr id ="sc_text_message">  
                                        <th>
                                            <label>Enter Alert Message</label>
                                        </th>
                                        <td>
                                            <input type="text" class="text_general" name="smart_content_protector_selecting_text_msg" value="<?php echo get_option('smart_content_protector_selecting_text_msg'); ?>"/>
                                        </td>                              
                                    </tr>

                                    <tr>
                                        <th>
                                            <label for="cbalert">Enable Alert Message on Mouse Right Click</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" id="enable_alert" name="smart_content_protector_alert" value="1"<?php checked('1', $enablealert); ?>/>
                                        </td>   
                                    </tr>     


                                    <tr id="alert_message">
                                        <th>
                                            <label>Enter Alert Message</label>
                                        </th>
                                        <td>
                                            <input type="text" class="text_general" name="smart_content_protector_alert_message" value="<?php echo get_option('smart_content_protector_alert_message'); ?>"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            <label for="cbprintscr">Enable Alert Message on Print Screen</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" id="enable_alert_printscr" name="smart_content_enable_print_screen" value="1"<?php checked('1', get_option('smart_content_enable_print_screen')); ?>/><label>(Print Screen, Alt + Print Screen and Ctrl + Print Screen)</label>
                                        </td>
                                    </tr>



                                    <tr id="alert_message_print_screen">
                                        <th>
                                            <label for="cbprintscrmsg">Enter Alert Message for Print Screen</label>
                                        </th>
                                        <td>
                                            <input type="text" class="text-general" name="smart_content_print_screen_message" value="<?php echo get_option('smart_content_print_screen_message'); ?>"/>
                                        </td>                              
                                    </tr>

                                    <tr>
                                        <th>
                                            <label for ="cbviewsource">Enable Empty Lines to View Source</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" class="enable_empty_source" name="smart_content_enable_view_source" value="1"<?php checked('1', get_option('smart_content_enable_view_source')); ?>/>
                                        </td>                               
                                    </tr>

                                    <tr id="empty_line_option">
                                        <th>

                                        </th>
                                        <td>
                                            <input type="radio" class="enablewphead" name="smart_content_protector_viewoption" value="53" <?php checked('53', get_option('smart_content_protector_viewoption')); ?>/><label>&nbsp;Insert Empty Lines after the Header</label><br/>
                                            <input type="radio" class="enablewphead" name="smart_content_protector_viewoption" value="54" <?php checked('54', get_option('smart_content_protector_viewoption')); ?>/><label>&nbsp;Insert Empty Lines at the beginning </label><br/>
                                        </td>
                                    </tr>


                                    <tr id="empty_lines_view_source">
                                        <th>
                                            <label>Number of Empty Lines to View Source</label>
                                        </th>
                                        <td>
                                            <input type="text" class="text_general" name="smart_content_protector_add_empty_lines" value="<?php echo get_option('smart_content_protector_add_empty_lines'); ?>"/>
                                        </td>                                
                                    </tr>

                                    <tr>
                                        <th>
                                            <label>Enable Append Message on Copied Text</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" id="enable_append_link" name="smart_content_protector_textarea" value="1"<?php checked('1', get_option('smart_content_protector_textarea')); ?>/>
                                        </td>                                
                                    </tr>


                                    <tr id="message_area">
                                        <th>
                                            <label>Enter Message</label>
                                        </th>
                                        <td>
                                            <textarea name="smart_content_protector_textarea_message" rows="9" cols="41"><?php echo get_option('smart_content_protector_textarea_message'); ?></textarea>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>
                                            <label>Display Message if Client Browser's JavaScript is Disabled</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" id="enable_js_disable_error" name="smart_content_enable_js_disable_error" value="1"<?php checked('1', get_option('smart_content_enable_js_disable_error')); ?>/>
                                        </td>
                                    </tr>

                                    <tr id='enable_js_disable_error_msg'>
                                        <th>
                                            <label>Message to show when Client Browser's JavaScript is Disabled</label>
                                        </th>
                                        <td>
                                            <input type="text" class="text-general" name="smart_content_js_disable_error_msg" value="<?php echo get_option('smart_content_js_disable_error_msg'); ?>"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th>
                                            <label>Redirect  if Client Browser's JavaScript is Disabled</label>
                                        </th>
                                        <td>
                                            <input type="checkbox" id="enable_js_disable_relaod" name="smart_content_enable_js_disable_reload" value="reload"<?php checked('reload', get_option('smart_content_enable_js_disable_reload')); ?>/>
                                        </td>
                                    </tr>
                                     <tr id='enable_js_disable_error_reload'>
                                        <th>
                                            <label>Redirection URL</label>
                                        </th>
                                        <td>
                                            <input type="text" class="text-general" name="smart_content_js_disable_error_reload" value="<?php echo get_option('smart_content_js_disable_error_reload'); ?>"/>
                                        </td>
                                    </tr>
                                    <!--version 4.3 Rss Feed Check Box Start-->
                                    <tr>
                                        <th>
                                            <label>Disable RSS Feed </label>
                                        </th>
                                        <td>
                                            <input type="checkbox" id="smart_content protect_rss" name="smart_content_protector_rssfeed" value="16"<?php checked('16', get_option('smart_content_protector_rssfeed')); ?> />
                                        </td>    
                                    </tr>
                                    <!--Ip Capture Check Box-->
                                    <tr>
                                        <th>
                                            <label>Log IPs that Copied Content </label>
                                        </th>
                                        <td>
                                            <input type="checkbox" id="smart_content_protect_ip" name="smart_content_protector_ip" value="17"<?php checked('17', get_option('smart_content_protector_ip')); ?> />
                                        </td>
                                    </tr>
                                </tbody>

                            </table>


                            <div id="gif"><img src="<?php echo WP_PLUGIN_URL; ?>/contentprotector/images/bar.gif"/></div>
                            <div id="result"></div>
                            <table>
                                <tr >
                                    <td colspan="52">
                                        <p class="submit">
                                            <input type="submit" value="Save" id="submit_general" name="submit" class="button-primary"/>
                                        <style type="text/css">

                                            #submit_general
                                            {
                                                float:right;
                                                margin-left: 268px;
                                                margin-right: 300px;

                                            }
                                            #reset_general
                                            {
                                                margin-top: -31px;
                                                margin-left: 200px;
                                                margin-right: 100px;
                                            }
                                            #submit_popup
                                            {
                                                margin-left: 270px;
                                                margin-right: 150px;
                                            }
                                            #button_align
                                            {
                                                margin-top: -52px;
                                                margin-left: 199px;

                                            }
                                            #submit_popup_mac
                                            {
                                                margin-left: 270px;
                                            }
                                            #align_button
                                            {
                                                margin-top: -52px;
                                                margin-left: 199px;
                                            }
                                            #submit_image_protection
                                            {
                                                margin-left: 270px;
                                            }
                                            #image_align
                                            {
                                                margin-top: -53px;
                                                margin-left: 199px;
                                            }
                                        </style>
                                        </p></td>
                                </tr>
                            </table>
                        </form>
                        <form id="form_general_reset" action="" class="form-1" method="post">
                            <input type="submit" value="Reset"id="reset_general" name="reset_general" class="button-secondary"/>
                            <input name="action" type="hidden" value="reset" />

                        </form><br/>
                        <br/>

                    </div>
                </div>
            </div>

            <div class="metabox-holder4">

                <div class="postbox4">
                    <h3>Text Protection Settings For Windows, Linux etc</h3>
                    <div class="inside4">
                        <form id="form_popup" onsubmit="return submittextprotection();" name="myform">
                            <?php settings_fields('smart_content_protector_text_protection_settings'); ?>
                            <?php
                            $slct = get_option('smart_content_protector_a');
                            $copy = get_option('smart_content_protector_c');
                            $cut = get_option('smart_content_protector_x');
                            $paste = get_option('smart_content_protector_v');
                            $save = get_option('smart_content_protector_s');
                            $source = get_option('smart_content_protector_u');
                            ?>
                            <table class="form-table">
                                <tbody>

                                    <tr id="show">
                                        <th>    
                                            <label class="cba"><a href="javascript:void(0);" onclick="javascript:checkAll('myform', true);">Check All</a> | <a href="javascript:void(0);" onclick="javascript:checkAll('myform', false);">UnCheck All</a></label></li>
                                        </th> 
                                    </tr>
                                <br/>
                                <tr>
                                    <th>
                                        <label for="cba">Select All</label>
                                    </th>                            
                                    <td>                                
                                        <input class="cba" type="checkbox" name="smart_content_protector_a" value="1"<?php checked('1', $slct); ?>/>                                                     
                                        <label>&nbsp;Disable CTRL+A</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbc">Copy</label>
                                    </th>
                                    <td>
                                        <input class="cbc" type="checkbox" name="smart_content_protector_c" value="2"<?php checked('2', $copy); ?>/>
                                        <label>&nbsp;Disable CTRL+C</label>
                                    </td>
                                </tr>    
                                <tr>
                                    <th>
                                        <label for="cbx">Cut</label>
                                    </th>
                                    <td>
                                        <input class="cbx" type="checkbox" name="smart_content_protector_x" value="3"<?php checked('3', $cut); ?>/>
                                        <label>&nbsp;Disable CTRL+X</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbv">Paste</label>
                                    </th>
                                    <td>
                                        <input class="cbv" type="checkbox" name="smart_content_protector_v" value="4"<?php checked('4', $paste); ?>/>
                                        <label>&nbsp;Disable CTRL+V</label>
                                    </td>
                                </tr>   
                                <tr>
                                    <th>
                                        <label for="cbs">Save</label>
                                    </th>
                                    <td>
                                        <input class="cbs" type="checkbox" name="smart_content_protector_s" value="5"<?php checked('5', $save); ?>/>
                                        <label>&nbsp;Disable CTRL+S</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbu">View Source</label>
                                    </th>
                                    <td>
                                        <input class="cbu" type="checkbox" name="smart_content_protector_u" value="6"<?php checked('6', $source); ?>/>
                                        <label>&nbsp;Disable CTRL+U</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbp">Print Page</label>
                                    </th>
                                    <td>
                                        <input class="cbp" type="checkbox" name="smart_content_protector_p" value="7"<?php checked('7', get_option("smart_content_protector_p")); ?> />
                                        <label>&nbsp;Disable CTRL+P</label>
                                    </td>
                                </tr>
                                
                               
                                <tr>
                                    <th>
                                        <label for="cbp">Developer Tool</label>
                                    </th>
                                    <td>
                                        <input class="cbp" type="checkbox" name="smart_content_protector_i" value="8"<?php checked('8', get_option("smart_content_protector_i")); ?> />
                                        <label>&nbsp;Disable CTRL+SHIFT+I</label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>                                                 


                            <div id="gif1"><img src="<?php echo WP_PLUGIN_URL; ?>/contentprotector/images/bar.gif"/></div>
                            <div id="result1"></div>
                            <p class="submit">
                                <input type="submit" value="Save" id="submit_popup" name="submit" class="button-primary"/>
                            </p>

                        </form>
                        <form action="" method="post" class="form-1">
                            <input type="submit"value="Reset" id="button_align" name="reset_text_protection" class="button-secondary"/>
                            <input name="action" type="hidden" value="reset" />

                        </form><br/>
                        <br/>

                    </div>
                </div>
            </div>
            <div class="metabox-holder4">

                <div class="postbox4">
                    <h3>Text Protection Settings For Mac OS X</h3>
                    <div class="inside4">
                        <form id="form_popup_mac" onsubmit="return submittextprotectionformac();" name="myformmac">
                            <?php settings_fields('smart_content_protector_text_protection_settings_for_mac'); ?>
                            <?php
                            $slct = get_option('smart_content_protector_mac_a');
                            $copy = get_option('smart_content_protector_mac_c');
                            $cut = get_option('smart_content_protector_mac_x');
                            $paste = get_option('smart_content_protector_mac_v');
                            $save = get_option('smart_content_protector_mac_s');
                            $source = get_option('smart_content_protector_mac_u');
                            ?>
                            <table class="form-table">
                                <tbody>
                                    <tr id="show">
                                        <th>
                                            <label class="cba"><a href="javascript:void(0);" onclick="javascript:checkAll('myformmac', true);">Check All</a> | <a href="javascript:void(0);" onclick="javascript:checkAll('myformmac', false);">UnCheck All</a></label></li>
                                        </th>
                                <br/>
                                </tr>  
                                <tr>
                                    <th>
                                        <label for="cba">Select All</label>
                                    </th>
                                    <td>
                                        <input class="cba" type="checkbox" name="smart_content_protector_mac_a" value="1"<?php checked('1', $slct); ?>/>
                                        <label>&nbsp;Disable CMD+A</label>
                                    </td>
                                </tr>    
                                <tr>
                                    <th>
                                        <label for="cbc">Copy</label>
                                    </th>
                                    <td>
                                        <input class="cbc" type="checkbox" name="smart_content_protector_mac_c" value="2"<?php checked('2', $copy); ?>/>
                                        <label>&nbsp;Disable CMD+C</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbx">Cut</label>
                                    </th>
                                    <td>
                                        <input class="cbx" type="checkbox" name="smart_content_protector_mac_x" value="3"<?php checked('3', $cut); ?>/>
                                        <label>&nbsp;Disable CMD+X</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbv">Paste</label>
                                    </th>
                                    <td>
                                        <input class="cbv" type="checkbox" name="smart_content_protector_mac_v" value="4"<?php checked('4', $paste); ?>/>
                                        <label>&nbsp;Disable CMD+V</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbs">Save</label>
                                    </th>
                                    <td>
                                        <input class="cbs" type="checkbox" name="smart_content_protector_mac_s" value="5"<?php checked('5', $save); ?>/>
                                        <label>&nbsp;Disable CMD+S</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbu">View Source</label>
                                    </th>
                                    <td>
                                        <input class="cbu" type="checkbox" name="smart_content_protector_mac_u" value="6"<?php checked('6', $source); ?>/>
                                        <label>&nbsp;Disable CMD+U</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="cbp">Print Page</label>
                                    </th>
                                    <td>
                                        <input class="cbp" type="checkbox" name="smart_content_protector_mac_p" value="7"<?php checked('7', get_option("smart_content_protector_mac_p")); ?> />
                                        <label>&nbsp;Disable CMD+P</label>
                                    </td>
                                </tr>
<!--                                <tr>
                                    <th>
                                        <label for="cbp"> Screenshot a Portion of Your Screen</label>
                                    </th>
                                    <td>
                                        <input class="cbp" type="checkbox" name="smart_content_protector_mac_cmdshift4" value="7"<?php checked('7', get_option("smart_content_protector_mac_cmdshift4")); ?> />
                                        <label>&nbsp;Disable Cmd+Shift+4</label>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>
                                        <label for="cbp">Take a Shot of Your Entire Screen</label>
                                    </th>
                                    <td>
                                        <input class="cbp" type="checkbox" name="smart_content_protector_mac_cmdshift3" value="7"<?php checked('7', get_option("smart_content_protector_mac_cmdshift3")); ?> />
                                        <label>&nbsp;Disable Cmd+Shift+3</label>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>
                                        <label for="cbp">Save a Screenshot to the Clipboard</label>
                                    </th>
                                    <td>
                                        <input class="cbp" type="checkbox" name="smart_content_protector_mac_cmdctrlshift3" value="7"<?php checked('7', get_option("smart_content_protector_mac_cmdctrlshift3")); ?> />
                                        <label>&nbsp;Disable Cmd+Ctrl+Shift+3</label>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <th>
                                        <label for="cbp">Screenshot of an Open Window</label>
                                    </th>
                                    <td>
                                        <input class="cbp" type="checkbox" name="smart_content_protector_mac_cmdshift4spacebar" value="7"<?php checked('7', get_option("smart_content_protector_mac_cmdshift4spacebar")); ?> />
                                        <label>&nbsp;Disable Cmd+Shift+4+Spacebar</label>
                                    </td>
                                </tr>-->
                                
                                <tr>
                                    <th>
                                        <label for="cbp">Developer Tool</label>
                                    </th>
                                    <td>
                                        <input class="cbp" type="checkbox" name="smart_content_protector_mac_i" value="8"<?php checked('8', get_option("smart_content_protector_mac_i")); ?> />
                                        <label>&nbsp;Disable CMD+OPTION+I</label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>



                            <div id="gif3"><img src="<?php echo WP_PLUGIN_URL; ?>/contentprotector/images/bar.gif"/></div>
                            <div id="result3"></div>
                            <p class="submit">
                                <input type="submit" value="Save" id="submit_popup_mac" name="submit" class="button-primary"/>
                            </p>

                        </form>
                        <form action="" method="post" class="form-1">
                            <input type="submit" id="align_button" value="Reset" name="reset_text_protection" class="button-secondary"/>
                            <input name="action" type="hidden" value="reset" />

                        </form><br/>
                        <br/>

                    </div>
                </div>
            </div>
            <?php
            include 'image_protection.php';
            ?>
        </div>
    </div>
    <?php
    $bpageside1 = true;
    if ($bpageside1 == false) {
        ?>
        <div class="metabox-holder_lp">
            <div class="postbox_lp" >
                <h3 class="ad">You Like This Plugin?</h3>
                <div class="inside_lp">
                    <p><strong>We are not taking donations. Try becoming a <a href="http://fantasticplugins.com/" target="_blank">Fantastic Plugins Member</a>. Afterall each Fantastic WordPress Plugin will cost less than a $1 for Members.</strong></p>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php
    $bpageside2 = true;
    if ($bpageside2 == false) {
        ?>
        <div class="metabox-holder_latest">
            <div class="postbox_latest"  >
                <h3 class="ad">Latest News</h3>
                <div class="inside_latest">
                    <?php
                    $new = file_get_contents("http://fantasticplugins.com/blog/feed");
                    $x = new SimpleXmlElement($new);
                    echo "<ul>";
                    $i = 0;
                    foreach ($x->channel->item as $entry) {
                        if ($i == 5)
                            break;
                        echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";
                        $i++;
                    }

                    echo "</ul>";
                    ?>
                </div>

            </div>

        </div>

        <?php
    }
    ?>
    <!-- Capture Ip Address 4.3 version  table create jquery -->
    <div id="scipcapture">            
        <div class="metabox-holder4">

            <div class="postbox4">
                <h3>IPs that Copied Content</h3>
                <div class="inside4">
                    <form method="POST"><input type="submit" name="sccsv" style="margin-left: -7px;" value="EXPORT CSV"/></form>
                    <b>SEARCH:</b> <input id="filter" type="text"/>
                    <table border="1" class="table_footable1" data-filter="#filter" data-page-size="5">
                        <thead>

                            <tr>
                                <th data-toggle="true">IP Address</th>
                                <!--<th data-toggle="true">Number of Times Copied</th>-->
                                <th data-hide="tablet,phone">Date & Time</th>
                                <th data-hide="tablet,phone">Username</th>
                                <th data-hide="tablet,phone">Which Page / Post</th>
                                <th data-sort-ignore="true" data-name="Delete">Clear Row</th>
                            </tr>
                        </thead>




                        <script type="text/javascript">


                            jQuery(function() {
                                jQuery('.table_footable1').footable();
                            });
                            jQuery(function() {
                                jQuery('.table_footable1').footable().on('click', '.table_footable1', function(e) {
                                    e.preventDefault();
                                    //get the footable object
                                    var footable = jQuery('.table_footable1').data('footable');
                                    //alert(jQuery(this).attr('data-id')); 

                                    var dataid = jQuery(this).attr('data-id');

                                    var data = {
                                        'action': 'scdeletelog',
                                        'dataid': dataid,
                                    };
                                    // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                                    jQuery.post('<?php echo admin_url('admin-ajax.php') ?>', data, function(response) {
                                        //alert('Got this from the server: ' + response);
                                    });



                                    //get the row we are wanting to delete
                                    var row = jQuery(this).parents('tr:first');

                                    //delete the row
                                    footable.removeRow(row);
                                });
                            });
                            //                    
                            //                    jQuery(document).ready(function(){
                            //                        
                            //                    });

                        </script>                
                        <?php
                        global $wpdb;
                        $ipresult = $wpdb->get_results("SELECT * FROM wp_smartiplog");

                        // $ipresult = $wpdb->get_results( "SELECT id, name FROM wp_smartiplog" );
                        foreach ($ipresult as $result) {
//             echo '<p>';
//             var_dump($result);
//             echo '</p>';
                            ?>


                            <tr>
                                <td><?php echo $result->ipaddress; ?></td>

                                <td><?php echo $result->time; ?></td>
                                <td><?php echo $result->username; ?></td>
                                <td><?php echo $result->whichpage; ?></td>
                                <td><a data-id="<?php echo $result->id; ?>"class="table_footable1" href="#" style="margin-left:55px;"><b>x</b></a></td>
                            </tr>
                            <?php
                        }
                        ?>              
                        <tfoot class="hide-if-no-paging">
                            <tr>
                                <td colspan="7">
                                    <div class="pagination pagination-centered"></div>
                                </td>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </div>
    </div>
<?php }
?>