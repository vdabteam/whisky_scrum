$(function(){

$("#sliderstrength").slider({
    min: 0,
    max: 100,
    step: 1,
    values: [10, 90],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("#labelstrength.input.sliderValue").change(function() {
    var $this = $(this);
    $("#sliderstrength").slider("values", $this.data("index"), $this.val());
});

$("#sliderscore").slider({
    min: 0,
    max: 10,
    step: 0.5,
    values: [0, 10],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue").change(function() {
    var $this = $(this);
    $("#sliderscore").slider("values", $this.data("index"), $this.val());
});


}); //END FUNCTION
