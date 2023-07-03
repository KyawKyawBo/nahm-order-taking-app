<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        .menu-category {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Menu</h1>
        <?php
        // Fetch food items grouped by category from the database
        require_once '../nahm/connection.php';
        // Define the desired category order
        $categoryOrder = [
            "Fast Cook",
            "Medium Cook",
            "Long Cook",
            "Cocktail",
            "Beer & Cider",
            "Spirits",
            "Sodas & Juices",
            "Water",
            "DIGESTIVES",
            "Wine",
            "Sweets",
            "Coffee & Tea",
            "Juice"
        ];
        // Generate a comma-separated list of categories for sorting
        $categoryList = "'" . implode("','", $categoryOrder) . "'";
        $query = "SELECT category, GROUP_CONCAT(CONCAT('<i class=\"fas fa-star\"></i> ', name, ' - $', price) SEPARATOR '<br>') AS items
              FROM food_item
              WHERE category IN ($categoryList)
              GROUP BY category
              ORDER BY FIELD(category, $categoryList)";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category = $row['category'];
                $items = $row['items'];
                ?>
                <div class="menu-category">
                    <h2>
                        <?php
                        // Set the appropriate Font Awesome icon for each category
                        $categoryIcon = "";
                        switch ($category) {
                            case "Fast Cook":
                                $categoryIcon = "fas fa-utensils";
                                break;
                            case "Medium Cook":
                                $categoryIcon = "fas fa-pepper-hot";
                                break;
                            case "Long Cook":
                                $categoryIcon = "fas fa-clock";
                                break;
                            case "Cocktail":
                                $categoryIcon = "fas fa-cocktail";
                                break;
                            case "Beer & Cider":
                                $categoryIcon = "fas fa-beer";
                                break;
                            case "Spirits":
                                $categoryIcon = "fas fa-glass-whiskey";
                                break;
                            case "Sodas & Juices":
                                $categoryIcon = "fas fa-glass-martini";
                                break;
                            case "Water":
                                $categoryIcon = "fas fa-tint";
                                break;
                            case "DIGESTIVES":
                                $categoryIcon = "fas fa-pills";
                                break;
                            case "Wine":
                                $categoryIcon = "fas fa-wine-glass-alt";
                                break;
                            case "Sweets":
                                $categoryIcon = "fas fa-cookie";
                                break;
                            case "Coffee & Tea":
                                $categoryIcon = "fas fa-coffee";
                                break;
                            case "Juice":
                                $categoryIcon = "fas fa-glass-cheers";
                                break;
                        }
                        ?>
                        <i class="<?php echo $categoryIcon; ?>"></i>
                        <?php echo $category; ?>
                    </h2>
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <?php
                            $itemArray = explode("<br>", $items);
                            foreach ($itemArray as $item) {
                                echo "<tr><td>" . $item . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
        } else {
            echo "No food items found.";
        }
        // Close the database connection
        $conn->close();
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-refresh the page every 5 seconds
        setInterval(function () {
            location.reload();
        }, 5000);
    </script>
</body>
</html>