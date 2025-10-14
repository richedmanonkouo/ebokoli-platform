<?php
/* Smarty version 4.3.4, created on 2024-02-13 21:12:57
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/admin.colored_posts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cbdb592b6230_83526758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b655c23ab7b251bc32b81e9348608c6832c411e' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/admin.colored_posts.tpl',
      1 => 1707770547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cbdb592b6230_83526758 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card">
  <div class="card-header with-icon">
    <?php if ($_smarty_tpl->tpl_vars['sub_view']->value == '') {?>
      <div class="float-end">
        <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/<?php echo $_smarty_tpl->tpl_vars['control_panel']->value['url'];?>
/colored_posts/add" class="btn btn-md btn-primary">
          <i class="fa fa-plus mr5"></i><?php echo __("Add New Pattern");?>

        </a>
      </div>
    <?php } else { ?>
      <div class="float-end">
        <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/<?php echo $_smarty_tpl->tpl_vars['control_panel']->value['url'];?>
/colored_posts" class="btn btn-md btn-light">
          <i class="fa fa-arrow-circle-left mr5"></i><?php echo __("Go Back");?>

        </a>
      </div>
    <?php }?>
    <i class="fa fa-palette mr10"></i><?php echo __("Colored Posts");?>

    <?php if ($_smarty_tpl->tpl_vars['sub_view']->value == "add") {?> &rsaquo; <?php echo __("Add New Pattern");
}?>
    <?php if ($_smarty_tpl->tpl_vars['sub_view']->value == "edit") {?> &rsaquo; <?php echo __("Edit Pattern");
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
              <th><?php echo __("Preview");?>
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
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pattern_id'];?>
</td>
                <td>
                  <?php if ($_smarty_tpl->tpl_vars['row']->value['type'] == "color") {?>
                    <div class="post-colored-preview small" style="background-image: linear-gradient(45deg, <?php echo $_smarty_tpl->tpl_vars['row']->value['background_color_1'];?>
, <?php echo $_smarty_tpl->tpl_vars['row']->value['background_color_2'];?>
);">
                      <h4 style="color: <?php echo $_smarty_tpl->tpl_vars['row']->value['text_color'];?>
;">
                        <?php echo __("Hello World");?>

                      </h4>
                    </div>
                  <?php } else { ?>
                    <div class="post-colored-preview small" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['row']->value['background_image'];?>
)">
                      <h4 style="color: <?php echo $_smarty_tpl->tpl_vars['row']->value['text_color'];?>
;">
                        <?php echo __("Hello World");?>

                      </h4>
                    </div>
                  <?php }?>
                </td>
                <td>
                  <a data-bs-toggle="tooltip" title='<?php echo __("Edit");?>
' href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/<?php echo $_smarty_tpl->tpl_vars['control_panel']->value['url'];?>
/colored_posts/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['pattern_id'];?>
" class="btn btn-sm btn-icon btn-rounded btn-primary">
                    <i class="fa fa-pencil-alt"></i>
                  </a>
                  <button data-bs-toggle="tooltip" title='<?php echo __("Delete");?>
' class="btn btn-sm btn-icon btn-rounded btn-danger js_admin-deleter" data-handle="pattern" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['pattern_id'];?>
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

  <?php } elseif ($_smarty_tpl->tpl_vars['sub_view']->value == "add") {?>

    <form class="js_ajax-forms" data-url="admin/colored_posts.php?do=add">
      <div class="card-body">
        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Pattern Type");?>

          </label>
          <div class="col-md-9">
            <div class="form-check form-check-inline">
              <input type="radio" name="type" id="pattern_type_color" value="color" class="form-check-input js_pattern-type" checked>
              <label class="form-check-label" for="pattern_type_color"><?php echo __("Background Color");?>
</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="type" id="pattern_type_image" value="image" class="form-check-input js_pattern-type">
              <label class="form-check-label" for="pattern_type_image"><?php echo __("Background Image");?>
</label>
            </div>
          </div>
        </div>

        <div id="js_pattern-type-color">
          <div class="row form-group">
            <label class="col-md-3 form-label">
              <?php echo __("Background Color 1");?>

            </label>
            <div class="col-md-9">
              <div class="input-group js_colorpicker">
                <input type="text" class="form-control form-control-color js_pattern-background-color-1" name="background_color_1" value="#FF00FF" />
                <input type="color" class="form-control form-control-color" value="#FF00FF" />
              </div>
            </div>
          </div>

          <div class="row form-group">
            <label class="col-md-3 form-label">
              <?php echo __("Background Color 2");?>

            </label>
            <div class="col-md-9">
              <div class="input-group js_colorpicker">
                <input type="text" class="form-control form-control-color js_pattern-background-color-2" name="background_color_2" value="#3A3AD7" />
                <input type="color" class="form-control form-control-color" value="#3A3AD7" />
              </div>
            </div>
          </div>
        </div>

        <div id="js_pattern-type-image" class="x-hidden">
          <div class="row form-group">
            <label class="col-md-3 form-label">
              <?php echo __("Background Image");?>

            </label>
            <div class="col-md-9">
              <div class="x-image">
                <button type="button" class="btn-close x-hidden js_x-image-remover" title='<?php echo __("Remove");?>
'>

                </button>
                <div class="x-image-loader">
                  <div class="progress x-progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <i class="fa fa-camera fa-lg js_x-uploader" data-handle="x-image"></i>
                <input type="hidden" class="js_x-image-input js_pattern-background-image" name="background_image" value="">
              </div>
            </div>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Text Color");?>

          </label>
          <div class="col-md-9">
            <div class="input-group js_colorpicker">
              <input type="text" class="form-control form-control-color js_pattern-text-color" name="text_color" value="#000000" />
              <input type="color" class="form-control form-control-color" value="#000000" />
            </div>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Preview");?>

          </label>
          <div class="col-md-9">
            <div class="post-colored-preview js_pattern-preview" style="background-image: linear-gradient(45deg, #FF00FF, #3A3AD7);">
              <h2 style="color: #000000;">
                <?php echo __("Hello World");?>

              </h2>
            </div>
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

  <?php } elseif ($_smarty_tpl->tpl_vars['sub_view']->value == "edit") {?>

    <form class="js_ajax-forms" data-url="admin/colored_posts.php?do=edit&id=<?php echo $_smarty_tpl->tpl_vars['data']->value['pattern_id'];?>
">
      <div class="card-body">
        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Pattern Type");?>

          </label>
          <div class="col-md-9">
            <div class="form-check form-check-inline">
              <input type="radio" name="type" id="pattern_type_color" value="color" class="form-check-input js_pattern-type" <?php if ($_smarty_tpl->tpl_vars['data']->value['type'] == "color") {?>checked<?php }?>>
              <label class="form-check-label" for="pattern_type_color"><?php echo __("Background Color");?>
</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="type" id="pattern_type_image" value="image" class="form-check-input js_pattern-type" <?php if ($_smarty_tpl->tpl_vars['data']->value['type'] == "image") {?>checked<?php }?>>
              <label class="form-check-label" for="pattern_type_image"><?php echo __("Background Image");?>
</label>
            </div>
          </div>
        </div>

        <div id="js_pattern-type-color" <?php if ($_smarty_tpl->tpl_vars['data']->value['type'] == "image") {?>class="x-hidden" <?php }?>>
          <div class="row form-group">
            <label class="col-md-3 form-label">
              <?php echo __("Background Color 1");?>

            </label>
            <div class="col-md-9">
              <div class="input-group js_colorpicker">
                <input type="text" class="form-control form-control-color js_pattern-background-color-1" name="background_color_1" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['background_color_1'];?>
" />
                <input type="color" class="form-control form-control-color" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['background_color_1'];?>
" />
              </div>
            </div>
          </div>

          <div class="row form-group">
            <label class="col-md-3 form-label">
              <?php echo __("Background Color 2");?>

            </label>
            <div class="col-md-9">
              <div class="input-group js_colorpicker">
                <input type="text" class="form-control form-control-color js_pattern-background-color-2" name="background_color_2" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['background_color_2'];?>
" />
                <input type="color" class="form-control form-control-color" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['background_color_2'];?>
" />
              </div>
            </div>
          </div>
        </div>

        <div id="js_pattern-type-image" <?php if ($_smarty_tpl->tpl_vars['data']->value['type'] == "color") {?>class="x-hidden" <?php }?>>
          <div class="row form-group">
            <label class="col-md-3 form-label">
              <?php echo __("Background Image");?>

            </label>
            <div class="col-md-9">
              <div class="x-image" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['background_image'];?>
')">
                <button type="button" class="btn-close js_x-image-remover" title='<?php echo __("Remove");?>
'>

                </button>
                <div class="x-image-loader">
                  <div class="progress x-progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <i class="fa fa-camera fa-lg js_x-uploader" data-handle="x-image"></i>
                <input type="hidden" class="js_x-image-input js_pattern-background-image" name="background_image" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['background_image'];?>
">
              </div>
            </div>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Text Color");?>

          </label>
          <div class="col-md-9">
            <div class="input-group js_colorpicker">
              <input type="text" class="form-control form-control-color js_pattern-text-color" name="text_color" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['text_color'];?>
" />
              <input type="color" class="form-control form-control-color" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['text_color'];?>
" />
            </div>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 form-label">
            <?php echo __("Preview");?>

          </label>
          <div class="col-md-9">
            <?php if ($_smarty_tpl->tpl_vars['data']->value['type'] == "color") {?>
              <div class="post-colored-preview js_pattern-preview" style="background-image: linear-gradient(45deg, <?php echo $_smarty_tpl->tpl_vars['data']->value['background_color_1'];?>
, <?php echo $_smarty_tpl->tpl_vars['data']->value['background_color_2'];?>
);">
                <h2 style="color: <?php echo $_smarty_tpl->tpl_vars['data']->value['text_color'];?>
;">
                  <?php echo __("Hello World");?>

                </h2>
              </div>
            <?php } else { ?>
              <div class="post-colored-preview js_pattern-preview" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['data']->value['background_image'];?>
)">
                <h2 style="color: <?php echo $_smarty_tpl->tpl_vars['data']->value['text_color'];?>
;">
                  <?php echo __("Hello World");?>

                </h2>
              </div>
            <?php }?>
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
