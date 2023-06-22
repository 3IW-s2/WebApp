$(document).ready(function() {
    // update product quantity in cart
    $(".quantity").change(function() {
        var element = this;
        setTimeout(function() { update_quantity.call(element) }, 2000);
    });

    function update_quantity() {
        var pcode = $(this).attr("data-code");
        var quantity = $(this).val();
        $(this).parent().parent().fadeOut();
        $.getJSON("manage_cart.php", { "update_quantity": pcode, "quantity": quantity }, function(data) {
            window.location.reload();
        });
    }

    // add item to cart
    $(".product-form").submit(function(e) {
        var form_data = $(this).serialize();
        var button_content = $(this).find('button[type=submit]');
        button_content.html('Adding...');
        $.ajax({
            url: "manage_cart.php",
            type: "POST",
            dataType: "json",
            data: form_data
        }).done(function(data) {
            $("#cart-container").html(data.products);
            button_content.html('Add to Cart');
        })
        e.preventDefault();
    });

    //Remove items from cart
    $("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
        e.preventDefault();
        var pcode = $(this).attr("data-code");
        $(this).parent().parent().fadeOut();
        $.getJSON("manage_cart.php", { "remove_code": pcode }, function(data) {
            $("#cart-container").html(data.products);
            window.location.reload();
        });
    });
});