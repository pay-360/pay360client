<form method="POST" action="payment_intent.php">
    <table>
        <tr>
            <td>API Key : </td>
            <td><input type="text" id="user" name="user" required></td>
        </tr>
        <tr>
            <td>API Secret : </td>
            <td><input type="text" id="pass" name="pass" required></td>
        </tr>
        <tr>
            <td>Reference ID : </td>
            <td><input type="text" id="ref_id" name="ref_id" required></td>
        </tr>
        <tr>
            <td></td>
            <td>- Reference ID must be unique</td>
        </tr>
        <tr>
            <td>Currency : </td>
            <td><select id="currency" name="currency" required>
                <option value="">Select Currency</option>
                <option value="MYR" selected>MYR</option>
                <option value="USD">USD</option>
                <option value="CHN">CHN</option>
            </select></td>
        </tr>
        <tr>
            <td>Product : </td>
            <td><input type="text" id="prod_name" name="prod_name" required></td>
        </tr>
        <tr>
            <td></td>
            <td>- eg. Iphone 16 Pro Max</td>
        </tr>
        <tr>
            <td>Unit Amount : </td>
            <td><input type="number" id="unit_amount" name="unit_amount" required></td>
        </tr>
        <tr>
            <td></td>
            <td>- eg. 850.00</td>
        </tr>
        <tr>
            <td>Quantity : </td>
            <td><input type="number" id="quantity" name="quantity" value="1" required></td>
        </tr>
        <tr>
            <td>Mode : </td>
            <td><select id="mode" name="mode" required>
                <option value="">Select Mode</option>
                <option value="credit_card">Credit Card</option>
                <option value="duitnow@b2b">DuitNow B2B</option>
                <option value="duitnow@b2c">DuitNow B2C</option>
            </select></td>
        </tr>
        <tr>
            <td>Email : </td>
            <td><input type="text" id="email" name="email" required></td>
        </tr>
        <tr>
            <td>Success URL : </td>
            <td><input type="text" id="success_url" name="success_url" required></td>
        </tr>
        <tr>
            <td></td>
            <td>- eg. http://localhost/pay360client/success_url</td>
        </tr>
        <tr>
            <td>Cancel URL : </td>
            <td><input type="text" id="cancel_url" name="cancel_url" required></td>
        </tr>
        <tr>
            <td></td>
            <td>- eg. http://localhost/pay360client/cancel_url</td>
        </tr>
        <tr>
            <td>Status URL : </td>
            <td><input type="text" id="status_url" name="status_url" required></td>
        </tr>
        <tr>
            <td></td>
            <td>- eg. http://localhost/pay360client/status_url</td>
        </tr>
        <tr>
            <td><br><input type="submit" value="Submit"></td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
</form>

Credit Card Test Info:
<br>Card Number => 4242 4242 4242 4242
<br>MM/YY => 12/34
<br>CVC => 567
<br>
<br>Duitnow B2B/B2C Test Info:
<br>Select Bank => PYN Bank A
<br>Username => user1
<br>Password => password1