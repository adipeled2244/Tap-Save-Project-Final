var favoriteFood;
var favoriteResturant;

$(document).ready(function() {
    $.getJSON("includes/data/food_sell_most.json", function(data) {
        // console.log("get bookId");
        // var userId = '<?php echo $_SESSION["user_id"] ?>';
        var id;
        var userId = $('#favorite1').data("id");
        // var id = userId.id;
        $.each(data.users_favorites, function(i, obj) {
            console.log(i);
            if (obj.id == userId) {
                favoriteFood = obj.favorite_food;
                favoriteResturant = obj.favorite_resturant;
            }
        });
        // console.log(favoriteFood);
        // console.log(favoriteResturant);
        $('#favorite1').html(favoriteFood);
        $('#favorite2').html(favoriteResturant);
    });
});