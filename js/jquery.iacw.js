jQuery(document).ready(function($)
{
	jQuery("#ituneschartswidget_chart_category_list").hide();
	jQuery("#ituneschartswidget_chart_section").append('<option value="">Choose Section</option>');
	jQuery.each(store.en, function(index, value)
	{
		var selected = '';
		
		if(jQuery("#ituneschartswidget_chart_section_hidden").val() == index)
			selected = 'selected="selected"';
		
		jQuery("#ituneschartswidget_chart_section").append('<option value="' + index + '" ' + selected + '">' + value.title + '</option>');
	});
	
	if(typeof store.en[jQuery("#ituneschartswidget_chart_section_hidden").val()] != 'undefined')
	{
		jQuery.each(store.en[jQuery("#ituneschartswidget_chart_section_hidden").val()].childs, function(index, value){
			var selected = '';
			
			if(value.path == jQuery("#ituneschartswidget_chart_type_hidden").val())
				selected = 'selected="selected"';
			
			jQuery("#ituneschartswidget_chart_type").append('<option value="' + value.path + '" ' + selected + '>' + value.caption + '</option>');
		});
	}
	
	jQuery("#ituneschartswidget_chart_section").change(function()
	{
		jQuery("#ituneschartswidget_chart_type option").remove();
		
		jQuery("#ituneschartswidget_chart_type").append('<option value="">Choose Type</option>');
		
		jQuery.each(store.en[jQuery("#ituneschartswidget_chart_section").val()].childs, function(index, value)
		{
			jQuery("#ituneschartswidget_chart_type").append('<option value="' + value.path + '">' + value.caption + '</option>');
		});
	});
	
	jQuery("#ituneschartswidget_chart_type").change(function()
	{
		if((typeof store.en[jQuery("#ituneschartswidget_chart_section").val()].categories != 'undefined') && (store.en[jQuery("#ituneschartswidget_chart_section").val()].categories.length > 0))
		{
			fillCategorySelector();
		}
		else
		{
			jQuery("#ituneschartswidget_chart_category_list").hide();
		}
	});
	
	if((typeof store.en[jQuery("#ituneschartswidget_chart_section").val()].categories != 'undefined') && (store.en[jQuery("#ituneschartswidget_chart_section").val()].categories.length > 0))
		fillCategorySelector();
	
	function fillCategorySelector() 
	{
		jQuery("#ituneschartswidget_chart_category option").remove();
		jQuery("#ituneschartswidget_chart_category").append('<option>all Categories</option>');
		jQuery.each(store.en[jQuery("#ituneschartswidget_chart_section").val()].categories, function(index, value)
		{
			var selected = '';
			
			if(value.genre == jQuery("#ituneschartswidget_chart_category_hidden").val())
				selected = 'selected="selected"';
			
			jQuery("#ituneschartswidget_chart_category").append('<option value="' + value.genre + '" ' + selected + '>' + value.caption + '</option>');
		});
		
		jQuery("#ituneschartswidget_chart_category_list").show();
	}
});