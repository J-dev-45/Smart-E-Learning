<?php

namespace App\Support;

class AnswerNormalizer
{

    public static function normalize($answer): string
    {
        $answer = (string) ($answer ?? '');

        if (class_exists(\Normalizer::class)) {
            $normalized = \Normalizer::normalize($answer, \Normalizer::FORM_KC);

            if ($normalized !== false) {
                $answer = $normalized;
            }
        }

        $answer = trim($answer);
        $answer = function_exists('mb_strtolower')
            ? mb_strtolower($answer, 'UTF-8')
            : strtolower($answer);

        $answer = str_replace(
            ["'", '’', '‘', '`', '´', 'ʻ', 'ʼ', '"', '“', '”', '„', '‟'],
            '',
            $answer
        );

        $answer = str_replace(
            ['‐', '‑', '‒', '–', '—', '−'],
            '-',
            $answer
        );

        $answer = preg_replace('/\s+/u', ' ', $answer) ?? $answer;
        $answer = trim($answer);

        $numbers = [
            'zero' => '0', 'one' => '1', 'two' => '2', 'three' => '3',
            'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7',
            'eight' => '8', 'nine' => '9', 'ten' => '10',
        ];

        foreach ($numbers as $word => $digit) {
            $answer = preg_replace('/\b' . $word . '\\b/i', $digit, $answer) ?? $answer;
        }

        return trim($answer);
    }

   
    public static function isCorrect($studentAnswer, $correctAnswer): bool
    {
        $student = self::normalize($studentAnswer);
        $correct = self::normalize($correctAnswer);

        if ($student === '' || $correct === '') {
            return false;
        }

        if ($student === $correct) {
            return true;
        }

    
        $genericWords = [
            'a', 'an', 'the', 'of', 'in', 'on', 'for', 'to', 'and', 'or',
            'law', 'rule', 'property', 'principle', 'theorem', 'method',
            'technique', 'formula', 'function', 'algorithm',
        ];

        $studentWords = preg_split('/\s+/u', $student, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $correctWords = preg_split('/\s+/u', $correct, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        if (count($studentWords) === 0 || count($studentWords) > count($correctWords)) {
            return false;
        }

        $phraseFound = false;
        $studentCount = count($studentWords);
        $correctCount = count($correctWords);

        for ($i = 0; $i <= $correctCount - $studentCount; $i++) {
            if (array_slice($correctWords, $i, $studentCount) === $studentWords) {
                $phraseFound = true;
                break;
            }
        }

        if (!$phraseFound) {
            return false;
        }

        foreach ($studentWords as $word) {
            if (strlen($word) >= 4 && !in_array($word, $genericWords, true)) {
                return true;
            }
        }

        return false;
    }
}
