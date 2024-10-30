<?php
require_once(dirname(__FILE__)."/abstract.layout.class.php");

class default_layout extends abstract_layout
{
    protected function getLayout()
    {
        $Layout = '<li style="list-style-type:none;">
		    	   	<table style="border-bottom:1px dashed #AFAFAF;margin-top:5px;width:100%;">
		    	    	<tr>
		    	        	<td colspan="2" style="font-weight:bolder;">
		    	            	<a href="%APP_LINK%" target="_blank">
		    	            		%APP_CHART_POSITION%. %APP_TITLE%
		    	            	</a>
		    	            </td>
		    	        </tr>
		    	        <tr>
		    	        	<td rowspan="3" style="width:'.(get_option("ituneschartswidget_layout_imagesize")+5).'px;">
		    	            	<a href="%APP_LINK%" target="_blank">
		    	                	<img src="%APP_IMAGE_'.get_option("ituneschartswidget_layout_imagesize").'%" alt="%APP_TITLE%" />
		    	                </a>
		    	            </td>
							<td style="vertical-align:top;">
		    	            	in ';
		    	                
		    	                if(get_option("ituneschartswidget_layout_link_categories") == "true")
		    	                {
		    	                    $Layout .= '<a href="%APP_CATEGORY_LINK%" target="_blank">
		    	                        %APP_CATEGORY_NAME%
		    	                    </a>';   
		    	                }
		    	                else
		    	                {
		    	                    $Layout.= '%APP_CATEGORY_NAME%';
		    	                }
		    	                
		    	            $Layout .= '</td>
	                    </tr>
	                    <tr>
		    	        	<td>
		    	            	Preis: %APP_AMOUNT% %APP_CURRENCY%
		    	            </td>
	                    </tr>
	                    <tr>
		    	        	<td style="vertical-align:top;">
		    	                Datum: %APP_DATE%
		    	            </td>
		    	        </tr>
		    	    </table>
		    </li>';
		    	            
		   return $Layout;
    }
}