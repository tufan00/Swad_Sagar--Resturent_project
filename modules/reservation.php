<?php include '../includes/header.php'; ?>
<section class="relative">
    <div class="absolute inset-0 bg-gradient-to-r from-black to-black/50 z-10"></div>
    <div class="relative h-[50vh]">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1521017432531-fbd92d768814?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3270&q=80');"></div>
        <div class="container mx-auto px-4 h-full flex items-center justify-center relative z-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Reserve Your Table</h1>
                <p class="text-xl text-white max-w-2xl mx-auto">Secure your spot for an unforgettable dining experience</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="grid md:grid-cols-2">
                <div class="p-8 bg-gray-800 text-white">
                    <h2 class="text-2xl font-bold mb-6">Reservation Information</h2>
                    <div class="space-y-4 text-white/80">
                        <div class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold text-white">Hours</h3>
                                <p>Monday - Friday: 11:00 AM - 10:00 PM</p>
                                <p>Saturday: 10:00 AM - 11:00 PM</p>
                                <p>Sunday: 10:00 AM - 9:00 PM</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <h3 class="font-bold text-white">Contact</h3>
                                <p>+91 1234567890</p>
                                <p>reservations@swadsagar.com</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold text-white">Location</h3>
                                <p>123 Gourmet Street</p>
                                <p>Foodville, West Bengal</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-6">Make a Reservation</h2>
                    <form id="reservation-form" class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input id="name" name="name" type="text" required class="w-full p-2 border rounded" placeholder="John Doe">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input id="email" name="email" type="email" required class="w-full p-2 border rounded" placeholder="john@example.com">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input id="phone" name="phone" type="tel" required class="w-full p-2 border rounded" placeholder="(555) 123-4567">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input id="date" name="date" type="date" required class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                                <input id="time" name="time" type="time" required class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
                                <select id="guests" name="guests" required class="w-full p-2 border rounded">
                                    <option value="">Select</option>
                                    <?php for ($i = 1; $i <= 8; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i . ($i === 1 ? ' person' : ' people'); ?></option>
                                    <?php endfor; ?>
                                    <option value="9+">9+ people</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="table_id" class="block text-sm font-medium text-gray-700 mb-1">Select a Table</label>
                            <select id="table_id" name="table_id" required class="w-full p-2 border rounded">
                                <option value="">Choose a table</option>
                                <option value="1">Table 1 (2 seats)</option>
                                <option value="2">Table 2 (4 seats)</option>
                                <option value="3">Table 3 (6 seats)</option>
                                <option value="4">Table 4 (8 seats)</option>
                                <option value="5">Table 5 (10 seats)</option>
                            </select>
                        </div>
                        <div>
                            <label for="occasion" class="block text-sm font-medium text-gray-700 mb-1">Occasion (Optional)</label>
                            <select id="occasion" name="occasion" class="w-full p-2 border rounded">
                                <option value="">Select an occasion</option>
                                <option value="Birthday">Birthday</option>
                                <option value="Anniversary">Anniversary</option>
                                <option value="Date Night">Date Night</option>
                                <option value="Business Meeting">Business Meeting</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-1">Special Requests (Optional)</label>
                            <textarea id="special_requests" name="special_requests" rows="3" class="w-full p-2 border rounded" placeholder="Any dietary restrictions or special requests?"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Book Table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Private Dining</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Host your special events in our elegant private dining rooms</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3174&q=80" alt="Private dining room" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">The Vineyard Room</h3>
                    <p class="text-gray-600 mb-4">Intimate setting for up to 12 guests, perfect for family gatherings or small celebrations.</p>
                    <button class="w-full border border-gray-300 text-gray-700 py-2 rounded hover:bg-gray-100">Inquire about The Vineyard Room</button>
                </div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1525648199074-cee30ba79a4a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3270&q=80" alt="Private dining room" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">The Grand Hall</h3>
                    <p class="text-gray-600 mb-4">Elegant space for up to 40 guests, ideal for corporate events, weddings, and large celebrations.</p>
                    <button class="w-full border border-gray-300 text-gray-700 py-2 rounded hover:bg-gray-100">Inquire about The Grand Hall</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <h2 class="text-3xl font-bold mb-8 text-center">Reservation Policies</h2>
        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-bold mb-2">Confirmation</h3>
                <p class="text-gray-600">All reservations will be confirmed via email or phone. Please ensure you provide accurate contact information.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-2">Cancellations</h3>
                <p class="text-gray-600">We kindly request at least 24 hours notice for cancellations. Late cancellations or no-shows may incur a fee.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-2">Late Arrivals</h3>
                <p class="text-gray-600">We hold reservations for 15 minutes past the scheduled time. If you're running late, please call us.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-2">Large Parties</h3>
                <p class="text-gray-600">For groups of 8 or more, a credit card is required to secure the reservation, and a set menu may be required.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-2">Children</h3>
                <p class="text-gray-600">Children are welcome in our restaurant. High chairs and children's menus are available upon request.</p>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('reservation-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    const reservationData = {
        name: formData.get('name'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        date: formData.get('date'),
        time: formData.get('time'),
        guests: formData.get('guests'),
        table_id: formData.get('table_id'),
        occasion: formData.get('occasion'),
        special_requests: formData.get('special_requests')
    };

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/restaurant-website/api/make_reservation.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('Thank you for your reservation! We\'ll contact you shortly to confirm.');
                    window.location.href = '/restaurant-website/reservation_table.php';
                } else {
                    alert('Error making reservation: ' + response.message);
                }
            } else {
                alert('Error making reservation: Network error');
            }
        }
    };
    xhr.onerror = function() {
        alert('Error making reservation: Network error');
    };
    xhr.send(JSON.stringify(reservationData));
});
</script>

<?php include '../includes/footer.php'; ?>