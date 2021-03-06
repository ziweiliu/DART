<?php

class customer
{
//this function takes the mysql customers table and changes it into a JS array for search and output purposes (to search without server connection)
    public static function parseCustomers($con)
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

    public static function generateStateSelect($name, $con)
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

    public static function getDocumentInfo($doc_id)
    {
        global $con;
        $sql = "SELECT customers.cust_id, firstName, lastName, nickName, uscID, classification, email, filename, startDate, endDate, longTerm, file_submit_date, file_exp_date, review_status, review_date, deny_reason, comment FROM customers_doc, customers WHERE document_id = $doc_id AND customers_doc.cust_id = customers.cust_id";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            exit (mysqli_error($con));
        }
        $array_info = mysqli_fetch_assoc($result);
        return $array_info;
    }

    public static function to_JS($customers)
    {
        $arrayCustomers = json_encode($customers);
        ?>
        <script>
            var arrayCustomers = <?php echo $arrayCustomers; ?>; // this creates the JSON
            console.log(arrayCustomers);
        </script>
    <?php
    }
    public static function getCustomerInfo($cust_id){
        global $con;
        $sql = "SELECT * FROM customers, customers_addr WHERE customers.cust_id = $cust_id AND customers_addr.cust_id = customers.cust_id";
        $result = mysqli_query($con, $sql);
        $array_info = mysqli_fetch_assoc($result);
        return $array_info;
    }
    public static function getAlLDocuments($cust_id){
        global $con;
        $array_info = array();
        $sql = "SELECT * FROM customers_doc WHERE cust_id=$cust_id";
        $result = mysqli_query($con, $sql);
        while ($r = mysqli_fetch_assoc($result)){
            array_push($array_info, $r);
        }
        return $array_info;
    }
}