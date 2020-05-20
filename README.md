
# Magento 2 Module Gaiterjones AjaxButton

## A Multipurpose Ajax Button for Magento 2

Easily configurable to perform any click/action tasks in Magento using Ajax calls.

    <block class="Gaiterjones\AjaxButton\Block\AjaxButton" name="gj-ajaxbutton-helloworld" template="Gaiterjones_AjaxButton::ajaxbutton.phtml"></block>

The examples here shows a simple hello world button and two add to cart buttons, the first using a standard product view and the second using a button to add multiple products to the cart with one click.

[https://magento2.gaiterjones.com/en/gaiterjones-dev/ajax-button.html](https://magento2.gaiterjones.com/en/gaiterjones-dev/ajax-button.html)

## Installation

### Git

 - Git clone to `app/code/Gaiterjones/AjaxButton`
 - Enable the module by running `php bin/magento module:enable Gaiterjones_AjaxButton`
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration

To create your own custom button you can use

           <block class="Gaiterjones\AjaxButton\Block\AjaxButton" name="myajaxbutton" template="Gaiterjones_AjaxButton::ajaxbutton.phtml">
           <arguments>
               <argument name="ajaxbuttonid" xsi:type="string">1</argument>
               <argument name="button_name" xsi:type="string">My Button Name</argument>
               <argument name="button_template" xsi:type="string">customproduct</argument>
               <argument name="button_class" xsi:type="string">mybuttonclass</argument>
               <argument name="button_data" xsi:type="array">
                   <item name="mybuttondata" xsi:type="boolean">true</item>
               </argument>
               <argument name="action_template" xsi:type="string">mycustomactiontemplate</argument>
           </arguments>
         </block>

or

        $ajaxButton = $this->getLayout()
        ->createBlock(
            "Gaiterjones\AjaxButton\Block\AjaxButton",
            myajaxbutton",
            [
                'data' => [
                    'button_name' => 'My Button Name',
                    'button_class' => 'mybuttonclass',
                    'action_template' => 'mycustomactiontemplate',
                    'action_data' => [
                        'mybuttondata' => true
                    ]
                ]
            ]
        )
        ->toHtml();


Arguments

ajaxbuttonid - the id of the button
button_name - text shown on button
button_class - css class of button
button_template - frontend/templates/buttons/ template file for creating the button data
button_data - data passed to button template
action_template - frontend/templates/actions/ template file for creating the action data when button is clicked
action_data - data passed to action template

This example will add products id 1, 2, 3, 4, 5 to the cart.

         <block class="Gaiterjones\AjaxButton\Block\AjaxButton" name="gj-ajaxbutton-addproductstocart" template="Gaiterjones_AjaxButton::ajaxbutton.phtml">
           <arguments>
               <argument name="ajaxbuttonid" xsi:type="string">1</argument>
               <argument name="button_name" xsi:type="string">Multi Product Add To Cart Button</argument>
               <argument name="button_class" xsi:type="string">product</argument>
               <argument name="button_template" xsi:type="string">default</argument>
               <argument name="action_template" xsi:type="string">addproductstocart</argument>
               <argument name="action_data" xsi:type="array">
                   <item name="addtocart" xsi:type="boolean">true</item>
                   <item name="productids" xsi:type="string">1,2,3,4,5</item>
               </argument>
           </arguments>
       </block>

See example product layout xml for all demo button examples.
