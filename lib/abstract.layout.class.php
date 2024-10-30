<?php
abstract class abstract_layout
{
    private $Template;
    private $ReplaceVars;
    private $Position;
	
    abstract protected function getLayout();
    
    public function __construct($AppData)
    {
		$this->Template = $this->getLayout();
		
		$this->ReplaceVars = array(
			"%APP_TITLE%"			=> $AppData['Title'],
		    "%APP_LINK%"			=> $AppData['URL'],
			"%APP_DATE%"			=> $AppData['ReleaseDate'],
			"%APP_CURRENCY%"		=> $AppData['Currency'],
			"%APP_AMOUNT%"			=> number_format($AppData['Amount'],2),
			"%APP_CATEGORY_NAME%"	=> $AppData['CategoryName'],
		    "%APP_CATEGORY_LINK%"	=> $AppData['CategoryURL'],
			"%APP_ARTIST%"			=> $AppData['Artist'],
			"%APP_IMAGE_53%"		=> $AppData['Image_53'],
			"%APP_IMAGE_75%"		=> $AppData['Image_75'],
			"%APP_IMAGE_100%"		=> $AppData['Image_100']
		);
    }
    
	public function generate($Position = null)
	{
		$AppMarkup = stripslashes($this->Template);
		
		if(!is_null($Position))
		    $this->ReplaceVars['%APP_CHART_POSITION%'] = $Position;
		
		foreach($this->ReplaceVars as $Needle => $DataValue)
		{
			$AppMarkup = str_replace($Needle, $DataValue, $AppMarkup);
		}
		
		return $AppMarkup;
	}
}