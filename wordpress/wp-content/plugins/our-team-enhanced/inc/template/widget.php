<?php

/*
 * Short description
 * @author bilal hassan <info@smartcatdesign.net>
 * 
 */
$args = array(
    'post_type' => 'team_member',
    'meta_key' => 'sc_member_order',
    'orderby' => 'meta_value',
    'order' => 'ASC'
);
$team = new WP_Query($args);
?>
<div id="sc_our_team" class="widget">
    <?php
    if ($team->have_posts()) {
        while ($team->have_posts()) {
            $team->the_post();
//                            echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID() ));
            ?>
            <div itemscope itemtype="http://schema.org/Person" class="sc_sidebar_team_member">
                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php if (has_post_thumbnail())
                            echo the_post_thumbnail('medium');
                        else
                            echo '<img src="' . SC_TEAM_URL .'inc/img/noprofile.jpg" class="attachment-medium wp-post-image"/>';?>  
                </a>
                    <div class="sc_team_member_overlay">
                        <div itemprop="name" class="sc_team_member_name">
                            <?php the_title() ?>
                        </div>
                        <div itemprop="jobtitle" class="sc_team_member_jobtitle">
                            <?php echo get_post_meta(get_the_ID(), 'team_member_title', true); ?>
                        </div>
                        <div class='icons'>

                            <?php // the_content(); ?>
                            <?php
                            
                            $facebook = get_post_meta(get_the_ID(), 'team_member_facebook', true);
                            $twitter = get_post_meta(get_the_ID(), 'team_member_twitter', true);
                            $linkedin = get_post_meta(get_the_ID(), 'team_member_linkedin', true);
                            $gplus = get_post_meta(get_the_ID(), 'team_member_gplus', true);
                            $email = get_post_meta(get_the_ID(), 'team_member_email', true);
                            
                            


                            ?>

                        </div>
                    </div>
            </div>
        <?php
        }
        wp_reset_postdata();
    } else {
        echo 'There are no team members to display';
    }
    ?>
</div>
