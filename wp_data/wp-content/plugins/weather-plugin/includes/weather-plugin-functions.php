<?php
// weather-plugin-functions.php

// Add any additional functions or logic here that support your Weather Plugin

// Example function to retrieve weather data for a specific city
function weather_plugin_get_weather($city) {
    $transient_key = 'weather_data_' . $city;
    $weather_data = get_transient($transient_key);

    if (false === $weather_data) {
        $api_key = OPENWEATHERMAP_API_KEY;
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$api_key}&units=metric";
        $args = array(
            'timeout' => 5,
        );

        $response = wp_remote_get($url, $args);
        if (is_wp_error($response)) {
            return 'Error retrieving weather data: ' . $response->get_error_message();
        }

        if (wp_remote_retrieve_response_code($response) !== 200) {
            return 'Error retrieving weather data: ' . wp_remote_retrieve_response_message($response);
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($data['main'])) {
            $weather_data = array(
                'temperature' => $data['main']['temp'],
                'humidity' => $data['main']['humidity'],
                'description' => $data['weather'][0]['description']
            );

            set_transient($transient_key, $weather_data, 30 * MINUTE_IN_SECONDS);
        } else {
            return 'Weather data not available.';
        }
    }

    return "<div class='weather'>
        <p>Temperature: {$weather_data['temperature']}°C</p>
        <p>Humidity: {$weather_data['humidity']}%</p>
        <p>Description: {$weather_data['description']}</p>
    </div>";
}
?>
