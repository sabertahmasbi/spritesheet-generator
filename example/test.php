<?php

require '../vendor/autoload.php';

use Saber\SpritesheetGenerator\SpritesheetGenerator;

$sg = new SpritesheetGenerator(48,48);
$sg->addImagesPaths([
    __DIR__.'/imgs/1.png',
    __DIR__.'/imgs/2.png',
    __DIR__.'/imgs/3.png',
    __DIR__.'/imgs/4.png'
])
->generateSheet()
->saveSpritesheetTo('./menu-icons.png')
->saveStyleSheetTo('./menu-icons.css');