// Global menu items array
let menuItems = [];
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function addToCart(item) {
    const existingItem = cart.find(cartItem => cartItem.id === item.id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ ...item, quantity: 1 });
    }
    saveCart();
    updateCartDisplay();
}

function addToCartById(itemId) {
    const item = menuItems.find(item => item.id === itemId);
    if (item) {
        addToCart(item);
    } else {
        console.error('Item not found:', itemId);
    }
}

function removeFromCart(itemId) {
    const existingItem = cart.find(item => item.id === itemId);
    if (existingItem) {
        if (existingItem.quantity > 1) {
            existingItem.quantity -= 1;
        } else {
            cart = cart.filter(item => item.id !== itemId);
        }
        saveCart();
        updateCartDisplay();
    }
}

function updateCartDisplay() {
    const cartItemsDiv = document.getElementById('cart-items');
    const cartSubtotal = document.getElementById('cart-subtotal');
    const cartTotal = document.getElementById('cart-total');
    const checkoutButton = document.getElementById('checkout-button');

    if (!cartItemsDiv || !cartSubtotal || !cartTotal || !checkoutButton) return;

    cartItemsDiv.innerHTML = '';
    let subtotal = 0;

    if (cart.length === 0) {
        cartItemsDiv.innerHTML = '<p class="text-gray-500 text-center py-4">Your cart is empty</p>';
        cartSubtotal.textContent = '₹0.00';
        cartTotal.textContent = '₹0.00';
        checkoutButton.disabled = true;
        return;
    }

    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        const itemDiv = document.createElement('div');
        itemDiv.className = 'flex justify-between items-center border-b py-2';
        itemDiv.innerHTML = `
            <div class="flex items-center">
                <div class="mr-4">
                    <button onclick="removeFromCart(${item.id})" class="text-gray-400 hover:text-gray-500">-</button>
                    <span class="mx-2">${item.quantity}</span>
                    <button onclick="addToCartById(${item.id})" class="text-gray-400 hover:text-gray-500">+</button>
                </div>
                <div>
                    <h3 class="font-medium">${item.name}</h3>
                    <p class="text-sm text-gray-500">₹${item.price} each</p>
                </div>
            </div>
            <span class="font-medium">₹${itemTotal.toFixed(2)}</span>
        `;
        cartItemsDiv.appendChild(itemDiv);
    });

    cartSubtotal.textContent = `₹${subtotal.toFixed(2)}`;
    const total = subtotal + 5; // Delivery fee
    cartTotal.textContent = `₹${total.toFixed(2)}`;
    checkoutButton.disabled = false;

    // Save cart to session for checkout
    sessionStorage.setItem('cart', JSON.stringify(cart));
}

function populateMenu() {
    const categoriesDiv = document.getElementById('categories');
    const menuItemsDiv = document.getElementById('menu-items');

    if (!categoriesDiv || !menuItemsDiv) return;

    // Populate categories
    const categories = ['All', ...new Set(menuItems.map(item => item.category))];
    categoriesDiv.innerHTML = '';
    categories.forEach(category => {
        const button = document.createElement('button');
        button.className = `px-4 py-2 rounded-full whitespace-nowrap text-sm font-medium transition-all duration-300 hover:shadow-lg ${category === 'All' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'}`;
        button.textContent = category;
        button.onclick = () => {
            categoriesDiv.querySelectorAll('button').forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));
            button.classList.add('bg-blue-500', 'text-white');
            const filteredItems = category === 'All' ? menuItems : menuItems.filter(item => item.category === category);
            menuItemsDiv.innerHTML = '';
            filteredItems.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'bg-white rounded-lg overflow-hidden border shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-102';
                itemDiv.innerHTML = `
                    <div class="grid grid-cols-3">
                        <div class="col-span-1 overflow-hidden">
                            <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
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
        };
        categoriesDiv.appendChild(button);
    });

    // Trigger click on "All" category to load all items initially
    categoriesDiv.querySelector('button').click();
}

// Fetch menu items on page load
document.addEventListener('DOMContentLoaded', () => {
    fetch('/restaurant-website/api/get_menu.php')
        .then(response => response.json())
        .then(data => {
            menuItems = data;
            populateMenu();
            updateCartDisplay();
        })
        .catch(error => console.error('Error fetching menu:', error));
});

// Handle order type form submission
function handleOrderTypeSubmit(event) {
    event.preventDefault();
    const orderType = document.querySelector('input[name="order_type"]:checked').value;
    const name = document.getElementById('name').value;
    const location = document.getElementById('location')?.value;
    const contact = document.getElementById('contact')?.value;

    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    const orderData = {
        order_type: orderType,
        name: name,
        items: cart,
        total_amount: cart.reduce((total, item) => total + (item.price * item.quantity), 0) + 5,
        delivery_address: orderType === 'delivery' ? `${location}, Contact: ${contact}` : null
    };

    // Send order data to PHP backend via AJAX
    const xhrOrder = new XMLHttpRequest();
    xhrOrder.open('POST', '/restaurant-website/api/place_order.php', true);
    xhrOrder.setRequestHeader('Content-Type', 'application/json');
    xhrOrder.onreadystatechange = function () {
        if (xhrOrder.readyState === 4) {
            if (xhrOrder.status === 200) {
                const response = JSON.parse(xhrOrder.responseText);
                if (response.success) {
                    if (orderType === 'dine-in') {
                        // Show popup with order ID for dine-in
                        if (confirm(`Order placed successfully! Your Order ID is ${response.order_id}. Click OK to return to the main page.`)) {
                            localStorage.removeItem('cart');
                            sessionStorage.removeItem('cart');
                            window.location.href = '/restaurant-website/index.php';
                        }
                    } else {
                        // Redirect to payment page for delivery
                        window.location.href = `/restaurant-website/payment.php?order_id=${response.order_id}`;
                    }
                } else {
                    alert('Error placing order: ' + response.message);
                }
            } else {
                alert('Error placing order: Network error');
            }
        }
    };
    xhrOrder.onerror = function () {
        alert('Error placing order: Network error');
    };
    xhrOrder.send(JSON.stringify(orderData));
}

// Handle payment form submission
function handlePaymentSubmit(event) {
    event.preventDefault();
    const orderId = new URLSearchParams(window.location.search).get('order_id');
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

    if (!orderId || !paymentMethod) {
        alert('Missing order ID or payment method');
        return;
    }

    const paymentData = {
        order_id: orderId,
        payment_method: paymentMethod
    };

    const xhrPayment = new XMLHttpRequest();
    xhrPayment.open('POST', '/restaurant-website/api/process_payment.php', true);
    xhrPayment.setRequestHeader('Content-Type', 'application/json');
    xhrPayment.onreadystatechange = function () {
        if (xhrPayment.readyState === 4) {
            if (xhrPayment.status === 200) {
                const response = JSON.parse(xhrPayment.responseText);
                if (response.success) {
                    alert('Payment successful! Your order has been placed.');
                    localStorage.removeItem('cart');
                    sessionStorage.removeItem('cart');
                    window.location.href = '/restaurant-website/orders.php';
                } else {
                    alert('Payment failed: ' + response.message);
                }
            } else {
                alert('Error processing payment: Network error');
            }
        }
    };
    xhrPayment.onerror = function () {
        alert('Error processing payment: Network error');
    };
    xhrPayment.send(JSON.stringify(paymentData));
}

// Fetch and display orders
function fetchOrders() {
    const ordersTable = document.getElementById('orders-table');
    if (!ordersTable) return;

    const xhrOrders = new XMLHttpRequest();
    xhrOrders.open('GET', '/restaurant-website/api/get_orders.php', true);
    xhrOrders.onreadystatechange = function () {
        if (xhrOrders.readyState === 4 && xhrOrders.status === 200) {
            const orders = JSON.parse(xhrOrders.responseText);
            const tbody = ordersTable.querySelector('tbody');
            tbody.innerHTML = '';

            if (orders.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No orders found.</td></tr>';
                return;
            }

            orders.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="border px-4 py-2">${order.order_id}</td>
                    <td class="border px-4 py-2">${order.created_at}</td>
                    <td class="border px-4 py-2">${order.item}</td>
                    <td class="border px-4 py-2">₹${order.total_amount.toFixed(2)}</td>
                    <td class="border px-4 py-2">${order.type}</td>
                    <td class="border px-4 py-2">${order.status}</td>
                    <td class="border px-4 py-2">${order.delivery_tracking || 'N/A'}</td>
                `;
                tbody.appendChild(row);
            });
        }
    };
    xhrOrders.send();
}

// Fetch and display reservations
function fetchReservations() {
    const reservationsTable = document.getElementById('reservations-table');
    if (!reservationsTable) return;

    const xhrReservations = new XMLHttpRequest();
    xhrReservations.open('GET', '/restaurant-website/api/get_reservations.php', true);
    xhrReservations.onreadystatechange = function () {
        if (xhrReservations.readyState === 4 && xhrReservations.status === 200) {
            const reservations = JSON.parse(xhrReservations.responseText);
            const tbody = reservationsTable.querySelector('tbody');
            tbody.innerHTML = '';

            if (reservations.length === 0) {
                tbody.innerHTML = '<tr><td colspan="15" class="text-center py-4">No reservations found.</td></tr>';
                return;
            }

            reservations.forEach(reservation => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="border px-4 py-2">${reservation.reservation_id || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.customer_id || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.name || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.email || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.phone || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.date || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.time || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.party_size}</td>
                    <td class="border px-4 py-2">${reservation.table_id || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.occasion || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.special_requests || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.status || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.modified_by || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.last_updated_by || 'N/A'}</td>
                    <td class="border px-4 py-2">${reservation.created_at || 'N/A'}</td>
                `;
                tbody.appendChild(row);
            });
        }
    };
    xhrReservations.send();
}

// Load orders and reservations on page load
document.addEventListener('DOMContentLoaded', () => {
    fetchOrders();
    fetchReservations();
});