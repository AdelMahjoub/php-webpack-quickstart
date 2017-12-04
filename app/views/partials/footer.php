<?php
    if(file_exists(DIST_FOLDER . '/manifest.json')) {
        $manifest_js_prop = 'bundle.js';
        $manifest = json_decode(file_get_contents(DIST_FOLDER . '/manifest.json'));
        $js = $manifest->$manifest_js_prop;
    } else {
        $js = 'bundle.js';
    }
?>
<?php if(file_exists(DIST_FOLDER . '/' . $js)): ?>
    <script src="<?= PUBLIC_ASSETS_URL . '/' . $js ?>"></script>
<?php endif; ?>
</body>
</html>