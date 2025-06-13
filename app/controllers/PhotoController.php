<?php

namespace app\controllers;

use app\core\View;
use app\core\Route;
use app\models\PhotoModel;
use app\models\LikeModel;
use Exception;

class PhotoController
{
    private PhotoModel $photoModel;
    private View $view;
    private string $uploadDir;
    private LikeModel $likeModel;

    public function __construct()
    {
        $this->photoModel = new PhotoModel();
        $this->view = new View();
        $this->likeModel = new LikeModel();

        $this->uploadDir = rtrim(UPLOAD_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        if (!extension_loaded('fileinfo')) {
            throw new Exception('PHP Fileinfo extension is not enabled. It is required for secure file uploads.');
        }
    }

    public function index(): void
    {
        try {
            $photos = $this->photoModel->allPhoto(); // Отримуємо всі фотографії
            $allLikes = $this->likeModel->allLikes(); // Отримуємо всі лайки, згруповані за imageId

            // Додаємо кількість лайків до кожної фотографії
            if (is_array($photos)) { // Перевіряємо, чи є $photos масивом
                foreach ($photos as &$photo) { // Використовуємо & для зміни елементів масиву безпосередньо
                    $photo['likes_count'] = $allLikes[$photo['id']] ?? 0; // Додаємо 'likes_count'
                }
            }

            $this->view->render('index_index', [
                'title' => 'Галерея фотографій',
                'photos' => $photos,
                'success_message' => $_GET['success'] ?? '',
                'error_message' => $_GET['error'] ?? '',
            ]);
        } catch (Exception $e) {
            $this->view->render('error', [
                'title' => 'Помилка',
                'error_message' => 'Помилка при завантаженні фотографій: ' . $e->getMessage()
            ]);
        }
    }

    public function upload(): void
    {
        $success_message = '';
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view->render('index_upload', [
                'title' => 'Завантажити фото',
                'success_message' => '',
                'error_message' => '',
            ]);
            return;
        }

        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            switch ($_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE) {
                case UPLOAD_ERR_INI_SIZE:   $error_message = 'Розмір файлу перевищує ліміт PHP.'; break;
                case UPLOAD_ERR_FORM_SIZE:  $error_message = 'Розмір файлу перевищує ліміт форми.'; break;
                case UPLOAD_ERR_PARTIAL:    $error_message = 'Файл завантажено лише частково.'; break;
                case UPLOAD_ERR_NO_FILE:    $error_message = 'Файл для завантаження не вибрано.'; break;
                case UPLOAD_ERR_NO_TMP_DIR: $error_message = 'Відсутня тимчасова директорія.'; break;
                case UPLOAD_ERR_CANT_WRITE: $error_message = 'Помилка запису файлу на диск.'; break;
                default:                    $error_message = 'Невідома помилка завантаження.'; break;
            }
        } else {
            $file = $_FILES['image'];
            $tempFilePath = $file['tmp_name'];
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxFileSize = 5 * 1024 * 1024; // 5 МБ

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if ($finfo === false) {
                $error_message = 'Не вдалося ініціалізувати Fileinfo розширення.';
            } else {
                $realMimeType = finfo_file($finfo, $tempFilePath);
                finfo_close($finfo);

                if (!in_array($realMimeType, $allowedMimeTypes)) {
                    $error_message = 'Неприпустимий тип файлу: ' . htmlspecialchars($realMimeType);
                } elseif ($file['size'] > $maxFileSize) {
                    $error_message = 'Розмір файлу завеликий (макс. 5 МБ).';
                } else {
                    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $uniqueFileName = uniqid('photo_', true) . '.' . $fileExtension;
                    $destinationPath = $this->uploadDir . $uniqueFileName;

                    if (move_uploaded_file($tempFilePath, $destinationPath)) {
                        try {
                            $this->photoModel->upload($uniqueFileName);
                            $success_message = 'Фотографію успішно завантажено!';
                        } catch (Exception $e) {
                            unlink($destinationPath);
                            $error_message = 'Помилка збереження в БД: ' . $e->getMessage();
                        }
                    } else {
                        $error_message = 'Помилка переміщення файлу.';
                    }
                }
            }
        }
        Route::redirect(Route::url('photo', 'index', ['success' => urlencode($success_message), 'error' => urlencode($error_message)]));
    }
}