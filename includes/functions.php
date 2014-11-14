<?php
    include_once('db_connect.php');
?>
<script>
//this function takes the mysql customers table and changes it into a JS array for search and output purposes (to search without server connection)
function parseCustomers(){
    //this creates an object
    var arrayCustomers = [];
    <?php
    $r = mysqli_query($con, "SELECT * FROM customers");
    $i = 0;
    while ($row = mysqli_fetch_array($r)){
    ?>
    arrayCustomers[<?php echo $i; ?>] = {
        <?php
        echo "firstName: '". $row['firstName']."',";
        echo "nickName: '". $row['nickName']."',";
        echo "lastName: '". $row['lastName']."',";
        echo "universityID: '". $row['uscID']."',";
        echo "phone: '". $row['cell']."',";
        echo "email: '". $row['email']."',";
        echo "startDate: '". $row['startDate']."',";
        echo "endDate: '". $row['endDate']."'";
        $i++;
        ?>
    };
    <?php
    }
    ?>
    return arrayCustomers;
}
</script>
<?php

?>