<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route definitions are grouped by feature. Each feature owns the file
| below its own concern in routes/features.
|
*/

require base_path('routes/features/home.php');
require base_path('routes/features/about.php');
require base_path('routes/features/services.php');
require base_path('routes/features/locations.php');
require base_path('routes/features/contact.php');
require base_path('routes/features/admin.php');
