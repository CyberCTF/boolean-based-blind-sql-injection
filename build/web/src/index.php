<?php
require_once __DIR__ . '/config.php';
$page_title = 'HealthLabs Patient Portal - Home';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <!-- Hero Section -->
    <section class="mb-12">
        <div class="bg-gray-950 border border-gray-800 rounded-lg p-8">
            <h1 class="text-4xl font-bold mb-4">Welcome to HealthLabs Patient Portal</h1>
            <p class="text-gray-300 text-lg mb-6">
                Your trusted healthcare technology partner providing comprehensive patient management 
                and medical record systems to clinics and hospitals across the region.
            </p>
            <div class="flex space-x-4">
                <a href="/items.php" class="px-6 py-3 bg-gray-900 border border-gray-700 rounded hover:bg-gray-800 text-white">View Patients</a>
                <a href="/search.php" class="px-6 py-3 border border-gray-700 rounded hover:bg-gray-900 text-white">Search Records</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-6">Our Services</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Patient Management</h3>
                <p class="text-gray-300">
                    Comprehensive patient record management system allowing healthcare providers 
                    to access patient information, medical histories, and treatment plans securely.
                </p>
            </div>
            <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Medical Records</h3>
                <p class="text-gray-300">
                    Complete health history tracking including diagnoses, medications, treatment plans, 
                    and appointment scheduling for efficient healthcare delivery.
                </p>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section>
        <h2 class="text-2xl font-semibold mb-6">System Overview</h2>
        <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
            <?php
            $conn = getDBConnection();
            $patient_count = 0;
            $record_count = 0;
            
            if ($conn) {
                $result = $conn->query("SELECT COUNT(*) as total FROM patients");
                if ($result !== false) {
                    $row = $result->fetch_assoc();
                    if ($row && isset($row['total'])) {
                        $patient_count = (int)$row['total'];
                    }
                    $result->free();
                }
                
                $result = $conn->query("SELECT COUNT(*) as total FROM medical_records");
                if ($result !== false) {
                    $row = $result->fetch_assoc();
                    if ($row && isset($row['total'])) {
                        $record_count = (int)$row['total'];
                    }
                    $result->free();
                }
                
                $conn->close();
            }
            ?>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-400">Total Patients</p>
                    <p class="text-3xl font-bold"><?php echo htmlspecialchars($patient_count); ?></p>
                </div>
                <div>
                    <p class="text-gray-400">Medical Records</p>
                    <p class="text-3xl font-bold"><?php echo htmlspecialchars($record_count); ?></p>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
