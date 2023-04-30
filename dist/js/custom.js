function custom_js_nav_bar_selection(choice)
{
    $(".nav-link").removeClass("active");

    $(".nav-link-"+choice).addClass("active");

    $(".nav-link-"+choice).closest(".nav-treeview").parent('.nav-item').addClass("menu-open");
    $(".nav-link-"+choice).closest(".nav-treeview").parent('.nav-item').children("a").addClass("active");
}

function custom_js_pagination_sync(pageNumber)
{
    $(".card-tools .custom-select,#pagination_page").val(pageNumber);
    $(".card-tools .custom-select").change(function(){
        $("#pagination_page").val($(this).val());
        $("#filter-form").submit();
    });
}

function custom_js_show_filter(filterChoice)
{
    if(filterChoice=="1")
    {
        $(".d-block").click();
    }    
}

function custom_js_show_accordian_level(filterLevel)
{
    $("#accordiancard_"+filterLevel+" .d-block").click();   
}

function custom_js_show_accordian_hierarchy(filterLevel,totalLevel)
{
    $("#accordiancard_"+filterLevel).removeClass("card-warning").addClass("card-success"); 
    for(var i=( parseInt(filterLevel) + 1); i<=totalLevel; i++)
    {
        $("#accordiancard_"+i).removeClass("card-warning").addClass("card-danger"); 
    }
}

function custom_js_show_accordian_hierarchy_hide(filterLevel,totalLevel)
{
    $("#accordiancard_"+filterLevel).removeClass("card-warning").addClass("card-success"); 
    for(var i=( parseInt(filterLevel) + 1); i<=totalLevel; i++)
    {
        $("#accordiancard_"+i).addClass("hide"); 
    }
}

function custom_js_submit_filter()
{
    $(".filter-btn").click(function(){
        $(".card-tools .custom-select,#pagination_page").val('1');
        $("#filter-form").submit();
    });

    
    $(".filter-reset").click(function(){
        $(".form_search_input_text").val('');
        $(".form_search_input_select").val('');
        $(".form_search_input_status").val('1');
        $("#filter-form").submit();
    });
}

function custom_js_number_field_check()
{
    $(".form-control-number-min").blur(function(){
        if($(this).val()!="")
        {
            valueToCheck = parseInt($(this).val());
            minValueToCheck = parseInt($(this).attr('min'));
            if(valueToCheck < minValueToCheck)
            {
                $(this).val(minValueToCheck);
            }
        }
    });
}

function custom_js_datepicker_activate()
{
    $('.form-control-datepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });
}

function custom_js_state_dropdown(FieldID,CountryRef,OptionToSelect="")
{
    $.LoadingOverlay("show");
	var request = {
					mode 		: "dropdown_state",
					country_ref : CountryRef
				   };
    $.ajax({
        type	: 'post',
        url		: 'ajaxcall/states.php',
        data	: request,
        dataType: 'json',		  
        success	: function(data){

            if (data == '')
            {
                 alert('Success. No Data');
            }
            else
            {                
                $('#'+FieldID).html(
                    $('<option></option>').val("").html("-- SELECT --")
                );
                var _data = data['states'];
                for (i=0;i<_data.length;i++)
                {
                    var _val 	= _data[i]['states_ref'];
                    var _name 	= _data[i]['states_name']
                    $('#'+FieldID).append(
                        $('<option></option>').val(_val).html(_name)
                    );
                }
                
                if(OptionToSelect != "")
                {
                    var exists = 0 != $('#'+FieldID+' option[value='+OptionToSelect+']').length;
                    if(exists)
                    {
                        $('#'+FieldID).val(OptionToSelect);
                    }
                }
            }
        },
        error	: function(data){
            alert('custom js error. see console log')
            console.log(data);
            $.LoadingOverlay("hide");
        },
        complete: function(data){
            //ajax_hidediv('div_load_job_detail_package');
            $.LoadingOverlay("hide");
        }
    });
}

function custom_js_country_region_dropdown(FieldID,CountryRef,OptionToSelect="")
{
    $.LoadingOverlay("show");
	var request = {
					mode 		: "dropdown_country_region",
					country_ref : CountryRef
				   };
    $.ajax({
        type	: 'post',
        url		: 'ajaxcall/region.php',
        data	: request,
        dataType: 'json',		  
        success	: function(data){

            if (data == '')
            {
                 alert('Success. No Data');
            }
            else
            {                
                $('#'+FieldID).html(
                    $('<option></option>').val("").html("-- SELECT --")
                );
                var _data = data['region'];
                for (i=0;i<_data.length;i++)
                {
                    var _val 	= _data[i]['region_ref'];
                    var _name 	= "";
                    _name 	+= _data[i]['region_name'];
                    if(_data[i]['states_name'])
                    {
                        _name 	+= ", " + _data[i]['states_name'];

                    }
                    $('#'+FieldID).append(
                        $('<option></option>').val(_val).html(_name)
                    );
                }
                
                if(OptionToSelect != "")
                {
                    var exists = 0 != $('#'+FieldID+' option[value='+OptionToSelect+']').length;
                    if(exists)
                    {
                        $('#'+FieldID).val(OptionToSelect);
                    }
                }
            }
        },
        error	: function(data){
            alert('custom js error. see console log')
            console.log(data);
            $.LoadingOverlay("hide");
        },
        complete: function(data){
            //ajax_hidediv('div_load_job_detail_package');
            $.LoadingOverlay("hide");
        }
    });
}

function custom_js_pack_edit_wine_search_dropdown(FieldID, BranchRef, CountryRef, RegionRef, WineryRef, VintageRef, OptionToSelect="")
{
    $.LoadingOverlay("show");
	var request = {
					mode 		        : "dropdown_wine_filter",
					wine_branch_ref     : BranchRef,
					wine_country_ref    : CountryRef,
					wine_region_ref     : RegionRef,
					wine_winery_ref     : WineryRef,
					wine_vintage        : VintageRef
				   };
    $.ajax({
        type	: 'post',
        url		: 'ajaxcall/wine.php',
        data	: request,
        dataType: 'json',		  
        success	: function(data){

            if (data == '')
            {
                 alert('Success. No Data');
            }
            else
            {                
                $('#'+FieldID).html(
                    $('<option></option>').val("").html("-- SELECT --")
                );
                var _data = data['wine'];
                for (i=0;i<_data.length;i++)
                {
                    var _val 	= _data[i]['wine_ref'];
                    var _name 	= _data[i]['wine_name']
                    $('#'+FieldID).append(
                        $('<option></option>').val(_val).html(_name)
                    );
                }
                
                if(OptionToSelect != "")
                {
                    var exists = 0 != $('#'+FieldID+' option[value='+OptionToSelect+']').length;
                    if(exists)
                    {
                        $('#'+FieldID).val(OptionToSelect);
                    }
                }
            }
        },
        error	: function(data){
            alert('custom js error. see console log')
            console.log(data);
            $.LoadingOverlay("hide");
        },
        complete: function(data){
            //ajax_hidediv('div_load_job_detail_package');
            $.LoadingOverlay("hide");
        }
    });
}

function custom_js_navigation_list_generator()
{
    $(".filter-btn-navigation").click(function(){
        var navigationShowVal = parseInt($(this).val());
        navigateAndSubmitForm = true;

        if(navigationShowVal == 4)
        {
            navigateAndSubmitForm = false;
            choiceToWork = $("input[name='customers_add_to_custpack']:checked").val();
            if(choiceToWork != 1)
            {
                navigateAndSubmitForm = true;
            }
            else
            {
                navigateAndSubmitForm = confirm("This Is Irreversible. Do You Want To Write To Client File?");
            }
        }

        if(navigateAndSubmitForm)
        {
            var nextNavigationLevel = navigationShowVal + 1;
            $("#show_level").val(nextNavigationLevel);

            $("#filter-form").submit();
        }
    });
}

function custom_js_reset_filter_list_generator()
{
    $(".filter-reset-list-generator").click(function(){
        $('#accordiancard_2').find('input[type="text"]').val("");
        $('#accordiancard_2').find('input[type="number"]').val("");
        $('#accordiancard_2').find('select').val("");
        $('#accordiancard_2').find('input[type="checkbox"]').prop("checked",false);
        $('#accordiancard_2').find('input[type="radio"]').prop("checked",false);
    });
}

function custom_js_open_all_filter_list_generator()
{
    $(".data_collapse_btn_common").click();
}

function custom_js_navigation_com_generator()
{
    $(".filter-btn-navigation").click(function(){
        var navigationShowVal = parseInt($(this).val());
        navigateAndSubmitForm = true;

        if(navigationShowVal == 4)
        {
            navigateAndSubmitForm = false;
            choiceToWork = $("input[name='customers_add_to_custpack']:checked").val();
            if(choiceToWork != 1)
            {
                navigateAndSubmitForm = true;
            }
            else
            {
                navigateAndSubmitForm = confirm("This Is Irreversible. Do You Want To Write To Client File?");
            }
        }

        if(navigateAndSubmitForm)
        {
            var nextNavigationLevel = navigationShowVal + 1;
            $("#show_level").val(nextNavigationLevel);

            $("#filter-form").submit();
        }
    });
}

function custom_js_reset_filter_com_generator()
{
    $(".filter-reset-list-generator").click(function(){
        $('#accordiancard_2').find('input[type="text"]').val("");
        $('#accordiancard_2').find('input[type="number"]').val("");
        $('#accordiancard_2').find('select').val("");
        $('#accordiancard_2').find('input[type="checkbox"]').prop("checked",false);
        $('#accordiancard_2').find('input[type="radio"]').prop("checked",false);
    });
}

function custom_js_open_all_filter_com_generator()
{
    $(".data_collapse_btn_common").click();
}


function custom_js_navigation_report_pack()
{
    $(".filter-btn-navigation").click(function(){
        var navigationShowVal = parseInt($(this).val());
        navigateAndSubmitForm = true;

        if(navigationShowVal == 4)
        {
            // navigateAndSubmitForm = false;
            // choiceToWork = $("input[name='customers_add_to_custpack']:checked").val();
            // if(choiceToWork != 1)
            // {
            //     navigateAndSubmitForm = true;
            // }
            // else
            // {
            //     navigateAndSubmitForm = confirm("This Is Irreversible. Do You Want To Write To Client File?");
            // }
        }

        if(navigateAndSubmitForm)
        {
            var nextNavigationLevel = navigationShowVal + 1;
            $("#show_level").val(nextNavigationLevel);

            $("#filter-form").submit();
        }
    });
}

function custom_js_order_code_generator()
{
    $(".class-order-code-generator").change(function(){
        var pack_wine_type = $("#pack_wine_type").val();
        var pack_order_month = $("#pack_order_month").val();
        var pack_order_year = $("#pack_order_year").val();
        var pack_order_code = "";

        if((pack_wine_type!="") && (pack_order_month!="") && (pack_order_year!=""))
        {
            pack_order_code = "#"+pack_wine_type+"0000-"+pack_order_month+pack_order_year;
        }
        $("#pack_order_code").val(pack_order_code);
    });
}

function custom_js_cust_nav_bar_selection(choosen_class)
{
    $("."+choosen_class).addClass("active");
}