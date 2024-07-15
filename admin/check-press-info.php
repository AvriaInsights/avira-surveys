<?php
require_once("classes/cls-press.php");
$obj_press = new Press();

// check for slug id
if (isset($_POST['slug']) && $_POST['slug'] != "") {
    if (isset($_POST['old_slug'])) {
        if ($_POST['slug'] == $_POST['old_slug']) {
            echo "true";
            die();
        }
    }
    $condition = "`slug` = '" . $_POST['slug'] . "'";
    $press_details = $obj_press->getPressDetails('', $condition, '', '', 0);

    if (isset($press_details) && count($press_details)) {
        echo "false";
    } else {
        echo "true";
    }
}
?>