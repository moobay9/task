
      <div class="well">
        <legend>タスクの登録</legend>
        <form class="ajax-post" id="postlnk__task-add_action">
          <fieldset>
            <label>締切日</label>
              <input class="input-small date" type="text" name="limit" placeholder="締切日" value="<?php echo set_value('limit'); ?>" />
            <label>内容</label>
            <textarea name="text" rows="3" placeholder="内容"><?php echo set_value('text'); ?></textarea>

            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?> 

            <hr>

            <button type="button" class="btn btn-warning send-btn"><i class='icon-plus icon-white'></i> 登録</button>

          </fieldset>
        </form>
      </div><!--/.well-->
