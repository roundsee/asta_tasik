<?php
// loading_functions.php - Helper functions for loading screen

/**
 * Update loading status with a message
 * @param string $message The status message to display
 */
function updateLoadingStatus($message)
{
    echo '<script>updateLoadingStatus("' . htmlspecialchars($message, ENT_QUOTES) . '");</script>';
    flush();
}

/**
 * Initialize loading screen (call this at the very beginning)
 */
function initLoadingScreen()
{
    ob_start(); // Start output buffering
}

/**
 * Show loading screen (call after HTML head is ready)
 */
function showLoadingScreen()
{
    include 'loading_screen.php';
    ob_end_flush(); // Flush the loading screen to browser
    flush();
}

/**
 * Simulate processing delay (optional - for testing)
 * @param int $seconds Seconds to delay
 */
function simulateProcessing($seconds = 1)
{
    sleep($seconds);
}
