<style>
    /* Modal Backdrop */
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        z-index: 998;
        display: none;
    }

    .modal-backdrop.active {
        display: block;
    }

    .login_signup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 420px;
        max-width: 90%;
        height: auto;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        border-radius: 20px;
        background: #ffffff;
        z-index: 999;
        display: none;
    }

    .login_signup h2 {
        font-size: 28px;
        font-weight: 700;
        color: #121213;
        margin-bottom: 10px;
        text-align: center;
    }

    .login_signup .subtitle {
        font-size: 14px;
        color: #666;
        text-align: center;
        margin-bottom: 30px;
    }

    .login_signup .close-modal {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        font-size: 28px;
        color: #999;
        cursor: pointer;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .login_signup .close-modal:hover {
        background: #f0f0f0;
        color: #333;
    }

    .login_signup .signupBx, .loginBx {
        width: 100%;
        display: none;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .login_signup form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 100%;
        gap: 16px;
    }

    .login_signup form input,
    .login_signup form select {
        width: 100%;
        padding: 14px 16px;
        border-radius: 12px;
        border: 2px solid #e0e0e0;
        background: #f8f9fa;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        outline: none;
    }

    .login_signup form input:focus,
    .login_signup form select:focus {
        border-color: #000;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
    }

    .login_signup form input::placeholder {
        color: #999;
        font-weight: 400;
        text-transform: capitalize;
    }

    .login_signup form select {
        cursor: pointer;
        color: #333;
    }

    .login_signup form button {
        width: 100%;
        padding: 14px 20px;
        margin-top: 10px;
        border-radius: 12px;
        border: none;
        background: #000;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .login_signup form button:hover {
        background: #333;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    .login_signup .switch-text {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #666;
    }

    .login_signup .switch-text a {
        color: #000;
        font-weight: 600;
        text-decoration: none;
    }

    .login_signup .switch-text a:hover {
        color: #333;
        text-decoration: underline;
    }

    /* Demo Credentials Styling */
    .demo-credentials {
        display: flex;
        gap: 12px;
        width: 100%;
        margin-bottom: 20px;
    }

    .demo-card {
        flex: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 16px;
        border-radius: 12px;
        text-align: left;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .demo-card.admin-demo {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
    }

    .demo-card h4 {
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .demo-card p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 12px;
        margin: 6px 0;
        font-weight: 500;
    }

    .demo-card p strong {
        color: #fff;
        font-weight: 600;
    }

    .login_signup_ll {
        display: block;
    }

    .login_signup_ll .loginBx {
        display: flex;
    }

    .login_signup_ss {
        display: block;
    }

    .login_signup_ss .signupBx {
        display: flex;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login_signup {
            width: 90%;
            padding: 30px 25px;
        }

        .login_signup h2 {
            font-size: 24px;
        }

        .demo-credentials {
            flex-direction: column;
            gap: 10px;
        }

        .demo-card h4 {
            font-size: 13px;
        }

        .demo-card p {
            font-size: 11px;
        }

        .demo-btn small {
            font-size: 10px;
        }
    }

    /* Demo Button Styles */
    .demo-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: left;
        color: white;
        width: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }

    .demo-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    }

    .demo-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .demo-btn.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .demo-btn.loading::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 15px;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,0.3);
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .demo-btn h4 {
        margin: 0 0 8px 0;
        font-size: 14px;
        font-weight: 600;
    }

    .demo-btn p {
        margin: 4px 0;
        font-size: 12px;
        opacity: 0.9;
    }

    .demo-btn.admin-demo {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .demo-btn.admin-demo:hover {
        background: linear-gradient(135deg, #e083eb 0%, #e5475c 100%);
    }
</style>

<!-- Modal Backdrop -->
<div class="modal-backdrop"></div>

<!-- Login And Signup -->
<div class="login_signup">
    <button class="close-modal" onclick="closeModal()">&times;</button>
    
    <div class="signupBx">
        <h2>Create Account</h2>
        <p class="subtitle">Join us to start your journey</p>
        <form id="signupForm">
            <input type="text" id="signup_name" placeholder="Full Name" required>
            <input type="number" id="signup_mobile" placeholder="Mobile Number" required>
            <input type="password" id="signup_password" placeholder="Password" required>
            <select name="" id="signup_gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <button type="submit" id="signup">Create Account</button>
        </form>
        <p class="switch-text">Already have an account? <a href="#" onclick="switchToLogin(event)">Login</a></p>
    </div>

    <div class="loginBx">
        <h2>Welcome Back</h2>
        <p class="subtitle">Login to continue your adventure</p>
        
        <!-- Demo Credentials -->
        <div class="demo-credentials">
            <button class="demo-card demo-btn" onclick="fillDemoCredentials('user')" data-type="user">
                <h4>👤 Demo User</h4>
                <p><strong>Mobile:</strong> 1234567890</p>
                <p><strong>Password:</strong> 123456</p>
                <small style="display: block; margin-top: 8px; opacity: 0.8;">Click to auto-login</small>
            </button>
            <button class="demo-card demo-btn admin-demo" onclick="fillDemoCredentials('admin')" data-type="admin">
                <h4>👑 Admin</h4>
                <p><strong>Username:</strong> admin</p>
                <p><strong>Password:</strong> admin@123</p>
                <small style="display: block; margin-top: 8px; opacity: 0.8;">Click to auto-login</small>
            </button>
        </div>
        
        <form id="loginForm">
            <input type="text" id="login_mobile" placeholder="Username or Mobile Number" required>
            <input type="password" id="login_password" placeholder="Password" required>
            <button type="submit" id="login">Login</button>
        </form>
        <p class="switch-text">Don't have an account? <a href="#" onclick="switchToSignup(event)">Sign up</a></p>
    </div>
</div>


 <script>
    let login_signup = document.getElementsByClassName('login_signup')[0];
    let modalBackdrop = document.getElementsByClassName('modal-backdrop')[0];
    let loginBtn = document.getElementById('loginBtn');
    let signupBtn = document.getElementById('signupBtn');

    function closeModal() {
        login_signup?.classList.remove('login_signup_ll');
        login_signup?.classList.remove('login_signup_ss');
        modalBackdrop?.classList.remove('active');
    }

    function switchToLogin(e) {
        e.preventDefault();
        login_signup?.classList.add('login_signup_ll');
        login_signup?.classList.remove('login_signup_ss');
    }

    function switchToSignup(e) {
        e.preventDefault();
        login_signup?.classList.remove('login_signup_ll');
        login_signup?.classList.add('login_signup_ss');
    }

    loginBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        login_signup?.classList.add('login_signup_ll');
        login_signup?.classList.remove('login_signup_ss');
        modalBackdrop?.classList.add('active');
    });

    signupBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        login_signup?.classList.remove('login_signup_ll');
        login_signup?.classList.add('login_signup_ss');
        modalBackdrop?.classList.add('active');
    });

    // Close modal when clicking backdrop
    modalBackdrop?.addEventListener('click', closeModal);

    // Close modal on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Demo credentials auto-fill function
    function fillDemoCredentials(type) {
        const mobileInput = document.getElementById('login_mobile');
        const passwordInput = document.getElementById('login_password');
        const button = event.target.closest('.demo-btn');
        
        // Add loading state
        button.classList.add('loading');
        button.innerHTML = '<h4>🔄 Logging in...</h4><p>Please wait...</p>';
        
        if (type === 'user') {
            mobileInput.value = '1234567890';
            passwordInput.value = '123456';
        } else if (type === 'admin') {
            mobileInput.value = 'admin';
            passwordInput.value = 'admin@123';
        }
        
        // Auto-submit the login form after filling credentials
        setTimeout(() => {
            document.getElementById('login').click();
        }, 800);
    }
 </script>

 <script>
    let base_url = "<?php echo base_url('user/');?>";

    // Login 
    document.getElementById('login').addEventListener('click' , async (e) => {
        e.preventDefault();

        let form = new FormData();
        form.append('mobile', document.getElementById('login_mobile').value);
        form.append('password', document.getElementById('login_password').value);

        try {
            const response = await fetch(base_url +  'login' , {
                method: "POST",
                body: form
            }
        );

        const result = await response.json();

        alert(result.message);

        // Redirect admin to dashboard, regular users reload
        if (result.status === 'success' && result.is_admin === true) {
            window.location.href = "<?php echo base_url('dashboard'); ?>";
        } else {
            window.location.reload();
        }


        } catch (error) {
            console.log(error);
        }
    });

    // signup 
    document.getElementById('signup')?.addEventListener('click' , async (e) => {
        e.preventDefault();

        let form = new FormData();
        form.append('name', document.getElementById('signup_name').value);
        form.append('mobile', document.getElementById('signup_mobile').value);
        form.append('password', document.getElementById('signup_password').value);
        form.append('gender', document.getElementById('signup_gender').value);

        try {
            const response = await fetch(base_url +  'signup' , {
                method: "POST",
                body: form
            }
        );

        const result = await response.json();

        alert(result.message);

        window.location.reload();


        } catch (error) {
            console.log(error);
        }
    });


    // logoutBtn 
    document.getElementById('logoutBtn')?.addEventListener('click' , async (e) => {
        e.preventDefault();

        try {
            const response = await fetch(base_url +  'logout');

        const result = await response.json();

        alert(result.message);

        window.location.reload();


        } catch (error) {
            console.log(error);
        }
    });


 </script>

 </script>


<footer>
    <div class="footer-container">
        <!-- Newsletter Section -->
        <div class="footer-newsletter">
            <h2>Subscribe & Get Special Discounts</h2>
            <p>Be the first to know about new destinations, travel inspiration, and exclusive deals</p>
            <div class="newsletter-input">
                <input type="email" placeholder="Enter your email address" id="newsletter-email">
                <button onclick="subscribeNewsletter()">Subscribe</button>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="footer-links">
            <div class="footer-column">
                <h3>Wide Ways</h3>
                <p class="footer-desc">Your trusted travel companion for discovering amazing destinations around the world.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?= base_url('/');?>">Home</a></li>
                    <li><a href="<?= base_url('Welcome/destinations');?>">Destinations</a></li>
                    <li><a href="<?= base_url('Welcome/order');?>">My Bookings</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Popular Destinations</h4>
                <ul>
                    <li><a href="javascript:void(0);" onclick="exploreFooterCity('Jaipur')">Jaipur</a></li>
                    <li><a href="javascript:void(0);" onclick="exploreFooterCity('Delhi')">Delhi</a></li>
                    <li><a href="javascript:void(0);" onclick="exploreFooterCity('Goa')">Goa</a></li>
                    <li><a href="javascript:void(0);" onclick="exploreFooterCity('Mumbai')">Mumbai</a></li>
                    <li><a href="<?= base_url('Welcome/destinations');?>">View All</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Contact Info</h4>
                <ul class="footer-contact">
                    <li><i class="bi bi-geo-alt-fill"></i> 123 Travel Street, City</li>
                    <li><i class="bi bi-telephone-fill"></i> +1 234 567 890</li>
                    <li><i class="bi bi-envelope-fill"></i> info@wideways.com</li>
                    <li><i class="bi bi-clock-fill"></i> Mon - Fri: 9:00 - 18:00</li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; 2025 Wide Ways. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

<script>
    function subscribeNewsletter() {
        const email = document.getElementById('newsletter-email').value;
        if (email && email.includes('@')) {
            alert('Thank you for subscribing!');
            document.getElementById('newsletter-email').value = '';
        } else {
            alert('Please enter a valid email address');
        }
    }

    // Function to explore destination from footer
    function exploreFooterCity(city) {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        const startDate = today.toISOString().split('T')[0];
        const endDate = tomorrow.toISOString().split('T')[0];
        
        window.location.href = `<?php echo base_url('Welcome/result');?>?city=${encodeURIComponent(city)}&checkin=${encodeURIComponent(startDate)}&checkout=${encodeURIComponent(endDate)}&guests=2`;
    }
</script>

<script>
// Sticky navbar fallback for browsers that don't support CSS sticky positioning
(function() {
    const header = document.querySelector('header');
    let lastScrollTop = 0;
    
    function makeSticky() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Add fixed positioning as fallback for older browsers
        if (scrollTop > 0 && !CSS.supports('position', 'sticky')) {
            header.style.position = 'fixed';
            header.style.top = '0';
            header.style.width = '100%';
            header.style.zIndex = '1000';
            header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        }
    }
    
    // Apply fallback for browsers that don't support sticky positioning
    if (!CSS.supports('position', 'sticky') && !CSS.supports('position', '-webkit-sticky')) {
        console.log('Using JavaScript sticky fallback');
        window.addEventListener('scroll', makeSticky);
    }
})();
</script>
    
</body>

</html>