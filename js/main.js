var DIR = "http://localhost:8080/DART"

var timeslots = [];
timeslots[1]="9:00 AM";
timeslots[2]="9:10 AM";
timeslots[3]="9:20 AM";
timeslots[4]="9:30 AM";
timeslots[5]="9:40 AM";
timeslots[6]="9:50 AM";
timeslots[7]="10:00 AM";
timeslots[8]="10:10 AM";
timeslots[9]="10:20 AM";
timeslots[10]="10:30 AM";
timeslots[11]="10:40 AM";
timeslots[12]="10:50 AM";
timeslots[13]="11:00 AM";
timeslots[14]="11:10 AM";
timeslots[15]="11:20 AM";
timeslots[16]="11:30 AM";
timeslots[17]="11:40 AM";
timeslots[18]="11:50 AM";
timeslots[19]="12:00 PM";
timeslots[20]="12:10 PM";
timeslots[21]="12:20 PM";
timeslots[22]="12:30 PM";
timeslots[23]="12:40 PM";
timeslots[24]="12:50 PM";
timeslots[25]="1:00 PM";
timeslots[26]="1:10 PM";
timeslots[27]="1:20 PM";
timeslots[28]="1:30 PM";
timeslots[29]="1:40 PM";
timeslots[30]="1:50 PM";
timeslots[31]="2:00 PM";
timeslots[32]="2:10 PM";
timeslots[33]="2:20 PM";
timeslots[34]="2:30 PM";
timeslots[35]="2:40 PM";
timeslots[36]="2:50 PM";
timeslots[37]="3:00 PM";
timeslots[38]="3:10 PM";
timeslots[39]="3:20 PM";
timeslots[40]="3:30 PM";
timeslots[41]="3:40 PM";
timeslots[42]="3:50 PM";
timeslots[43]="4:00 PM";
timeslots[44]="4:10 PM";
timeslots[45]="4:20 PM";
timeslots[46]="4:30 PM";
timeslots[47]="4:40 PM";
timeslots[48]="4:50 PM";

var locations = [];
locations[1]="ALM";
locations[2]="GER";
locations[3]="ASC";
locations[4]="PRB";
locations[5]="BHE";
locations[6]="BIT";
locations[7]="BSR";
locations[8]="BKS";
locations[9]="ADM";
locations[10]="BRI";
locations[11]="SCA";
locations[12]="DCC";
locations[13]="PSA";
locations[14]="CML";
locations[15]="DRC";
locations[16]="ESH";
locations[17]="EVK";
locations[18]="MRF";
locations[19]="FLT";
locations[20]="GFS";
locations[21]="AHF";
locations[22]="HER";
locations[23]="HOH";
locations[24]="PSX";
locations[25]="JHH";
locations[26]="HRC";
locations[27]="IRC";
locations[28]="RRI";
locations[29]="JEF";
locations[30]="JMC";
locations[31]="JEP";
locations[32]="KAP";
locations[33]="LAW";
locations[34]="LVL";
locations[35]="ACC";
locations[36]="RGL";
locations[37]="WAH";
locations[38]="LRC";
locations[39]="DMT";
locations[40]="DXM";
locations[41]="MRF";
locations[42]="MHP";
locations[43]="SGM";
locations[44]="NEW";
locations[45]="DEN";
locations[46]="NRC";
locations[47]="OHE";




function logOut(){
    alert("Logged Out");
}
//this function takes the arrayCustomers parsed by "parseCustomers()" function in customer_functions.php and outputs the list of customers matching the criteria
//To-do: add "click" functionalities using _POST?
function displayCustomers(arrayCustomers){
    //gets the search criteria, if any
    var t = document.getElementById('inputSearchCustomer').value;
    var historical = document.getElementById('inputDisplayPast').checked;
    var currDate = new Date();
    //table headers
    var outputString = "<table><tr><th>First Name</th><th>Nick Name</th><th>Last Name</th><th>ID Number</th><th>Phone Number</th><th>E-mail Address</th><th>Start Date</th><th>End Date</th></tr>";
    //if there's no search text, display all
    if (t.length === 0){
        for (var i = 0; i < arrayCustomers.length; i++){
            var d = arrayCustomers[i].endDate.split(/[-]/);
            var endDate = new Date(d[0], d[1]-1, d[2]);
            if (historical === false){
                if (endDate >= currDate){
                    outputString = outputString + "<tr data-href='" + DIR + "/customer/viewCustomer/?cust_id=" + arrayCustomers[i].cust_id + "'><td>" + arrayCustomers[i].firstName + "</td><td>"+ arrayCustomers[i].nickName + "</td><td>"+ arrayCustomers[i].lastName + "</td><td>"+ arrayCustomers[i].uscID + "</td><td>"+ arrayCustomers[i].cell + "</td><td>"+ arrayCustomers[i].email + "</td><td>"+ arrayCustomers[i].startDate + "</td><td>" + arrayCustomers[i].endDate + "</td></tr>";
                }
            }
            else {
                outputString = outputString + "<tr data-href='" + DIR + "/customer/viewCustomer/?cust_id=" + arrayCustomers[i].cust_id + "'><td>" + arrayCustomers[i].firstName + "</td><td>"+ arrayCustomers[i].nickName + "</td><td>"+ arrayCustomers[i].lastName + "</td><td>"+ arrayCustomers[i].uscID + "</td><td>"+ arrayCustomers[i].cell + "</td><td>"+ arrayCustomers[i].email + "</td><td>"+ arrayCustomers[i].startDate + "</td><td>" + arrayCustomers[i].endDate + "</td></tr>";
            }
        }       
    }
    //if there's search text, loops it through to check if it matches ANY field
    else {
        for (var i = 0; i < arrayCustomers.length; i++){
            var d = arrayCustomers[i].endDate.split(/[-]/);
            var endDate = new Date(d[0], d[1]-1, d[2]);
            if (arrayCustomers[i].firstName.toLowerCase().indexOf(t)>= 0 ||arrayCustomers[i].nickName.toLowerCase().indexOf(t)>= 0 ||arrayCustomers[i].lastName.toLowerCase().indexOf(t)>= 0 ||arrayCustomers[i].uscID.toLowerCase().indexOf(t)>= 0||arrayCustomers[i].cell.toLowerCase().indexOf(t)>= 0||arrayCustomers[i].email.toLowerCase().indexOf(t)>= 0){
             if (historical === false){
                if (endDate >= currDate){
                    outputString = outputString + "<tr data-href='" + DIR + "/customer/viewCustomer/?cust_id=" + arrayCustomers[i].cust_id + "'><td>" + arrayCustomers[i].firstName + "</td><td>"+ arrayCustomers[i].nickName + "</td><td>"+ arrayCustomers[i].lastName + "</td><td>"+ arrayCustomers[i].uscID + "</td><td>"+ arrayCustomers[i].cell + "</td><td>"+ arrayCustomers[i].email + "</td><td>"+ arrayCustomers[i].startDate + "</td><td>" + arrayCustomers[i].endDate + "</td></tr>";
                }
            }
            else {
                outputString = outputString + "<tr data-href='" + DIR + "/customer/viewCustomer/?cust_id=" + arrayCustomers[i].cust_id + "'><td>" + arrayCustomers[i].firstName + "</td><td>"+ arrayCustomers[i].nickName + "</td><td>"+ arrayCustomers[i].lastName + "</td><td>"+ arrayCustomers[i].uscID + "</td><td>"+ arrayCustomers[i].cell + "</td><td>"+ arrayCustomers[i].email + "</td><td>"+ arrayCustomers[i].startDate + "</td><td>" + arrayCustomers[i].endDate + "</td></tr>";
            }   
            }
        } 
    }
    //finishes the table
    outputString = outputString + "</table>";
    //outputs to the page
    document.getElementById('displayCustomers').innerHTML = outputString;
}