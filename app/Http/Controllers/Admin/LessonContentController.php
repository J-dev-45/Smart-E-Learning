<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LessonContent;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Smalot\PdfParser\Parser;

class LessonContentController extends Controller
{
    public function index($topicId)
    {
        $lesson = LessonContent::where('topic_id', $topicId)->first();

        return response()->json([
            'lesson' => $lesson,
        ]);
    }

    public function show($lessonId)
    {
        $lesson = LessonContent::findOrFail($lessonId);

        return response()->json([
            'lesson' => $lesson,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic_id' => ['required', 'exists:topics,id'],
            'content' => ['nullable', 'string'],
        ]);

        $lesson = LessonContent::updateOrCreate(
            [
                'topic_id' => $validated['topic_id'],
            ],
            [
                'content' => $validated['content'] ?? null,
            ]
        );

        return response()->json([
            'message' => 'Topic content saved successfully.',
            'lesson' => $lesson,
        ], 200);
    }

    public function update(Request $request, $lessonId)
    {
        $lesson = LessonContent::findOrFail($lessonId);

        $validated = $request->validate([
            'content' => ['nullable', 'string'],
        ]);

        $lesson->update([
            'content' => $validated['content'] ?? null,
        ]);

        return response()->json([
            'message' => 'Topic content updated successfully.',
            'lesson' => $lesson->fresh(),
        ]);
    }

    public function destroy($lessonId)
    {
        $lesson = LessonContent::findOrFail($lessonId);

        $lesson->delete();

        return response()->json([
            'message' => 'Topic content deleted successfully.',
        ]);
    }

    public function extractDocument(Request $request)
    {
        $request->validate([
            'document' => ['required', 'file', 'mimes:pdf,docx', 'max:10240'],
        ]);

        $file = $request->file('document');
        $extension = strtolower($file->getClientOriginalExtension());

        try {
            $content = '';

            if ($extension === 'pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($file->getRealPath());
                $content = $pdf->getText();
            } elseif ($extension === 'docx') {
                $phpWord = IOFactory::load($file->getRealPath());

                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        $content .= $this->extractElementText($element);
                    }
                }
            }

            $content = trim($content);

            if (empty($content)) {
                return response()->json([
                    'message' => 'No readable text was found in this document.',
                ], 422);
            }

            return response()->json([
                'message' => 'Document content extracted successfully.',
                'content' => $content,
            ]);
        } catch (\Throwable $error) {
            \Log::error(
                'Document extraction failed: ' . $error->getMessage()
            );

            return response()->json([
                'message' => 'Unable to extract content from this document.',
            ], 500);
        }
    }

    private function extractElementText($element)
    {
        $text = '';

        if (method_exists($element, 'getText')) {
            $elementText = $element->getText();

            if (is_string($elementText)) {
                $text .= $elementText;
            }
        }

        if (method_exists($element, 'getElements')) {
            foreach ($element->getElements() as $childElement) {
                $text .= $this->extractElementText($childElement);
            }
        }

        return $text . "\n";
    }
}
