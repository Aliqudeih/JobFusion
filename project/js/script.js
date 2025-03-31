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

// تشغيل الروابط عند الضغط على الكروت
const cards = document.querySelectorAll('.card');

if (cards.length > 0) {
    cards.forEach(card => {
        card.addEventListener('click', () => {
            const cardId = card.getAttribute('data-id');
            window.location.href = `services.php?service=${cardId}`;
        });
    });
}
