<?php

namespace app\validators;

class PhotoValidator
{
    /**
     * Checks file to upload conditions.
     * @param array $file
     * @return array
     */
    public function validate(array $file): array
    {
        $errors = [];

        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = FILE_UPLOAD_ERRORS[$file['error']] ?? 'Невідома помилка завантаження.';
            return $errors;
        }

        // MIME-тип
        if (!in_array($file['type'], PHOTO_AVAILABLE_TYPES, true)) {
            $errors[] = FILE_UPLOAD_ERRORS[5]; // Недопустимий тип файла
        }

        // Розмір
        if ($file['size'] > PHOTO_MAX_FILE_SIZE) {
            $errors[] = FILE_UPLOAD_ERRORS[2]; // Завеликий файл
        }

        return $errors;
    }
}
