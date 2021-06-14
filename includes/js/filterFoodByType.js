window.addEventListener('load', () => {
    var checkList = document.getElementById('list1');
    var itemslist = document.getElementById('items');
    checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
        if (itemslist.classList.contains('visible')) {
            itemslist.classList.remove('visible');
            itemslist.style.display = "none";
        } else {
            itemslist.classList.add('visible');
            itemslist.style.display = "block";
        }

    }

    itemslist.onblur = function(evt) {
        itemslist.classList.remove('visible');
    }


    // checkbox filter 

    function filtersort() {

        var options = ["Vegetarian", "Kosher", "Gluten-Free", "Vegan", "Lactose-Free", "Suger-Free"];

        options.map((option, index) => {
            document.getElementById(option).onclick = function() {
                var checkIfChecked = document.getElementById(option);
                // 'string'
                // "."+option
                // `.${option}.jhj`
                var all = document.getElementsByClassName(option);
                if (checkIfChecked.checked) {
                    for (var i = 0; i < all.length; i++) {
                        all[i].style.display = "block";
                    }
                } else {
                    for (var i = 0; i < all.length; i++) {
                        all[i].style.display = "none";
                    }
                }
            }
        })
    }
    filtersort();
})