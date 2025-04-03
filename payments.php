<?php include 'includes/header.php'; ?>
<section class="py-12">
    <div class="container mx-auto px-4 max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Payment</h2>
        <form id="payment-form" onsubmit="handlePaymentSubmit(event)" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label class="block text-lg font-medium mb-2">Select Payment Method</label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="credit_card" class="mr-2" checked>
                        Credit Card
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="paypal" class="mr-2">
                        PayPal
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="cash_on_delivery" class="mr-2">
                        Cash on Delivery
                    </label>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Pay Now</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>