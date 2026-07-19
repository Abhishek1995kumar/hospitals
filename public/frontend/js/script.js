// Page Navigation
function showPage(name, el) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById('page-' + name).classList.add('active');
    document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
    if (el) {
        el.classList.add('active');
    } else {
        document.querySelectorAll('.nav-links a').forEach(a => {
            if (a.getAttribute('href') && a.getAttribute('href').includes(name)) {
                a.classList.add('active');
            }
        });
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


// Modal Controls
function openModal(type) {
    document.getElementById('modalOverlay').classList.add('open');
    document.getElementById('contentLogin').style.display = type === 'login' ? 'block' : 'none';
    document.getElementById('contentBook').style.display = type === 'book' ? 'block' : 'none';
    document.getElementById('successMsg').style.display = 'none';
}

function closeOverlay(e) {
    if (e.target === document.getElementById('modalOverlay')) closeModal();
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
}

// Tab Switch
function switchTab(t) {
    document.getElementById('formLogin').style.display = t === 'login' ? 'block' : 'none';
    document.getElementById('formRegister').style.display = t === 'register' ? 'block' : 'none';
    document.getElementById('tabLogin').classList.toggle('active', t === 'login');
    document.getElementById('tabRegister').classList.toggle('active', t === 'register');
}

// Success Message
function doSuccess(msg) {
    document.getElementById('contentLogin').style.display = 'none';
    document.getElementById('contentBook').style.display = 'none';
    document.getElementById('successMsg').style.display = 'block';
    document.getElementById('successText').textContent = msg;
}

// Banner Book
function bannerBook() {
    var doc = document.getElementById('bannerDoc').value;
    var date = document.getElementById('bannerDate').value;
    if (!doc || !date) {
        openModal('book');
        return;
    }
    showToast('Appointment request send ho gayi!');
}

// Contact Submit
function submitContact() {
    showToast('Message bhej diya gaya! Hum jald sampark karenge. 😊');
}

// Toast
function showToast(msg) {
    var t = document.getElementById('toast');
    t.textContent = msg;
    t.style.display = 'block';
    setTimeout(() => { t.style.display = 'none'; }, 3000);
}

// Set default date to today
var today = new Date().toISOString().split('T')[0];
var bd = document.getElementById('bannerDate');
if (bd) bd.value = today;