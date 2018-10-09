<?php
 /**
 * Plugin Name:  Team WD
 * Plugin URI: https://web-dorado.com/products/wordpress-team-wd.html
 * Description:  Team WD is a WordPress team list plugin with large and affecting capabilities which helps you to display information about the group of people more intelligible, effective and convenient.  Team WD’s main feature is the possibility to create and manage your own list of different contacts with corresponding images, data and with a feedback option.
 * Version: 1.0.9
 * Author:          WebDorado
 * Author URI:      https://web-dorado.com
 * License:  GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

define ('SC_FILE' , __FILE__);
define ('SC_DIR',dirname(__FILE__));
define ('SC_URL',plugins_url(plugin_basename(dirname(__FILE__))));
require_once('SContClass.php');
add_action( 'plugins_loaded', array( 'SContClass', 'getInstance' ) );
include_once dirname( __FILE__ ) . '/includes/SCDemo.php';
register_activation_hook( __FILE__, array( 'SCDemo', 'installDemoData' ) );
if(is_admin()){
	require_once('SContAdminClass.php');
	$cont_admin = SContAdminClass::getInstance();
}

register_activation_hook( __FILE__,  array( 'SContAdminClass', 'contActivate' ));
//team-staff
?>