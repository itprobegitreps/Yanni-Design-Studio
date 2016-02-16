<?php

include('includes/init.php');

function add_more_buttons($buttons) {$buttons[] = 'fontsizeselect'; $buttons[] = 'styleselect'; return $buttons; } add_filter("mce_buttons_3", "add_more_buttons");
/*
include('temp/process.php');*/