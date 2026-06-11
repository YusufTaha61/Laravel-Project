# ☕ Coffee Shop - E-Commerce Automation

**Author:** Yusuf Taha Çebi  
**Student ID:** 20222022788  
**Project Type:** E-Commerce Web Application  

---

### 🔑 Test Credentials (Admin Access)
To review the admin panel features (Order Management, Product Management, etc.), please use the following credentials:
- **Admin Email:** yusuf@test.com
- **Password:** 12345677

---

## 📌 About the Project
This project is a dynamic and scalable full-stack B2C e-commerce application developed using the Laravel framework. The system is designed with a secure Role-Based Access Control (RBAC) architecture to serve two main user types: Customers (User) and Administrators (Admin). 

## 🚀 Key Features (Current State)
- **Premium UI/UX Design:** A custom-designed, fully responsive interface featuring a warm, wood-textured, and semi-transparent (glassmorphism) aesthetic tailored for a boutique coffee shop experience.
- **User Authentication & Profile Management:** Secure registration, login, and account management processes utilizing Laravel Breeze, with database-driven `admin` and `user` role distinctions.
- **Dynamic Shopping Cart Operations:** Fully functional cart system allowing users to add products, update quantities, remove items, and view real-time subtotal/total calculations.
- **Secure Checkout & Order Creation:** End-to-end purchasing process where users can successfully place orders with delivery and payment preferences.
- **Advanced Admin Order Management:** A dedicated panel for admins to view incoming orders, update order statuses (New, Accepted, Onshipping, Completed, Cancelled), and review detailed digital invoices.
- **Dynamic Product & Category Management (CRUD):** Admins can effortlessly add, list, update, and delete products. The system supports image uploads, stock tracking, pricing, and category assignments.
- **Admin Security Firewall (Middleware):** A custom control mechanism that prevents unauthorized users from accessing the admin panel and sensitive data.
- **Relational Database Architecture:** Complex database relationships (Foreign Keys) linking products to categories, orders to users, and order items to specific products to ensure absolute data integrity.

## 🚧 Upcoming Features (Work in Progress)
- Payment Gateway Integration (e.g., Stripe, Iyzico)
- Customer Order History and Tracking Dashboard (UI enhancements)
- Advanced Admin Analytics and Sales Reporting
- Quality Assurance (QA) Tests and Advanced Form Validations

## 💻 Technologies Used
- **Backend:** PHP 8.x, Laravel 10.x
- **Frontend:** Blade Templating, HTML5, CSS3 (Modern Flexbox/Grid, Custom UI styling)
- **Database:** MySQL
- **Server Environment:** XAMPP (Apache)