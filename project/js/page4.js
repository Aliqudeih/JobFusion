function showNotifications() {
    window.location.href = './notifications.php';
}

function openContactForm() {
    window.location.href = './contact.php';
}

function openSettings() {
    document.querySelector('.header').style.display = 'none';
    document.querySelector('.card-container').style.display = 'none';
    document.querySelector('.create-project-btn').style.display = 'none';
    document.querySelector('.contact').style.display = 'none';

    document.getElementById('settingsView').style.display = 'block';



    // تحميل باقي البيانات
    document.getElementById('settingsName').textContent = localStorage.getItem('userName') || 'John Doe';
    document.getElementById('settingsEmail').textContent = localStorage.getItem('userEmail') || 'john@example.com';
    document.getElementById('settingsPhone').textContent = localStorage.getItem('userPhone') || '+1234567890';
    document.getElementById('settingsLocation').textContent = localStorage.getItem('userLocation') || 'New York, USA';
    document.getElementById('settingsPassword').textContent = localStorage.getItem('userPassword') || '********';
}

function closeSettings() {
    document.querySelector('.header').style.display = 'block';
    document.querySelector('.card-container').style.display = 'grid';
    document.querySelector('.create-project-btn').style.display = 'block';
    document.querySelector('.contact').style.display = 'block';

    document.getElementById('settingsView').style.display = 'none';
}

function hideChangePasswordOverlay() {
    const overlay = document.querySelector(".overlay-content");
    if (overlay) {
        overlay.style.display = "none";
    }
}


function logoutUser() {
    const confirmation = confirm('Are you sure you want to log out?');
    if (confirmation) {
        window.location.href = '/php/home0.php';
    }
}

function changeProfilePicture() {
    const newImageUrl = prompt("Enter the URL of your new profile picture:");
    if (newImageUrl) {
        document.getElementById('profilePicture').src = newImageUrl;
        localStorage.setItem('profilePicture', newImageUrl); // حفظ الصورة في localStorage
    }
}

function toggleEditMode() {
    const fields = ['Name', 'Email', 'Phone', 'Location', 'Password'];
    fields.forEach(field => {
        const span = document.getElementById(`settings${field}`);
        const input = document.getElementById(`edit${field}`);
        if (span && input) {
            if (span.style.display === 'none') {
                span.style.display = 'inline';
                input.style.display = 'none';
            } else {
                span.style.display = 'none';
                input.style.display = 'inline';
                input.value = span.textContent;
            }
        }
    });

    document.getElementById('editInfoBtn').style.display = 'none';
    document.getElementById('saveInfoBtn').style.display = 'inline';
}

function saveInfo() {
    const fields = ['Name', 'Email', 'Phone', 'Location', 'Password'];
    fields.forEach(field => {
        const span = document.getElementById(`settings${field}`);
        const input = document.getElementById(`edit${field}`);
        if (span && input) {
            span.textContent = input.value;
            localStorage.setItem(`user${field}`, input.value);
            span.style.display = 'inline';
            input.style.display = 'none';
        }
    });

    document.getElementById('editInfoBtn').style.display = 'inline';
    document.getElementById('saveInfoBtn').style.display = 'none';
}

function editPage(pageId) {
    window.location.href = './page9.php';
}

function deletePage(pageId) {
    const confirmDelete = confirm('Are you sure you want to delete this page?');
    if (confirmDelete) {
        alert('Page ' + pageId + ' deleted.');
    }
}

function togglePasswordVisibility() {
    const passwordInput = document.getElementById('editPassword');
    const toggleButton = document.querySelector('.toggle-password-btn i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.classList.remove('fa-eye');
        toggleButton.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleButton.classList.remove('fa-eye-slash');
        toggleButton.classList.add('fa-eye');
    }
}

function showNotification(message, type = "info") {
    let notification = document.createElement("div");
    notification.className = "notification " + type; // Add class for styling
    notification.innerText = message;

    document.body.appendChild(notification);
    setTimeout(() => {
        notification.style.opacity = "0";
        setTimeout(() => notification.remove(), 500);
    }, 3000);
}

// جلب العناصر من DOM
const loginButton = document.getElementById("login-button");
const popupOverlay = document.getElementById("popup-overlay");
const closePopupButton = document.getElementById("close-popup");

// عرض النافذة عند النقر على زر Login
if (loginButton) {
    loginButton.addEventListener("click", () => {
        popupOverlay.style.display = "flex";
    });
}

// إغلاق النافذة عند النقر على زر الإغلاق
if (closePopupButton) {
    closePopupButton.addEventListener("click", () => {
        popupOverlay.style.display = "none";
    });
}

// تسجيل الدخول عبر جوجل
function handleCredentialResponse(response) {
    console.log("Encoded JWT ID token: " + response.credential);
    // تحقق من بيانات JWT مع السيرفر الخاص بك.
}

window.onload = function () {
    google.accounts.id.initialize({
        client_id: "YOUR_GOOGLE_CLIENT_ID",
        callback: handleCredentialResponse
    });
    google.accounts.id.renderButton(
        document.getElementById("google-login"), // العنصر المستخدم للزر
        { theme: "outline", size: "large" } // خيارات التخصيص
    );
    google.accounts.id.prompt(); // طلب تسجيل الدخول الفوري
};

// عناصر نافذة نسيان كلمة المرور
const forgotPasswordLink = document.getElementById('forgot-password');
const forgetPasswordOverlay = document.getElementById('forget-password-overlay');
const closeForgetPopup = document.getElementById('close-forget-popup');
const backToLogin = document.getElementById('back-to-login');

if (forgotPasswordLink && forgetPasswordOverlay && closeForgetPopup && backToLogin) {
    // إظهار نافذة نسيان كلمة المرور
    forgotPasswordLink.addEventListener('click', (e) => {
        e.preventDefault();
        forgetPasswordOverlay.style.display = 'flex';
    });

    // إخفاء نافذة نسيان كلمة المرور عند النقر على زر الإغلاق
    closeForgetPopup.addEventListener('click', () => {
        forgetPasswordOverlay.style.display = 'none';
    });

    // إخفاء النافذة عند النقر على "العودة لتسجيل الدخول"
    backToLogin.addEventListener('click', (e) => {
        e.preventDefault();
        forgetPasswordOverlay.style.display = 'none';
    });
}

// عناصر نافذة إنشاء حساب
const createAccountLink = document.getElementById('create-account');
const createAccountOverlay = document.getElementById('create-account-overlay');
const closeCreatePopup = document.getElementById('close-create-popup');
const backToLoginFromCreate = document.getElementById('back-to-login-from-create');

if (createAccountLink && createAccountOverlay && closeCreatePopup && backToLoginFromCreate) {
    // إظهار نافذة إنشاء حساب
    createAccountLink.addEventListener('click', (e) => {
        e.preventDefault();
        createAccountOverlay.style.display = 'flex';
    });

    // إخفاء نافذة إنشاء حساب عند النقر على زر الإغلاق
    closeCreatePopup.addEventListener('click', () => {
        createAccountOverlay.style.display = 'none';
    });

    // إخفاء النافذة عند النقر على "العودة لتسجيل الدخول"
    backToLoginFromCreate.addEventListener('click', (e) => {
        e.preventDefault();
        createAccountOverlay.style.display = 'none';
    });
}





// دالة لإظهار الـ overlay
function showChangePasswordOverlay() {
    document.getElementById('changePasswordOverlay').style.display = 'flex';
}

// دالة لإخفاء الـ overlay
function hideChangePasswordOverlay() {
    document.getElementById('changePasswordOverlay').style.display = 'none';
}

// دالة لحفظ كلمة المرور الجديدة
function saveNewPassword(event) {
    event.preventDefault(); // منع إعادة تحميل الصفحة

    const oldPassword = document.getElementById('oldPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmNewPassword = document.getElementById('confirmNewPassword').value;

    // التحقق من تطابق كلمة المرور الجديدة
    if (newPassword !== confirmNewPassword) {
        alert("New passwords do not match!");
        return;
    }

    // هنا يمكنك إضافة التحقق من كلمة المرور القديمة مع الخادم
    // إذا كانت صحيحة، قم بحفظ كلمة المرور الجديدة
    localStorage.setItem('userPassword', newPassword);
    alert("Password changed successfully!");

    // إخفاء الـ overlay بعد الحفظ
    hideChangePasswordOverlay();
}

