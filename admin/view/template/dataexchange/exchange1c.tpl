<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('view/image/feed.png');"><?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
        
        <tr>
          <td><?php echo $entry_username; ?></td>
          <td><input name="exchange1c_username" type="text" value="<?php echo $exchange1c_username; ?>" /></td>
        </tr>        
        <tr>
          <td><?php echo $entry_password; ?></td>
          <td><input name="exchange1c_password" type="password" value="<?php echo $exchange1c_password; ?>" /></td>
        </tr>
        
        <tr>
          <td><?php echo $entry_status; ?></td>
          <td><select name="exchange1c_status">
              <?php if ($exchange1c_status) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select></td>
        </tr>
        
         <tr>
          <td><?php echo $entry_flush_db; ?></td>
          <td><select name="exchange1c_flush_db">
              <?php if ($exchange1c_flush_db) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>
              <?php } ?>
            </select></td>
        </tr>
        
        <tr>
          <td><?php echo $entry_lic_type; ?></td>
          <td><b style="color: green"><?php echo $exchange1c_lic_type; ?></b></td>
        </tr>

        
      </table>
    </form>
  </div>
</div>
<?php echo $footer; ?>