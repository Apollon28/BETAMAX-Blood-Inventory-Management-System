<?php
session_start();
include 'database.php';

if (!isset($_SESSION['userID'])) {
    die("User not logged in.");
}

$userID = $_SESSION['userID'];

if (!isset($_SESSION['cart'][$userID])) {
    $_SESSION['cart'][$userID] = [];
}

$cart = $_SESSION['cart'][$userID];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betamax: Blood Management System</title>
    <link rel="stylesheet" href="dash.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="nav-container">
                <div class="left">
                    <a href="4-dash.html">
                    <img src="logo_notext.png" alt="logo" height="65px" width="65px">
                    </a>
                </div>
                <div class="center">
                    <a href="4-dash.html">
                    <img src="textlogo.png" alt="logo" height="80px"> 
                </a>
                </div>
                <div class="right">
                    <a href="14-profile.html">
                        <img src="profile.png" alt="logo" height="40px" width="40px">
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="content-container">
            <section id="faqs">
                <h2><a href="13-faqs.html">FAQs</a></h2>
            </section>
            <div class="right-content">
                <section id="donate">
                    <h2><a href="5-donate.html">DONATE</a></h2>
                </section>
                <section id="request">
                    <h2><a href="10-request.html">REQUEST</a></h2>
                </section>
            </div>
        </div>
    </main>
    <div class="flex-container">
        <div class="left-side">
            <img src="blood-inventory.png" alt="Blood Inventory" height="60px" width="500px">
        </div>
        <div class="right-side">
            <img src="cart.png" alt="Cart" height="30px" width="30px">
        </div>
    </div>

    <div class="yourcart">
        <section class="y-cart">
            <h3>YOUR CART</h3>
            <?php foreach ($cart as $bloodType => $quantity): ?>
                <div class="cart-item" data-blood-type="<?php echo $bloodType; ?>">
                    <span><?php echo $bloodType; ?></span>
                    <input type="number" class="quantity-input" name="quantity" min="1" max="100" value="<?php echo $quantity; ?>">
                    <button class="update-quantity" data-blood-type="<?php echo $bloodType; ?>">Update</button>
                    <button class="remove-item" data-blood-type="<?php echo $bloodType; ?>">Remove</button>
                </div>
            <?php endforeach; ?>
        </section>
    </div>

    <div class="total">
        <section class="ttl">
            <h3>TOTAL UNITS: <span id="total-units">0</span></h3>
        </section>
    </div>

    <div class="proceed">
        <section class="button-total">
            <a href="12-requestform.php">
            <button id="proceedButton">Proceed to Request</button>
            </a>
        </section>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartItems = document.querySelectorAll('.cart-item');
    const totalUnitsElement = document.getElementById('total-units');

    function updateTotalUnits() {
        let totalUnits = 0;
        cartItems.forEach(item => {
            const quantityInput = item.querySelector('.quantity-input');
            totalUnits += parseInt(quantityInput.value);
        });
        totalUnitsElement.textContent = totalUnits;
    }

    cartItems.forEach(item => {
        const updateButton = item.querySelector('.update-quantity');
        const removeButton = item.querySelector('.remove-item');

        updateButton.addEventListener('click', function() {
            const bloodType = this.dataset.bloodType;
            const quantityInput = item.querySelector('.quantity-input');
            const quantity = parseInt(quantityInput.value);

            fetch('update_cart_quantity.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ blood_type: bloodType, quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Quantity updated');
                    updateTotalUnits();
                } else {
                    alert('Failed to update quantity');
                }
            });
        });

        removeButton.addEventListener('click', function() {
            const bloodType = this.dataset.bloodType;

            fetch('remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ blood_type: bloodType })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Item removed');
                    item.remove();
                    updateTotalUnits();
                } else {
                    alert('Failed to remove item');
                }
            });
        });
    });

    updateTotalUnits();
});
</script>

</body>
</html>
