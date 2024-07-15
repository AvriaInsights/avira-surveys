<?php
require_once("survey/classes/cls-survey.php");

$obj_survey = new Survey();

ini_set('allow_url_fopen',1);


$url="https://newsapi.org/v2/everything?q=keyword&apiKey=9ec99190085a47df959d6f2c847c7fea";

$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
$ch=curl_init();
curl_setopt($ch,CURLOPT_USERAGENT, $agent);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);
if(!$json) {
    echo "error";
    echo curl_error($ch);
}

curl_close($ch);
//print_r(json_decode($json));

$newsData = json_decode($json);
$totalnews=$newsData->totalResults;
$articles=$newsData->articles;

// echo "<pre>";
// print_r($articles);
//  echo "</pre>";
// echo "<pre>";
//       print_r($newsData);
//   echo "</pre>";
//var_dump($newsData);

// foreach($newsData as $nws){
//     echo $nws->status;
// }

$adjacents = 3;
$targetpage = SITEPATHFRONT . 'news?';

/* Setup page vars for display. */
$total = 0;
$currentpage = 1;
//echo $_REQUEST['limit'];
if (isset($_REQUEST['limit'])) {
    $limit = $_REQUEST['limit'];
} else {
    $limit = 10;
}

if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} else {
    $page = 0;
}


if ($page) {
    $start = ($page - 1) * $limit; //first item to display on this page
} else {
    $start = 0;
}

#Get Total News Count

$total = count($articles);


if ($page == 0) {
    $page = 1; //if no page var is given, default to 1.
} else {
    $currentpage = $page;    
}
$prev = $page - 1; //previous page is current page - 1
$next = $page + 1; //next page is current page + 1
$lastpage = ceil($total / $limit); //lastpage.
$lpm1 = $lastpage - 1; //last page minus 1
/* CREATE THE PAGINATION */

$targetpage .= "limit=" . $limit . "&page=";
$pagination = "";
$counter = 0;
if ($lastpage > 1) {
    $pagination .= "<ul class=\"pagination\">";
    if ($page > $counter + 1) {
        $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$prev}\"><li class=\"page-item\"><< Previous</li></a>"; 
    }

    if ($lastpage < 7 + ($adjacents * 2)) {
        for ($counter = 1; $counter <= $lastpage; $counter++) {
            if ($counter == $page) {
                $pagination .= "<a class=\"page-link active\" href='#' class=''><li class=\"page-item\">$counter</li></a>";
            } else {
                $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$counter}\"><li class=\"page-item\">$counter</li></a>";
            }
        }
    } elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
        //close to beginning; only hide later pages
        if ($page < 1 + ($adjacents * 2)) {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                if ($counter == $page) {
                    $pagination .= "<a class=\"page-link active\" href='#'><li class=\"page-item\">$counter</li></a>";
                } else {
                    $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$counter}\"><li class=\"page-item\">$counter</li></a>";
                }
            }
            $pagination .= "<li class=\"page-item\">...</li>";
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$lpm1}\"><li class=\"page-item\">$lpm1</li></a>";
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$lastpage}\"><li class=\"page-item\">$lastpage</li></a>";
        }
        //in middle; hide some front and some back
        elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}1\"><li class=\"page-item\">1</li></a>";
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}2\"><li class=\"page-item\">2</li></a>";
            $pagination .= "<li class=\"page-item\">...</li>";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                if ($counter == $page) {
                    $pagination .= "<a class=\"page-link active\" href='#'><li class=\"page-item\">$counter</li></a>";
                } else {
                    $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$counter}\"><li class=\"page-item\">$counter</li></a>";
                }
            }
            $pagination .= "<li class=\"page-item\">...</li>";
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$lpm1}\"><li class=\"page-item\">$lpm1</li></a>";
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$lastpage}\"><li class=\"page-item\">$lastpage</li></a>";
        }
        //close to end; only hide early pages
        else {
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}1\"><li class=\"page-item\">1</li></a>";
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}2\"><li class=\"page-item\">2</li></a>";
            $pagination .= "<li class=\"page-item\">...</li>";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                if ($counter == $page) {
                    $pagination .= "<a class=\"page-link active\" href='#'><li class=\"page-item\">$counter</li></a>";
                } else {
                    $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$counter}\"><li class=\"page-item\">$counter</li></a>";
                }
            }
        }
    }

    //next button
    if ($page < $counter - 1) {
        $pagination .= "<a href=\"{$targetpage}{$next}\"><li class=\"page-item\">Next >></li></a>";
    } else {
        $pagination .= "";
    }
    $pagination .= "</ul>\n";
}
?>
<?php
$page = "News";
$page_title = "Avira Surveys – News - " . SITETITLE;
$meta_description = "The insights that help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";

include('common-header.php')?>
<style>
    .active
    {
        color: #fff;
        background: #01A5FF;
    }
</style>
<div class="ptb">
    <div class="container">
        <div class="row">
             <div class="col-md-12 pb-4">
                <h2 class="n_ttl">Latest News</h2>
            </div>
        </div>
         <?php 
           $lmval=$start+$limit;
            for($i=$start;$i<$lmval;$i++){
                  if(isset($articles[$i]->title)){ 
        ?>
        <div class="row news-holder-main">
            <div class="col-md-2">
                <img src="<?php  echo $articles[$i]->urlToImage;?>" alt="new-img" class="img-fluid news-img">
            </div>
            <div class="col-md-10">
                <div class="news-data">
                    <h5><?php echo date("F d, Y h:i a",strtotime($articles[$i]->publishedAt));?></h5>
                    <h2><a href="<?php echo $articles[$i]->url;?>" target="_blank"><?php  echo $articles[$i]->title;?></a></h2>
                    <p><?php  echo $articles[$i]->description;?></p>
                    <a href="<?php echo $articles[$i]->url;?>" class="r_link" target="_blank">Read More</a>
                </div>
            </div>
        </div>
        <?php } } ?>
        <div class="row pt-5">
            <div class="col-md-12">
               <?php if(isset($pagination) && $pagination != "") { ?>
                    <div class="row pagination-main float-end news-pagination">
                        <div class="col-md-12">
                            <nav aria-label="Page navigation example">
                                <?php echo $pagination ?>
                            </nav>
                        </div>
                     <!--   <div class="col-md-3">
                            <p>Page <?php echo $currentpage . " of " . $lastpage; ?></p>
                        </div> -->
                    </div>
                <?php }  ?>
                        
            </div>
        </div>
    </div>
</div>

<?php include('footer.php')?>
