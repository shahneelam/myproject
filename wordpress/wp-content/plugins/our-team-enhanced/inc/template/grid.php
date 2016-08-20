<?php
/*
 * Short description
 * @author bilal hassan <info@smartcatdesign.net>
 * 
 */
$args = $this->sc_get_args( $group );
$members = new WP_Query( $args );
?>
<div id="sc_our_team" class="<?php
echo $template == '' ? $this->options[ 'template' ] : $template;
echo ' sc-col' . $this->options[ 'columns' ];
?>">
    <div class="clear"></div>
    <?php
    if ( $members->have_posts() ) {
        while ( $members->have_posts() ) {
            $members->the_post();
            ?>
            <div itemscope itemtype="http://schema.org/Person" class="sc_team_member">
                <div class="sc_team_member_inner">

                    <?php
                    if ( has_post_thumbnail() )
                        echo the_post_thumbnail( 'medium' );
                    else {
                        echo '<img src="' . SC_TEAM_URL . 'inc/img/noprofile.jpg" class="attachment-medium wp-post-image"/>';
                    }
                    ?>

                    <?php if ( 'yes' == $this->options[ 'name' ] ) : ?>
                        <div itemprop="name" class="sc_team_member_name">
                            <a href="<?php the_permalink() ?>" rel="bookmark" >                            
                                <?php the_title() ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ( 'yes' == $this->options[ 'title' ] && get_post_meta( get_the_ID(), 'team_member_title', true )) : ?>
                        <div itemprop="jobtitle" class="sc_team_member_jobtitle">
                            <?php echo get_post_meta( get_the_ID(), 'team_member_title', true ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="sc_team_content">
                        <?php the_content(); ?>
                    </div>

                    <div class='icons <?php echo 'yes' == $this->options[ 'social' ] ? '' : 'hidden'; ?>'>

                        <?php $this->set_social( get_the_ID() ); ?>

                    </div>

                    <div class="sc_team_member_overlay"></div>
                    <div class="sc_team_more">
                        <a href="<?php the_permalink() ?>" rel="bookmark" class="<?php echo $this->check_clicker( $single_template ); ?>"> 
                            <img src="<?php echo SC_TEAM_URL . 'inc/img/more.png' ?>"/>
                        </a>
                    </div>
                </div>

            </div>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo __( 'There are no team members to display', 'smartcat-team' );
    }
    ?>
    <div class="clear"></div>
</div>
