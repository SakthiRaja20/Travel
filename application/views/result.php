<!-- Header -->
<?php $this->load->view('layout/header');?>
<!-- Main Content -->

<main style="flex: 1;">
<header>
    <div class="content">
        <div class="cont_bx">
            <h1>Find Your Perfect Destination</h1>
            <p>Discover amazing places and create unforgettable memories</p>
        </div>
        <div class="trip_bx">
            <div class="search_bx">
                <div class="search-fields">
                    <div class="card">
                        <h4>Location <i class="bi bi-caret-down-fill"></i></h4>
                        <input type="text" placeholder="Enter your destination" id="destination">
                    </div>
                    <div class="card">
                        <h4>Start Date <i class="bi bi-caret-down-fill"></i></h4>
                        <input type="date" id="startDate">
                    </div>
                    <div class="card">
                        <h4>End Date <i class="bi bi-caret-down-fill"></i></h4>
                        <input type="date" id="endDate">
                    </div>
                    <div class="card">
                        <h4>People <i class="bi bi-caret-down-fill"></i></h4>
                        <input type="number" placeholder="How many People?" id="people" min="1">
                    </div>
                </div>
                <input type="button" value="Explore Now" id="submit">
            </div>

            <script>
                function validateSearchForm() {
                    const destination = document.getElementById('destination').value.trim();
                    const startDate = document.getElementById('startDate').value.trim();
                    const endDate = document.getElementById('endDate').value.trim();
                    const people = document.getElementById('people').value.trim();

                    if (!destination || !startDate || !endDate || !people) {
                        alert('Please fill all fields');
                        return false;
                    }

                    if (isNaN(people) || parseInt(people) < 1) {
                        alert('Please enter a valid number of people');
                        return false;
                    }

                    if (new Date(startDate) >= new Date(endDate)) {
                        alert('End date must be after start date');
                        return false;
                    }

                    return true;
                }

                document.getElementById('submit').addEventListener('click', () => {
                    if (validateSearchForm()) {
                        const destination = encodeURIComponent(document.getElementById('destination').value);
                        const startDate = encodeURIComponent(document.getElementById('startDate').value);
                        const endDate = encodeURIComponent(document.getElementById('endDate').value);
                        const people = encodeURIComponent(document.getElementById('people').value);
                        
                        window.location.href = `<?php echo base_url('welcome/result');?>?city=${destination}&checkin=${startDate}&checkout=${endDate}&guests=${people}`;
                    }
                });
            </script>
        </div>
    </div>
</header>

<style>
    .hotel_bx {
        width: 90%;
        max-width: 1200px;
        margin: 20px auto;
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .hotel_bx .hotelFilters, .hotelsDetails {
        height: fit-content;
    }

    .hotel_bx .hotelFilters {
        width: 200px;
        position: sticky;
        top: 20px;
    }

    .hotel_bx .hotelsDetails {
        flex: 1;
        min-width: 0;
    }

    .hotel_bx .hotelFilters .filterCard h4 {
        font-weight: 600;
        margin-top: 15px;
        margin-bottom: 10px;
    }

    .hotel_bx .hotelFilters .filterCard li {
        list-style: none;
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .hotel_bx .hotelFilters .filterCard li input {
        width: 17px;
        height: 17px;
        cursor: pointer;
    }

    .hotel_bx .hotelFilters .filterCard li span {
        font-size: 14px;
        margin-left: 8px;
        color: #5f5f5f;
        font-weight: 500;
        cursor: pointer;
    }

    .hotel_bx .hotelsDetails h3 {
        margin-bottom: 15px;
        font-size: 18px;
    }

    .hotel_bx .hotelsDetails h3 span {
        color: #0b58b4;
        font-weight: 700;
    }

    .hotel_bx .hotelsDetails .hotels {
        display: grid;
        gap: 15px;
    }

    .hotel_bx .hotelsDetails .hotels .card {
        background: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 15px;
        display: grid;
        grid-template-columns: 180px 1fr auto;
        gap: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .hotel_bx .hotelsDetails .hotels .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
    }

    .hotel_bx .hotelsDetails .hotels .card .img_bx img {
        border-radius: 8px;
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .hotel_bx .hotelsDetails .hotels .card .img_bx .subImages {
        display: flex;
        gap: 5px;
        margin-top: 8px;
    }

    .hotel_bx .hotelsDetails .hotels .card .img_bx .subImages img {
        width: 32%;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
        cursor: pointer;
    }

    .hotel_bx .hotelsDetails .hotels .card .content_bx {
        display: flex;
        flex-direction: column;
    }

    .hotel_bx .hotelsDetails .hotels .card .content_bx h4 {
        margin: 0 0 5px 0;
        font-size: 16px;
        color: #333;
    }

    .hotel_bx .hotelsDetails .hotels .card .content_bx h5 {
        margin: 0;
        font-size: 13px;
        color: #ffa500;
        margin-bottom: 8px;
    }

    .hotel_bx .hotelsDetails .hotels .card .content_bx p {
        margin: 5px 0;
        font-size: 12px;
        text-align: left;
        color: #666;
        line-height: 1.4;
    }

    .hotel_bx .hotelsDetails .hotels .card .content_bx .hotel_services {
        margin: 10px 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }

    .hotel_bx .hotelsDetails .hotels .card .content_bx .hotel_services li {
        font-size: 11px;
        list-style: none;
        background: #f0f0f0;
        padding: 4px 8px;
        border-radius: 4px;
        color: #555;
    }

    .hotel_bx .hotelsDetails .hotels .card .content_bx .add {
        margin-top: 8px;
        font-size: 12px;
        color: #666;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx {
        text-align: right;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-width: 150px;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx h5 {
        margin: 0 0 8px 0;
        font-size: 13px;
        color: #0b58b4;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx h5 span {
        background: #0b58b4;
        color: #fff;
        font-size: 10px;
        margin-left: 5px;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx h5.discount {
        color: #dc3545;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx .room-availability {
        margin: 8px 0;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 8px;
        text-align: left;
        font-size: 11px;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx .room-type {
        font-size: 11px;
        color: #666;
        padding: 3px 0;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx .room-type i {
        font-size: 12px;
        color: #28a745;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx .room-type.no-rooms {
        color: #dc3545;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx .room-type.no-rooms i {
        color: #dc3545;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx h5.price {
        font-size: 16px;
        font-weight: 700;
        color: #0b58b4;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx a {
        text-decoration: none;
        background: #0b58b4;
        padding: 8px 12px;
        border-radius: 5px;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid #0b58b4;
        transition: all 0.3s;
        cursor: pointer;
        text-align: center;
    }

    .hotel_bx .hotelsDetails .hotels .card .price_bx a:hover {
        background: transparent;
        color: #0b58b4;
    }

    .loading {
        text-align: center;
        padding: 40px;
        font-size: 16px;
        color: #666;
    }

    .error-message {
        background: #f8d7da;
        color: #721c24;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 15px;
        border: 1px solid #f5c6cb;
    }

    .no-results {
        text-align: center;
        padding: 40px;
        color: #666;
    }

    @media (max-width: 768px) {
        .hotel_bx {
            flex-direction: column;
            gap: 15px;
        }

        .hotel_bx .hotelFilters {
            width: 100%;
            position: static;
        }

        .hotel_bx .hotelsDetails .hotels .card {
            grid-template-columns: 1fr;
        }

        .hotel_bx .hotelsDetails .hotels .card .img_bx {
            max-width: 100%;
        }

        .hotel_bx .hotelsDetails .hotels .card .price_bx {
            min-width: auto;
            text-align: left;
        }
    }
</style>

<div class="hotel_bx">
    <div class="hotelFilters">
        <h3><i class="bi bi-funnel-fill"></i> Filter</h3>
        
        <div class="filterCard">
            <h4>Room Amenities</h4>
            <div class="filterInputs" id="amenties"></div>
        </div>

        <div class="filterCard">
            <h4>Price per night</h4>
            <div class="filterInputs">
                <li class="underPrice" data-price="1000">
                    <input type="checkbox" name="price"> 
                    <span>Under ₹1000</span>
                </li>
                <li class="underPrice" data-price="2000">
                    <input type="checkbox" name="price"> 
                    <span>Under ₹2000</span>
                </li>
                <li class="underPrice" data-price="3000">
                    <input type="checkbox" name="price"> 
                    <span>Under ₹3000</span>
                </li>
                <li class="underPrice" data-price="4000">
                    <input type="checkbox" name="price"> 
                    <span>Under ₹4000</span>
                </li>
                <li class="underPrice" data-price="5000">
                    <input type="checkbox" name="price"> 
                    <span>Under ₹5000</span>
                </li>
            </div>
        </div>

        <div class="filterCard">
            <h4>Star rating</h4>
            <div class="filterInputs">
                <li class="starRating" data-rating="5">
                    <input type="checkbox" name="rating"> 
                    <span>5 Star</span>
                </li>
                <li class="starRating" data-rating="4">
                    <input type="checkbox" name="rating"> 
                    <span>4 Star</span>
                </li>
                <li class="starRating" data-rating="3">
                    <input type="checkbox" name="rating"> 
                    <span>3 Star</span>
                </li>
                <li class="starRating" data-rating="2">
                    <input type="checkbox" name="rating"> 
                    <span>2 Star</span>
                </li>
                <li class="starRating" data-rating="1">
                    <input type="checkbox" name="rating"> 
                    <span>1 Star</span>
                </li>
            </div>
        </div>
    </div>

    <div class="hotelsDetails">
        <h3><i class="bi bi-buildings"></i> Hotels in <span id="city">Loading...</span></h3>
        <div class="hotels" id="hotels">
            <div class="loading">Loading hotels...</div>
        </div>
    </div>
</div>

<script>
    // ===== PARSE URL PARAMETERS FIRST =====
    // Handle both URL formats:
    // Format 1: ?city=jaipur&checkin=2025-10-14&checkout=2025-10-15&guests=1
    // Format 2: ?jaipur?2025-10-14?2025-10-15?1
    let destination = '';
    let checkin = '';
    let checkout = '';
    let guests = '';

    const urlParams = new URLSearchParams(window.location.search);
    
    // Try standard query parameters first
    destination = decodeURIComponent(urlParams.get('city') || '');
    checkin = decodeURIComponent(urlParams.get('checkin') || '');
    checkout = decodeURIComponent(urlParams.get('checkout') || '');
    guests = decodeURIComponent(urlParams.get('guests') || '');

    // If not found, try parsing the old format with ? separators
    if (!destination || !checkin || !checkout || !guests) {
        const search = window.location.search.substring(1);
        if (search.includes('?')) {
            const parts = search.split('?').filter(p => p.trim());
            if (parts.length >= 4) {
                destination = decodeURIComponent(parts[0] || '');
                checkin = decodeURIComponent(parts[1] || '');
                checkout = decodeURIComponent(parts[2] || '');
                guests = decodeURIComponent(parts[3] || '');
            }
        }
    }

    console.log('Parsed URL parameters:', { destination, checkin, checkout, guests });

    // ===== UTILITY FUNCTIONS =====
    function getRatingText(rating) {
        if (!rating) return 'Not Rated';
        rating = parseFloat(rating);
        if (rating >= 4.5) return 'Excellent';
        if (rating >= 4.0) return 'Very Good';
        if (rating >= 3.5) return 'Good';
        if (rating >= 3.0) return 'Average';
        return 'Fair';
    }

    function getSafeImageUrl(imageName) {
        if (!imageName) return '<?php echo base_url('assets/img/placeholder.jpg'); ?>';
        return `<?php echo base_url('assets/img/Hotels-photos/'); ?>${encodeURIComponent(imageName)}`;
    }

    function sanitizeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // ===== SET FORM VALUES FROM URL PARAMETERS =====
    document.getElementById('destination').value = destination;
    document.getElementById('startDate').value = checkin;
    document.getElementById('endDate').value = checkout;
    document.getElementById('people').value = guests;
    document.getElementById('city').textContent = destination || 'Loading...';

    // ===== INITIALIZE STATE VARIABLES =====
    let hotelsContainer = document.getElementById('hotels');
    let selectedAmenities = [];
    let selectedPrice = '';
    let selectedRating = '';

    // ===== FETCH HOTELS FUNCTION =====
    async function fetchHotels(amenities = [], price = '', rating = '') {
        try {
            hotelsContainer.innerHTML = '<div class="loading">Loading hotels...</div>';

            const requestData = {
                amenities: amenities,
                price: price,
                rating: rating,
                city: destination
            };

            const response = await fetch("<?php echo base_url('index.php/Welcome/hotelFind'); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();

            if (!result || !result[0] || result[0].length === 0) {
                hotelsContainer.innerHTML = '<div class="no-results">No hotels found matching your criteria.</div>';
                return;
            }

            hotelsContainer.innerHTML = '';

            result[0].forEach((hotel) => {
                try {
                    const hotelCard = createHotelCard(hotel);
                    hotelsContainer.appendChild(hotelCard);
                } catch (error) {
                    console.error('Error creating hotel card:', error);
                }
            });

        } catch (error) {
            console.error('Error fetching hotels:', error);
            hotelsContainer.innerHTML = '<div class="error-message">Failed to load hotels. Please try again.</div>';
        }
    }

    // ===== CREATE HOTEL CARD FUNCTION =====
    function createHotelCard(hotel) {
        const card = document.createElement('div');
        card.className = 'card';

        const images = hotel.room_andHotelImages 
            ? hotel.room_andHotelImages.split(',').slice(0, 3)
            : [];

        const subImagesHtml = images.length > 0
            ? images.map((img, i) => `
                <img src="${getSafeImageUrl(img.trim())}" 
                     alt="Hotel view ${i + 1}" 
                     onerror="this.src='<?php echo base_url('assets/img/placeholder.jpg'); ?>'">
              `).join('')
            : '<img src="<?php echo base_url('assets/img/placeholder.jpg'); ?>" alt="No image">'.repeat(3);

        const roomAvailability = hotel.room_details 
            ? hotel.room_details.split(',').map(room => `
                <div class="room-type">
                    <i class="bi bi-check2-circle"></i> 
                    ${sanitizeHtml(room.trim())}
                </div>
              `).join('')
            : '<div class="room-type no-rooms"><i class="bi bi-x-circle"></i> No rooms available</div>';

        const services = hotel.services 
            ? hotel.services.split(',').map(service => 
                `<li>${sanitizeHtml(service.trim())}</li>`
              ).join('')
            : '';

        // FIX: Use correct URL format with hotel_id parameter
        const bookUrl = `<?php echo base_url('book');?>?hotel_id=${hotel.id}&city=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&guests=${encodeURIComponent(guests)}`;

        card.innerHTML = `
            <div class="img_bx">
                <img src="${getSafeImageUrl(hotel.poster)}" 
                     alt="${sanitizeHtml(hotel.name)}"
                     onerror="this.src='<?php echo base_url('assets/img/placeholder.jpg'); ?>'">
                <div class="subImages">
                    ${subImagesHtml}
                </div>
            </div>
            <div class="content_bx">
                <h4>${sanitizeHtml(hotel.name)}</h4>
                <h5>
                    ${'★'.repeat(Math.floor(hotel.rate || 0))}${'☆'.repeat(5 - Math.floor(hotel.rate || 0))}
                    ${hotel.rate ? ` (${hotel.rate})` : ''}
                </h5>
                <p>${sanitizeHtml(hotel.description || 'No description available')}</p>
                <div class="hotel_services">
                    ${services}
                </div>
                <p class="add">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>${sanitizeHtml(hotel.location || 'Location not specified')}</span>
                </p>
            </div>
            <div class="price_bx">
                <h5>${getRatingText(hotel.rate)} <span>${hotel.rate || 'N/A'}</span></h5>
                <div style="font-size: 12px; color: #666; margin: 8px 0;">Available Rooms:</div>
                <div class="room-availability">
                    ${roomAvailability}
                </div>
                <h5 class="price">₹${Math.floor(hotel.mrp)} <span style="font-size: 12px;">/night</span></h5>
                ${hotel.discount ? `<h5 class="discount">${Math.floor(hotel.discount)}% Discount</h5>` : ''}
                <a href="${bookUrl}">Book Now</a>
            </div>
        `;

        return card;
    }

    // ===== FETCH AMENITIES FUNCTION =====
    async function fetchAmenities() {
        try {
            if (!destination) {
                console.log('No destination provided');
                return;
            }

            const response = await fetch("<?php echo base_url('index.php/Welcome/hotelAmenities'); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ city: destination })
            });

            const result = await response.json();

            if (!result || !result[0]) {
                console.log('No amenities found');
                return;
            }

            let amenities = [];
            result[0].forEach(item => {
                if (item && item.services) {
                    amenities.push(...item.services.split(',').map(s => s.trim()));
                }
            });

            amenities = [...new Set(amenities)].filter(Boolean);

            const amenitiesContainer = document.getElementById('amenties');
            amenitiesContainer.innerHTML = '';

            amenities.forEach((amenity) => {
                const li = document.createElement('li');
                const safeId = amenity.replace(/[^a-zA-Z0-9-_]/g, '-').toLowerCase();
                
                li.innerHTML = `
                    <input type="checkbox" data-amenity="${sanitizeHtml(amenity)}" id="amenity-${safeId}"> 
                    <span>${sanitizeHtml(amenity)}</span>
                `;

                li.addEventListener('click', (e) => {
                    const checkbox = li.querySelector('input[type="checkbox"]');
                    if (e.target !== checkbox) {
                        checkbox.checked = !checkbox.checked;
                    }

                    if (checkbox.checked) {
                        selectedAmenities.push(amenity);
                    } else {
                        selectedAmenities = selectedAmenities.filter(a => a !== amenity);
                    }

                    fetchHotels(selectedAmenities, selectedPrice, selectedRating);
                });

                amenitiesContainer.appendChild(li);
            });

        } catch (error) {
            console.error('Error fetching amenities:', error);
        }
    }

    // ===== FILTER EVENT LISTENERS =====
    document.querySelectorAll('.underPrice').forEach((el) => {
        el.addEventListener('click', (e) => {
            const checkbox = e.target.closest('input[type="checkbox"]');
            if (!checkbox) return;

            selectedPrice = checkbox.checked ? el.getAttribute('data-price') : '';
            document.querySelectorAll('.underPrice input').forEach((input) => {
                if (input !== checkbox) input.checked = false;
            });

            fetchHotels(selectedAmenities, selectedPrice, selectedRating);
        });
    });

    document.querySelectorAll('.starRating').forEach((el) => {
        el.addEventListener('click', (e) => {
            const checkbox = e.target.closest('input[type="checkbox"]');
            if (!checkbox) return;

            selectedRating = checkbox.checked ? el.getAttribute('data-rating') : '';
            document.querySelectorAll('.starRating input').forEach((input) => {
                if (input !== checkbox) input.checked = false;
            });

            fetchHotels(selectedAmenities, selectedPrice, selectedRating);
        });
    });

    // ===== INITIALIZE =====
    fetchAmenities();
    fetchHotels();
</script>

</main>

<!-- Footer -->
<?php $this->load->view('layout/footer');?>