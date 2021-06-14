var index = 6;

window.addEventListener('load', function() {
    const selectObj = document.querySelector('#selectType');
    const allOptions = document.getElementsByName("optional");
    ind = selectObj.dataset.selected;
    if (ind == 'Kosher')
        index = 0;
    if (ind == 'Vegetarian')
        index = 1;
    if (ind == 'Vegan')
        index = 2;
    if (ind == 'Gluten-Free')
        index = 3;
    if (ind == 'Lactose-Free')
        index = 4;
    if (ind == 'Suger-Free')
        index = 5;
    if (ind == 'None')
        index = 6;
    allOptions[index].checked = true;
});