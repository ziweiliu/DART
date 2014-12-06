<?php
/**
 * Created electrically * User: Angela
 * Date: 12/3/2014
 * Time: 10:08 PM
 */
include_once "db_connect.php";
include_once "customer_functions.php";
class email{
    public static function getCustomerEmail($cust_id){
        global $con;
        $sql = "SELECT email FROM customers WHERE cust_id = $cust_id";
        $result = mysqli_query($con, $sql);
        if(!$result){
            exit (mysqli_error($con));
        }
        $r = mysqli_fetch_array($result);
        return $r['email'];
    }
    public static function sendCustomerEmail($cust_id, $template, $deny_reason=""){
        global $DIR;
        global $con;
        $email = email::getCustomerEmail($cust_id);
        $customerInfo = customer::getCustomerInfo($cust_id);
        $firstName = $customerInfo['firstName'];
        $lastName = $customerInfo['lastName'];
        if ($customerInfo['nickName']!=""){
            $firstName = $customerInfo['nickName'];
        }
        $uscID = $customerInfo['uscID'];

        $to = $email;
        $headers = "From: ziweiliu@usc.edu \r\n";
        $headers .="CC: ziweiliu@usc.edu \r\n";
        $headers .="MIME-Version: 1.0 \r\n";
        $headers .= "Content-Type: text/html; charset= ISO-8859-1 \r\n";
        $subject = "";

        $message = "<html><body>";
        $message .= "<p>$firstName $lastName <br /> USC ID: $uscID <br /></p><p>Dear $firstName, </p>";

        switch ($template){
            case 1://Template for application has been submitted
                $subject = "Application Received";
                $message .= "<p>Thank you for submitting your application to Disability Access to Road Transportation(DART). Your application is now under review and you will be notified within 48 hours. If you did not submit a doctor's note, please note that your application will be on hold until the note is received. </p>";
                $message .="<p>You may now use the link <a href='$DIR'>here </a> to access and select a tentative schedule. Please note that service is not guaranteed until your application is processed.</p>";
                break;
            case 2: //Template for uploading new document
                $subject = "New Document Uploaded";
                $message .= "<p>This is an automatic notification to inform you that your new document has been uploaded. You may check the status of your documents online in the next 24-48 hours. Thank you for submitting your document and we will be in touch shortly.</p>";
                break;
            case 3: //Template for document approved
                $subject = "Document Approved";
                $message .= "<p>This is an automatic notification to inform you that your document has been <strong>approved</strong>. You may check the status of your account online by using the link <a href='$DIR'>here</a>. Thank you for submitting your document.</p>";
                break;
            case 4: //Template for expiring document
                $subject = "[ACTION REQUIRED]Documents Needed";
                $message .= "<p>We have noticed that your Doctor's Note is about to expire. Please note that current documentation is required to continue service. To avoid any interruptions in your service, please upload a new document within <strong>Five Business Days</strong> from this notice. </p>";
                $message .= "<p>You may upload it electronically by accessing your account <a href = '$DIR'>here</a>. Alternatively, the note could be hand delivered to our office located on the bottom floor of Parking Structure X during our hours of operations.</p>";
                $message .= "<p>You will receive a confirmation when your document has been processed. If you no longer need the service, please cancel your account with us online or call us during our operational hours. Thank you. </p>";
                break;
            case 5: //Template for application approval
                $subject = "Application Approved";
                $message .= "<p>Your application has been approved. If you have already selected a schedule, they will now be in effect the next business day. </p>";
                $message .= "<p>If you have not selected your schedule already, you may login to your account <a href='$DIR'>here</a> to select your schedule. </p>";
                break;
            case 6: //Template for application denial
                $subject = "Application Denied";
                $message .="<p>Your recent application to DART has been denied. The following was the reason:</p>";
                $message .="<p><span style='color:red'>$deny_reason</span></p>";
                $message .="<p>If you are missing documentation, you may upload them online. Please contact us if further information is required.</p>";
                break;
            case 7: //Template for document denied
                $subject = "Document Denied";
                $message .="<p>Your recent document submission to DART has been denied. The following was the reason:</p>";
                $message .="<p><span style='color:red'>$deny_reason</span></p>";
                $message .="<p>If you are missing documentation, you may upload them online. Please contact us if further information is required.</p>";
                break;
            case 8: //Template to warn customer of impending end of service
                $subject = "[ACTION REQUIRED]DART Service End Date";
                $message .= "<p>This is an automatic notification that your scheduled service will end in <strong>7 days</strong> as determined by the end date you submitted on your application. Please log onto your account to modify the end date if you would like to extend service.</p>";
                $message .= "<p>Please note that additional documentation may be required to extend service, and service is not guaranteed until the documention has been received.</p>";
                break;

        }
        $sql = "INSERT INTO email_log (cust_id, template_id) VALUES ('$cust_id', '$template')";
        if (!mysqli_query($con, $sql)){
            exit (mysqli_error($con));
        }
        $message .="<p>Sincerely,</p><p>USC DART Services</p>";
        $message .="<hr /><p><span style='font-size: 10px'>If you have received this message in error, please let us know immediately by replying to this email or calling 213-740-3575. We apologize for any inconvenience.</span></p>";
        mail ($to, $subject, $message, $headers);
    }

}