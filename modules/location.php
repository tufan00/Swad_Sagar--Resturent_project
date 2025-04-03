<?php include '../includes/header.php'; ?>

<?php
// Sample locations data
$locations = [
    [
        'id' => 1,
        'name' => 'Downtown',
        'address' => '123 Gourmet Street, Foodville, FD 12345',
        'phone' => '+1 (555) 123-4567',
        'hours' => [
            'monFri' => '11:00 AM - 10:00 PM',
            'sat' => '10:00 AM - 11:00 PM',
            'sun' => '10:00 AM - 9:00 PM'
        ],
        'mapUrl' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0673431557898!2d-122.4195349!3d37.7749295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808580a734e582d3%3A0x7fddbd9b1b4fd747!2sSan%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2sus!4v1685296854388!5m2!1sen!2sus'
    ],
    [
        'id' => 2,
        'name' => 'Waterfront',
        'address' => '456 Seaside Avenue, Bayside, FD 67890',
        'phone' => '+1 (555) 987-6543',
        'hours' => [
            'monFri' => '11:00 AM - 10:00 PM',
            'sat' => '10:00 AM - 11:00 PM',
            'sun' => '10:00 AM - 9:00 PM'
        ],
        'mapUrl' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0673431557898!2d-122.4195349!3d37.7749295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808580a734e582d3%3A0x7fddbd9b1b4fd747!2sSan%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2sus!4v1685296854388!5m2!1sen!2sus'
    ]
];
?>

<section class="py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Location</h2>
        <p>Find our restaurant location here.</p>
    </div>
</section>

<div class="container">
    <?php foreach ($locations as $location): ?>
    <div class="location-box mb-8 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex flex-wrap justify-between">
            <!-- Left Side: Location Details -->
            <div class="w-full lg:w-1/2 mb-6 lg:mb-0">
                <h2 class="text-2xl font-bold mb-4"><?php echo $location['name']; ?> Location</h2>
                <p><strong>Address:</strong> <?php echo $location['address']; ?></p>
                <p><strong>Phone:</strong> <?php echo $location['phone']; ?></p>
                <p><strong>Hours:</strong></p>
                <p>Mon-Fri: <?php echo $location['hours']['monFri']; ?></p>
                <p>Saturday: <?php echo $location['hours']['sat']; ?></p>
                <p>Sunday: <?php echo $location['hours']['sun']; ?></p>
                <div class="mt-4">
                    <a href="<?php echo $location['mapUrl']; ?>" class="btn btn-outline" target="_blank">Get Directions</a>
                    <a href="tel:<?php echo $location['phone']; ?>" class="btn btn-outline">Call Us</a>
                </div>
            </div>

            <!-- Right Side: Map -->
            <div class="w-full lg:w-1/2">
                <iframe src="<?php echo $location['mapUrl']; ?>" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>
