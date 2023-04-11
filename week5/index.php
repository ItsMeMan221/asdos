<?php
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'register') {
        include './views/register.php';
    } else if ($_GET['page'] === 'dashboard') {
        include './views/dashboard.php';
    } else if ($_GET['page'] === 'product') {
        include './views/ModifyProduct.php';
    } else if ($_GET['page'] === 'delete') {
        include './views/deleteProduct.php';
    }
} else {
    include './views/login.php';
}