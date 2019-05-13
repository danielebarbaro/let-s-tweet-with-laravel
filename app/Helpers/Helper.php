<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
    protected $expire_at;
    protected $session_token;
    protected $user;

    /**
     * Helper constructor.
     */
    public function __construct()
    {
        $this->expire_at = Carbon::now()->addMinutes(1440);
        $this->user = auth()->user();
    }

    /**
     * Just a sample function to test helper
     */
    public function helloWorld()
    {
        dd('Hello World!');
    }

    /**
     * Convert Carbon date from datetime string to $format
     * @param $date
     * @param string $format
     * @return string
     */
    public function formatDate($date, $format = 'd-m-Y H:i')
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($format);
    }

    /**
     * Convert and round a number
     * @param $amount
     * @return string
     */
    public static function formatAndRound($amount)
    {
        return number_format(round($amount, 2), 2);
    }

    /**
     * @param \Exception $e
     * @param string $message
     * @param string $debug_message
     * @param int $code
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($e, $message = null, $debug_message = '', $code = 0, $status_code = 0)
    {
        $message_string = is_null($message) && $e instanceof \Exception ? $e->getMessage() : $message;
        $code_value = is_null($code) && $e instanceof \Exception ? $e->getCode() : $code;

        if (is_null($debug_message)) {
            $log_message = $message_string;
            $error_data = [
                'message' => $message_string,
                'code' => $code_value,
            ];
        } else {
            $log_message = "{$message_string} | {$debug_message}";
            $error_data = [
                'message' => $message_string,
                'debug' => $debug_message,
                'code' => $code_value,
            ];
        }

        \Log::error($log_message);

        return response()->json([
            'status' => 'error',
            'error' => $error_data
        ], $status_code ?: 412);
    }
}
