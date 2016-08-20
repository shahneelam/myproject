<?php include_once 'setting.php';
extract(get_option('smartcat_team_options')); ?>
<div class="width70 left">
    <p>To display the Team, copy and paste this shortcode into the page or widget where you want to show it. 
        <input type="text" readonly="readonly" value="[our-team]" style="width: 130px" onfocus="this.select()"/>
    <div>You can set the <strong>template</strong>, <strong>single_template</strong> and group in the <strong>shortcode</strong></div>
</p>
<p><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FSmartcatDesign&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=233286813420319" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe></p>

<form name="sc_our_team_post_form" method="post" action="" enctype="multipart/form-data">
    <table class="widefat">
        <thead>
            <tr>
                <th colspan="2"><b>Team View Settings</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Template</td>
                <td>
                    <select name="smartcat_team_options[template]" id="sc_our_team_template">
                        <option>Select Template</option>
                        <option value="grid" <?php echo 'grid' == esc_attr($template) ? 'selected=selected' : ''; ?>>Grid - Boxes</option>
                        <option value="grid_circles" <?php echo 'grid_circles' == esc_attr($template) ? 'selected=selected' : ''; ?>>Grid - Circles</option>
                        <option value="grid_circles2" <?php echo 'grid_circles2' == esc_attr($template) ? 'selected=selected' : ''; ?>>Grid - Circles Version 2</option>
                        <option disabled="disabled">List - Stacked ( pro version )</option>
                        <option disabled="disabled">Honey Comb ( pro version )</option>
                        <option disabled="disabled">Carousel ( pro version )</option>
                        <option disabled="disabled">Staff Directory ( pro version )</option>
                    </select>
                </td>
            </tr>

            <tr id="columns-row">
                <td>Grid Columns</td>
                <td>
                    <select name="smartcat_team_options[columns]">
                        <option value="2" <?php echo '2' == esc_attr($columns) ? 'selected=selected' : ''; ?>>2</option>
                        <option value="3" <?php echo '3' == esc_attr($columns) ? 'selected=selected' : ''; ?>>3</option>
                        <option value="4" <?php echo '4' == esc_attr($columns) ? 'selected=selected' : ''; ?>>4</option>
                        <option value="5" <?php echo '5' == esc_attr($columns) ? 'selected=selected' : ''; ?>>5</option>
                        <option value="10" <?php echo '10' == esc_attr($columns) ? 'selected=selected' : ''; ?>>10</option>
                    </select>
                </td>
            </tr>                


            <tr id="margin-row">
                <td>Margin</td>
                <td>
                    <select name="smartcat_team_options[margin]">
                        <option value="0" <?php echo '0' == esc_attr($margin) ? 'selected=selected' : ''; ?>>No margin</option>
                        <option value="5" <?php echo '5' == esc_attr($margin) ? 'selected=selected' : ''; ?>>5</option>
                        <option value="10" <?php echo '10' == esc_attr($margin) ? 'selected=selected' : ''; ?>>10</option>
                        <option value="15" <?php echo '15' == esc_attr($margin) ? 'selected=selected' : ''; ?>>15</option>
                    </select>px
                </td>
            </tr>                

            <tr id="social_icons_row">
                <td><?php _e('Display Social Icons') ?></td>
                <td>
                    <select name="smartcat_team_options[social]">
                        <option value="yes" <?php echo 'yes' == esc_attr($social) ? 'selected=selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo 'no' == esc_attr($social) ? 'selected=selected' : ''; ?>>No</option>
                    </select>
                </td>
            </tr>

            <tr id="social_links_row">
                <td><?php _e('Social Icon Links') ?></td>
                <td>
                    <select name="smartcat_team_options[social_link]">
                        <option value="" <?php echo '' == esc_attr($social_link) ? 'selected=selected' : ''; ?>>Same Page</option>
                        <option value="new" <?php echo 'new' == esc_attr($social_link) ? 'selected=selected' : ''; ?>>New Page</option>
                    </select>
                </td>
            </tr>



            <tr id="">
                <td>Display Name</td>
                <td>
                    <select name="smartcat_team_options[name]">
                        <option value="yes" <?php echo 'yes' == esc_attr($name) ? 'selected=selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo 'no' == esc_attr($name) ? 'selected=selected' : ''; ?>>No</option>
                    </select>
                </td>
            </tr>



            <tr id="">
                <td>Display Title</td>
                <td>
                    <select name="smartcat_team_options[title]">
                        <option value="yes" <?php echo 'yes' == esc_attr($title) ? 'selected=selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo 'no' == esc_attr($title) ? 'selected=selected' : ''; ?>>No</option>
                    </select>
                </td>
            </tr>   

            <tr>
                <td>Single Member URL Slug</td>
                <td>
                    <input type="text" name="smartcat_team_options[slug]" value="<?php echo esc_attr($slug); ?>" />
                    <p>
                        <em>Set the slug for the single team member page. <b><?php echo home_url() . '/' . $slug . '/member-name'; ?></b></em><br>
                        <em>If your update doesn't work, go to Settings - Permalinks & hit Save</em>
                    </p>
                </td>
            </tr>



            <tr>
                <td>Number of members to display</td>
                <td>
                    <input type="text" value="<?php echo esc_attr($member_count); ?>" name="smartcat_team_options[member_count]" placeholder="number of members to show"/><br>
                    <em>Set to -1 to display all members</em>
                </td>
            </tr>

            <tr>
                <td>Main Color</td>
                <td>
                    <input class="wp_popup_color width25" type="text" value="<?php echo esc_attr($text_color); ?>" name="smartcat_team_options[text_color]"/>
                </td>
            </tr>

            <tr>
                <td>Max Word Count</td>
                <td>
                    <em class="pro">pro version</em>
                </td>
            </tr>                


            <tr id="">
                <td>Name Font Size</td>
                <td>
                    <em class="pro">pro version</em>
                </td>
            </tr>                

            <tr id="">
                <td>Title Font Size</td>
                <td>
                    <em class="pro">pro version</em>
                </td>
            </tr>

            <tr id="social_links_style_row">
                <td><?php _e('Icons Style') ?></td>
                <td>
                    <em class="pro">pro version</em>
                </td>
            </tr>                   

        </tbody>
    </table>

    <table class="widefat">
        <thead>
            <tr>
                <th colspan="2"><b>Single Member View Settings</b></th>
            </tr>
            <tr>
                <td>Template</td>
                <td>
                    <select name="smartcat_team_options[single_template]">
                        <option>Select Template</option>
                        <option value="standard" <?php echo 'standard' == esc_attr($single_template) ? 'selected=selected' : ''; ?>>Theme Default (single post)</option>
                        <option value="disable" <?php echo 'disable' == esc_attr($single_template) ? 'selected=selected' : ''; ?>>Disabled</option>                            
                        <option disabled="disabled" value="custom" <?php echo 'custom' == esc_attr($single_template) ? 'selected=selected' : ''; ?>>Custom Template - ( Pro Version )</option>
                        <option disabled="disabled">Card (pop-up) - ( pro version )</option>
                        <option disabled="disabled">Side Panel - ( pro version )</option>
                    </select>
                </td>
            </tr>

            <tr id="">
                <td>Display Social Icons</td>
                <td>
                    <select name="smartcat_team_options[single_social]">
                        <option value="no" <?php echo 'no' == esc_attr($single_social) ? 'selected=selected' : ''; ?>>No</option>
                        <option value="yes" <?php echo 'yes' == esc_attr($single_social) ? 'selected=selected' : ''; ?>>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Card Popup Margin From Top</td>
                <td>
                    <em>pro version</em>
                </td>
            </tr>



            <tr id="">
                <td>Display Skills Bar</td>
                <td>
                    <em>pro version</em>
                </td>
            </tr>

            <tr>
                <td>Skills Title</td>
                <td>
                    <em>pro version</em>
                </td>
            </tr>



            <tr>
                <td>Image Style</td>
                <td>
                    <em>pro version</em>
                </td>
            </tr>

        </thead>
    </table>


    <div style="text-align: right">
        <input type="hidden" name="smartcat_team_options[redirect]" value=""/>
        <input type="submit" name="sc_our_team_save" value="Update" class="button button-primary button-hero" />

    </div>        
    <br>



</form>
</div>

<div class="clear"></div>

<div class="demo-table">
    <h3>Preview</h3>
    
    <div class="left width50">
        
        <h3>Carousel</h3>
        <img src="<?php echo SC_TEAM_URL ?>screenshot-6.jpg" >
        
        <h3>Honeycomb Demo</h3>
        <img src="<?php echo SC_TEAM_URL ?>screenshot-4.jpg" >

        <h3>Stacked List Demo</h3>
        <img src="<?php echo SC_TEAM_URL ?>screenshot-5.jpg" >  
        
        <h3>Grid Boxes &amp; Grid Circles Demo</h3>
        <img src="<?php echo SC_TEAM_URL ?>inc/img/circles2_demo.jpg" >
        <img src="<?php echo SC_TEAM_URL ?>inc/img/grid_demo.jpg" >
        
        
    </div>
    
    <div class="left width50">
        
        <h3>Popup Card Demo</h3>
        <img src="<?php echo SC_TEAM_URL ?>inc/img/card_demo.jpg" >

        <img src="<?php echo SC_TEAM_URL ?>inc/img/circles_demo.jpg">

        <h3>Staff Directory</h3>
        <img src="<?php echo SC_TEAM_URL ?>inc/img/directory.jpg"/>

        <h3>Custom Template</h3>
        <img src="<?php echo SC_TEAM_URL ?>inc/img/custom_demo.jpg"/>

        <h3>Sliding Side Panel</h3>
        <img src="<?php echo SC_TEAM_URL ?>inc/img/panel_demo.jpg" />         
    </div>
    





   
    
</div>




</div>
<script>
    function confirm_reset() {
        if (confirm("Are you sure you want to reset to defaults ?")) {
            return true;
        } else {
            return false;
        }
    }
    jQuery(document).ready(function ($) {
        $("#sc_popup_shortcode").focusout(function () {
            var shortcode = jQuery(this).val();
            shortcode = shortcode.replace(/"/g, "").replace(/'/g, "");
            jQuery(this).val(shortcode);
        });

    });

</script>