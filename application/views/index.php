<!-- Header  -->
<?php $this->load->view('layout/header');?>

<main style="flex: 1;">
<!-- Hero Section Wrapper -->
<section class="hero-wrapper">
    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Discover Your Dream Destination</h1>
                <p>Explore the world's most beautiful places and create unforgettable memories</p>
            </div>
            
            <!-- Search Box Inside Hero -->
            <div class="search_bx">
                <div class="search-fields">
                    <div class="card">
                        <h4>Location <i class="bi bi-caret-down-fill"></i></h4>
                        <input type="text" placeholder="Enter your destination" id="destination" required
                               pattern="[A-Za-z\s]+" title="Please enter a valid destination name"
                               autocomplete="off" list="cityList">
                    </div>
                    <div class="card">
                        <h4>Start Date <i class="bi bi-caret-down-fill"></i></h4>
                        <input type="date" id="startDate" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="card">
                        <h4>End Date <i class="bi bi-caret-down-fill"></i></h4>
                        <input type="date" id="endDate" required>
                    </div>
                    <div class="card">
                        <h4>People <i class="bi bi-caret-down-fill"></i></h4>
                        <input type="number" placeholder="How many People?" id="people" min="1" max="10" required
                               value="2" title="Please enter a number between 1 and 10">
                    </div>
                </div>
                <input type="button" value="Explore Now" id="submit">
            </div>

                <script>
                    let destination = document.getElementById('destination');
                    let startDate = document.getElementById('startDate');
                    let endDate = document.getElementById('endDate');
                    let people = document.getElementById('people');
                    let submit = document.getElementById('submit');

                    // Set default values on page load
                    window.addEventListener('DOMContentLoaded', () => {
                        // Get URL parameters if they exist
                        const urlParams = new URLSearchParams(window.location.search);
                        const today = new Date();
                        const tomorrow = new Date(today);
                        tomorrow.setDate(tomorrow.getDate() + 1);

                        // Set destination from URL or default to empty
                        destination.value = urlParams.get('city') || 'Jaipur';

                        // Set start date from URL or default to today
                        const todayStr = today.toISOString().split('T')[0];
                        startDate.min = todayStr;
                        
                        // If URL has a date, validate it's not in the past
                        let checkinDate = urlParams.get('checkin');
                        if (checkinDate) {
                            const checkinDateTime = new Date(checkinDate);
                            checkinDateTime.setHours(0, 0, 0, 0);
                            // If checkin date is in the past, use today
                            if (checkinDateTime < today) {
                                checkinDate = todayStr;
                            }
                        } else {
                            checkinDate = todayStr;
                        }
                        startDate.value = checkinDate;
                        
                        // Set end date from URL or default to tomorrow
                        const checkoutDate = urlParams.get('checkout') || tomorrow.toISOString().split('T')[0];
                        endDate.min = tomorrow.toISOString().split('T')[0];
                        endDate.value = checkoutDate;
                        
                        // Set people count from URL or default to 2
                        people.value = urlParams.get('guests') || "2";

                        // Create datalist for destination suggestions
                        const popularCities = ['Jaipur', 'Delhi', 'Mumbai', 'Goa', 'Bengaluru', 'Chennai', 'Kolkata'];
                        const datalist = document.createElement('datalist');
                        datalist.id = 'cityList';
                        popularCities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city;
                            datalist.appendChild(option);
                        });
                        destination.setAttribute('list', 'cityList');
                        destination.parentNode.appendChild(datalist);
                    });

                    // Helper function to format date for display
                    function formatDate(date) {
                        return date.toISOString().split('T')[0];
                    }

                    // Update dates based on selection
                    function updateDates(selectedStartDate) {
                        const start = new Date(selectedStartDate);
                        const nextDay = new Date(start);
                        nextDay.setDate(nextDay.getDate() + 1);
                        
                        // Update end date constraints
                        endDate.min = formatDate(nextDay);
                        
                        // If end date is before or equal to start date, update it
                        const end = new Date(endDate.value);
                        if (end <= start) {
                            endDate.value = formatDate(nextDay);
                        }
                        
                        // Set maximum date range (30 days from start)
                        const maxDate = new Date(start);
                        maxDate.setDate(maxDate.getDate() + 30);
                        endDate.max = formatDate(maxDate);
                    }

                    // Update end date when start date changes
                    startDate.addEventListener('change', function() {
                        const selectedDate = new Date(this.value);
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);
                        selectedDate.setHours(0, 0, 0, 0);

                        // If selected date is in the past, reset to today
                        if (selectedDate < today) {
                            alert('Start date cannot be in the past. Setting to today.');
                            this.value = today.toISOString().split('T')[0];
                        }
                        
                        updateDates(this.value);
                    });

                    // Prevent end date being before start date
                    endDate.addEventListener('change', function() {
                        const start = new Date(startDate.value);
                        const end = new Date(this.value);
                        if (end <= start) {
                            const nextDay = new Date(start);
                            nextDay.setDate(nextDay.getDate() + 1);
                            this.value = formatDate(nextDay);
                        }
                    });

                    function validateSearch() {
                        // Check if all fields are filled
                        if (!destination.value.trim() || !startDate.value || !endDate.value || !people.value) {
                            alert('Please fill in all fields');
                            return false;
                        }

                        // Validate destination (only letters and spaces)
                        if (!/^[A-Za-z\s]+$/.test(destination.value.trim())) {
                            alert('Please enter a valid destination name (letters only)');
                            return false;
                        }

                        // Validate dates
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);
                        const start = new Date(startDate.value);
                        start.setHours(0, 0, 0, 0);
                        const end = new Date(endDate.value);
                        end.setHours(0, 0, 0, 0);

                        if (start < today) {
                            alert('Start date must be today or a future date');
                            startDate.value = today.toISOString().split('T')[0];
                            updateDates(startDate.value);
                            return false;
                        }

                        if (end <= start) {
                            alert('End date must be after start date');
                            return false;
                        }

                        // Maximum stay validation (30 days)
                        const daysDifference = (end - start) / (1000 * 60 * 60 * 24);
                        if (daysDifference > 30) {
                            alert('Maximum stay duration is 30 days');
                            return false;
                        }

                        // Validate number of people
                        const peopleCount = parseInt(people.value);
                        if (isNaN(peopleCount) || peopleCount < 1 || peopleCount > 10) {
                            alert('Please enter a valid number of people (1-10)');
                            return false;
                        }

                        return true;
                    }

                    submit.addEventListener('click', () => {
                        if (validateSearch()) {
                            // Show loading state
                            submit.value = 'Searching...';
                            submit.disabled = true;

                            // Create and click the link
                            let a = document.createElement('a');
                            a.href = `<?php echo base_url('Welcome/result');?>?city=${encodeURIComponent(destination.value.trim())}&checkin=${encodeURIComponent(startDate.value)}&checkout=${encodeURIComponent(endDate.value)}&guests=${encodeURIComponent(people.value)}`;
                            a.click();

                            // Reset button after a delay (in case the navigation fails)
                            setTimeout(() => {
                                submit.value = 'Explore Now';
                                submit.disabled = false;
                            }, 2000);
                        }
                    });

                    // Function to explore specific city
                    function exploreCity(city) {
                        const today = new Date();
                        const tomorrow = new Date(today);
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        
                        const startDate = today.toISOString().split('T')[0];
                        const endDate = tomorrow.toISOString().split('T')[0];
                        
                        window.location.href = `<?php echo base_url('Welcome/result');?>?city=${encodeURIComponent(city)}&checkin=${encodeURIComponent(startDate)}&checkout=${encodeURIComponent(endDate)}&guests=2`;
                    }
                </script>
        </div>
    </div>
</section>

<!-- Travel Section -->
<section class="travel-bx">
    <div class="travel_bx">
        <h4>Popular Destinations</h4>
        <p>Explore amazing places across India</p>
        <div class="cards">
            <div class="card" onclick="exploreCity('Jaipur')" style="cursor: pointer;">
                <h3>JAIPUR <img src="<?= base_url('assets/icon/india.png');?>" alt=""></h3>
                <img src="<?= base_url('assets/img/lotus_temple.jpg');?>" alt="">
                <div class="btn_city">
                    <a href="javascript:void(0);">Explore Now</a>
                    <h5>The Pink City <br> <span>From ₹4,000</span></h5>
                </div>
            </div>
            <div class="card" onclick="exploreCity('Delhi')" style="cursor: pointer;">
                <h3>DELHI <img src="<?= base_url('assets/icon/india.png');?>" alt=""></h3>
                <img src="<?= base_url('assets/img/Mumbai-India-at-night.jpg');?>" alt="">
                <div class="btn_city">
                    <a href="javascript:void(0);">Explore Now</a>
                    <h5>India's Capital <br> <span>From ₹5,500</span></h5>
                </div>
            </div>
            <div class="card" onclick="exploreCity('Goa')" style="cursor: pointer;">
                <h3>GOA <img src="<?= base_url('assets/icon/india.png');?>" alt=""></h3>
                <img src="<?= base_url('assets/img/boat.jpg');?>" alt="">
                <div class="btn_city">
                    <a href="javascript:void(0);">Explore Now</a>
                    <h5>Beach Paradise <br> <span>From ₹9,500</span></h5>
                </div>
            </div>
            <div class="card" onclick="exploreCity('Mumbai')" style="cursor: pointer;">
                <h3>MUMBAI <img src="<?= base_url('assets/icon/india.png');?>" alt=""></h3>
                <img src="<?= base_url('assets/img/Mumbai-India-at-night.jpg');?>" alt="">
                <div class="btn_city">
                    <a href="javascript:void(0);">Explore Now</a>
                    <h5>City of Dreams <br> <span>From ₹7,000</span></h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Offers Section -->
<section class="offers">
    <div class="offers-container">
        <h1>Best tour Package offers for You</h1>
        <p>choose your next destination</p>
        <div class="cards">
            <div class="card">
                <h3>Lotus-Delhi</h3>
                <div class="img_text">
                    <img src="<?= base_url('assets/img/lotus_temple.jpg');?>" alt="">
                    <h4>Included: Air ticket, Hotel, Breakfast, Tours, Airport Transfer</h4>
                </div>
                <div class="cont_bx">
                    <div class="price">
                        <div class="heart_chat">
                            <i class="bi bi-heart-fill"><span>86415</span></i>
                            <i class="bi bi-chat-fill"><span>4586</span></i>
                        </div>
                        <div class="info_price">
                            <a href="<?php echo base_url('Welcome/destinations'); ?>">More Info</a>
                            <h4>$2648</h4>
                        </div>
                    </div>
                    <div class="days">5 Days <br> India</div>
                </div>
            </div>
            <div class="card">
                <h3>Burj Khalifa-DXB</h3>
                <div class="img_text">
                    <img src="<?= base_url('assets/img/burjkhlifa.jpg');?>" alt="">
                    <h4>Included: Air ticket, Hotel, Breakfast, Tours, Airport Transfer</h4>
                </div>
                <div class="cont_bx">
                    <div class="price">
                        <div class="heart_chat">
                            <i class="bi bi-heart-fill"><span>86415</span></i>
                            <i class="bi bi-chat-fill"><span>4586</span></i>
                        </div>
                        <div class="info_price">
                            <a href="<?php echo base_url('Welcome/destinations'); ?>">More Info</a>
                            <h4>$2648</h4>
                        </div>
                    </div>
                    <div class="days">5 Days <br> Dubai</div>
                </div>
            </div>
            <div class="card">
                <h3>Pyramids-Egypt</h3>
                <div class="img_text">
                    <img src="<?= base_url('assets/img/piramids.jpg');?>" alt="">
                    <h4>Included: Air ticket, Hotel, Breakfast, Tours, Airport Transfer</h4>
                </div>
                <div class="cont_bx">
                    <div class="price">
                        <div class="heart_chat">
                            <i class="bi bi-heart-fill"><span>86415</span></i>
                            <i class="bi bi-chat-fill"><span>4586</span></i>
                        </div>
                        <div class="info_price">
                            <a href="<?php echo base_url('Welcome/destinations'); ?>">More Info</a>
                            <h4>$2648</h4>
                        </div>
                    </div>
                    <div class="days">7 Days <br> Egypt</div>
                </div>
            </div>
            <div class="card">
                <h3>Mountain-Vietnam</h3>
                <div class="img_text">
                    <img src="<?= base_url('assets/img/mountain.jpg');?>" alt="">
                    <h4>Included: Air ticket, Hotel, Breakfast, Tours, Airport Transfer</h4>
                </div>
                <div class="cont_bx">
                    <div class="price">
                        <div class="heart_chat">
                            <i class="bi bi-heart-fill"><span>86415</span></i>
                            <i class="bi bi-chat-fill"><span>4586</span></i>
                        </div>
                        <div class="info_price">
                            <a href="<?php echo base_url('Welcome/destinations'); ?>">More Info</a>
                            <h4>$2648</h4>
                        </div>
                    </div>
                    <div class="days">7 Days <br> Vietnam</div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Destination Section -->
<section class="destination-wrapper">
    <div class="destination">
        <div class="des_bx">
            <h4>Our Destination</h4>
            <p>choose your next Destination</p>
            <li>India</li>
            <li>Dubai</li>
            <li>USA</li>
            <li>Vietnam</li>
            <li>Russia</li>
            <li>Brazil</li>
            <h6>Included: Air ticket, Hotel, Breakfast, Tours, Airport transfer</h6>
            <button onclick="window.location.href='<?php echo base_url('Welcome/destinations'); ?>'">VIEW ALL DESTINATIONS</button>
        </div>
        <div class="img_bx">
            <img src="<?= base_url('assets/img/Main_plan.png');?>" alt="">
            <div class="msg">
                <img src="<?= base_url('assets/icon/round_india_flag.png');?>" alt="">
                <div class="cont">
                    <h4>India</h4>
                    <div class="icon">
                        <i class="bi bi-heart-fill"><span>86415</span></i>
                        <i class="bi bi-chat-fill"><span>4586</span></i>
                    </div>
                </div>
            </div>
            <div class="msg">
                <img src="<?= base_url('assets/icon/united-states.png');?>" alt="">
                <div class="cont">
                    <h4>United State</h4>
                    <div class="icon">
                        <i class="bi bi-heart-fill"><span>86415</span></i>
                        <i class="bi bi-chat-fill"><span>4586</span></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
</main>

<!-- Footer  -->
<?php $this->load->view('layout/footer');?>
    
