<?php
header('Content-Type: application/json');

function getStopWords() {
    return array('the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'i', 'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do', 'at', 'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her', 'she', 'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'their', 'what');
}

function tokenizeText($text) {
    // Remove special characters and convert to lowercase
    $text = strtolower($text);
    $text = preg_replace('/[^a-z\s-]/', ' ', $text);
    
    // Split into words and filter empty strings
    $words = array_filter(explode(' ', $text), function($word) {
        return trim($word) !== '';
    });
    
    return $words;
}

function calculateWordFrequency($text) {
    try {
        // Tokenize text
        $words = tokenizeText($text);
        
        // Remove stop words
        $stopWords = getStopWords();
        $words = array_filter($words, function($word) use ($stopWords) {
            return !in_array($word, $stopWords) && strlen($word) > 1;
        });
        
        // Count word frequencies
        $frequencies = array_count_values($words);
        
        return [
            'status' => 'success',
            'data' => $frequencies,
            'total_words' => count($words),
            'unique_words' => count($frequencies)
        ];
    } catch (Exception $e) {
        return [
            'status' => 'error',
            'message' => 'Error processing text: ' . $e->getMessage()
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

if (empty($_POST['text'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'No text provided']);
    exit;
}

try {
    $text = $_POST['text'];
    $sort = $_POST['sort'] ?? 'desc';
    $limit = (int)($_POST['limit'] ?? 10);
    
    if ($limit < 1) $limit = 10;
    
    $result = calculateWordFrequency($text);
    
    if ($result['status'] === 'success') {
        $frequencies = $result['data'];
        
        if (empty($frequencies)) {
            echo json_encode(['status' => 'error', 'message' => 'No valid words found after processing']);
            exit;
        }
        
        // Sort based on user preference
        if ($sort === 'asc') {
            asort($frequencies);
        } else {
            arsort($frequencies);
        }
        
        // Limit results
        $frequencies = array_slice($frequencies, 0, $limit);
        
        echo json_encode([
            'status' => 'success',
            'data' => $frequencies,
            'stats' => [
                'total_words' => $result['total_words'],
                'unique_words' => $result['unique_words'],
                'displayed_words' => count($frequencies)
            ]
        ]);
    } else {
        echo json_encode($result);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
}
