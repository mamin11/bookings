<?php

    function checkRoute($name) {
        if( Route::currentRouteName() == $name) {
            return 'active-menu-link';
        } 
            return '';
    }