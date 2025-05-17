<?php

// Upload file ảnh, trả về tên file nếu thành công, rỗng nếu thất bại
function handle_file_upload(string $inputName = 'thumbnail', string $uploadDir = __DIR__ . '/../../uploads/'): string
{
    if (!file_exists($uploadDir))
        mkdir($uploadDir, 0755, true);

    $file = $_FILES[$inputName] ?? null;
    if (!$file || $file['error'] !== UPLOAD_ERR_OK)
        return '';

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileMime = mime_content_type($file['tmp_name']);
    if (!in_array($fileMime, $allowedTypes))
        return '';

    $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt))
        return '';

    $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($file['name']));
    $targetFile = rtrim($uploadDir, '/') . '/' . $fileName;

    return move_uploaded_file($file['tmp_name'], $targetFile) ? $fileName : '';
}

// Lưu flash message vào session
function set_flash(string $type, string $text): void
{
    $_SESSION['flash_message'] = ['type' => $type, 'text' => $text];
}

// Chuyển hướng đến URL và dừng chương trình
function redirect(string $url): void
{
    header("Location: $url");
    exit;
}
