<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$user = App\Models\User::where('email','admin@knrint.in')->first();
if (!$user) { echo "not_found\n"; exit; }
$ok = Illuminate\Support\Facades\Hash::check('Password@knrint', $user->password);
echo $ok ? "password_ok\n" : "password_bad\n";
