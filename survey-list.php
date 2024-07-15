<?php
require_once("survey/classes/cls-survey.php");

$obj_survey = new Survey();

/**********All Questions***************/


$adjacents = 3;
$targetpage = SITEPATHFRONT . 'survey-list?';

/* Setup page vars for display. */
$total = 0;
$currentpage = 1;
//echo $_REQUEST['limit'];
if (isset($_REQUEST['limit'])) {
    $limit = $_REQUEST['limit'];
} else {
    $limit = 8;
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

#Get Total Report Count

$fields_survey= "*";
$condition_survey = "`tbl_survey`.`status` = 'Active' AND `tbl_survey`.`survey_status` = 'Published'";

$all_surveys_details = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, '', '', 0);
$total = count($all_surveys_details);

$sort_by = "`tbl_survey`.`s_id` DESC";
$all_surveys = $obj_survey->getSurveyDetail($fields_survey, $condition_survey, $sort_by, "$start, $limit", 0);

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
$page = "contactus";
$page_title = "Avira Surveys – Survey List - " . SITETITLE;
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
<section class="ptb">
    <!--<a href="https://www.software-intent.com/survey-list?limit=8&amp;page=limit=8&amp;page=2"><li class="page-item list-unstyled" style="margin-top: 30rem;position: absolute;font-size: 7rem;left: 3rem;">&lt;</li></a>-->
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h1 class="ttl">Survey List</h1>
            </div>
            <!--<div class="col-md-3">-->
            <!--    <form class="d-flex">-->
            <!--        <input class="form-control search-holder" type="search" placeholder="Search For....." aria-label="Search">-->
            <!--        <button class="btn search-btn" type="submit">-->
            <!--            <i class="fa fa-search"></i>-->
            <!--        </button>-->
            <!--    </form>-->
            <!--</div>-->
            <!--<div class="col-md-3">-->
            <!--    <form class="d-flex">-->
            <!--        <div class="select-opt">-->
            <!--          <select>-->
            <!--            <option value="1">Search By Category</option>-->
            <!--            <option value="2">Category 1</option>-->
            <!--            <option value="3">Category 2</option>-->
            <!--            <option value="4">Category 3</option>-->
            <!--            <option value="5">Category 4</option>-->
            <!--          </select>-->
            <!--        </div>-->
            <!--    </form>-->
            <!--</div>-->
        </div>
        <div class="row pt-5">
            <?php foreach($all_surveys as $all_survey){
                  $dat=explode(" ",$all_survey['created_at']);
                  $dat1=date_create($dat[0]);
                  $survey_url = strtolower($all_survey['survey_title']);
                  $survey_url = str_replace(' ', '-', $survey_url); 
            ?>
            
            <?php
              $condition_response = "`tbl_response_user`.`survey_id` = '".$all_survey['survey_id']."'";
              $all_related_survey_response=$obj_survey->getSurveyUser('', $condition_response, '', '', 0);
              $cnt_que_res = count($all_related_survey_response);
            ?>
            <div class="col-xl-3 col-md-6">
                <div class="box-shadow rounded mb-4 survey-main ht-30">
                    <a href="<?php echo SITEPATHFRONT;?>survey-view/<?php echo $all_survey['survey_id'];?>/<?php echo $survey_url; ?>">
                    <div class="survey-main-data active">
                        <!--<p><?php // echo $all_survey['survey_title'];?></p>-->
                         <p><?php if($all_survey['survey_title']!=""){ if(strlen(stripslashes($all_survey['survey_title']))>90) { echo substr(stripslashes($all_survey['survey_title']), 0, 90) . "..."; } else { echo stripslashes($all_survey['survey_title']); }} else { echo "..."; } ?></p>
                    </div>
                    </a>
                    <div class="d-time-main">
                        <div class="d-time">
                            <p class="fw-bold">Start Date:</p>
                            <p><?php echo date_format($dat1,"j M, Y");?></p>
                        </div>
                        <div class="d-time">
                            <p class="fw-bold">End Date:</p>
                            <p class="end-date">Going on</p>
                        </div>
                        <!--<div class="d-time">-->
                        <!--    <p class="fw-bold">Respondents:</p>-->
                        <!--    <p class="resp-count"><?php echo $cnt_que_res; ?></p>-->
                        <!--</div>-->
                    
                        <div class="survey-btn">
                            <a href="<?php echo SITEPATHFRONT;?>survey-view/<?php echo $all_survey['survey_id'];?>/<?php echo $survey_url; ?>" class="gradient-border btn">Start Survey</a>
                                <?php if($all_survey['take_away']!=""){ ?>
                                    <a href="#" class="cta-btn btn m-0" data-bs-toggle="modal" data-bs-target="#give-away_<?php echo $all_survey['survey_id']; ?>">Give Away</a>
                                <?php } ?>
                        </div>
                    </div>
                    
                </div>
            </div>
            
<!---give-away-Modal--->
<div class="modal fade" id="give-away_<?php echo $all_survey['survey_id']; ?>" tabindex="-1" aria-labelledby="give-away" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered take-away-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $all_survey['survey_title'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <p><?php echo $all_survey['take_away']; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>            
            
            <?php }?>
            
        </div>
        <div class="row pt-5">
            <div class="col-md-12">
               <?php if(isset($pagination) && $pagination != "") { ?>
                    <div class="row pagination-main float-end">
                        <div class="col-md-12">
                            <nav aria-label="Page navigation example">
                                <?php echo $pagination ?>
                            </nav>
                        </div>
                     <!--   <div class="col-md-3">
                            <p>Page <?php echo $currentpage . " of " . $lastpage; ?></p>
                        </div> -->
                    </div>
                <?php } ?>
                        
            </div>
        </div>
    </div>
    <!--<a href="https://www.software-intent.com/survey-list?limit=8&amp;page=limit=8&amp;page=2"><li class=" list-unstyled" style="
    margin-top: -37rem;
    font-size: 8rem;
    position: absolute;
    margin-left: 128rem;
">&gt;</li></a>-->
</section>

<?php include('footer.php')?>
<script>
    MakeMenuActive("survey-list");
</script>
<script>
    window.onscroll = function () {
    changeHeader();
    };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;
    
    function changeHeader() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>