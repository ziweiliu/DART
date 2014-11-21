<?php
//this function takes the mysql customers table and changes it into a JS array for search and output purposes (to search without server connection)
function parseCustomers($con){
    global $con;
    $r = mysqli_query($con, "SELECT * FROM customers");
    if (!$r){
        echo mysqli_error($con);
    }
    $customers = [];
    while ($row = mysqli_fetch_assoc($r)) {
        array_push($customers, $row);
    }
    return $customers;
}
function to_JS($customers){
    $arrayCustomers = json_encode($customers);
    ?>
    <script>
        var arrayCustomers = <?php echo $arrayCustomers; ?>; // this creates the JSON
        console.log(arrayCustomers);
    </script>
<?php
}
function test_input($data) {
    global $con;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($con,$data);
    return $data;
}

