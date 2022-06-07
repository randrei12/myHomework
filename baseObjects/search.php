<?php 
    if (isset($_GET['searchSubmit']) || isset($_GET['search'])) {
        header('Location: /index.php?q='. $_GET['search']);
    }
    if (isset($_GET['q']) && $_GET['q'] != '') {
        $search = $_GET['q'];
        $searchCondition = 1;
    }
?>