<?php
require_once __DIR__ . '/../config.php';
$page_title = 'User Management - HealthLabs';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">User Management</h1>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-6">
        <?php
        $conn = getDBConnection();
        $users = [];
        
        if ($conn) {
            $result = $conn->query("SELECT id, username, full_name, role, created_at FROM admin_users ORDER BY username");
            
            if ($result !== false) {
                while ($row = $result->fetch_assoc()) {
                    $users[] = $row;
                }
                $result->free();
            }
            
            $conn->close();
        }
        
        if (empty($users)) {
            echo '<p class="text-gray-400">No users found.</p>';
        } else {
            echo '<div class="overflow-x-auto">';
            echo '<table class="w-full border-collapse">';
            echo '<thead>';
            echo '<tr class="border-b border-gray-800">';
            echo '<th class="text-left py-3 px-4">Username</th>';
            echo '<th class="text-left py-3 px-4">Full Name</th>';
            echo '<th class="text-left py-3 px-4">Role</th>';
            echo '<th class="text-left py-3 px-4">Created</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($users as $user) {
                echo '<tr class="border-b border-gray-800">';
                echo '<td class="py-3 px-4">' . htmlspecialchars($user['username']) . '</td>';
                echo '<td class="py-3 px-4">' . htmlspecialchars($user['full_name']) . '</td>';
                echo '<td class="py-3 px-4">' . htmlspecialchars($user['role']) . '</td>';
                echo '<td class="py-3 px-4 text-gray-400">' . htmlspecialchars($user['created_at']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }
        ?>
    </div>
    
    <div class="mt-6">
        <a href="/admin/index.php" class="text-white hover:opacity-80">← Back to Dashboard</a>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
