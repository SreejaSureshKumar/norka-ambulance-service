<?php

namespace App\Services;

class CaptchaService
{
    public function getCode($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $char_length = strlen($characters);
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $char_length - 1)];
        }
        return $code;
    }

    public function getSrc()
    {
        return 'data:image/png;base64,' . $this->generate();
    }

    public function generate()
    {
        $code = $this->getCode();
        session(['captcha' => $code]);

        $width = 220; // Increased width
        $height = 70; // Increased height
        $image = imagecreatetruecolor($width, $height);
        $background = imagecolorallocate($image, 255, 255, 255);
        $noise_color = imagecolorallocatealpha($image, rand(120, 200), rand(120,200), rand(120, 200), 65);

        imagefilledrectangle($image, 0, 0, $width, $height, $background);
        for ($i = 0; $i < 50; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $noise_color);
        }
        for ($i = 0; $i < 1000; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $noise_color);
        }

        $font_size = 28; // Increased font size
        $x = 18;
        $spacing = 10;
        $font = public_path('fonts/Roboto-Light.ttf');
        if (!file_exists($font)) {
            throw new \Exception("Captcha font file not found: $font");
        }
        $text_color = imagecolorallocate($image, 0, 0, 0);
        for ($i = 0; $i < strlen($code); $i++) {
            $y = rand(45, 60);
            $char = $code[$i];
            imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $char);
            $dimensions = imagettfbbox($font_size, 0, $font, $char);
            $x += (abs($dimensions[4] - $dimensions[0]) + $spacing);
        }

        ob_start();
        imagepng($image);
        $contents = ob_get_contents();
        ob_end_clean();

        imagedestroy($image);
        return base64_encode($contents);
    }

    public function validate($input)
    {
        $code = session('captcha');
        return $code === $input;
    }
}
