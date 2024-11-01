<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <?php echo (@$config_data->id) ? html_entity_decode(esc_html(twl_get_twl_script($config_data))) : "" ?>
</body>
</html>