<?php
function pagination1($rows_per_page = 5, $sql)
{
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $per_row = $page * $rows_per_page - $rows_per_page;

    $sql .= " LIMIT $per_row, $rows_per_page";
    $query = mysqli_query($conn, $sql);
    return $query;
}

function listPages($ul = '<ul class="pagination">', $pre_li = '<li class="page-item"><a class="page-link"' , $link="product")
{
    $list_pages = $ul;

    // Page Prev
    $page_prev = $page - 1;
    if ($page_prev == 0) {
        $page_prev = 1;
    }
    $list_pages .= $pre_li.' href="index.php?page_layout='.$link.'&page=' . $page_prev . '">&laquo;</a></li>';

    for ($i = 1; $i <= $total_pages; $i++) {

        $list_pages .= ''.$pre_li.' href="index.php?page_layout='.$link.'&page=' . $i . '">' . $i . '</a></li>';
    }

    // Page Next
    $page_next = $page + 1;
    if ($page_next > $total_pages) {
        $page_next = $total_pages;
    }
    $list_pages .= ''.$pre_li.' href="index.php?page_layout='.$link.'&page=' . $page_next . '">&raquo;</a></li>';
    $list_pages .= '</ul>';
    return $list_pages ;
}

?>


