<?php
/* Smarty version 4.3.4, created on 2024-02-13 21:13:05
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/admin.widgets.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cbdb6189b4e4_89258171',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4d2d53353c54f764fbd51200fc56d86bc3ed5e3' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/admin.widgets.tpl',
      1 => 1707770572,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cbdb6189b4e4_89258171 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card">
  <div class="card-header with-icon">
    <?php if ($_smarty_tpl->tpl_vars['sub_view']->value == '') {?>
      <div class="float-end">
        <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/<?php echo $_smarty_tpl->tpl_vars['control_panel']->value['url'];?>
/widgets/add" class="btn btn-md btn-primary">
          <i class="fa fa-plus mr5"></i><?php echo __("Add New widget");?>

        </a>
      </div>
    <?php } else { ?>
      <div class="float-end">
        <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/<?php echo $_smarty_tpl->tpl_vars['control_panel']->value['url'];?>
/widgets" class="btn btn-md btn-light">
          <i class="fa fa-arrow-circle-left mr5"></i><?php echo __("Go Back");?>

        </a>
      </div>
    <?php }?>
    <i class="fa fa-puzzle-piece mr10"></i><?php echo __("Widgets");?>

    <?php if ($_smarty_tpl->tpl_vars['sub_view']->value == "edit") {?> &rsaquo; <?php echo $_smarty_tpl->tpl_vars['data']->value['title'];
}?>
    <?php if ($_smarty_tpl->tpl_vars['sub_view']->value == "add") {?> &rsaquo; <?php echo __("Add New widget");
}?>
  </div>

  <?php if ($_smarty_tpl->tpl_vars['sub_view']->value == '') {?>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover js_dataTable">
          <thead>
            <tr>
              <th><?php echo __("ID");?>
</th>
              <th><?php echo __("Title");?>
</th>
              <th><?php echo __("Place");?>
</th>
              <th><?php echo __("Order");?>
</th>
              <th><?php echo __("Actions");?>
</th>
            </tr>
          </thead>
          <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
              <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['widget_id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</td>
                <td>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['place'] == "home") {?><i class='fa fa-home fa-fw mr5'></i><?php echo __("Home  Page");
}?>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['place'] == "search") {?><i class='fa fa-search fa-fw mr5'></i><?php echo __("Search  Page");
}?>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['place'] == "people") {?><i class='fa fa-users fa-fw mr5'></i><?php echo __("Discover People  Page");
}?>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['place'] == "notifications") {?><i class='fa fa-bell fa-fw mr5'></i><?php echo __("Notifications  Page");
}?>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['place'] == "post") {?><i class='fa fa-file-powerpoint fa-fw mr5'></i><?php echo __("Post  Page");
}?>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['place'] == "photo") {?><i class='fa fa-file-image fa-fw mr5'></i><?php echo __("Photo  Page");
}?>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['place'] == "article") {?><i class='fa fa-file-alt fa-fw mr5'></i><?php echo __("Article  Page");
}?>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['place'] == "directory") {?><i class='fa fa-th-list fa-fw mr5'></i><?php echo __("Directory  Page");
}?>
                </td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['place_order'];?>
</td>
                <td>
                  <a data-bs-toggle="tooltip" title='<?php echo __("Edit");?>
' href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/<?php echo $_smarty_tpl->tpl_vars['control_panel']->value['url'];?>
/widgets/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['widget_id'];?>
" class="btn btn-sm btn-icon btn-rounded btn-primary">
                    <i class="fa fa-pencil-alt"></i>
                  </a>
                  <button data-bs-toggle="tooltip" title='<?php echo __("Delete");?>
' class="btn btn-sm btn-icon btn-rounded btn-danger js_admin-deleter" data-handle="widget" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['widget_id'];?>
">
                    <i class="fa fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </tbody>
        </table>
      </div>
    </div>

  <?php } elseif ($_smarty_tpl->tpl_vars['sub_view']->value == "edit") {?>

    <form class="js_ajax-forms" data-url="admin/widgets.php?do=edit&id=<?php echo $_smarty_tpl->tpl_vars['data']->value['widget_id'];?>
">
      <div class="card-body">
        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Title");?>

          </label>
          <div class="col-md-9">
            <input class="form-control" name="title" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
">
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Place");?>

          </label>
          <div class="col-md-9">
            <select class="form-select" name="place">
              <option <?php if ($_smarty_tpl->tpl_vars['data']->value['place'] == "home") {?>selected<?php }?> value="home"><?php echo __("Home");?>
</option>
              <option <?php if ($_smarty_tpl->tpl_vars['data']->value['place'] == "search") {?>selected<?php }?> value="search"><?php echo __("Search");?>
</option>
              <option <?php if ($_smarty_tpl->tpl_vars['data']->value['place'] == "people") {?>selected<?php }?> value="people"><?php echo __("Discover People");?>
</option>
              <option <?php if ($_smarty_tpl->tpl_vars['data']->value['place'] == "notifications") {?>selected<?php }?> value="notifications"><?php echo __("Notifications");?>
</option>
              <option <?php if ($_smarty_tpl->tpl_vars['data']->value['place'] == "post") {?>selected<?php }?> value="post"><?php echo __("Post");?>
</option>
              <option <?php if ($_smarty_tpl->tpl_vars['data']->value['place'] == "photo") {?>selected<?php }?> value="photo"><?php echo __("Photo");?>
</option>
              <option <?php if ($_smarty_tpl->tpl_vars['data']->value['place'] == "article") {?>selected<?php }?> value="article"><?php echo __("Article Page");?>
</option>
              <option <?php if ($_smarty_tpl->tpl_vars['data']->value['place'] == "directory") {?>selected<?php }?> value="directory"><?php echo __("Directory");?>
</option>
            </select>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Order");?>

          </label>
          <div class="col-md-9">
            <input class="form-control" name="place_order" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['place_order'];?>
">
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("HTML");?>

          </label>
          <div class="col-md-9">
            <textarea class="form-control" name="message" rows="8"><?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
</textarea>
          </div>
        </div>

        <!-- success -->
        <div class="alert alert-success mt15 mb0 x-hidden"></div>
        <!-- success -->

        <!-- error -->
        <div class="alert alert-danger mt15 mb0 x-hidden"></div>
        <!-- error -->
      </div>
      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary"><?php echo __("Save Changes");?>
</button>
      </div>
    </form>

  <?php } elseif ($_smarty_tpl->tpl_vars['sub_view']->value == "add") {?>

    <form class="js_ajax-forms" data-url="admin/widgets.php?do=add">
      <div class="card-body">
        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Title");?>

          </label>
          <div class="col-md-9">
            <input class="form-control" name="title">
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Place");?>

          </label>
          <div class="col-md-9">
            <select class="form-select" name="place">
              <option value="home"><?php echo __("Home");?>
</option>
              <option value="search"><?php echo __("Search");?>
</option>
              <option value="people"><?php echo __("Discover People");?>
</option>
              <option value="notifications"><?php echo __("Notifications");?>
</option>
              <option value="post"><?php echo __("Post");?>
</option>
              <option value="photo"><?php echo __("Photo");?>
</option>
              <option value="article"><?php echo __("Article Page");?>
</option>
              <option value="directory"><?php echo __("Directory");?>
</option>
            </select>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Order");?>

          </label>
          <div class="col-md-9">
            <input class="form-control" name="place_order">
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("HTML");?>

          </label>
          <div class="col-md-9">
            <textarea class="form-control" name="message" rows="8"></textarea>
          </div>
        </div>

        <!-- success -->
        <div class="alert alert-success mt15 mb0 x-hidden"></div>
        <!-- success -->

        <!-- error -->
        <div class="alert alert-danger mt15 mb0 x-hidden"></div>
        <!-- error -->
      </div>
      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary"><?php echo __("Save Changes");?>
</button>
      </div>
    </form>

  <?php }?>
</div><?php }
}
