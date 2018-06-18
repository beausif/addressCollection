<?php
declare(strict_types=1);

require_once dirname(dirname(dirname(__DIR__))) . '/assets/assets.php';

try {

    $bindings = [];
    $where = "";

    $globalSearch = array();
    $columnSearch = array();
    if (isset($_POST['search']) && $_POST['search']['value'] != '') {
        $str = $_POST['search']['value'];
        for ($i = 0, $ien = count($_POST['columns']); $i < $ien; $i++) {
            $requestColumn = $_POST['columns'][$i];
            if ($requestColumn['searchable'] == 'true') {

                if ($i === 0) {
                    $bindings[':dateAdded'] = "%" . $str . "%";
                    $globalSearch[] = "DATE_FORMAT(dateAdded, '%m/%d/%Y %h:%i%s') LIKE :dateAdded";
                } else if ($i === 1) {
                    $bindings[':address1'] = "%" . $str . "%";
                    $globalSearch[] = "address1 LIKE :address1";
                } else if ($i === 2) {
                    $bindings[':address2'] = "%" . $str . "%";
                    $globalSearch[] = "address2 LIKE :address2";
                } else if ($i === 3) {
                    $bindings[':city'] = "%" . $str . "%";
                    $globalSearch[] = "city LIKE :city";
                } else if ($i === 4) {
                    $bindings[':state'] = "%" . $str . "%";
                    $globalSearch[] = "state LIKE :state";
                } else if ($i === 5) {
                    $bindings[':zip5'] = "%" . $str . "%";
                    $globalSearch[] = "zip5 LIKE :zip5";
                }
            }
        }
    }

    // Combine the filters into a single string
    if (count($globalSearch)) {
        $where = ' WHERE (' . implode(' OR ', $globalSearch) . ')';
    }

    $limit = '';
    if (isset($_POST['start']) && $_POST['length'] != -1) {
        $limit = "LIMIT :limit OFFSET :offset";
        $bindings[':limit'] = intval($_POST['length']);
        $bindings[':offset'] = intval($_POST['start']);
    }

    $order = '';
    if (isset($_POST['order']) && count($_POST['order'])) {
        $orderBy = array();
        for ($i = 0, $ien = count($_POST['order']); $i < $ien; $i++) {
            if ($_POST['columns'][$_POST['order'][$i]['column']]['orderable'] == 'true') {
                $dir = $_POST['order'][$i]['dir'] === 'asc' ?
                    'ASC' :
                    'DESC';

                $columnIndex = intval($_POST['order'][$i]['column']);

                if ($columnIndex === 0) {
                    $orderBy[] = 'dateAdded ' . $dir;
                } else if ($columnIndex === 1) {
                    $orderBy[] = 'address1 ' . $dir;
                } else if ($columnIndex === 2) {
                    $orderBy[] = 'address2 ' . $dir;
                } else if ($columnIndex === 3) {
                    $orderBy[] = 'city ' . $dir;
                } else if ($columnIndex === 4) {
                    $orderBy[] = 'state ' . $dir;
                } else if ($columnIndex === 5) {
                    $orderBy[] = 'zip ' . $dir;
                }
            }
        }
        $order = 'ORDER BY ' . implode(', ', $orderBy);
    }

    $data = $db->queryDatabase(
        "SELECT
            dateAdded,
            address1,
            address2,
            city,
            state,
            IF(zip4 IS NULL, zip5, CONCAT(zip5, '-', zip4)) AS zip
       FROM addresscollection.address
          $where
          $order
          $limit", $bindings);

    // Data set length after filtering
    $resFilterLength = $db->queryDatabase(
        "SELECT COUNT(*) AS count
           FROM addresscollection.address
          $where
          $limit", $bindings);

    // Total data set length
    $resTotalLength = $db->queryDatabase(
        "SELECT COUNT(*) AS count
           FROM addresscollection.address");

    foreach ($data as $key=>$address) {
        $data[$key]['dateAdded'] = (new DateTime($address['dateAdded']))->format('m/d/Y h:i:s A');
    }

    echo json_encode(array(
        "draw" => isset ($request['draw']) ?
            intval($request['draw']) :
            0,
        "recordsTotal" => intval($resTotalLength[0]['count']),
        "recordsFiltered" => intval($resFilterLength[0]['count']),
        "data" => $data
    ));


} catch (Exception $e) {
    if ($db->inTransaction()) {
        $db->rollbackTransaction();
    }

    echo json_encode(array(
        "draw" => isset ($request['draw']) ?
            intval($request['draw']) :
            0,
        "recordsTotal" => intval(0),
        "recordsFiltered" => intval(0),
        "data" => [],
        "error" => $e->getMessage()
    ));
}
