var billProductDetailListID = 'mCSB_2_container';
var billCalculations = 'billCalculations';
var currentSession = '1';
$( document ).ready(function() {
    addProductToBillbyUUID(0);
    billCalculate();
    $( "#productName" ).keyup(function() {
        doSearch($(this).val());

    });
    $('.cauta_lt input').click(function(e){
        doSearch($(this).val());
    })

    $('html').click(function(e) {
        if (e.target.id != 'menuWraper'  && $(e.target).parents('#menuWraper').length == 0 ) {
            $('.pop_up5').hide();
        }
    })


});
$("#resetSearch").click(function(e) {
    //repeat last search
    doSearch(localStorage.searchTerm);
    //fill input
    $( "#productName" ).val(localStorage.searchTerm);
});
function doSearch(term){
    $.get('frontend/search/autocomplete/?term='+term, function(response){
       $(".pop_up5").html(response);
        $('.main_bk_bt ul li a,.bk_lt a').click(function(e) {
            var tar = '.'+ $(this).attr('id');
            $(tar).lightbox_me({
                centered: true
            });
            e.preventDefault();
            $(".close").click(function(e){
                $('.pop_up1').trigger('close');
            });
        });

        $(".pop_up5").show();

        $("#searchResponseScroll").mCustomScrollbar({
            axis:"yx",
            scrollButtons:{enable:true},
            theme:"light-thick",
            scrollbarPosition:"outside"
        });
        console.log('change');

        //save to local storage
        localStorage.searchTerm = term
    });

}
$("#productName").keyup(function(e) {
    console.log('key pressed');
    if(e.which == 13) {
        addProductToBillbyUUID($("#productID").val());
    }
});
function addProductToBillbyUUID(productUUID){
    console.log('frontend/search/product/'+productUUID+ '/' + currentSession)
    $.get('frontend/search/product/'+productUUID+ '/' + currentSession, function(response){
        $("#"+billProductDetailListID).html(response);
        resetSearchValues();
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
    $('.pop_up5').hide();
    $('#productName').val('');
    $('#q').val('');
}
function billCalculate(){
    console.log(arguments.callee.name);
    $.get('frontend/bill/calculations/'+ currentSession, function(response){
        $("#"+billCalculations).html(response);
    });
}