@extends('frontend.master')

@section('headerMenu')
    @include('frontend.partial.headerMenu')
@endsection
@section('headerSearch')
    @include('frontend.partial.productSearch')
@endsection
@section('categories')
    @include('frontend.partial.categories')
@endsection
@section('operationOne')
    @include('frontend.partial.operationOne')
@endsection
@section('buyList')
    @include('frontend.partial.buyList')
@endsection
@section('operationTwo')
    @include('frontend.partial.operationTwo')
@endsection
@section('footerScripts')
    @parent
    <script>
        var billProductDetailListID = 'mCSB_1_container';
        var currentSession = '1';
        $( document ).ready(function() {
            addProductToBillbyUUID(0);
        });
        $(function()
        {
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
            $.get('/frontend/search/product/'+productUUID+ '/' + currentSession, function(response){
                $("#"+billProductDetailListID).html(response);
            });
        }

        function removeProductfromBill(id){
            $("#"+id).remove();
            removeBillProduct(id)
        }
        function removeBillProduct(code){
            $.get('/frontend/bill/removeProduct/'+productUUID+'/'+currentSession, function(response){
                console.log('it saves');
            });

        }
        function resetSearchValues(){
            $('#productID').val('');
            $('#productName').val('');
            $('#q').val('');
        }
    </script>

@endsection
