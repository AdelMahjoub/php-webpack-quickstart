<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= SITE_NAME ?></title>
    <?php
        if(file_exists(DIST_FOLDER . '/manifest.json')) {
            $manifest_css_prop = 'bundle.css';
            $manifest = json_decode(file_get_contents(DIST_FOLDER . '/manifest.json'));
            $css = $manifest->$manifest_css_prop;
        } else {
            $css = 'bundle.css';
        }
    ?>
    <?php if(file_exists(DIST_FOLDER . '/' . $css)): ?>
    <link rel="stylesheet" href="<?= PUBLIC_ASSETS_URL . '/' . $css ?>">
    <?php endif; ?>
</head>
<body>
