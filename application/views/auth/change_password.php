
      <div class="well">
        <legend>パスワード変更</legend>
        <form class="ajax-post" id="postlnk__auth-change_password_action">
          <fieldset>
            <div class="controls">
              <input type="password" name="now_password" placeholder="現在のパスワード" />
            </div><!--/.controls-->

            <div class="controls">
              <input type="password" name="new_password" placeholder="新しいパスワード" />
            </div><!--/.controls-->

            <div class="controls">
              <input type="password" name="confirm" placeholder="新しいパスワード（確認）" />
            </div><!--/.controls-->

            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?> 

            <div class="controls">
              <button type="button" class="btn btn-warning send-btn">変更</button>
            </div><!--/.controls-->

          </fieldset>
        </form>
      </div><!--/.well-->
