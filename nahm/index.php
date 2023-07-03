<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Item CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1>Food Item CRUD</h1>
        <!-- Create Form -->
        <h2>Create Food Item</h2>
        <form id="create-form" method="POST" action="create.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" onkeyup="checkNameAvailability()"
                    required>
                <div style="display:none;" id="error-message" class="error-message mt-2 btn"></div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <?php
                    // Include the database connection file
                    require_once 'connection.php';
                    // Fetch unique category names
                    $sql = "SELECT DISTINCT category FROM food_item";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["category"] . "'>" . $row["category"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        <!-- Read Table -->
        <!-- Read Table -->
        <h2 class="mt-4">Food Items</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display food items -->
                <?php
                // Define the desired category order
                $categoryOrder = [
                    'Fast Cook',
                    'Medium Cook',
                    'Long Cook',
                    'Cocktail',
                    'Beer & Cider',
                    'Spirits',
                    'Sodas & Juices',
                    'Water',
                    'DIGESTIVES',
                    'Wine',
                    'Sweets',
                    'Coffee & Tea',
                    'Juice'
                ];
                // Fetch and display food items in the specified category order
                $sql = "SELECT * FROM food_item ORDER BY FIELD(category, '" . implode("','", $categoryOrder) . "')";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row["name"]; ?>
                            </td>
                            <td>
                                <?php echo $row["category"]; ?>
                            </td>
                            <td>
                                <?php echo $row["price"]; ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-danger delete-item" data-id="<?php echo $row["id"]; ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary update-item" data-id="<?php echo $row["id"]; ?>"
                                    data-name="<?php echo $row["name"]; ?>" data-category="<?php echo $row["category"]; ?>"
                                    data-price="<?php echo $row["price"]; ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                <tr>
                    <td colspan="4">No food items found</td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Food Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateForm" action="update.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="update-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="update-category" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="update-price" name="price"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="update-id" name="id">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="check-script.js"></script>
    <script src="script.js"></script>
</body>
</html>