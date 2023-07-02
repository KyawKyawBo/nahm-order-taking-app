const searchInput = document.getElementById('search-input');
const suggestionList = document.getElementById('suggestion-list');
const selectedItems = document.getElementById('selected-items');
const quantityModal = document.getElementById('quantityModal');
const quantityInput = document.getElementById('quantityInput');
const addToCartBtn = document.getElementById('addToCartBtn');
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
  })
  .catch(error => {
    console.error('Error fetching food items:', error);
  });

// Function to display suggestions based on search input
function showSuggestions(searchTerm) {
    suggestionList.innerHTML = '';

    // Filter menuItems based on search term
    const filteredItems = menuItems.filter(item =>
        item.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

    // Create suggestion list items
    filteredItems.forEach(item => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.textContent = item.name;
        suggestionList.appendChild(listItem);

        // Add click event listener to select items
        listItem.addEventListener('click', () => {
            selectedItem = item;
            quantityInput.value = '1';
            quantityModal.classList.add('show');
            quantityModal.style.display = 'block';
            searchInput.value = ''; // Clear search text
            suggestionList.innerHTML = ''; // Close suggestion list
        });
    });
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
    const selected = document.createElement('li');
    selected.className = 'list-group-item';
    selected.textContent = `${selectedItem.name} (Qty: ${quantity})`;
    selectedItems.appendChild(selected);
    quantityModal.classList.remove('show');
    quantityModal.style.display = 'none';
});
