<?php
class itunescharts_update
{
	private $CurrentVersion;
	
	public function __construct()
	{
		$this->CurrentVersion = get_option("ituneschartswidget_version");
	}
	
	public function update()
	{
	    if(!$this->CurrentVersion)
	        $this->CurrentVersion = "2.1.2";
	        
	    if($this->CurrentVersion != ITUNES_CHARTS_VERSION)
		    $UpdateStatus = $this->runUpdate();
	}
	
	private function runUpdate()
	{
		if($this->CurrentVersion == "2.1.2")
		{
			add_option("ituneschartswidget_version", 				$this->CurrentVersion);
			add_option("ituneschartswidget_lastrefresh",			get_option("itunescharts_lastrefresh"));
			add_option("ituneschartswidget_content",				get_option("itunescharts_content"));
			add_option("ituneschartswidget_chart_country", 			get_option("appstorecharts_country"));
			add_option("ituneschartswidget_chart_limit", 			get_option("appstorecharts_dispalaytop"));
			add_option("ituneschartswidget_chart_type", 			get_option("appstorecharts_show"));
			add_option("ituneschartswidget_chart_section", 			get_option("appstorecharts_section"));
			add_option("ituneschartswidget_chart_category", 		get_option("appstorecharts_category"));
			add_option("ituneschartswidget_layout_link_categories", get_option("appstore_charts_link_categories"));
			add_option("ituneschartswidget_layout_imagesize", 		get_option("appstore_charts_imagesize"));
			add_option("ituneschartswidget_layout_type", 			get_option("appstorecharts_layout"));
			add_option("ituneschartswidget_layout_custom_template", get_option("appstorecharts_layout_html"));
			add_option("ituneschartswidget_widget_title", 			get_option("appstorecharts_widgettitle"));
			add_option("ituneschartswidget_affiliate_network", 		get_option("appstorecharts_itunes_contryid"));
			add_option("ituneschartswidget_affiliate_active", 		get_option("appstorecharts_affiliate"));
			add_option("ituneschartswidget_affiliate_id", 			get_option("tradedoubler_id"));
			
			delete_option("itunescharts_lastrefresh");
			delete_option("iteneschartswidget_version");
			delete_option("itunescharts_content");
			delete_option("appstorecharts_country");
			delete_option("appstorecharts_dispalaytop");
			delete_option("appstorecharts_show");
			delete_option("appstorecharts_section");
			delete_option("appstore_charts_link_categories");
			delete_option("appstore_charts_imagesize");
			delete_option("appstorecharts_layout");
			delete_option("appstorecharts_layout_html");
			delete_option("appstorecharts_category");
			delete_option("appstorecharts_widgettitle");
			delete_option("appstorecharts_itunes_contryid");
			delete_option("appstorecharts_affiliate");
			delete_option("tradedoubler_id");
		}		
		
		update_option("ituneschartswidget_version", ITUNES_CHARTS_VERSION);
	}
}