
<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

$zipname = '../exported_posts.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);

foreach (glob("../posts/*.md") as $file) {
    $zip->addFile($file, basename($file));
}
foreach (glob("../posts/*.date.txt") as $file) {
    $zip->addFile($file, basename($file));
}
$zip->close();

header('Content-Type: application/zip');
header("Content-Disposition: attachment; filename="exported_posts.zip"");
readfile($zipname);
unlink($zipname);
exit;
?>
