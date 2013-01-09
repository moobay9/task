
      <div class="well">
        <legend>登録名変更</legend>
        <form class="ajax-post" id="postlnk__user-change_name_action">
          <fieldset>
            <div class="controls">
              <input type="text" name="name" placeholder="新しい登録名" />
            </div><!--/.controls-->

            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?> 

            <div class="controls">
              <button type="button" class="btn btn-warning send-btn">変更</button>
            </div><!--/.controls-->

          </fieldset>
        </form>
      </div><!--/.well-->
