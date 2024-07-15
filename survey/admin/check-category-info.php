<?php
require_once("classes/cls-category.php");
$obj_category = new Category();

// check for title id
if (isset($_POST['title']) && $_POST['title'] != "") {
    if (isset($_POST['old_title'])) {
        if ($_POST['title'] == $_POST['old_title']) {
            echo "true";
            die();
        }
    }
    $condition = "`title` = '" . $_POST['title'] . "'";
    $category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);

    if (isset($category_details) && count($category_details)) {
        echo "false";
    } else {
        echo "true";
    }
}

// check for title id
if (isset($_POST['shortcode']) && $_POST['shortcode'] != "") {
    if (isset($_POST['old_shortcode'])) {
        if ($_POST['shortcode'] == $_POST['old_shortcode']) {
            echo "true";
            die();
        }
    }
    $condition = "`shortcode` = '" . $_POST['shortcode'] . "'";
    $category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);

    if (isset($category_details) && count($category_details)) {
        echo "false";
    } else {
        echo "true";
    }
}
?>