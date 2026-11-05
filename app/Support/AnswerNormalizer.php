<?php

namespace App\Support;

class AnswerNormalizer
{
    /**
     * Normalize common formatting differences without changing the stored answer.
     */
    public static function normalize($answer): string
    {
        $answer = (string) ($answer ?? '');

        // Normalize compatible Unicode characters when PHP's intl extension exists.
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

        // Treat straight, curly, and backtick-style apostrophes as equivalent.
        $answer = str_replace(
            ["'", '’', '‘', '`', '´', 'ʻ', 'ʼ', '"', '“', '”', '„', '‟'],
            '',
            $answer
        );

        // Treat common dash characters consistently.
        $answer = str_replace(
            ['‐', '‑', '‒', '–', '—', '−'],
            '-',
            $answer
        );

        $answer = preg_replace('/\s+/u', ' ', $answer) ?? $answer;
        $answer = trim($answer);

        // Convert standalone number words to digits (two = 2).
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

    /**
     * Compare exact normalized answers, or accept a meaningful word/phrase
     * contained in a longer official answer. Generic words are not accepted
     * by themselves to reduce accidental matches (for example, "law").
     */
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

        // A student's shortened answer may be a contiguous phrase from the
        // official answer, provided it includes at least one meaningful term.
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

        // Every student word must be present in the same order and adjacent.
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
