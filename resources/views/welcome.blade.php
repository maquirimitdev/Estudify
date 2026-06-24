<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudify - Student Management System</title>
    <link rel="stylesheet" href="{{ asset('assets/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/navigation.css') }}">

</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <div class="logo">📚 Estudify</div>
            <ul class="links">
                <li><a href="#features">Features</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-signup">Sign Up</a>
                <a href="{{ route('logout') }}" class="btn-signup">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Manage Your School, Empower Success</h1>
            <p>All-in-one student management platform for modern educational institutions</p>
            <div>
                <button class="btn-primary" onclick="window.location='{{ route('register') }}'">Get Started Free</button>
                <button class="btn-secondary">Watch Demo</button>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title">Powerful Features</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Grade Management</h3>
                    <p>Track student performance with detailed grade analytics and progress reports</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📋</div>
                    <h3>Attendance Tracking</h3>
                    <p>Automated attendance system with real-time notifications to parents</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📅</div>
                    <h3>Class Scheduling</h3>
                    <p>Create and manage timetables, class assignments, and events effortlessly</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3>Student Profiles</h3>
                    <p>Centralized student information with enrollment history and documents</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📧</div>
                    <h3>Communication Hub</h3>
                    <p>Seamless messaging between teachers, parents, and administrators</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3>Analytics & Reports</h3>
                    <p>Comprehensive reports and insights for data-driven decision making</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Setup Account</h3>
                    <p>Create your school account and configure basic settings</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Invite Users</h3>
                    <p>Add teachers, students, and parents to your system</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Manage Classes</h3>
                    <p>Create classes, assign teachers, and organize schedules</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Track Progress</h3>
                    <p>Monitor grades, attendance, and generate performance reports</p>
                </div>
            </div>
        </div>
    </section>

    <!-- User Roles -->
    <section class="user-roles">
        <div class="container">
            <h2 class="section-title">Built for Everyone</h2>
            <div class="roles-grid">
                <div class="role-card">
                    <h3>👨‍💼 Administrators</h3>
                    <ul>
                        <li>System configuration</li>
                        <li>User management</li>
                        <li>School analytics</li>
                        <li>Financial tracking</li>
                        <li>Security controls</li>
                    </ul>
                </div>
                <div class="role-card">
                    <h3>👨‍🏫 Teachers</h3>
                    <ul>
                        <li>Attendance marking</li>
                        <li>Grade entry</li>
                        <li>Class materials</li>
                        <li>Parent communication</li>
                        <li>Assessment tools</li>
                    </ul>
                </div>
                <div class="role-card">
                    <h3>👨‍🎓 Students</h3>
                    <ul>
                        <li>View grades</li>
                        <li>Class schedule</li>
                        <li>Assignment tracking</li>
                        <li>Announcements</li>
                        <li>Progress reports</li>
                    </ul>
                </div>
                <div class="role-card">
                    <h3>👨‍👩‍👧 Parents</h3>
                    <ul>
                        <li>Student progress</li>
                        <li>Attendance updates</li>
                        <li>Teacher messages</li>
                        <li>Announcements</li>
                        <li>Payment tracking</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <h2 class="section-title">What Schools Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"Estudify has transformed how we manage student data. The system is intuitive and has reduced administrative burden significantly."</p>
                    <p class="testimonial-author">Sarah Johnson</p>
                    <p class="testimonial-role">Principal, Central High School</p>
                </div>
                <div class="testimonial-card">
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"Our teachers love the interface. Recording grades and attendance is now a breeze. Communication with parents has never been easier."</p>
                    <p class="testimonial-author">Michael Chen</p>
                    <p class="testimonial-role">Head of IT, Lincoln Academy</p>
                </div>
                <div class="testimonial-card">
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"The analytics dashboard gives us real insights into student performance. We can now make data-driven decisions for improvements."</p>
                    <p class="testimonial-author">Emma Rodriguez</p>
                    <p class="testimonial-role">Academic Director, Excellence School</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Ready to Transform Your School?</h2>
            <p>Join hundreds of schools already using Estudify</p>
            <button class="btn-primary" onclick="window.location='{{ route('register') }}'">Start Free Trial Today</button>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Product</h4>
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Security</a></li>
                    <li><a href="#">Roadmap</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Resources</h4>
                <ul>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">API Docs</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Status</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Estudify. All rights reserved.</p>
            <div class="social-links">
                <a href="#">f</a>
                <a href="#">𝕏</a>
                <a href="#">in</a>
                <a href="#">▶</a>
            </div>
        </div>
    </footer>
</body>
</html>