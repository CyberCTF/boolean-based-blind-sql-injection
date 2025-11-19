# Flag Definition

## Critical Data to Extract

The flag is the **administrative database user credentials** stored in the `app_repo41` database: username `backup8320` and password `kxj#t=%YkFv8S+q&`.

## Business Impact

These credentials provide full database administrator privileges, enabling complete access to all patient records, medical histories, and sensitive personal data. An attacker with these credentials could modify or delete critical medical records, leading to patient safety risks, HIPAA violations, and potential medical malpractice liability. Additionally, these credentials could enable lateral movement to other systems in HealthLabs' infrastructure, expanding the breach scope significantly.

## Extraction Approach

Exploit the Boolean-based Blind SQL Injection vulnerability in the patient portal's user query parameter. Use conditional SQL statements with `IF()`, `SUBSTRING()`, and `ASCII()` functions to systematically extract the username and password character-by-character from the database administrator account table. Analyze HTTP response differences (status codes, content length, or page content variations) to determine true/false conditions for each character position, iterating through all character positions until the complete credentials are recovered.
