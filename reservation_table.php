<?php include 'includes/header.php'; ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">My Reservations</h2>
        <table id="reservations-table" class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Reservation ID</th>
                    <th class="border px-4 py-2">Customer ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Phone</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Time</th>
                    <th class="border px-4 py-2">Guests</th>
                    <th class="border px-4 py-2">Table ID</th>
                    <th class="border px-4 py-2">Occasion</th>
                    <th class="border px-4 py-2">Special Requests</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Modified By</th>
                    <th class="border px-4 py-2">Last Updated By</th>
                    <th class="border px-4 py-2">Created At</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<?php include 'includes/footer.php'; ?>