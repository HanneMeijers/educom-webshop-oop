<?php
function connectToDatabase () {
    $servername = "127.0.0.1"; // ip adres van de "localhost";
    $username = "WebShopUser";
    $password = "Eemnes11!";
    $dbname = "webshop_hanne";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    checkConnection ($conn);
    return $conn;
}

function checkConnection ($conn) {
if (!$conn) {
  throw new Exception("connection with database has failed" . mysqli_connect_error());
}
}
function checkResult ($conn, $result, $sql) {
    if ($result === false) {
        throw new Exception("query failed. sql: ". $sql. " Error: ". mysqli_error($conn));
    }
}

function closeDatabase ($conn) {
    mysqli_close($conn); 
}

function findUserByEmail ($email) {
    $userArray = null;
    $conn = connectToDatabase();
    try {
        $email = mysqli_real_escape_string($conn, $email);
        
        $sql = "SELECT id, name, email, password FROM users WHERE email = '$email'"; 
        $result = mysqli_query($conn, $sql);
        checkResult($conn, $result, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $userArray = mysqli_fetch_assoc($result);
        } 
        return $userArray;
    }
    finally {
        closeDatabase($conn);
    }
}

function saveUser ($email, $name, $password) {
    $conn = connectToDatabase();
    try {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        $sql = "INSERT INTO users (name, email , password)
                    VALUES ('$name', '$email', '$password')";

        $result = mysqli_query($conn, $sql);
        checkResult($conn, $result, $sql);
    }
    finally {
        closeDatabase($conn);
    }
}

function getAllProducts () {
    $productsArray = Array ();
    $conn = connectToDatabase();
    try {
        $sql = "SELECT id, name, img_url, price_per_one FROM products"; 
        $result = mysqli_query($conn, $sql);
        checkResult($conn, $result, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $productsArray [$id] = $row;
            }
        }
        return $productsArray;
    }    
    finally {
        closeDatabase($conn);
    }
}

function getProductById ($productId) {
    $productArray = null;
    $conn = connectToDatabase();
    try {
        $sql = "SELECT * FROM products WHERE id = '$productId'"; 
        $result = mysqli_query($conn, $sql);
        checkResult($conn, $result, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $productArray = mysqli_fetch_assoc($result);
        } 
        return $productArray;
    }
    finally {
        closeDatabase($conn);
    }
}

function storeOrder ($userId, $shoppingCartRows) {
    $conn = connectToDatabase();
    try {
        // insert met invoice number 2022000000
        $invoiceNumber = date("Y")."000000";
        $sql = "INSERT INTO invoice (invoice_number, user_id, `date`)
                             VALUES ($invoiceNumber, $userId, CURRENT_DATE())";
        var_dump($sql);
        $result = mysqli_query($conn, $sql);
        checkResult($conn, $result, $sql);
        $invoiceId = mysqli_insert_id($conn);
        
        // zoek grootste invoice number
        $sql="SELECT MAX(invoice_number) FROM `invoice`";
        $result = mysqli_query($conn, $sql);
        checkResult($conn, $result, $sql);
        $maxInvoiceNumber = mysqli_fetch_row($result)[0];
        
        // update ons record met max invoice number + 1
        $sql = "UPDATE invoice SET invoice_number = ".($maxInvoiceNumber + 1)." WHERE id = $invoiceId";
        $result = mysqli_query($conn, $sql);
        checkResult($conn, $result, $sql);
        
        foreach ($shoppingCartRows as $shoppingCartRow) {
           $sql = "INSERT INTO invoice_line (product_id, invoice_id, quantity, sale_price) 
                        VALUES (".$shoppingCartRow['productid'].",".$invoiceId.", ".$shoppingCartRow['quantity'].", '".$shoppingCartRow['price_per_one']."')";
            $result = mysqli_query($conn, $sql);
            checkResult($conn, $result, $sql);
        }
        $invoiceArray = null;
        $sql = "SELECT invoice.invoice_number, users.email 
                FROM invoice
                JOIN users ON users.id = invoice.user_id
                WHERE invoice.id = $invoiceId"; 
        $result = mysqli_query($conn, $sql);
        checkResult($conn, $result, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $invoiceArray = mysqli_fetch_assoc($result);
        } 
        return $invoiceArray;
    }
    finally {
        closeDatabase($conn);
    }
}