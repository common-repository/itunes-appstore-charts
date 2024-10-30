<?php
require_once(dirname(__FILE__)."/abstract.layout.class.php");

class custom_layout extends abstract_layout
{
    protected function getLayout()
    {
        return get_option("ituneschartswidget_layout_custom_template");
    }
}