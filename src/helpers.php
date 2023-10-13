<?php

use LazyCode404\laravelwebinstaller\models\Configuration;

function setupStatus()
{
    try {
        $checkComplete = LazyCode404\laravelwebinstaller\models\Configuration::where('config', 'setup_complete')->first();
        if (!$checkComplete) {
            return false;
        }
        if ($checkComplete['value'] === '0') {
            return false;
        }
        return true;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * This function is used to save the image in desired location
 */

function saveImage($image, $location)
{
    $imageName = bin2hex(random_bytes(5)) . time() . '.' . $image->extension();
    $image->move(public_path($location), $imageName);
    $url = url($location . '/' . $imageName);
    return $url;
}
