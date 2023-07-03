const searchInput = document.getElementById('search-input');
const suggestionList = document.getElementById('suggestion-list');
const categoryList = document.getElementById('category-list');
const selectedItems = document.getElementById('selected-items');
const quantityModal = document.getElementById('quantityModal');
const quantityInput = document.getElementById('quantityInput');
const addToCartBtn = document.getElementById('addToCartBtn');
const remarkInput = document.getElementById('remarkInput');
let selectedItem = null;
// Function to fetch food items from the database
function fetchFoodItems() {
    return new Promise((resolve, reject) => {
        fetch('fetch_food_items.php') // Modify the URL based on your server setup
            .then(response => response.json())
            .then(data => resolve(data))
            .catch(error => reject(error));
    });
}
// Fetch food items from the database
fetchFoodItems()
    .then(data => {
        menuItems = data;
        showCategories();
    })
    .catch(error => {
        console.error('Error fetching food items:', error);
    });
// Function to display categories
function showCategories() {
    const categories = [
        { name: 'Fast Cook', icon: 'fas fa-utensils' },
        { name: 'Medium Cook', icon: 'fas fa-utensil-spoon' },
        { name: 'Long Cook', icon: 'fas fa-hourglass-start' },
        { name: 'Cocktail', icon: 'fas fa-cocktail' },
        { name: 'Beer & Cider', icon: 'fas fa-beer' },
        { name: 'Spirits', icon: 'fas fa-wine-bottle' },
        { name: 'Sodas & Juices', icon: 'fas fa-glass-whiskey' },
        { name: 'Water', icon: 'fas fa-glass-whiskey' },
        { name: 'DIGESTIVES', icon: 'fas fa-glass-whiskey' },
        { name: 'Wine', icon: 'fas fa-wine-glass' },
        { name: 'Sweets', icon: 'fas fa-candy-cane' },
        { name: 'Coffee & Tea', icon: 'fas fa-coffee' },
        { name: 'Juice', icon: 'fas fa-glass-whiskey' }
    ];
    categories.forEach(category => {
        const categorySection = document.createElement('div');
        categorySection.className = 'category-section';
        categorySection.innerHTML = `
            <h3>
                <i class="${category.icon}"></i>
                ${category.name}
            </h3>
            <ul id="${category.name}" class="list-group"></ul>
        `;
        categoryList.appendChild(categorySection);
    });
}
function showSuggestions(searchTerm) {
    suggestionList.innerHTML = '';
    // Filter menuItems based on search term
    const filteredItems = menuItems.filter(item =>
        item.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
    // Create suggestion list items grouped by category
    const groupedItems = {};
    filteredItems.forEach(item => {
        if (groupedItems.hasOwnProperty(item.category)) {
            groupedItems[item.category].push(item);
        } else {
            groupedItems[item.category] = [item];
        }
    });
    // Create suggestion list items with category headers
    for (const category in groupedItems) {
        const categoryItem = document.createElement('li');
        categoryItem.className = 'list-group-item list-group-item-secondary fw-bold';
        categoryItem.textContent = category;
        suggestionList.appendChild(categoryItem);
        const items = groupedItems[category];
        items.forEach(item => {
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            listItem.textContent = item.name;
            suggestionList.appendChild(listItem);
            // Add click event listener to select items
            listItem.addEventListener('click', () => {
                selectedItem = item;
                document.getElementById('selectedItemName').textContent = selectedItem.name;
                quantityInput.value = '1';
                remarkInput.value = ''; // Clear remark input
                quantityModal.classList.add('show');
                quantityModal.style.display = 'block';
                searchInput.value = ''; // Clear search text
                suggestionList.innerHTML = ''; // Close suggestion list
            });
        });
    }
}
// Event listener for search input
searchInput.addEventListener('input', e => {
    const searchTerm = e.target.value;
    suggestionList.innerHTML = ''; // Clear suggestion list
    if (searchTerm.trim() !== '') {
        showSuggestions(searchTerm);
    }
});
// Event listener for plus button
document.getElementById('plusBtn').addEventListener('click', () => {
    const quantity = parseInt(quantityInput.value);
    quantityInput.value = quantity + 1;
});
// Event listener for minus button
document.getElementById('minusBtn').addEventListener('click', () => {
    const quantity = parseInt(quantityInput.value);
    if (quantity > 1) {
        quantityInput.value = quantity - 1;
    }
});
// Event listener for add to cart button in the modal
addToCartBtn.addEventListener('click', () => {
    const quantity = parseInt(quantityInput.value);
    const remark = remarkInput.value;
    const selected = document.createElement('li');
    selected.className = 'list-group-item';
    selected.innerHTML = `${selectedItem.name} (Qty: ${quantity})`;
    if (remark.trim() !== '') {
        const remarkSpan = document.createElement('span');
        remarkSpan.className = 'remark text-danger';
        remarkSpan.textContent = remark;
        selected.appendChild(remarkSpan);
    }
    const deleteBtn = document.createElement('button');
    deleteBtn.className = 'btn btn-link delete-item';
    deleteBtn.innerHTML = '<i class="fas fa-times"></i>';
    deleteBtn.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevent the click event from bubbling up
        selected.parentElement.removeChild(selected);
    });
    selected.appendChild(deleteBtn);
    // Find the relevant category and append the selected item
    const categoryList = document.getElementById(selectedItem.category);
    if (categoryList) {
        categoryList.appendChild(selected);
    }
    quantityModal.classList.remove('show');
    quantityModal.style.display = 'none';
});
// Event listener for close button in the modal
closeModal.addEventListener('click', () => {
    quantityModal.classList.remove('show');
    quantityModal.style.display = 'none';
});

