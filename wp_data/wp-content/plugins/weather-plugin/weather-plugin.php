<?php
/*
Plugin Name: Weather Plugin
Description: Displays current weather information.
Version: 1.0
Author: Szaniszló Ivor
*/

// weather-plugin.php

// Add the widget file
require_once plugin_dir_path(__FILE__) . 'includes/weather-plugin-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/weather-widget.php';

// Add a dashboard widget to display the memory limit
function weather_plugin_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'weather_plugin_memory_limit_widget', // Widget slug.
        'Memory Limit', // Title.
        'weather_plugin_memory_limit_widget_function' // Display function.
    );
}
add_action('wp_dashboard_setup', 'weather_plugin_add_dashboard_widgets');

function weather_plugin_memory_limit_widget_function() {
    echo 'Current memory limit: ' . ini_get('memory_limit');
}

function weather_plugin_enqueue_scripts() {
    wp_enqueue_style('weather-plugin-style', plugins_url('assets/css/style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'weather_plugin_enqueue_scripts');

function weather_plugin_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'city' => 'Budapest',
        ),
        $atts,
        'weather'
    );

    return get_weather_data($atts['city']);
}
add_shortcode('weather', 'weather_plugin_shortcode');

function weather_plugin_menu() {
    add_options_page(
        'Weather Plugin Settings',
        'Weather Plugin',
        'manage_options',
        'weather-plugin',
        'weather_plugin_settings_page'
    );
}
add_action('admin_menu', 'weather_plugin_menu');

function weather_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1>Weather Plugin Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('weather_plugin_settings');
            do_settings_sections('weather-plugin');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function weather_plugin_settings_init() {
    register_setting('weather_plugin_settings', 'weather_plugin_city');

    add_settings_section(
        'weather_plugin_section',
        'General Settings',
        'weather_plugin_section_callback',
        'weather-plugin'
    );

    add_settings_field(
        'weather_plugin_city',
        'City',
        'weather_plugin_city_callback',
        'weather-plugin',
        'weather_plugin_section'
    );
}
add_action('admin_init', 'weather_plugin_settings_init');

function weather_plugin_section_callback() {
    echo 'Enter the city for which you want to display the weather.';
}

function weather_plugin_city_callback() {
    $city = get_option('weather_plugin_city', 'Budapest');
    echo "<input type='text' name='weather_plugin_city' value='" . esc_attr($city) . "' />";
}
?>
