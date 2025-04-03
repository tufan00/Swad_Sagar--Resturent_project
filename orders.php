<?php include 'includes/header.php'; ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">My Orders</h2>
        <table id="orders-table" class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Order ID</th>
                    <th class="border px-4 py-2">Order Time</th>
                    <th class="border px-4 py-2">Item</th>
                    <th class="border px-4 py-2">Total (INR)</th>
                    <th class="border px-4 py-2">Type</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Delivery Tracking</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<?php include 'includes/footer.php'; ?>