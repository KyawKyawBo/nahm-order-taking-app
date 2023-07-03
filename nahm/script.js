// script.js
// Delete item
const deleteButtons = document.querySelectorAll('.delete-item');
deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
        const itemId = button.dataset.id;
        if (confirm('Are you sure you want to delete this item?')) {
            // Redirect to delete.php with itemId
            window.location.href = `delete.php?id=${itemId}`;
        }
    });
});
// Update item
const updateButtons = document.querySelectorAll('.update-item');
const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
const updateForm = document.getElementById('updateForm');
const updateIdInput = document.getElementById('update-id');
const updateNameInput = document.getElementById('update-name');
const updateCategoryInput = document.getElementById('update-category');
const updatePriceInput = document.getElementById('update-price');
updateButtons.forEach(button => {
    button.addEventListener('click', () => {
        const itemId = button.dataset.id;
        const itemName = button.dataset.name;
        const itemCategory = button.dataset.category;
        const itemPrice = button.dataset.price;
        updateIdInput.value = itemId;
        updateNameInput.value = itemName;
        updateCategoryInput.value = itemCategory;
        updatePriceInput.value = itemPrice;
        updateModal.show();
    });
});
updateForm.addEventListener('submit', (e) => {
    // Prevent form submission
    e.preventDefault();
    // Submit the form
    updateForm.submit();
});
