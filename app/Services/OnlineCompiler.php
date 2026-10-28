<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OnlineCompiler
{
    public function run(string $compiler, string $code, ?string $input = null): array
    {
        $response = Http::withHeaders([
                'Authorization' => config('services.onlinecompiler.key'),
            ])
            ->acceptJson()
            ->asJson()
            ->timeout(40)
            ->post(config('services.onlinecompiler.url'), [
                'compiler' => $compiler,
                'code'     => $code,
                'input'    => $input ?? '',
            ]);

        $response->throw();

        return $response->json();
    }
}