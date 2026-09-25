<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$user = App\Models\User::where('email', 'admin@knrint.in')->first();
if (!$user) { echo "not_found\n"; exit; }
echo "email={$user->email}\n";
echo "active=" . ($user->is_active ? '1' : '0') . "\n";
$ok = Illuminate\Support\Facades\Hash::check('Password@knrint', $user->password);
echo "hash_check=" . ($ok ? '1' : '0') . "\n";
