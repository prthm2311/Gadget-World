# 🛒 Gadget World

> A full-stack e-commerce platform for electronic gadgets — built with PHP, MySQL, and AdminLTE.

---

## 📌 Overview

Gadget World is a fully functional e-commerce web application designed for buying and selling electronic gadgets. It features a **responsive storefront** for customers and **dedicated dashboards** for Admins, Sellers, and Delivery personnel — all powered by a single PHP/MySQL backend.

---

## ✨ Features

### 🧑‍💻 Customer
- Browse and search products with manufacturer filters
- View detailed product pages with pricing and offers
- Add items to cart and proceed to checkout
- Simulated payment gateway
- Order history and account management
- Contact form for support

### 🔧 Admin
- Full product, category, and manufacturer management
- User role management (Sellers, Delivery Boys, Customers)
- Order overview and status control
- System-wide dashboard via AdminLTE

### 🏪 Seller
- Add and manage own product listings
- Track order status for listed products
- Seller-specific dashboard

### 🚚 Delivery Boy
- View assigned delivery orders
- Update delivery status
- Dedicated delivery dashboard

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (procedural) |
| Database | MySQL |
| Frontend | HTML5, CSS3, JavaScript, jQuery |
| UI Framework | AdminLTE 3 + Bootstrap 4 |
| Slider | Swiper.js |
| Local Server | XAMPP (Apache + MySQL) |

---

## 📁 Project Structure

```
Gadget-World/
│
├── index.php                  # Homepage with product carousel & suggestions
├── shop.php                   # Product listing with filters
├── product-details.php        # Individual product page
├── cart.php                   # Shopping cart
├── payment_gate.php           # Payment simulation
├── success.php                # Order success page
├── order-details.php          # Order tracking
├── print.php                  # Printable invoice
│
├── login.php                  # User login
├── registration.php           # New user registration
├── forgot-password.php        # Password recovery
├── log-out.php                # Session logout
├── my-account.php             # Customer profile
│
├── manufacture-filter.php     # Filter products by brand
├── about.php                  # About page
├── contact.php                # Contact form
├── submit_contact.php         # Contact form handler
│
├── student_electronic_gadget.sql  # Full database schema + seed data
│
├── common/                    # Shared classes, DB connection, config
├── theme-part/                # Header, footer, nav includes
└── assets/                    # Images, CSS, JS libraries
```

---

## ⚙️ Installation & Setup

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP + MySQL stack)
- PHP 7.4 or higher
- MySQL 5.7 / 8.0

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/prthm2311/Gadget-World.git
```

**2. Move to your web root**
```bash
# On Linux/macOS
mv Gadget-World /opt/lampp/htdocs/

# On Windows
# Move to C:\xampp\htdocs\Gadget-World
```

**3. Import the database**
- Open `http://localhost/phpmyadmin`
- Create a new database named `student_electronic_gadget`
- Click **Import** and select `student_electronic_gadget.sql`

**4. Configure the database connection**

Open `common/class.php` (or similar config file) and update:
```php
$host     = "localhost";
$username = "root";
$password = "";           // your MySQL password
$database = "student_electronic_gadget";
```

**5. Start Apache & MySQL in XAMPP, then visit:**
```
http://localhost/Gadget-World/
```

---

## 🔐 Default Login Credentials

> ⚠️ Change these immediately in any non-local environment.

| Role | Username / Email | Password |
|---|---|---|
| Admin | admin@gadgetworld.com | admin123 |
| Seller | seller@gadgetworld.com | seller123 |
| Delivery | delivery@gadgetworld.com | delivery123 |
| Customer | Register via `/registration.php` | — |

*(Actual credentials may differ — check the imported SQL data or `tbl_users` table.)*

---

## 🖼️ Screenshots

> Add screenshots here once the project is running locally.

| Storefront | Admin Dashboard | Cart |
|---|---|---|
| *(screenshot)* | *(screenshot)* | *(screenshot)* |

---

## 🔒 Security Notes

This project is intended for **academic/learning purposes**. Before deploying to any public environment:

- Replace plain-text or MD5 passwords with `password_hash()` / `password_verify()`
- Use **prepared statements** to prevent SQL injection
- Enable HTTPS and set secure session cookie flags
- Remove `ini_set('display_errors', 1)` from production code
- Validate and sanitize all user inputs server-side

---

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you'd like to change.

1. Fork the repo
2. Create your feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "Add your feature"`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 👤 Author

**Pratham** — [@prthm2311](https://github.com/prthm2311)

> Built as a college project for the BCA program — Indus University, Gujarat.
