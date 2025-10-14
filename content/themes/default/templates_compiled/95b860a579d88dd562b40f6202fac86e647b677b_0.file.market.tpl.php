<?php
/* Smarty version 4.3.4, created on 2024-11-06 15:52:41
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/market.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_672b90c9e61f21_21204574',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95b860a579d88dd562b40f6202fac86e647b677b' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/market.tpl',
      1 => 1707770619,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:__svg_icons.tpl' => 8,
    'file:_ads.tpl' => 1,
    'file:__feeds_product.tpl' => 2,
    'file:_no_data.tpl' => 3,
    'file:_addresses.tpl' => 1,
    'file:_order.tpl' => 2,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_672b90c9e61f21_21204574 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/u994747101/domains/ebokoli.com/public_html/vendor/smarty/smarty/libs/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
$_smarty_tpl->_subTemplateRender('file:_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- page header -->
<div class="page-header">
  <img class="floating-img d-none d-md-block" src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/content/themes/<?php echo $_smarty_tpl->tpl_vars['system']->value['theme'];?>
/images/headers/undraw_online_shopping_ga73.svg">
  <div class="circle-2"></div>
  <div class="circle-3"></div>
  <div class="<?php if ($_smarty_tpl->tpl_vars['system']->value['fluid_design']) {?>container-fluid<?php } else { ?>container<?php }?>">
    <h2><?php echo __("Marketplace");?>
</h2>
    <p class="text-xlg"><?php echo __($_smarty_tpl->tpl_vars['system']->value['system_description_marketplace']);?>
</p>
    <div class="row mt20">
      <div class="col-sm-9 col-lg-6 mx-sm-auto">
        <form class="js_search-form" data-handle="market">
          <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder='<?php echo __("Search for products");?>
'>
            <button type="submit" class="btn btn-light"><?php echo __("Search");?>
</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- page header -->

<!-- page content -->
<div class="<?php if ($_smarty_tpl->tpl_vars['system']->value['fluid_design']) {?>container-fluid<?php } else { ?>container<?php }?> sg-offcanvas" style="margin-top: -25px;">

  <div class="position-relative">
    <!-- tabs -->
    <div class="content-tabs rounded-sm shadow-sm clearfix">
      <ul>
        <li <?php if ($_smarty_tpl->tpl_vars['view']->value == '' || $_smarty_tpl->tpl_vars['view']->value == "search" || $_smarty_tpl->tpl_vars['view']->value == "category") {?>class="active" <?php }?>>
          <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market">
            <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"market",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, false);
?>
            <span class="ml5 d-none d-lg-inline-block"><?php echo __("Market");?>
</span>
          </a>
        </li>
        <?php if ($_smarty_tpl->tpl_vars['user']->value->_logged_in) {?>
          <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "cart") {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market/cart">
              <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"products",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
              <span class="ml5 d-none d-lg-inline-block"><?php echo __("Shopping Cart");?>
</span>
            </a>
          </li>
          <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "orders") {?>class="active" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market/orders">
              <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"articles",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
              <span class="ml5 d-none d-lg-inline-block"><?php echo __("Orders");?>
</span>
            </a>
          </li>
          <?php if ($_smarty_tpl->tpl_vars['user']->value->_data['can_sell_products']) {?>
            <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "sales") {?>class="active" <?php }?>>
              <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market/sales">
                <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"monetization",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                <span class="ml5 d-none d-lg-inline-block"><?php echo __("Sales");?>
</span>
              </a>
            </li>
          <?php }?>
        <?php }?>
      </ul>
      <?php if ($_smarty_tpl->tpl_vars['user']->value->_data['can_sell_products']) {?>
        <div class="mt10 float-end">
          <button class="btn btn-md btn-primary d-none d-lg-block" data-toggle="modal" data-url="posts/product.php?do=create">
            <i class="fa fa-plus-circle mr5"></i><?php echo __("Sell New Product");?>

          </button>
          <button class="btn btn-sm btn-icon btn-primary d-block d-lg-none" data-toggle="modal" data-url="posts/product.php?do=create">
            <i class="fa fa-plus-circle"></i>
          </button>
        </div>
      <?php }?>
    </div>
    <!-- tabs -->
  </div>

  <?php if (in_array($_smarty_tpl->tpl_vars['view']->value,array('','search','category'))) {?>

    <div class="row">
      <!-- left panel -->
      <div class="col-md-4 col-lg-3 sg-offcanvas-sidebar">
        <!-- categories -->
        <div class="card">
          <div class="card-body with-nav">
            <ul class="side-nav">
              <?php if ($_smarty_tpl->tpl_vars['view']->value != "category") {?>
                <li class="active">
                  <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market">
                    <?php echo __("All");?>

                  </a>
                </li>
              <?php } else { ?>
                <li>
                  <?php if ($_smarty_tpl->tpl_vars['current_category']->value['parent']) {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market/category/<?php echo $_smarty_tpl->tpl_vars['current_category']->value['parent']['category_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['current_category']->value['parent']['category_url'];?>
">
                      <i class="fas fa-arrow-alt-circle-left mr5"></i><?php echo __($_smarty_tpl->tpl_vars['current_category']->value['parent']['category_name']);?>

                    </a>
                  <?php } else { ?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market">
                      <?php if ($_smarty_tpl->tpl_vars['current_category']->value['sub_categories']) {?><i class="fas fa-arrow-alt-circle-left mr5"></i><?php }
echo __("All");?>

                    </a>
                  <?php }?>
                </li>
              <?php }?>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
                <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "category" && $_smarty_tpl->tpl_vars['current_category']->value['category_id'] == $_smarty_tpl->tpl_vars['category']->value['category_id']) {?>class="active" <?php }?>>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market/category/<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['category']->value['category_url'];?>
">
                    <?php echo __($_smarty_tpl->tpl_vars['category']->value['category_name']);?>

                    <?php if ($_smarty_tpl->tpl_vars['category']->value['sub_categories']) {?>
                      <span class="float-end"><i class="fas fa-angle-right"></i></span>
                    <?php }?>
                  </a>
                </li>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
          </div>
        </div>
        <!-- categories -->
      </div>
      <!-- left panel -->

      <!-- right panel -->
      <div class="col-md-8 col-lg-9 sg-offcanvas-mainbar">

        <?php $_smarty_tpl->_subTemplateRender('file:_ads.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <?php if ($_smarty_tpl->tpl_vars['view']->value == "search") {?>
          <div class="bs-callout bs-callout-info mt0">
            <!-- results counter -->
            <span class="badge rounded-pill badge-lg bg-secondary"><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</span> <?php echo __("results were found for the search for");?>
 "<strong class="text-primary"><?php echo htmlentities($_smarty_tpl->tpl_vars['query']->value,ENT_QUOTES,'utf-8');?>
</strong>"
            <!-- results counter -->
          </div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['view']->value == '' && $_smarty_tpl->tpl_vars['promoted_products']->value) {?>
          <div class="articles-widget-header">
            <div class="articles-widget-title"><?php echo __("Promoted Products");?>
</div>
          </div>
          <div class="row mb20">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['promoted_products']->value, 'post');
$_smarty_tpl->tpl_vars['post']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->do_else = false;
?>
              <?php $_smarty_tpl->_subTemplateRender('file:__feeds_product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('_boosted'=>true), 0, true);
?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['rows']->value) {?>
          <div class="articles-widget-header clearfix">
            <!-- sort -->
            <div class="float-end">
              <div class="dropdown">
                <button type="button" class="btn btn-sm btn-light dropdown-toggle ml10" data-bs-toggle="dropdown" data-display="static">
                  <?php if (!$_smarty_tpl->tpl_vars['sort']->value || $_smarty_tpl->tpl_vars['sort']->value == "latest") {?>
                    <i class="fas fa-bars fa-fw"></i> <?php echo __("Latest");?>

                  <?php } elseif ($_smarty_tpl->tpl_vars['sort']->value == "price-high") {?>
                    <i class="fas fa-sort-amount-down fa-fw"></i> <?php echo __("Price High");?>

                  <?php } elseif ($_smarty_tpl->tpl_vars['sort']->value == "price-low") {?>
                    <i class="fas fa-sort-amount-down-alt fa-fw"></i> <?php echo __("Price Low");?>

                  <?php }?>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <a href="?<?php if ($_smarty_tpl->tpl_vars['distance']->value) {?>distance=<?php echo $_smarty_tpl->tpl_vars['distance']->value;?>
&<?php }?>sort=latest" class="dropdown-item"><i class="fas fa-bars fa-fw mr10"></i><?php echo __("Latest");?>
</a>
                  <a href="?<?php if ($_smarty_tpl->tpl_vars['distance']->value) {?>distance=<?php echo $_smarty_tpl->tpl_vars['distance']->value;?>
&<?php }?>sort=price-high" class="dropdown-item"><i class="fas fa-sort-amount-down fa-fw mr10"></i><?php echo __("Price High");?>
</a>
                  <a href="?<?php if ($_smarty_tpl->tpl_vars['distance']->value) {?>distance=<?php echo $_smarty_tpl->tpl_vars['distance']->value;?>
&<?php }?>sort=price-low" class="dropdown-item"><i class="fas fa-sort-amount-down-alt fa-fw mr10"></i><?php echo __("Price Low");?>
</a>
                </div>
              </div>
            </div>
            <!-- sort -->
            <?php if ($_smarty_tpl->tpl_vars['user']->value->_logged_in && $_smarty_tpl->tpl_vars['system']->value['location_finder_enabled']) {?>
              <!-- location filter -->
              <div class="float-end">
                <div class="dropdown">
                  <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown" data-display="static">
                    <i class="fa fa-map-marker-alt mr5"></i><?php echo __("Location");?>

                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <form class="ptb15 plr15" method="get" action="?">
                      <div class="form-group">
                        <label class="form-label"><?php echo __("Distance");?>
</label>
                        <div>
                          <?php if ($_smarty_tpl->tpl_vars['sort']->value) {?>
                            <input type="hidden" name="sort" value="<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
">
                          <?php }?>
                          <div class="d-grid mb10">
                            <input type="range" class="custom-range" min="1" max="5000" name="distance" value="<?php if ($_smarty_tpl->tpl_vars['distance']->value) {
echo $_smarty_tpl->tpl_vars['distance']->value;
} else { ?>5000<?php }?>" oninput="this.form.distance_value.value=this.value">
                          </div>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><?php if ($_smarty_tpl->tpl_vars['system']->value['system_distance'] == "mile") {
echo __("ML");
} else {
echo __("KM");
}?></span>
                            <input disabled type="number" class="form-control" min="1" max="5000" name="distance_value" value="<?php if ($_smarty_tpl->tpl_vars['distance']->value) {
echo $_smarty_tpl->tpl_vars['distance']->value;
} else { ?>5000<?php }?>" oninput="this.form.distance.value=this.value">
                          </div>
                        </div>
                      </div>
                      <div class="d-grid">
                        <button type="submit" class="btn btn-md btn-primary"><?php echo __("Filter");?>
</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- location filter -->
            <?php }?>
            <div class="articles-widget-title"><?php echo __("Products");?>
</div>
          </div>

          <div class="row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'post');
$_smarty_tpl->tpl_vars['post']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->do_else = false;
?>
              <?php $_smarty_tpl->_subTemplateRender('file:__feeds_product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>

          <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

        <?php } else { ?>
          <?php $_smarty_tpl->_subTemplateRender('file:_no_data.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php }?>
      </div>
      <!-- right panel -->
    </div>

  <?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "cart") {?>

    <div class="card">
      <div class="card-header with-icon">
        <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"products",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
        <?php echo __("Shopping Cart");?>

      </div>
      <div class="card-body page-content">
        <div class="row">
          <!-- Addresses -->
          <div class="col-md-5">
            <div class="section-title mb20">
              <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"map",'class'=>"main-icon mr5",'width'=>"20px",'height'=>"20px"), 0, true);
?>
              <?php echo __("Your Addresses");?>

            </div>
            <?php $_smarty_tpl->_subTemplateRender('file:_addresses.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('_small'=>true), 0, false);
?>
          </div>
          <!-- Addresses -->

          <!-- Shopping Cart -->
          <div class="col-md-7">
            <div class="section-title mb20">
              <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"products",'class'=>"main-icon mr5",'width'=>"20px",'height'=>"20px"), 0, true);
?>
              <?php echo __("Shopping Cart");?>

            </div>
            <div class="heading-small mb20">
              <?php echo __("Items");?>

            </div>
            <div class="pl-md-4">
              <?php if ($_smarty_tpl->tpl_vars['cart']->value['items']) {?>
                <div class="row">
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['items'], 'cart_item');
$_smarty_tpl->tpl_vars['cart_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cart_item']->value) {
$_smarty_tpl->tpl_vars['cart_item']->do_else = false;
?>
                    <div class="col-lg-6">
                      <div class="card product active">
                        <div class="product-image">
                          <div class="product-price">
                            <?php if ($_smarty_tpl->tpl_vars['cart_item']->value['post']['product']['price'] > 0) {?>
                              <?php echo print_money($_smarty_tpl->tpl_vars['cart_item']->value['post']['product']['price']);?>

                            <?php } else { ?>
                              <?php echo __("Free");?>

                            <?php }?>
                          </div>
                          <?php if ($_smarty_tpl->tpl_vars['cart_item']->value['post']['photos_num'] > 0) {?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['cart_item']->value['post']['photos'][0]['source'];?>
">
                          <?php } else { ?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/content/themes/<?php echo $_smarty_tpl->tpl_vars['system']->value['theme'];?>
/images/blank_product.png">
                          <?php }?>
                        </div>
                        <div class="product-info plr15">
                          <div class="product-meta title">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['cart_item']->value['post']['post_id'];?>
" class="title"><?php echo $_smarty_tpl->tpl_vars['cart_item']->value['post']['product']['name'];?>
</a>
                            <?php if ($_smarty_tpl->tpl_vars['cart_item']->value['post']['product']['status'] == "new") {?>
                              <span class="badge bg-info"><?php echo __("New");?>
</span>
                            <?php } else { ?>
                              <span class="badge bg-info"><?php echo __("Used");?>
</span>
                            <?php }?>
                          </div>
                          <div class="mt20">
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-text"><?php echo __("Qty:");?>
</span>
                                <select class="form-select js_shopping-update-cart" name="quantity" data-id="<?php echo $_smarty_tpl->tpl_vars['cart_item']->value['product_post_id'];?>
">
                                  <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 1;
if ($_smarty_tpl->tpl_vars['i']->value <= $_smarty_tpl->tpl_vars['cart_item']->value['post']['product']['quantity']) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= $_smarty_tpl->tpl_vars['cart_item']->value['post']['product']['quantity']; $_smarty_tpl->tpl_vars['i']->value++) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['i']->value == $_smarty_tpl->tpl_vars['cart_item']->value['quantity']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
                                  <?php }
}
?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div>
                            <div class="d-grid">
                              <button type="button" class="btn btn-sm btn-light js_shopping-remove-from-cart" data-id="<?php echo $_smarty_tpl->tpl_vars['cart_item']->value['product_post_id'];?>
">
                                <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"delete",'class'=>"danger-icon",'width'=>"18px",'height'=>"18px"), 0, true);
?>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
              <?php } else { ?>
                <div class="alert alert-info">
                  <?php echo __("Your cart is empty.");?>

                </div>
              <?php }?>
            </div>
            <div class="heading-small mb20">
              <?php echo __("Shipping Address");?>

            </div>
            <div class="pl-md-4">
              <?php if ($_smarty_tpl->tpl_vars['addresses']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addresses']->value, 'address');
$_smarty_tpl->tpl_vars['address']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['address']->value) {
$_smarty_tpl->tpl_vars['address']->do_else = false;
?>
                  <div class="shipping-address">
                    <div class="form-check">
                      <input class="form-check-input js_shipping-address" type="radio" name="shipping_address" id="shipping_address-<?php echo $_smarty_tpl->tpl_vars['address']->value['address_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['address']->value['address_id'];?>
">
                      <label class="form-check-label" for="shipping_address-<?php echo $_smarty_tpl->tpl_vars['address']->value['address_id'];?>
">
                        <strong><?php echo $_smarty_tpl->tpl_vars['address']->value['address_title'];?>
</strong> (<?php echo $_smarty_tpl->tpl_vars['address']->value['address_details'];?>
, <?php echo $_smarty_tpl->tpl_vars['address']->value['address_city'];?>
- <?php echo $_smarty_tpl->tpl_vars['address']->value['address_country'];?>
)
                      </label>
                    </div>
                  </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <!-- error -->
                <div class="alert alert-danger mt15 mb0 x-hidden" id="addresses-error">
                  <?php echo __("Select a shipping address");?>

                </div>
                <!-- error -->
              <?php } else { ?>
                <div class="alert alert-warning">
                  <?php echo __("You have no addresses");?>

                </div>
              <?php }?>
            </div>
            <div class="divider"></div>
            <?php if ($_smarty_tpl->tpl_vars['user']->value->_data['user_wallet_balance'] < $_smarty_tpl->tpl_vars['cart']->value['total']) {?>
              <div class="alert alert-warning mt15 d-block">
                <?php echo __("Your wallet balance is insufficient");?>
. <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/wallet"><?php echo __("Please add funds to continue");?>
</a>
              </div>
            <?php }?>
            <div class="text-end">
              <?php echo __("Total Price");?>

              <p>
                <span class="text-xxlg">
                  <?php echo print_money(number_format($_smarty_tpl->tpl_vars['cart']->value['total'],2),$_smarty_tpl->tpl_vars['system']->value['system_currency_symbol'],$_smarty_tpl->tpl_vars['system']->value['system_currency_dir']);?>

                </span>
              </p>
            </div>
            <div class="divider"></div>
            <div class="text-end">
              <button type="button" class="btn btn-success btn-lg js_shopping-checkout" <?php if (!$_smarty_tpl->tpl_vars['cart']->value['items'] || $_smarty_tpl->tpl_vars['user']->value->_data['user_wallet_balance'] < $_smarty_tpl->tpl_vars['cart']->value['total']) {?>disabled<?php }?>>
                <?php echo __("Checkout");?>

              </button>
            </div>
          </div>
          <!-- Shopping Cart -->
        </div>
      </div>
    </div>

  <?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "orders") {?>

    <div class="articles-widget-header clearfix">
      <!-- search -->
      <div class="float-end">
        <form action="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market/orders" method="get">
          <input type="text" class="form-control form-control-sm" name="query" placeholder='<?php echo __("Search");?>
'>
        </form>
      </div>
      <!-- search -->
      <div class="articles-widget-title lg">
        <?php echo __("Orders");?>
 <?php if (!$_smarty_tpl->tpl_vars['query']->value) {?><span class="badge bg-info rounded-pill"><?php echo $_smarty_tpl->tpl_vars['orders_count']->value;?>
</span><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['query']->value) {?>
          <span class="badge bg-secondary rounded-pill"><?php echo __("for");?>
: <?php echo $_smarty_tpl->tpl_vars['query']->value;?>
</span>
        <?php }?>
      </div>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['orders']->value) {?>
      <ul class="js_orders-stream">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orders']->value, 'order');
$_smarty_tpl->tpl_vars['order']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['order']->value) {
$_smarty_tpl->tpl_vars['order']->do_else = false;
?>
          <?php $_smarty_tpl->_subTemplateRender('file:_order.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>

      <!-- see-more -->
      <?php if (count($_smarty_tpl->tpl_vars['orders']->value) >= $_smarty_tpl->tpl_vars['system']->value['max_results']) {?>
        <div class="alert alert-post see-more js_see-more" data-get="orders" data-target-stream=".js_orders-stream" <?php if ($_smarty_tpl->tpl_vars['query']->value) {?>data-filter="<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
" <?php }?>>
          <span><?php echo __("See More");?>
</span>
          <div class="loader loader_small x-hidden"></div>
        </div>
      <?php }?>
      <!-- see-more -->
    <?php } else { ?>
      <?php $_smarty_tpl->_subTemplateRender('file:_no_data.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php }?>

  <?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "sales") {?>

    <div class="row">
      <div class="col-lg-4">
        <div class="stat-panel bg-gradient-primary">
          <div class="stat-cell narrow">
            <i class="fa fa-file-invoice bg-icon"></i>
            <span class="text-xxlg"><?php echo $_smarty_tpl->tpl_vars['orders_count']->value;?>
</span><br>
            <span class="text-lg"><?php echo __("Total Orders");?>
</span><br>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="stat-panel bg-gradient-info">
          <div class="stat-cell narrow">
            <i class="fa fa-dollar-sign bg-icon"></i>
            <span class="text-xxlg"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['monthly_sales']->value,2));?>
</span><br>
            <span class="text-lg"><?php echo __("This Month Earnings");?>
</span><br>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="stat-panel bg-gradient-info">
          <div class="stat-cell narrow">
            <i class="fa fa-dollar-sign bg-icon"></i>
            <span class="text-xxlg"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['user']->value->_data['user_market_balance'],2));?>
</span><br>
            <span class="text-lg"><?php echo __("Total Earnings");?>
</span><br>
          </div>
        </div>
      </div>
    </div>

    <div class="articles-widget-header clearfix">
      <!-- search -->
      <div class="float-end">
        <form action="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/market/sales" method="get">
          <input type="text" class="form-control form-control-sm" name="query" placeholder='<?php echo __("Search");?>
'>
        </form>
      </div>
      <!-- search -->
      <div class="articles-widget-title lg">
        <?php echo __("Sales Orders");?>

        <?php if ($_smarty_tpl->tpl_vars['query']->value) {?>
          <span class="badge bg-secondary rounded-pill"><?php echo __("for");?>
: <?php echo $_smarty_tpl->tpl_vars['query']->value;?>
</span>
        <?php }?>
      </div>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['orders']->value) {?>
      <ul class="js_orders-stream">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orders']->value, 'order');
$_smarty_tpl->tpl_vars['order']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['order']->value) {
$_smarty_tpl->tpl_vars['order']->do_else = false;
?>
          <?php $_smarty_tpl->_subTemplateRender('file:_order.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sales'=>true), 0, true);
?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>

      <!-- see-more -->
      <?php if (count($_smarty_tpl->tpl_vars['orders']->value) >= $_smarty_tpl->tpl_vars['system']->value['max_results']) {?>
        <div class="alert alert-post see-more js_see-more" data-get="sales_orders" data-target-stream=".js_orders-stream" <?php if ($_smarty_tpl->tpl_vars['query']->value) {?>data-filter="<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
" <?php }?>>
          <span><?php echo __("See More");?>
</span>
          <div class="loader loader_small x-hidden"></div>
        </div>
      <?php }?>
      <!-- see-more -->
    <?php } else { ?>
      <?php $_smarty_tpl->_subTemplateRender('file:_no_data.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php }?>

  <?php }?>

</div>
<!-- page content -->

<?php $_smarty_tpl->_subTemplateRender('file:_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
