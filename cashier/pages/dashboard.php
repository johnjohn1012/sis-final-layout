<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List with Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid d-flex">
        <!-- Sidebar / Navigation -->
        <div class="col-md-2 bg-light p-3">
            <h2>Categories</h2>
            <?php
            require('./includes/connection.php');

            $category_sql = "SELECT category_id, category_name FROM tbl_categories ORDER BY category_id ASC";
            $category_result = $conn->query($category_sql);

            if ($category_result->num_rows > 0) {
                while ($category = $category_result->fetch_assoc()) {
                    echo "<button class='btn btn-primary w-100 mb-2'>" . $category["category_name"] . "</button>";
                }
            } else {
                echo "<p>No categories found</p>";
            }
            
            ?>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            <!-- Logout Button -->
            <div>
                <button class="btn btn-danger w-100" onclick="logout()">Logout</button>
            </div>
        </div>


        <!-- Product Grid -->
        <div class="col-md-7 p-3">
            <h1>Product List</h1>
            <div class="row">
                <?php
                $product_sql = "SELECT product_id, product_name, product_selling_price, product_stock_quantity, product_reorder_level FROM tbl_products";
                $product_result = $conn->query($product_sql);

                if ($product_result->num_rows > 0) {
                    while ($row = $product_result->fetch_assoc()) {
                        echo "<div class='col-md-4 mb-3'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row["product_name"] . "</h5>";
                        echo "<p class='card-text'>Price: $" . $row["product_selling_price"] . "</p>";
                        echo "<p class='card-text stock' id='stock-" . $row["product_id"] . "'>Stock: " . $row["product_stock_quantity"] . "</p>";
                        echo "<p class='card-text'>Reorder Level: " . $row["product_reorder_level"] . "</p>";
                        echo "<button class='btn btn-success' onclick='addToCheckout(" . $row["product_id"] . ")'>Add to Order</button>";
                        echo "</div></div></div>";
                    }
                } else {
                    echo "<p>No products found</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>

        <!-- Checkout Section -->
        <div class="col-md-3 p-3 bg-light">
            <h2>Checkout</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="checkout-list">
                    <!-- Dynamically filled -->
                </tbody>
            </table>

            <div class="totals">
                <div class="mb-2">
                    <label>Discount (%):</label>
                    <input type="number" id="discount" class="form-control" value="0" onchange="updateTotal()">
                </div>
                <p>Subtotal: <span id="subtotal">$0.00</span></p>
                <p>Tax: <span id="tax">$0.00</span></p>
                <h3>Total: <span id="total">$0.00</span></h3>
            </div>
            <div class="actions mt-3">
    <button class="btn btn-danger w-100 mb-2" onclick="cancelOrder()">Cancel Order</button>
    <button class="btn btn-warning w-100 mb-2" onclick="holdOrder()">Hold Order</button>
    <button class="btn btn-success w-100" onclick="payOrder()">Pay</button>
    </div>


        </div>
    </div>

    <script>
         function addToCheckout(productId) {
            const productCard = document.querySelector(`[onclick='addToCheckout(${productId})']`).closest('.card-body');
            const productName = productCard.querySelector('.card-title').innerText;
            const productPrice = productCard.querySelector('.card-text').innerText.match(/\d+(\.\d{1,2})?/)[0];
            const stockElement = document.getElementById(`stock-${productId}`);

            // Update stock in the UI
            let currentStock = parseInt(stockElement.innerText.replace('Stock: ', ''));
            if (currentStock > 0) {
                currentStock -= 1;
                stockElement.innerText = `Stock: ${currentStock}`;

                // Send request to update stock in the database
                fetch('./api/update_stock.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ product_id: productId, quantity: 1 })
})
.then(response => response.text()) // <-- Log as text first
.then(text => {
    console.log('Raw response:', text); // Check raw response
    const data = JSON.parse(text); // Then parse manually
    if (data.success) {
        console.log('Stock updated in database');
    } else {
        alert('Failed to update stock in database: ' + data.message);
    }
})
.catch(error => {
    console.error('Error:', error);
    console.log("Error nya", error);
});


                const checkoutList = document.getElementById('checkout-list');
                const existingRow = Array.from(checkoutList.getElementsByTagName('tr')).find(row => row.dataset.productId == productId);

                if (existingRow) {
                    const quantityInput = existingRow.querySelector('input');
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                } else {
                    const newRow = document.createElement('tr');
                    newRow.dataset.productId = productId;
                    newRow.innerHTML = `
                        <td>${productName}</td>
                        <td><input type="number" class="form-control" value="1" min="1" onchange="updateTotal()"></td>
                        <td>$${productPrice}</td>
                    `;
                    checkoutList.appendChild(newRow);
                }

                updateTotal();
            } else {
                alert('Out of stock!');
            }
        }

        function cancelOrder() {
            if (confirm('Are you sure you want to cancel the order?')) {
                document.getElementById('checkout-list').innerHTML = '';
                document.getElementById('subtotal').innerText = '$0.00';
                document.getElementById('tax').innerText = '$0.00';
                document.getElementById('total').innerText = '$0.00';
                document.getElementById('discount').value = 0;
                alert('Order has been canceled.');
            }
        }

        function holdOrder() {
            alert('Order is now on hold. You can retrieve it later.');
        }

        function payOrder() {
            const total = document.getElementById('total').innerText;
            if (total === '$0.00') {
                alert('No items in the order!');
            } else {
                alert(`Payment successful! Total amount: ${total}`);
                document.getElementById('checkout-list').innerHTML = '';
                document.getElementById('subtotal').innerText = '$0.00';
                document.getElementById('tax').innerText = '$0.00';
                document.getElementById('total').innerText = '$0.00';
                document.getElementById('discount').value = 0;
            }
        }

        function updateTotal() {
            let subtotal = 0;
            const rows = document.querySelectorAll('#checkout-list tr');
            
            rows.forEach(row => {
                const quantity = row.querySelector('input').value;
                const price = row.children[2].innerText.replace('$', '');
                subtotal += quantity * parseFloat(price);
            });

            const discount = parseFloat(document.getElementById('discount').value) || 0;
            const discountedAmount = subtotal * (discount / 100);
            const tax = subtotal * 0.05;

            document.getElementById('subtotal').innerText = `$${subtotal.toFixed(2)}`;
            document.getElementById('tax').innerText = `$${tax.toFixed(2)}`;
            document.getElementById('total').innerText = `$${(subtotal - discountedAmount + tax).toFixed(2)}`;
        }

        function logout() {
            window.location.href = 'http://localhost/sis-final-layout/login/index.php';
        }
    </script>
</body>
</html>
