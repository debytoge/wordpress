<?php
// Define the URL of the plugin ZIP file
$plugin_url = 'https://downloads.wordpress.org/plugin/mainwp-child.4.5.1.zip';

// Get the absolute path to the WordPress root directory
$wp_root_dir = dirname(__FILE__);

// Define the target directory for storing the plugin ZIP file
$target_directory = $wp_root_dir . '/wp-content/plugins/';

// Construct the path to the downloaded ZIP file
$downloaded_file = $target_directory . basename($plugin_url);

// Use cURL to download the plugin ZIP file
$ch = curl_init($plugin_url);
$fp = fopen($downloaded_file, 'w');

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

// Check if the download was successful
if (file_exists($downloaded_file)) {
    // Unzip the downloaded plugin to the target directory
    $zip = new ZipArchive;
    if ($zip->open($downloaded_file) === TRUE) {
        $zip->extractTo($target_directory);
        $zip->close();

        // Load the WordPress core
        require_once($wp_root_dir . '/wp-load.php');
        
        // Include the plugin.php file for plugin activation checks
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        // Define the plugin's directory and main plugin file
        $plugin_directory = 'mainwp-child';
        $plugin_file = 'mainwp-child.php';

        // Check if the plugin is active before attempting to activate it
        if (!function_exists('is_plugin_active') || !is_plugin_active($plugin_directory . '/' . $plugin_file)) {
            echo 'Error: Plugin activation failed.';
        } else {
            echo 'Plugin downloaded, installed, and activated successfully.';
        }
    } else {
        echo 'Error: Could not unzip the plugin file.';
    }

    // Delete the downloaded ZIP file (optional)
    unlink($downloaded_file);
} else {
    echo 'Error: Download failed.';
}
?>
