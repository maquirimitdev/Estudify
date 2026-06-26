<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CaptchaService
{
    public function generateCaptcha(): array
    {
        $num1 = rand(1, 100);
        $num2 = rand(1, 100);
        $answer = $num1 + $num2;

        Session::put('captcha_answer', $answer);
        Session::put('captcha_question', "$num1 + $num2");

        return [
            'question' => Session::get('captcha_question'),
        ];
    }

    public function verifyCaptcha(string $userAnswer): bool
    {
        $correctAnswer = Session::get('captcha_answer');
        Session::forget('captcha_answer');
        Session::forget('captcha_question');

        return (int)$userAnswer === (int)$correctAnswer;
    }

    public function getCaptchaQuestion(): ?string
    {
        return Session::get('captcha_question');
    }
}
