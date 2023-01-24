<?php

namespace Api;

class Api
{
    const URI = __DIR__  . '/state-lga.json';
    public function __construct(array $parts)
    {
        if (empty($parts[2])) self::getStates();
        if (empty($parts[3])) self::getLgas($parts[2]);
    }
    private static function getStates(): void
    {
        $json = file_get_contents(self::URI);
        $stateArr = json_decode($json, true);
        $keys = array_keys($stateArr);
        $data = [];
        foreach ($keys as $key) {
            $data[$key] = self::slugify($key);
        }
        echo json_encode($data);
        die;
    }
    private static function getLgas(string $slug): void
    {
        $state = ucwords(str_replace("-", " ", $slug));
        $json = file_get_contents(self::URI);
        $stateArr = json_decode($json, true);
        if (!key_exists($state, $stateArr)) {
            http_response_code(400);
            echo json_encode(['error' => "State don't exist"]);
            die;
        }
        $lgaArr = $stateArr[$state];
        $data = [];
        foreach ($lgaArr as $lga) {
            $data[$lga] = self::slugify($lga);
        }
        echo json_encode($data);
        die;
    }
    private static function getLgaTowns($state, $lga): void
    {
        # code...
    }
    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}