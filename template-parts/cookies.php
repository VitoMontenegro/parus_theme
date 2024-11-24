<?php
    $wishlist = [];

if ($_POST['status']) {
    $wishitem = $_POST['status'];

    $pw ='product[' . $wishitem . ']';

    if (isset($_COOKIE['product'])) {
        foreach ($_COOKIE['product'] as $name => $value) {
            $name = htmlspecialchars($name);
            $value = htmlspecialchars($value);
            $wishlist[$value] = $value;
        }
    }

    if(isset($_COOKIE['product'][$wishitem])) {
        setcookie($pw, $wishitem, time()-3600, '/');
        unset($wishlist[$wishitem]);
    } else {
        setcookie($pw, $wishitem, 0, '/');
        $wishlist[$wishitem] = $wishitem;
    }
    echo json_encode($wishlist);
    exit();
} else {
    if (isset($_COOKIE['product'])) {
        foreach ($_COOKIE['product'] as $name => $value) {
            $name = htmlspecialchars($name);
            $value = htmlspecialchars($value);
            if ($name && $value) {
                $wishlist[$value] = $value;
            }

        }
    }
    echo json_encode($wishlist);
    exit();
}



