# Shees Custom Plugin

A custom WordPress plugin built with PSR-4 autoloading.  
It adds a REST API endpoint, a WP-CLI command, and an admin page for easier management.

## Features
- PSR-4 autoloaded structure for clean code organization
- Custom REST API endpoint to fetch data
- WP-CLI command for quick access from the terminal
- Simple admin page inside WordPress dashboard

## Installation
1. Download the plugin zip file.
2. In your WordPress dashboard, go to **Plugins → Add New → Upload Plugin**.
3. Select the zip file and click **Install Now**.
4. After installation, click **Activate Plugin**.

## Usage
- **REST API**: Available under `wp-json/sheescustom/v1/data`.  
- **CLI Command**: Run with `wp shees-custom-plugin refresh-data` from the terminal.  
- **Admin Page**: Find it in the WordPress dashboard under **Settings → Custom Plugin**.

## Requirements
- WordPress 5.0 or higher
- PHP 7.4 or higher
- WP-CLI (for CLI usage)

## License
This plugin is open source and free to use.
