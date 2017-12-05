var billProductDetailListID = 'mCSB_1_container';
var billCalculations = 'billCalculations';
var currentSession = '1';
$( document ).ready(function() {
    addProductToBillbyUUID(0);
    billCalculate();
    $( "#productName" ).keyup(function() {
        console.log('keyup='+$(this).val());
        if ($(this).val().length>2){
            console.log('keyup lenght='+$(this).val().length);
            $.get('frontend/search/autocomplete/?term='+$(this).val(), function(response){
                $("#searchResponseScroll").html(response);

                $(".pop_up5").show();
            });

        }
    });

});
$("#resetSearch").click(function(e) {
    resetSearchValues();
});
$("#productName").keyup(function(e) {
    console.log('key pressed');
    if(e.which == 13) {
        addProductToBillbyUUID($("#productID").val());
    }
});
function addProductToBillbyUUID(productUUID){
    console.log(arguments.callee.name);
    $.get('frontend/search/product/'+productUUID+ '/' + currentSession, function(response){
        $("#"+billProductDetailListID).html(response);
        billCalculate();
    });

}

function removeProductfromBill(id){
    $.get('frontend/bill/removeProduct/'+id+'/'+currentSession, function(response){
        addProductToBillbyUUID(0);
    });
    resetSearchValues();
}
function resetSearchValues(){
    $('#productID').val('');
    $('#productName').val('');
    $('#q').val('');
}
function billCalculate(){
    console.log(arguments.callee.name);
    $.get('frontend/bill/calculations/'+ currentSession, function(response){
        $("#"+billCalculations).html(response);
    });
}