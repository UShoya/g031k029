﻿<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('board');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1>掲示板</h1>
            <h2>こんにちは～</h2>
        </div>
        <div id="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
        <div id="footer">
        </div>
    </div>
    <?php //echo $this->element('sql_dump'); ?>
</body>
</html>