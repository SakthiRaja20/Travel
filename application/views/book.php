<?php $this->load->view('layout/header');?>

<!-- Styles -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/booking.css'); ?>">

<!-- Hotel Booking Page -->
<main class="booking-container">
    <!-- Left Column: Hotel Details and Booking -->
    <div class="hotel-details">
        <!-- Hotel Info Section -->
        <div id="hotelInfo" class="hotel-info">
            <div class="loading">
                Loading hotel information
            </div>
        </div>
        
        <!-- Hotel Description -->
        <div class="hotel-description">
            <!-- Amenities Section -->
            <section class="amenities-section">
                <h4>✨ Hotel Amenities</h4>
                <ul class="hotel-amenities">
                    <!-- Amenities will be populated by JavaScript -->
                </ul>
            </section>
            
            <!-- Description Section -->
            <section class="description-section">
                <h4>📖 About This Hotel</h4>
                <div id="hotelDescription" class="hotel-description-content">
                    <!-- Description will be populated by JavaScript -->
                </div>
            </section>
        </div>

        <!-- Booking Summary Section -->
        <section class="booking-summary-section">
            <h4>� Booking Summary</h4>
            <div id="bookingSummary">
                <!-- Summary will be populated by JavaScript -->
            </div>

            <!-- Booking Action -->
            <div class="booking-action">
                <button type="button" id="bookNowBtn" class="btn-book" disabled>
                    <span class="btn-text">Select a Room to Continue</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </section>
    </div>

    <!-- Right Column: Room Selection -->
    <div class="booking-sidebar">
        <!-- Room Selection -->
        <div id="roomSelection" class="room-selection">
            <h4>🏨 Select Your Room</h4>
            <div class="room-options">
                <!-- Room options will be populated by JavaScript -->
            </div>
        </div>
    </div>
</main>

<!-- Configuration Script -->
<script>
    // ===== PARSE URL PARAMETERS =====
    const urlParams = new URLSearchParams(window.location.search);
    const hotelId = urlParams.get('hotel_id');
    const city = decodeURIComponent(urlParams.get('city') || '');
    const checkin = urlParams.get('checkin');
    const checkout = urlParams.get('checkout');
    const guests = urlParams.get('guests');

    // Debug logging
    console.log('🏨 Booking Page - Parsed Parameters:', {
        hotelId,
        city,
        checkin,
        checkout,
        guests
    });

    // Validate required parameters
    if (!hotelId || !city || !checkin || !checkout || !guests) {
        console.error('❌ Missing required parameters');
        alert('Invalid booking link. Please select a hotel and try again.');
        window.location.href = '<?php echo base_url('welcome/result'); ?>';
    }

    // ===== GLOBAL CONFIGURATION OBJECT =====
    window.BOOKING_CONFIG = {
        baseUrl: '<?php echo base_url(); ?>',
        userData: <?php echo json_encode($this->session->userdata('userdata') ?? null); ?>,
        urlParams: {
            hotelId: hotelId,
            city: city,
            checkIn: checkin,
            checkOut: checkout,
            guests: guests
        },
        endpoints: {
            hotelFind: 'index.php/Welcome/hotelFind',
            getHotelRooms: 'index.php/Welcome/getHotelRooms',
            bookRoom: 'index.php/Welcome/bookRoom'
        },
        selectors: {
            hotelInfo: '#hotelInfo',
            hotelAmenities: '.hotel-amenities',
            hotelDescription: '#hotelDescription',
            roomSelection: '#roomSelection',
            roomOptions: '.room-options',
            bookingSummary: '#bookingSummary',
            bookButton: '#bookNowBtn'
        }
    };

    console.log('✅ BOOKING_CONFIG initialized:', window.BOOKING_CONFIG);
</script>

<!-- Load utility scripts -->
<script src="<?php echo base_url('assets/js/date-utils.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/booking-utils.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/booking-handler.js'); ?>"></script>

<!-- Initialize booking -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        console.log('🚀 DOMContentLoaded - Initializing BookingHandler');
        
        try {
            // Check if BookingHandler class exists
            if (typeof BookingHandler === 'undefined') {
                throw new Error('BookingHandler class not found. Make sure booking-handler.js is loaded.');
            }

            // Check if required utility functions exist
            if (typeof DateUtils === 'undefined') {
                throw new Error('DateUtils not found. Make sure date-utils.js is loaded.');
            }

            if (typeof BookingUtils === 'undefined') {
                throw new Error('BookingUtils not found. Make sure booking-utils.js is loaded.');
            }

            // Initialize the booking handler
            const bookingHandler = new BookingHandler();
            
            // Start initialization
            bookingHandler.initialize().catch(error => {
                console.error('❌ Booking initialization failed:', error);
                
                // Show user-friendly error
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.innerHTML = `
                    <i class="bi bi-exclamation-triangle"></i>
                    <div>
                        <strong>Unable to load booking details</strong>
                        <p>Please refresh the page or try again later.</p>
                    </div>
                `;
                
                const container = document.querySelector('.booking-container');
                if (container) {
                    container.insertBefore(errorDiv, container.firstChild);
                }
            });

            console.log('✅ BookingHandler initialized successfully');

        } catch (error) {
            console.error('❌ Failed to create booking handler:', error);
            
            // Show critical error to user
            alert('Unable to start booking system. Please refresh the page.\n\nError: ' + error.message);
        }
    });

    // Handle page unload (optional cleanup)
    window.addEventListener('beforeunload', (event) => {
        // You can add any cleanup here if needed
        console.log('👋 Leaving booking page');
    });

    // Add error handler for uncaught errors
    window.addEventListener('error', (event) => {
        console.error('💥 Uncaught error:', event.error);
    });

    // Add handler for unhandled promise rejections
    window.addEventListener('unhandledrejection', (event) => {
        console.error('💥 Unhandled promise rejection:', event.reason);
    });
</script>

<style>
    /* Main container background */
    .booking-container {
        background-color: #eef2f6;
        padding: 25px;
    }

    /* Hotel details section styling */
    .hotel-details {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 25px;
    }

    /* Hotel info section */
    .hotel-info {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        border-bottom: 2px solid #e9ecef;
    }

    /* Hotel description sections */
    .amenities-section,
    .description-section {
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 25px;
        margin: 0 0 20px 0;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    /* Section headings */
    .amenities-section h4,
    .description-section h4,
    .booking-summary-section h4 {
        color: #1a202c;
        font-size: 1.25rem;
        margin-bottom: 1.25rem;
        font-weight: 600;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 12px;
    }

    /* Booking summary section - most important, so highest contrast */
    .booking-summary-section {
        background: linear-gradient(145deg, #ffffff 0%, #f7fafc 100%);
        border-radius: 12px;
        padding: 25px;
        margin: 25px 0;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }

    /* Room options styling */
    .room-options {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    /* Amenities list styling */
    .hotel-amenities {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .hotel-amenities li {
        background-color: #ffffff;
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .error-message {
        position: fixed;
        top: 80px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        padding: 20px 30px;
        border-radius: 12px;
        border: 2px solid #f5c6cb;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        max-width: 500px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        animation: slideDown 0.5s ease-out;
    }

    .error-message i {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .error-message strong {
        display: block;
        margin-bottom: 5px;
        font-size: 1.1rem;
    }

    .error-message p {
        margin: 0;
        font-size: 0.95rem;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translate(-50%, -30px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }

    .success-message {
        position: fixed;
        top: 80px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        padding: 20px 30px;
        border-radius: 12px;
        border: 2px solid #c3e6cb;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        max-width: 500px;
        display: flex;
        align-items: center;
        gap: 15px;
        animation: slideDown 0.5s ease-out;
    }

    .success-message i {
        font-size: 1.5rem;
    }

    /* Loading overlay */
    .booking-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9998;
        backdrop-filter: blur(5px);
    }

    .booking-overlay .spinner {
        width: 60px;
        height: 60px;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #037b83;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    /* Enhanced button states */
    #bookNowBtn {
        position: relative;
        overflow: hidden;
    }

    #bookNowBtn .btn-text {
        position: relative;
        z-index: 2;
    }

    #bookNowBtn i {
        position: relative;
        z-index: 2;
        transition: transform 0.3s ease;
    }

    #bookNowBtn:hover i {
        transform: translateX(5px);
    }

    #bookNowBtn:disabled {
        cursor: not-allowed;
    }

    #bookNowBtn:disabled:hover i {
        transform: translateX(0);
    }

    /* Ensure footer stays at bottom */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main.booking-container {
        flex: 1;
    }

    /* Print styles */
    @media print {
        .booking-action,
        .btn-select-room {
            display: none;
        }
        
        .booking-sidebar {
            position: static;
        }
        
        .booking-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php $this->load->view('layout/footer');?>