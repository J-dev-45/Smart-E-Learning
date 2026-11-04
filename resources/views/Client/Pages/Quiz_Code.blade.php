<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Code Quiz Test</title>

    {{-- If your Tailwind CSS entry is not resources/css/app.css, change it here --}}
    @vite(['resources/css/app.css', 'resources/js/Vue/Client/test-code-quiz.js'])
</head>
<body class="bg-white p-6">

    {{-- Test info (server-side, so you can compare with what Vue shows) --}}
    <div class="max-w-6xl mx-auto mb-4 p-4 rounded-lg border border-[#cfd9e6] bg-[#fcfcfd] text-sm text-[#1f2430]">
        <div class="font-semibold text-[#6b5b95] mb-2">CODE QUIZ TEST PAGE</div>
        <div>Question ID: <b>{{ $question->id }}</b></div>
        <div>Test cases in database: <b>{{ $total }}</b> (hidden: <b>{{ $hidden }}</b>)</div>

        @if ($total === 0)
            <div class="mt-2 text-red-600">
                This question has no test cases. Add some first, otherwise SUBMIT can never be correct.
            </div>
        @endif

        <div class="mt-3 text-[#6b5b95]">
            Try: correct code → 3/3 · wrong text → FAIL · missing semicolon → ERROR · empty editor → validation error
        </div>
    </div>

    {{-- Vue mounts CodePlayground here --}}
    <div id="app" data-question-id="{{ $question->id }}"></div>

</body>
</html>