<?php $this->layout('layout') ?>

<h1>Welcome!</h1>

<?php if (empty($user)) : ?>
    <p>This is your first controller.</p>
    <a href="<?= $this->route('auth.show') ?>">Log in</a>
<?php else : ?>
    <p>Logged in as <?= $user->email ?></p>
    <a href="<?= $this->route('auth.logout') ?>">Log out</a>
<?php endif ?>