<?php
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    require_once 'C:\xampp_new\htdocs\RVHSGAMEJAM2025\private\rvhsgamejam_secrets.inc.php';
} else {
    require_once '../../../private/rvhsgamejam_secrets.inc.php';
}
$conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
// use UTF-8 charset, if not it will cause encoding errors with JSON (iirc)
$conn->set_charset('utf8mb4');

function sqlQueryObject($conn, $stmt, $arg = null) {
    $sqlResult = $conn->execute_query($stmt, $arg);
    if (!$sqlResult) { die(); }
    if ($sqlResult === true) { return; } // statement does not return i.e. INSERT, UPDATE
    $result = $sqlResult->fetch_object();
    $sqlResult->free();
    return $result;
}

function sqlQueryAllObjects($conn, $stmt, $arg = null) {
    $sqlResult = $conn->execute_query($stmt, $arg);
    if (!$sqlResult) { die(); }
    if ($sqlResult === true) { return; } // statement does not return i.e. INSERT, UPDATE
    $result = [];
    while ($row = $sqlResult->fetch_object()) {
        $result[] = $row;
    }
    $sqlResult->free();
    return $result;
}

// function prepared_query($mysqli, $sql, $params, $types = "")
// {
//     $stmt = $mysqli->prepare($sql);
//     $stmt->bind_param($types, ...$params);
//     $stmt->execute();
//     return $stmt;
// }
// class iimysqli_result
// {
//     public $stmt, $nCols, $fields;
// }

// function iimysqli_stmt_get_result($stmt)
// {
//     /**    EXPLANATION:
//      * We are creating a fake "result" structure to enable us to have
//      * source-level equivalent syntax to a query executed via
//      * mysqli_query().
//      *
//      *    $stmt = mysqli_prepare($conn, "");
//      *    mysqli_bind_param($stmt, "types", ...);
//      *
//      *    $param1 = 0;
//      *    $param2 = 'foo';
//      *    $param3 = 'bar';
//      *    mysqli_execute($stmt);
//      *    $result _mysqli_stmt_get_result($stmt);
//      *        [ $arr = _mysqli_result_fetch_array($result);
//      *            || $assoc = _mysqli_result_fetch_assoc($result); ]
//      *    mysqli_stmt_close($stmt);
//      *    mysqli_close($conn);
//      *
//      * At the source level, there is no difference between this and mysqlnd.
//      **/
//     $metadata = mysqli_stmt_result_metadata($stmt);
//     $ret = new iimysqli_result;
//     if (!$ret)
//         return NULL;
//     $fields = $metadata->fetch_fields();
//     $ret->fields = $fields;
//     $ret->nCols = mysqli_num_fields($metadata);
//     $ret->stmt = $stmt;

//     mysqli_free_result($metadata);
//     return $ret;
// }
// function iimysqli_result_fetch_array(&$result)
// {
//     $ret = array();
//     $code = "return mysqli_stmt_bind_result(\$result->stmt ";

//     for ($i = 0; $i < $result->nCols; $i++) {
//         $ret[$i] = NULL;
//         $code .= ", \$ret['" . $i . "']";
//     }
//     ;

//     $code .= ");";
//     if (!eval($code)) {
//         return NULL;
//     }
//     ;

//     // This should advance the "$stmt" cursor.
//     if (!mysqli_stmt_fetch($result->stmt)) {
//         return NULL;
//     }
//     ;

//     // Return the array we built.
//     return $ret;
// }

// function iimysqli_result_fetch_assoc_array(&$result)
// {
//     $ret = array();
//     $code = "return mysqli_stmt_bind_result(\$result->stmt ";
//     $fields = $result->fields;
//     for ($i = 0; $i < $result->nCols; $i++) {
//         $ret[$fields[$i]->name] = NULL;
//         $code .= ", \$ret['" . $fields[$i]->name . "']";
//     }
//     ;

//     $code .= ");";
//     if (!eval($code)) {
//         return NULL;
//     }
//     ;

//     // This should advance the "$stmt" cursor.
//     if (!mysqli_stmt_fetch($result->stmt)) {
//         return 0;
//     }
//     ;

//     // Return the array we built.
//     return $ret;
// }

?>
