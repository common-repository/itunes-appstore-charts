<?php
class itunes_item
{
	private $ID;
    private $Title;
    private $Image_53;
    private $Image_75;
    private $Image_100;
    private $Currency;
    private $Amount;
    private $URL;
    private $CategoryName;
    private $CategoryURL;
    private $Artist;
    private $ReleaseDate;

    public function __construct()
    {
        
    }
    
    public function toArray()
    {
        $itunes_item_array = array(
            "Title"		    => $this->Title,
            "Image_53"	    => $this->Image_53,
            "Image_75"	    => $this->Image_75,
            "Image_100"	    => $this->Image_100,
            "Currency"	    => $this->Currency,
            "Amount"	    => $this->Amount,
            "URL"		    => $this->URL,
            "CategoryName"	=> $this->CategoryName,
            "CategoryURL"	=> $this->CategoryURL,
            "Artist"		=> $this->Artist,
            "ReleaseDate"	=> $this->ReleaseDate,
        	"ID"			=> $this->ID
        );
        
        return $itunes_item_array;
    }
    
	public function getTitle ()
    {
        return $this->Title;
    }

	public function setTitle ($Title)
    {
        $this->Title = $Title;
        return $this;
    }

	public function getImage_53 ()
    {
        return $this->Image_53;
    }

	public function setImage_53 ($Image_53)
    {
        $this->Image_53 = $Image_53;
        return $this;
    }

	public function getImage_75 ()
    {
        return $this->Image_75;
    }

	public function setImage_75 ($Image_75)
    {
        $this->Image_75 = $Image_75;
        return $this;
    }

	public function getImage_100 ()
    {
        return $this->Image_100;
    }

	public function setImage_100 ($Image_100)
    {
        $this->Image_100 = $Image_100;
        return $this;
    }

	public function getCurrency ()
    {
        return $this->Currency;
    }

	public function setCurrency ($Currency)
    {
        $this->Currency = $Currency;
        return $this;
    }

	public function getAmount ()
    {
        return $this->Amount;
    }

	public function setAmount ($Amount)
    {
        $this->Amount = $Amount;
        return $this;
    }

	public function getURL ()
    {
        return $this->URL;
    }

	public function setURL ($URL)
    {
        $this->URL = $URL;
        return $this;
    }

	public function getCategoryName ()
    {
        return $this->CategoryName;
    }

	public function setCategoryName ($CategoryName)
    {
        $this->CategoryName = $CategoryName;
        return $this;
    }

	public function getCategoryURL ()
    {
        return $this->CategoryURL;
    }

	public function setCategoryURL ($CategoryURL)
    {
        $this->CategoryURL = $CategoryURL;
        return $this;
    }

	public function getArtist ()
    {
        return $this->Artist;
    }

	public function setArtist ($Artist)
    {
        $this->Artist = $Artist;
        return $this;
    }

	public function getReleaseDate ()
    {
        return $this->ReleaseDate;
    }

	public function setReleaseDate ($ReleaseDate)
    {
        $this->ReleaseDate = $ReleaseDate;
        return $this;
    }
    
	public function getID() 
	{
		return $this->ID;
	}

	public function setID($ID) 
	{
		$this->ID = $ID;
		return $this;
	}

}