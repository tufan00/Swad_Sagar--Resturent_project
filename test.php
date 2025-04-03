<?php include 'includes/header.php'; ?>

<section class="relative py-16">
  <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50 z-10" />
  <div class="relative h-[40vh]">
    <div 
      class="absolute inset-0 bg-cover bg-center"
      style="background-image: url('https://images.unsplash.com/photo-1559329007-40df8a9345d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3274&q=80');"
    ></div>
    <div class="container mx-auto px-4 h-full flex items-center justify-center relative z-20">
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
          Special Offers
        </h1>
        <p class="text-xl text-white mb-4 max-w-2xl mx-auto text-background-effect">
          Discover our latest promotions and exclusive deals
        </p>
      </div>
    </div>
  </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php
        $offers = [
          [
            'id' => 1,
            'title' => 'Happy Hour Special',
            'description' => 'Enjoy 50% off select appetizers and $5 signature cocktails every weekday from 4-6 PM.',
            'validUntil' => 'Ongoing',
            'code' => 'HAPPY50',
            'image' => 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3269&q=80'
          ],
          [
            'id' => 2,
            'title' => 'Date Night Package',
            'description' => '3-course dinner for two with a bottle of wine for $99. Available every Friday and Saturday night.',
            'validUntil' => 'Ongoing',
            'code' => 'DATE99',
            'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3269&q=80'
          ],
          [
            'id' => 3,
            'title' => 'Weekday Lunch Special',
            'description' => 'Enjoy our chef\'s selection of lunch entrées for just $15, including a non-alcoholic beverage.',
            'validUntil' => 'Ongoing',
            'code' => 'LUNCH15',
            'image' => 'https://images.unsplash.com/photo-1578474846511-04ba529f0b88?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3287&q=80'
          ],
          [
            'id' => 4,
            'title' => 'Summer Tasting Menu',
            'description' => 'Experience our seasonal 5-course tasting menu featuring the freshest summer ingredients for $65 per person.',
            'validUntil' => 'September 30, 2023',
            'code' => 'SUMMER65',
            'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3287&q=80'
          ],
          [
            'id' => 5,
            'title' => 'First-Time Customer',
            'description' => 'First-time customers receive a complimentary dessert with the purchase of any entrée.',
            'validUntil' => 'Ongoing',
            'code' => 'WELCOME',
            'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3282&q=80'
          ],
          [
            'id' => 6,
            'title' => 'Sunday Family Style',
            'description' => 'Family-style dinner for 4-6 people with shared appetizers, entrées, and desserts for $150.',
            'validUntil' => 'Ongoing',
            'code' => 'FAMILY150',
            'image' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3270&q=80'
          ]
        ];

        foreach ($offers as $offer) {
          echo "
          <div key='{$offer['id']}' class='bg-white rounded-lg overflow-hidden shadow-lg border transition-transform duration-300 hover:scale-105'>
            <div class='h-48 overflow-hidden'>
              <img src='{$offer['image']}' alt='{$offer['title']}' class='w-full h-full object-cover'/>
            </div>
            <div class='p-6'>
              <h3 class='text-xl font-bold mb-2'>{$offer['title']}</h3>
              <p class='text-gray-600 mb-4'>{$offer['description']}</p>
              <div class='flex justify-between items-center mb-4'>
                <span class='text-sm text-gray-500'>Valid until: {$offer['validUntil']}</span>
                <span class='text-sm font-medium bg-gray-100 px-2 py-1 rounded'>Code: {$offer['code']}</span>
              </div>
              <div class='grid grid-cols-2 gap-4'>
                <a href='/menu' class='btn-outline'>View Menu</a>
                <a href='/reservation' class='btn'>Reserve Now</a>
              </div>
            </div>
          </div>";
        }
      ?>
    </div>
  </div>
</section>

<!-- Newsletter Signup -->
<section class="py-16 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
  <div class="container mx-auto px-4 max-w-4xl text-center">
    <h2 class="text-3xl font-bold mb-4">Get Exclusive Offers</h2>
    <p class="text-white/80 mb-8 text-lg">
      Subscribe to our newsletter and be the first to know about special promotions, seasonal menus, and events.
    </p>
    
    <div class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
      <input type="email" placeholder="Your email address" class="px-4 py-3 rounded-md text-gray-900 w-full focus:outline-none"/>
      <button class="bg-Blue text-primary border-2 border-red-500 hover:bg-white/90 md:w-auto w-full rounded-full py-3 px-6">
  Subscribe
</button>
    </div>
    
    <p class="text-white/60 text-sm mt-4">
      We respect your privacy. Unsubscribe at any time.
    </p>
  </div>
</section>

<!-- Corporate Events Section -->
<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      <div>
        <h2 class="text-3xl font-bold mb-4">Corporate Packages</h2>
        <p class="text-gray-600 mb-6">
          Planning a corporate event? We offer special packages for business lunches, team celebrations, and client entertaining.
        </p>
        <ul class="space-y-3 mb-6">
          <li class="flex items-start">
            <span class="text-primary mr-2">•</span>
            <span>Customizable menus to suit your budget and preferences</span>
          </li>
          <li class="flex items-start">
            <span class="text-primary mr-2">•</span>
            <span>Private dining rooms for meetings and presentations</span>
          </li>
          <li class="flex items-start">
            <span class="text-primary mr-2">•</span>
            <span>Audio-visual equipment for presentations</span>
          </li>
          <li class="flex items-start">
            <span class="text-primary mr-2">•</span>
            <span>Dedicated event coordinator for seamless planning</span>
          </li>
        </ul>
        <button>Inquire About Corporate Packages</button>
      </div>
      <div class="rounded-lg overflow-hidden shadow-xl">
        <!-- Updated corporate dining image -->
        <img src="https://images.unsplash.com/photo-1592384670911-8ff7c8b0f90c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-1.2.1&q=80&w=500" alt="Corporate event setting" class="w-full h-full object-cover"/>
      </div>
    </div>
  </div>
</section>

<!-- Offer Terms and Conditions Section -->
<section class="py-12 bg-white">
  <div class="container mx-auto px-4 max-w-3xl">
    <h2 class="text-2xl font-bold mb-6 text-center">Offer Terms & Conditions</h2>
    <div class="bg-gray-50 p-6 rounded-lg">
      <ul class="space-y-3 text-sm text-gray-600">
        <li>• All offers are subject to availability and cannot be combined with other promotions.</li>
        <li>• Promotional codes must be mentioned when making a reservation or placing an order.</li>
        <li>• Management reserves the right to modify or discontinue any offer without prior notice.</li>
        <li>• Special dietary requirements should be mentioned at the time of booking.</li>
        <li>• All prices are inclusive of applicable taxes unless otherwise stated.</li>
        <li>• For certain offers, a minimum spend or number of guests may be required.</li>
        <li>• Limited-time offers are valid until the specified date or while supplies last.</li>
      </ul>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
