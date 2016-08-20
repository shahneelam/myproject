<?php
get_header();
$options = get_option('smartcat_team_options');
$plugin = new SmartcatTeamPlugin();
?>

<div class="sc-single-wrapper">

    <?php while (have_posts()) : the_post(); ?>
        <div class="sc_team_single_member <?php echo $options['single_template']; ?>">

            <div class="sc_single_side" itemscope itemtype="http://schema.org/Person">

                <div class="inner">
                    <?php echo the_post_thumbnail('medium'); ?>
                    <h2 class="name" itemprop="name"><?php echo the_title(); ?></h2>
                    <h3 class="title" itemprop="jobtitle"><?php echo get_post_meta(get_the_ID(), 'team_member_title', true); ?></h3>
                    <ul class="social <?php echo 'yes' == $options['social'] ? '' : 'hidden'; ?>">

                        <?php $plugin->set_social(get_the_ID()); ?>

                    </ul>
                </div>
            </div>

            <div class="sc_single_main">  

                <?php echo the_content(); ?>

            </div>

        </div>

    <?php endwhile; ?>
</div>
<?php get_footer(); ?>