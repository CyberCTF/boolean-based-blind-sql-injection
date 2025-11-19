<?php
http_response_code(500);
$page_title = 'Server Error - HealthLabs';
ob_start();
?>

<div class="max-w-4xl mx-auto text-center">
    <h1 class="text-6xl font-bold mb-4">500</h1>
    <h2 class="text-2xl font-semibold mb-6">Internal Server Error</h2>
    <p class="text-gray-300 mb-8">
        An error occurred while processing your request. Please try again later.
    </p>
    <a href="/" class="px-6 py-3 bg-gray-900 border border-gray-700 rounded hover:bg-gray-800 text-white">
        Return to Home
    </a>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
