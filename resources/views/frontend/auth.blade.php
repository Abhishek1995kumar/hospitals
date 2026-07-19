<div class="modal-overlay" id="modalOverlay" onclick="closeOverlay(event)">
    <div class="modal" id="modalBox">
        <button class="modal-close" onclick="closeModal()">×</button>
        <!-- Login/Register Content -->
        <div id="contentLogin">
        <h3>Welcome Back 👋</h3>
        <p>Apne HMS account mein login karein</p>
        <div class="tab-row">
            <button class="tab-btn active" id="tabLogin" onclick="switchTab('login')">Login</button>
            <button class="tab-btn" id="tabRegister" onclick="switchTab('register')">Register</button>
        </div>
        <div id="formLogin">
            <div class="form-group"><label>Email / Phone</label><input type="text" placeholder="email ya phone number"></div>
            <div class="form-group"><label>Password</label><input type="password" placeholder="••••••••"></div>
            <button class="btn-submit" onclick="doSuccess('Login successful! HMS mein aapka swagat hai.')">Login</button>
            <p style="font-size:12px;color:var(--gray);text-align:center;margin-top:12px;cursor:pointer;">Forgot password?</p>
        </div>
        <div id="formRegister" style="display:none;">
            <div class="form-row">
            <div class="form-group"><label>First Name</label><input type="text" placeholder="Pehla naam"></div>
            <div class="form-group"><label>Last Name</label><input type="text" placeholder="Aakhri naam"></div>
            </div>
            <div class="form-group"><label>Email</label><input type="email" placeholder="email@example.com"></div>
            <div class="form-group"><label>Phone</label><input type="text" placeholder="+91 XXXXX XXXXX"></div>
            <div class="form-group"><label>Password</label><input type="password" placeholder="••••••••"></div>
            <button class="btn-submit" onclick="doSuccess('Account create ho gaya! Welcome to HMS.')">Create Account</button>
        </div>
        </div>

        <!-- Book Appointment Content -->
        <div id="contentBook" style="display:none;">
        <h3>Book Appointment 📅</h3>
        <p>Doctor select karein aur apna slot book karein</p>
        <div class="form-group">
            <label>Doctor Select Karein</label>
            <select>
            <option value="">-- Doctor choose karein --</option>
            <option>Dr. Abhishek Kumar — Cardiology</option>
            <option>Dr. Tehshin Bano — Orthopedics</option>
            <option>Dr. Sadaf Fatima — Dental Care</option>
            <option>Dr. Neha Sharma — Pulmonology</option>
            <option>Dr. Rohit Kumar — Neurology</option>
            <option>Dr. Sunita Mehta — Ophthalmology</option>
            </select>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Date</label><input type="date"></div>
            <div class="form-group">
            <label>Time Slot</label>
            <select>
                <option>09:00 AM</option>
                <option>10:00 AM</option>
                <option>11:00 AM</option>
                <option>12:00 PM</option>
                <option>02:00 PM</option>
                <option>03:00 PM</option>
                <option>04:00 PM</option>
                <option>05:00 PM</option>
            </select>
            </div>
        </div>a
        <div class="form-group"><label>Patient Name</label><input type="text" placeholder="Patient ka poora naam"></div>
        <div class="form-group"><label>Phone</label><input type="text" placeholder="+91 XXXXX XXXXX"></div>
        <button class="btn-submit" onclick="doSuccess('Appointment successfully book ho gayi! Confirmation aapke phone par bheja jayega.')">Confirm Booking ✓</button>
        </div>

        <!-- Success Message -->
        <div class="success-msg" id="successMsg">
        <div class="success-icon">✅</div>
        <h4>Shukriya!</h4>
        <p id="successText"></p>
        <button class="btn-submit" style="margin-top:16px;" onclick="closeModal()">Close</button>
        </div>
    </div>
</div>