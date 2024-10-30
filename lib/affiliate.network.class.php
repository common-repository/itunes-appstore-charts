<?php
class affiliate_network
{
	const BASE_APPLICATION_URL_LINKSHARE 	= "http://click.linksynergy.com/fs-bin/click?id=%AFFILIATE_ID%&offerid=%PROGRAM_ID%.%APP_ID%&type=3&subid=0&tmpid=1826&RD_PARM1=%TARGET_URL%";
	const BASE_APPLICATION_URL_TRADEDOUBLER	= "http://clk.tradedoubler.com/click?p=%PROGRAM_ID%&a=%AFFILIATE_ID%&url=%TARGET_URL%";
	
	const NETWORK_IDENTIFIER_LINKSHARE		= "&partnerId=30";
	const NETWORK_IDENTIFIER_TRADEDOUBLER	= "&partnerId=2003";
	
	private $NetworkIdentifier;
	private $AffiliateID;
	private $ReplacementData;
	private $AffiliateNetworkData;
	
	public function __construct()
	{
		$this->AffiliateID			= get_option("ituneschartswidget_affiliate_id");
		$this->NetworkIdentifier	= get_option("ituneschartswidget_affiliate_network");
		$this->AffiliateNetworkData = $this->getNetworkData();
	}
	
	public function getApplicationLink($NetworkIdentifier, $TargetURL, $ApplicationID = false)
	{
		$NetworkConstantName = $this->getNetworkConstantName($NetworkIdentifier);
		
		$BaseURL = constant("self::BASE_APPLICATION_URL_".$NetworkConstantName);
		
		$ReplacementData	 = array(
			"%AFFILIATE_ID%" => $this->AffiliateID,
			"%PROGRAM_ID%"	 => $this->AffiliateNetworkData[$this->NetworkIdentifier]['ProgramID'],
			"%TARGET_URL%"	 => urlencode($TargetURL.constant("self::NETWORK_IDENTIFIER_".$NetworkConstantName)),
			"%APP_ID%"		 => $ApplicationID
		);
		
		foreach($ReplacementData as $Needle => $Replace) {
			$BaseURL = str_replace($Needle, $Replace, $BaseURL);
		}
		
		return $BaseURL;
	}
	
	public function getNetworkData()
    {
        return array(
            "TRADEDOUBLER_DE"	=> array(
            	"Title" => "iTunes @ Tradedoubler AT",
        		"ProgramID"	=> "24380"
       		),
       		"TRADEDOUBLER_BE"	=> array(
            	"Title" => "iTunes @ Tradedoubler BE",
        		"ProgramID"	=> "24379"
       		),
			"TRADEDOUBLER_CH"	=> array(
            	"Title" => "iTunes @ Tradedoubler CH",
        		"ProgramID"	=> "24372"
       		),
       		"TRADEDOUBLER_DE"	=> array(
            	"Title" => "iTunes @ Tradedoubler DE",
        		"ProgramID"	=> "23761"
       		),
       		"TRADEDOUBLER_DK"	=> array(
            	"Title" => "iTunes @ Tradedoubler DK",
        		"ProgramID"	=> "24375"
       		),
       		"TRADEDOUBLER_ES"	=> array(
            	"Title" => "iTunes @ Tradedoubler ES",
        		"ProgramID"	=> "24364"
       		),
       		"TRADEDOUBLER_FI"	=> array(
            	"Title" => "iTunes @ Tradedoubler FI",
        		"ProgramID"	=> "24366"
       		),
       		"TRADEDOUBLER_FR"	=> array(
            	"Title" => "iTunes @ Tradedoubler FR",
        		"ProgramID"	=> "23753"
       		),
       		"TRADEDOUBLER_GB"	=> array(
            	"Title" => "iTunes @ Tradedoubler GB",
        		"ProgramID"	=> "23708"
       		),
       		"TRADEDOUBLER_IE"	=> array(
            	"Title" => "iTunes @ Tradedoubler IE",
        		"ProgramID"	=> "24367"
       		),
       		"TRADEDOUBLER_IT"	=> array(
            	"Title" => "iTunes @ Tradedoubler IT",
        		"ProgramID"	=> "24373"
       		),
       		"TRADEDOUBLER_NL"	=> array(
            	"Title" => "iTunes @ Tradedoubler NL",
        		"ProgramID"	=> "24371"
       		),
       		"TRADEDOUBLER_NO"	=> array(
            	"Title" => "iTunes @ Tradedoubler NO",
        		"ProgramID"	=> "24369"
       		),
       		"TRADEDOUBLER_SE"	=> array(
            	"Title" => "iTunes @ Tradedoubler SE",
        		"ProgramID"	=> "24379"
       		),
       		"LINKSHARE_US"		=> array(
       			"Title" => "iTunes US @ Linkshare",
       			"ProgramID"	=> "146261"
       		),
       		"LINKSHARE_CA"		=> array(
       			"Title" => "iTunes CA @ Linkshare",
       			"ProgramID"	=> "162397"
       		)
        );
    }
    
    private function getNetworkConstantName($NetworkIdentifier)
    {
    	return substr($NetworkIdentifier, 0, strpos($NetworkIdentifier, "_"));
    }
}