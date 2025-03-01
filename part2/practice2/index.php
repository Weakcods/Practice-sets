<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = $_POST['text'];
    $sortingOrder = $_POST['sorting_order']; 
    $displayLimit = $_POST['display_limit'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Word Frequency Counter</h1>
        
        <form id="wordForm">
            <div class="form-group">
                <label for="text">Paste your text here:</label>
                <textarea id="text" name="text" rows="10" required placeholder="Enter or paste your text here..."></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="sort">Sort by frequency:</label>
                    <select id="sort" name="sort">
                        <option value="desc">Highest to Lowest</option>
                        <option value="asc">Lowest to Highest</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="limit">Number of words to display:</label>
                    <input type="number" id="limit" name="limit" value="10" min="1" max="100">
                </div>
            </div>
            
            <button type="submit" class="btn-primary">Calculate Word Frequency</button>
        </form>

        <div id="results" class="hidden">
            <div id="stats" class="stats-container"></div>
            <div id="frequency-table"></div>
        </div>

        <div id="error" class="error hidden"></div>
    </div>

    <script>
        document.getElementById('wordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const results = document.getElementById('results');
            const error = document.getElementById('error');
            const stats = document.getElementById('stats');
            const table = document.getElementById('frequency-table');
            
            // Show loading state
            results.classList.remove('hidden');
            error.classList.add('hidden');
            stats.innerHTML = 'Processing...';
            table.innerHTML = '';
            
            fetch('process.php', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(response => {
                if (response.status === 'error') {
                    throw new Error(response.message);
                }
                
                // Display statistics
                stats.innerHTML = `
                    <div class="stat-item">
                        <span class="stat-label">Total Words:</span>
                        <span class="stat-value">${response.stats.total_words}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Unique Words:</span>
                        <span class="stat-value">${response.stats.unique_words}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Displayed Words:</span>
                        <span class="stat-value">${response.stats.displayed_words}</span>
                    </div>
                `;
                
                // Create frequency table
                let tableHtml = `
                    <table>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Word</th>
                                <th>Frequency</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                
                let rank = 1;
                for (const [word, freq] of Object.entries(response.data)) {
                    const percentage = ((freq / response.stats.total_words) * 100).toFixed(2);
                    tableHtml += `
                        <tr>
                            <td>${rank}</td>
                            <td>${word}</td>
                            <td>${freq}</td>
                            <td>${percentage}%</td>
                        </tr>
                    `;
                    rank++;
                }
                
                tableHtml += '</tbody></table>';
                table.innerHTML = tableHtml;
            })
            .catch(err => {
                error.textContent = err.message || 'An error occurred while processing your request.';
                error.classList.remove('hidden');
                results.classList.add('hidden');
            });
        });
    </script>
</body>
</html>