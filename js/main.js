//var DIR = "http://localhost:8080/DART";
var DIR = "http://ziweiliu.student.uscitp.com/DART";//live
//this function takes the arrayCustomers parsed by "parseCustomers()" function in customer_functions.php and outputs the list of customers matching the criteria
//To-do: add "click" functionalities using _POST?
function displayCustomers(arrayCustomers) {
    //gets the search criteria, if any
    var t = document.getElementById('inputSearchCustomer').value;
    var historical = document.getElementById('inputDisplayPast').checked;
    var currDate = new Date();
    //table headers
    var outputString = "<table><tr><th>First Name</th><th>Last Name</th><th>ID Number</th><th>Phone Number</th><th>E-mail Address</th><th>Start Date</th><th>End Date</th></tr>";
    //if there's no search text, display all
    if (t.length === 0) {
        for (var i = 0; i < arrayCustomers.length; i++) {
            var d = arrayCustomers[i].endDate.split(/[-]/);
            var endDate = new Date(d[0], d[1] - 1, d[2]);
            var firstName = arrayCustomers[i].firstName;
            if (arrayCustomers[i].nickName != "") {
                firstName = arrayCustomers[i].nickName;
            }
            if (historical === false) {
                if (endDate >= currDate) {
                    outputString = outputString + "<tr data-href='" + DIR + "/customer/viewCustomer/?cust_id=" + arrayCustomers[i].cust_id + "'><td>" + firstName + "</td><td>" + arrayCustomers[i].lastName + "</td><td>" + arrayCustomers[i].uscID + "</td><td>" + arrayCustomers[i].cell + "</td><td>" + arrayCustomers[i].email + "</td><td>" + arrayCustomers[i].startDate + "</td><td>" + arrayCustomers[i].endDate + "</td></tr>";
                }
            }
            else {
                outputString = outputString + "<tr data-href='" + DIR + "/customer/viewCustomer/?cust_id=" + arrayCustomers[i].cust_id + "'><td>" + firstName + "</td><td>" + arrayCustomers[i].lastName + "</td><td>" + arrayCustomers[i].uscID + "</td><td>" + arrayCustomers[i].cell + "</td><td>" + arrayCustomers[i].email + "</td><td>" + arrayCustomers[i].startDate + "</td><td>" + arrayCustomers[i].endDate + "</td></tr>";
            }
        }
    }
    //if there's search text, loops it through to check if it matches ANY field
    else {
        for (var i = 0; i < arrayCustomers.length; i++) {
            var d = arrayCustomers[i].endDate.split(/[-]/);
            var endDate = new Date(d[0], d[1] - 1, d[2]);
            if (arrayCustomers[i].firstName.toLowerCase().indexOf(t) >= 0 || arrayCustomers[i].nickName.toLowerCase().indexOf(t) >= 0 || arrayCustomers[i].lastName.toLowerCase().indexOf(t) >= 0 || arrayCustomers[i].uscID.toLowerCase().indexOf(t) >= 0 || arrayCustomers[i].cell.toLowerCase().indexOf(t) >= 0 || arrayCustomers[i].email.toLowerCase().indexOf(t) >= 0) {
                if (historical === false) {
                    if (endDate >= currDate) {
                        outputString = outputString + "<tr data-href='" + DIR + "/customer/viewCustomer/?cust_id=" + arrayCustomers[i].cust_id + "'><td>" + firstName + "</td><td>" + arrayCustomers[i].lastName + "</td><td>" + arrayCustomers[i].uscID + "</td><td>" + arrayCustomers[i].cell + "</td><td>" + arrayCustomers[i].email + "</td><td>" + arrayCustomers[i].startDate + "</td><td>" + arrayCustomers[i].endDate + "</td></tr>";
                    }
                }
                else {
                    outputString = outputString + "<tr data-href='" + DIR + "/customer/viewCustomer/?cust_id=" + arrayCustomers[i].cust_id + "'><td>" + firstName + "</td><td>" + arrayCustomers[i].lastName + "</td><td>" + arrayCustomers[i].uscID + "</td><td>" + arrayCustomers[i].cell + "</td><td>" + arrayCustomers[i].email + "</td><td>" + arrayCustomers[i].startDate + "</td><td>" + arrayCustomers[i].endDate + "</td></tr>";
                }
            }
        }
    }
    //finishes the table
    outputString = outputString + "</table>";
    //outputs to the page
    document.getElementById('displayCustomers').innerHTML = outputString;
}

$(document).ready(function () {
    $("tr").on("click", function () {
        if ($(this).data('href') !== undefined) {
            document.location = $(this).data('href');
        }
    });
    $('#inputSearchCustomer').on("keyup", function () {
        displayCustomers(arrayCustomers);
    });
    $('#inputDisplayPast').on("click", function () {
        displayCustomers(arrayCustomers);
    });
});