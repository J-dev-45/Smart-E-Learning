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
        $safeOtp = htmlspecialchars($otp_code, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        $htmlContent = $this->buildOtpTemplate(
            [
                'page_bg' => '#F5F3FF',
                'card_border' => '#EDE9FE',
                'header_bg' => '#8B5CF6',
                'header_sub' => '#EDE9FE',
                'tint_bg' => '#F5F3FF',
                'tint_border' => '#C4B5FD',
                'accent' => '#4C1D95',
            ],
            'Email Verification',
            "Hi <b>{$safeName}</b>,",
            'Thank you for joining Smart E-Learning. Use the code below to verify your email address.',
            $safeOtp,
            'This is an automated email from Smart E-Learning.'
        );

        return $this->sendOtpEmail($email, $name, 'Your OTP Code', $htmlContent);
    }

    public function sendResetMail(string $email, string $name, string $otp_code): bool
    {
        $safeName = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $safeOtp = htmlspecialchars($otp_code, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        $htmlContent = $this->buildOtpTemplate(
            [
                'page_bg' => '#F5F3FF',
                'card_border' => '#EDE9FE',
                'header_bg' => '#8B5CF6',
                'header_sub' => '#EDE9FE',
                'tint_bg' => '#F5F3FF',
                'tint_border' => '#C4B5FD',
                'accent' => '#4C1D95',
            ],
            'Password Reset',
            "Hi <b>{$safeName}</b>,",
            'You requested to reset your password. Use the code below to continue.',
            $safeOtp,
            "If you didn't request this, please ignore this email."
        );

        return $this->sendOtpEmail($email, $name, 'Password Reset OTP', $htmlContent);
    }

    /**
     * Shared layout for the OTP emails (verification and password reset).
     * $c holds the color set; $greetingHtml must already be escaped.
     */
    private function buildOtpTemplate(
        array $c,
        string $subtitle,
        string $greetingHtml,
        string $intro,
        string $safeOtp,
        string $footerNote
    ): string {
        return "
            <div style='background-color:{$c['page_bg']}; padding:32px 16px; font-family: Arial, Helvetica, sans-serif;'>
                <table role='presentation' width='100%' cellpadding='0' cellspacing='0' border='0' style='max-width:520px; margin:0 auto;'>
                    <tr>
                        <td style='background-color:#FFFFFF; border-radius:16px; border:1px solid {$c['card_border']}; overflow:hidden;'>

                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' border='0'>
                                <tr>
                                    <td style='background-color:{$c['header_bg']}; padding:28px 24px; text-align:center;'>
                                        <img src='https://smart-e-learning.up.railway.app/images/Components/Logo.png' width='64' alt='Smart E-Learning' style='display:block; margin:0 auto 12px auto;'>
                                        <h1 style='margin:0; font-size:20px; line-height:1.3; color:#FFFFFF;'>Smart E-Learning</h1>
                                        <p style='margin:6px 0 0 0; font-size:14px; color:{$c['header_sub']};'>{$subtitle}</p>
                                    </td>
                                </tr>
                            </table>

                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' border='0'>
                                <tr>
                                    <td style='padding:28px 24px 8px 24px;'>
                                        <p style='margin:0 0 6px 0; font-size:16px; color:#111827;'>{$greetingHtml}</p>
                                        <p style='margin:0; font-size:14px; line-height:1.6; color:#4B5563;'>{$intro}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style='padding:20px 24px 8px 24px;'>
                                        <p style='margin:0 0 8px 0; font-size:11px; font-weight:bold; letter-spacing:0.8px; text-transform:uppercase; color:{$c['accent']}; text-align:center;'>Your OTP Code</p>
                                        <div style='background-color:{$c['tint_bg']}; border:2px dashed {$c['tint_border']}; border-radius:12px; padding:18px 16px; text-align:center; font-family: \"Courier New\", Courier, monospace; font-size:34px; font-weight:bold; letter-spacing:8px; color:{$c['accent']};'>
                                            {$safeOtp}
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style='padding:12px 24px 28px 24px; text-align:center;'>
                                        <p style='margin:0; font-size:13px; line-height:1.6; color:#6B7280;'>This code is valid for <b style='color:#374151;'>10 minutes</b>.</p>
                                    </td>
                                </tr>
                            </table>

                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' border='0'>
                                <tr>
                                    <td style='background-color:#FAFAFA; border-top:1px solid #F3F4F6; padding:16px 24px; text-align:center;'>
                                        <p style='margin:0; font-size:12px; line-height:1.5; color:#9CA3AF;'>{$footerNote}</p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </div>
        ";
    }

    private function sendOtpEmail(string $email, string $name, string $subject, string $htmlContent): bool
    {
        $apiKey = config('services.brevo.api_key');
        $senderEmail = config('mail.from.address');

        if (
            ! $apiKey ||
            ! $senderEmail ||
            ! filter_var($senderEmail, FILTER_VALIDATE_EMAIL) ||
            ! filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {
            Log::error('Brevo OTP email is not configured correctly or the recipient email is invalid.');

            return false;
        }

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(15)->connectTimeout(5)->post('https://api.brevo.com/v3/smtp/email', [
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
            ]);
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

    public function sendFeedbackMail(
        string $email,
        string $name,
        string $feedbackMessage,
        string $replyMessage,
        ?string $questionLabel = null
    ): bool {
        $safeName = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $safeFeedback = nl2br(htmlspecialchars($feedbackMessage, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
        $safeReply = nl2br(htmlspecialchars($replyMessage, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));

        $questionBlock = '';

        if ($questionLabel !== null && trim($questionLabel) !== '') {
            $safeQuestion = nl2br(htmlspecialchars($questionLabel, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));

            $questionBlock = "
                <p style='margin:0 0 6px 0; font-size:11px; font-weight:bold; letter-spacing:0.8px; text-transform:uppercase; color:#6B7280;'>About</p>
                <p style='margin:0 0 14px 0; font-size:13px; line-height:1.55; color:#4B5563;'>{$safeQuestion}</p>
            ";
        }

        $htmlContent = "
            <div style='background-color:#F5F3FF; padding:32px 16px; font-family: Arial, Helvetica, sans-serif;'>
                <table role='presentation' width='100%' cellpadding='0' cellspacing='0' border='0' style='max-width:520px; margin:0 auto;'>
                    <tr>
                        <td style='background-color:#FFFFFF; border-radius:16px; border:1px solid #EDE9FE; overflow:hidden;'>

                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' border='0'>
                                <tr>
                                    <td style='background-color:#8B5CF6; padding:28px 24px; text-align:center;'>
                                        <img src='https://smart-e-learning.up.railway.app/images/Components/Logo.png' width='64' alt='Smart E-Learning' style='display:block; margin:0 auto 12px auto;'>
                                        <h1 style='margin:0; font-size:20px; line-height:1.3; color:#FFFFFF;'>Smart E-Learning</h1>
                                        <p style='margin:6px 0 0 0; font-size:14px; color:#EDE9FE;'>We replied to your feedback</p>
                                    </td>
                                </tr>
                            </table>

                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' border='0'>
                                <tr>
                                    <td style='padding:28px 24px 8px 24px;'>
                                        <p style='margin:0 0 6px 0; font-size:16px; color:#111827;'>Hi <b>{$safeName}</b>,</p>
                                        <p style='margin:0; font-size:14px; line-height:1.6; color:#4B5563;'>Thank you for taking the time to send us your feedback. Our team has reviewed it and here is our reply.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style='padding:20px 24px 8px 24px;'>
                                        <p style='margin:0 0 8px 0; font-size:11px; font-weight:bold; letter-spacing:0.8px; text-transform:uppercase; color:#6D28D9;'>Our Reply</p>
                                        <div style='background-color:#F5F3FF; border-left:4px solid #8B5CF6; border-radius:8px; padding:14px 16px; font-size:15px; line-height:1.65; color:#1F2937;'>
                                            {$safeReply}
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style='padding:20px 24px 28px 24px;'>
                                        <div style='background-color:#F9FAFB; border:1px solid #E5E7EB; border-radius:8px; padding:14px 16px;'>
                                            {$questionBlock}
                                            <p style='margin:0 0 6px 0; font-size:11px; font-weight:bold; letter-spacing:0.8px; text-transform:uppercase; color:#6B7280;'>Your Feedback</p>
                                            <p style='margin:0; font-size:13px; line-height:1.6; color:#4B5563;'>{$safeFeedback}</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' border='0'>
                                <tr>
                                    <td style='background-color:#FAFAFA; border-top:1px solid #F3F4F6; padding:16px 24px; text-align:center;'>
                                        <p style='margin:0; font-size:12px; line-height:1.5; color:#9CA3AF;'>You received this email because you sent feedback on Smart E-Learning.</p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </div>
        ";

        return $this->sendFeedbackEmail($email, $name, 'Reply to Your Feedback', $htmlContent);
    }

    private function sendFeedbackEmail(string $email, string $name, string $subject, string $htmlContent): bool
    {
        $apiKey = config('services.brevo.api_key');
        $senderEmail = config('mail.from.address');

        if (
            ! $apiKey ||
            ! $senderEmail ||
            ! filter_var($senderEmail, FILTER_VALIDATE_EMAIL) ||
            ! filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {
            Log::error('Brevo feedback email is not configured correctly or the recipient email is invalid.');

            return false;
        }

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(15)->connectTimeout(5)->post('https://api.brevo.com/v3/smtp/email', [
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
            ]);
        } catch (ConnectionException $exception) {
            Log::error('Brevo feedback email request failed to connect.', [
                'exception' => $exception->getMessage(),
            ]);

            return false;
        }

        if (! $response->successful()) {
            Log::error('Brevo rejected feedback email request.', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return false;
        }

        return true;
    }
}