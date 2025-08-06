# Admin Quick Search 🔍

[![WordPress](https://img.shields.io/badge/WordPress-%23117AC9.svg?style=for-the-badge&logo=WordPress&logoColor=white)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)](https://javascript.com)
[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

A powerful WordPress plugin that adds a universal quick search feature to your admin dashboard, enabling lightning-fast navigation and improved productivity.

## ✨ Features

- 🔎 **Universal Search** - Search posts, pages, users, and plugins from one unified interface
- ⌨️ **Keyboard Shortcuts** - Press `Ctrl+K` (Windows/Linux) or `Cmd+K` (Mac) to instantly open search
- ⚡ **Real-time Results** - See search results instantly as you type with AJAX
- 🎯 **Direct Navigation** - Jump directly to edit screens without clicking through menus
- 🔐 **Permission-Aware** - Shows only content the current user has permission to access
- 🎨 **Clean UI** - Modern, minimalist modal interface that doesn't clutter your dashboard
- 📱 **Responsive Design** - Works perfectly on desktop, tablet, and mobile admin views

## 📸 Screenshots

### Quick Search Modal
<img src="https://github.com/user-attachments/assets/b282a011-ccd8-4970-b37a-ebc712abf3a8" alt="Quick Search Modal" />

*The clean, modern search interface appears instantly with Ctrl+K*

### Search Results
<img src="https://github.com/user-attachments/assets/a3645d3a-9b0b-4597-b77c-89d6ab416171" alt="Search Results" />

*Results are organized by type with status indicators*

### Keyboard Navigation
<img src="https://github.com/user-attachments/assets/989715b1-e9b9-4ad3-8d20-b239819c3c73" alt="Keyboard Navigation" />

*Navigate results with arrow keys, select with Enter*

## 🚀 Installation

### Via WordPress Admin

1. Download the latest release from the [Releases page](https://github.com/ghouliaras/admin-quick-search/releases)
2. Go to **Plugins → Add New** in your WordPress admin
3. Click **Upload Plugin** and choose the downloaded zip file
4. Click **Install Now** and then **Activate**

### Via FTP

1. Download and extract the plugin zip file
2. Upload the `admin-quick-search` folder to `/wp-content/plugins/`
3. Activate the plugin through the **Plugins** menu in WordPress

### Via Composer

```bash
composer require ghouliaras/admin-quick-search
```

### Via Git

```bash
cd wp-content/plugins/
git clone https://github.com/ghouliaras/admin-quick-search.git
```

## 📖 Usage

### Opening Search

- **Keyboard**: Press `Ctrl+K` (Windows/Linux) or `Cmd+K` (Mac) anywhere in the admin area
- **Admin Bar**: Click the search icon in the top admin bar
- **Menu**: Access from the "Quick Search" menu in the admin sidebar

### Searching

1. Type at least 2 characters to begin searching
2. Results appear instantly, grouped by content type
3. Each result shows:
   - Title/Name
   - Content type badge
   - Status (published, draft, active, etc.)

### Navigation

- **Arrow Keys**: Navigate up/down through results
- **Enter**: Open the selected result
- **Click**: Click any result to open it
- **Escape**: Close the search modal

## 🛠️ Development

### Prerequisites

- WordPress 5.0+
- PHP 7.2+
- Node.js 14+ (for development)

### Setup Development Environment

1. Clone the repository:
```bash
git clone https://github.com/ghouliaras/admin-quick-search.git
cd admin-quick-search
```

2. Install dependencies (if any):
```bash
npm install
```

3. Link to your local WordPress installation:
```bash
ln -s /path/to/admin-quick-search /path/to/wordpress/wp-content/plugins/
```

### Project Structure

```
admin-quick-search/
├── assets/
│   ├── css/
│   │   └── admin-search.css    # Styles for the search modal
│   └── js/
│       └── admin-search.js      # JavaScript functionality
├── includes/
│   ├── class-search-handler.php # Core search logic
│   └── class-ajax-handler.php   # AJAX request handling
├── admin-quick-search.php       # Main plugin file
├── readme.txt                    # WordPress.org readme
├── LICENSE                       # GPL v2 license
└── README.md                     # This file
```

### Coding Standards

This plugin follows [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/):

```bash
# Install PHP_CodeSniffer
composer global require "squizlabs/php_codesniffer=*"

# Install WordPress standards
composer global require wp-coding-standards/wpcs

# Check code
phpcs --standard=WordPress admin-quick-search.php
```

## 🔧 Configuration

Currently, the plugin works out of the box with no configuration needed. Future versions will include:

- Settings page for customization
- Custom post type selection
- Search result limits
- Custom keyboard shortcuts
- Search history

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Contribution Guidelines

- Write clean, readable code following WordPress standards
- Add inline documentation for complex logic
- Update the readme with new features
- Test on latest WordPress version
- Ensure backward compatibility to WordPress 5.0

## 📝 Changelog

### Version 1.0.0 (2025-01-08)
- Initial release
- Core search functionality for posts, pages, users, and plugins
- Keyboard shortcuts (Ctrl/Cmd + K)
- Real-time AJAX search
- Keyboard navigation support
- Permission-based result filtering
- Admin bar integration
- Dedicated admin menu page

### Roadmap for v1.1.0
- [ ] Custom post type support
- [ ] Media library search
- [ ] Settings page for advanced configuration
- [ ] Search history
- [ ] Customizable keyboard shortcuts
- [ ] Export/Import settings

## 🐛 Bug Reports

Found a bug? Please [open an issue](https://github.com/ghouliaras/admin-quick-search/issues/new) with:

- WordPress version
- PHP version
- Steps to reproduce
- Expected behavior
- Actual behavior
- Screenshots if applicable

## 💡 Feature Requests

Have an idea? [Open an issue](https://github.com/ghouliaras/admin-quick-search/issues/new) with the `enhancement` label.

## 📜 License

This project is licensed under the GPL v2 or later - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Ghouliaras**
- GitHub: [@ghouliaras](https://github.com/ghouliaras)
- WordPress: [@ghouliaras](https://profiles.wordpress.org/ghouliaras/)

## 🙏 Acknowledgments

- WordPress Core Team for the amazing platform
- Contributors who help improve this plugin
- Users who provide valuable feedback

## 💖 Support

If you find this plugin helpful, consider:

- ⭐ Starring the repository
- 🐦 Sharing on Twitter
- 📝 Writing a review on [WordPress.org](https://wordpress.org/plugins/admin-quick-search/)

## 🔗 Links

- [Plugin Homepage](https://github.com/ghouliaras/admin-quick-search)
- [Report Issues](https://github.com/ghouliaras/admin-quick-search/issues)
- [WordPress Plugin Directory](https://wordpress.org/plugins/admin-quick-search/) *(pending approval)*
- [Documentation Wiki](https://github.com/ghouliaras/admin-quick-search/wiki)

---

<p align="center">
  Made with ❤️ for the WordPress community
</p>

<p align="center">
  <a href="#admin-quick-search-">Back to top ↑</a>
</p>