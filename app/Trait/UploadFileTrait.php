<?php

namespace App\Trait;

trait UploadFileTrait
{
    private function uploadFile($path, $file, $old_file = null)
    {
        if (!$file) {
            return $old_file;
        }

        if ($old_file != null) {
            $this->removeFile($path, $old_file);
        }

        $image_name = time() . '-' . $file->getClientOriginalName();

        $file->move(public_path($path), $image_name);
        return $image_name;
    }

    private function removeFile($path, $file_name)
    {
        $file_path = public_path($path . $file_name);
        if (file_exists($file_path) && !str_starts_with($file_name, 'default')) {
            unlink($file_path);
        }
    }


}
