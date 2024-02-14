ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Dosya yükleme formu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $allowed_extensions = ['png', 'jpg', 'jpeg', 'gif', 'webp', 'ico', 'jfif', 'apng', 'svg'];
    $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    // Dosya türünü kontrol et
    if (!in_array($file_extension, $allowed_extensions)) {
        die('Yüklenen dosya türüne izin verilmiyor.');
    }

    // Dosyayı yükle
    $upload_dir = 'uploads/';
    $file_path = $upload_dir . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
        // Dosyanın URL'sini oluştur
        $domain = $_SERVER['HTTP_HOST'];
        $cdn_url = 'https://' . str_replace('.', '-', $domain) . '.cdn.ampproject.org/i/s/' . $domain . '/' . $file_path;

        // Dosyanın adını ve URL'sini göster
        echo '<script>
            $("#url-display").show();
            $("#url-text").val("' . $cdn_url . '");
            $("#image-display").show();
            $("#uploaded-image").attr("src", "' . $cdn_url . '");
            $("#uploaded-image").attr("alt", "' . basename($_FILES['file']['name']) . '");
        </script>';
    } else {
        echo 'Dosya yüklenirken bir hata oluştu.';
    }
}
