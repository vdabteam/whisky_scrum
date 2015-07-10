

/*
$("#search_whisky_form").submit(function(event) {

    event.preventDefault();

    console.log( $( this ).serialize() );
$.get('search.php?' + $( this ).serialize());



    });
*/









$(function(){






    $("#score_range").editRangeSlider({step: 0.5, defaultValues:{min: 0, max: 10}, bounds:{min: 0, max: 10}, wheelMode: "scroll", wheelSpeed: 10, 
                                        formatter:function(val){
                                            var decimal = val - Math.round(val);
                                            return decimal == 0 ? val.toString() + ".0" : val.toString();
                                        }
    });
    $("#strength_range").editRangeSlider({step: 1, defaultValues:{min: 1, max: 100}, bounds:{min: 1, max: 100}, wheelMode: "scroll", wheelSpeed: 10});
    $("#age_range").editRangeSlider({step: 1, defaultValues:{min: 1, max: 70}, bounds:{min: 1, max: 70}, wheelMode: "scroll", wheelSpeed: 10});



    jQuery('#search_whisky_form').change(function(e) {
        e.preventDefault();
        jQuery.ajax({
            type:"GET",
            async:false,
            url:"search.php",
            data: jQuery("#search_whisky_form").serialize(),
            success: function(response){
                //jQuery(".error_reporting_registration").addClass('result_registration').css('visibility','visible');
                //jQuery(".result_registration").html(response);
                console.log(jQuery("#searchResultContent").html(response));

            }
        });
    }); // End

















});