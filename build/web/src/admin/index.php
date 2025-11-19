<?php
require_once __DIR__ . '/../config.php';
$page_title = 'Admin Dashboard - HealthLabs';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Administrative Dashboard</h1>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-6 mb-6">
        <p class="text-gray-300 mb-4">
            Welcome to the HealthLabs administrative dashboard. This area provides access to system 
            management functions and user administration.
        </p>
        <div class="flex space-x-4">
            <a href="/admin/users.php" class="px-6 py-3 bg-gray-900 border border-gray-700 rounded hover:bg-gray-800 text-white">
                Manage Users
            </a>
        </div>
    </div>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">System Statistics</h2>
        <?php
        $conn = getDBConnection();
        $stats = [
            'patients' => 0,
            'records' => 0,
            'appointments' => 0
        ];
        
        if ($conn) {
            $result = $conn->query("SELECT COUNT(*) as total FROM patients");
            if ($result !== false) {
                $row = $result->fetch_assoc();
                if ($row && isset($row['total'])) {
                    $stats['patients'] = (int)$row['total'];
                }
                $result->free();
            }
            
            $result = $conn->query("SELECT COUNT(*) as total FROM medical_records");
            if ($result !== false) {
                $row = $result->fetch_assoc();
                if ($row && isset($row['total'])) {
                    $stats['records'] = (int)$row['total'];
                }
                $result->free();
            }
            
            $result = $conn->query("SELECT COUNT(*) as total FROM appointments");
            if ($result !== false) {
                $row = $result->fetch_assoc();
                if ($row && isset($row['total'])) {
                    $stats['appointments'] = (int)$row['total'];
                }
                $result->free();
            }
            
            $conn->close();
        }
        ?>
        <div class="grid md:grid-cols-3 gap-6">
            <div>
                <p class="text-gray-400">Total Patients</p>
                <p class="text-3xl font-bold"><?php echo htmlspecialchars($stats['patients']); ?></p>
            </div>
            <div>
                <p class="text-gray-400">Medical Records</p>
                <p class="text-3xl font-bold"><?php echo htmlspecialchars($stats['records']); ?></p>
            </div>
            <div>
                <p class="text-gray-400">Appointments</p>
                <p class="text-3xl font-bold"><?php echo htmlspecialchars($stats['appointments']); ?></p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
