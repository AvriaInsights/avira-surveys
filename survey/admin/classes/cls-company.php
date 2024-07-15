<?php

require_once("cls-connection.php");

class Company extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleReportDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_company', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCompanyDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_company', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getspecCompanydetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_company', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getReportDetailsUpcoming($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_upcoming', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_company` LEFT JOIN `tbl_category` USING (`category_id`) LEFT JOIN `tbl_author` USING (`author_id`)', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getFullReportUpcomingDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_upcoming` LEFT JOIN `tbl_category` USING (`category_id`) LEFT JOIN `tbl_author` USING (`author_id`)', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getFullReportDetailsByBindParam($fields = '', $condition = '',$parameters_array, $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecordsByBindParam('`tbl_company` LEFT JOIN `tbl_category` USING (`category_id`) LEFT JOIN `tbl_author` USING (`author_id`)', $fields, $condition,$parameters_array, $order_by, $limit, $debug);
    }

    public function getCategoryReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_company` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCatReportDetails($fields = '', $condition = '', $group_by = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getFullRecords('`tbl_company` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition, $group_by, $order_by, $limit, $debug);
    }
    /*Company*/
    public function insertCountryRegion($insert_data, $debug = 0) {
        return $this->insertRow("tbl_country_region", $insert_data, $debug);
    }
    
    public function getCountryRegion($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_country_region', $fields, $condition, $order_by, $limit, $debug);
    }
    
   /* public function insertMainIndustry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_main_industry", $insert_data, $debug);
    }
    
    public function getMainIndustry($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_main_industry', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertSecondaryIndustry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_secondary_industry", $insert_data, $debug);
    }
    
    public function getSecondaryIndustry($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_secondary_industry', $fields, $condition, $order_by, $limit, $debug);
    }*/
    
    public function insertBroadMainIndustry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_broad_main_industry", $insert_data, $debug);
    }
    
    public function getBroadMainIndustry($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_broad_main_industry', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertBroadSubIndustry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_broad_sub_industry", $insert_data, $debug);
    }
    
    public function getBroadSubIndustry($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_broad_sub_industry', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getCompanyAge($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_company_age', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getRevenue($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_revenue', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertCompany($insert_data, $debug = 0) {
        return $this->insertRow("tbl_company", $insert_data, $debug);
    }
    
    public function insertUserDownloadActivity($insert_data, $debug = 0) {
        return $this->insertRow("tbl_user_download_activity", $insert_data, $debug);
    }
    
    public function getUserDownloadActivity($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_user_download_activity', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertReportUpcoming($insert_data, $debug = 0) {
        return $this->insertRow("tbl_upcoming", $insert_data, $debug);
    }

    public function deleteReport($condition = '', $debug = 0) {
        $this->deleteRow("tbl_company", $condition, $debug);
    }

    public function updateCompany($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_company", $update_data, $condition, $debug);
    }
    
        public function updateReportUpcoming($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_upcoming", $update_data, $condition, $debug);
    }
    
        public function insertReportFAQ($insert_data, $debug = 0) {
        return $this->insertRow("tbl_faq", $insert_data, $debug);
    }
    
    public function getFullCompanyDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_company` INNER JOIN `tbl_financial` USING (`cmp_id`)', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getAllIndustryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_broad_main_industry` INNER JOIN `tbl_broad_sub_industry` USING (`main_ind_id`)', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getIndustryCompanyDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_industry`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertIndustry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_industry", $insert_data, $debug);
    }
    
    public function getSegmentCompanyDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_segment`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertSegment($insert_data, $debug = 0) {
        return $this->insertRow("tbl_segment", $insert_data, $debug);
    }

    public function insertfinancialdetailofcompany($insert_data, $debug = 0) {
        return $this->insertRow("tbl_financial", $insert_data, $debug);
    }

    public function getFinancialCompanyDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_financial`', $fields, $condition, $order_by, $limit, $debug);
    }
    
     public function getCompanyUser($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_cmp_login', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertCompanyUser($insert_data, $debug = 0) {
        return $this->insertRow("tbl_cmp_login", $insert_data, $debug);
    }
    
    public function insertAnalystSupport($insert_data, $debug = 0) {
        return $this->insertRow("tbl_analyst_user", $insert_data, $debug);
    }
    
    public function updateCompanyLogin($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_cmp_login", $update_data, $condition, $debug);
    }
    
}

?>