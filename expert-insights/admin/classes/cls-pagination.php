<?php

error_reporting(0);

class Pagination {

    var $page = 1;
    var $perPage = 10;
    var $showFirstAndLast = true;
    var $adjacents = 4;

    function generate($array, $perPage = 10) {
        if (!empty($perPage))
            $this->perPage = $perPage;

        if (!empty($_GET['page'])) {
            $this->page = $_GET['page'];
        } else {
            $this->page = 1;
        }

        $this->length = count($array);

        $this->pages = ceil($this->length / $this->perPage);

        $this->start = ceil(($this->page - 1) * $this->perPage);

        return array_slice($array, $this->start, $this->perPage);
    }

    function links($script) {
        $plinks = array();
        $links = array();
        $slinks = array();

        $queryURL = $script;
        if (count($_GET)) {
            foreach ($_GET as $key => $value) {
                if ($key != 'page') {
                    //$queryURL .= '&' . $key . '=' . $value;
                    $queryURL .= "/" . $value;
                }
            }
        }
        
        if (($this->pages) > 1) {
            if ($this->page != 1) {
                if ($this->showFirstAndLast) {
                    $plinks[] = '<li class="nav_btn"> <a href="' . SITEPATH . $queryURL . '/1"> <i class="fa fa-angle-double-left"></i> </a> </li>';
                }
                $plinks[] = ' <li class="nav_btn"><a href="' . SITEPATH . $queryURL . '/' .($this->page - 1) . '"> <i class="fa fa-angle-left"></i> </a> </li>';
            } else {
                $plinks[] = ' <li class="disabled"><a href="#"> <i class="fa fa-angle-left"></i> </a> </li>';
            }
            
            $pmin = ($this->page > $this->adjacents) ? ($this->page - $this->adjacents) : 1;
            $pmax = ($this->page < ($this->pages - $this->adjacents)) ? ($this->page + $this->adjacents) : $this->pages;
            
            for ($j = $pmin; $j <= $pmax; $j++) {
                if ($this->page == $j) {
                    $links[] = ' <li class="active"><a class="selected" style="color: #fff;background-color: #337ab7;">' . $j . '</a></li> ';
                } else {
                    $links[] = '<li> <a href="' . SITEPATH . $queryURL . '/' . $j . '">' . $j . '</a> </li>';
                }
            }


            if ($this->page < $this->pages) {
                $slinks[] = ' <li class="nav_btn"> <a href="' . SITEPATH . $queryURL . '/' . ($this->page + 1) . '"> <i class="fa fa-angle-right"></i> </a> </li>  ';
                if ($this->showFirstAndLast) {
                    $slinks[] = ' <li class="nav_btn"> <a href="' . SITEPATH . $queryURL . '/' . ($this->pages) . '"> <i class="fa fa-angle-double-right"></i> </a> </li> ';
                }
            } else {
                $slinks[] = ' <li class="disabled"><a href="#"> <i class="fa fa-angle-right"></i> </a> </li>';
            }


            return implode(' ', $plinks) . implode($this->implodeBy, $links) . implode(' ', $slinks);
        }
        return;
    }

}

?>
