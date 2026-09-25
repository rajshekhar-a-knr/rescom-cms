<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$users = App\Models\User::select('id','email','is_active','role')->orderBy('id')->get();
foreach ($users as $u) {
    echo "{$u->id} {$u->email} active=" . ($u->is_active ? '1' : '0') . " role={$u->role}\n";
}
