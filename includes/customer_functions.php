<?php
//this function takes the mysql customers table and changes it into a JS array for search and output purposes (to search without server connection)
function parseCustomers($con)
{
    $r = mysqli_query($con, "SELECT * FROM customers");
    if (!$r) {
        echo mysqli_error($con);
    }
    $customers = [];
    while ($row = mysqli_fetch_assoc($r)) {
        array_push($customers, $row);
    }
    return $customers;
}

function to_JS($customers)
{
    $arrayCustomers = json_encode($customers);
    ?>
    <script>
        var arrayCustomers = <?php echo $arrayCustomers; ?>; // this creates the JSON
        console.log(arrayCustomers);
    </script>
<?php
}


function generateStateSelect($name, $con)
{
    $html = "<select name='$name'>";
    $sql = "SELECT * FROM state";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        exit (mysqli_error($con));
    }
    while ($r = mysqli_fetch_array($result)) {
        $html = $html . "<option value = " . $r['abbreviation'] . ">" . $r['name'] . "</option>";
        if ($r['abbreviation'] == "CA") {
            $html = $html . "<option value = " . $r['abbreviation'] . " selected >" . $r['name'] . "</option>";
        }
    }
    $html = $html . "</select>";
    return $html;
}