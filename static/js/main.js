$(function() {
    $('#orders').load('index.php/orders/index');
    $('#save').on('click', function (e) {
        e.preventDefault();
        var form_data = {
            user_id: $('#selectUser').val(),
            product_id: $('#selectProduct').val(),
            quantity: $('#inputQuantity').val(),
            id: $('#inputEditId').val(),
            like: $('#searchBar').val().toLowerCase(),
            date_filter: $('input[name=filterRadios]:checked').val()
        };

        $.ajax({
            type: "POST",
            data: form_data,
            url: "index.php/orders/save",
            success: function (data) {
                $('#orders').load('index.php/orders/getOrders/'+form_data.date_filter+'/'+form_data.like);
                emptyForm();
            },
            error: function (err) {
                console.log(err);
            }
        });
        return false;
    });


    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();
    $('#searchBar').on('keyup', function (e) {
        var c = this.selectionStart;
        var r = /[^a-z0-9]/gi;
        var v = $(this).val();


        if(r.test(v))
        {
            $(this).val(v.replace(r, ''));
            c--;
        }
        this.setSelectionRange(c, c);


        delay(function () {
            var data = {
                like: $('#searchBar').val().toLowerCase(),
                date_filter: $('input[name=filterRadios]:checked').val()
            };
            $.ajax({
                type: "POST",
                data: data,
                url: "index.php/orders/index/",
                success: function (data) {
                    $('#orders').html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            })
        }, 1000)
    });

    $('input[name=filterRadios]').on('change', function () {
        var data = {
            like: $('#searchBar').val().toLowerCase(),
            date_filter: $('input[name=filterRadios]:checked').val()
        };
        $.ajax({
            type: "POST",
            data: data,
            url: "index.php/orders/index/",
            success: function (data) {
                $('#orders').html(data);
            },
            error: function (err) {
                console.log(err);
            }
        })
    })
});

function fillForEdit(id){
    $('#selectUser').val($('tr[data-order-id='+id+'] td[data-row="user"]').attr('data-user-id'));
    $('#selectProduct').val($('tr[data-order-id='+id+'] td[data-row="product"]').attr('data-product-id'));
    $('#inputQuantity').val($('tr[data-order-id='+id+'] td[data-row="quantity"]').attr('data-quantity'));
    $('#inputEditId').val(id);
    $('button#save').addClass('btn-warning').removeClass('btn-primary').text('Edit');
    $('#newOrder').css('border', '1px solid #eea236');
}

function emptyForm() {
    $('#inputEditId').val('');
    $('button#save').addClass('btn-primary').removeClass('btn-warning').text('Save');
    $('#inputQuantity').val('');
    $('#newOrder').css('border', 'none');
}

function deleteOrder(id) {
    if(confirm('Delete item?')){
        $.ajax({
            type : "POST",
            data: {id: id},
            url: "index.php/orders/removeOrder/",
            success : function (data) {
                console.log(data);
                $('#orders').load('index.php/orders/index/');
            },
            error : function (err) {
                console.log(err);
            }
        })
    }
}

function editOrder(id) {
    fillForEdit(id);
}