/**
 * Booking handler for hotel room booking system
 */
window.BookingHandler = class {
    constructor() {
        console.log('Constructor called');
        
        // Get configuration from global object
        this.config = window.BOOKING_CONFIG;
        console.log('Config loaded:', this.config);
        
        if (!this.config) {
            console.error('No BOOKING_CONFIG found in window object');
            throw new Error('Booking configuration not found');
        }

        // Parse URL parameters using standard query string format
        const urlParams = new URLSearchParams(window.location.search);
        this.config.urlParams = {
            hotelId: urlParams.get('hotel_id') || '',
            city: urlParams.get('city') || '',
            checkIn: urlParams.get('checkin') || '',
            checkOut: urlParams.get('checkout') || '',
            guests: urlParams.get('guests') || ''
        };

        console.log('Parsed URL Parameters:', this.config.urlParams);

        // Initialize state
        this.selectedRoom = null;
        this.hotelData = null;
        this.roomData = [];
        
        // Initialize DOM elements
        this.elements = {};
        this.initializeElements();
    }

    /**
     * Initialize DOM elements
     */
    initializeElements() {
        const s = this.config.selectors;
        for (const [key, selector] of Object.entries(s)) {
            const element = document.querySelector(selector);
            if (!element) {
                console.warn(`Element not found: ${selector}`);
            }
            this.elements[key] = element;
        }
    }

    /**
     * Initialize the booking system
     */
    async initialize() {
        if (!this.validateSetup()) {
            throw new Error('Invalid booking setup');
        }

        try {
            await this.loadHotelData();
            await this.loadRoomData();
            this.setupEventListeners();
            this.renderHotelInfo();
            this.renderRoomOptions();
            this.updateBookingSummary();
        } catch (error) {
            console.error('Initialization error:', error);
            BookingUtils.showError('Failed to load booking details: ' + error.message);
            throw error;
        }
    }

    /**
     * Validate setup requirements
     */
    validateSetup() {
        console.log('=== Booking Setup Validation ===');
        console.log('1. URL Information:');
        console.log('- Full URL:', window.location.href);
        console.log('- Path:', window.location.pathname);
        console.log('- Search:', window.location.search);
        console.log('- Hash:', window.location.hash);
        
        console.log('2. URL Parameters (parsed):');
        const urlParams = new URLSearchParams(window.location.search);
        for (const [key, value] of urlParams.entries()) {
            console.log(`- ${key}: ${value}`);
        }

        console.log('3. Config URL Parameters:');
        console.log(this.config.urlParams);

        console.log('4. Raw Search String Analysis:');
        const searchStr = window.location.search;
        console.log('- Raw:', searchStr);
        console.log('- Decoded:', decodeURIComponent(searchStr));

        // Check required DOM elements
        console.log('5. DOM Elements Check:');
        for (const [key, element] of Object.entries(this.elements)) {
            console.log(`- ${key}: ${element ? 'Found' : 'Missing'}`);
            if (!element) {
                console.error(`Required element not found: ${key}`);
                return false;
            }
        }

        // Check required URL parameters
        if (!this.config.urlParams) {
            console.error('URL parameters not found in configuration');
            return false;
        }

        console.log('Checking URL parameters:', this.config.urlParams);

        const required = ['hotelId', 'checkIn', 'checkOut'];
        for (const param of required) {
            const value = String(this.config.urlParams[param] || '').trim();
            if (!value) {
                console.error(`Missing or empty required parameter: ${param}`);
                return false;
            }
            console.log(`Parameter ${param} value:`, value);
        }

        // Validate dates
        try {
            console.log('Validating dates:', {
                checkIn: this.config.urlParams.checkIn,
                checkOut: this.config.urlParams.checkOut
            });

            const checkIn = DateUtils.parseDate(this.config.urlParams.checkIn);
            const checkOut = DateUtils.parseDate(this.config.urlParams.checkOut);
            
            console.log('Parsed dates:', { checkIn, checkOut });

            // Use BookingUtils for date validation
            const validation = BookingUtils.validateDates(checkIn, checkOut);
            console.log('Date validation result:', validation);

            if (!validation.isValid) {
                console.error('Date validation failed:', validation.message);
                return false;
            }

            // Store validated dates and duration
            this.checkInDate = validation.checkIn;
            this.checkOutDate = validation.checkOut;
            this.stayDuration = validation.stayDuration;
            this.daysUntilCheckIn = validation.daysUntilCheckIn;

            console.log('Booking details:', {
                checkIn: this.checkInDate,
                checkOut: this.checkOutDate,
                nights: this.stayDuration,
                daysUntil: this.daysUntilCheckIn
            });
        } catch (error) {
            console.error('Date parsing error:', error);
            return false;
        }

        console.log('Setup validation successful');
        return true;
    }

    /**
     * Load hotel data
     */
    async loadHotelData() {
        const url = this.config.baseUrl + this.config.endpoints.hotelFind;
        
        console.log('🔍 Loading hotel data:', {
            url,
            hotelId: this.config.urlParams.hotelId,
            city: this.config.urlParams.city
        });
        
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                id: this.config.urlParams.hotelId,
                city: this.config.urlParams.city || ''
            })
        });

        if (!response.ok) {
            console.error('❌ HTTP error:', response.status, response.statusText);
            throw new Error(`Failed to load hotel data: ${response.status}`);
        }

        const data = await response.json();
        console.log('📦 API Response:', data);
        
        // Check for error status in response
        if (data.status === 'error') {
            console.error('❌ API Error:', data.message, data.debug);
            throw new Error(data.message || 'Hotel not found');
        }
        
        // Check for hotels array
        if (!data.hotels || !Array.isArray(data.hotels) || data.hotels.length === 0) {
            console.error('❌ No hotels in response:', data);
            throw new Error('Hotel not found');
        }

        console.log('✅ Hotel loaded:', data.hotels[0]);
        this.hotelData = data.hotels[0];
    }

    /**
     * Load room data
     */
    async loadRoomData() {
        const url = this.config.baseUrl + this.config.endpoints.getHotelRooms;
        
        console.log('🔍 Loading room data:', {
            url,
            hotelId: this.config.urlParams.hotelId
        });
        
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                hotel_id: this.config.urlParams.hotelId
            })
        });

        if (!response.ok) {
            console.error('❌ HTTP error:', response.status);
            throw new Error(`Failed to load room data: ${response.status}`);
        }

        const data = await response.json();
        console.log('📦 Room API Response:', data);
        
        // Check for error status
        if (data.status === 'error') {
            console.error('❌ API Error:', data.message);
            throw new Error(data.message || 'No rooms available');
        }
        
        // Handle success response with nested data structure
        // Your PHP model returns: {status: "success", data: {rooms: [...], count: X}}
        if (data.status === 'success' && data.data && data.data.rooms) {
            console.log('✅ Rooms loaded:', data.data.rooms.length, 'rooms');
            this.roomData = data.data.rooms;
            return;
        }
        
        // Fallback: check for direct rooms array (backward compatibility)
        if (data.rooms && Array.isArray(data.rooms)) {
            console.log('✅ Rooms loaded (fallback):', data.rooms.length, 'rooms');
            this.roomData = data.rooms;
            return;
        }
        
        // No rooms found in any expected format
        console.error('❌ No rooms in response:', data);
        throw new Error('No rooms available for this hotel');
    }

    /**
     * Set up event listeners
     */
    setupEventListeners() {
        // Room selection via event delegation
        this.elements.roomOptions.addEventListener('click', (e) => {
            const selectButton = e.target.closest('.btn-select-room');
            if (selectButton) {
                const roomCard = selectButton.closest('.room-card');
                if (roomCard && roomCard.dataset.roomId) {
                    this.handleRoomSelection(roomCard.dataset.roomId);
                }
            }
        });

        // Book now button
        this.elements.bookButton.addEventListener('click', () => {
            this.handleBooking();
        });
    }

    /**
     * Handle room selection
     */
    handleRoomSelection(roomId) {
        console.log('🎯 Room selected:', roomId);
        
        // Find the room (roomId might be string or number)
        this.selectedRoom = this.roomData.find(room => room.id == roomId);
        
        if (!this.selectedRoom) {
            console.error('❌ Room not found:', roomId);
            BookingUtils.showError('Room not found');
            return;
        }
        
        console.log('✅ Selected room:', this.selectedRoom);
        
        // Update UI - highlight selected room
        document.querySelectorAll('.room-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        const selectedCard = document.querySelector(`[data-room-id="${roomId}"]`);
        if (selectedCard) {
            selectedCard.classList.add('selected');
        }
        
        // Update summary and enable book button
        this.updateBookingSummary();
        this.elements.bookButton.disabled = false;
    }

    /**
     * Render hotel information
     */
    renderHotelInfo() {
        if (!this.hotelData) {
            console.warn('No hotel data to render');
            return;
        }

        const hotel = this.hotelData;
        
        // Render hotel header
        this.elements.hotelInfo.innerHTML = `
            <div class="hotel-header">
                <h2>${hotel.name || 'Hotel'}</h2>
                <div class="hotel-meta">
                    <div class="hotel-rating">
                        <span class="stars">${'★'.repeat(Math.floor(parseFloat(hotel.rate) || 4))}</span>
                        <span class="rating-number">${hotel.rate || '4.0'}</span>
                    </div>
                    <div class="hotel-location">
                        <i class="icon-location"></i>
                        <span>${hotel.location || hotel.address || hotel.city}</span>
                    </div>
                </div>
            </div>
        `;

        // Render amenities if available
        if (hotel.services) {
            const amenitiesList = typeof hotel.services === 'string' 
                ? hotel.services.split(',').map(a => a.trim())
                : hotel.services;
            
            this.elements.hotelAmenities.innerHTML = amenitiesList
                .map(amenity => `<li>${amenity}</li>`)
                .join('');
        }

        // Render description
        if (hotel.description) {
            this.elements.hotelDescription.textContent = hotel.description;
        }
    }

    /**
     * Render room options
     */
    renderRoomOptions() {
        if (!this.roomData.length) {
            this.elements.roomOptions.innerHTML = '<p class="no-rooms">No rooms available for the selected dates</p>';
            return;
        }

        console.log('🏨 Rendering rooms:', this.roomData);

        this.elements.roomOptions.innerHTML = this.roomData
            .map(room => {
                // Handle amenities - it's a comma-separated string from database
                let amenitiesDisplay = '';
                if (room.amenities) {
                    amenitiesDisplay = typeof room.amenities === 'string' 
                        ? room.amenities 
                        : (Array.isArray(room.amenities) ? room.amenities.join(', ') : '');
                }

                // Calculate price for the stay
                const pricePerNight = parseFloat(room.price_per_night) || 0;
                const totalPrice = pricePerNight * this.stayDuration;

                return `
                    <div class="room-card" data-room-id="${room.id}">
                        <div class="room-header">
                            <h3>${room.room_type || 'Room'}</h3>
                            <span class="room-capacity">
                                <i class="icon-users"></i> ${room.capacity || 2} guests
                            </span>
                        </div>
                        <div class="room-details">
                            <p class="room-description">${room.description || 'Comfortable room with modern amenities'}</p>
                            ${amenitiesDisplay ? `
                                <div class="room-amenities">
                                    <strong>Amenities:</strong> ${amenitiesDisplay}
                                </div>
                            ` : ''}
                            <div class="room-availability">
                                <span class="available-count ${room.available_rooms < 3 ? 'low-stock' : ''}">
                                    ${room.available_rooms || 0} rooms available
                                </span>
                            </div>
                        </div>
                        <div class="room-footer">
                            <div class="room-pricing">
                                <div class="price-per-night">
                                    <strong>₹${this.formatCurrency(pricePerNight)}</strong>
                                    <span class="per-night">per night</span>
                                </div>
                                <div class="total-price">
                                    <span class="label">${this.stayDuration} nights total:</span>
                                    <strong>₹${this.formatCurrency(totalPrice)}</strong>
                                </div>
                            </div>
                            <button class="btn-select-room" data-room-id="${room.id}">
                                Select Room
                            </button>
                        </div>
                    </div>
                `;
            })
            .join('');
    }

    /**
     * Update booking summary
     */
    updateBookingSummary() {
        const checkIn = this.config.urlParams.checkIn;
        const checkOut = this.config.urlParams.checkOut;
        
        if (!checkIn || !checkOut) {
            BookingUtils.showError('Invalid booking dates');
            return;
        }

        const nights = this.stayDuration;

        if (!this.selectedRoom) {
            this.elements.bookingSummary.innerHTML = `
                <div class="booking-summary">
                    <h4>Booking Summary</h4>
                    <p class="select-room-message">Select a room to see booking details</p>
                    <div class="stay-info">
                        <p><strong>Check-in:</strong> ${this.formatDate(checkIn)}</p>
                        <p><strong>Check-out:</strong> ${this.formatDate(checkOut)}</p>
                        <p><strong>Stay duration:</strong> ${nights} night${nights > 1 ? 's' : ''}</p>
                        <p><strong>Guests:</strong> ${this.config.urlParams.guests}</p>
                    </div>
                </div>
            `;
            return;
        }

        const pricePerNight = parseFloat(this.selectedRoom.price_per_night) || 0;
        const subtotal = pricePerNight * nights;
        const discount = parseFloat(this.hotelData.discount) || 0;
        const discountAmount = (subtotal * discount) / 100;
        const totalPrice = subtotal - discountAmount;

        this.elements.bookingSummary.innerHTML = `
            <div class="booking-summary">
                <h4>Booking Summary</h4>
                <div class="summary-details">
                    <div class="summary-row">
                        <span class="label">Hotel:</span>
                        <span class="value">${this.hotelData.name}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Room:</span>
                        <span class="value">${this.selectedRoom.room_type}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Check-in:</span>
                        <span class="value">${this.formatDate(checkIn)}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Check-out:</span>
                        <span class="value">${this.formatDate(checkOut)}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Nights:</span>
                        <span class="value">${nights}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Guests:</span>
                        <span class="value">${this.config.urlParams.guests}</span>
                    </div>
                    <hr>
                    <div class="summary-row">
                        <span class="label">₹${this.formatCurrency(pricePerNight)} × ${nights} nights:</span>
                        <span class="value">₹${this.formatCurrency(subtotal)}</span>
                    </div>
                    ${discount > 0 ? `
                        <div class="summary-row discount">
                            <span class="label">Discount (${discount}%):</span>
                            <span class="value">-₹${this.formatCurrency(discountAmount)}</span>
                        </div>
                    ` : ''}
                    <hr>
                    <div class="summary-row total">
                        <span class="label">Total:</span>
                        <span class="value">₹${this.formatCurrency(totalPrice)}</span>
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * Handle the booking process
     */
    async handleBooking() {
        console.log('Starting booking process...');
        
        if (!this.selectedRoom) {
            BookingUtils.showError('Please select a room');
            return;
        }

        console.log('Checking user session...', this.config.userData);
        if (!this.config.userData || !this.config.userData.id) {
            BookingUtils.showError('Please log in to continue');
            // Store current URL to redirect back after login
            const currentUrl = window.location.href;
            localStorage.setItem('bookingRedirectUrl', currentUrl);
            // Redirect to login page
            window.location.href = this.config.baseUrl + 'index.php/User/login';
            return;
        }

        try {
            const pricePerNight = parseFloat(this.selectedRoom.price_per_night) || 0;
            const subtotal = pricePerNight * this.stayDuration;
            const discount = parseFloat(this.hotelData.discount) || 0;
            const totalPrice = subtotal - (subtotal * discount / 100);

            const bookingData = {
                hotelId: this.config.urlParams.hotelId,
                roomId: this.selectedRoom.id,
                checkIn: this.config.urlParams.checkIn,
                checkOut: this.config.urlParams.checkOut,
                guests: parseInt(this.config.urlParams.guests) || 1,
                nights: this.stayDuration,
                price: totalPrice,
                userId: this.config.userData.id,
                userEmail: this.config.userData.email
            };

            console.log('Sending booking request:', bookingData);

            const response = await fetch(this.config.baseUrl + this.config.endpoints.bookRoom, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(bookingData)
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => null);
                console.error('Booking response error:', {
                    status: response.status,
                    statusText: response.statusText,
                    errorData
                });
                throw new Error(errorData?.message || 'Booking request failed');
            }

            const result = await response.json();
            console.log('Booking response:', result);
            
            if (result.status === 'success' || result.success) {
                console.log('Booking successful! Redirecting to confirmation page...');
                window.location.href = `${this.config.baseUrl}index.php/Welcome/order`;
            } else {
                console.error('Booking failed:', result);
                throw new Error(result.message || 'Booking failed');
            }
        } catch (error) {
            console.error('Booking error:', error);
            BookingUtils.showError(error.message || 'Failed to complete booking. Please try again.');
            // If session expired, redirect to login
            if (error.message?.toLowerCase().includes('please log in')) {
                const currentUrl = window.location.href;
                localStorage.setItem('bookingRedirectUrl', currentUrl);
                window.location.href = this.config.baseUrl + 'index.php/User/login';
            }
        }
    }

    /**
     * Utility: Format currency
     */
    formatCurrency(amount) {
        return new Intl.NumberFormat('en-IN', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount);
    }

    /**
     * Utility: Format date for display
     */
    formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-IN', {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }
};