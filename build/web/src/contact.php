<?php
$page_title = 'Contact Us - HealthLabs';
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Contact HealthLabs</h1>
    
    <div class="bg-gray-950 border border-gray-800 rounded-lg p-8">
        <p class="text-gray-300 mb-6">
            For inquiries about our patient portal services, technical support, or general information, 
            please use the contact form below or reach out to us directly.
        </p>
        
        <form class="space-y-4">
            <div>
                <label class="block text-gray-300 mb-2">Name</label>
                <input 
                    type="text" 
                    class="w-full bg-gray-900 border border-gray-700 rounded px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white"
                    placeholder="Your name"
                >
            </div>
            <div>
                <label class="block text-gray-300 mb-2">Email</label>
                <input 
                    type="email" 
                    class="w-full bg-gray-900 border border-gray-700 rounded px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white"
                    placeholder="your.email@example.com"
                >
            </div>
            <div>
                <label class="block text-gray-300 mb-2">Message</label>
                <textarea 
                    rows="6" 
                    class="w-full bg-gray-900 border border-gray-700 rounded px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white"
                    placeholder="Your message"
                ></textarea>
            </div>
            <button 
                type="submit" 
                class="px-6 py-2 bg-gray-900 border border-gray-700 rounded hover:bg-gray-800 text-white"
            >
                Send Message
            </button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
