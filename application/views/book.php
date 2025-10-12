<!-- Header  -->
<?php $this->load->view('layout/header');?>
<!-- Main Content  -->

<main style="flex: 1;">
<style>
    .hotelBook {
        width: 90%;
        position: relative;
        margin: 10px auto;
    }
    .hotelBook .hotelContent {
        display: flex;
    }
    .hotelBook .hotelContent img {
        width: 480px;
        border-radius: 10px;
        box-shadow:  0 0 20px rgb(0,0,0,.2);
        border: 5px solid #fff;
        margin-right: 20px;
    }
    .hotelBook .hotelContent .rightImages img {
        width: 240px;
    }
    .hotelBook .hotelContent .rightRating {
        width: calc(100% - 720px);
        border: 1px solid lightgray;
        border-radius: 20px;
        padding: 6px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .hotelBook .hotelContent .rightRating h5 {
        white-space: nowrap;
        width: 80%;
        margin: 7px 0;
        box-shadow: 0 0 20px rgb(0,0,0,.08);
        padding: 18px;
        border-radius: 10px;
    }
    .hotelBook .hotelContent .rightRating h5 span {
        margin-bottom: 20px;
        box-shadow: 0 0 20px rgb(0,0,0,.08);
        padding: 9px 22px;
        border-radius: 10px;
        margin-right: 10px;
    }

    .hotelBook .contentSec {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .hotelBook .contentSec .contentSecLeft {
        width: calc(100% - 250px);
    }
    .hotelBook .contentSec .contentSecLeft .hotelAmenities {
        display: flex;
        align-items: center;
    }
    .hotelBook .contentSec .contentSecLeft .hotelAmenities li {
        margin: 0 10px;
    }
    .hotelBook .contentSec .contentSecRight {
        width: 250px;
    }
    .hotelBook .contentSec .contentSecRight iframe {
        border-radius: 20px;
        box-shadow: 0 0 20px rgb(0,0,0,.08);
        width: 90%;
        height: 200px;
        float: right;
        margin-top: 20px;
    }

    .hotelBook .bookingDetails {
        padding: 20px;
        border: 1px solid lightgray;
        border-radius: 20px;
        width: 70%;
    }
    .hotelBook .bookingDetails .hotelBookContent {
       width: 100%;
       display: flex;
       align-items: center;
       justify-content: space-between;
    }
    .hotelBook .bookingDetails .hotelBookContent img {
       width: 90px;
       height: 90px;
       border-radius: 15px;
       box-shadow: 0 0 20px rgb(0,0,0,.1);
    }
    .hotelBook .bookingDetails .hotelBookContent .contents h4 , h5 , h6 {
        margin: 0;
        margin-bottom: 10px;
    }
    .hotelBook .bookingDetails .hotelBookContent .contents h5 i  {
        color: orange;
    }
    .hotelBook .bookingDetails .hotelBookContent .contents h5 span {
        padding: 2px 14px;
        border: 1px solid lightgray;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 500;
        color: #8d8d8d;
        background: #fff;
        margin: 0 15px;
    }
    .hotelBook .bookingDetails .hotelBookCheckIN-out {
        width: 100%;
        display: flex;
        align-items: center;
        background: #f2f2f26b;
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
        margin-top: 15px;
    }
    .hotelBook .bookingDetails .hotelBookCheckIN-out .checkIN {
        margin-right: 10px;
        padding: 14px 17px;
        white-space: nowrap;
    }

    .hotelBook .bookingDetails .hotelBookCheckIN-out .checkIN label , p {
        font-size: 13px;
    }

    .hotelBook .bookingDetails .hotelBookCheckIN-out .checkIN h6 {
        font-size: 13px;
        font-weight: 500;
        margin: 5px 0;
    }
    .hotelBook .bookingDetails .hotelBookCheckIN-out .checkIN h6 span {
        font-size: 16px;
        font-weight: 600;
        color: #000;
    }
    .hotelBook .bookingDetails .hotelBookCheckIN-out .night {
        padding: 2px 14px;
        border: 1px solid lightgrey;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 500;
        color: #8d8d8d;
        background: #fff;
        margin: 0 15px;
        white-space: nowrap;
    }
    .hotelBook .bookingDetails .hotelBookCheckIN-out .checkIN2 span {
        color: #2f2f2f;
    }

    .hotelBook .bookingDetails .hotelBookCheckIN-out .checkIN2 span b {
        color: #000;
    }

    .hotelBook .bookingDetails .hotelBookCheckIN-out .checkIN2 span:nth-child(2) {
        border-left: 1px solid #000;
        border-right: 1px solid #000;
        margin: 0 15px;
        padding: 0 15px;
    }
    .hotelBook .alternativeDetails {
        width: 100%;
        display: flex;
        align-items: end;
        justify-content: space-between;
        margin: 20px 0;
        gap: 10px;
    }
    .hotelBook .alternativeDetails .formCard {
       width: 25%;
       display: flex;
       flex-direction: column;
    }
    .hotelBook .alternativeDetails .formCard label {
       font-size: 14px;
       font-weight: 600;
    }
    .hotelBook .alternativeDetails .formCard input {
       margin-top: 5px;
       padding: 10px 15px;
       border-radius: 10px;
       border: 1px solid lightgrey;
    }
    .hotelBook .alternativeDetails .formCard input[type="submit"] {
       background: #037b83;
       border: 1px solid #037b83;
       color: #fff;
       cursor: pointer;
       transition: .3s linear;
    }
    .hotelBook .roomSelection {
        margin: 30px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
    }
    .hotelBook .roomSelection h3 {
        margin-bottom: 20px;
        color: #037b83;
        font-size: 24px;
    }
    .hotelBook .roomOptions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    .hotelBook .roomCard {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .hotelBook .roomCard:hover {
        border-color: #037b83;
        box-shadow: 0 4px 12px rgba(3, 123, 131, 0.1);
    }
    .hotelBook .roomCard.selected {
        border-color: #037b83;
        background: #f0f8f9;
        box-shadow: 0 4px 12px rgba(3, 123, 131, 0.2);
    }
    .hotelBook .roomHeader {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .hotelBook .roomHeader h4 {
        margin: 0;
        color: #333;
        font-size: 18px;
    }
    .hotelBook .roomPrice {
        font-size: 16px;
        font-weight: bold;
        color: #037b83;
    }
    .hotelBook .roomDetails p {
        margin: 8px 0;
        color: #666;
        font-size: 14px;
    }
    .hotelBook .roomDetails i {
        margin-right: 8px;
        color: #037b83;
    }
    .hotelBook .selectRoomBtn {
        width: 100%;
        padding: 12px;
        background: #037b83;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s ease;
        margin-top: 15px;
    }
    .hotelBook .selectRoomBtn:hover {
        background: #025a5f;
    }
    .hotelBook .selectedRoom {
        background: #e8f5f5;
        padding: 15px;
        border-radius: 8px;
        margin-top: 20px;
        border-left: 4px solid #037b83;
    }
    .hotelBook .selectedRoom h5 {
        margin: 0 0 8px 0;
        color: #037b83;
    }
    .hotelBook .selectedRoom p {
        margin: 0;
        color: #666;
    }
    .hotelBook .roomError {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        color: #856404;
    }
    .hotelBook .roomError i {
        font-size: 24px;
        margin-bottom: 10px;
        display: block;
    }
    .hotelBook .roomError p {
        margin: 5px 0;
        font-size: 16px;
    }
    .hotelBook .capacity-warning {
        border-color: #ffc107 !important;
        background: #fff3cd !important;
        opacity: 0.7;
    }
    .hotelBook .capacity-warning .roomHeader h4 {
        color: #856404;
    }
    .hotelBook .capacity-warning .selectRoomBtn {
        background: #ffc107;
        color: #856404;
        cursor: not-allowed;
    }
    .hotelBook .capacity-warning .selectRoomBtn:hover {
        background: #e0a800;
    }
    .hotelBook .capacity-notice {
        background: #e7f3ff;
        border: 1px solid #b3d7ff;
        border-radius: 6px;
        padding: 12px 16px;
        margin-bottom: 20px;
        color: #0066cc;
    }
    .hotelBook .capacity-notice i {
        margin-right: 8px;
    }
    .hotelBook .capacity-notice strong {
        color: #004499;
    }
</style>

<!-- Hotel Book  -->
 <div class="hotelBook">

    <div class="contentSec">
        <div class="contentSecLeft">
            <h4>Amenities</h4>
            <div class="hotelAmenities"></div>
            <h4>Description</h4>
           
        </div>
        <div class="contentSecRight"></div>
    </div>


    <h4>Booking Details</h4>
    <div class="bookingDetails"></div>

    <h4>Guest Details</h4>

    <div class="alternativeDetails">
        <div class="formCard">
            <label for="">Name</label>
            <input type="text" placeholder="Name" id="name">
        </div>
        <div class="formCard">
            <label for="">Email</label>
            <input type="email" placeholder="Email" id="email">
        </div>
        <div class="formCard">
            <label for="">Mobile</label>
            <input type="number" placeholder="Mobile" id="mobile">
        </div>
        <div class="formCard">
            <input type="submit" id="submit" value="Book Now">
        </div>
    </div>

 </div>


 <script>
    console.log('🚀 Script loaded successfully');
    
    const mainUrl = window.location.href.split('?');
   const hotelID = mainUrl[1];
   const cityValue = mainUrl[2];
   const dateValue1 = mainUrl[3];
   const dateValue2 = mainUrl[4];
   const peopleValue = parseInt(mainUrl[5]);
   
   console.log('📊 URL Parameters:', { hotelID, cityValue, dateValue1, dateValue2, peopleValue });

   // Global variables
   let nights = 0; 
   const fetchData = async (hotelID) => {
    console.log('🔄 fetchData called for hotel:', hotelID);

    const requestData = {
        hotelID
    };

    try {
        console.log('✅ Entering try block');
        // Fetch hotel data
        const hotelResponse = await fetch("<?php echo base_url('Welcome/hotelFind')?>", {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(requestData)
        });

        // Fetch room data
        const roomResponse = await fetch("<?php echo base_url('Welcome/getHotelRooms')?>", {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(requestData)
        });

        const hotelData = await hotelResponse.json();
        const roomData = await roomResponse.json();
        
        console.log('📦 Data received - Hotel:', hotelData, 'Rooms:', roomData);

        if (hotelData && roomData) {
            console.log('✅ Both hotel and room data available');
            console.log('🏨 Hotel Data:', hotelData);
            console.log('🛏️ Room Data:', roomData);
            console.log('🔍 Room Data type:', typeof roomData[0]);
            console.log('🔍 Room Data[0]:', roomData[0]);

            // Check if room data contains an error
            if (roomData[0] && typeof roomData[0] === 'object' && roomData[0].status === 'error') {
                console.error('Room API Error:', roomData[0].message);
                
                // Show error message for room selection
                let roomSelection = document.createElement('div');
                roomSelection.className = 'roomSelection';
                roomSelection.innerHTML = `
                    <h3>Select Your Room</h3>
                    <div class="roomError">
                        <p><i class="fas fa-exclamation-triangle"></i> ${roomData[0].message}</p>
                        <p>Please contact the hotel directly or try another hotel.</p>
                    </div>
                `;
                
                // Insert room selection before booking details
                let contentSec = document.getElementsByClassName('contentSec')[0];
                contentSec.parentNode.insertBefore(roomSelection, contentSec.nextSibling);
                
                // Continue with hotel details but disable booking
                let bookingDetails = document.getElementsByClassName('bookingDetails')[0];
                bookingDetails.innerHTML = '<p style="color: red;">No rooms available for booking at this time.</p>';
                return;
            }

            // Check if roomData[0] is actually an array of rooms
            if (!Array.isArray(roomData[0])) {
                console.error('Invalid room data format:', roomData);
                
                // Show error message for room selection
                let roomSelection = document.createElement('div');
                roomSelection.className = 'roomSelection';
                roomSelection.innerHTML = `
                    <h3>Select Your Room</h3>
                    <div class="roomError">
                        <p><i class="fas fa-exclamation-triangle"></i> Unable to load room information.</p>
                        <p>Please try again or contact support.</p>
                    </div>
                `;
                
                // Insert room selection before booking details
                let contentSec = document.getElementsByClassName('contentSec')[0];
                contentSec.parentNode.insertBefore(roomSelection, contentSec.nextSibling);
                
                // Continue with hotel details but disable booking
                let bookingDetails = document.getElementsByClassName('bookingDetails')[0];
                bookingDetails.innerHTML = '<p style="color: red;">Unable to load room information.</p>';
                return;
            }

         let div = document.createElement('div');
         div.className = 'hotelContent';
         div.innerHTML = `
         <img src="<?php echo base_url('/assets/img/Hotels-photos/');?>${hotelData[0][0].poster}" alt="">
        <div class="rightImages">
            <img src="<?php echo base_url('/assets/img/Hotels-photos/');?>${hotelData[0][0].room_andHotelImages.split(',')[0]}" alt="">
            <img src="<?php echo base_url('/assets/img/Hotels-photos/');?>${hotelData[0][0].room_andHotelImages.split(',')[1].split(' ')[1]}" alt="">
        </div>
        <div class="rightRating">
            <h5><span>${Math.floor(hotelData[0][0].rate)}</span> ${hotelData[0][0].rate > 4.1 ? 'Very Good' : hotelData[0][0].rate >= 3.5 ? "Good" : hotelData[0][0].rate > 2 ? "Average" : "Poor"}</h5>
            <h5 id="totalRoomsDisplay"><span>${roomData[0].reduce((sum, room) => sum + room.available_rooms, 0)}</span> Total Rooms Available</h5>
            <h5><span>${Math.floor(hotelData[0][0].mrp)}</span>Rs / night (starting)</h5>
            <h5><span>${Math.floor(hotelData[0][0].discount)}</span>% Discount</h5>
        </div>
         `;
         let h3 = document.createElement('h3');
         h3.innerText = hotelData[0][0].name;

         document.getElementsByClassName('hotelBook')[0].prepend(div);
         document.getElementsByClassName('hotelBook')[0].prepend(h3);


        //  Amenities 

        hotelData[0][0].services.split(',').forEach(element => {
            let li = document.createElement('li');
            li.innerText = element;
            document.getElementsByClassName('hotelAmenities')[0].appendChild(li);
        });

        hotelData[0][0].food.split(',').forEach(element => {
            let li = document.createElement('li');
            li.innerText = element;
            document.getElementsByClassName('hotelAmenities')[0].appendChild(li);
        });

        let desc = document.createElement('p');
        desc.innerText = hotelData[0][0].description;
        document.getElementsByClassName('contentSecLeft')[0].append(desc);
        
        // Map 
        let lat = hotelData[0][0].lat;
        let log = hotelData[0][0].log;
        
        let map= document.createElement('iframe');
        map.setAttribute('id' , "map");
        map.setAttribute('style' , "border:0;");
        
        map.setAttribute('src' , `https://www.google.com/maps?q=${lat},${log}&hl=en&z=14&output=embed`);
        
        map.setAttribute("allowfullscreen" , "");
        map.setAttribute("loading" , "lazy");
        
        document.getElementsByClassName('contentSecRight')[0].append(map);
        


        
        // Room Selection
        let roomSelection = document.createElement('div');
        roomSelection.className = 'roomSelection';
        roomSelection.innerHTML = `
            <h3>Select Your Room</h3>
            <div class="capacity-notice">
                <p><i class="fas fa-info-circle"></i> You are booking for <strong>${peopleValue} guest${peopleValue > 1 ? 's' : ''}</strong>. Please select a room that can accommodate your group size.</p>
            </div>
            <div class="roomOptions">
        `;

        // Add room options
        console.log('About to process rooms:', roomData[0]);
        if (Array.isArray(roomData[0])) {
            roomData[0].forEach(room => {
            const isCapacityMatch = room.capacity >= peopleValue;
            const capacityClass = isCapacityMatch ? '' : 'capacity-warning';
            const buttonText = isCapacityMatch ? 'Select This Room' : `Only ${room.capacity} guests max`;
            const buttonDisabled = isCapacityMatch ? '' : 'disabled';
            
            roomSelection.innerHTML += `
                <div class="roomCard ${capacityClass}" data-room-id="${room.id}" data-room-type="${room.room_type}" data-price="${room.price_per_night}" data-capacity="${room.capacity}">
                    <div class="roomHeader">
                        <h4>${room.room_type}</h4>
                        <div class="roomPrice">₹${room.price_per_night}/night</div>
                    </div>
                    <div class="roomDetails">
                        <p><i class="fas fa-users"></i> Up to ${room.capacity} guests ${isCapacityMatch ? '' : '<span class="capacity-warning-text">(Not enough for your group)</span>'}</p>
                        <p><i class="fas fa-concierge-bell"></i> ${room.amenities}</p>
                        <p><i class="fas fa-check-circle"></i> ${room.available_rooms} rooms available</p>
                    </div>
                    <button class="selectRoomBtn" onclick="${isCapacityMatch ? `selectRoom(${room.id}, '${room.room_type}', ${room.price_per_night}, ${room.capacity})` : ''}" ${buttonDisabled}>${buttonText}</button>
                </div>
            `;
        });
        } else {
            console.error('Room data is not an array:', roomData[0]);
            // Handle case where roomData[0] is not an array
            roomSelection.innerHTML += `
                <div class="roomError">
                    <p><i class="fas fa-exclamation-triangle"></i> Unable to load room information.</p>
                    <p>Please try again or contact support.</p>
                </div>
            `;
        }

        roomSelection.innerHTML += `</div>`;

        // Insert room selection before booking details
        let contentSec = document.getElementsByClassName('contentSec')[0];
        contentSec.parentNode.insertBefore(roomSelection, contentSec.nextSibling);
        
        
        let bookingDetails = document.getElementsByClassName('bookingDetails')[0];
       
        const fullStars = Math.floor(hotelData[0][0].rate);
        let halfStar = 0;
        if (hotelData[0][0].rate.split('.').length > 1) {
             halfStar = hotelData[0][0].rate.split('.')[1] >= 50 ? 1 : 0;
        }

        const starHtml = `
    ${'<i class="bi bi-star-fill"></i>'.repeat(fullStars)}
     ${'<i class="bi bi-star-half"></i>'.repeat(halfStar)}
        `;
        // Dates 
        const formatDateParts = (date) => {
            return {
                weekday: date.toLocaleDateString("en-GB" , {
                    weekday: 'short'
                }),
                day: date.toLocaleDateString("en-GB" , {
                    day: '2-digit'
                }),
                month: date.toLocaleDateString("en-GB" , {
                    month: 'short'
                }),
                year: date.toLocaleDateString("en-GB" , {
                    year: 'numeric'
                })
            }
        }

        const date1 = new Date(dateValue1);
        const date2 = new Date(dateValue2);

        // Nights 
        const diffTime = date2 - date1;
        nights = diffTime / (1000 * 60 * 60 * 24 );

        bookingDetails.innerHTML = `
         <div class="hotelBookContent">
            <div class="contents">
                <h4>${hotelData[0][0].name}</h4>
                <h5>
    ${starHtml}
                     <span>Couple Friendly</span></h5>
                     <h6>${hotelData[0][0].location}</h6>
            </div>
            <img src="<?php echo base_url('/assets/img/Hotels-photos/');?>${hotelData[0][0].poster}" alt="">
        </div>

        <div class="hotelBookCheckIN-out">
            <div class="checkIN">
                <label for="">CHECK IN</label>
                <h6>${formatDateParts(date1).weekday} <span>${formatDateParts(date1).day} ${formatDateParts(date1).month}</span> ${formatDateParts(date1).year}</h6>
                <p>12 PM</p>
            </div>

            <p class="night">${nights} Night</p>

            <div class="checkIN">
                <label for="">CHECK Out</label>
               <h6>${formatDateParts(date2).weekday} <span>${formatDateParts(date2).day} ${formatDateParts(date2).month}</span> ${formatDateParts(date2).year}</h6>
                <p>12 PM</p>
            </div>

            <div class="checkIN checkIN2">
                <span><b>${nights}</b> Nights</span>
                <span><b>${peopleValue}</b> People</span>
                <span><b>${selectedRoomId ? Math.ceil(peopleValue / getSelectedRoomCapacity()) : '1'}</b> Room${selectedRoomId && Math.ceil(peopleValue / getSelectedRoomCapacity()) > 1 ? 's' : ''}</span>
            </div>


        </div>
        `;


        let checkLogin = <?php echo json_encode($this->session->userdata('userdata')['id'] ?? null); ?>

        let submit = document.getElementById('submit')
        submit.addEventListener('click' , () => {
            if (checkLogin) {
                console.log('Booking attempt for user:', checkLogin);
                if (document.getElementById('mobile').value != '' && document.getElementById('email').value != '' && document.getElementById('name').value != '') {
                    // Check if a room is selected
                    if (!selectedRoomId) {
                        alert('Please select a room before booking');
                        return;
                    }
                    roomBook(
                        hotelData[0][0].id,
                        hotelData[0][0].name,
                        date1,
                        date2,
                        checkLogin,
                        selectedRoomPrice * nights * Math.ceil(peopleValue / selectedRoomCapacity), // Total price for all rooms
                        peopleValue,
                        hotelData[0][0].discount,
                        document.getElementById('name').value ,
                        document.getElementById('email').value ,
                        document.getElementById('mobile').value,
                        nights,
                        selectedRoomId,
                        selectedRoomType
                    )
                } else {
                    alert('Please fill all inputs');
                    
                }
            } else {
                login_signup.classList.toggle('login_signup_ll');
                login_signup.classList.remove('modal_signup_ss');
            }
        });
        
        console.log('✅ Event listener setup complete');

        } // Close if (hotelData && roomData)
        
        console.log('✅ Exiting try block successfully');
        
    } catch (error) {
        console.error('❌ ERROR in fetchData:', error);
        console.error('❌ Error stack:', error.stack);
        // Handle error - show user friendly message
        const contentSec = document.getElementsByClassName('contentSec')[0];
        if (contentSec) {
            contentSec.innerHTML = `
                <div class="error-message" style="text-align: center; padding: 20px; color: red;">
                    <h3><i class="fas fa-exclamation-triangle"></i> Error Loading Hotel Data</h3>
                    <p>Please try refreshing the page or contact support if the problem persists.</p>
                </div>
            `;
        }
    }
   };
   
   console.log('✅ fetchData function defined');

   fetchData(hotelID);
   console.log('🎬 fetchData execution started');

   // Global variables for selected room
   let selectedRoomId = null;
   let selectedRoomType = null;
   let selectedRoomPrice = null;
   let selectedRoomCapacity = null;
   
   console.log('✅ Global room selection variables initialized');

   function getSelectedRoomCapacity() {
       return selectedRoomCapacity || 2; // Default fallback
   }

   function selectRoom(roomId, roomType, price, capacity) {
       console.log('🎯 Room selected:', { roomId, roomType, price, capacity });
       // Remove previous selection
       document.querySelectorAll('.roomCard').forEach(card => {
           card.classList.remove('selected');
       });

       // Add selection to clicked room
       event.target.closest('.roomCard').classList.add('selected');

       // Store selected room data
       selectedRoomId = roomId;
       selectedRoomType = roomType;
       selectedRoomPrice = price;
       selectedRoomCapacity = capacity;

       // Update booking details with selected room
       updateBookingDetails(roomType, price);

       console.log('Selected Room:', { roomId, roomType, price, capacity });
   }

   function updateBookingDetails(roomType, price) {
       console.log('🔄 updateBookingDetails called with:', { roomType, price, nights, peopleValue, selectedRoomCapacity });
       
       // Update the booking summary to show selected room
       let bookingDetails = document.getElementsByClassName('bookingDetails')[0];
       if (bookingDetails) {
           // Update room count in the existing display
           let roomCountSpan = bookingDetails.querySelector('.checkIN2 span:nth-child(3) b');
           if (roomCountSpan) {
               let roomsNeeded = selectedRoomCapacity > 0 ? Math.ceil(peopleValue / selectedRoomCapacity) : 1;
               roomCountSpan.textContent = roomsNeeded;
               
               // Update the "Room" vs "Rooms" text
               let roomText = roomCountSpan.nextSibling;
               if (roomText) {
                   roomText.textContent = roomsNeeded > 1 ? ' Rooms' : ' Room';
               }
           }
           
           let roomInfo = bookingDetails.querySelector('.roomInfo');
           if (!roomInfo) {
               roomInfo = document.createElement('div');
               roomInfo.className = 'roomInfo';
               bookingDetails.appendChild(roomInfo);
           }
           
           let roomsNeeded = selectedRoomCapacity > 0 ? Math.ceil(peopleValue / selectedRoomCapacity) : 1;
           let totalPrice = price * nights * roomsNeeded;
           
           console.log('💰 Price calculation:', { price, nights, roomsNeeded, totalPrice });
           
           roomInfo.innerHTML = `
               <div class="selectedRoom">
                   <h5>Selected Room: ${roomType}</h5>
                   <p>Price per night: ₹${price}</p>
                   <p>Rooms needed: ${roomsNeeded}</p>
                   <p><strong>Total Price: ₹${totalPrice}</strong></p>
               </div>
           `;
       }
   }



   let roomBook = async (hotelID, hotelName, startDate, endDate, userID, price, peopleValue, discount, bookingName, bookingEmail, bookingPhone, nights, roomId, roomType) => {
       console.log('📝 roomBook called with:', { hotelID, hotelName, startDate, endDate, userID, price, peopleValue, discount, bookingName, bookingEmail, bookingPhone, nights, roomId, roomType });
       
       try {
           let data = {
               hotelID, hotelName, startDate, endDate, userID, price, peopleValue, discount, bookingName, bookingEmail, bookingPhone, nights, roomId, roomType
           };
           
           console.log('📤 Sending booking request:', data);

           let response = await fetch("<?php echo base_url('Welcome/bookRoom')?>", {
               method: 'POST',
               headers: {
                   "Content-Type": "application/json"
               },
               body: JSON.stringify(data)
           });

           let result = await response.json();
           
           console.log('📥 Booking response:', result);

           if (result.status == 'success') {
               console.log('✅ Booking successful!');
               alert(result.message);
               window.location.href = "<?php echo base_url('/order')?>";
           } else {
               console.log('❌ Booking failed:', result.message);
               alert(result.message);
           }
       } catch (error) {
           console.error('❌ Error in roomBook:', error);
           console.error('❌ Error stack:', error.stack);
           alert('An error occurred while booking. Please try again.');
       }
   };
   
   console.log('✅ All functions defined - Script ready');
   
 </script>

</main>

<!-- Footer  -->
  <?php $this->load->view('layout/footer');?>
    
