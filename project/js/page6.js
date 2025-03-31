document.addEventListener("DOMContentLoaded", function () {
    console.log("Admin Dashboard Loaded!");

    setupUserManagement();
    setupProjectManagement();
    setupSearch();
    setupNotifications();
    setupSystemSettings();
    setupCollapsibleSections();
});

function setupUserManagement() {
    document.querySelectorAll(".user-item .btn-action").forEach(button => {
        button.addEventListener("click", function () {
            let action = this.innerText.toLowerCase();
            let userItem = this.closest(".user-item");

            if (action === "edit") {
                let nameEl = userItem.querySelector("p:nth-child(1)");
                let emailEl = userItem.querySelector("p:nth-child(2)");
                let newName = prompt("Edit User Name:", nameEl.innerText.replace("Name: ", ""));
                let newEmail = prompt("Edit User Email:", emailEl.innerText.replace("Email: ", ""));
                
                if (newName?.trim()) nameEl.innerText = `Name: ${newName}`;
                if (newEmail?.trim()) emailEl.innerText = `Email: ${newEmail}`;
            } else if (action === "delete" && confirm("Are you sure you want to delete this user?")) {
                userItem.remove();
            }
        });
    });
}

function setupProjectManagement() {
    document.querySelectorAll(".project-item .btn-action").forEach(button => {
        button.addEventListener("click", function () {
            let action = this.innerText.toLowerCase();
            let projectItem = this.closest(".project-item");
            
            if (action === "view details") {
                alert("Project Details:\n" + projectItem.innerText);
            } else if (action === "update status") {
                let newStatus = prompt("Enter new project status:");
                if (newStatus?.trim()) {
                    projectItem.querySelector("p:nth-child(2)").innerText = `Status: ${newStatus}`;
                }
            }
        });
    });
}

function setupSearch() {
    document.getElementById("search-bar").addEventListener("input", function () {
        let query = this.value.toLowerCase();
        document.querySelectorAll(".admin-section").forEach(section => {
            let matchFound = false;
            section.querySelectorAll(".user-item, .project-item, .request-item").forEach(item => {
                let text = item.innerText.toLowerCase();
                let match = text.includes(query);
                item.style.display = match ? "block" : "none";
                if (match) matchFound = true;
            });
            section.style.display = matchFound ? "block" : "none";
        });
    });
}

function setupNotifications() {
    document.getElementById("notification-form").addEventListener("submit", function (event) {
        event.preventDefault();
        let message = document.getElementById("notification-message").value.trim();
        let type = document.getElementById("notification-type").value;
        if (message) {
            addNotification(message, type);
            saveNotification(message, type);
        }
        this.reset();
    });

    document.getElementById("recipient-type").addEventListener("change", function () {
        let specificUserDiv = document.getElementById("specific-user");
        specificUserDiv.style.display = this.value === "specific" ? "block" : "none";
    });

    loadNotifications();
}

function addNotification(message, type) {
    const notificationList = document.querySelector(".notification-list");
    const newNotification = document.createElement("p");
    newNotification.classList.add("notification-item");
    newNotification.innerHTML = `<i class='fas ${type === "warning" ? "fa-exclamation-circle" : type === "success" ? "fa-check-circle" : "fa-info-circle"}'></i> ${message}`;
    newNotification.style.borderLeftColor = type === "warning" ? "#e74c3c" : type === "success" ? "#2ecc71" : "#3498db";
    
    newNotification.addEventListener("click", () => {
        newNotification.remove();
        removeNotification(message);
    });

    notificationList.appendChild(newNotification);
}

function saveNotification(message, type) {
    let notifications = JSON.parse(localStorage.getItem("notifications")) || [];
    notifications.push({ message, type });
    localStorage.setItem("notifications", JSON.stringify(notifications));
}

function loadNotifications() {
    let notifications = JSON.parse(localStorage.getItem("notifications")) || [];
    notifications.forEach(({ message, type }) => addNotification(message, type));
}

function removeNotification(message) {
    let notifications = JSON.parse(localStorage.getItem("notifications")) || [];
    notifications = notifications.filter(notif => notif.message !== message);
    localStorage.setItem("notifications", JSON.stringify(notifications));
}

function setupSystemSettings() {
    document.getElementById("changePassword").addEventListener("click", function () {
        let newPassword = prompt("Enter your new password:");
        if (newPassword?.trim()) alert("✅ Password changed successfully!");
    });

    document.getElementById("managePermissions").addEventListener("click", function () {
        window.location.href = "/admin/permissions";
    });

    document.getElementById("systemUpdates").addEventListener("click", function () {
        if (confirm("Check for updates?")) {
            alert("🔄 Checking for updates...");
            setTimeout(() => alert("✅ Your system is up to date!"), 2000);
        }
    });
}

function setupCollapsibleSections() {
    document.querySelectorAll(".collapsible h2").forEach(header => {
        header.addEventListener("click", function () {
            let sectionContent = this.nextElementSibling;
            let icon = this.querySelector(".toggle-icon");

            if (sectionContent.style.display === "block") {
                sectionContent.style.display = "none";
                icon.classList.remove("fa-chevron-up");
                icon.classList.add("fa-chevron-down");
            } else {
                sectionContent.style.display = "block";
                icon.classList.remove("fa-chevron-down");
                icon.classList.add("fa-chevron-up");
            }
        });
    });
}