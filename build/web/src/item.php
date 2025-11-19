<?php
require_once __DIR__ . '/config.php';
$page_title = 'Patient Details - HealthLabs';
ob_start();

$patient_id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($patient_id)) {
    header('Location: /items.php');
    exit;
}

$conn = getDBConnection();
$patient = null;
$records = [];
$appointments = [];

if ($conn) {
    // Get patient details
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id = ?");
    if ($stmt) {
        $stmt->bind_param("s", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result !== false) {
            $patient = $result->fetch_assoc();
            $result->free();
        }
        $stmt->close();
    }
    
    if ($patient) {
        // Get medical records
        $stmt = $conn->prepare("SELECT * FROM medical_records WHERE patient_id = ? ORDER BY record_date DESC");
        if ($stmt) {
            $stmt->bind_param("s", $patient_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result !== false) {
                while ($row = $result->fetch_assoc()) {
                    $records[] = $row;
                }
                $result->free();
            }
            $stmt->close();
        }
        
        // Get appointments
        $stmt = $conn->prepare("SELECT * FROM appointments WHERE patient_id = ? ORDER BY appointment_date DESC");
        if ($stmt) {
            $stmt->bind_param("s", $patient_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result !== false) {
                while ($row = $result->fetch_assoc()) {
                    $appointments[] = $row;
                }
                $result->free();
            }
            $stmt->close();
        }
    }
    
    $conn->close();
}
?>

<div class="max-w-6xl mx-auto">
    <?php if (!$patient): ?>
        <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
            <p class="text-gray-400">Patient not found.</p>
            <a href="/items.php" class="text-white hover:opacity-80 mt-4 inline-block">← Back to Patients</a>
        </div>
    <?php else: ?>
        <h1 class="text-3xl font-bold mb-6">Patient Details</h1>
        
        <!-- Patient Information -->
        <div class="bg-gray-950 border border-gray-800 rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4"><?php echo htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']); ?></h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-400">Patient ID</p>
                    <p class="text-white"><?php echo htmlspecialchars($patient['patient_id']); ?></p>
                </div>
                <div>
                    <p class="text-gray-400">Date of Birth</p>
                    <p class="text-white"><?php echo htmlspecialchars($patient['date_of_birth']); ?></p>
                </div>
                <div>
                    <p class="text-gray-400">Phone</p>
                    <p class="text-white"><?php echo htmlspecialchars($patient['phone']); ?></p>
                </div>
                <div>
                    <p class="text-gray-400">Email</p>
                    <p class="text-white"><?php echo htmlspecialchars($patient['email']); ?></p>
                </div>
                <div>
                    <p class="text-gray-400">Insurance Provider</p>
                    <p class="text-white"><?php echo htmlspecialchars($patient['insurance_provider']); ?></p>
                </div>
            </div>
        </div>
        
        <!-- Medical Records -->
        <div class="bg-gray-950 border border-gray-800 rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Medical Records</h2>
            <?php if (empty($records)): ?>
                <p class="text-gray-400">No medical records found.</p>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($records as $record): ?>
                        <div class="border-b border-gray-800 pb-4">
                            <p class="text-gray-400">Date: <?php echo htmlspecialchars($record['record_date']); ?></p>
                            <p class="text-white font-semibold"><?php echo htmlspecialchars($record['diagnosis']); ?></p>
                            <p class="text-gray-300"><?php echo htmlspecialchars($record['treatment']); ?></p>
                            <p class="text-gray-400">Doctor: <?php echo htmlspecialchars($record['doctor_name']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Appointments -->
        <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Upcoming Appointments</h2>
            <?php if (empty($appointments)): ?>
                <p class="text-gray-400">No appointments scheduled.</p>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($appointments as $appt): ?>
                        <div class="border-b border-gray-800 pb-4">
                            <p class="text-white font-semibold"><?php echo htmlspecialchars($appt['appointment_type']); ?></p>
                            <p class="text-gray-400"><?php echo htmlspecialchars($appt['appointment_date']); ?></p>
                            <p class="text-gray-400">Status: <?php echo htmlspecialchars($appt['status']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="mt-6">
            <a href="/items.php" class="text-white hover:opacity-80">← Back to Patients</a>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
