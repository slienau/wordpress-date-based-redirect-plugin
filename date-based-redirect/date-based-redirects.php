<?php
/*
Plugin Name: Date Based Redirect
Description: Redirects based on date settings configured in the admin interface.
Version: 1.1
Author: Your Name
*/

// Add settings menu
add_action('admin_menu', 'dbr_add_admin_menu');
add_action('admin_init', 'dbr_settings_init');

function dbr_add_admin_menu() {
    add_options_page('Date Based Redirect', 'Date Based Redirect', 'manage_options', 'date_based_redirect', 'dbr_options_page');
}

function dbr_settings_init() {
    register_setting('pluginPage', 'dbr_settings');

    add_settings_section(
        'dbr_pluginPage_section',
        __('Date Based Redirect Settings', 'wordpress'),
        'dbr_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'dbr_url_slug',
        __('URL Slug', 'wordpress'),
        'dbr_url_slug_render',
        'pluginPage',
        'dbr_pluginPage_section'
    );

    add_settings_field(
        'dbr_date_ranges',
        __('Date Ranges and Target URLs', 'wordpress'),
        'dbr_date_ranges_render',
        'pluginPage',
        'dbr_pluginPage_section'
    );

    add_settings_field(
        'dbr_default_url',
        __('Default Target URL', 'wordpress'),
        'dbr_default_url_render',
        'pluginPage',
        'dbr_pluginPage_section'
    );
}

function dbr_url_slug_render() {
    $options = get_option('dbr_settings');
    ?>
    <input type='text' name='dbr_settings[dbr_url_slug]' value='<?php echo $options['dbr_url_slug']; ?>'>
    <?php
}

function dbr_date_ranges_render() {
    $options = get_option('dbr_settings');
    $date_ranges = isset($options['dbr_date_ranges']) ? $options['dbr_date_ranges'] : array();
    ?>
    <div id="date-ranges-wrapper">
        <?php foreach ($date_ranges as $index => $date_range) { ?>
            <div class="date-range-item">
                <input type='date' name='dbr_settings[dbr_date_ranges][<?php echo $index; ?>][start_date]' value='<?php echo $date_range['start_date']; ?>'>
                <input type='date' name='dbr_settings[dbr_date_ranges][<?php echo $index; ?>][end_date]' value='<?php echo $date_range['end_date']; ?>'>
                <input type='text' name='dbr_settings[dbr_date_ranges][<?php echo $index; ?>][target_url]' value='<?php echo $date_range['target_url']; ?>'>
                <button type="button" class="remove-date-range">Remove</button>
            </div>
        <?php } ?>
    </div>
    <button type="button" id="add-date-range">Add Date Range</button>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addDateRangeButton = document.getElementById('add-date-range');
            var dateRangesWrapper = document.getElementById('date-ranges-wrapper');

            addDateRangeButton.addEventListener('click', function() {
                var newIndex = dateRangesWrapper.children.length;
                var newDateRangeItem = document.createElement('div');
                newDateRangeItem.className = 'date-range-item';
                newDateRangeItem.innerHTML = `
                    <input type='date' name='dbr_settings[dbr_date_ranges][${newIndex}][start_date]'>
                    <input type='date' name='dbr_settings[dbr_date_ranges][${newIndex}][end_date]'>
                    <input type='text' name='dbr_settings[dbr_date_ranges][${newIndex}][target_url]'>
                    <button type="button" class="remove-date-range">Remove</button>
                `;
                dateRangesWrapper.appendChild(newDateRangeItem);

                newDateRangeItem.querySelector('.remove-date-range').addEventListener('click', function() {
                    dateRangesWrapper.removeChild(newDateRangeItem);
                });
            });

            document.querySelectorAll('.remove-date-range').forEach(function(button) {
                button.addEventListener('click', function() {
                    button.parentElement.remove();
                });
            });
        });
    </script>
    <?php
}

function dbr_default_url_render() {
    $options = get_option('dbr_settings');
    ?>
    <input type='text' name='dbr_settings[dbr_default_url]' value='<?php echo $options['dbr_default_url']; ?>'>
    <?php
}

function dbr_settings_section_callback() {
    echo __('Configure the settings for the date-based redirect.', 'wordpress');
}

function dbr_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2>Date Based Redirect</h2>
        <?php
        settings_fields('pluginPage');
        do_settings_sections('pluginPage');
        submit_button();
        ?>
    </form>
    <?php
}

// Redirect based on settings
add_action('template_redirect', 'dbr_date_based_redirect');

function dbr_date_based_redirect() {
    $options = get_option('dbr_settings');
    $url_slug = $options['dbr_url_slug'];
    $date_ranges = isset($options['dbr_date_ranges']) ? $options['dbr_date_ranges'] : array();
    $default_url = $options['dbr_default_url'];
    $current_url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $today = new DateTime();

    if ($url_slug && $current_url === $url_slug) {
        foreach ($date_ranges as $date_range) {
            $start_date = new DateTime($date_range['start_date']);
            $end_date = new DateTime($date_range['end_date']);
            $end_date->setTime(23, 59, 59); // Set end date time to 23:59:59 to include the entire day
            $target_url = $date_range['target_url'];

            if ($today >= $start_date && $today <= $end_date) {
                wp_redirect($target_url);
                exit();
            }
        }

        if ($default_url) {
            wp_redirect($default_url);
            exit();
        }
    }
}
