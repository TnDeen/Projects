<?php

/*
	location-of-this-file: app/
*/

// Step 1: Setting up the resource [Check!]
// Step 2: Setting up the registration [Check!]
// Step 3: Creating profile pages [Check!]
// Step 4: Allowing updates and deletes [Check!]
// Step 5: Handling authentication [Check!]

Route::resource('users', 'UsersController');

Route::controller('/', 'HomeController');