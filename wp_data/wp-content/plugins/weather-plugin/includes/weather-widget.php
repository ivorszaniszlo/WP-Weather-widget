<?php
class Weather_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'weather_widget',
            __('Weather Widget', 'weather_widget_domain'),
            array('description' => __('A widget to display weather information', 'weather_widget_domain'))
        );
    }

    public function widget($args, $instance) {
        $city = !empty($instance['city']) ? $instance['city'] : 'Budapest';

        echo $args['before_widget'];
        if (!empty($city)) {
            echo $args['before_title'] . apply_filters('widget_title', $city) . $args['after_title'];
        }

        echo weather_plugin_get_weather($city);

        echo $args['after_widget'];
    }

    public function form($instance) {
        if (isset($instance['city'])) {
            $city = $instance['city'];
        } else {
            $city = __('Budapest', 'weather_widget_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo esc_attr($city); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['city'] = (!empty($new_instance['city'])) ? strip_tags($new_instance['city']) : '';

        return $instance;
    }
}

function register_weather_widget() {
    register_widget('Weather_Widget');
}
add_action('widgets_init', 'register_weather_widget');
?>
