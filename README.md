<h1 align="center">Admin Quick Search</h1>

<p align="center">
  A <kbd>Ctrl</kbd> + <kbd>K</kbd> command palette for the WordPress admin — find posts, pages, users and plugins instantly.
</p>

<p align="center">
  <a href="https://github.com/ghouliaras/admin-quick-search/releases"><img src="https://img.shields.io/badge/version-1.0.0-2563EB?style=flat-square" alt="Version 1.0.0" /></a>
  <img src="https://img.shields.io/badge/WordPress-5.0%2B-1E293B?style=flat-square&logo=wordpress&logoColor=white" alt="WordPress 5.0+" />
  <img src="https://img.shields.io/badge/PHP-7.2%2B-1E293B?style=flat-square&logo=php&logoColor=white" alt="PHP 7.2+" />
  <img src="https://img.shields.io/badge/license-GPL--2.0--or--later-1E293B?style=flat-square" alt="License GPL-2.0-or-later" />
</p>

<p align="center">
  <img src="https://github.com/user-attachments/assets/b282a011-ccd8-4970-b37a-ebc712abf3a8" alt="Admin Quick Search modal" width="85%" />
</p>

---

## Why

Large WordPress sites mean endless clicking through menus and list tables. **Admin Quick Search** gives you one search box, available everywhere in the dashboard, that takes you straight to what you need.

## Features

- **Universal search** — posts, pages, users and plugins from one interface
- **Keyboard first** — open with <kbd>Ctrl</kbd> + <kbd>K</kbd> (<kbd>⌘</kbd> + <kbd>K</kbd> on Mac), move with the arrow keys, open with <kbd>Enter</kbd>, close with <kbd>Esc</kbd>
- **Real-time results** as you type (AJAX), grouped by type with status labels
- **Direct navigation** to edit screens
- **Permission-aware** — users only see what they're allowed to access
- **Clean, responsive modal** that stays out of the way

## Screenshots

<table>
  <tr>
    <td width="50%" valign="top">
      <img src="https://github.com/user-attachments/assets/a3645d3a-9b0b-4597-b77c-89d6ab416171" alt="Search results grouped by type" /><br/>
      <sub>Results grouped by type, with status indicators</sub>
    </td>
    <td width="50%" valign="top">
      <img src="https://github.com/user-attachments/assets/989715b1-e9b9-4ad3-8d20-b239819c3c73" alt="Keyboard navigation" /><br/>
      <sub>Navigate with the arrow keys, open with Enter</sub>
    </td>
  </tr>
</table>

## Requirements

| | |
| --- | --- |
| WordPress | 5.0 or higher |
| PHP | 7.2 or higher |

## Installation

**From the latest release**
1. Download the ZIP from the [Releases page](https://github.com/ghouliaras/admin-quick-search/releases).
2. In WordPress go to **Plugins → Add New → Upload Plugin**, choose the ZIP and click **Install Now**.
3. Activate **Admin Quick Search**.

**With Git**
```bash
cd wp-content/plugins
git clone https://github.com/ghouliaras/admin-quick-search.git
```
Then activate it from **Plugins**.

## Usage

Open the search in any of three ways:

- Press <kbd>Ctrl</kbd> + <kbd>K</kbd> / <kbd>⌘</kbd> + <kbd>K</kbd> anywhere in the admin
- Click the search icon in the admin bar
- Open **Quick Search** from the admin menu

Type at least two characters — results appear instantly, each with its title, type and status. Use the arrow keys and <kbd>Enter</kbd>, or just click a result.

## Roadmap

- Custom post type and Media Library search
- Settings page (result limits, searchable types)
- Customisable keyboard shortcut
- Search history

## Project structure

```
admin-quick-search/
├── admin-quick-search.php          # Bootstrap, admin menu & admin bar
├── includes/
│   ├── class-search-handler.php    # Search logic
│   └── class-ajax-handler.php      # AJAX endpoint
├── assets/
│   ├── css/admin-search.css        # Modal styles
│   └── js/admin-search.js          # Modal & keyboard handling
└── readme.txt                      # WordPress.org readme
```

## Contributing

Issues and pull requests are welcome. Please follow the [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/) and include your WordPress and PHP versions when reporting a bug.

## Changelog

**1.0.0** — Initial release: search for posts, pages, users and plugins, <kbd>Ctrl</kbd>/<kbd>⌘</kbd> + <kbd>K</kbd> shortcut, real-time AJAX results, keyboard navigation, permission-aware results, admin bar and admin menu entry points.

## License

GPL-2.0-or-later — see [LICENSE](LICENSE).

---

<p align="center">
  Built by <a href="https://github.com/ghouliaras"><b>George Chouliaras</b></a> · WordPress, WooCommerce &amp; Laravel developer ·
  <a href="https://www.flowcreations.gr/en/contact/">Available for projects</a>
</p>
