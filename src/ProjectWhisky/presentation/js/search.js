
/*

$("#search_whisky_form").submit(function(event) {

      //stop form from submitting normally
      event.preventDefault();

      //get some values from elements on the page:
      var $form = $( this ),
          url = $form.attr( 'action' );

      //Send the data using post
      var posting = $.post( url, { barrel_id: $('#selBarrel').val(), region: $('#selRegion').val(),
       strength_rangeleft: $('#strength_rangeleft').val(), strength_rangeright: $('#strength_rangeright').val(),
       score_rangeleft: $('#score_rangeleft').val(), score_rangeright: $('#score_rangeright').val(),
       age_rangeleft: $('#age_rangeleft').val(), age_rangeright: $('#age_rangeright').val(),
      
      } );

      //Alerts the results
      posting.done(function( data ) {
        alert('success');
      });
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
         
});