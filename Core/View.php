<?php

namespace core;

class View {

    public static function render(string $path, array $data = []) {

        $file = ROOT . '/app/views/' . $path . '.php';

        if (!file_exists($file)) {
            throw new \ErrorException("$file cannot be found");
        }

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        require_once  $file;
    }
}
