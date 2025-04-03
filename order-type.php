<?php include 'includes/header.php'; ?>
<section class="py-12">
    <div class="container mx-auto px-4 max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Order Details</h2>
        <form id="order-type-form" onsubmit="handleOrderTypeSubmit(event)" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label class="block text-lg font-medium mb-2">Order Type</label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="order_type" value="delivery" class="mr-2" checked onchange="toggleDeliveryFields()">
                        Delivery
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="order_type" value="dine-in" class="mr-2" onchange="toggleDeliveryFields()">
                        Dine-In
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium mb-2">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 border rounded" required>
            </div>
            <div id="delivery-fields">
                <div class="mb-4">
                    <label for="location" class="block text-lg font-medium mb-2">Delivery Address</label>
                    <input type="text" id="location" name="location" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="contact" class="block text-lg font-medium mb-2">Contact Number</label>
                    <input type="text" id="contact" name="contact" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Submit</button>
        </form>
    </div>
</section>

<script>
    function toggleDeliveryFields() {
        const orderType = document.querySelector('input[name="order_type"]:checked').value;
        const deliveryFields = document.getElementById('delivery-fields');
        if (orderType === 'delivery') {
            deliveryFields.style.display = 'block';
            deliveryFields.querySelectorAll('input').forEach(input => input.required = true);
        } else {
            deliveryFields.style.display = 'none';
            deliveryFields.querySelectorAll('input').forEach(input => input.required = false);
        }
    }
    toggleDeliveryFields();
</script>

<?php include 'includes/footer.php'; ?>