
      <div class="well">
        <legend>メールアドレス変更</legend>
        <form class="ajax-post" id="postlnk__user-change_email_action">
          <fieldset>
            <div class="controls">
              <p>新しいメールアドレスへ認証メールを送信します</p>
              <input type="text" name="email" placeholder="新しいメールアドレス" value="<?php echo set_value('email'); ?>" />
            </div><!--/.controls-->

            <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?> 

            <div class="controls">
              <button type="button" class="btn btn-warning send-btn">送信</button>
            </div><!--/.controls-->

          </fieldset>
        </form>
      </div><!--/.well-->
