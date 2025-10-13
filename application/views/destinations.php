<!-- Header  -->
<?php $this->load->view('layout/header');?>

<main style="flex: 1;">
<!-- Hero Section -->
<section class="destinations-hero">
    <div class="destinations-hero-content">
        <h1>Explore Amazing Destinations</h1>
        <p>Discover breathtaking places around the world and plan your perfect getaway</p>
    </div>
</section>

<!-- Destinations Grid -->
<section class="destinations-section">
    <div class="destinations-container">
        <div class="section-header">
            <h2>Popular Destinations</h2>
            <p>Choose from our handpicked collection of amazing places</p>
        </div>

        <div class="destinations-grid" id="destinationsGrid">
            <!-- Jaipur -->
            <div class="destination-card" data-city="Jaipur">
                <div class="destination-image">
                    <img src="<?= base_url('assets/img/lotus_temple.jpg');?>" alt="Jaipur">
                    <div class="destination-overlay">
                        <button class="explore-btn" onclick="exploreDestination('Jaipur')">
                            <i class="bi bi-compass"></i> Explore Now
                        </button>
                    </div>
                </div>
                <div class="destination-info">
                    <div class="destination-header">
                        <h3>Jaipur</h3>
                        <span class="destination-badge">
                            <i class="bi bi-star-fill"></i> 4.5+
                        </span>
                    </div>
                    <p class="destination-desc">The Pink City - Famous for its rich history, magnificent palaces, and vibrant culture</p>
                    <div class="destination-stats">
                        <span><i class="bi bi-building"></i> 10 Hotels</span>
                        <span><i class="bi bi-currency-dollar"></i> From ₹4,000</span>
                    </div>
                </div>
            </div>

            <!-- Delhi -->
            <div class="destination-card" data-city="Delhi">
                <div class="destination-image">
                    <img src="<?= base_url('assets/img/Mumbai-India-at-night.jpg');?>" alt="Delhi">
                    <div class="destination-overlay">
                        <button class="explore-btn" onclick="exploreDestination('Delhi')">
                            <i class="bi bi-compass"></i> Explore Now
                        </button>
                    </div>
                </div>
                <div class="destination-info">
                    <div class="destination-header">
                        <h3>Delhi</h3>
                        <span class="destination-badge">
                            <i class="bi bi-star-fill"></i> 4.6+
                        </span>
                    </div>
                    <p class="destination-desc">India's Capital - A perfect blend of ancient heritage and modern lifestyle</p>
                    <div class="destination-stats">
                        <span><i class="bi bi-building"></i> 10 Hotels</span>
                        <span><i class="bi bi-currency-dollar"></i> From ₹5,500</span>
                    </div>
                </div>
            </div>

            <!-- Goa -->
            <div class="destination-card" data-city="Goa">
                <div class="destination-image">
                    <img src="<?= base_url('assets/img/boat.jpg');?>" alt="Goa">
                    <div class="destination-overlay">
                        <button class="explore-btn" onclick="exploreDestination('Goa')">
                            <i class="bi bi-compass"></i> Explore Now
                        </button>
                    </div>
                </div>
                <div class="destination-info">
                    <div class="destination-header">
                        <h3>Goa</h3>
                        <span class="destination-badge">
                            <i class="bi bi-star-fill"></i> 4.7+
                        </span>
                    </div>
                    <p class="destination-desc">Beach Paradise - Stunning beaches, vibrant nightlife, and Portuguese heritage</p>
                    <div class="destination-stats">
                        <span><i class="bi bi-building"></i> 10 Hotels</span>
                        <span><i class="bi bi-currency-dollar"></i> From ₹9,500</span>
                    </div>
                </div>
            </div>

            <!-- Mumbai -->
            <div class="destination-card" data-city="Mumbai">
                <div class="destination-image">
                    <img src="<?= base_url('assets/img/Mumbai-India-at-night.jpg');?>" alt="Mumbai">
                    <div class="destination-overlay">
                        <button class="explore-btn" onclick="exploreDestination('Mumbai')">
                            <i class="bi bi-compass"></i> Explore Now
                        </button>
                    </div>
                </div>
                <div class="destination-info">
                    <div class="destination-header">
                        <h3>Mumbai</h3>
                        <span class="destination-badge">
                            <i class="bi bi-star-fill"></i> 4.5+
                        </span>
                    </div>
                    <p class="destination-desc">City of Dreams - Bollywood, Marine Drive, and endless opportunities</p>
                    <div class="destination-stats">
                        <span><i class="bi bi-building"></i> 10 Hotels</span>
                        <span><i class="bi bi-currency-dollar"></i> From ₹7,000</span>
                    </div>
                </div>
            </div>

            <!-- Barcelona -->
            <div class="destination-card" data-city="Barcelona">
                <div class="destination-image">
                    <img src="<?= base_url('assets/img/barcelona.jpg');?>" alt="Barcelona">
                    <div class="destination-overlay">
                        <button class="explore-btn" onclick="exploreDestination('Barcelona')">
                            <i class="bi bi-compass"></i> Explore Now
                        </button>
                    </div>
                </div>
                <div class="destination-info">
                    <div class="destination-header">
                        <h3>Barcelona</h3>
                        <span class="destination-badge">
                            <i class="bi bi-star-fill"></i> 4.8+
                        </span>
                    </div>
                    <p class="destination-desc">Spanish Gem - Gothic architecture, stunning beaches, and Gaudí's masterpieces</p>
                    <div class="destination-stats">
                        <span><i class="bi bi-building"></i> Coming Soon</span>
                        <span><i class="bi bi-currency-dollar"></i> From €80</span>
                    </div>
                </div>
            </div>

            <!-- New York -->
            <div class="destination-card" data-city="New York">
                <div class="destination-image">
                    <img src="<?= base_url('assets/img/newyork.webp');?>" alt="New York">
                    <div class="destination-overlay">
                        <button class="explore-btn" onclick="exploreDestination('New York')">
                            <i class="bi bi-compass"></i> Explore Now
                        </button>
                    </div>
                </div>
                <div class="destination-info">
                    <div class="destination-header">
                        <h3>New York</h3>
                        <span class="destination-badge">
                            <i class="bi bi-star-fill"></i> 4.9+
                        </span>
                    </div>
                    <p class="destination-desc">The Big Apple - Times Square, Statue of Liberty, and endless entertainment</p>
                    <div class="destination-stats">
                        <span><i class="bi bi-building"></i> Coming Soon</span>
                        <span><i class="bi bi-currency-dollar"></i> From $150</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search by Destination -->
        <div class="destination-search-section">
            <h3>Looking for something specific?</h3>
            <p>Enter your destination and dates to find the perfect stay</p>
            <div class="quick-search-form">
                <div class="search-input-group">
                    <i class="bi bi-geo-alt-fill"></i>
                    <input type="text" id="quickDestination" placeholder="Enter destination" list="cityList">
                    <datalist id="cityList">
                        <option value="Jaipur">
                        <option value="Delhi">
                        <option value="Goa">
                        <option value="Mumbai">
                        <option value="Barcelona">
                        <option value="New York">
                    </datalist>
                </div>
                <div class="search-input-group">
                    <i class="bi bi-calendar-check"></i>
                    <input type="date" id="quickStartDate">
                </div>
                <div class="search-input-group">
                    <i class="bi bi-calendar-x"></i>
                    <input type="date" id="quickEndDate">
                </div>
                <div class="search-input-group">
                    <i class="bi bi-people-fill"></i>
                    <input type="number" id="quickPeople" placeholder="Guests" min="1" value="2">
                </div>
                <button class="search-submit-btn" onclick="quickSearch()">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </div>
    </div>
</section>
</main>

<script>
    // Explore destination function
    function exploreDestination(city) {
        // Get today's date
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        // Format dates as YYYY-MM-DD
        const startDate = today.toISOString().split('T')[0];
        const endDate = tomorrow.toISOString().split('T')[0];
        
        // Redirect to result page with pre-filled destination
        window.location.href = `<?php echo base_url('Welcome/result');?>?city=${encodeURIComponent(city)}&checkin=${encodeURIComponent(startDate)}&checkout=${encodeURIComponent(endDate)}&guests=2`;
    }

    // Quick search function
    function quickSearch() {
        const destination = document.getElementById('quickDestination').value;
        const startDate = document.getElementById('quickStartDate').value;
        const endDate = document.getElementById('quickEndDate').value;
        const people = document.getElementById('quickPeople').value;

        if (!destination) {
            alert('Please enter a destination');
            return;
        }

        if (!startDate || !endDate) {
            alert('Please select check-in and check-out dates');
            return;
        }

        if (new Date(startDate) >= new Date(endDate)) {
            alert('Check-out date must be after check-in date');
            return;
        }

        // Redirect to result page
        window.location.href = `<?php echo base_url('Welcome/result');?>?city=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(startDate)}&checkout=${encodeURIComponent(endDate)}&guests=${encodeURIComponent(people)}`;
    }

    // Set minimum date for date inputs to today
    window.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('quickStartDate').min = today;
        document.getElementById('quickEndDate').min = today;
    });

    // Add hover effect to cards
    const cards = document.querySelectorAll('.destination-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>

<!-- Footer  -->
<?php $this->load->view('layout/footer');?>
