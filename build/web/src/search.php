<?php
require_once __DIR__ . '/config.php';
$page_title = 'Search Patients - HealthLabs';
ob_start();

// VULNERABILITY: Boolean-based Blind SQL Injection
// The search query parameter is directly concatenated into SQL without proper sanitization
// This allows an attacker to extract data character-by-character using boolean conditions

$search_query = isset($_GET['q']) ? $_GET['q'] : '';
$results = [];

if (!empty($search_query) && $conn = getDBConnection()) {
    // VULNERABLE CODE: Boolean-based Blind SQL Injection
    // The search_query parameter is directly concatenated into SQL without proper sanitization
    // An attacker can inject boolean conditions to extract data character-by-character
    // Example payloads:
    //   - ' OR 1=1 -- (returns all patients)
    //   - ' AND IF(ASCII(SUBSTRING((SELECT username FROM admin_users LIMIT 1),1,1))=98,1,0) -- (tests first char)
    
    // CRITICAL VULNERABILITY: No prepared statements, no proper escaping
    // The single quote in the LIKE clause can be closed, allowing SQL injection
    $sql = "SELECT patient_id, first_name, last_name, date_of_birth FROM patients WHERE last_name LIKE '%" . $search_query . "%' OR first_name LIKE '%" . $search_query . "%'";
    
    $result = $conn->query($sql);
    
    if ($result !== false) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        $result->free();
    }
    
    $conn->close();
}
?>

<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Search Patients</h1>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-6 mb-6">
        <form method="GET" action="/search.php" class="flex gap-4">
            <input 
                type="text" 
                name="q" 
                value="<?php echo htmlspecialchars($search_query); ?>" 
                placeholder="Search by name..."
                class="flex-1 bg-gray-900 border border-gray-700 rounded px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white"
            >
            <button 
                type="submit" 
                class="px-6 py-2 bg-gray-900 border border-gray-700 rounded hover:bg-gray-800 text-white"
            >
                Search
            </button>
        </form>
    </div>
    
    <?php if (!empty($search_query)): ?>
        <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Search Results</h2>
            <?php if (empty($results)): ?>
                <p class="text-gray-400">No patients found matching your search.</p>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($results as $patient): ?>
                        <div class="border-b border-gray-800 pb-4">
                            <a href="/item.php?id=<?php echo urlencode($patient['patient_id']); ?>" class="block hover:opacity-80">
                                <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']); ?></h3>
                                <p class="text-gray-400">Patient ID: <?php echo htmlspecialchars($patient['patient_id']); ?></p>
                                <p class="text-gray-400">DOB: <?php echo htmlspecialchars($patient['date_of_birth']); ?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
