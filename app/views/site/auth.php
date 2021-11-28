<?php $this->layout('layout') ?>

<h1>Auth</h1>

<form method="post" action="<?= $this->route('auth.do') ?>">

    <?php if (!empty($error)) : ?>

        <div><?= $error ?></div>

    <?php endif ?>

    <div>
        <label>Email</label><br />
        <input type="email" name="email" />
    </div>

    <div>
        <label>Password</label><br />
        <input type="password" name="password" />
    </div>

    <div>
        <button>Log in</button>
    </div>

</form>