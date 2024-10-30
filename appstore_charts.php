<?php
/*
Plugin Name: iTunes Charts Affiliate Widget
Plugin URI: http://www.59-media.de/wordpress-plugin-itunes-appstore-charts/
Description: iTunes Charts Affiliate Widget is a free full configurable widget to display the current download charts from the iTunes Store. Tradedoubler and LinkShare Affiliates can earn up to 5% per sale!
Version: 2.2.1
Author: Hauke Leweling
Author URI: http://www.59-media.de
Min WP Version: 2.7.0
*/

define('ITUNES_CHARTS_VERSION', '2.2.0');

if(!function_exists ('is_admin') ) 
{
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

require_once("lib/itunes.rss.class.php");
require_once("lib/custom.layout.class.php");
require_once("lib/default.layout.class.php");
require_once("lib/affiliate.network.class.php");
require_once("lib/itunescharts.upgrade.class.php");

add_action("widgets_init", array('itunescharts_widget', 'register'));
add_action("widgets_init", array('itunescharts_widget', 'update_contents'));
add_action("admin_menu", array('itunescharts_widget', 'itunes_appstorecharts_add_menu'));

register_activation_hook( __FILE__, array('itunescharts_widget', 'activate'));
register_deactivation_hook( __FILE__, array('itunescharts_widget', 'deactivate'));

if (strpos($_SERVER['REQUEST_URI'], 'appstore_charts.php' ) == true) 
{
	add_action('admin_init', array('itunescharts_widget', 'add_jquery'));
	add_action('admin_init', array('itunescharts_widget', 'update'));
}
	
class itunescharts_widget 
{
    function __construct()
    {

    }

	function control()
	{
		echo "Configuration is stored under Settings";
	}
	
	function register()
	{
    	wp_register_sidebar_widget('itunes_appstore_charts', 'iTunes Charts', array('itunescharts_widget', 'widget'));
	}
	
	function activate()
	{
		add_option("iteneschartswidget_version", 				ITUNES_CHARTS_VERSION);
		add_option("ituneschartswidget_lastrefresh",			"0");
		add_option("ituneschartswidget_content",				"");
		add_option("ituneschartswidget_chart_country",			"US");
		add_option("ituneschartswidget_chart_limit",			"10");
		add_option("ituneschartswidget_chart_type",				"toppaidapplications");
		add_option("ituneschartswidget_chart_section", 			"");
		add_option("ituneschartswidget_chart_category",			"");
		add_option("ituneschartswidget_layout_link_categories", "true");
		add_option("ituneschartswidget_layout_imagesize", 		"53");
		add_option("ituneschartswidget_layout_type", 			"STANDARD");
		add_option("ituneschartswidget_layout_custom_template", "");
		add_option("ituneschartswidget_widget_title", 			"iTunes Charts");
		add_option("ituneschartswidget_affiliate_network", 		"TRADEDOUBLER_DE");
		add_option("ituneschartswidget_affiliate_active", 		"true");
		add_option("ituneschartswidget_affiliate_id",			"1811869");
	}
	function deactivate()
	{
		delete_option("ituneschartswidget_lastrefresh");
		delete_option("ituneschartswidget_content");
		delete_option("ituneschartswidget_chart_country");
		delete_option("ituneschartswidget_chart_limit");
		delete_option("ituneschartswidget_chart_type");
		delete_option("ituneschartswidget_affiliate_id");
		delete_option("ituneschartswidget_layout_link_categories");
		delete_option("ituneschartswidget_layout_imagesize");
		delete_option("ituneschartswidget_layout_type");
		delete_option("ituneschartswidget_chart_section");
		delete_option("ituneschartswidget_chart_category");
		delete_option("ituneschartswidget_widget_title");
		delete_option("ituneschartswidget_affiliate_network");
		delete_option("ituneschartswidget_affiliate_active");
		delete_option("iteneschartswidget_version");
	}
	
	function update_contents()
	{
	    global $wpdb;
	    
		if(get_option("ituneschartswidget_lastrefresh") < time() - 3600)
	    {
	        $Result = array();
	        $itunes_rss = new itunes_rss();
	        
            $itunes_rss->setITunesCharttype(get_option("ituneschartswidget_chart_type", "toppaidapplications"))
                       ->setITunesCountry(  get_option("ituneschartswidget_chart_country", "US"))
                       ->setITunesLimit(    get_option("ituneschartswidget_chart_limit", 10))
                       ->setITunesCategory(	get_option("ituneschartswidget_chart_category"), "");
            
            foreach($itunes_rss->getITunesItems() as $ItunesItem)
            {
                array_push($Result, $ItunesItem->toArray());
            }

			update_option("ituneschartswidget_content",$Result);
			update_option("ituneschartswidget_lastrefresh",time());
	    }
	}
	
	function widget($args)
	{
		$i = 1;
		
	    echo $args['before_widget'];
	    echo $args['before_title'] . get_option("ituneschartswidget_widget_title") . $args['after_title'];
	    
	    $AffiliateNetwork = new affiliate_network();
	    
	    $PartnerID = get_option("ituneschartswidget_affiliate_id");
	    $ProgramID = get_option("ituneschartswidget_affiliate_network");

	    echo "<ul>";

	    foreach(get_option("ituneschartswidget_content") as $Key => $App)
	    {
    	    if(get_option("ituneschartswidget_affiliate_active") == "true") 
    	    {
	    	    $App['URL']         = $AffiliateNetwork->getApplicationLink($ProgramID, $App['URL'], $App['ID']);
	    	    $App['CategoryURL'] = $AffiliateNetwork->getApplicationLink($ProgramID, $App['CategoryURL']);
    	    }
    	    
	    	if(get_option("ituneschartswidget_layout_type") == "STANDARD") 
	    	{
                $Template = new default_layout($App);
	    	} 
	    	else 
	    	{
	    		$Template = new custom_layout($App);
	    	}
	    	
	    	echo $Template->generate($i);
	    	
	    	$i++;
	    }
        
	    echo "</ul>";
	    echo "<span style=\"font-size:7pt;padding:1px;font-weight:bolder;\"><a href=\"http://www.59-media.de\" target=\"_blank\"><img height=\"8\" border=\"0\" src=\"".get_option("siteurl")."/wp-content/plugins/itunes-appstore-charts/img/logo.png\" alt=\"59 MEDIA Suchmaschinenoptimierung\" /></a> - <a href=\"http://www.59-media.de/wordpress-plugin-itunes-appstore-charts/\" target=\"_blank\">iTunes Charts Widget</a></span>";
	    
    	echo $args['after_widget'];
	}
	function itunes_appstorecharts_option_page()
	{
		global $wpdb;
		
		$OptionPage = null;
		$itunes_rss = new itunes_rss();
		$AffiliateNetwork = new affiliate_network();
		
		if(isset($_POST['ituneschartswidget_save_options']))
		{
		    update_option("ituneschartswidget_lastrefresh", 			0);
			update_option("ituneschartswidget_chart_country",			esc_attr($_POST['ituneschartswidget_chart_country']));
			update_option("ituneschartswidget_chart_limit",				esc_attr($_POST['ituneschartswidget_chart_limit']));
			update_option("ituneschartswidget_chart_type",				esc_attr($_POST['ituneschartswidget_chart_type']));
			update_option("ituneschartswidget_affiliate_id",			esc_attr($_POST['ituneschartswidget_affiliate_id']));
			update_option("ituneschartswidget_layout_imagesize", 		esc_attr($_POST['ituneschartswidget_layout_imagesize']));
			update_option("ituneschartswidget_layout_link_categories", 	esc_attr($_POST['ituneschartswidget_layout_link_categories']));
			update_option("ituneschartswidget_layout_type", 			esc_attr($_POST['ituneschartswidget_layout_type']));
			update_option("ituneschartswidget_layout_custom_template", 	$_POST['ituneschartswidget_layout_custom_template']);
			update_option("ituneschartswidget_chart_section", 			esc_attr($_POST['ituneschartswidget_chart_section']));
			update_option("ituneschartswidget_chart_category", 			esc_attr($_POST['ituneschartswidget_chart_category']));
			update_option("ituneschartswidget_widget_title", 			esc_attr($_POST['ituneschartswidget_widget_title']));
			update_option("ituneschartswidget_affiliate_network", 		esc_attr($_POST['ituneschartswidget_affiliate_network']));
			update_option("ituneschartswidget_affiliate_active", 		esc_attr($_POST['ituneschartswidget_affiliate_active']));
		}
		
		$OptionPage .= '
		<style>
			ul > li > div > select, input[type=text] {
				width:225px;
			}
			ul > li > div > label {
				display:block;
				width:160px;
				float:left;
			}
			td.custom-layout{
				border:1px solid #DFDFDF;
			}
		</style>
		
		<div class="wrap">
			<div id="icon-options-general" class="icon32"></div>
			<h2>iTunes Chart Widget Configuration</h2>
			<form name="ituneschartswidget_config_form" id="ituneschartswidget_config_form" action="'.get_option("siteurl").'/wp-admin/options-general.php?page=itunes-appstore-charts/appstore_charts.php" method="post">
				<div id="poststuff"> 
					<div class="postbox" style="width:49%;float:left;"> 
						<h3>Settings</h3> 
						<div class="inside"> 
							<ul>
								<li>
									<div>
										<label for="ituneschartswidget_widget_title">Widget Title: </label>
										<input type="text" id="ituneschartswidget_widget_title" name="ituneschartswidget_widget_title" value="'.get_option("ituneschartswidget_widget_title").'"/>
									</div>
								</li> 
								<li> 
									<div>
										<label for="ituneschartswidget_chart_country">Country: </label>
										<select id="ituneschartswidget_chart_country" name="ituneschartswidget_chart_country">';
										foreach($itunes_rss->getCountries() as $Key => $Country)
										{
											$OptionPage .= '<option value="'.$Key.'"';
											
											if(get_option("ituneschartswidget_chart_country") == $Key) 
											    $OptionPage .= ' selected="selected"';
											
											$OptionPage .= '>'.$Country.'</option>';
										}
										$OptionPage .='</select> 
									</div> 
								</li>
								<li>
									<div>
										<label for="ituneschartswidget_chart_limit">Item Count: </label>
										<select id="ituneschartswidget_chart_limit" name="ituneschartswidget_chart_limit">';
										foreach($itunes_rss->getLimits() as $Limit)
										{
										    $OptionPage    .= '<option value="'.$Limit.'"';
										    
										    if(get_option("ituneschartswidget_chart_limit") == $Limit)
										    	$OptionPage .= ' selected="selected"';
										    
										    	$OptionPage .= '>'.$Limit.'</option>';
										}
										$OptionPage .= '</select>
									</div>
								</li>
								<li>
									<div>
										<label for="ituneschartswidget_chart_section">Section: </label><input type="hidden" id="ituneschartswidget_chart_section_hidden" value="'.get_option("ituneschartswidget_chart_section").'" />
										<select name="ituneschartswidget_chart_section" id="ituneschartswidget_chart_section"></select>
									</div>
								</li>
								<li>
									<div>
										<label for="ituneschartswidget_chart_type">Charttype: </label><input type="hidden" id="ituneschartswidget_chart_type_hidden" value="'.get_option("ituneschartswidget_chart_type").'" />
										<select id="ituneschartswidget_chart_type" name="ituneschartswidget_chart_type"></select>
									</div>
								</li>
								<li id="ituneschartswidget_chart_category_list">
									<div>
										<label for="ituneschartswidget_chart_category">Categories: </label><input type="hidden" id="ituneschartswidget_chart_category_hidden" value="'.get_option("ituneschartswidget_chart_category").'" />
										<select id="ituneschartswidget_chart_category" name="ituneschartswidget_chart_category"></select>
									</div>
								</li>
								<li>
									<div>
										<label for="ituneschartswidget_layout_imagesize">Imagesize: </label>
										<select name="ituneschartswidget_layout_imagesize">
										<option value="53"';
									    if(intval(get_option("ituneschartswidget_layout_imagesize")) == 53)
									        $OptionPage .= ' selected="selected"';
									    $OptionPage.= '>53 Pixel</option>
									    <option value="75"';
									    if(intval(get_option("ituneschartswidget_layout_imagesize")) == 75)
									        $OptionPage .= ' selected="selected"';
									    $OptionPage.= '>75 Pixel</option>
									    <option value="100"';
									    if(intval(get_option("ituneschartswidget_layout_imagesize")) == 100)
									        $OptionPage .= ' selected="selected"';
									    $OptionPage.= '>100 Pixel</option>
									</select>
									</div>
								</li>
								<li>
									<div>
										<label for="ituneschartswidget_layout_type">Layout:</label>
										<select name="ituneschartswidget_layout_type" id="ituneschartswidget_layout_type">
											<option value="STANDARD"';
									    	if(get_option("ituneschartswidget_layout_type") == "STANDARD")
									    		$OptionPage .= ' selected="selected"';
									    	$OptionPage .= '>Standard Layout</option>
									    	<option value="CUSTOM"';
									    	if(get_option("ituneschartswidget_layout_type") == "CUSTOM")
									    		$OptionPage .= ' selected="selected"';
									    	$OptionPage .= '>Custom Layout</option>
										</select>
									</div>
								</li>
								<li>
									<div>
										<label for="ituneschartswidget_layout_link_categories">link Categories:</label>
										<input type="checkbox" id="ituneschartswidget_layout_link_categories" name="ituneschartswidget_layout_link_categories" value="true"'; 
											if(get_option("ituneschartswidget_layout_link_categories") == 'true')
									   			$OptionPage .= ' checked="checked"';
										$OptionPage .= '/>
									</div>
								</li>
								<li>
									<div>
										<label for="ituneschartswidget_affiliate_active">activate Affiliate:</label>
										<input type="checkbox" name="ituneschartswidget_affiliate_active" id="ituneschartswidget_affiliate_active" value="true" ';
										if(get_option("ituneschartswidget_affiliate_active") == "true")
										    $OptionPage .= 'checked="checked"';
										$OptionPage .= '/>
									</div>
								</li>
								<li id="affiliate_tradedoubler_country">
									<div>
										<label for="ituneschartswidget_affiliate_network">Affiliate Network:</label>
										<select name="ituneschartswidget_affiliate_network" id="ituneschartswidget_affiliate_network">
											<option>Choose Affiliate Network</option>';
										    foreach($AffiliateNetwork->getNetworkData() as $NetworkIdentifier => $NetworkParams)
										    {
										        $OptionPage .= '<option value="'.$NetworkIdentifier.'"';
										        
										        if(get_option("ituneschartswidget_affiliate_network") == $NetworkIdentifier)
										            $OptionPage .= ' selected="selected"';
										        
										        $OptionPage .= '>'.$NetworkParams['Title'].'</option>';
										    }

										    
										    $OptionPage .= '</select>
									</div>
								</li>
								<li id="affiliate_tradedoubler_id">
									<div>
										<label for="ituneschartswidget_affiliate_id">Affiliate ID: </label>
										<input type="text" id="ituneschartswidget_affiliate_id" name="ituneschartswidget_affiliate_id" value="'.get_option("ituneschartswidget_affiliate_id").'"/>
									</div>
								</li>
								<li id="affiliate_tradedoubler_reg">
									<div>
										<label for="ituneschartswidget_tradedoubler_reg">Register at Tradedoubler: </label>
										<a class="button-secondary" id="ituneschartswidget_tradedoubler_reg" name="ituneschartswidget_tradedoubler_reg" href="http://clkde.tradedoubler.com/click?p=82&a=1811869&g=19144578" title="register to tradedoubler" target="_blank" style="width:200px;">Become a Tradedoubler Affiliate (EU)&nbsp;&nbsp;&nbsp;</a>
									</div>
								</li>
								<li id="affiliate_linkshare_reg">
									<div>
										<label for="ituneschartswidget_linkshare_reg">Register at LinkShare (US): </label>
										<a class="button-secondary" id="ituneschartswidget_linkshare_reg" name="ituneschartswidget_linkshare_reg" href="http://click.linksynergy.com/fs-bin/stat?id=y712Adf/K/g&offerid=7097.10000001&type=3&subid=0" title="register to tradedoubler" target="_blank" style="width:200px;">Become a LinkShare Affiliate (US & CA)</a>
									</div>
								</li>
								<li>
									<div>
										<input type="submit" name="ituneschartswidget_save_options" id="ituneschartswidget_save_options" value="Save Options" class="button-primary"/>
									</div>
								</li>
							</ul> 
						</div>
					</div>
					<div class="postbox" style="width:49%;float:right;"> 
						<div class="inside">
							<a href="http://www.59-media.de" target="_blank"><img src="'.get_option("siteurl").'/wp-content/plugins/itunes-appstore-charts/img/59-media-logo.png" alt="59 MEDIA Webdevelopment" border="0"/></a>
						</div>
					</div>
					<div class="postbox" style="width:49%;height:355px;float:right;"> 
						<h3>About</h3> 
						<div class="inside"> 
							iTunes Appstore Widget is written by Hauke Leweling<br />
							<br />
							<ul>
								<li><a href="http://www-59-media.de" target="_blank">Company Page</a></li>
								<li><a href="http://twitter.com/#!/joghurtkultur" target="_blank">The Author on Twitter</a></li>
								<li><a href="http://www.59-media.de/wordpress-plugin-itunes-appstore-charts/" target="_blank">iTunes Chart Widget Support Page</a></li>
							</ul>
							<br />
							Feel free to put some motivation in my pockets by a litte Paypal donation<br />
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="T9CRKPGJUWQU6">
								<input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen Ð mit PayPal.">
								<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
							</form>
							<br />
							<h4>My other Wordpress Plugins</h4>
							<ul>
								<li><a href="http://wordpress.org/extend/plugins/itunes-appstore-charts/" target="_blank">Appstore Charts</a></li>
								<li><a href="http://wordpress.org/extend/plugins/wp-css-button/" target="_blank">WP CSS Button</a></li>
								<li><a href="http://wordpress.org/extend/plugins/facebook-image-suggest/" target="_blank">Facebook Image Suggest</a></li>
								<li><a href="http://wordpress.org/extend/plugins/autoclose-comments/" target="_blank">Autoclose Comments</a></li>
							</ul>
						</div>
					</div>
					<div class="postbox" style="width:100%;float:left;">
						<h3>Custom Layout</h3>
						<div class="inside">
							<table style="width:100%">
								<tr>
									<td><h3>Custom HTML Code</h3></td>
									<td><h3>Possible Elements</h3></td>
									<td><h3>Example</h3></td>
								</tr>
								<tr>
									<td class="custom-layout">
										<textarea cols="40" rows="13" name="ituneschartswidget_layout_custom_template" id="ituneschartswidget_layout_custom_template" style="border:none;font-size:9pt;height:100%;width:100%;">'.stripslashes(get_option("ituneschartswidget_layout_custom_template")).'</textarea>
									</td>
									<td valign="top" class="custom-layout">
										<ul>
											<li>%APP_TITLE%</li>
											<li>%APP_CHART_POSITION%</li>
											<li>%APP_LINK%</li>
											<li>%APP_DATE%</li>
											<li>%APP_CURRENCY%</li>
											<li>%APP_AMOUNT%</li>
											<li>%APP_CATEGORY_NAME%</li>
											<li>%APP_CATEGORY_LINK%</li>
											<li>%APP_ARTIST%</li>
											<li>%APP_IMAGE_53%</li>
											<li>%APP_IMAGE_75%</li>
											<li>%APP_IMAGE_100%</li>
										</ul>
									</td>
									<td class="custom-layout" valign="top">'.nl2br(htmlentities('<li>
										<a href="%APP_LINK%" target="_blank">%APP_TITLE%</a><br />
										<img src="%APP_IMAGE_53%" title="%APP_TITLE%" style="float:left;"/>
										Price: <strong>%APP_AMOUNT% %APP_CURRENCY%</strong><br />
										Category: %APP_CATEGORY_NAME%<br />
										Release: %APP_DATE%
										</li>')).'
									</td>
								</tr>
							</table>
							<input type="submit" name="ituneschartswidget_save_options" id="ituneschartswidget_save_options" value="Save Custom Layout" class="button-primary"/>
						</div>
					</div>
					<div class="postbox" style="width:100%;float:left;"> 
						<div class="inside">
							<center>
								iTunes and Appstore are registered trademarks of &#63743; Apple Inc.
							</center>
						</div>
					</div>
				</div>
				</form>
		</div>';
		
		echo $OptionPage;
	}
	
	function add_jquery()
	{
    	wp_enqueue_script('jquery');
    	wp_enqueue_script('charts', WP_CONTENT_URL. '/plugins/itunes-appstore-charts/js/charts.js');
    	wp_enqueue_script('iacw', WP_CONTENT_URL. '/plugins/itunes-appstore-charts/js/jquery.iacw.js');
	}
	
	function itunes_appstorecharts_add_menu()
	{
		add_options_page('iTunes Charts Widget', 'iTunes Charts', 9, __FILE__, array('itunescharts_widget','itunes_appstorecharts_option_page'));
	}
	
	function update()
	{
		if(!get_option("ituneschartswidget_version") || get_option("ituneschartswidget_version") != ITUNES_CHARTS_VERSION)
		{
			$UpdateHandler = new itunescharts_update();
			$UpdateHandler->update();
		}
	}
}
?>