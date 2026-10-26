<?php

namespace App\Services;

use RuntimeException;

class BijoyToUnicode
{
    /**
     * Convert Bijoy/SutonnyMJ encoded text to Unicode Bangla.
     */
    public function convert(string $text): string
    {
        if ($text === '') {
            return '';
        }

        if (!function_exists('mb_strlen')) {
            throw new RuntimeException(
                'PHP mbstring extension is required.'
            );
        }

        // Normalize common typing/spacing problems first.
        $text = $this->preProcess($text);

        // Convert Bijoy characters to Unicode characters.
        $text = $this->convertCharacters($text);

        // Fix duplicate hasanta.
        $text = str_replace('্্', '্', $text);

        // Re-arrange Unicode Bangla vowel signs and reph.
        $text = $this->rearrange($text);

        // Final cleanup.
        $text = $this->postProcess($text);

        return $text;
    }

    /**
     * Bijoy text normalization before conversion.
     */
    protected function preProcess(string $text): string
    {
        $replacements = [
            ' +'       => ' ',
            'yy'       => 'y',
            'vv'       => 'v',
            'y&'       => 'y',
            '„&'       => '„',

            // Common typing mistakes.
            '‡u'       => 'u‡',
            'wu'       => 'uw',

            " ,"       => ",",

            " \\"       => "",
            "\\ "       => "",
            "\\"       => "",

            "\n +"     => "\n",
            " +\n"     => "\n",

            "\n\n\n\n\n" => "\n\n",
            "\n\n\n\n"   => "\n\n",
            "\n\n\n"     => "\n\n",
        ];

        foreach ($replacements as $search => $replace) {
            $text = str_replace($search, $replace, $text);
        }

        return $text;
    }

    /**
     * Bijoy/SutonnyMJ -> Unicode mapping.
     *
     * Long/multi-character sequences must be processed
     * before individual characters.
     */
    protected function convertCharacters(string $text): string
    {
        $map = [

            /*
            |--------------------------------------------------------------------------
            | Vowels
            |--------------------------------------------------------------------------
            */

            'Av' => 'আ',
            'A'  => 'অ',
            'B'  => 'ই',
            'C'  => 'ঈ',
            'D'  => 'উ',
            'E'  => 'ঊ',
            'F'  => 'ঋ',
            'G'  => 'এ',
            'H'  => 'ঐ',
            'I'  => 'ও',
            'J'  => 'ঔ',

            /*
            |--------------------------------------------------------------------------
            | Common conjuncts / special characters
            |--------------------------------------------------------------------------
            */

            'Î' => 'ত্র',
            'Ï' => 'দ্দ',
            'Ð' => '-',
            'Ñ' => '-',
            'Ò' => '"',
            'Ó' => '"',
            'Ô' => "'",
            'Õ' => "'",

            'Ö' => '্র',
            '×' => 'দ্ধ',
            'Ø' => 'দ্ব',
            'Ù' => 'দ্ম',
            'Ú' => 'ন্ঠ',
            'Û' => 'ন্ড',
            'Ü' => 'ন্ধ',
            'Ý' => 'ন্স',

            'Þ' => 'প্ট',
            'ß' => 'প্ত',
            'à' => 'প্প',
            'á' => 'প্স',

            'â' => 'ব্জ',
            'ã' => 'ব্দ',
            'ä' => 'ব্ধ',
            'å' => 'ভ্র',

            'æ' => 'ম্ন',
            'ç' => 'ম্ফ',

            'è' => '্ন',

            'é' => 'ল্ক',
            'ê' => 'ল্গ',
            'ë' => 'ল্ট',
            'ì' => 'ল্ড',
            'í' => 'ল্প',
            'î' => 'ল্ফ',

            'ï' => 'শু',
            'ð' => 'শ্চ',
            'ñ' => 'শ্ছ',

            'ò' => 'ষ্ণ',
            'ó' => 'ষ্ট',
            'ô' => 'ষ্ঠ',
            'õ' => 'ষ্ফ',

            'ö' => 'স্খ',
            '÷' => 'স্ট',
            'ø' => 'স্ন',
            'ù' => 'স্ফ',

            'ú' => '্প',
            'û' => 'হু',
            'ü' => 'হৃ',
            'ý' => 'হ্ন',
            'þ' => 'হ্ম',

            /*
            |--------------------------------------------------------------------------
            | Basic consonants
            |--------------------------------------------------------------------------
            */

            'K' => 'ক',
            'L' => 'খ',
            'M' => 'গ',
            'N' => 'ঘ',
            'O' => 'ঙ',

            'P' => 'চ',
            'Q' => 'ছ',
            'R' => 'জ',
            'S' => 'ঝ',
            'T' => 'ঞ',

            'U' => 'ট',
            'V' => 'ঠ',
            'W' => 'ড',
            'X' => 'ঢ',
            'Y' => 'ণ',

            'Z' => 'ত',
            'a' => 'থ',
            'b' => 'দ',
            'c' => 'ধ',
            'd' => 'ন',

            'e' => 'প',
            'f' => 'ফ',
            'g' => 'ব',
            'h' => 'ভ',
            'i' => 'ম',

            'j' => 'য',
            'k' => 'র',
            'l' => 'ল',
            'm' => 'শ',
            'n' => 'ষ',
            'o' => 'স',
            'p' => 'হ',

            /*
            |--------------------------------------------------------------------------
            | Kar / vowel signs
            |--------------------------------------------------------------------------
            */

            'q' => 'া',
            'r' => 'ি',
            's' => 'ী',
            't' => 'ু',
            'u' => 'ু',
            'v' => 'ূ',

            'w' => 'ৃ',

            'x' => 'ে',
            'y' => 'ৈ',

            'z' => 'ং',

            '&' => '্',

            /*
            |--------------------------------------------------------------------------
            | Additional signs
            |--------------------------------------------------------------------------
            */

            '‚' => 'ঁ',
            'ƒ' => 'ং',
            '„' => 'ৃ',
            '…' => 'ঃ',
            '†' => '্র',
            '‡' => 'া',
            'ˆ' => 'ি',
            '‰' => 'ী',
            'Š' => 'ু',
            '‹' => 'ূ',
            'Œ' => 'ৃ',
            'Ž' => 'ে',
            '‘' => 'ৈ',
            '’' => 'ো',
            '“' => 'ৌ',
            '”' => '্',

            /*
            |--------------------------------------------------------------------------
            | Numbers
            |--------------------------------------------------------------------------
            */

            '0' => '০',
            '1' => '১',
            '2' => '২',
            '3' => '৩',
            '4' => '৪',
            '5' => '৫',
            '6' => '৬',
            '7' => '৭',
            '8' => '৮',
            '9' => '৯',
        ];

        /*
         * Important:
         * Sort by source length so multi-character sequences
         * are converted before individual characters.
         */
        uksort(
            $map,
            fn ($a, $b) =>
                mb_strlen($b, 'UTF-8') <=> mb_strlen($a, 'UTF-8')
        );

        foreach ($map as $from => $to) {
            $text = str_replace($from, $to, $text);
        }

        return $text;
    }

    /**
     * Re-arrange Unicode Bangla characters.
     *
     * Bijoy stores some vowel signs in a visual/legacy order.
     * Unicode requires the logical order.
     */
    protected function rearrange(string $text): string
    {
        $length = mb_strlen($text, 'UTF-8');

        $output = '';

        for ($i = 0; $i < $length; $i++) {

            $current = mb_substr($text, $i, 1, 'UTF-8');

            /*
             * Reph:
             *
             * র্ + consonant
             *
             * should visually behave as a reph over the consonant.
             */
            if ($current === 'র' && $this->nextChar($text, $i) === '্') {

                $cluster = 'র্';

                $i += 2;

                while ($i < $length) {

                    $char = mb_substr(
                        $text,
                        $i,
                        1,
                        'UTF-8'
                    );

                    $cluster .= $char;

                    if (!$this->isBanglaVowelSign($char)) {
                        break;
                    }

                    $i++;
                }

                /*
                 * Put reph after the consonant cluster.
                 */
                $cluster = $this->moveReph($cluster);

                $output .= $cluster;

                continue;
            }

            /*
             * Pre-base vowel signs:
             *
             * ি
             * ে
             * ৈ
             *
             * In Unicode logical order they belong after
             * the consonant/cluster.
             */
            if ($this->isPreBaseVowel($current)) {

                $previous = $this->lastUnicodeChar($output);

                if ($previous !== null) {

                    $output = mb_substr(
                        $output,
                        0,
                        mb_strlen($output, 'UTF-8') - 1,
                        'UTF-8'
                    );

                    $output .= $previous;
                    $output .= $current;
                } else {
                    $output .= $current;
                }

                continue;
            }

            $output .= $current;
        }

        return $output;
    }

    /**
     * Move reph to the end of a consonant cluster.
     */
    protected function moveReph(string $cluster): string
    {
        if (!str_starts_with($cluster, 'র্')) {
            return $cluster;
        }

        return mb_substr($cluster, 2, null, 'UTF-8') . 'র্';
    }

    /**
     * Final cleanup.
     */
    protected function postProcess(string $text): string
    {
        $map = [
            '০ঃ' => '০:',
            '১ঃ' => '১:',
            '২ঃ' => '২:',
            '৩ঃ' => '৩:',
            '৪ঃ' => '৪:',
            '৫ঃ' => '৫:',
            '৬ঃ' => '৬:',
            '৭ঃ' => '৭:',
            '৮ঃ' => '৮:',
            '৯ঃ' => '৯:',

            ' ঃ' => ' :',
            "\nঃ" => "\n:",
        ];

        return str_replace(
            array_keys($map),
            array_values($map),
            $text
        );
    }

    protected function isPreBaseVowel(string $char): bool
    {
        return in_array(
            $char,
            ['ি', 'ে', 'ৈ'],
            true
        );
    }

    protected function isBanglaVowelSign(string $char): bool
    {
        return in_array(
            $char,
            [
                'া',
                'ি',
                'ী',
                'ু',
                'ূ',
                'ৃ',
                'ে',
                'ৈ',
                'ো',
                'ৌ',
                'ং',
                'ঃ',
                'ঁ',
            ],
            true
        );
    }

    protected function nextChar(string $text, int $index): ?string
    {
        $next = $index + 1;

        if ($next >= mb_strlen($text, 'UTF-8')) {
            return null;
        }

        return mb_substr(
            $text,
            $next,
            1,
            'UTF-8'
        );
    }

    protected function lastUnicodeChar(string $text): ?string
    {
        if ($text === '') {
            return null;
        }

        return mb_substr(
            $text,
            -1,
            1,
            'UTF-8'
        );
    }
}