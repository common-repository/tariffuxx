<?php
header('Content-Type: application/json');
?>
<?php echo json_encode($json_data, JSON_PRETTY_PRINT) ?>
<?php die; ?>
