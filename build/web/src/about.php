<?php
$page_title = 'About Us - HealthLabs';
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">About HealthLabs</h1>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-8 space-y-6">
        <section>
            <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
            <p class="text-gray-300">
                HealthLabs is a leading healthcare technology company dedicated to providing comprehensive 
                patient management and medical record systems to clinics and hospitals across the region. 
                We are committed to improving healthcare delivery through innovative technology solutions.
            </p>
        </section>
        
        <section>
            <h2 class="text-2xl font-semibold mb-4">Our Services</h2>
            <p class="text-gray-300 mb-4">
                We provide a complete suite of healthcare management tools including:
            </p>
            <ul class="list-disc list-inside text-gray-300 space-y-2 ml-4">
                <li>Patient record management and access systems</li>
                <li>Medical history tracking and documentation</li>
                <li>Appointment scheduling and management</li>
                <li>Secure data storage and HIPAA-compliant systems</li>
            </ul>
        </section>
        
        <section>
            <h2 class="text-2xl font-semibold mb-4">Contact Information</h2>
            <p class="text-gray-300">
                For more information about our services, please visit our 
                <a href="/contact.php" class="text-white underline hover:opacity-80">contact page</a>.
            </p>
        </section>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
