<?php

namespace app\helpers;

class TransliterationHelper {

    /**
     * @var array Массив соотвествия символов
     * для транслитерации
     */
    private static $_transliterationTable = [
        'А' => 'A', 'а' => 'a',
        'Б' => 'B', 'б' => 'b',
        'В' => 'V', 'в' => 'v',
        'Г' => 'G', 'г' => 'g',
        'Д' => 'D', 'д' => 'd',
        'Е' => 'E', 'е' => 'e',
        'Ё' => 'Yo', 'ё' => 'yo',
        'Ж' => 'Zh', 'ж' => 'zh',
        'З' => 'Z', 'з' => 'z',
        'И' => 'I', 'и' => 'i',
        'Й' => 'J', 'й' => 'j',
        'К' => 'K', 'к' => 'k',
        'Л' => 'L', 'л' => 'l',
        'М' => 'M', 'м' => 'm',
        'Н' => "N", 'н' => 'n',
        'О' => 'O', 'о' => 'o',
        'П' => 'P', 'п' => 'p',
        'Р' => 'R', 'р' => 'r',
        'С' => 'S', 'с' => 's',
        'Т' => 'T', 'т' => 't',
        'У' => 'U', 'у' => 'u',
        'Ф' => 'F', 'ф' => 'f',
        'Х' => 'H', 'х' => 'h',
        'Ц' => 'Cz', 'ц' => 'cz',
        'Ч' => 'Ch', 'ч' => 'ch',
        'Ш' => 'Sh', 'ш' => 'sh',
        'Щ' => 'Shh', 'щ' => 'shh',
        'Ъ' => '', 'ъ' => '',
        'Ы' => 'Y', 'ы' => 'y',
        'Ь' => '', 'ь' => '',
        'Э' => 'E', 'э' => 'e',
        'Ю' => 'Yu', 'ю' => 'yu',
        'Я' => 'Ya', 'я' => 'ya',
        ' ' => '-', '+' => '',
        '\\' => '-', '/' => '-',
        '.' => '-',
    ];

    /**
     * @var array Разрешенные для транслитерации
     * символы
     */
    private static $_availChars = [
        'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H',
        'I', 'J', 'K', 'L',
        'M', 'N', 'O', 'P',
        'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X',
        'Y', 'Z', 'a', 'b',
        'c', 'd', 'e', 'f',
        'g', 'h', 'i', 'j',
        'k', 'l', 'm', 'n',
        'o', 'p', 'q', 'r',
        's', 't', 'u', 'v',
        'w', 'x', 'y', 'z',

        '0', '1', '2', '3',
        '4', '5', '6', '7',
        '8', '9',

        '-', '_',
    ];

    /**
     * Получает транслит строки
     *
     * @param string $string Строка для транслитерации
     * @return string Транслит строки
     */
    public function transliterateString($string) {
        $encoding = 'UTF-8';
        $result = mb_strtolower($string, $encoding);

        // Получаем транслит строки
        $result = str_replace(array_keys(self::$_transliterationTable), array_values(self::$_transliterationTable), $result);

        // Чистим транслит от двойных пробелов
        $result = str_replace('--', '-', $result);

        // Чистим транслит от пробелов в начале и в коннце
        $result = preg_replace('/^-*(.*?)-*$/', '$1', $result);

        // Оставляем только валидные символы
        $resultCpy = $result;
        $result = '';
        $len = mb_strlen($resultCpy, $encoding);
        for($i = 0; $i < $len; $i++) {
            $char = mb_substr($resultCpy, $i, 1, $encoding);
            if(!in_array($char, self::$_availChars)) {
                continue;
            }
            $result .= $char;
        }

        return $result;
    }

}