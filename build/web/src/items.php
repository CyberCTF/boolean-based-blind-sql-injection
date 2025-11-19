<?php
require_once __DIR__ . '/config.php';
$page_title = 'Patients - HealthLabs';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Patient Directory</h1>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
        <?php
        $conn = getDBConnection();
        $patients = [];
        
        if ($conn) {
            $result = $conn->query("SELECT patient_id, first_name, last_name, date_of_birth, phone FROM patients ORDER BY last_name");
            
            if ($result !== false) {
                while ($row = $result->fetch_assoc()) {
                    $patients[] = $row;
                }
                $result->free();
            }
            
            $conn->close();
        }
        
        if (empty($patients)) {
            echo '<p class="text-gray-400">No patients found.</p>';
        } else {
            echo '<div class="space-y-4">';
            foreach ($patients as $patient) {
                echo '<div class="border-b border-gray-800 pb-4">';
                echo '<a href="/item.php?id=' . urlencode($patient['patient_id']) . '" class="block hover:opacity-80">';
                echo '<h3 class="text-xl font-semibold">' . htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']) . '</h3>';
                echo '<p class="text-gray-400">Patient ID: ' . htmlspecialchars($patient['patient_id']) . '</p>';
                echo '<p class="text-gray-400">DOB: ' . htmlspecialchars($patient['date_of_birth']) . '</p>';
                echo '</a>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
