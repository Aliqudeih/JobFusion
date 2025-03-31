<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard | SerHub</title>
    <link rel="stylesheet" href="../css/page6.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="admin-dashboard-container">
        <!-- Header -->
        <header class="admin-dashboard-header">
            <img src="../imge/logo.jpg" alt="Logo" class="admin-logo">
            <h1>Admin Dashboard</h1>
            <div class="search-container">
                <input type="text" id="search-bar" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </header>

        <!-- Sidebar Menu -->
        <aside class="admin-sidebar">
            <ul>
                <li><a href="#manage-users"><i class="fas fa-users"></i> Manage Users</a></li>
                <li><a href="#manage-projects"><i class="fas fa-tasks"></i> Manage Projects</a></li>
                <li><a href="#payment-methods"><i class="fas fa-credit-card"></i> Payment Methods</a></li>
                <li><a href="#project-requests"><i class="fas fa-file-alt"></i> Project Requests</a></li>
                <li><a href="#notifications"><i class="fas fa-bell"></i> Notifications</a></li>
                <li><a href="#analytics"><i class="fas fa-chart-line"></i> Analytics</a></li>
                <li><a href="#support"><i class="fas fa-life-ring"></i> Support</a></li>
                <li><a href="#settings"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main-content">
            <!-- Manage Users Section -->
            <section id="manage-users" class="admin-section collapsible">
                <h2 onclick="toggleSection(this)">
                    Manage Users
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h2>
                <div class="section-content">
                    <div class="user-list">
                        <div class="user-item">
                            <p>Name: Ali</p>
                            <p>Email: ali@example.com</p>
                            <button class="btn-action">Edit</button>
                            <button class="btn-action">Delete</button>
                        </div>
                        <div class="user-item">
                            <p>Name: Sarah</p>
                            <p>Email: sarah@example.com</p>
                            <button class="btn-action">Edit</button>
                            <button class="btn-action">Delete</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Manage Projects Section -->
            <section id="manage-projects" class="admin-section collapsible">
                <h2 onclick="toggleSection(this)">
                    Manage Projects
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h2>
                <div class="section-content">
                    <div class="project-list">
                        <div class="project-item">
                            <p>Project: E-Commerce Website</p>
                            <p>Status: 75% Complete</p>
                            <button class="btn-action">View Details</button>
                            <button class="btn-action">Update Status</button>
                        </div>
                        <div class="project-item">
                            <p>Project: Food Delivery App</p>
                            <p>Status: Awaiting Feedback</p>
                            <button class="btn-action">View Details</button>
                            <button class="btn-action">Update Status</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Payment Methods Section -->
            <section id="payment-methods" class="admin-section collapsible">
                <h2 onclick="toggleSection(this)">
                    Payment Methods
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h2>
                <div class="section-content">
                    <div class="payment-method-list">
                        <p>Method: Credit Card</p>
                        <p>Status: Active</p>
                        <button class="btn-action">Deactivate</button>
                        <p>Method: PayPal</p>
                        <p>Status: Active</p>
                        <button class="btn-action">Deactivate</button>
                    </div>
                </div>
            </section>

            <!-- Project Requests Section -->
            <section id="project-requests" class="admin-section collapsible">
                <h2 onclick="toggleSection(this)">
                    New Project Requests
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h2>
                <div class="section-content">
                    <div class="project-request-list">
                        <div class="request-item">
                            <p>Project: Web Design for NGO</p>
                            <p>Client: Ali</p>
                            <button class="btn-action">Approve</button>
                            <button class="btn-action">Reject</button>
                        </div>
                        <div class="request-item">
                            <p>Project: Mobile App for Events</p>
                            <p>Client: Sarah</p>
                            <button class="btn-action">Approve</button>
                            <button class="btn-action">Reject</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Notification Form -->
            <div class="admin-section">
                <h2>Send Notification</h2>
                <form id="notification-form">
                    <label for="recipient-type">Send To:</label>
                    <select id="recipient-type" onchange="toggleRecipient()">
                        <option value="all">All Users</option>
                        <option value="project-owners">Project Owners</option>
                        <option value="specific">Specific User</option>
                    </select>

                    <div id="specific-user" style="display: none;">
                        <label for="user-email">User Email:</label>
                        <input type="email" id="user-email" placeholder="Enter user email">
                    </div>

                    <label for="notification-message">Message:</label>
                    <textarea id="notification-message" rows="4" required></textarea>

                    <label for="notification-type">Type:</label>
                    <select id="notification-type">
                        <option value="info">Info</option>
                        <option value="success">Success</option>
                        <option value="warning">Warning</option>
                    </select>

                    <button type="submit" class="btn-action">Send</button>
                </form>
            </div>

            <!-- Notifications Section -->
            <section id="notifications" class="admin-section collapsible">
                <h2 onclick="toggleSection(this)">
                    Notifications
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h2>
                <div class="section-content">
                    <div class="notification-list">
                        <p><i class="fas fa-exclamation-circle"></i> New project request from Sarah.</p>
                        <p><i class="fas fa-check-circle"></i> Payment received from Ali.</p>
                        <p><i class="fas fa-info-circle"></i> System maintenance scheduled for midnight.</p>
                    </div>
                </div>
            </section>

            <!-- Analytics Section -->
            <section id="analytics" class="admin-section collapsible">
                <h2 onclick="toggleSection(this)">
                    Website Analytics
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h2>
                <div class="section-content">
                    <div class="analytics-overview">
                        <p>Number of Active Users: 200</p>
                        <p>Number of Projects in Progress: 5</p>
                        <p>Total Revenue: $5000</p>
                    </div>
                </div>
            </section>

            <!-- Support Section -->
            <section id="support" class="admin-section collapsible">
                <h2 onclick="toggleSection(this)">
                    Support Requests
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h2>
                <div class="section-content">
                    <div class="support-requests">
                        <div class="request-item">
                            <p>User: Ali</p>
                            <p>Issue: Payment not processed</p>
                            <button class="btn-action">Resolve</button>
                        </div>
                        <div class="request-item">
                            <p>User: Sarah</p>
                            <p>Issue: Account locked</p>
                            <button class="btn-action">Resolve</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Settings Section -->
            <section id="settings" class="settings-panel collapsible">
                <h2 class="settings-heading" onclick="toggleSection(this)">
                    ⚙️ Settings
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h2>
                <div class="section-content">
                    <div class="settings-list">
                        <div class="settings-item" id="changePassword">
                            <i class="settings-icon fas fa-key"></i>
                            <div class="settings-text">
                                <h3 class="settings-title">Change Password</h3>
                                <p class="settings-description">Update your account password for security.</p>
                            </div>
                        </div>
                        <div class="settings-item" id="managePermissions">
                            <i class="settings-icon fas fa-user-shield"></i>
                            <div class="settings-text">
                                <h3 class="settings-title">Manage Permissions</h3>
                                <p class="settings-description">Control access levels for different users.</p>
                            </div>
                        </div>
                        <div class="settings-item" id="systemUpdates">
                            <i class="settings-icon fas fa-sync-alt"></i>
                            <div class="settings-text">
                                <h3 class="settings-title">System Updates</h3>
                                <p class="settings-description">Check and apply the latest system updates.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <div class="footer">
            <a href="/html/home.html">
                <img class="footer-logo" src="/imge/logo.jpg" alt="" />
            </a>
            2024 - <span>Group of Programmers</span> - All Right Reserved by
        </div>
    </div>

    <script src="../js/page6.js"></script>
</body>

</html>