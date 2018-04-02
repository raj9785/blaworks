
        <?php
        echo $this->Form->create("customerData", array('url' => array('plugin' => false, 'controller' => 'users', 'action' => 'ccavenue_post'), 'enctype' => 'multipart/form-data'));
        ?>


        <table width="40%" height="100" border='1' align="center"><caption><font size="4" color="blue"><b>Integration Kit</b></font></caption></table>
        <table width="40%" height="100" border='1' align="center">
            <tr>
                <td>Parameter Name:</td><td>Parameter Value:</td>
            </tr>
            <tr>
                <td colspan="2"> Compulsory information</td>
            </tr>
            <tr>
                <td>TID	:</td><td><input type="text" name="tid" id="tid" readonly /></td>
            </tr>
            <tr>
                <td>Merchant Id	:</td><td><input type="text" name="merchant_id" value="122049"/></td>
            </tr>
            <tr>
                <td>Order Id	:</td><td><input type="text" name="order_id" value="<?php echo rand(10000000,99999999) ?>"/></td>
            </tr>
            <tr>
                <td>Amount	:</td><td><input type="text" name="amount" value="1.00"/></td>
            </tr>
            <tr>
                <td>Currency	:</td><td><input type="text" name="currency" value="INR"/></td>
            </tr>
            <tr>
                <td>Redirect URL	:</td><td><input type="text" name="redirect_url" value="<?php echo WEBSITE_URL; ?>admin/users/ccavenue_success"/></td>
            </tr>
            <tr>
                <td>Cancel URL	:</td><td><input type="text" name="cancel_url" value="<?php echo WEBSITE_URL; ?>admin/users/ccavenue_cancel"/></td>
            </tr>
            <tr>
                <td>Language	:</td><td><input type="text" name="language" value="EN"/></td>
            </tr>
            <tr>
                <td colspan="2">Billing information(optional):</td>
            </tr>
            <tr>
                <td>Billing Name	:</td><td><input type="text" name="billing_name" value="Charli"/></td>
            </tr>
            <tr>
                <td>Billing Address	:</td><td><input type="text" name="billing_address" value="Room no 1101, near Railway station Ambad"/></td>
            </tr>
            <tr>
                <td>Billing City	:</td><td><input type="text" name="billing_city" value="Indore"/></td>
            </tr>
            <tr>
                <td>Billing State	:</td><td><input type="text" name="billing_state" value="MP"/></td>
            </tr>
            <tr>
                <td>Billing Zip	:</td><td><input type="text" name="billing_zip" value="425001"/></td>
            </tr>
            <tr>
                <td>Billing Country	:</td><td><input type="text" name="billing_country" value="India"/></td>
            </tr>
            <tr>
                <td>Billing Tel	:</td><td><input type="text" name="billing_tel" value="7023311807"/></td>
            </tr>
            <tr>
                <td>Billing Email	:</td><td><input type="text" name="billing_email" value="rajesh.kumar@supercabz.com"/></td>
            </tr>
            <tr>
                <td colspan="2">Shipping information(optional)</td>
            </tr>
            <tr>
                <td>Shipping Name	:</td><td><input type="text" name="delivery_name" value="Chaplin"/></td>
            </tr>
            <tr>
                <td>Shipping Address	:</td><td><input type="text" name="delivery_address" value="room no.701 near bus stand"/></td>
            </tr>
            <tr>
                <td>shipping City	:</td><td><input type="text" name="delivery_city" value="Hyderabad"/></td>
            </tr>
            <tr>
                <td>shipping State	:</td><td><input type="text" name="delivery_state" value="Andhra"/></td>
            </tr>
            <tr>
                <td>shipping Zip	:</td><td><input type="text" name="delivery_zip" value="425001"/></td>
            </tr>
            <tr>
                <td>shipping Country	:</td><td><input type="text" name="delivery_country" value="India"/></td>
            </tr>
            <tr>
                <td>Shipping Tel	:</td><td><input type="text" name="delivery_tel" value="9876543210"/></td>
            </tr>
            <tr>
                <td>Merchant Param1	:</td><td><input type="text" name="merchant_param1" value="additional Info."/></td>
            </tr>
            <tr>
                <td>Merchant Param2	:</td><td><input type="text" name="merchant_param2" value="additional Info."/></td>
            </tr>
            <tr>
                <td>Merchant Param3	:</td><td><input type="text" name="merchant_param3" value="additional Info."/></td>
            </tr>
            <tr>
                <td>Merchant Param4	:</td><td><input type="text" name="merchant_param4" value="additional Info."/></td>
            </tr>
            <tr>
                <td>Merchant Param5	:</td><td><input type="text" name="merchant_param5" value="additional Info."/></td>
            </tr>
            <tr>
                <td>Promo Code	:</td><td><input type="text" name="promo_code" value=""/></td>
            </tr>
            <tr>
                <td>Vault Info.	:</td><td><input type="text" name="customer_identifier" value=""/></td>
            </tr>
            <tr>
                <td>Integration Type	:</td><td><input type="text" name="integration_type" value="iframe_normal"/></td>
            </tr>
            <tr>
                <td></td><td><INPUT TYPE="submit" value="CheckOut"></td>
            </tr>
        </table>
   
