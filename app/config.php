<?php
const SITE_NAME = 'PhotoGraphy';
const PHOTO_UPLOAD_DIR = 'storage/';
const PHOTO_UPLOAD_URL = 'storage/';
const PHOTO_AVAILABLE_TYPES = [
    'image/jpg',
    'image/jpeg',
    'image/gif',
    'image/png',
    'image/webp',
];
const PHOTO_MAX_FILE_SIZE = 1024 * 1024 * 5;
const FILE_UPLOAD_ERRORS = [
    0 => 'Файл успішно завантажено.',
    1 => 'Завантажений файл перевищує максимальний розмір, вказаний у параметрі upload_max_filesize в php.ini.',
    2 => 'Завантажений файл перевищує допустимий розмір файлу. Оберіть файл до 5МБ.',
    3 => 'Файл не був завантажений.',
    4 => 'Пусте поле. Оберіть будь ласка файл.',
    5 => 'Недопустимий тип файла. Оберіть будь ласка jpg/jpeg/gif/png/webp файл.',
    6 => 'Файл з таким іменем вже існує',
];

const IMG_LIMIT = 5;