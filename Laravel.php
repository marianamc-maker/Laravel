<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    // Consulta todos os registros da tabela 'users'
    $usuarios = User::all();

    // Exibe os resultados
    foreach ($usuarios as $u) {
        echo "ID: {$u->id} - Nome: {$u->name} - E-mail: {$u->email} <br>";
    }
}
);