<?php
  $year = date("Y");
?>

<!-- Include Google Fonts for a more attractive and unique font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

<footer style="background-color: #1a202c; color: white; padding-top: 3rem; padding-bottom: 2rem; font-family: 'Poppins', sans-serif;">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <div>
        <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; font-family: 'Roboto', sans-serif;">Swad Sagar</h3>
        <p style="color: #cbd5e0; margin-bottom: 1rem; font-size: 1rem;">
          Exquisite dining experience with the finest ingredients and exceptional service since 2010.
        </p>
      </div>

      <div>
        <h4 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 1rem;">Hours</h4>
        <ul style="list-style: none; padding-left: 0; color: #cbd5e0; font-size: 0.875rem;">
          <li>Monday - Friday: 11:00 AM - 10:00 PM</li>
          <li>Saturday: 10:00 AM - 11:00 PM</li>
          <li>Sunday: 10:00 AM - 9:00 PM</li>
        </ul>
      </div>

      <div>
        <h4 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 1rem;">Contact</h4>
        <ul style="list-style: none; padding-left: 0; color: #cbd5e0; font-size: 0.875rem;">
          <li>123 Gandhi Street</li>
          <li>Foodville, West Bengal</li>
          <li>+91 1234567890</li>
          <li>info@SwadSagar.com</li>
        </ul>
      </div>

      <div>
        <h4 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 1rem;">Newsletter</h4>
        <p style="color: #cbd5e0; margin-bottom: 1rem; font-size: 0.875rem;">Subscribe to our newsletter for updates, promotions, and special events.</p>
        <div class="flex">
          <input 
            type="email" 
            placeholder="Your email" 
            style="padding: 0.75rem 1rem; border-radius: 0.375rem; width: 100%; border: none; outline: none; color: #1a202c; margin-right: 1rem; transition: all 0.3s ease;"
            onfocus="this.style.borderColor='#3182ce'; this.style.boxShadow='0 0 10px rgba(49, 130, 206, 0.5)';"
            onblur="this.style.borderColor=''; this.style.boxShadow='';"
          />
          <button style="background-color: #3182ce; color: white; padding: 0.75rem 1.5rem; border-radius: 0.375rem; border: none; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
            onmouseover="this.style.backgroundColor='#2c5282';"
            onmouseout="this.style.backgroundColor='#3182ce';"
          >
            Subscribe
          </button>
        </div>
      </div>
    </div>

    <div style="border-top: 1px solid #2d3748; margin-top: 2rem; padding-top: 2rem; font-size: 0.875rem; color: #cbd5e0; text-align: center;">
      <p>&copy; <?php echo $year; ?> Swad Sagar- Develop by Tufan & Joy.</p>
    </div>
  </div>
</footer>
