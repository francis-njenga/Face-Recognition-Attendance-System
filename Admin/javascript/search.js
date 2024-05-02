function searchItems() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    
    var items = document.querySelectorAll('.speakerCategory');

    items.forEach(function(item) {
        var title = item.querySelector('.speakerCategoryTitle').innerText.toLowerCase();
        var description = item.querySelector('.productInfoContainer').innerText.toLowerCase();
        
        if (title.includes(input) || description.includes(input)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
