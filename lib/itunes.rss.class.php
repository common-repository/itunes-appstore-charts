<?php
require_once("itunes.item.class.php");

class itunes_rss
{
    private $iTunesCountry;
    private $iTunesLimit;
    private $iTunesCharttype;
    private $iTunesCategory;
    
    const ITUNES_XML_BASEURL = "http://itunes.apple.com/%COUNTRY%/rss/%TYPE%/limit=%LIMIT%/genre=%GENRE%/xml";
    
    public function __construct()
    {
        
    }
    
    public function getITunesItems()
    {
        $Result = array();
        $iTunesResponse = $this->fetchITunesContent();

        foreach($iTunesResponse->entry as $Item)
        {
            $Title       = $Item->xpath("im:name");
            $ImageData   = $Item->xpath("im:image");
            $Currency    = $Item->xpath("im:price/@currency");
            $Amount      = $Item->xpath("im:price/@amount");
            $Category    = $Item->category;
            $Artist      = $Item->xpath("im:artist");
            $ReleaseDate = $Item->xpath("im:releaseDate/@label");
            $ItunesItemID= $this->extractItemID((string) $Item->id);
                
            $iTunesItem = new itunes_item();
        
            $iTunesItem->setTitle(            (string) $Title[0])
                        ->setImage_53(        (string) $ImageData[0][0])
                        ->setImage_75(        (string) $ImageData[1][0])
                        ->setImage_100(       (string) $ImageData[2][0])
                        ->setCurrency(        (string) $Currency[0])
                        ->setAmount(          (string) $Amount[0])
                        ->setCategoryName(    (string) $Category[0]['label'])
                        ->setCategoryURL(     (string) $Category[0]['scheme'])
                        ->setArtist(          (string) $Artist[0])
                        ->setReleaseDate(     (string) $ReleaseDate[0])
                        ->setURL(             (string) $Item->id)
                        ->setID(			  $ItunesItemID);
            
            array_push($Result, $iTunesItem);                
        }

        return $Result;
    }
    
    private function extractItemID($ItunesURL)
    {
    	preg_match('/id([0-9]+)/', $ItunesURL, $Match);
    	return $Match[1];
    }
    
    private function fetchITunesContent()
    {
        $RSSContent = simplexml_load_file(
    		$this->getFeedURL(),
    		"SimpleXMLElement",
            LIBXML_NOCDATA
        );
        
        if($RSSContent === false)
        {
            $ch = curl_init($this->getFeedURL());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $XMLRawData = curl_exec($ch);
            curl_close($ch);

            $RSSContent = simplexml_load_string($XMLRawData);
        }

        return $RSSContent;
    }
    
    private function getFeedURL()
    {
        $Replacements = array(
            "%COUNTRY%"	=> $this->iTunesCountry,
            "%TYPE%"	=> $this->iTunesCharttype,
            "%LIMIT%"	=> $this->iTunesLimit,
        	"%GENRE%"	=> $this->iTunesCategory
        );
        
        $iTunesURL = self::ITUNES_XML_BASEURL;
        
        foreach($Replacements as $Needle => $ReplaceString)
        {
            $iTunesURL = str_replace($Needle, $ReplaceString, $iTunesURL);
        }

        return $iTunesURL;
    }
    
	public function getITunesCountry ()
    {
        return $this->iTunesCountry;
    }

	public function setITunesCountry ($iTunesCountry)
    {
        $this->iTunesCountry = $iTunesCountry;
        return $this;
    }

	public function getITunesLimit ()
    {
        return $this->iTunesLimit;
    }

	public function setITunesLimit ($iTunesLimit)
    {
        $this->iTunesLimit = $iTunesLimit;
        return $this;
    }

	public function getITunesCharttype ()
    {
        return $this->iTunesCharttype;
    }

	public function setITunesCharttype ($iTunesCharttype)
    {
        $this->iTunesCharttype = $iTunesCharttype;
        return $this;
    }
    
	public function getITunesCategory() 
	{
		return $this->iTunesCategory;
	}

	public function setITunesCategory($iTunesCategory) 
	{
		$this->iTunesCategory = $iTunesCategory;
		return $this;
	}
    
    public function getLimits()
    {
        return array(3, 5, 10, 25, 50, 75, 100, 200, 300);
    }
    
    public function getCountries()
    {
        return array(
            "AR" => "Argentina",
            "AU" => "Australia",
            "AT" => "Austria",
            "BE" => "Belgium",
            "BR" => "Brazil",
            "CA" => "Canada",
            "CL" => "Chile",
            "CN" => "China",
            "CO" => "Colombia",
            "CR" => "Costa Rica",
            "HR" => "Croatia",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "SV" => "El Salvador",
            "FI" => "Finland",
            "FR" => "France",
            "DE" => "Germany",
            "GR" => "Greece",
            "GT" => "Guatemala",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IN" => "India",
            "ID" => "Indonesia",
            "IE" => "Ireland",
            "IL" => "Israel",
            "IT" => "Italy",
            "JP" => "Japan",
            "KR" => "Korea, Republic Of",
            "KW" => "Kuwait",
            "LB" => "Lebanon",
            "LU" => "Luxembourg",
            "MY" => "Malaysia",
            "MX" => "Mexico",
            "NL" => "Netherlands",
            "NZ" => "New Zealand",
            "NO" => "Norway",
            "PK" => "Pakistan",
            "PA" => "Panama",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PL" => "Poland",
            "PT" => "Portugal",
            "QA" => "Qatar",
            "RO" => "Romania",
            "RU" => "Russia",
            "SA" => "Saudi Arabia",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "ZA" => "South Africa",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "TW" => "Taiwan",
            "TH" => "Thailand",
            "TR" => "Turkey",
            "GB" => "UK",
            "US" => "USA",
            "AE" => "United Arab Emirates",
            "VE" => "Venezuela",
            "VN" => "Vietnam"
        );
    }

}