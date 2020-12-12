<?php

class ImageEditor{

    public function cropImage($originalFileName, $croppedFileName, $maxWidth, $maxHeight){
        if (file_exists($originalFileName)){
            $originalImage = imagecreatefromjpeg($originalFileName);
            $originalWidth = imagesx($originalImage);
            $originalHeight = imagesy($originalImage);

            if ($originalHeight > $originalWidth){
                //make width equal to max width
                $ratio = $maxWidth / $originalWidth;
                $newWidth = $maxWidth;
                $newHeight = $originalHeight * $ratio;
            } else {
                $ratio = $maxHeight / $originalHeight;
                $newHeight = $maxHeight;
                $newWidth = $originalWidth * $ratio;
            }
        }

        //adjust in case max width and height are different
        if ($maxWidth != $maxHeight){
            if ($maxHeight > $maxWidth){
                if ($maxHeight > $newHeight){
                    $adjustment = ($maxHeight / $newHeight);
                } else {
                    $adjustment = ($newHeight / $maxHeight);
                }
            } else {
                if ($maxWidth > $newWidth){
                    $adjustment = ($maxWidth / $newWidth);
                } else {
                    $adjustment = ($newWidth / $maxWidth);
                }
            }

            $newWidth = $newWidth * $adjustment;
            $newHeight = $newHeight * $adjustment;
        }

        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
        imagedestroy($originalImage);

        if ($maxWidth != $maxHeight){
            if ($maxWidth > $maxHeight){
                $diff = abs($newHeight - $maxHeight);
                $y = round($diff / 2);
                $x = 0;
            } else {
                $diff = abs($newWidth - $maxWidth);
                $x = round($diff / 2);
                $y = 0;
            }
        } else {
            if ($newHeight > $newWidth){
                $diff = $newHeight - $newWidth;
                $y = round($diff / 2);
                $x = 0;
            } else {
                $diff = $newWidth - $newHeight;
                $x = round($diff / 2);
                $y = 0;
            }
        }

        $newCroppedImage = imagecreatetruecolor($maxWidth, $maxHeight);
        imagecopyresampled($newCroppedImage, $newImage, 0, 0, $x, $y, $maxWidth, $maxHeight, $maxWidth, $maxHeight);
        imagedestroy($newImage);
        imagejpeg($newCroppedImage, $croppedFileName, 90);
        imagedestroy($newCroppedImage);
    }
}