<?php
session_start();
?>

<div id="tete">
    <h1>Club Photo de Limoges</h1>
    
    <?php if (isset($_SESSION['username'])): ?>
        <a href="index.php?page=logout">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                <path d="M16 13v-2H7V8l-5 4 5 4v-3h9zM20 3H4c-1.1 0-2 .9-2 2v4h2V5h16v14H4v-4H2v4c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" fill="#000000"/>
            </svg>
        </a>
        <p>Bonjour <?php echo $_SESSION['username']; ?></p>
    <?php else: ?>
        <a href="index.php?page=login">
            <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"> 
                    <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="#000000"></path> 
                    <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000"></path> 
                </g>
            </svg>
        </a>
        <p>aucun compte connecté</p>
    <?php endif; ?>
</div>