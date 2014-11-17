<div id="wrapper">
    <div id="container">
        <?php
            include('includes/header.php');
        ?>
        <div id="content">
            <div id="form">
                <h2>New Customer Registration</h2>
                <form name="newCustomer" method="POST" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                    <label>Salutations:</label>
                    <select name="salutation">
                        <option value="Ms">Ms.</option>
                        <option value="Mrs">Mrs.</option>
                        <option value="Mr">Mr.</option>
                    </select><br />
                    <label>First Name:</label>
                    <input type="text" name="firstName" required /><br />
                    <label>Last Name:</label>
                    <input type="text" name="lastName" required /><br />
                    <label>Middle Name:</label>
                    <input type="text" name="middleName"><br />
                    <label>NickName:</label>
                    <input type="text" name="nickName"><br />
                    <label>USC ID Number:</label>
                    <input type="text" maxlength="10" name="USCID" required /><br />
                    <label>Customer Classification:</label>
                    <select name="classification">
                        <option value="student">Student</option>
                        <option value="faculty">Faculty</option>
                        <option value="staff">Staff</option>
                        <option value="visitor">Guest</option>
                    </select><br />
                    <label>Preferred E-mail Address:</label>
                    <input type="email" name="email" required /><br />
                    <label>Street Address:</label>
                    <input type="text" name="street" required /><br/>
                    <label>Apartment/Suite Number:</label>
                    <input type="text" name="apt"><br/>
                    <label>City:</label>
                    <input type="text" name="city" required /><br/>
                    <label>State:</label>
                    <input type="text" name="state" required /><br/>
                    <label>Zipcode:</label>
                    <input type="text" name="zip" maxlength="5" required /><br/>
                    <label>Cell Number:</label>
                    <input type="text" name="cell1" maxlength="3" size = "3" required /><input type="text" name="cell2" size = "3" maxlength="3" required /><input type="text" name="cell3" size = "4" maxlength="4" required/> <br />
                    <label>Nature of Disability:</label>
                    <textarea row="4" col="100" maxlength="200" name="natureOfDisability" required /></textarea><br />
                    <label>Special Needs or Requests:</label>
                    <textarea row="4" col="100" maxlength="200" name="specialNeeds"></textarea><br />
                    <label>Start Date of Service: </label>
                    <input type="text" name="startDate" id="datepicker1" required/><br />
                    <label>End Date of Service:</label>
                    <input type="text" name="endDate" id="datepicker2" /> <br />
                    <input type="checkbox" name="longTerm" value="1"/>This request is for longer than 60 days and I have explained the situation under Speical Needs or Requests.<br />
                    <span class="warning">All customers are required to submit a valid Doctor's certification. It can be attached electronically here or hand-delivered to the office within five business days of the initial request for services.". </span><br />
                    <label for="file">Filename:</label>
                    <input type="file" name="file" id="file"><br />
                    <input type="checkbox" name="confirm" required/>
                    <span class="warning">I understand that this application does not guarantee service at my requested times and that it might take up to 48 hours for review and approval.</span><br />
                    <input type="submit" name = "submit" value="Submit" />
                </form>
            </div>
        </div>
        <div id="footer">
            footer

        </div>
    </div>
</div>
