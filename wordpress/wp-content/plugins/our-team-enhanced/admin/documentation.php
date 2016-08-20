<script type="text/javascript">
    jQuery(document).ready(function ($) {

//  $("#nav").sticky({topSpacing:0});

        $('a[href^="#"]').on('click', function (e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 950, 'swing');
        });
    });


</script>
<style type="text/css">

    .sub-section {
        border: thin solid #91c6c0;
        border-radius: 15px;
        width: 80%;
        padding: 25px;
        margin-bottom: 15px;
    }

    div#wrapper {
        /*background: #ffffff;*/
        color: #313131;
        margin-top: 5px;
    }

    div#header {
        margin-right: 125px;
        background: #178dc4;
        border-radius: 0px 0px 50px 0px;
        padding: 20px;
        color: #fff;
    }

    div#main {
        height: 100%;
        background: blue;
    }

    div#nav {
        height: 100% !important;
        width: 15% !important;
        float: left !important;
    }

    div#content {
        float: right !important;
        width: 82% !important;
        /*background: #ffffff;*/
    }

    div#nav-sticky-wrapper {
        display: inline;
        margin-right: 0;
    }

    div#nav-sticky-wrapper.is-sticky {
        float: left;
    }

    p {
        padding-left: 25px;
        padding-right: 125px;
        padding-top: 10px;
        padding-bottom: 10px;
		font-size: 14px;
    }

    p.warning {
        color: #ff7777;
        font-style: italic;
    }

    div#header img#logo {
        float: left;
        width: 75px;
        padding-right: 15px;
    }


    h1#title{
        font-family: "Raleway", Verdana, sans-serif;
        font-weight: 100;
        font-size: 30px;    
    }
    h1#subtitle{

        font-size: 22px;
        font-weight: 100;
    }

    div#nav{
        border-right: 1px solid #f9f9f9;
        background: #DDDDDD;
    }
    h1.navheading{
        font-size: 14px;
        padding-top: 15px;
        margin-right: 0px;    
    }

    #nav ul {
        list-style: none;
        padding-left: 15px;
        padding-top: 10px;
    }

    #nav li {
        display: table;
        font-size: 14px;
        font-style: normal;
        background-color: #ffffff;
        color: #178dc4;
        width: 85%;
        border: thin solid #178dc4;
        border-radius: 5px;
        margin-bottom: 2px;
        text-align: center;
        min-height: 25px;
    }

    #nav li:hover {
        background-color: #178dc4;
        color: #ffffff;
        
        cursor: pointer;
    }
    #nav li:hover a{
        color: #fff;
    }
    a.navlink {
        font-size: 12px;
        color: #178dc4;
        text-decoration: none;
        display: table-cell;
        vertical-align: middle;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    ul {
        padding-left: 65px;
    }

    li {
        color: #91c6c0;
        /*font-style: italic;*/
        list-style: square;
    }

    footer {
        text-align: right;
        padding-right: 125px;
        padding-left: 25px;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    i.fa {
        padding-right: 5px;
    }    
    em.pro{
        margin-left: 5px;
        font-size: 14px;
        color: #CC0000;
        
    }
	
	em.tip{
		font-size: 15px;
		color: #0066ff;
	}
</style>

<div id="wrapper">
    <?php //if( ! $this->strap_pl() ) : exit( 'Please activate your license <a class="button-primary" href="' . admin_url( 'edit.php?post_type=team_member&page=smartcat_team_license' ) . '">Activate</a>' ); endif; ?>
    
    <div id="header">
        <img src="<?php echo SC_TEAM_URL ?>inc/img/smartcat_icon.png" alt="Smartcat" id="logo">
        <h1 id="title">Our Team Showcase</h1>
        <h1 id="subtitle">A WordPress Plugin by Smartcat</h1>
    </div>
    <div id="main">
        <div id="nav">

            <h1 class="navheading"><i class="fa fa-cube"></i>Setup</h1>
            <ul>
                <li><a href="#welcome" class="navlink">Welcome</a></li>
                <li><a href="#overview" class="navlink">Plugin Overview</a></li>
                <li><a href="#downloading" class="navlink">Downloading</a></li>
                <li><a href="#installing" class="navlink">Installation & Activation</a></li>
            </ul>
            <h1 class="navheading"><i class="fa fa-plug"></i>Plugin Usage</h1>
            <ul>	
                <li><a href="#include-sc" class="navlink">Including the Shortcode</a></li>
                <li><a href="#add-member" class="navlink">Adding & Configuring a Team Member Profile</a></li>
                <li><a href="#manage-members" class="navlink">Managing Team Members</a></li>
                <li><a href="#groups" class="navlink">Groups</a></li>
                <li><a href="#templates" class="navlink">Templates</a></li>
                <li><a href="#custom_templates" class="navlink">Custom Template</a></li>
                <li><a href="#view-settings" class="navlink">Settings Panel Quick Guide</a></li>
                <li><a href="#sidebar-widget" class="navlink">Sidebar Widget</a></li>
			</ul>
			<h1 class="navheading"><i class="fa fa-cube"></i>Member Login Portal</h1>
			<ul>
				<li><a href="#portal-about" class="navlink">About Member Login Portal</a></li>
				<li><a href="#portal-install" class="navlink">Installing & Configuring</a></li>
				<li><a href="#portal-settings" class="navlink">Member Login Portal Settings</a></li>
				<li><a href="#portal-email" class="navlink">Email Settings</a></li>
				<li><a href="#portal-extra" class="navlink">Extra Options</a></li>
				<li><a href="#portal-content" class="navlink">Restricting Content</a></li>
				<li><a href="#portal-profile" class="navlink">Profile Options</a></li>
				<li><a href="#portal-admin" class="navlink">Admin Options</a></li>
            </ul>
            <h1 class="navheading"><i class="fa fa-question-circle"></i>Miscellaneous</h1>
            <ul>	
                <li><a href="#faq" class="navlink">FAQ</a></li>
                <ul>
                    </div>
                    <div id="content">
                        <h2 id="welcome">Welcome!</h2>
                        <p>
                            This is the documentation for the 'Our Team Showcase' plugin, by Smartcat.
                            This document includes the details for both the free and the Pro versions of the plugin.
                            Items that only exist in the Pro version are indicated by the <em class="pro">PRO</em> sign. Our tips to improve your user experience with the plugin are indicated by <em class="tip">SMARTCAT TIPS</em>.
                        </p>

                        <h2 id="overview">Plugin Overview</h2>
                        <p>
                            Our Team Showcase lets you easily create, edit and display a team roster for your site, including employees, associates, or your websites's contributing authors. Displaying your team on a page is quick and easy, with simple short-codes, while a comprehensive settings menu lets you manipulate the plugin's behavior and appearance without any coding at all. Sort your team members into groups, to display all or some of them together on different parts of your site. The PRO version includes seven different team view layouts, as well as three single member view layouts.
                        </p>

                        <h2 id="downloading">Downloading</h2>
                        <p>
                            Upon purchase, you'll receive an email from Smartcat containing your receipt and a link
                            to download the plugin, 'Our Team Showcase Pro'. To start your download, click the link labelled
                            "smartcat_our_team". 
                        </p>

                        <h2 id="installing">Installion & Activation</h2>
                        <div class="sub-section">
                            <h3>Option One - Root Folder Installation</h3>
                            <p>
                                Double-click your "smartcat_our_team.zip" file download to decompress it. In the root folder of your WordPress install, navigate to  "wp-content" > "plugins". Now drag or copy the new, decompressed folder "smartcat_our_team" into it.
                                In your browser, reload your WordPress Dashboard and you will now see a menu item "Team".
                            </p>
                        </div>
                        <div class="sub-section">
                            <h3>Option Two - Upload To WordPress Dashboard</h3>
                            <p>
                                If you prefer to install the plugin directly through the WordPress Dashboard, leave the downloaded file in its
                                .zip format. From the WordPress Dashboard, select "Plugins" > "Add New" > "Upload Plugin", and you 
                                will be directed to a page that will let you upload the file. Simply navigate to and choose 
                                the "smartcat_our_team.zip" file, and select "Install Now". When the upload completes click "Activate." Reload your WordPress Dashboard and you will see a menu item "Team".
                            </p>
                        </div>
						<div class="sub-section">
                            <h3>License Activation <em class="pro">Pro Version</em></h3>
                            <p>
                                Once you've added your plugin files to WordPress, you'll need to activate it using your licence key. This can be found in on the email receipt that you received after purchase. If you've purchased a multiple or unlimited use licence, be sure to save the email with your licence key for future reference. 
                            </p>
                        </div>

                        <h2>Plugin Usage</h2>
                        <div class="sub-section" id="include-sc">
                            <h3>Including the [our-team] Shortcode</h3>
                            <p>
                                To display a team showcase on any page of your site, simply place the shortcode, "[our-team]" (without quotes) where you want it to appear within the page. 
                            </p>
                            <p>
                                You can also indicate a specific group to display, as well as override the settings for the full team and single member templates through the shortcode:
                            </p>
                            <p>
                                <strong>[our-team group="slug" template="grid" single_template="panel"]</strong>
								
                            </p>
							<p><em class="tip">SMARTCAT TIP</em> <i>The group "slug" can be viewed and edited from the plugin settings. Go to Team > Groups and select "Quick Edit" for the group you want to use. The slug should have no capital letters, and use understcores (group_slug) or dashes (group-slug) instead of spaces.</i></p>
							<p> Overriding your settings is useful when you want to display the showcase in different ways on different pages.</p>
                        </div>	
                        <div class="sub-section" id="add-member">
                            <h3>Adding & Configuring a Team Member Profile</h3>
                            <p>
                                To add a new Team member, Click "Add New" near the top of the menu in your WordPress dashboard. This will launch the Add New Member editor.
                                Enter the <b>name</b> of the person you are adding in the first box that asks you to enter a title.
                                The main content box can be used to provide a <b>brief biography</b> of the person, their work history, or a description of the role they play on the team.
                            </p>
								<p><em class="tip">SMARTCAT TIP</em> <i>Please note - if you're using the Stacked template, any HTML formatting you include in this text box will not be active in the preview, on page where the full team is displayed.</i></p>
                            <p>
                                Additional information, including a <b>Personal Quote, Job Title</b> and <b>Social Media Account Links</b> can be added in the section below the main content area.</p>
								<p><em class="tip">SMARTCAT TIP </em> <i>For best results, we recommend using no more than 5 social media links for a Circle Template, no more than 6 for a Grid template, and the Stacked template if you want to include 7 social media links or more.</i></p>
								<p>A small list of standout <b>Skills</b> or proficiencies can also be listed with a 1 - 10 rating of that competency. This will appear as a percentage bar on the Single Member View.</p>
								<p>Finally, in the third settings box, select up to three pages or posts you want to display on your Team Member's profile as <b>Featured Articles</b>. You can include a custom title for this area, or leave it blank. Be sure to select the "Show" or "Hide" radio button to activate this feature.</p>
								<p>You can also add a custom list of <b>Attributes</b>, with a custom title such as "Favourites" "Accreditation," "Specialties," etc.</p>
								<p><em class="tip">SMARTCAT TIP </em><i> Enter the attributes as a comma seperated list, eg: </i></p>
<p> <strong>Apples,Bananas,Oranges,Pears.</strong></p>
								<p>If you already have a <b>Group</b> created that you would like to add the member to, you may select it from this page.
                            </p>
                            <p>
                                Upload a <b>Featured Image</b> by clicking the corresponding link in the right-hand sidebar. This image will be used as the main portrait photo.</p>
								<p><em class="tip">SMARTCAT TIP </em> <i>For best results, use an image size of 300 x 300 pixels, or similar, with a 1:1 aspect ratio.</i>
                            </p>
                            
                            <!--<img style="width: 60%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/userdetails_demo.jpg"/>
                                             
                            
                            <h3>Member Details</h3>
                            <ul>
                                <li>Name</li>
                                <li>Featured Image</li>
                                <li>Bio</li>
                                <li>Groups</li>
                                <li>Title ( Job Title )</li>
                                <li>Email Address</li>
                                <li>Facebook</li>
                                <li>Twitter</li>
                                <li>LinkedIn</li>
                                <li>Google Plus</li>
                                <li>Personal Quote <em class="pro">Pro Version</em></li>                                
                                <li>Phone Number<em class="pro">Pro Version</em></li>
                            </ul>

                            <img style="width: 60%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/skills_demo.jpg"/>
                                                          
                            
                            <h3>Attributes / Skills / Ratings</h3>
                            <ul>
                                <li>Skill/Attribute Title<em class="pro">Pro Version</em></li>
                                <li>Skill/Attribute Rating<em class="pro">Pro Version</em></li>
                                
                            </ul>-->
                            
                            
                        </div>
                        <div class="sub-section" id="manage-members">
                            <h3>Managing Team Members</h3>
                            <p>
                                Select "Team" from your WordPress Dashboard to see a list of all team members. Once you have added a member,
                                you can edit their profile information clicking on their name, or selecting Edit while
                                hovering over it.
                            </p>
                            <p>
                                To change the order your team members appear in the Showcase, select "Reorder Members" from the main "Team" menu in your WordPress Dashboard. Simply drag and drop the member to the idea position.
                                Once the order is set, select Save Order.
                            </p>
                            <p>
                                To delete a team member from the showcase, hover over the name of the member, then
                                click the red "Trash" link. You will not be prompted to confirm your decision, but if you have made a mistake, you can  retrieve the deleted member. After a delete has been performed, a new link titled "Trash (x)" appears on your Team dashboard. Clicking that link to review the Trash items, and either "Restore" or "Delete Permanently".
                            </p>
                        </div>
                        <div class="sub-section" id="groups">
                            <h3>Groups</h3>
                            <p>
                                Our Team Showcase Pro allows you to divide your team into smaller sections based on projects, location or any other criteria you choose.
                            </p>
                            <p>
                                Creating a new Group for your team is easy, and there are two ways you can do it. The first option is to select the "Groups" option from the main "Team" sidebar menu, then enter a name for the Group and click the "Add New Group" button. Alternatively, if you are currently viewing a single team member, the "Groups" box on the right-hand side of the page has an "Add New Group" option. This fuctions similarly to the Categories box in a WordPress post.
                            </p>
                            <p>
                                Using the [our-team] shortcode will default to displaying all members regardless of Groups. If you would like to have a showcase that only includes members of a specific group, modify the shortcode to include the Group name.
                            </p>
                            <p>
                                Example: [our-team group="name of your group"]
                            </p>
                        </div>
                        <div class="sub-section" id="templates">
                            <h3>Team View Templates</h3>
							<p>To view the Template options for Our Team Showcase, visit the<a href="https://smartcatdesign.net/our-team-showcase-demo/" target="_blank"> Our Team Showcase Demo</a> page.</p>
							<p><em class="pro">Pro Version</em>   Please note that <b>Carousel, Honeycomb, Stacked</b> and <b>Directory</b> are only available in the Pro version.</p>
                           <!-- <h4>Grid - Boxes</h4>
                            <p>
                                Displays a grid based layout of team members, with rectangular edges.
                            </p>
                            
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/grid_demo.jpg"/>
                            <div class="clear"></div>                                  
                            
                            
                            <h4>Grid - Circles</h4>
                            <p>
                                Displays a grid based layout of team members, with circular edges. Name and Title appear overtop of the circular images.
                            </p>
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/circles2_demo.jpg"/>
                            <div class="clear"></div>                              
                            
                            
                            <h4>Grid - Circles Version 2</h4>
                            <p>
                                Displays a grid based layout of team members, with circular edges. Name and Title appear when the mouse hovers over the circular images.
                            </p>
                            
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/circles_demo.jpg"/>
                            <div class="clear"></div>                             
                            
                            <h4>List - Stacked <em class="pro">Pro Version</em></h4>
                            <p>
                                Displays a stacked list of each team member, with details such as Name, Title, Description, and Social Media links.
                            </p>
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/stacked_demo.jpg"/>
                            <div class="clear"></div>                             
                            
                            <h4>Honey Comb <em class="pro">Pro Version</em></h4>
                            <p>
                                Displays a honeycomb style layout, consisting of interconnected, hexagonally shaped images that can display information when hovered over.
                            </p>
                            
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/honeycomb_demo.jpg"/>
                            <div class="clear"></div>                                  
                            
                            <h4>Carousel <em class="pro">Pro Version</em></h4>
                            <p>Displays team members in a horizontally cycling carousel.</p>
                            
                            
                            
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/carousel_demo.jpg"/>
                            <div class="clear"></div>-->                          
                            
                            <h3>Setting a Template and Using Shortcodes</h3>
                            <p>
                                The default template, "Grid - Boxes", can be changed to one of several other options. Each one will display your team showcase in a different visual arrangement. To change the default template, select "Settings" under the "Team" menu, and select the desired template from the drop-down list.
                            </p>
                            <p>
                                If you wish to display the Showcase in more than one configuration on the site, you can also modify the shortcode to specify a different template for that version of output of the plugin.
                            </p>
                            <p>	
                                Example: [our-team template="grid"]
                            </p>
                            <p>
                                The short-code for the each template that can be placed within the quotes are: </p>
								<p><b>[our-team template="carousel"]<br>
								[our-team template="grid"]<br>
								[our-team template="grid_cirlces"]<br>
								[our-team template="grid_circles2"]<br>
								[our-team template="hc"]<br> 
								[our-team template="stacked"]<br> 
								[our-team template="directory"]</b>
								
                            </p>
                            
                            <h3>Single Member View Templates</h3>
                            <h4>Theme Default(Single Post)</h4>
                            <p>This will load the single member page based on your theme's single.php file</p>
                            
                            <h4>Custom Template</h4>
                            <p>This will load the single member page from a custom template file (team_members_template.php)</p>
                            
                            
                            <h4>Card Popup ( single_template="vcard" ) <em class="pro">Pro Version</em></h4>
                            <p>This will load a lightbox and the member details in a sliding box.</p>
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/card_demo.jpg"/>
                            <div class="clear"></div>                            
                            
                            
                            <h4>Side Panel ( single_template="panel" )<em class="pro">Pro Version</em></h4>
                            <p>Clicking on a member will slide in a panel that includes all their details in a very appealing design</p>
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/panel_demo.jpg"/>
                            <div class="clear"></div>
							
							<h4>Disabled ( single_template="disable" )</h4>
							<p>If you don't wish to include a full single profile for each Team Member, chose the "Disable" option. Your Showcase will display without active links to a Single Member View.</p>
                        </div>	
                        
                        
                        <div class="sub-section" id="custom_templates">
                            <h3>Custom templates <em class="pro">Pro Version</em> </h3>
                            <p>The plugin allows you to choose between several options for displaying single members. 
                            By default, the team member single page follows the theme's single.php file.
                            <br>
                            <br>
                            You can choose to use the custom template, which is included in the plugin. 
                            In the Team plugin Settings page, under Single Member View Settings, select Custom Template.
                            That tells the plugin to use the included custom template file.
                            <br>
                            <br>
                            
                            <h4>Overriding the Custom Template</h4>
                            <p>To override the file, do not edit it from the plugin. Instead, copy the file 
                            team_members_template.php ( found in <strong>/inc/template/team_members_template.php</strong> )
                            into your theme's root folder. You can then edit this file to your liking.
                            </p>
                            
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/custom_demo.jpg"/>
                            <div class="clear"></div>  
                            
                        </div>
                        
                        <h2 id="view-settings">Settings Panel Quick Guide</h2>
                        <div class="sub-section">
                            <h2>Team View</h2>
							<p>The following settings are accessible in the first section of the Settings Dashboard.</p>
							<h4>Carousel Time Speed:</h4>
							<p>If you're using the Carousel layout, adjust the speed that it auto-rotates at from here. If you want to disable the auto-rotate completely, type the word "false".</p>
                            <h4>Grid Columns:</h4>
                            <p>Specify the number of columns per row of members.</p>

                            <h4>Margin:</h4>
                            <p>Specify the amount of space between each column in a row.</p>
                            <h4>Display Social Icons:</h4>
                            <p>Toggles whether social icons are displayed over the featured images for each member.</p>
                            <h4>Social Icons Links</h4>
                            <p>Specify if you want the social icon links to open in the same page, or in a new page</p>
                            <h4>Social Links Style</h4>
                            <p>Specify if you want to use round colored icons, or flat icons</p>
                            <h4>Display Name:</h4>
                            <p>Toggles whether the member names are displayed over the featured images.</p>
                            <h4>Display Title:</h4>
                            <p>Toggles whether the member's job titles are displayed over the featured images.</p>
                            <h4>Name Font Size: <em class="pro">Pro version</em></h4>
                            <p>Set the font size in pixels. Specify the number value here</p>
                            <h4>Title Font Size: <em class="pro">Pro version</em></h4>
                            <p>Set the font size in pixels. Specify the number value here</p>
                            <h4>Number of members to display:</h4>
                            <p>Specify a limit to the number of displayed members, or -1 to show all members.</p>
                            <h4>Main Color:</h4>
                            <p>Specify the main color, used as the background for member name and job title text.</p>
                            <h4>[ HONEY COMB TEMPLATE ONLY ] Honey Comb Color:<em class="pro">Pro version</em></h4>
                            <p> Specify the color used as the overlay for honey comb shape.</p>
                            
							<h3>Single Member View</h3>
							<p>The following settings are accessible in the second section of the Settings Dashboard:</p>
                            <h4>Template:</h4>
                            <p>
                                This option will set the way that a single member is displayed when selected from the showcase. "Card (pop-up)" displays an index card style display of a single member. A custom template may also be selected from the drop-down menu. The custom template should be a file located in "/inc/template/team_members_template.php".
                            </p>
							<h4>Card Margin from Top <em class="pro">Pro Version</em></h4>
							<p>Set the distance of the Single Member view Card Pop-Up from the top of your site. The default is 100 px. This helps avoid rendering errors when a drop-down menu or sticky header overlap with the card.</p>
							<h4>Panel Margin from Top <em class="pro">Pro Version</em></h4>
							<p>Set the distance between the top of the Side Panel from the top of your page. The default is 0px. This helps work around display issues when a sticky header at the top of your site is covering the "X" close button or other features at the top of the Side Panel.</p>
                            <h4>Display Social Icons: <em class="pro">Pro Version</em></h4>
                            <p>
                                Toggles whether social icons are displayed when viewing an individual team member.
                            </p>
                           
                            <h4>Image Style:<em class="pro">Pro version</em></h4>
                            <p>
                                Specifies whether the featured image should have a round or rectangular border, when viewing an individual team member.
                            </p>
                            
							<h3>Staff Directory Options</h3>
							<p>If you're using the Staff Directory template, these settings help you modify the display. Each of the three columns after Name - Title, Group, and Phone Number - can be disabled and renamed from this settings box. </p>
							<p>Select "Yes" to include a field, or "No" to disable it. Put the Title that you want for that column in the text field below the Yes / No radio buttons.</p>
                        </div>
                        
                        <div class="sub-section" id="sidebar-widget">
                            <h3>Sidebar Widget</h3>
                            <p>
                                The plugin comes with an easy to use widget designed for appearing in your site Sidebar.
                                Go to Appearance - Widgets and find the widget titled "Our Team Sidebar Widget".
                                
                            </p>
                            <p>
                                You can drag & drop the widget into any widget placeholder
                            </p>
                            <img style="width: 40%; float: right" src="<?php echo SC_TEAM_URL ?>inc/img/sidebar_demo.jpg"/>
                            <div class="clear"></div>                             
                            
                        </div>
						
						<h2 id="portal">Member Login Portal Extension</h2>
						<div class="sub-section">
						<h3 id="portal-about">About the Member Login Portal</h3>
						<p>You can now </strong> add Member-Only pages and posts</strong> to your WordPress site, with the addition of the Member Login Portal. Your Our Team Showcase Team Members can login to a custom dashboard to view edit their basic profiles, and view restricted content.</p>
						<p>This plugin is ideal for web site administrators that want to share:</p>
							<ul>
								<li>Company best-practices</li>
								<li>How-tos</li>
								<li>Event news</li>
								<li>Policy updates</li>
							</ul>
						<p>and more, with their staff, associates or contributing authors.</p>
						<p>Content can be restricted to <b>specific groups of Team Members</b> within the plugin; allowing you to create and post content for a group of Members that might not even be displayed on the front-end of your site.</p>
						</div>
						
						<div class="sub-section">
						<h3 id="portal-install">Installing & Configuring the Member Portal</h3>
						<p>The Member Login Portal extension is a plugin that you can download <a href="https://smartcatdesign.net/downloads/member-login-portal/" target="_blank"> from the Smartcat site,</a> under Products. Add it to your WordPress site by following the same installation and activation instructions included here for Our Team Showcase.</p>
						<p>When the Portal is installed and activated on a WordPress site, the Pages "Login", "Logout" and "Profile" will automatically be created on your site. The urls for these pages are listed at the top of the main Portal Page, under "Portal Pages". </p>
						</div>
						<div class="sub-section">
						<h3 id="portal-settings">Member Login Portal Settings</h3>
						<p>The main settings for the Member Login Portal are found in the Team menu, on your WordPress Dashbaord. Click "Portal" at the bottom of the sub-menu to access these settings.</p>
							<h4>Login Redirect Destination:</h4>
							<p>Select the page users will be redirected to when they click "Login"
							<h4>Un-authorized Redirect Destination:</h4>
							<p>Choose the page a user will be reidrected to if they do not have access to a page or post.</p>
							<h4>Wrong Group Redirect Destination:</h4>
							<p>Choose the page a user will be redirected to when they try to access content assigned to another group.</p>
							<h4>Portal Logo Image:</h4>
							<p>Paste the link to your logo media file from your WordPress Media directory. </p>
						
						</div>
						<div class="sub-section">
						<h3 id="portal-email">Email Settings</h3>
						<p>This is the setting for the admin emails that will be sent to registrants for your Member Login Portal. Set the name and the address users will see when they receive an automated message from the Member Portal. (Sender Name, Sender Email Address.)</p>
						<p>Add copy for the automated Welcome Email for new Members, as well as for the Password Reset Email.</p> 
						</div>
						<div class="sub-section">
						<h3 id="portal-extra">Extra Options</h3>
						<p>Set the Welcome Message for your Team Member Portal. This text appears prominantly at the top of the Team Member's Dashboard when they first login. Example: "Welcome to Smartcat's Team Area! Here, you'll find everything you need to be a successful WordPress developer with Smartcat!"</p>
						</div>
						<div class="sub-section">
						<h3 id="portal-content">Restricting Content to Members Only</h3>
						<p>Content is restricted to groups on a per-page basis. Once the Member Login Portal is activated, a new box appears in Editing area for each Page and Post, below the box for page or post. The site admin can select groups of Team Members to access that content. The default for published content that isn't selected is to remain public. </p>
						<h3>Content Protection & Permissions</h3>
						<p>Select "Yes" if you want to protect the content (make it visible to members only); or, select "No" if you want the content to be visible to the general public.</p>
						<h3>Allow Access To</h3>
						<p>If you chose "Yes," next select either "All logged in Members" or "Selected Groups"</p>
						<h3>Selected Team Member Groups</h3>
						<p> A list of the Groups you've created using the Our Team Showcase Plugin will appear here. If you chose "Selected Groups" above, click one or several of the groups you'd like to be able to view this content.</p>
						<p>Click "Update" to save your changes.</p>
						</div>
						<div class="sub-section">
						<h3 id="portal-profile">Team Member Profile Options</h3>
						<p>When an Our Team Showcase Team Member logs in to the Member Portal, they'll arrive on the Member Portal dashboard. Their restircted Pages appear in the left-hand dashboard below their picture. Their restricted posts appear in the main body of the page. They can browse these posts by category.</p>
						<p>A team member can also update their settings by clicking "Profile." </p>
						<p><em class="tip">SMARTCAT TIP</em> <i>Any changes they make to their Member Login Portal profile will also appear in the Our Team Showcase plugin on your site.</i></p>
						<p>Team Members can edit their Profile image, Name, Job Title, Bio, and Social Links.</p>
						<p>Team Members can also manage their passwords for the Team Member Portal.</p>
						<p>To view the public side of the webiste, while remaining logged in, Team Members simply need to click the "Public Site" icon, below their image.</p>

						<h3 id="portal-admin">Team Member Profile Admin Settings</h3>
						<p>Once the Portal is activated on your site, a new box appears on the editing page for an individual Team Member, called "Team Portal". To grant a team member access to the Portal, select the "Active" button for Team Member Status. To Deactivate a user, select "Inactive." </p>
						<p>The email address associated with their Team Member Profile will auto-populate as their Email Address.</p>
						<p>If you want to reset the Team Members password, enter a new password and click "Update" to save. This will override the password sent to them when they register.</p>
						</div>

                        <h2 id="faq">Frequently Asked Questions</h2>
                        
                        <div class="sub-section">
                            <h3>What is the recommended Image size for the team members ?</h3>
                            <p>Image size should be 400x400, however you can also use 300x300. Make sure all your images are the same size</p>
                        </div>                        
                        
                        
                        <div class="sub-section">
                            <h3>I can't add a featured image to the team member</h3>
                            <p>The ability to add Featured Images is supported in the plugin, however the way that WordPress Works, the Theme you are using needs to also allow for featured images to be used.

                                Most themes usually allow for featured images, some themes restrict it to single post types, and not custom-post-types.

                                In order to fix this issue, please edit your theme’s functions.php file and add this code to it:</p>
                            <p>
                                <code>function my_custom_theme_setup() {
                                        add_theme_support('post-thumbnails')
                                      }
                                      add_action( 'after_setup_theme', 'my_custom_theme_setup' );
                                </code>
                            </p>
                        </div>

                        <div class="sub-section">
                            <h3>How do I remove the "posted on (date)" from the single member view ?</h3>
                            <p>The date usually comes from your theme's single.php file. If you remove the code snippet from your single.php file,
                            the date will also be removed from your Posts.</p>
                            <p>Alternatively, you can use the Custom Template included in the plugin, which you can select from the plugin settings</p>
							
                        </div>
						<div class="sub-section">
                            <h3>What if I don't want a Single Member View at all?</h3>
                            <p>From the "Single Member View" settings, you have the options to select "Disable" for Single Member View. The showcase will now display with no active link to a Single Member profile on the Team Member's page.</p>
                        </div>                        

                        <footer>Copyright © <a href="http://smartcat.ca">Smartcat</a></footer>
                    </div>
                    </div>
                    </div>