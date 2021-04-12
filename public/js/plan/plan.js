$(document).ready(function(){
    $(".plan-control a").hover(function() {
        const e = $(this).attr("data-floornumber");
        $("area[alt='floor-"+ e +"']").mapster("set", true, {
            fillColor: "fff881",
            fillOpacity: 0.6
        })
    }, function() {
        $("area").mapster("set", false);
    });

    $('#invesmentplan').mapster({
        fillColor: 'fff881',
        fillOpacity: 0.6,
        clickNavigate: true
    });
});
