<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MailerService
{
    public function sendMail(string $email, string $name, string $otp_code): bool
    {
        $safeName = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $htmlContent = "
            <div style='font-family: Arial; text-align:center; padding:20px;'>
                <div style='margin-bottom:20px;'>
                    <img src='https://smart-e-learning.up.railway.app/images/Components/Logo.png' width='100'>
                </div>
                <h2 style='color:#26AF5A; margin-bottom:10px;'> Smart E-Learning </h2>
                <h2 style='color:#128C40;'>Email Verification</h2>
                <p>Hi <b>{$safeName}</b>, your OTP code is:</p>
                <div style='font-size:30px; font-weight:bold; letter-spacing:5px; margin:20px 0;'>
                    {$otp_code}
                </div>
                <p>This code is valid for 10 minutes.</p>
            </div>
        ";

        $textContent = "Hi {$name},\n\nYour Smart E-Learning verification OTP code is: {$otp_code}\n\nThis code is valid for 10 minutes.";

        return $this->sendOtpEmail($email, $name, 'Your OTP Code', $htmlContent, $textContent);
    }

    public function sendResetMail(string $email, string $name, string $otp_code): bool
    {
        $safeName = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $htmlContent = "
            <div style='font-family: Arial; text-align:center; padding:20px;'>
                <div style='margin-bottom:20px;'>
                    <img src='https://smart-e-learning.up.railway.app/images/Components/Logo.png' width='100'>
                </div>
                <h2 style='color:#4C1D95; margin-bottom:10px;'> Smart E-Learning </h2>
                <h2 style='color:#4C1D95;'>Verification Code</h2>
                <p>Hi <b>{$safeName}</b>, your OTP code is:</p>
                <div style='font-size:30px; font-weight:bold; letter-spacing:5px; margin:20px 0; color:#4C1D95;'>
                    {$otp_code}
                </div>
                <p>This code is valid for 10 minutes.</p>
            </div>
        ";

        $textContent = "Hi {$name},\n\nYour Smart E-Learning OTP code is: {$otp_code}\n\nThis code is valid for 10 minutes.";

        return $this->sendOtpEmail($email, $name, 'Your OTP Code', $htmlContent, $textContent);
    }

    private function sendOtpEmail(string $email, string $name, string $subject, string $htmlContent, ?string $textContent = null): bool
    {
        $apiKey = config('services.brevo.api_key');
        $senderEmail = config('mail.from.address');

        if (! $apiKey || ! $senderEmail || ! filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
            Log::error('Brevo OTP email is not configured. Set BREVO_API_KEY and a valid MAIL_FROM_ADDRESS.');

            return false;
        }

        $payload = [
            'sender' => [
                'name' => config('mail.from.name', 'Smart E-Learning'),
                'email' => $senderEmail,
            ],
            'to' => [[
                'email' => $email,
                'name' => $name,
            ]],
            'subject' => $subject,
            'htmlContent' => $htmlContent,
        ];

        if ($textContent) {
            $payload['textContent'] = $textContent;
        }

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(15)->connectTimeout(5)->post('https://api.brevo.com/v3/smtp/email', $payload);
        } catch (ConnectionException $exception) {
            Log::error('Brevo OTP email request failed to connect.', [
                'exception' => $exception->getMessage(),
            ]);

            return false;
        }

        if (! $response->successful()) {
            Log::error('Brevo rejected OTP email request.', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return false;
        }

        return true;
    }
}
