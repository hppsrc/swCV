# 📄 swCV

**swCV** is a Curriculum Vitae manager and builder written entirely in PHP. swCV allows you to create a dynamically generated view with separate, dedicated sections for different personal aspects and projects, making it perfect for developers or as a personal portfolio.

Current version: **0.1.0-alpha**

> [!WARNING]
> THIS PROJECT IS IN AN EARLY DEVELOPMENT PHASE. UNDER NO CIRCUMSTANCES SHOULD IT BE USED IN A PRODUCTION ENVIRONMENT.

---

### What can you do? 🚀

- **Personal CV Landing Page:** Create a complete landing page with dedicated sections for personal info, skills, projects, social links, and more.
- **Database Management:** Manage your CV entries, profile details, and project portfolio.
- **Rich Media Support:** Add profile pictures, multimedia content, and visual elements.
- **Integrated Blog:** Keep a simple personal blog to share your thoughts, articles, and experiences.
- **FOSS Icons:** Use free and open-source icons from [Feather Icons](https://feathericons.com/) for a sleek UI.
- **Analytics & Tracking:** Monitor your CV's performance and growth over time from an intuitive dashboard!

## Getting Started 🎯

### Requirements 🗃️

- `PHP` (>= 8.0)
- `MySQL` (>= 5.7) or `MariaDB`
- A PHP web server (e.g. Apache, Nginx) or local environment (e.g. XAMPP).

### Download ⬇️

Download the full project ZIP [here](https://github.com/hppsrc/swCV/archive/refs/heads/main.zip) or get the latest [development build](https://github.com/hppsrc/swCV/archive/refs/heads/dev.zip).

### Installing ⚙️

To install swCV, follow these steps:

1. Place the project files into your web server root directory.
2. Configure your `.env` file with your database credentials.
3. Open `installer/installer.html` in your browser.

The installer view will prompt you for:

- Database credentials
- Admin credentials
- Initial configuration settings

The installer will generate a `.sql` file, which must be imported/executed on your MySQL server.

## Architecture & Features 🏗️

- **Front Controller & Routing:** All requests are routed through `index.php` to `router.php`, bootstrapping the application and cleanly rendering views.
- **Secure Database Abstraction:** Powered by a MySQLi wrapper supporting secure prepared statements (`client_sql()` and `client_select()`) to prevent SQL Injection vulnerabilities.
- **Lightweight `.env` Configuration:** Loads settings on-demand per request using a zero-dependency environment parser.
- **Localization Support:** Translates views dynamically using fast, cached PHP array translation keys (located in `lang/`).

### Environment Variables Configuration (.env)

Here is a standard example of the configuration structure inside `.env`:

```env
'host' = "localhost"
'user' = "root"
'pass' = "1234"
'name' = "swCV"
'sql_generic_error' = "false"
'sql_generic_error_msg' = "SQL execution error."
'version' = "001"
'lang' = "en"
```

## Using swCV 💻

Once installed, you can access swCV by navigating to the root directory of your web server in your browser:

Usually `http://localhost/` or `http://your-domain.com/`. If everything is set up correctly, you should see the swCV welcome page.

Use `http://localhost/?v=dashboard` to access the main dashboard.

### Help ❓

If you need help, please consult the wiki or the source code at [GitHub](https://github.com/hppsrc/swCV).

### License 🔑

This project is licensed under the MIT License.
