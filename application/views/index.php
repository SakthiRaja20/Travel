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
                        <input type="number" placeholder="How many People?" id="people">
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


                    submit.addEventListener('click' , () => {
                        if (destination.value != '' && startDate.value != '' && endDate.value != '' && people.value != '') {
                            let a = document.createElement('a');
                            a.href = `<?php echo base_url('Welcome/result');?>?${destination.value}?${startDate.value}?${endDate.value}?${people.value}`;
                            a.click();
                        } else {
                            alert('Please Fill all inputs')
                        }
                    })

                    // Function to explore specific city
                    function exploreCity(city) {
                        const today = new Date();
                        const tomorrow = new Date(today);
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        
                        const startDate = today.toISOString().split('T')[0];
                        const endDate = tomorrow.toISOString().split('T')[0];
                        
                        window.location.href = `<?php echo base_url('Welcome/result');?>?${city}?${startDate}?${endDate}?2`;
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
    
