<?php
// Параметры плагина
add_option('simple_basket_buynow_caption', __('Buy', 'simple_basket'));
add_option('simple_basket_order_page', '');
add_option('simple_basket_catalog_price', __('Price', 'simple_basket'));
add_option('simple_basket_delivery', '0');
add_option('simple_basket_delivery_default', '0');
add_option('simple_basket_google_analytics_mode', '0');
add_option('simple_basket_order_compete_virtual_page', '');
add_option('simple_basket_conformation_email_post', '');
add_option('simple_basket_conformation_email_subject', '');
add_option('simple_basket_admin_email_post', '');
add_option('simple_basket_admin_email_subject', '');


// Принимаем данные
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (isset($_POST['bc_position']))
		update_option('bc_position', $_POST['bc_position']);

	if (isset($_POST['orderpage']))
		update_option('simple_basket_order_page', $_POST['orderpage']);

	if (isset($_POST['pricefield']))
		update_option('simple_basket_catalog_price', $_POST['pricefield']);

	if (isset($_POST['deliverymode']))
		update_option('simple_basket_delivery', '1');
	else
		update_option('simple_basket_delivery', '0');

	if (isset($_POST['deliveryplan']))
		update_option('simple_basket_delivery_default', $_POST['deliveryplan']);

	if (isset($_POST['googleanalyticsmode']))
		update_option('simple_basket_google_analytics_mode', $_POST['googleanalyticsmode']);

	if (isset($_POST['ordercompletevirtualvage']))
		update_option('simple_basket_order_compete_virtual_page', $_POST['ordercompletevirtualvage']);


	if (isset($_POST['confirmationEmailSubject']))
		update_option('simple_basket_conformation_email_subject', $_POST['confirmationEmailSubject']);
	if (isset($_POST['confirmemail']))
		update_option('simple_basket_conformation_email_post', $_POST['confirmemail']);

	if (isset($_POST['adminEmailSubject']))
		update_option('simple_basket_admin_email_subject', $_POST['adminEmailSubject']);
	if (isset($_POST['adminemail']))
		update_option('simple_basket_admin_email_post', $_POST['adminemail']);

}


// Для списка SELECT
?>
<div id="simple_basket">
	<h1><?php
		_e('Breadcrumbs', 'breadcrumbs');
		?></h1>
    <h3><?php _e('Settings')?></h3>
	<form method="post" action="">
		<div id="bc-main-container">
			<div id="bs-section">
				<fieldset>
					<?php $bc_position = 'left' ?>
					<?php if(get_option('bc_position'))$bc_position=get_option('bc_position'); ?>
					<?php var_dump(get_option('bc_position')); ?>
					<legend><?php _e('Breadcrumbs position', 'breadcrumbs')?></legend>
					<div class="control">
						<label for="left_position"><?php _e('Left position', 'breadcrumbs')?></label>
						<input
                                id="left_position"
                                class="textString"
                                type="radio"
                                name="name_position"
                                <?= $bc_position=='left'?'checked': ''?>
                                value="left" />
                        <br>
                        <label for="right_position"><?php _e('Right position', 'breadcrumbs')?></label>
						<input id="right_position" class="textString" type="radio" name="name_position" <?= $bc_position=='right'?'checked': ''?> value="right" />
                        <br>
                        <label for="center_position"><?php _e('Center position', 'breadcrumbs')?></label>
						<input id="center_position" class="textString" type="radio" name="name_position" <?= $bc_position=='center'?'checked': ''?> value="center" />
						<p><?php _e('Choose a position for bread crumbs', 'breadcrumbs')?></p>
                        <script>

                            $('#bs-section input').change(function () {
                                // console.log($(this).prop());
                                console.log($(this).val());
                                console.log($(this).is());
                                // console.log($(this).attr());
                            });
                        </script>
					</div>
<!--					<div class="control">-->
<!--						<label for="orderPage">--><?php //_e('Order Page', 'simple_basket')?><!--</label>-->
<!--						<input id="orderPage" class="textString" type="text" name="orderpage" value="--><?php //echo get_option('simple_basket_order_page'); ?><!--" />-->
<!--						<p>--><?php //_e('This parameter specifies the URL of page contains order form. To display thу order form use shortcode [basket-order-form]', 'simple_basket')?><!--</p>-->
<!--					</div>-->
<!--				</fieldset>-->
<!--				<fieldset>-->
<!--					<legend>--><?php //_e('Product Catalog', 'simple_basket')?><!--</legend>-->
<!--					<div class="control">-->
<!--						<label for="priceCustomFiled">--><?php //_e('Price Custom Field', 'simple_basket')?><!--</label>-->
<!--						<input id="priceCustomFiled" class="textString" type="text" name="pricefield" value="--><?php //echo get_option('simple_basket_catalog_price'); ?><!--" />-->
<!--						<p>--><?php //_e('This parameter specifies the name of product custom field that contains the price.', 'simple_basket')?><!--</p>-->
<!--					</div>-->
<!--				</fieldset>-->

			</div><!--/tabSBMain-->
		</div><!--/tabSB-->
		<div>
			<button class="button button-primary" type="submit"><?php _e('Update settings', 'breadcrumbs')?></button>
		</div>
	</form>
</div>