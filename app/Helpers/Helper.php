<?php
namespace App\Helpers;

use App\Models\UsersModel;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Cache\RateLimiting\Limit;

class Helper
{
    public static function throttle($key, $maxAttempts, $decayTime, $type = "mi")
    {
        $key = $key . '_' . request()->ip();

        // Calculate $time based on the provided $type
        if ($type == "ss") {
            $time = 1; // 1 second for rate limiting
            $unit = 'giây';
        } elseif ($type == "mi") {
            $time = $decayTime * 60; // Convert minutes to seconds
            $unit = 'phút';
        } elseif ($type == "hh") {
            $time = $decayTime * 60 * 60; // Convert hours to seconds
            $unit = 'giờ';
        } elseif ($type == "dd") {
            $time = $decayTime * 60 * 60 * 24; // Convert days to seconds
            $unit = 'ngày';
        } elseif ($type == "mm") {
            $time = $decayTime * 60 * 60 * 24 * 30; // Assuming a month has 30 days
            $unit = 'tháng';
        } elseif ($type == "yyyy") {
            $time = $decayTime * 60 * 60 * 24 * 365; // Assuming a year has 365 days
            $unit = 'năm';
        } else {
            // Invalid $type, you can handle this as per your requirement
            return "Invalid type.";
        }

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $retryAfter = RateLimiter::availableIn($key);

            // Calculate the remaining time in years, months, days, hours, minutes, and seconds
            $remainingYears = floor($retryAfter / (365 * 24 * 60 * 60)); // 365 days in a year
            $remainingMonths = floor(($retryAfter % (365 * 24 * 60 * 60)) / (30 * 24 * 60 * 60)); // Assuming a month has 30 days
            $remainingDays = floor(($retryAfter % (30 * 24 * 60 * 60)) / (24 * 60 * 60));
            $remainingHours = floor(($retryAfter % (24 * 60 * 60)) / (60 * 60));
            $remainingMinutes = floor(($retryAfter % (60 * 60)) / 60);
            $remainingSeconds = $retryAfter % 60;

            // Format the remaining time
            $formattedTime = '';
            if ($remainingYears > 0) {
                $formattedTime .= $remainingYears . " năm ";
            }
            if ($remainingMonths > 0) {
                $formattedTime .= $remainingMonths . " tháng ";
            }
            if ($remainingDays > 0) {
                $formattedTime .= $remainingDays . " ngày ";
            }
            if ($remainingHours > 0) {
                $formattedTime .= $remainingHours . " giờ ";
            }
            if ($remainingMinutes > 0) {
                $formattedTime .= $remainingMinutes . " phút";
            }
            if ($remainingSeconds > 0) {
                $formattedTime .= ($formattedTime ? ' ' : '') . $remainingSeconds . " giây";
            }

            return "Bạn đã nhập sai quá nhiều lần. Vui lòng thử lại sau {$formattedTime}.";
        }

        RateLimiter::hit($key, $time);

        return null;
    }

    public static function base32_encode(string $data): string
    {
        $base32Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

        $result = '';
        $buffer = 0;
        $bufferSize = 0;
        $length = strlen($data);

        for ($i = 0; $i < $length; ++$i) {
            $buffer <<= 8;
            $buffer |= ord($data[$i]);
            $bufferSize += 8;

            while ($bufferSize >= 5) {
                $bufferSize -= 5;
                $index = ($buffer >> $bufferSize) & 31;
                $result .= $base32Chars[$index];
            }
        }

        if ($bufferSize > 0) {
            $buffer <<= (5 - $bufferSize);
            $index = $buffer & 31;
            $result .= $base32Chars[$index];
        }

        return $result;
    }
    public static function base32_decode(string $encodedData): string
    {
        $base32Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

        $result = '';
        $buffer = 0;
        $bufferSize = 0;
        $length = strlen($encodedData);

        for ($i = 0; $i < $length; ++$i) {
            $char = $encodedData[$i];
            $index = strpos($base32Chars, strtoupper($char));
            if ($index === false) {
                return 'error';
            }

            $buffer <<= 5;
            $buffer |= $index;
            $bufferSize += 5;

            if ($bufferSize >= 8) {
                $bufferSize -= 8;
                $result .= chr(($buffer >> $bufferSize) & 255);
            }
        }

        return $result;
    }

   







    public static function random($string, $int)
    {
        return substr(str_shuffle($string), 0, $int);
    }
}
