<?php

namespace App\Http\Controllers;

use App\Services\OnlineCompiler;
use Illuminate\Http\Request;

class CodeRunnerController extends Controller
{
    public function run(Request $request, OnlineCompiler $compiler)
    {
        $data = $request->validate([
            'compiler' => 'required|string|max:50',
            'code'     => 'required|string|max:50000',
            'input'    => 'nullable|string|max:5000',
        ]);

        return response()->json(
            $compiler->run($data['compiler'], $data['code'], $data['input'] ?? null)
        );
    }
}