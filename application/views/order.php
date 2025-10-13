<!-- Header  -->
<?php $this->load->view('layout/header');?>
<!-- Main Content  -->

<main class="bookings-container">
    
<!-- Hotel Book  -->
 <div class="hotelBook">
   <h4>Booking Details</h4>
   <div id="bookingsContainer"></div>
 </div>


 <script>
    const mainUrl = window.location.href.split('?');
   const hotelID = mainUrl[1];
   const cityValue = mainUrl[2];
   const dateValue1 = mainUrl[3];
   const dateValue2 = mainUrl[4];
   const peopleValue = mainUrl[5];

//    fetch hotel data 
   const fetchData = async () => {

    let id = <?php echo json_encode($this->session->userdata('userdata')['id'] ?? null); ?>


    try {
        const response = await fetch("<?php echo base_url('Welcome/hotelBooking')?>" , {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({id})
        });

        const data = await response.json();

        if (data && data[0] && data[0].length > 0) {
            console.log(data);


            let bookingsContainer = document.getElementById('bookingsContainer');


             // Booking Details 

        

        // Dates 
        const formatDateParts = (date) => {

            date = new Date(date);

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

        

        data[0].forEach((el , i) => {


            // Stars

        
        const fullStars = Math.floor(el.rate);
        let halfStar = 0;
        if (el.rate.split('.').length > 1) {
             halfStar = el.rate.split('.')[1] >= 50 ? 1 : 0;
        }

        const starHtml = `
    ${'<i class="bi bi-star-fill"></i>'.repeat(fullStars)}
     ${'<i class="bi bi-star-half"></i>'.repeat(halfStar)}
        `;

            let bookingDetails = document.createElement('div');
            bookingDetails.className = 'bookingDetails';
            bookingDetails.innerHTML = `
         <div class="hotelBookContent">
            <div class="contents">
                <h4>${el.name}</h4>
                <h5>
        ${starHtml}
                     <span>Couple Friendly</span></h5>
                     <h6>${el.location} </h6>
            </div>
            <img src="<?php echo base_url('/assets/img/Hotels-photos/');?>${el.poster}" alt="">
        </div>

        <div class="hotelBookCheckIN-out">
            <div class="checkIN">
                <label for="">CHECK IN</label>
                <h6>${formatDateParts(el.startDate).weekday} <span>${formatDateParts(el.startDate).day} ${formatDateParts(el.startDate).month}</span> ${formatDateParts(el.startDate).year}</h6>
                <p>12 PM</p>
            </div>

            <p class="night">${el.nights} Night</p>

            <div class="checkIN">
                <label for="">CHECK Out</label>
               <h6>${formatDateParts(el.endDate).weekday} <span>${formatDateParts(el.endDate).day} ${formatDateParts(el.endDate).month}</span> ${formatDateParts(el.endDate).year}</h6>
                <p>12 PM</p>
            </div>

            <div class="checkIN checkIN2">
                <span><b>${el.nights}</b> Nights</span>
                <span><b>${el.peopleValue}</b> People</span>
                <span><b>${Math.ceil(el.peopleValue / el.capacity)}</b> Room${Math.ceil(el.peopleValue / el.capacity) > 1 ? 's' : ''}</span>
            </div>

             <div class="checkIN">
                <label for="">Price</label>
                <h6><span>${((el.price) - ((el.mrp * el.discount) / 100)) * Math.ceil(el.peopleValue / el.capacity)}</span>Rs</h6>
                <p>MRP <b>${el.mrp * Math.ceil(el.peopleValue / el.capacity)}</b> <b>${Math.floor(el.discount)}%</b> Discount</p>
            </div>


        </div>
        `;

        bookingsContainer.appendChild(bookingDetails);
        });

        

        } else {
            // Show empty state placeholder
            let bookingsContainer = document.getElementById('bookingsContainer');
            bookingsContainer.innerHTML = `
                <div class="empty-bookings">
                    <i class="bi bi-calendar-x"></i>
                    <h3>No Bookings Yet</h3>
                    <p>You haven't made any bookings yet. Start exploring amazing destinations and create your perfect travel experience!</p>
                    <a href="<?php echo base_url('Welcome'); ?>" class="explore-btn">
                        <i class="bi bi-compass"></i> Explore Destinations
                    </a>
                </div>
            `;
        }
    } catch (error) {
        console.error(error);
        // Show error state
        let bookingsContainer = document.getElementById('bookingsContainer');
        bookingsContainer.innerHTML = `
            <div class="empty-bookings">
                <i class="bi bi-exclamation-triangle"></i>
                <h3>Oops! Something went wrong</h3>
                <p>We couldn't load your bookings. Please try refreshing the page.</p>
                <a href="javascript:location.reload()" class="explore-btn">
                    <i class="bi bi-arrow-clockwise"></i> Refresh Page
                </a>
            </div>
        `;
    }

   }

   fetchData();



  
 </script>

</main>

<!-- Footer  -->
  <?php $this->load->view('layout/footer');?>
    
