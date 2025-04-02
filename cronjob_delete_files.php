<?php

/**
 * -------------------------------------------------------------------------------
 *	This is a cronjob file!
 *	This file is used to delete stored files automatically when a cron job is set.
 * -------------------------------------------------------------------------------
**/

$file_dir = "components/storage/app/livewire-tmp";
$delete_after = 0; // time in seconds after videos should be deleted

$files_deleted = false; // flag variable to check if any files have been deleted

if (file_exists($file_dir)) {
    $files = scandir($file_dir);
    foreach ($files as $idx => $file_name) {
        if ($file_name != '.' && $file_name != '..') {
            $create_time = filemtime($file_dir . "/" . $file_name);
            if ((time() - $create_time) > $delete_after)
            {
                unlink($file_dir . "/" . $file_name);
                $files_deleted = true;
            }
        }
    }
} 

if (!$files_deleted) {
    echo "No files were detected in this folder!";
} else echo 'All files have been deleted!';
