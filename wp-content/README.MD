
# 🎓 EduMate LMS – WordPress Learning Management System Plugin & Theme

EduMate LMS is a beginner-friendly WordPress-based Learning Management System. It includes a custom plugin and a lightweight theme for managing courses, lessons, and educational content with simplicity and flexibility.

---

## 📁 Project Structure

```

wp-content/
├── plugins/
│   └── edumate-lms/
│       ├── edumate-lms.php           # Main plugin logic
│       ├── edumate-style.css         # Plugin-specific styles
│       ├── includes/                 # Backend PHP helpers/hooks
│       └── shortcodes/               # LMS shortcodes (e.g., course list)
│
├── themes/
│   └── edumate-theme/
│       ├── style.css                 # Theme style + WordPress header info
│       ├── header.php                # Site header layout
│       ├── footer.php                # Site footer layout
│       ├── front-page.php            # Homepage template
│       ├── archive-course.php        # Course list view
│       ├── single-course.php         # Individual course page
│       └── functions.php             # Theme functions (enqueue, etc.)
│
└── uploads/                          # Media uploads directory

````

---

## 🚀 Key Features

- 🧩 Custom Post Type for Courses
- 🧠 Shortcodes for displaying course content
- 🎨 Lightweight and customizable LMS theme
- 📚 Front-page and archive templates
- 🧑‍🎓 Single course display
- 🛠️ Easy setup, perfect for beginners

---

## 🔧 Installation Guide

### 1. Clone or Download the Repository

```bash
git clone https://github.com/your-username/edumate-lms.git
````

### 2. Install the Plugin

* Copy `edumate-lms/` folder into your WordPress `/wp-content/plugins/` directory.
* Go to **WordPress Admin > Plugins** and **Activate** the plugin.

### 3. Install the Theme

* Copy `edumate-theme/` folder into `/wp-content/themes/`.
* Go to **Appearance > Themes** and **Activate "EduMate Theme"**.

---

## 📦 Shortcodes

Use this shortcode in any page/post to display all available courses:

```text
[edumate_course_list]
```

---

## 💡 Tips for Development

* Enable **WP\_DEBUG** in `wp-config.php` for debugging.
* Use `functions.php` in the theme to enqueue additional styles/scripts.
* Customize styles in `edumate-style.css` for plugin visuals.

---


## 📧 Email Notification Setup (Optional)

Using WP Mail SMTP plugin? Make sure:

* SMTP settings are configured properly.
* Run a test from **Tools > WP Mail SMTP**.

---

## 👨‍💻 Contribution

Feel free to fork this repository, make changes, and submit pull requests!
Beginners welcome 🎉

---

## 📄 License

Licensed under the [MIT License](LICENSE).

---

## 🔗 Resources

* [WordPress Plugin Developer Handbook](https://developer.wordpress.org/plugins/)
* [WordPress Theme Developer Handbook](https://developer.wordpress.org/themes/)
* [WP Shortcode Reference](https://developer.wordpress.org/plugins/shortcodes/)

```



