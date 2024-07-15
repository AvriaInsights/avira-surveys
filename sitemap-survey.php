<?php
require_once("survey/classes/cls-survey.php");
$obj_survey = new Survey();
$condition = "`tbl_survey`.`status` = 'Active' AND `tbl_survey`.`survey_status` = 'Published'";
$sort_by = "`tbl_survey`.`s_id` DESC";
$fields_survey = "*";
$survey_details = $obj_survey->getSurveyDetail($fields_survey, $condition, '', '', 0);

$base_url = "<?php echo SITEPATHFRONT; ?>/php-sitemap/";

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

foreach($survey_details as $survey_detailss)
{
 $survey_url = strtolower($survey_detailss['survey_title']);
 $survey_url = str_replace(' ', '-', $survey_url);   
 echo '<url>' . PHP_EOL;
 echo '<loc>'.SITEPATHFRONT . "survey-view/" . $survey_detailss['survey_id'] . "/" . $survey_url .'/</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>