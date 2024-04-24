<?php
include 'execute.php';

if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $result_data = execute($_GET['paymentId']);
    $response = json_decode($result_data, true);

    if (isset($response['transactionStatus']) && $response['transactionStatus'] == 'Completed') {
        // Success case
        // db insert operation  
        header("Location: success.php?trxID=" . $response['trxID']);
        exit;
    }
} else {
    header("Location: fail.php");
    exit;
}

?>