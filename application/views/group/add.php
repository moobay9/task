
      <div class="well">
        <legend>グループ新規作成</legend>
        <form class="ajax-post" id="postlnk__group-add_action">
          <fieldset>
            <div class="input-append">
              <input type="text" name="name" placeholder="グループ名">
              <button type="button" class="btn send-btn">追加</button>
            </div><!--/.input-append-->
          </fieldset>
        </form>
        <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?> 
      </div><!--/.well-->
