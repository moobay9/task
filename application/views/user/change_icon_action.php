
      <div class="well">
        <legend>範囲選択</legend>
        <p>使用する範囲を選択してください</p>

        <img id="crop_target" src='<?php echo site_url('tmp/'. $up['file_name']); ?>' alt=''>

        <hr>

        <div class="row-fluid">
          <div class="span1">
            <form class="ajax-post" id="postlnk__user-change_icon_crop">
              <fieldset>
                <input type="hidden" name="filename" value="<?php echo $up['file_name']; ?>">
                <input type="hidden" name="crop_x" value="0">
                <input type="hidden" name="crop_y" value="0">
                <input type="hidden" name="crop_w" value="<?php echo $up['image_height']; ?>">
                <input type="hidden" name="crop_h" value="<?php echo $up['image_height']; ?>">
                <button type="button" class="btn btn-warning send-btn">決定</button>
              </fieldset>
            </form>
          </div><!--/.span-->

          <div class="span11">
            <form class="ajax-post" id="postlnk__user-change_icon_delete">
              <input type="hidden" name="filename" value="<?php echo $up['file_name'];?>">
              <button type="button" class="btn send-btn">キャンセル</button>
            </form>
          </div><!--/.span-->

        </div><!--/.row-fluid-->
      </div><!--/.well-->
