$(document).ready(function () {

    //add product btn
    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        // var price = $(this).data('price');
        var price = $.number($(this).data('price') ,2);

        console.log(id + '' + price)

        $(this).removeClass('btn-success').addClass('btn-default disabled');


        var html =
            `<tr>
                <td>${name}</td>
                <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price">${price}</td>
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;
        $('.order-list').append(html);
        calculateTotal();


    })
    $('body').on('click', '.disabled', function(e) {

        e.preventDefault();

    });//end of disabled


    $('body').on('click', '.remove-product-btn', function(e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

        //to calculate total price
        calculateTotal();
    });//end of remove product btn

    $('body').on('keyup change', '.product-quantity', function() {

        // var productPrice = $(this).closest('tr').find(.'product-price').html()
        var quantity =parseInt($(this).val());

        // var unitPrice = $(this).data('price');
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice ,2));

        calculateTotal();
        // var productPrice =parseInt( $(this).closest('tr').find('.product-price').html());
        // $(this).closest('tr').find('.product-price').html()
        // var totalPrice = quantity * productPrice;
        // $('.total-price').html(totalPrice)



    });//end of product quantity change


    //list all order products
    $('.order-products').on('click', function(e) {

        e.preventDefault();

        $('#loading').css('display', 'flex');

        var url = $(this).data('url');
        var method = $(this).data('method');
        $.ajax({
            url: url,
            method: method,
            success: function(data) {

                $('#loading').css('display', 'none');
                $('#order-product-list').empty();
                $('#order-product-list').append(data);

            }
        })

    });//end of order products click


    //print order
    $(document).on('click', '.print-btn', function() {

        $('#print-area').printThis();

    });//end of click function



});//end of calculate total
function calculateTotal(){
    var price = 0;

    $('.order-list .product-price').each(function(index) {

        price += parseFloat($(this).html().replace(/,/g, ''));
    });
    $('.total-price').html($.number(price , 2));

    if (price > 0) {

        $('#add-order-form-btn').removeClass('disabled')

    } else {

        $('#add-order-form-btn').addClass('disabled')

    }//end of else

}
