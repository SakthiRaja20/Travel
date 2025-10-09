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
        <form id="loginForm">
            <input type="number" id="login_mobile" placeholder="Mobile Number" required>
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

        window.location.reload();


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


<footer>
        <h2>Subscribe & <br> get special discount</h2>
        <p>Adventure is just a click away! Be the first to know about new destinations, travel inspiration, and exclusive discounts delivered straight to your inbox</p>
        <div class="input">
            <input type="text" placeholder="Enter your Email Address">
            <button>Subscribe</button>
        </div>
        <ul>
            <li>7823 <br> <h6>Years Serving the travel Industry</h6></li>
            <li>6374 <br><h6>Global <br> Partnership</h6> </li>
            <li>1496 <br> <h6>Industry Awards since 2022</h6></li>
            <li>5658 <br> <h6>Subscribe</h6></li>
        </ul>
    </footer>
    <!-- <script src="app.js"></script> -->
    
</body>

</html>