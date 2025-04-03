<?php
include './includes/db_connect.php';
include './includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmet Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Hero Section Styling */
        .hero-section {
            position: relative;
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3270&q=80') no-repeat center center;
            background-size: cover;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-text {
            z-index: 1;
            position: relative;
            color: #fff;
        }

        .typing {
            font-family: 'Courier New', monospace;
            font-size: 3rem;
            white-space: nowrap;
            overflow: hidden;
            width: 0;
            border-right: 2px solid white;
            animation: typing 4s steps(40) forwards, blink 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink {
            50% { border-color: transparent; }
        }

        .sub-heading {
            font-size: 1.25rem;
            opacity: 0;
            animation: fadeInText 2s ease-out 1s forwards;
        }

        @keyframes fadeInText {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Featured Menu Item Styling */
        .featured-menu-item {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .featured-menu-item:hover {
            transform: scale(1.05);
        }

        .featured-menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Gallery Section Styling */
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay h3 {
            color: white;
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Success Story Section Styling */
        .success-story-section {
            background-color: #f8f9fa;
        }

        .success-story-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="bg-overlay"></div>
        <div class="container h-full flex items-center hero-text">
            <div class="text-center mx-auto">
                <!-- Title with typing animation -->
                <h1 id="typing-text" class="text-4xl md:text-5xl font-bold typing"></h1>
                <!-- Sub-heading with fade-in effect -->
                <p class="text-lg md:text-xl sub-heading mt-4">Experience fine dining with our exquisite selection of dishes prepared by world-class chefs.</p>
                <div class="flex justify-center gap-4 mt-6">
                    <!-- Reserve a Table Button -->
                    <a href="/restaurant-website/reservation.php" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">Reserve a Table</a>
                    <a href="/restaurant-website/menu.php" class="border border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-gray-800 transition">Explore Menu</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Menu Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Featured Menu</h2>
            <div id="featured-menu" class="grid grid-cols-1 md:grid-cols-3 gap-6"></div>
        </div>
    </section>

    <!-- Gallery Section: Celebrate with Us -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Celebrate with Us</h2>
            <p class="text-center text-gray-600 mb-8">From birthdays to corporate events, we’ve hosted memorable celebrations. Take a look at some of our past events!</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $galleryItems = [
                    ["title" => "Birthday Celebration", "image" => "https://plus.unsplash.com/premium_photo-1691688119249-f3487d1245c7?q=80&w=1469&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"],
                    ["title" => "Anniversary Dinner", "image" => "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&auto=format&fit=crop&w=3270&q=80"],
                    ["title" => "Corporate Event", "image" => "https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=3270&q=80"],
                    ["title" => "Family Gathering", "image" => "https://images.unsplash.com/photo-1541532713592-79a0317b6b77?q=80&w=1376&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"],
                    ["title" => "Wedding Reception", "image" => "https://images.unsplash.com/photo-1533146303127-f2ef440cfeb5?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"],
                    ["title" => "Holiday Party", "image" => "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"],
                ];

                foreach ($galleryItems as $item) {
                    echo '<div class="gallery-item">';
                    echo '<img src="' . $item["image"] . '" alt="' . $item["title"] . '">';
                    echo '<div class="gallery-overlay">';
                    echo '<h3>' . $item["title"] . '</h3>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Our Success Story Section -->
    <section class="py-12 success-story-section">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Our Success Story</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Image on the left -->
                <div>
                    <img src="https://images.unsplash.com/photo-1559910369-3924e235c1cf?q=80&w=1479&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Our Success Story" class="success-story-image">
                </div>
                <!-- Text on the right -->
                <div>
                    <h3 class="text-2xl font-bold mb-4">A Journey of Culinary Excellence</h3>
                    <p class="text-gray-600 mb-4">
                        Since our humble beginnings in 2010, Gourmet Haven has grown from a small family-owned restaurant to a renowned dining destination. Our passion for culinary arts and commitment to using the freshest ingredients have earned us numerous awards and a loyal customer base.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Over the years, we’ve expanded our menu to include a diverse range of dishes, blending traditional recipes with modern techniques. Our team of world-class chefs continues to innovate, ensuring every visit to Gourmet Haven is a memorable experience.
                    </p>
                    <a href="/restaurant-website/about.php" class="text-blue-500 hover:underline">Learn More About Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">What Our Guests Say</h2>
            <div id="testimonialCarousel" class="relative">
                <div class="overflow-hidden">
                    <div id="testimonialItems" class="flex transition-transform duration-500"></div>
                </div>
                <button id="prevTestimonial" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">❮</button>
                <button id="nextTestimonial" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">❯</button>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-12 bg-blue-500 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Experience Swad?</h2>
            <p class="text-lg mb-6">Book your table now and embark on a culinary journey that will delight your senses.</p>
            <div class="flex justify-center gap-4">
                <a href="/restaurant-website/modules/reservation.php" class="bg-white text-blue-500 px-6 py-3 rounded-lg hover:bg-gray-100 transition">Make a Reservation</a>
                <a href="/restaurant-website/modules/food_ordering.php" class="border border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-blue-500 transition">Order Online</a>
            </div>
        </div>
    </section>

    <script>
        // Continuous Typing Animation with Multiple Quotations
        const quotes = [
            "A Culinary Journey For Your Senses",
            "Savor the Finest Flavors in Town",
            "Where Every Bite Tells a Story",
            "Indulge in Exquisite Dining",
            "Taste the Art of Gourmet"
        ];
        let currentQuoteIndex = 0;
        const typingText = document.getElementById('typing-text');

        function typeQuote() {
            typingText.textContent = quotes[currentQuoteIndex];
            typingText.style.width = '0';
            typingText.classList.remove('typing');
            void typingText.offsetWidth; // Trigger reflow to restart animation
            typingText.classList.add('typing');
        }

        function cycleQuotes() {
            typeQuote();
            currentQuoteIndex = (currentQuoteIndex + 1) % quotes.length;
        }

        // Start the animation and cycle every 6 seconds
        cycleQuotes();
        setInterval(cycleQuotes, 6000);

        // Fetch Featured Menu Items
        fetch('/restaurant-website/api/get_menu.php')
            .then(response => response.json())
            .then(data => {
                const featuredMenu = document.getElementById('featured-menu');
                // Select the first 3 items as featured
                const featuredItems = data.slice(0, 3);
                featuredItems.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'featured-menu-item';
                    itemDiv.innerHTML = `
                        <img src="${item.image}" alt="${item.name}">
                        <div class="p-4">
                            <h5 class="text-lg font-bold">${item.name}</h5>
                            <p class="text-gray-600 text-sm mb-2">${item.description}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-500 font-bold">₹${item.price}</span>
                                <a href="/restaurant-website/modules/food_ordering.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Taste Now</a>
                            </div>
                        </div>
                    `;
                    featuredMenu.appendChild(itemDiv);
                });
            })
            .catch(error => console.error('Error fetching menu:', error));

        // Testimonials Carousel
        const testimonials = [
            { name: "John Smith", quote: "The attention to detail in every dish is remarkable. Definitely the best dining experience I've had in years.", image: "https://randomuser.me/api/portraits/men/32.jpg" },
            { name: "Emily Johnson", quote: "Not only was the food exceptional, but the service was impeccable. We felt welcomed from the moment we stepped in.", image: "https://randomuser.me/api/portraits/women/44.jpg" },
            { name: "Michael Wong", quote: "The chef's tasting menu was a culinary journey I won't forget. Each course was better than the last.", image: "https://randomuser.me/api/portraits/men/62.jpg" }
        ];

        let currentTestimonialIndex = 0;
        const testimonialItems = document.getElementById('testimonialItems');
        const prevTestimonial = document.getElementById('prevTestimonial');
        const nextTestimonial = document.getElementById('nextTestimonial');

        function renderTestimonials() {
            testimonialItems.innerHTML = '';
            testimonials.forEach((testimonial, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'flex-shrink-0 w-full text-center';
                itemDiv.innerHTML = `
                    <img src="${testimonial.image}" class="rounded-full w-24 h-24 mx-auto mb-4" alt="${testimonial.name}">
                    <p class="text-gray-600 italic mb-2">"${testimonial.quote}"</p>
                    <h5 class="font-bold">${testimonial.name}</h5>
                `;
                testimonialItems.appendChild(itemDiv);
            });
            updateTestimonialPosition();
        }

        function updateTestimonialPosition() {
            testimonialItems.style.transform = `translateX(-${currentTestimonialIndex * 100}%)`;
        }

        prevTestimonial.addEventListener('click', () => {
            currentTestimonialIndex = (currentTestimonialIndex - 1 + testimonials.length) % testimonials.length;
            updateTestimonialPosition();
        });

        nextTestimonial.addEventListener('click', () => {
            currentTestimonialIndex = (currentTestimonialIndex + 1) % testimonials.length;
            updateTestimonialPosition();
        });

        // Auto-slide testimonials every 5 seconds
        setInterval(() => {
            currentTestimonialIndex = (currentTestimonialIndex + 1) % testimonials.length;
            updateTestimonialPosition();
        }, 5000);

        renderTestimonials();
    </script>

<?php include './includes/footer.php'; ?>
</body>
</html>