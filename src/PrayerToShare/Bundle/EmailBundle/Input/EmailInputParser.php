<?php

namespace PrayerToShare\Bundle\EmailBundle\Input;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("email.input_parser")
 */
class EmailInputParser
{
    public function parseEmails($text)
    {
        $emails = array();

        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            $cleaned = preg_replace('/\s+/', ',', $line);
            $cleaned = preg_replace('/[\'\"]\w[\'\"]/', '${1}', $cleaned);
            $words = explode(',', $cleaned);
            foreach ($words as $word) {
                $emails[] = $word;
            }
        }

        return array_unique(array_filter($emails, function ($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }));
    }
}
