<?php


function sc_team_update_order() {
    $post_id = $_POST['id'];
    $sc_member_order = $_POST['sc_member_order'];
    //update_post_meta($post_id, $meta_key, $sc_member_order)
    update_post_meta($post_id, 'sc_member_order', $sc_member_order);
    exit();
}
add_action('wp_ajax_sc_team_update_order', 'sc_team_update_order');
add_action('wp_ajax_sc_team_update_order', 'sc_team_update_order');


class SmartcatTeamPlugin {

    const VERSION = '2.5.0';
    const NAME = 'Our Team Showcase';

    private static $instance;
    private $options;

    public static function instance() {
        if ( !self::$instance ) :
            self::$instance = new self;
            self::$instance->get_options();
            self::$instance->add_hooks();
        endif;
    }

    public static function activate() {

        $options = array(
            'template'              => 'grid',
            'social'                => 'yes',
            'single_social'         => 'yes',
            'name'                  => 'yes',
            'title'                 => 'yes',
            'profile_link'          => 'yes',
            'member_count'          => -1,
            'text_color'            => '1F7DCF',
            'columns'               => '3',
            'margin'                => 5,
            'redirect'              => true,
            'single_image_style'    => 'square',
            'social_link'           =>  'new',
            'card_margin'           =>  100,
            'single_template'       =>  'standard',
            'slug'                  => 'team_member'
        );

        if ( !get_option( 'smartcat_team_options' ) ) :
            
            add_option( 'smartcat_team_options', $options );
            $options[ 'redirect' ] = true;
            update_option( 'smartcat_team_options', $options );
            
        else :
            $options = get_option( 'smartcat_team_options' );
        
            if( !isset( $options['social_link'] ) ) :
                $options['social_link'] = 'new';
            endif;
        
            if( !isset( $options['slug'] ) ) :
                $options['slug'] = 'team_member';
            endif;
            
            update_option( 'smartcat_team_options', $options );
            
        endif;
        
        flush_rewrite_rules();
        
    }

    public static function deactivate() {
        
    }

    private function add_hooks() {
        add_action( 'init', array( $this, 'team_members' ) );
        add_action( 'init', array( $this, 'team_member_positions' ), 0 );
        add_action( 'admin_init', array( $this, 'smartcat_team_activation_redirect' ) );
        add_action( 'admin_menu', array( $this, 'smartcat_team_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'smartcat_team_load_admin_styles_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'smartcat_team_load_styles_scripts' ) );
        add_shortcode( 'our-team', array( $this, 'set_our_team' ) );
        add_action( 'add_meta_boxes', array( $this, 'smartcat_team_member_info_box' ) );
        add_action( 'save_post', array( $this, 'team_member_box_save' ) );
        add_action( 'widgets_init', array( $this, 'wpb_load_widget' ) );
        add_action( 'wp_ajax_smartcat_team_update_pm', array( $this, 'smartcat_team_update_order' ) );
        add_action( 'wp_head', array( $this, 'sc_custom_styles' ) );
        add_action( 'admin_head', array( $this, 'sc_custom_admin_styles' ) );
        add_filter( 'the_content', array( $this, 'smartcat_set_single_content' ) );
        add_filter( 'single_template', array( $this, 'smartcat_team_get_single_template' ) );
        add_action( 'after_setup_theme', array( $this, 'add_featured_image_support' ) );
        add_filter( 'manage_edit-team_member_columns', array( $this, 'set_columns') );
        add_action( 'manage_team_member_posts_custom_column' , array( $this, 'custom_columns' ), 10, 2 );
    }
    
    public function set_columns( $columns ) {
        
        unset( $columns['date'] );
        
        $columns['team_member_title'] = __( 'Title' );
        $columns['team_member_image'] = __( 'Image' );
        
        return $columns;
        
    }

    public function custom_columns( $column, $post_id ){
        
        switch( $column ) :
            
            case 'team_member_title' :
                echo get_post_meta( $post_id, 'team_member_title', TRUE );
                break;
            
            case 'team_member_image' :
                echo get_the_post_thumbnail( $post_id, array( 50, 50 ) );
                break;
            
            
        endswitch;
        
    }
    
    private function get_options() {
        if ( get_option( 'smartcat_team_options' ) ) :
            $this->options = get_option( 'smartcat_team_options' );
        endif;
    }


    public function smartcat_team_activation_redirect() {
        if ( $this->options[ 'redirect' ] ) :
            $old_val = $this->options;
            $old_val[ 'redirect' ] = false;
            update_option( 'smartcat_team_options', $old_val );
            wp_safe_redirect( admin_url( 'edit.php?post_type=team_member&page=smartcat_team_settings' ) );
        endif;
    }

    public function add_featured_image_support(){
        add_theme_support('post-thumbnails');
    }
    
    public function smartcat_team_menu() {

        add_submenu_page( 'edit.php?post_type=team_member', 'Settings', 'Settings', 'administrator', 'smartcat_team_settings', array( $this, 'smartcat_team_settings' ) );
        add_submenu_page( 'edit.php?post_type=team_member', 'Re-Order Members', 'Re-Order Members', 'administrator', 'smartcat_team_reorder', array( $this, 'smartcat_team_reorder' ) );
        add_submenu_page( 'edit.php?post_type=team_member', 'Documentation', 'Documentation', 'administrator', 'smartcat_team_documentation', array( $this, 'smartcat_team_documentation' ) );
        add_submenu_page( 'edit.php?post_type=team_member', 'Add-ons', 'Add-ons', 'administrator', 'smartcat_team_addons', array( $this, 'smartcat_team_addons' ) );
    }

    public function smartcat_team_documentation(){
        
        include_once SC_TEAM_PATH . 'admin/documentation.php';
        
    }

    public function smartcat_team_addons(){
        
        include_once SC_TEAM_PATH . 'admin/addons.php';
        
    }

    public function smartcat_team_reorder() {
        include_once SC_TEAM_PATH . 'admin/reorder.php';
    }

    public function smartcat_team_settings() {

        if ( isset( $_REQUEST[ 'sc_our_team_save' ] ) && $_REQUEST[ 'sc_our_team_save' ] == 'Update' ) :
            update_option( 'smartcat_team_options', $_REQUEST[ 'smartcat_team_options' ] );
        endif;

        include_once SC_TEAM_PATH . 'admin/options.php';
    }

    public function smartcat_team_load_admin_styles_scripts( $hook ) {
        wp_enqueue_style( 'smartcat_team_admin_style', SC_TEAM_URL . 'inc/style/sc_our_team_admin.css' );
        wp_enqueue_script( 'smartcat_team_color_script', SC_TEAM_URL . 'inc/script/jscolor/jscolor.js', array( 'jquery' ) );
        wp_enqueue_script( 'smartcat_team_script', SC_TEAM_URL . 'inc/script/sc_our_team_admin.js', array( 'jquery' ) );
    }

    function smartcat_team_load_styles_scripts() {
       
        // plugin main style
        wp_enqueue_style( 'smartcat_team_default_style', SC_TEAM_URL . 'inc/style/sc_our_team.css', false, self::VERSION );

        // plugin main script
        wp_enqueue_script( 'smartcat_team_hc_script', SC_TEAM_URL . 'inc/script/hc.js', array( 'jquery' ), self::VERSION );
        wp_enqueue_script( 'smartcat_team_carousel_script', SC_TEAM_URL . 'inc/script/carousel.js', array( 'jquery' ), self::VERSION );
        wp_enqueue_script( 'smartcat_team_default_script', SC_TEAM_URL . 'inc/script/sc_our_team.js', array( 'jquery' ), self::VERSION );
    }

    function set_our_team( $atts ) {
        extract( shortcode_atts( array(
            'group'             => '',
            'template'          => '',
            'single_template'   =>  '',
                        ), $atts ) );
        global $content;

        ob_start();

        if( $template == '' ) :
            if ( $this->options[ 'template' ] === false or $this->options[ 'template' ] == '' ) :
                include SC_TEAM_PATH . 'inc/template/grid.php';
            else :
                include SC_TEAM_PATH . 'inc/template/' . $this->options[ 'template' ] . '.php';
            endif;
        else :
            
            if( file_exists( SC_TEAM_PATH . 'inc/template/' . $template . '.php') ) :
                
                include SC_TEAM_PATH . 'inc/template/' . $template . '.php';
            else :
                include SC_TEAM_PATH . 'inc/template/grid.php';
            endif;
        endif;

        $output = ob_get_clean();
        return $output;
    }

    function team_members() {
        $labels = array(
            'name' => _x( 'Team', 'post type general name' ),
            'singular_name' => _x( 'Team Member', 'post type singular name' ),
            'add_new' => _x( 'Add New', 'team_member' ),
            'add_new_item' => __( 'Add New Member' ),
            'edit_item' => __( 'Edit Member' ),
            'new_item' => __( 'New Team Member' ),
            'all_items' => __( 'All Team Members' ),
            'view_item' => __( 'View Team Member' ),
            'search_items' => __( 'Search Team Members' ),
            'not_found' => __( 'No member found' ),
            'not_found_in_trash' => __( 'No member found in the Trash' ),
            'parent_item_colon' => '',
        );
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => $this->options['slug'],'with_front' => false),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon' => SC_TEAM_URL . 'inc/img/icon.png',
            'supports' => array( 'title', 'editor', 'thumbnail' ),

        );
        register_post_type( 'team_member', $args );
    }

    public function team_member_positions() {
        $labels = array(
            'name' => _x( 'Groups', 'taxonomy general name' ),
            'singular_name' => _x( 'Group', 'taxonomy singular name' ),
            'search_items' => __( 'Search Groups' ),
            'all_items' => __( 'All Groups' ),
            'parent_item' => __( 'Parent Group' ),
            'parent_item_colon' => __( 'Parent Group:' ),
            'edit_item' => __( 'Edit Group' ),
            'update_item' => __( 'Update Group' ),
            'add_new_item' => __( 'Add New Group' ),
            'new_item_name' => __( 'New Group' ),
            'menu_name' => __( 'Groups' ),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
        );
        register_taxonomy( 'team_member_position', 'team_member', $args );
    }
    
    public function get_groups() {
        
        return get_categories('taxonomy=team_member_position&type=team_member'); 
        
    }
    
    

    public function smartcat_team_member_info_box() {

        add_meta_box(
                'smartcat_team_member_info_box', __( 'Additional Information', 'myplugin_textdomain' ), array( $this, 'smartcat_team_member_info_box_content' ), 'team_member', 'normal', 'high'
        );
    }

    public function smartcat_team_member_info_box_content( $post ) {
        //nonce
        wp_nonce_field( plugin_basename( __FILE__ ), 'smartcat_team_member_info_box_content_nonce' );

        //social

        echo '<p><em>Fields that are left blank, will simply not display any output</em></p>';

        echo '<div class="sc_options_table">';
        
        echo '<table class="widefat">';

        echo '<tr><td><lablel for="team_member_title">Job Title</lablel></td>';
        echo '<td><input type="text" value="' . get_post_meta( $post->ID, 'team_member_title', true ) . '" id="team_member_title" name="team_member_title" placeholder="Enter Job Title"/></td></tr>';

        echo '<tr><td><lablel for="team_member_email"><img src="' . SC_TEAM_URL . 'inc/img/email.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta( $post->ID, 'team_member_email', true ) . '" id="team_member_email" name="team_member_email" placeholder="Enter Email Address"/></td></tr>';

        echo '<tr><td><lablel for="team_member_facebook"><img src="' . SC_TEAM_URL . 'inc/img/fb.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta( $post->ID, 'team_member_facebook', true ) . '" id="team_member_facebook" name="team_member_facebook" placeholder="Enter Facebook URL"/></td></tr>';

        echo '<tr><td><label for="team_member_twitter"><img src="' . SC_TEAM_URL . 'inc/img/twitter.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta( $post->ID, 'team_member_twitter', true ) . '" id="team_member_twitter" name="team_member_twitter" placeholder="Enter Twitter URL"/></td></tr>';

        echo '<tr><td><lablel for="team_member_linkedin"><img src="' . SC_TEAM_URL . 'inc/img/linkedin.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta( $post->ID, 'team_member_linkedin', true ) . '" id="team_member_linkedin" name="team_member_linkedin" placeholder="Enter Linkedin URL"/></td></tr>';

        echo '<tr><td><lablel for="team_member_gplus"><img src="' . SC_TEAM_URL . 'inc/img/google.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta( $post->ID, 'team_member_gplus', true ) . '" id="team_member_gplus" name="team_member_gplus" placeholder="Enter Google Plus URL"/></td></tr>';

        echo '<tr><td><lablel for="team_member_phone"><img src="' . SC_TEAM_URL . 'inc/img/phone.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta( $post->ID, 'team_member_phone', true ) . '" id="team_member_phone" name="team_member_phone" placeholder="Enter Phone Number"/></td></tr>';

        echo '<tr><td><lablel for="team_member_instagram"><img src="' . SC_TEAM_URL . 'inc/img/instagram.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta($post->ID, 'team_member_instagram', true) . '" id="team_member_instagram" name="team_member_instagram" placeholder="Enter Instagram URL"/></td></tr>';

        echo '<tr><td><lablel for="team_member_pinterest"><img src="' . SC_TEAM_URL . 'inc/img/pinterest.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta($post->ID, 'team_member_pinterest', true) . '" id="team_member_pinterest" name="team_member_pinterest" placeholder="Enter pinterest URL"/></td></tr>';

        echo '<tr><td><lablel for="team_member_website"><img src="' . SC_TEAM_URL . 'inc/img/website.png" width="20px"/></label></td>';
        echo '<td><input type="text" value="' . get_post_meta($post->ID, 'team_member_website', true) . '" id="team_member_website" name="team_member_website" placeholder="Enter Personal Website URL"/></td></tr>';

//
//        echo '<tr><th><lablel for="team_member_qoute">Personal Quote </lablel></th>';
//        echo '<td><em style="color: red; font-size: 10px">pro version</em></td></tr>';        
        

//        echo '<tr><th><lablel for="team_member_qoute">Attributes / Skills / Ratings</lablel></th>';
//        echo '<td><em style="color: red; font-size: 10px">pro version</em></td></tr>';        
        
        echo '</table>';
        echo '</div><hr>'; 
        
    $posts = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'post',
                ));

        echo '<div class="sc_options_table">'
        . '<h4>Authored / Favorite Articles</h4>'
        . '<table class="widefat"><tr>'
        . '<td colspan="2">Show <input type="radio" name="team_member_article_bool" value="on" ' . checked(get_post_meta($post->ID, 'team_member_article_bool', true), 'on', false) . '/> '
        . 'Hide <input type="radio" name="team_member_article_bool" value="off" ' . checked(get_post_meta($post->ID, 'team_member_article_bool', true), 'off', false) . ' />'
        . '</td>'
        . '</tr><tr><td>Title</td>'
        . '<td><input type="text" name="team_member_article_title" placeholder="Enter the title" value="' . get_post_meta($post->ID, 'team_member_article_title', true) . '"/></td></tr>';

        echo '<tr><td>Article 1</td>'
        . '<td><select name="team_member_article1">'
        . '<option value="">Select Article</option>';

        foreach ($posts as $the_post) :

            echo '<option value="' . $the_post->ID . '" ' . selected($the_post->ID, get_post_meta($post->ID, 'team_member_article1', true), true) . '>' . $the_post->post_title . '</option>';

        endforeach;

        echo '</select></td>'
        . '</tr>';


        echo '<tr><td>Article 2</td>'
        . '<td><select name="team_member_article2">'
        . '<option value="">Select Article</option>';

        foreach ($posts as $the_post) :

            echo '<option value="' . $the_post->ID . '" ' . selected($the_post->ID, get_post_meta($post->ID, 'team_member_article2', true), true) . '>' . $the_post->post_title . '</option>';

        endforeach;

        echo '</select></td>'
        . '</tr>';

        echo '<tr><td>Article 3</td>'
        . '<td><select name="team_member_article3">'
        . '<option value="">Select Article</option>';

        foreach ($posts as $the_post) :

            echo '<option value="' . $the_post->ID . '" ' . selected($the_post->ID, get_post_meta($post->ID, 'team_member_article3', true), true) . '>' . $the_post->post_title . '</option>';

        endforeach;

        echo '</select></td>'
        . '</tr>';


        echo '</table>'
        . ''
        . ''
        . '</div><hr>';
        
        echo '<div class="sc_options_table">'
        . '<h4>Attributes / Skills / Ratings <em style="font-size: 11px; color: #CC0000"> -  Pro version</em></h4>'
        . '<table class="widefat"><tr>'
        . '<td colspan="2">Show <input type="radio" name="team_member_skill_bool" value="on" disabled/> '
        . 'Hide <input type="radio" name="team_member_skill_bool" value="off" disabled/>'
        . '</td></tr><tr>'
        . '<td>Title</td><td colspan="2">'
        . '<input type="text" name="team_member_skill_title" value="" disabled/>'
        . '</td></tr><tr>'
        . '<td>Attribute/Skill #1</td>'
        . '<td><input type="text" name="team_member_skill1" placeholder="Title" value="" disabled/></td>'
        . '<td><input type="text" name="team_member_skill_value1" placeholder="Skill rating( 1 to 10 )" value="" disabled/></td></tr>'
        . '<td>Attribute/Skill #2</td>'
        . '<td><input type="text" name="team_member_skill2" placeholder="Title" value="" disabled/></td>'
        . '<td><input type="text" name="team_member_skill_value2" placeholder="Skill rating( 1 to 10 )" value="" disabled/></td></tr>'
        . '<td>Attribute/Skill #3</td>'
        . '<td><input type="text" name="team_member_skill3" placeholder="Title" value="" disabled/></td>'
        . '<td><input type="text" name="team_member_skill_value3" placeholder="Skill rating( 1 to 10 )" value="" disabled/</td></tr>'
        . '<td>Attribute/Skill #4</td>'
        . '<td><input type="text" name="team_member_skill4" placeholder="Title" value="" disabled/></td>'
        . '<td><input type="text" name="team_member_skill_value4" placeholder="Skill rating( 1 to 10 )" value="" disabled/></td></tr>';

        echo '</table></div>'
        . '<div class="clear"></div><hr>';
        
        ?>

        <div class="sc_options_table">

            <h4>Interests / Tags / Additional Skills <em style="font-size: 11px; color: #CC0000"> -  Pro version</em></h4>
            <table class="widefat">
                <tr>
                    <td colspan="2">
                        Show <input disabled type="radio" name="team_member_tags_bool" value="on" <?php checked('on', get_post_meta($post->ID, 'team_member_tags_bool', true)); ?>/> Hide <input type="radio" name="team_member_tags_bool" value="off" <?php checked('off', get_post_meta($post->ID, 'team_member_tags_bool', true)); ?>/>
                    </td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td><input disabled type="text" name="team_member_tags_title" placeholder="Enter the label for the tags" value="<?php echo get_post_meta($post->ID, 'team_member_tags_title', true) ?>"/></td>
                </tr>
                <tr>
                    <td>Attributes</td>
                    <td><textarea disabled name="team_member_tags" placeholder="Enter attributes, comma separated" style="width: 100%"><?php echo get_post_meta($post->ID, 'team_member_tags', true) ?></textarea></td>
                </tr>


            </table>

        </div>
        


    <?php

        
    }

    public function team_member_box_save( $post_id ) {

        $slug = 'team_member';

        if ( isset( $_POST[ 'post_type' ] ) ) {
            if ( $slug != $_POST[ 'post_type' ] ) {
                return;
            }
        }

        // get var values
        if ( get_post_meta( $post_id, 'sc_member_order', true ) == '' || get_post_meta( $post_id, 'sc_member_order', true ) === FALSE )
            update_post_meta( $post_id, 'sc_member_order', 0 );


        if ( isset( $_REQUEST[ 'team_member_title' ] ) ) {
            $facebook_url = $_POST[ 'team_member_title' ];
            update_post_meta( $post_id, 'team_member_title', $facebook_url );
        }

        if ( isset( $_REQUEST[ 'team_member_email' ] ) ) {
            $facebook_url = $_POST[ 'team_member_email' ];
            update_post_meta( $post_id, 'team_member_email', $facebook_url );
        }


        if ( isset( $_REQUEST[ 'team_member_facebook' ] ) ) {
            $facebook_url = $_POST[ 'team_member_facebook' ];
            update_post_meta( $post_id, 'team_member_facebook', $facebook_url );
        }

        if ( isset( $_REQUEST[ 'team_member_twitter' ] ) ) {
            $twitter_url = $_POST[ 'team_member_twitter' ];
            update_post_meta( $post_id, 'team_member_twitter', $twitter_url );
        }

        if ( isset( $_REQUEST[ 'team_member_linkedin' ] ) ) {
            $linkedin_url = $_POST[ 'team_member_linkedin' ];
            update_post_meta( $post_id, 'team_member_linkedin', $linkedin_url );
        }

        if ( isset( $_REQUEST[ 'team_member_gplus' ] ) ) {
            $gplus_url = $_POST[ 'team_member_gplus' ];
            update_post_meta( $post_id, 'team_member_gplus', $gplus_url );

        }
        
        if (isset($_REQUEST['team_member_instagram'])) {
            $instagram_url = $_POST['team_member_instagram'];
            update_post_meta($post_id, 'team_member_instagram', $instagram_url);
        }

        if (isset($_REQUEST['team_member_pinterest'])) {
            $pinterest_url = $_POST['team_member_pinterest'];
            update_post_meta($post_id, 'team_member_pinterest', $pinterest_url);
        }

        if (isset($_REQUEST['team_member_website'])) {
            $website_url = $_POST['team_member_website'];
            update_post_meta($post_id, 'team_member_website', $website_url);
        }
        
        if (isset($_REQUEST['team_member_tags_bool'])) {
            $tags_bool = $_POST['team_member_tags_bool'];
            update_post_meta($post_id, 'team_member_tags_bool', $tags_bool);
        }

        if (isset($_REQUEST['team_member_tags_title'])) {
            $tags_title = $_POST['team_member_tags_title'];
            update_post_meta($post_id, 'team_member_tags_title', $tags_title);
        }

        if (isset($_REQUEST['team_member_tags'])) {
            $tags = $_POST['team_member_tags'];
            update_post_meta($post_id, 'team_member_tags', $tags);
        }
        
        if ( isset( $_REQUEST[ 'team_member_phone' ] ) ) {
            update_post_meta( $post_id, 'team_member_phone', $_POST[ 'team_member_phone' ] );
        }

        if ( isset( $_REQUEST[ 'team_member_skill1' ] ) ) {
            $skill = $_POST[ 'team_member_skill1' ];
            update_post_meta( $post_id, 'team_member_skill1', $skill );
        }

        if ( isset( $_REQUEST[ 'team_member_skill_value1' ] ) ) {
            $value = $_POST[ 'team_member_skill_value1' ];
            update_post_meta( $post_id, 'team_member_skill_value1', $value );
        }

        if ( isset( $_REQUEST[ 'team_member_skill2' ] ) ) {
            $skill = $_POST[ 'team_member_skill2' ];
            update_post_meta( $post_id, 'team_member_skill2', $skill );
        }

        if ( isset( $_REQUEST[ 'team_member_skill_value2' ] ) ) {
            $value = $_POST[ 'team_member_skill_value2' ];
            update_post_meta( $post_id, 'team_member_skill_value2', $value );
        }

        if ( isset( $_REQUEST[ 'team_member_skill3' ] ) ) {
            $skill = $_POST[ 'team_member_skill3' ];
            update_post_meta( $post_id, 'team_member_skill3', $skill );
        }

        if ( isset( $_REQUEST[ 'team_member_skill_value3' ] ) ) {
            $value = $_POST[ 'team_member_skill_value3' ];
            update_post_meta( $post_id, 'team_member_skill_value3', $value );
        }

        if ( isset( $_REQUEST[ 'team_member_skill4' ] ) ) {
            $skill = $_POST[ 'team_member_skill4' ];
            update_post_meta( $post_id, 'team_member_skill4', $skill );
        }

        if ( isset( $_REQUEST[ 'team_member_skill_value4' ] ) ) {
            $value = $_POST[ 'team_member_skill_value4' ];
            update_post_meta( $post_id, 'team_member_skill_value4', $value );
        }

        if ( isset( $_REQUEST[ 'team_member_qoute' ] ) ) {
            $value = $_POST[ 'team_member_qoute' ];
            update_post_meta( $post_id, 'team_member_qoute', $value );
        }
        
        if (isset($_REQUEST['team_member_article_bool'])) {
            $article_bool = $_POST['team_member_article_bool'];
            update_post_meta($post_id, 'team_member_article_bool', $article_bool);
        }
        
        if (isset($_REQUEST['team_member_article_title'])) {
            $value = $_POST['team_member_article_title'];
            update_post_meta($post_id, 'team_member_article_title', $value);
        }

        if (isset($_REQUEST['team_member_article1'])) {
            $value = $_POST['team_member_article1'];
            update_post_meta($post_id, 'team_member_article1', $value);
        }

        if (isset($_REQUEST['team_member_article2'])) {
            $value = $_POST['team_member_article2'];
            update_post_meta($post_id, 'team_member_article2', $value);
        }

        if (isset($_REQUEST['team_member_article3'])) {
            $value = $_POST['team_member_article3'];
            update_post_meta($post_id, 'team_member_article3', $value);
        }

        
    }


    public function wpb_load_widget() {
        register_widget( 'smartcat_team_widget' );
    }


    public function smartcat_team_update_order() {
        $post_id = $_POST[ 'id' ];
        $sc_member_order = $_POST[ 'sc_member_order' ];
        //update_post_meta($post_id, $meta_key, $sc_member_order)
        update_post_meta( $post_id, 'sc_member_order', $sc_member_order );
    }

    public function sc_custom_admin_styles() { ?>
        
        <style>
            #menu-posts-team_member ul li:last-child a{ color: #A2CB86 !important; }
        </style>
    <?php }
    public function sc_custom_styles() {
        ?>
        <style>
            
            #sc_our_team a,
            .sc_our_team_lightbox .name,
            .sc_personal_quote span.sc_team_icon-quote-left{ color: #<?php echo $this->options['text_color']; ?>; }
            .grid#sc_our_team .sc_team_member .sc_team_member_name,
            .grid#sc_our_team .sc_team_member .sc_team_member_jobtitle,
            .grid_circles#sc_our_team .sc_team_member .sc_team_member_jobtitle,
            .grid_circles#sc_our_team .sc_team_member .sc_team_member_name,
            #sc_our_team_lightbox .progress,
            .sc_our_team_panel .sc-right-panel .sc-name,
            #sc_our_team .sc_team_member .icons span,
            .sc_our_team_panel .sc-right-panel .sc-skills .progress,
            #sc_our_team_lightbox .sc_our_team_lightbox .social span,
            .sc_team_single_member .sc_team_single_skills .progress{ background: #<?php echo $this->options[ 'text_color' ]; ?>;}
            .stacked#sc_our_team .smartcat_team_member{ border-color: #<?php echo $this->options[ 'text_color' ]; ?>;}
            /*.grid#sc_our_team .sc_team_member_inner{ height: <?php echo $this->options[ 'height' ]; ?>px; }*/
            .grid#sc_our_team .sc_team_member{ padding: <?php echo $this->options['margin']; ?>px;}
            #sc_our_team_lightbox .sc_our_team_lightbox{ margin-top: <?php echo $this->options['card_margin']; ?>px }
            
        </style>
        <?php
    }

    public function smartcat_set_single_content($content) {
        global $post;

        if (is_single()) :
            if ($post->post_type == 'team_member' &&
                    $this->options['single_template'] == 'standard' &&
                    $this->options['single_social'] == 'yes'
            ) :
                $facebook = get_post_meta(get_the_ID(), 'team_member_facebook', true);
                $twitter = get_post_meta(get_the_ID(), 'team_member_twitter', true);
                $linkedin = get_post_meta(get_the_ID(), 'team_member_linkedin', true);
                $gplus = get_post_meta(get_the_ID(), 'team_member_gplus', true);
                $email = get_post_meta(get_the_ID(), 'team_member_email', true);
                $phone = get_post_meta(get_the_ID(), 'team_member_phone', true);
                $instagram = get_post_meta(get_the_ID(), 'team_member_instagram', true);
                $pinterest = get_post_meta(get_the_ID(), 'team_member_pinterest', true);
                $website = get_post_meta(get_the_ID(), 'team_member_website', true);


                $content .= '<div class="smartcat_team_single_icons">';
                $content .= $this->smartcat_get_social_content($facebook, $twitter, $linkedin, $gplus, $email, $phone, $instagram, $pinterest, $website);
                $content .= '</div><hr>';

                if (null !== get_post_meta(get_the_ID(), 'team_member_article_bool', true) && get_post_meta(get_the_ID(), 'team_member_article_bool', true) == 'on') :

                    $content .= '<div class="sc_team_posts sc_team_post">
                    <h3 class="skills-title">' . get_post_meta(get_the_ID(), 'team_member_article_title', true) . '</h3>';

                    $post1 = get_post_meta(get_the_ID(), 'team_member_article1', true) > 0 ? get_post(get_post_meta(get_the_ID(), 'team_member_article1', true)) : null;
                    $post2 = get_post_meta(get_the_ID(), 'team_member_article2', true) > 0 ? get_post(get_post_meta(get_the_ID(), 'team_member_article2', true)) : null;
                    $post3 = get_post_meta(get_the_ID(), 'team_member_article3', true) > 0 ? get_post(get_post_meta(get_the_ID(), 'team_member_article3', true)) : null;

                    $content .= '<div class="sc-team-member-posts">

                        <div>';
                    
                    if( $post1 ) :
                        if (get_the_post_thumbnail($post1->ID, 'medium')) :
                            $content .= '<div class="width25 left">' . get_the_post_thumbnail($post1->ID, 'medium') . '</div>';
                        endif;

                        $content .= '<div class="width75 left">
                                    <a href="' . get_the_permalink($post1->ID) . '">' . get_the_title($post1->ID) . '</a>
                                </div>
                            </div>
                            <div>';
                    endif;
                    
                    if( $post2 ) :
                        if (get_the_post_thumbnail($post2->ID, 'medium')) :
                            $content .= '<div class="width25 left">' . get_the_post_thumbnail($post2->ID, 'medium') . '</div>';
                        endif;

                        $content .= '<div class="width75 left">
                                <a href="' . get_the_permalink($post2->ID) . '">' . get_the_title($post2->ID) . '</a>
                            </div>
                            </div>
                            <div>';
                    endif;

                    if( $post3 ) :
                        if (get_the_post_thumbnail($post3->ID, 'medium')) :
                            $content .= '<div class="width25 left">' . get_the_post_thumbnail($post3->ID, 'medium') . '</div>';
                        endif;

                        $content .= '<div class="width75 left">
                                    <a href="' . get_the_permalink($post3->ID) . '">' . get_the_title($post3->ID) . '</a>
                                </div>
                            </div>
                        </div>';
                    endif;
                    
                    echo '</div>';
                endif;

            endif;
        else :

        endif;

        return $content;
    }
    
    public function add_target() {
        
        if( $this->options['social_link'] == 'new' ) :
            
            return 'target="_BLANK"';
            
        endif;
        
        
    }
    
    public function set_social($id) {

        $facebook = get_post_meta($id, 'team_member_facebook', true);
        $twitter = get_post_meta($id, 'team_member_twitter', true);
        $linkedin = get_post_meta($id, 'team_member_linkedin', true);
        $gplus = get_post_meta($id, 'team_member_gplus', true);
        $email = get_post_meta($id, 'team_member_email', true);
        $phone = get_post_meta($id, 'team_member_phone', true);
        $pinterest = get_post_meta($id, 'team_member_pinterest', true);
        $instagram = get_post_meta($id, 'team_member_instagram', true);
        $website = get_post_meta($id, 'team_member_website', true);


        $this->get_social($facebook, $twitter, $linkedin, $gplus, $email, $phone, $pinterest, $instagram, $website);

    }

    public function get_social($facebook, $twitter, $linkedin, $gplus, $email, $phone, $pinterest, $instagram, $website) {

        if ($facebook != '')
            echo '<a ' . $this->add_target() . ' href="' . $facebook . '"><img src="' . SC_TEAM_URL . 'inc/img/fb.png" class="sc-social"/></a>';
        if ($twitter != '')
            echo '<a ' . $this->add_target() . ' href="' . $twitter . '"><img src="' . SC_TEAM_URL . 'inc/img/twitter.png" class="sc-social"/></a>';
        if ($gplus != '')
            echo '<a ' . $this->add_target() . ' href="' . $gplus . '"><img src="' . SC_TEAM_URL . 'inc/img/google.png" class="sc-social"/></a>';
        if ($linkedin != '')
            echo '<a ' . $this->add_target() . ' href="' . $linkedin . '"><img src="' . SC_TEAM_URL . 'inc/img/linkedin.png" class="sc-social"/></a>';

        if ($pinterest != '')
            echo '<a ' . $this->add_target() . ' href="' . $pinterest . '"><img src="' . SC_TEAM_URL . 'inc/img/pinterest.png" class="sc-social"/></a>';
        if ($instagram != '')
            echo '<a ' . $this->add_target() . ' href="' . $instagram . '"><img src="' . SC_TEAM_URL . 'inc/img/instagram.png" class="sc-social"/></a>';
        if ($website != '')
            echo '<a ' . $this->add_target() . ' href="' . $website . '"><img src="' . SC_TEAM_URL . 'inc/img/website.png" class="sc-social"/></a>';
        if ($email != '')
            echo '<a href=mailto:' . $email . '><img src="' . SC_TEAM_URL . 'inc/img/email.png" class="sc-social"/></a>';
        if ($phone != '')
            echo '<a href=tel:' . $phone . '><img src="' . SC_TEAM_URL . 'inc/img/phone.png" class="sc-social"/></a>';
    }

    
    public function smartcat_get_social_content($facebook, $twitter, $linkedin, $gplus, $email, $phone, $pinterest, $instagram, $website) {

        $content = null;

        if ('yes' == $this->options['social']) {
            if ($facebook != '')
                $content .= '<a ' . $this->add_target() . ' href="' . $facebook . '"><img src="' . SC_TEAM_URL . 'inc/img/fb.png" class="sc-social"/></a>';

            if ($twitter != '')
                $content .= '<a ' . $this->add_target() . ' href="' . $twitter . '"><img src="' . SC_TEAM_URL . 'inc/img/twitter.png" class="sc-social"/></a>';

            if ($gplus != '')
                $content .= '<a ' . $this->add_target() . ' href="' . $gplus . '"><img src="' . SC_TEAM_URL . 'inc/img/google.png" class="sc-social"/></a>';

            if ($linkedin != '')
                $content .= '<a ' . $this->add_target() . ' href="' . $linkedin . '"><img src="' . SC_TEAM_URL . 'inc/img/linkedin.png" class="sc-social"/></a>';

            if ($pinterest != '')
                $content .= '<a ' . $this->add_target() . ' href="' . $pinterest . '"><img src="' . SC_TEAM_URL . 'inc/img/pinterest.png" class="sc-social"/></a>';

            if ($instagram != '')
                $content .= '<a ' . $this->add_target() . ' href="' . $instagram . '"><img src="' . SC_TEAM_URL . 'inc/img/instagram.png" class="sc-social"/></a>';

            if ($email != '')
                $content .= '<a href=mailto:' . $email . '><img src="' . SC_TEAM_URL . 'inc/img/email.png" class="sc-social"/></a>';

            if ($phone != '')
                $content .= '<a href=tel:' . $phone . '><img src="' . SC_TEAM_URL . 'inc/img/phone.png" class="sc-social"/></a>';

            if ($website != '')
                $content .= '<a href=' . $website . '><img src="' . SC_TEAM_URL . 'inc/img/website.png" class="sc-social"/></a>';
        }
        return $content;
    }

    public function get_single_social( $social ) {
        
        if ( 'yes' == $this->options[ 'social' ] ) :
            if ( $social != '' )
                echo '<li><a href="' . $social . '"><img src="' . SC_TEAM_URL . 'inc/img/fb.png" class="sc-social"/></a></li>';

        endif;
        
    }

    public function sc_get_args( $group ) {
        $args = array(
            'post_type' => 'team_member',
            'meta_key' => 'sc_member_order',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'team_member_position' => $group,
            'posts_per_page' => $this->options[ 'member_count' ],
        );
        return $args;
    }

    public function smartcat_team_get_single_template( $single_template ) {
            
        global $post;

        if ( $post->post_type == 'team_member' && 'custom' == $this->options[ 'single_template' ] ) :

            if( file_exists( get_stylesheet_directory() . '/team_members_template.php')) :
                
                $single_template = get_stylesheet_directory() . '/team_members_template.php';
            
            else :
                
                $single_template = SC_TEAM_PATH . 'inc/template/team_members_template.php';
            
            endif;

        endif;

        return $single_template;
        
        
    }
    
    public function check_clicker( $single_template ){
        
        if ($single_template == 'disable') :
            return 'sc_team_single_disabled';

        endif;
        
        if ($this->options['single_template'] == 'disable') :
            return 'sc_team_single_disabled';
        endif;
        
    }


}

class smartcat_team_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'smartcat_team_widget', __( 'Our Team Sidebar Widget', 'smartcat_team_widget_domain' ), array( 'description' => __( 'Use this widget to display the Our Team anywhere on the site.', 'smartcat_team_widget_domain' ), )
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance[ 'title' ] );

        // before and after widget arguments are defined by themes
        echo $args[ 'before_widget' ];
        if ( !empty( $title ) )
            echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];

        // This is where you run the code and display the output
        include SC_TEAM_PATH . 'inc/template/widget.php';
        //        echo $args['after_title'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'Meet Our Team', 'smartcat_team_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="////<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="////<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance[ 'title' ] = (!empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
        return $instance;
    }

}
