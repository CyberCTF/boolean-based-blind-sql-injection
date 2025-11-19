<?php
$page_title = 'Terms of Service - HealthLabs';
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Terms of Service</h1>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-8 space-y-6">
        <section>
            <h2 class="text-2xl font-semibold mb-4">Acceptance of Terms</h2>
            <p class="text-gray-300">
                By accessing and using the HealthLabs Patient Portal, you agree to be bound by these 
                Terms of Service and all applicable laws and regulations.
            </p>
        </section>
        
        <section>
            <h2 class="text-2xl font-semibold mb-4">Use of Service</h2>
            <p class="text-gray-300">
                The Patient Portal is intended for authorized healthcare providers and administrative 
                personnel only. Unauthorized access or misuse of the system is strictly prohibited.
            </p>
        </section>
        
        <section>
            <h2 class="text-2xl font-semibold mb-4">Limitation of Liability</h2>
            <p class="text-gray-300">
                HealthLabs shall not be liable for any indirect, incidental, special, or consequential 
                damages arising from the use or inability to use the Patient Portal.
            </p>
        </section>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
