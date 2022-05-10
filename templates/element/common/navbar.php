<header>
    <nav id="navbar">
        <ul>
            <li>
                <?= $this->Html->link(
                    'Accueil',
                    [
                        'controller' => 'Images',
                        'action' => 'home',
                        'class' => 'navLink'
                    ]
                ); ?>
            </li>
            <li>
                <?= $this->Html->link(
                    'Add Image',
                    [
                        'controller' => 'Images',
                        'action' => 'add',
                        'class' => 'navLink'
                    ]
                ); ?>
            </li>
            <li>
                <?= $this->Html->link(
                    'Inscription',
                    [
                        'controller' => 'Users',
                        'action' => 'inscription',
                        'class' => 'navLink'
                    ]
                ); ?>
            </li>
            <li>
                <?= $this->Html->link(
                    'Connexion',
                    [
                        'controller' => 'Users',
                        'action' => 'login',
                        'class' => 'navLink'
                    ]
                ); ?>
            </li>
        </ul>
    </nav>
</header>