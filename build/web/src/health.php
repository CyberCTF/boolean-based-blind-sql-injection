<?php
// Health check endpoint - must return 200 without database dependency
http_response_code(200);
header('Content-Type: application/json');
echo json_encode(['status' => 'ok', 'service' => 'HealthLabs Patient Portal']);
exit;
