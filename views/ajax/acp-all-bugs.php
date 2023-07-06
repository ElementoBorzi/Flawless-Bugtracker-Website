<?php
include ("../../engine/config.php");

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

$searchArray = array();

## Search 
$searchQuery = "";
if($searchValue != '')
{
	$searchQuery = " AND (title LIKE :title or 
        description LIKE :description OR 
        author LIKE :author ) ";

    $searchArray = array( 
        'title'=>"%$searchValue%", 
        'description'=>"%$searchValue%",
        'author'=>"%$searchValue%"
    );
}


$totalRecords = $Bugs->getTotalRows();

$totalRecordwithFilter = $Bugs->getTotalRowsFilter($searchQuery, $searchArray);

$empRecords = $Bugs->getAllBugs($searchArray, $searchQuery, $columnName, $columnSortOrder, $row, $rowperpage);

$data = array();

foreach($empRecords as $row)
{
    $data[] = array(
        "id"=>$row['id'],
        "title"=>"<a href='?page=acp-view-bug&id=".$row['id']."'>".$Common->customEcho($row['title'], 25)."</a>",
        "description"=>$Common->customEcho($row['description'], 25),
        "post_date"=>$row['post_date'],
        "category"=>$Common->getCategoryName($row['category']),
        "tags"=>$Common->getPriorityName($row['tags']),
        "status"=>$Common->getStatusName($row['status'])
    );
}

$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);