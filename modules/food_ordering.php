<?php include '../includes/header.php'; ?>


<section class="relative">

    <div class="absolute inset-0 bg-gradient-to-r from-black to-black/50 z-10"></div>
    <div class="relative h-96">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1576867757603-05b134ebc379?ixlib=rb-4.0.3&auto=format&fit=crop&w=3270&q=80');"></div>
        <div class="container mx-auto px-4 h-full flex items-center justify-center relative z-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Order Online</h1>
                <p class="text-xl text-white max-w-2xl mx-auto">Enjoy our delicious meals in the comfort of your home</p>
            </div>
        </div>
    </div>
</section>

<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Our Menu</h2>
                    <div class="flex overflow-x-auto pb-2 -mx-2 scrollbar-none">
                        <div class="flex space-x-2" id="categories"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="menu-items"></div>
            </div>
            <div class="lg:col-span-1">
                <div class="bg-white border rounded-lg shadow-sm p-6 sticky top-24">
                    <h2 class="text-2xl font-bold mb-4">Your Order</h2>
                    <div id="cart-items" class="space-y-4 mb-6 max-h-72 overflow-y-auto pr-2"></div>
                    <div class="border-t pt-4">
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span id="cart-subtotal">₹0.00</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Delivery Fee</span>
                            <span>₹5.00</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg mt-4">
                            <span>Total</span>
                            <span id="cart-total">₹0.00</span>
                        </div>
                        <button id="checkout-button" class="w-full mt-6 bg-blue-500 text-white py-2 rounded hover:bg-blue-600 disabled:bg-gray-400" disabled onclick="window.location.href='../order-type.php'">Proceed to Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-center">Delivery Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-102">
                    <div class="text-blue-500 text-3xl mb-4">🚚</div>
                    <h3 class="text-lg font-bold mb-2">Delivery Areas</h3>
                    <p class="text-gray-600">We deliver within a 5-mile radius of our restaurant. Enter your address at checkout to confirm delivery availability.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-102">
                    <div class="text-blue-500 text-3xl mb-4">⏱️</div>
                    <h3 class="text-lg font-bold mb-2">Delivery Times</h3>
                    <p class="text-gray-600">Delivery available from 11:30 AM to 9:30 PM daily. Average delivery time is 30-45 minutes depending on your location.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-102">
                    <div class="text-blue-500 text-3xl mb-4">📦</div>
                    <h3 class="text-lg font-bold mb-2">Packaging</h3>
                    <p class="text-gray-600">All our food is carefully packaged to maintain temperature and quality. We use eco-friendly packaging materials.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Fetch menu items from the API
fetch('/restaurant-website/api/get_menu.php')
    .then(response => response.json())
    .then(data => {
        const categoriesDiv = document.getElementById('categories');
        const menuItemsDiv = document.getElementById('menu-items');

        // Populate categories
        const categories = ['All', ...new Set(data.map(item => item.category))];
        categoriesDiv.innerHTML = '';
        categories.forEach(category => {
            const button = document.createElement('button');
            button.className = `px-4 py-2 rounded-full whitespace-nowrap text-sm font-medium transition-all duration-300 hover:shadow-lg ${category === 'All' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'}`;
            button.textContent = category;
            button.onclick = () => {
                categoriesDiv.querySelectorAll('button').forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));
                button.classList.add('bg-blue-500', 'text-white');
                const filteredItems = category === 'All' ? data : data.filter(item => item.category === category);
                renderMenuItems(filteredItems);
            };
            categoriesDiv.appendChild(button);
        });

        // Initial render with all items
        renderMenuItems(data);

        function renderMenuItems(items) {
            menuItemsDiv.innerHTML = '';
            items.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'bg-white rounded-lg overflow-hidden border shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-102';
                // Log the image URL for debugging
                console.log('Attempting to load image:', item.image);
                // Use the image path directly from the API
                const imagePath = item.image || 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80';
                itemDiv.innerHTML = `
                    <div class="grid grid-cols-3">
                        <div class="col-span-1 overflow-hidden">
                            <img src="${imagePath}" alt="${item.name}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110" onerror="this.src='https://via.placeholder.com/300x200?text=Image+Not+Available';">
                        </div>
                        <div class="col-span-2 p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold">${item.name}</h3>
                                <span class="text-blue-500 font-bold">₹${item.price}</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-2">${item.description}</p>
                            <p class="text-gray-500 text-xs mb-4">${item.dietary_tags ? 'Tags: ' + item.dietary_tags : ''}</p>
                            <button onclick="addToCartById(${item.id})" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Add to Order
                            </button>
                        </div>
                    </div>
                `;
                menuItemsDiv.appendChild(itemDiv);
            });
        }
    })
    .catch(error => {
        console.error('Error fetching menu:', error);
        const menuItemsDiv = document.getElementById('menu-items');
        menuItemsDiv.innerHTML = '<p class="text-center text-red-500">Failed to load menu. Please try again later.</p>';
    });

// Cart functionality (already defined in scripts.js, included via header.php)
document.addEventListener('DOMContentLoaded', () => {
    updateCartDisplay();
});
</script>

<?php include '../includes/footer.php'; ?>