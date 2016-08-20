<?php include_once 'setting.php'; ?>

<div class="width70 left">
    <table class="widefat">
        <thead>
            <tr>
                <th><b>Drag & Drop the member's pictures to sort them in the order you want them to appear</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <ul class="sc_sortable grid" data-action="<?php echo SC_TEAM_PATH; ?>">
                        <?php
                        $args = array(
                            'post_type' => 'team_member',
                            'meta_key' => 'sc_member_order',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                        );
                        $members = new WP_Query($args);
                        if ($members->have_posts()) {
                            while ($members->have_posts()) {
                                $members->the_post();
                                $id = get_the_ID();
                                $order = get_post_meta($id, 'sc_member_order', true);
                                if (has_post_thumbnail())
                                    $thumb_url = wp_get_attachment_url(get_post_thumbnail_id($id));
                                else
                                    $thumb_url = SC_TEAM_PATH . 'img/noprofile.jpg';
                                ?>
                                <li id="<?php echo $id; ?>" itemscope itemtype="http://schema.org/Person" class="sc_team_member ui-state-default" data-order="<?php echo $order; ?>">
                                    <div class="sc_team_member_inner">
                                        <img src="<?php echo $thumb_url; ?>" />
                                        <div class="sc_team_member_overlay">
                                            <?php the_title() ?>
                                        </div>
                                        <div itemprop="jobtitle" class="sc_team_member_jobtitle">
                                            <?php echo get_post_meta($id, 'team_member_title', true); ?>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            echo 'There are no team members to display';
                        }
                        ?>
                    </ul>
            </tr>
        </tbody>
    </table>
    <!--<input type="submit" name="wp_popup_reset" value="Reset" class="button button-primary" onclick="return confirm_reset();"/>-->
    <a class="button button-primary" id="set_order">Save Order</a>
    <p class="sc_team_member_update_status">
        <span class="sc_team_member_updating"><img src="<?php echo SC_TEAM_URL . 'inc/img/spinner.gif' ?>" class=""/> Saving</span>
        <span class="sc_team_member_saved"><img src="<?php echo SC_TEAM_URL . 'inc/img/check.png' ?>" class=""/> Saved!</span>
    </p>
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
    jQuery(document).ready(function($) {
        $("#sc_popup_shortcode").focusout(function() {
            var shortcode = jQuery(this).val();
            shortcode = shortcode.replace(/"/g, "").replace(/'/g, "");
            jQuery(this).val(shortcode);
        });

    });

</script>