var billProductDetailListID = 'mCSB_1_container';
var billCalculations = 'billCalculations';
var currentSession = '1';
$( document ).ready(function() {
    addProductToBillbyUUID(0);
    billCalculate();
    $( "#productName" ).autocomplete({
        source: "frontend/search/autocomplete",
        minLength: 3,
        select: function(event, ui) {
            $('#q').val(ui.item.value);
            $('#productID').val(ui.item.id);
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