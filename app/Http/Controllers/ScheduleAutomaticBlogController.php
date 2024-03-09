<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScheduleAutomaticBlogController extends Controller
{
    public function generateBlog(Request $request)
    {
        $keyword = $request->input('keyword');
    
        // Query for the title
        $titlePrompt = "Write a creative title for an article about \"$keyword\". Try not to change the original \"$keyword\" while writing the Title. It is a 30-55 characters";
        $title = $this->getChatGptResponse($titlePrompt, 20);
        $title = str_replace('"', '', $title);
        $seoDescriptionPrompt = "Write an SEO meta-description for an article titled \"$title\". Try to include \"$keyword\" in the description.";
        $seoDescriptionResponse  = $this->getChatGptResponse($seoDescriptionPrompt, 100);
        $seoDescription = trim($seoDescriptionResponse);

        $altAttributePrompt = "Write an alt attribute for the main image of an article titled \"$title\".";
        $altAttribute = $this->getChatGptResponse($altAttributePrompt, 10);
    

        $contentPrompt = "Write a 100% unique, creative and in a human-like style article of minimum 2500 words using HTML <h1> and <h2> tags for headings and sub-headings. The article should be titled \"$title\" and include the keyword \"$keyword\" in English. the topic of taxes.
            Structure the article with an <h1>Introduction</h1>. Include bullet points or numbered lists using <ul> and <ol> tags (if needed), <h2>FAQs</h2> and an <h1>Conclusion</h1>. Ensure the article is plagiarism-free and can pass AI detection tools. Use a question mark (?) at the end of questions. Maintain the original \"$keyword\" in the title, use it 2-3 times in the article, and include it in headings when possible.";
    
        $articleContent = $this->getChatGptResponse($contentPrompt, 3000);
            
        $slug = Str::slug($title, '-');

        $currentDate = date('Y-m-d H:i:s');

        $blog = new Blog([
            'title' => $title,
            'description' => $seoDescription,
            'body' => $articleContent,
            'slug' => $slug,
            'created_at' => $currentDate,
            'updated_at' => $currentDate,
            'path_image' => '',
            'alt_attribute' =>  $altAttribute,
            'author_id' => 4, 
            'category_id' =>4, 
            'keywords' => 'keyword1, keyword2, keyword3',
            'status' => 0
        ]);
    
        $blog->save();
    
        return response()->json([
            'title' => $title,
            'seoDescription' => $seoDescription,
            'articleContent' => $articleContent,
        ]);
    }

    private function getChatGptResponse($prompt, $tokens)
    {
        $client = new Client([
            'base_uri' => 'https://api.openai.com',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . getenv('OPENAI_API_KEY')
            ],
        ]);
    
        $response = $client->post('/v1/chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful SEO Engineer.' 
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'max_tokens' => $tokens, 
                'temperature' => 0.7,
            ],
        ]);
    
        $result = json_decode($response->getBody(), true);
        return $result['choices'][0]['message']['content'];
    }
}
