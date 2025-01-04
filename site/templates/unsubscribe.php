<?php
$email = strip_tags(get('email', ''));
$token = get('token');

if (!empty($email) && !empty($token) && csrf($token)): ?>

    <?= site()->unsubscribe($email) ? 'Unsubscribed' : 'Error' ?>

<?php else: ?>

<form action="/newsletter/unsubscribe" method="post">
    <label>
        <input type="email" name="email" placeholder="E-Mail">
    </label>
    <input type="hidden" name="token" value="<?= csrf() ?>">
    <input type="submit" value="Unsubscribe">
</form>

<?php endif; ?>
