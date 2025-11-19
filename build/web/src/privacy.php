<?php
$page_title = 'Privacy Policy - HealthLabs';
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Privacy Policy</h1>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-8 space-y-6">
        <section>
            <h2 class="text-2xl font-semibold mb-4">Information We Collect</h2>
            <p class="text-gray-300">
                HealthLabs collects and stores patient information including medical records, personal 
                identification data, and administrative credentials in accordance with HIPAA regulations 
                and industry best practices.
            </p>
        </section>
        
        <section>
            <h2 class="text-2xl font-semibold mb-4">How We Use Your Information</h2>
            <p class="text-gray-300">
                Patient information is used solely for healthcare delivery purposes, including medical 
                record management, appointment scheduling, and treatment coordination.
            </p>
        </section>
        
        <section>
            <h2 class="text-2xl font-semibold mb-4">Data Security</h2>
            <p class="text-gray-300">
                We implement industry-standard security measures to protect patient data, including 
                encryption, access controls, and regular security audits.
            </p>
        </section>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
