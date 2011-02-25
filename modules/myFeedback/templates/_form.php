<?php use_helper('jQuery') ?>

<?php if (isset($success) && $success): ?>
<div class="flash success">
Ваше сообщение успешно отправлено.
</div>
<?php endif ?>

<?php echo jq_form_remote_tag(array(
    'url' => 'my_feedback_create',
    'update' => 'feedback-form',
    'class' => 'list',
)) ?>
    <ul class="form">
        <?php echo $form ?>
        <li class="form-item">
            <input id="feedback-submit" type="submit" value="Отправить" />
        </li>
    </ul>
</form>
