<?php
/**
 * @package Server_Status
 * @version 3.0
 */
/*
Plugin Name: Server Status by Hostname/IP
Plugin URI: http://xpertsol.org/server-status-by-hostnameip/
Description: Server Status Plugin is made for those who wish to publish their Server and Services Status. 
Version: 3.0
Author: Xpert Solution
Author URI: http://xpertsol.org/
*/

add_action('admin_menu', 'sship_server_status');
register_activation_hook( __FILE__, 'sship_ss_install' );
add_action( 'plugins_loaded', 'sship_myplugin_update_db_check' );
add_shortcode( 'check_status' , 'sship_check_status' );
add_action( 'widgets_init', 'sship_register_ss_widget' );

// register Foo_Widget widget
function sship_register_ss_widget() {
    register_widget( 'sship_server_status_widget' );
}

global $ss_db_version;
$ss_db_version = '1.0';

function sship_ss_install() {
	global $wpdb;
	global $ss_db_version;

	$table_name = $wpdb->prefix . 'server_status';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		port tinytext NOT NULL,
		server text NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'ss_db_version', $ss_db_version );
}



function sship_myplugin_update_db_check() {
    global $ss_db_version;
    if ( get_site_option( 'ss_db_version' ) != $ss_db_version ) {
        sship_ss_install();
    }
}


function sship_server_status(){
        add_menu_page( 'Server Status', 'All Servers', 'manage_options', 'all-servers', 'sship_server_listing');

add_submenu_page ( 'all-servers', 'Add Server', 'Add Server', 'manage_options', 'add-server', 'sship_add_server' );
add_submenu_page ( 'all-servers', 'Server Load', 'Server Load', 'manage_options', 'load-sship-server', 'sship_server_load' );
add_submenu_page ( 'all-servers', 'About', 'About', 'manage_options', 'about-sship-plugin', 'sship_about_plugin' );

}

function sship_server_listing(){
	if ( !is_admin( ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

echo header_pages();

?>


<h1>Server Listing<h1>

<table class="table-fill"> 

<tr>
<th>Server</th><th>Port</th><th>Status</th><th>ID</th><th>Action</th>
</tr>

<?php



global $wpdb;

if($_REQUEST['delete'] == 1 )
{
 
$wpdb->delete( $wpdb->prefix . "server_status", array( 'id' => $_REQUEST['id'] ) );

}






$servers = $wpdb->get_results( 
	"
	SELECT * 
	FROM ".$wpdb->prefix . "server_status"
);

if(empty($servers[0]) )
{
	echo '<h3 align="center">No Servers Added.</h3>';
	
}

foreach ( $servers as $server ) 
{

	$iphost = $server->server;
	$port = $server->port;
	$id = $server->id;
		
	$action = '<a href="?page=all-servers&id='.$id.'&delete=1" onclick=" return delete_confirm();">Delete</a>';


	$status =  sship_GetServerStatus($iphost,$port);
	if($status == 'ONLINE')
	{
		$col = '#3C0';
		
	}
	else
	{
		$col = '#F00';
		
	}

?>
<tr>
<td><?php echo $iphost; ?></td><td><?php echo $port; ?></td><td style="color:<?php echo $col; ?>;"><?php echo $status; ?></td><td><?php echo $id; ?></td><td><?php echo $action; ?></td>
</tr>
<?php
}
?>
</table>

</p>



<?php

}



function sship_GetServerStatus($site, $port)
{
$status = array("OFFLINE", "ONLINE");
$fp = @fsockopen($site, $port, $errno, $errstr, 2);
if (!$fp) {
    return $status[0];
} else 
  { return $status[1];}
}


function sship_add_server()
{

if($_GET['action'] == 'add_server')
{
	
global $wpdb;

$iphost = $_POST['iphost'];
$port = $_POST['port'];

if(empty($port))
{
	$port = '80';
	
}

  
 $wpdb->insert( 
	$wpdb->prefix . 'server_status', 
	array( 
		'server' => $iphost , 
		'port' => $port 
		)
);

$msg = 'Server Added Successfully.';





}

echo header_pages();
?>
<h1>Add Server</h1>

<h2 align="center"> Please enter the server details below</h2>


<form action="?page=add-server&action=add_server" method="post" class="form-style-7">
<h2><?php echo $msg; ?></h2>
<table class="table-fill">
<tr>
<td class="text-left">Server IP/Hostname:</td> <td class="text-left">
<li><input type="text" name="iphost"  required="required"/>
    <span>Enter your Server's Hostname or IP</span>
    </li>
</td>
</tr>
<tr>
<td class="text-left">Port:</td> <td class="text-left">
<li>
<input type="text" name="port"  />
    <span>Enter Port or leave blank for 80</span>
    </li>
    
</td>
</tr>

<tr>
<td class="text-left"></td> <td class="text-left">
<li>
<input type="submit" value="Add Server" /> <input type="reset" value="Reset"  /></td>
</li>
</tr>


</table>
</form>
<br />
<br />

<?php
echo footer_pages();
}


function sship_check_status($atts)
{
	$a = shortcode_atts( array(
        'id' => 'id',
    ), $atts );

global $wpdb;
$servers = $wpdb->get_results( 
	"
	SELECT * 
	FROM ".$wpdb->prefix . "server_status where id=".$a['id']
);


foreach($servers as $server)
{
	$iphost = $server->server;
	$port = $server->port;
	$id = $server->id;
		
	$status =  sship_GetServerStatus($iphost,$port);
	if($status == 'ONLINE')
	{
		$col = '#3C0';
		$img = '<img style="float:left;" src="'. plugin_dir_url( __FILE__ ) .'images/online.png"  />';
		
	}
	else
	{
		$col = '#F00';
		$img = '<img style="float:left;" src="' .  plugin_dir_url( __FILE__ )  .'images/offline.png"   />';
	}
	
}
	?>
    
    <h3 style="color:<?php echo $col; ?> !important;"><?php echo $img; ?> &nbsp;<?php echo $iphost; ?>:<?php echo $port; ?></h3>


    <?php
	
}
	
	
	
	/**
 * Adds Foo_Widget widget.
 */
class sship_server_status_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'foo_widget', // Base ID
			__( 'Server Status', 'title' ), // Name
			array( 'description' => __( 'Display Server Status in Widget', 'desc' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
	
		

        echo sship_check_status_widget($instance['id']);
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Server Status', 'text_domain' );
		$id = ! empty( $instance['id'] ) ? $instance['id'] : __( '', 'id' );

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">

		<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'ID:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" type="text" value="<?php echo esc_attr( $id ); ?>">


		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['id'] = ( ! empty( $new_instance['id'] ) ) ? strip_tags( $new_instance['id'] ) : '';
		return $instance;
	}

} // class Foo_Widget

function sship_check_status_widget($atts)
{
	$a = shortcode_atts( array(
        'id' => 'id',
    ), $atts );

global $wpdb;
$servers = $wpdb->get_results( 
	"
	SELECT * 
	FROM ".$wpdb->prefix . "server_status where id=".$atts[0]
);


foreach($servers as $server)
{
	$iphost = $server->server;
	$port = $server->port;
	$id = $server->id;
		
	$status =  sship_GetServerStatus($iphost,$port);
	if($status == 'ONLINE')
	{
		$col = '#3C0';
		$img = '<img style="float:left; " src="'. plugin_dir_url( __FILE__ ) .'images/online.png" width="25"  />';
	}
	else
	{
		$col = '#F00';
		$img = '<img style="float:left; " src="'. plugin_dir_url( __FILE__ ) .'images/offline.png" width="25"  />';
	}
	
}
	?>
    
    <h3 style="color:<?php echo $col; ?> !important;"> <?php echo $img; ?>&nbsp;<?php echo $iphost; ?>:<?php echo $port; ?></h3>
    
    <?php
	
}


function sship_server_load(){


		echo '<h1>Server Load</h1>';



if ( !function_exists('sys_getloadavg') )
{
	
	//    header("Content-Type: text/plain");

    function _getServerLoadLinuxData()
    {
        if (is_readable("/proc/stat"))
        {
            $stats = @file_get_contents("/proc/stat");

            if ($stats !== false)
            {
                // Remove double spaces to make it easier to extract values with explode()
                $stats = preg_replace("/[[:blank:]]+/", " ", $stats);

                // Separate lines
                $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                $stats = explode("\n", $stats);

                // Separate values and find line for main CPU load
                foreach ($stats as $statLine)
                {
                    $statLineData = explode(" ", trim($statLine));

                    // Found!
                    if
                    (
                        (count($statLineData) >= 5) &&
                        ($statLineData[0] == "cpu")
                    )
                    {
                        return array(
                            $statLineData[1],
                            $statLineData[2],
                            $statLineData[3],
                            $statLineData[4],
                        );
                    }
                }
            }
        }

        return null;
    }

    // Returns server load in percent (just number, without percent sign)
    function getServerLoad()
    {
        $load = null;

        if (stristr(PHP_OS, "win"))
        {
            $cmd = "wmic cpu get loadpercentage /all";
            @exec($cmd, $output);

            if ($output)
            {
                foreach ($output as $line)
                {
                    if ($line && preg_match("/^[0-9]+\$/", $line))
                    {
                        $load = $line;
                        break;
                    }
                }
            }
        }
        else
        {
            if (is_readable("/proc/stat"))
            {
                // Collect 2 samples - each with 1 second period
                // See: https://de.wikipedia.org/wiki/Load#Der_Load_Average_auf_Unix-Systemen
                $statData1 = _getServerLoadLinuxData();
                sleep(1);
                $statData2 = _getServerLoadLinuxData();

                if
                (
                    (!is_null($statData1)) &&
                    (!is_null($statData2))
                )
                {
                    // Get difference
                    $statData2[0] -= $statData1[0];
                    $statData2[1] -= $statData1[1];
                    $statData2[2] -= $statData1[2];
                    $statData2[3] -= $statData1[3];

                    // Sum up the 4 values for User, Nice, System and Idle and calculate
                    // the percentage of idle time (which is part of the 4 values!)
                    $cpuTime = $statData2[0] + $statData2[1] + $statData2[2] + $statData2[3];

                    // Invert percentage to get CPU time, not idle time
                    $load = 100 - ($statData2[3] * 100 / $cpuTime);
                }
            }
        }

        return $load;
    }

    //----------------------------

    $cpuLoad = getServerLoad();
    if (is_null($cpuLoad)) {
        echo "CPU load not estimateable (maybe too old Windows or missing rights at Windows)";
    }
    else {
		
		echo header_pages();
		
		?>
        
        
        <h2 align="center">Opreating System</h2>
        <center>
        <img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/windows.png" width="300"  />
     	<br />
		<br />
        </center>
        <h2 align="center">CPU LOAD</h2>
        <center>
        <h1><?php echo $cpuLoad . "%";  ?></h1>
        <br />
<br />
<br />
<br />
*We don't have much enhanced results for windows servers yet.
        
        </center>        
        
    
    <?php
    }




}
else
{

function getServerLoad($windows = false){
    $os=strtolower(PHP_OS);
    if(strpos($os, 'win') === false){
        if(file_exists('/proc/loadavg')){
            $load = file_get_contents('/proc/loadavg');
            $load = explode(' ', $load, 1);
            $load = $load[0];
        }elseif(function_exists('shell_exec')){
            $load = explode(' ', `uptime`);
            $load = $load[count($load)-1];
        }else{
            return false;
        }

        if(function_exists('shell_exec'))
            $cpu_count = shell_exec('cat /proc/cpuinfo | grep processor | wc -l');        

        return array('load'=>$load, 'procs'=>$cpu_count);
    }elseif($windows){
        if(class_exists('COM')){
            $wmi=new COM('WinMgmts:\\\\.');
            $cpus=$wmi->InstancesOf('Win32_Processor');
            $load=0;
            $cpu_count=0;
            if(version_compare('4.50.0', PHP_VERSION) == 1){
                while($cpu = $cpus->Next()){
                    $load += $cpu->LoadPercentage;
                    $cpu_count++;
                }
            }else{
                foreach($cpus as $cpu){
                    $load += $cpu->LoadPercentage;
                    $cpu_count++;
                }
            }
            return array('load'=>$load, 'procs'=>$cpu_count);
        }
        return false;
    }
    return false;
}


$loadinfo =  getServerLoad();

$loadinfoval = explode( ' ', $loadinfo['load'] );

echo header_pages();
?>




        <h2 align="center">Opreating System</h2>
        <center>
        <img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/linux.png" width="300"  />
     	<br />
		<br />
        </center>

<h2 align="center">Server's Load average over the last </h2>

<table class="table-fill">
<tbody class="table-hover">
<tr>
<td class="text-left">1 Min</td>
<td class="text-left"><?php echo $loadinfoval[0]; ?></td>
</tr>
<tr>
<td class="text-left">5 Min</td>
<td class="text-left"><?php echo $loadinfoval[1]; ?></td>
</tr>
<tr>
<td class="text-left">10 Min</td>
<td class="text-left"><?php echo $loadinfoval[2]; ?></td>
</tr>
<tr>
<td class="text-left">No. of Processers</td>
<td class="text-left"><?php echo $loadinfo['procs']; ?></td>
</tr>
</tbody>

</table>


<?php	
}
	
	
		echo footer_pages();

	
}


function header_pages()
{
	
	?>
<script>
	<?php
    
	include 'scripts.js';
	
    
    ?>
	</script>
    <style>
@import url(http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

body {
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 16px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}

div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}

.table-title h3 {
   color: #fafafa;
   font-size: 30px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}


/*** Table Styles **/

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:23px;
  font-weight: 100;
  padding:24px;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
  border-bottom: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:20px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}

.form-style-7{
    margin:50px auto;
    border-radius:2px;
    padding:20px;
    font-family: Georgia, "Times New Roman", Times, serif;
}
.form-style-7 h1{
    display: block;
    text-align: center;
    padding: 0;
    margin: 0px 0px 20px 0px;
    color: #5C5C5C;
    font-size:x-large;
}
.form-style-7 ul{
    list-style:none;
    padding:0;
    margin:0;   
}
.form-style-7 li{
    display: block;
    padding: 9px;
    border:1px solid #DDDDDD;
    margin-bottom: 30px;
    border-radius: 3px;
}
.form-style-7 li:last-child{
    border:none;
    margin-bottom: 0px;
    text-align: center;
}
.form-style-7 li > label{
    display: block;
    float: left;
    margin-top: -19px;
    background: #FFFFFF;
    height: 14px;
    padding: 2px 5px 2px 5px;
    color: #B9B9B9;
    font-size: 14px;
    overflow: hidden;
    font-family: Arial, Helvetica, sans-serif;
}
.form-style-7 input[type="text"],
.form-style-7 input[type="date"],
.form-style-7 input[type="datetime"],
.form-style-7 input[type="email"],
.form-style-7 input[type="number"],
.form-style-7 input[type="search"],
.form-style-7 input[type="time"],
.form-style-7 input[type="url"],
.form-style-7 input[type="password"],
.form-style-7 textarea,
.form-style-7 select 
{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 100%;
    display: block;
    outline: none;
    border: 1px solid #999;
    height: 40px;
    line-height: 35px;
    font-size: 18px;
    padding: 10px;
    font-family: Georgia, "Times New Roman", Times, serif;
}
.form-style-7 input[type="text"]:focus,
.form-style-7 input[type="date"]:focus,
.form-style-7 input[type="datetime"]:focus,
.form-style-7 input[type="email"]:focus,
.form-style-7 input[type="number"]:focus,
.form-style-7 input[type="search"]:focus,
.form-style-7 input[type="time"]:focus,
.form-style-7 input[type="url"]:focus,
.form-style-7 input[type="password"]:focus,
.form-style-7 textarea:focus,
.form-style-7 select:focus 
{
}
.form-style-7 li > span{
    background: #F3F3F3;
    display: block;
    padding: 3px;
    text-align: center;
    color: #000;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
}
.form-style-7 textarea{
    resize:none;
}
.form-style-7 input[type="submit"],
.form-style-7 input[type="button"],
.form-style-7 input[type="reset"] {
    background: #2471FF;
    border: none;
    padding: 10px 20px 10px 20px;
    border-bottom: 3px solid #5994FF;
    border-radius: 3px;
    color: #D2E2FF;
}
.form-style-7 input[type="submit"]:hover ,
.form-style-7 input[type="button"]:hover ,
.form-style-7 input[type="reset"]:hover 
{
    background: #6B9FFF;
    color:#fff;
	    border: none;
    padding: 10px 20px 10px 20px;
    border-bottom: 3px solid #5994FF;
    border-radius: 3px;

}


</style>
    
    
    <?php
	
	
}


function footer_pages()
{
	?>
    <p align="right">
    <br />
	<br />
	<br />
	<br />
<a href="http://xpertsol.org" target="new">
    <img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/logo.png" width="150"  />
    </a>
    <br />

	This Plugin is powered by <a href="http://xpertsol.org" target="new">Xpert Solution</a>
	</p>
	<?php
	
	
}



function sship_about_plugin()
{
	?>
    <h1>About Server Status</h1>
    For any queries contact us @ support@xpertsol.org<br />
 We would appreciate if you report any bugs or send us improvement suggestions.
<br />
    
    <h2>How to Use ?</h2>
    <p>
    - You can add a shortcode [check_status id=(Server ID)]
    <br />
    - You can also add a widget from Appearence > Widgets to add widget in any sidebar.
    </p>
    <br />

    <?php
	echo footer_pages();
	
}