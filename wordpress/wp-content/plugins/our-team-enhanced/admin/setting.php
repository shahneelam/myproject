<style>
    #gopro{
        width: 100%;
        display: block;
        clear: both;
        padding: 10px;
        margin: 10px 8px 15px 5px;
        border: 1px solid #e1e1e1;
        background: #464646;
        color: #ffffff;
        overflow: hidden;
    }
    #wrapper{
        border: 1px solid #f0f0f0;
        width: 95%;

    }
    #wrapper{
        border: 1px solid #f0f0f0;
        width: 95%;

    }
    table.widefat{
        margin-bottom: 15px;
    }
    table.widefat tr{
        transition: 0.3s all ease-in-out;
        -moz-transition: 0.3s all ease-in-out;
        -webkit-transition: 0.3s all ease-in-out;
    }
    table.widefat tr:hover{
        /*background: #E6E6E6;*/
    }

    #wrapper input[type='text']{
        width: 80%;
        transition: 0.3s all ease-in-out;
        -moz-transition: 0.3s all ease-in-out;
        -webkit-transition: 0.3s all ease-in-out;
    }
    #wrapper input[type='text']:focus{
        border: 1px solid #1784c9;
        box-shadow: 0 0 7px #1784c9;
        -moz-box-shadow: 0 0 5px #1784c9;
        -webkit-box-shadow: 0 0 5px #1784c9;
    }
    #wrapper input[type='text'].small-text{
        width: 20%;
    }
    .proversion{
        color: red;
        font-style: italic;
    }
    .choose-progress{
        display: none;
    }
    .sc_popup_mode{
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        position: relative;
        top: 2px;
        box-shadow: 0 0 3px #333;
        -moz-box-shadow: 0 0 3px #333;
        -webkit-box-shadow: 0 0 3px #333;
    }

    .sc_popup_mode_off{
        background: #F54412;
    }
    .sc_popup_mode_live{
        background: #84E11F;
    }
    .sc_popup_mode_test{
        background: #FF9717;
    }
    .left{ float: left;}
    .right {float: right;}
    .center{text-align: center;}
    .width70{ width: 70%;}
    .width25{ width: 25% !important;}
    .width50{ width: 50%;}
    .larger{ font-size: larger;}
    .bold{ font-weight: bold;}
    .editcursor{ cursor: text}
    .demo-table{
        
        
        
        overflow: hidden;
        
    }
    .demo-table .width50{
        width: 44%;
        padding: 20px;
        margin-right: 2%;
        background: #fff;
    }
    .demo-table img{
        width: 100%;
    }
</style>

<div id="wrapper">
    <div id="gopro">
        <div class="left">
            <h1><b style="color: #37BDF7">Our Team Settings</b></h1>
            <div><em>Why go pro?</em> 4 More templates including a uniue Honeycomb and Carouse. More features, and more control! <br>Professional, sleek and easily customizable Team page & widget with extra options!</div>
        </div>
        <div class="right">
            <a href="https://smartcatdesign.net/our-team-showcase-demo/" target="_blank" class="button-secondary" style="padding: 40px;line-height: 0;font-size: 20px">View Demo</a>
        </div>
        <div class="right" style="margin-right: 20px">
            <a href="https://smartcatdesign.net/downloads/our-team-showcase/" target="_blank" class="button-primary" style="padding: 40px;line-height: 0;font-size: 20px">GO PRO NOW</a>
        </div>
    </div>
    <div class="width25 right">
     
        
        <table class="widefat">
            <thead>
            <tr>
                <th><b>Quick Reference</b> </th>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li>- Image recommended size is 400x400 px. To achieve the best appearance, please ensure all team member images are the same size.</li>
                        <li>- To display the team members, add <b>[our-team]</b> shortcode in a widget, post or page</li>
                        <li>- To display members from a specific group, add <b>[our-team group="name of your group"]</b></li>
                        <li>- To override the template choice from the shortcode, add <b>[our-team template="grid"]</b> . Template Options: <em>grid, grid_circles, grid_circles2</em></li>
                        <li>- Click on Re-order to arrange the order of the team members</li>
                        <li>- Click on Groups to create groups, such as department names, team names</li>
                        <li>- Custom Single Template: Copy /inc/template/single-team_member.php into your theme root folder and edit it as you please. <a href="https://codex.wordpress.org/Post_Type_Templates" target="_BLANK">More Details</a></li>
                    </ul>
                    
                </td>
            </tr>
            </thead>
        </table>        
        
        <?php if( ! is_plugin_active( 'testimonials-reviews-showcase/our_testimonials_showcase.php') ) : ?>
<!--        <table class="widefat">
            <thead>
                <tr>
                    <th><b>Testimonials Showcase</b> </th>
                </tr>
            </thead>
            <tr>
                <td>Showcase your Testimonials & reviews with star ratings and professional design. Download </td>
            </tr>            
            <tr>
                <td>
                    <p>
                        <img src="https://s.w.org/plugins/testimonials-reviews-showcase/screenshot-2.jpg" style="width: 100%"/>
                    </p>
                </td>
            </tr>

            <tr class="center">
                
                <td>
                    <a class="button-primary" href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins&plugin_status=install' ); ?>" >Install Plugin</a>
                    <a class="button-secondary" href="https://wordpress.org/plugins/testimonials-reviews-showcase/screenshots/" target="_BLANK">Demo</a>
                
                </td>
            </tr>
            
        </table>-->
        <?php endif; ?>
        
        <table class="widefat">
            <thead>

            <tr>
                <td>
                    <p>If you come across any bugs or issues, please <strong><a href="https://smartcatdesign.net/faqs/" target="_blank">contact us</a></strong> and let us know</p>
                </td>
            </tr>
            </thead>
        </table>


    </div>