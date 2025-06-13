<?php
const SITE_NAME = 'Site Name';
const PHOTO_UPLOAD_DIR = 'storage';
const PHOTO_AVAILABLE_TYPES = [
    'image/jpg',
    'image/jpeg',
    'image/gif',
    'image/png',
    'image/webp',
];
const PHOTO_MAX_FILE_SIZE = 1024 * 1024 * 5;
const FILE_UPLOAD_ERR = [
    0 => 'Файл успішно завантажено.',
    1 => 'Завантажений файл перевищує максимальний розмір, вказаний у параметрі upload_max_filesize в php.ini.',
    2 => 'Завантажений файл перевищує значення MAX_FILE_SIZE, вказане у HTML-формі.',
    3 => 'Файл був завантажений лише частково.',
    4 => 'Файл не був завантажений.',
    6 => 'Відсутня тимчасова тека для збереження файлів.',
    7 => 'Не вдалося записати файл на диск.',
    8 => 'Завантаження файлу було зупинено PHP-розширенням.',
];

const IMG_LIMIT = 5;