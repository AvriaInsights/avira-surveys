<?php
require_once("classes/cls-blog.php");
$obj_blog = new Blog();

// check for slug id
if (isset($_POST['slug']) && $_POST['slug'] != "") {
    if (isset($_POST['old_slug'])) {
        if ($_POST['slug'] == $_POST['old_slug']) {
            echo "true";
            die();
        }
    }
    $condition = "`slug` = '" . $_POST['slug'] . "'";
    $blog_details = $obj_blog->getBlogDetails('', $condition, '', '', 0);

    if (isset($blog_details) && count($blog_details)) {
        echo "false";
    } else {
        echo "true";
    }
}
?>