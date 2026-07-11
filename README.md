# 📄 swCV

**swCV** is a Curriculum Vitae manager and builder written entirely in PHP. swCV allows you to create a dynamically generated view with separate, dedicated sections for different personal aspects and projects, making it perfect for developers or as a personal portfolio.

Current version: 0.0.0

---

_What you can do?_

- Create a full landing page as your personal CV, with sections for personal information, skills, projects, socials and more.
- Manage a database of your CV entries and projects.
- Add images, multimedia content, and other visual elements to your CV.
- Keep a simple blog to share your thoughts and experiences.
- Using FOSS icons from [Feather Icons](https://feathericons.com/) to add visual elements to your CV.
- Analytics, tracking and data analysis. All packed into a single dashboard so you can monitor your CV's performance and growth over time!

## Getting Started 🎯

### Dependencies / Requirements 🗃️

#### Requirements

- `PHP` (>= 8.0)
- `MySQL` (>= 5.7) (MariaDB if preferred)
- A PHP web server (e.g. Apache, Nginx) or hosting provider.

### Download ⬇️

Download the [installer.html](installer.html) file and run it in your web browser. It will guide you through the installation and setup process.

### Installing ⚙️

To install swCV, follow the steps in the [installer.html](installer.html) file.

The installer will ask you for:

- DB credentials.
- Admin credentials.
- Initial configuration (Allow tracking, sections, etc)

The installer.html will create a `config.php` file, which you have to place in the root directory of your web server.

> [!WARNING]
>
> The `config.php` file contains sensitive information about your database and admin credentials. Make sure to keep it secure and not expose it to the public. Also **swCV** requires this file to be able to run any of the application's features.

## Using swCV 💻

Once installed, you can access swCV by navigating to the root directory of your web server in your browser.

Usually `http://localhost/` or `http://your-domain.com/`. If everything is set up correctly, you should see the swCV welcome page.

_**-- INSERT DASH IMG --**_

Use `http://localhost/swCV/dashboard.php` to access the dashboard.

### Help ❓

If you need help, please consult the wiki, or the source code at [GitHub](https://github.com/hppsrc/swCV). Every part of the source code is fully documented.

### License 🔑

This project is licensed under the MIT license.
