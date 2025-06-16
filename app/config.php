<?php
const SITE_NAME = 'Site Name';
const PHOTO_UPLOAD_DIR = '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage';

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
    2 => "Завантажений файл перевищує максимальний допустимий розмір. Оберіть інший файл.",
    3 => 'Файл був завантажений лише частково.',
    4 => 'Файл не був завантажений.',
    6 => 'Відсутня тимчасова тека для збереження файлів.',
    7 => 'Не вдалося записати файл на диск.',
    8 => 'Завантаження файлу було зупинено PHP-розширенням.',
    9 => 'Пусте поле. Оберіть будь-ласка файл.',
    10 => 'Недопустимий тип файла. Оберіть будь-ласка jpg/jpeg/gif/png/webp файл.',
    11 => 'Файл з таким іменем вже існує',
];

const IMG_LIMIT = 5;