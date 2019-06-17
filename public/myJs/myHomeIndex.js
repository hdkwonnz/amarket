$(function () {
    //$('.menu_map_parent1').mouseover(function () {
    //    var sub = $('.menu_map_parent1_number').text()
    //    //$('.menu_map_child1').show()
    //    $('.'+sub).show()
    //});
    $('.menu_map_parent1').mouseover(function () {      
        $('.menu_map_child1').show()
    });
    $('.menu_map_parent1').mouseout(function () {
        $('.menu_map_child1').hide()
    });
    
    //$('.menu_map_parent2').mouseover(function () {
    //    var sub = $('.menu_map_parent2_number').text()
    //    //$('.menu_map_child2').show()
    //    $('.' + sub).show()
    //});
    $('.menu_map_parent2').mouseover(function () {        
        $('.menu_map_child2').show()
    });
    $('.menu_map_parent2').mouseout(function () {
        $('.menu_map_child2').hide()
    });

    //$('.menu_map_parent3').mouseover(function () {
    //    var sub = $('.menu_map_parent3_number').text()
    //    //$('.menu_map_child3').show()
    //    $('.' + sub).show()
    //});
    $('.menu_map_parent3').mouseover(function () {        
        $('.menu_map_child3').show()
    });
    $('.menu_map_parent3').mouseout(function () {
        $('.menu_map_child3').hide()
    });

    $('.directContactQues').mouseover(function () {
        $('.directContactQuesSub').show()
    });
    $('.directContactQues').mouseout(function () {
        $('.directContactQuesSub').hide()
    });    
});