$("#logo").bind('click', function () {
    $("#introtext").hide();
});
$("#clhave").bind('click', function () {
    $(".pmblocks").hide();
    $("#pmhave").show();
});
$("#cldo").bind('click', function () {
    $(".pmblocks").hide();
    $("#pmdo").show();
});
$("#clsee").bind('click', function () {
    $(".pmblocks").hide();
    $("#pmsee").show();
});
$("#clwant").bind('click', function () {
    $(".pmblocks").hide();
    $("#pmwant").show();
});