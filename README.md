# Weather Plugin

## Description
The Weather Plugin is a WordPress plugin that displays current weather information for a specified city using the OpenWeatherMap API.

## Features
- Display current temperature, humidity, and weather description.
- Add the weather widget to your WordPress site.
- Shortcode support to display weather information on any post or page.

## Installation
1. Upload the `weather-plugin` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to 'Appearance' -> 'Widgets' and add the 'Weather Widget' to your desired widget area.
4. Alternatively, you can use the shortcode `[weather city="City Name"]` to display weather information in any post or page.

## Prerequisites
- Docker and Docker Compose installed on your machine.

### Steps

1. **Clone the Repository**
   ```sh
   git clone <repository-url>
   cd <repository-directory>
   ```
   
2. **Setup Docker Compose**
   Create a docker-compose.yml file in the root of your project with the file content.

3.  **Start Docker Containers**
    ```sh
    docker-compose up -d
    ```
    
4.  **Access WordPress**
    Open your browser and navigate to http://localhost:8001 to complete the WordPress installation.
    
5.  **Access phpMyAdmin**
    Open your browser and navigate to http://localhost:8081 to manage your MySQL database.

6.   **Install the Weather Plugin**
     Copy the weather-plugin directory to wp_data/wp-content/plugins/.
     Activate the plugin from the WordPress admin panel.

7.    **Configure the Plugin**
      Go to Settings -> Weather Plugin Settings to configure your default city.

## Usage
### Using the Widget
1. Navigate to 'Appearance' -> 'Widgets'.
2. Find the 'Weather Widget' and drag it to your desired widget area.
3. Enter the city name for which you want to display the weather information.
4. Save the widget settings.

### Using the Shortcode
Use the shortcode `[weather city="City Name"]` in any post or page. Replace `"City Name"` with the name of the city for which you want to display the weather information.

Example:
\`\`\`html
[weather city="Budapest"]
\`\`\`

## Requirements
- PHP 7.4 or higher
- WordPress 5.0 or higher

## Changelog

### 1.0.0
- Initial release

## Frequently Asked Questions

### How do I get an API key for the OpenWeatherMap API?
You can get an API key by signing up at [OpenWeatherMap](https://openweathermap.org/appid).

### The widget is not displaying any information. What should I do?
Make sure you have entered a valid city name and that your server can make HTTP requests to the OpenWeatherMap API.

### How do I change the appearance of the weather information?
You can customize the appearance by editing the `style.css` file located in the `assets/css` directory of the plugin.

## License
This plugin is licensed under the GPLv2 or later.

## Author
Szaniszló Ivor
