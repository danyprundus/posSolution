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
        $(function()
        {
            $( "#productName" ).autocomplete({
                source: "frontend/search/autocomplete",
                minLength: 3,
                select: function(event, ui) {
                    $('#q').val(ui.item.value);
                    $('#productID').val(ui.item.id);
                    addProductToBillbyUUID(ui.item.id);

                }
            });
        });
        $("#productName")._onChange(function(e) {
            if(e.which == 13) {
                addProductToBillbyUUID($("#productID").val());
            }
        });
        function addProductToBillbyUUID(productUUID){
            $.get('/frontend/search/product/'+productUUID, function(response){
                $("#"+billProductDetailListID).append(response);
                saveBillProduct(productUUID);
            });
        }
        function removeProductfromBill(id){
            $("#"+id).remove();
            removeBillProduct(id)
        }
        function saveBillProduct(uuid) {
            $.get('/frontend/bill/saveProduct/' + uuid + '/' + currentSession, function (response) {
                console.log('it saves');
            });
        }
        function removeBillProduct(code){
            $.get('/frontend/bill/removeProduct/'+productUUID+'/'+currentSession, function(response){
                console.log('it saves');
            });

        }
        function updateBillCalculation(){

        }
    </script>

@endsection
