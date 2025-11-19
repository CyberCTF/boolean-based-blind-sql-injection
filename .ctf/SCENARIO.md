# Scenario: HealthLabs Patient Portal Breach

## Company Overview

**HealthLabs** is a healthcare technology company providing patient management and medical record systems to clinics and hospitals across the region. The company operates a web-based patient portal that allows healthcare providers to access patient records, schedule appointments, and manage medical histories.

## Crown Jewels

HealthLabs' most critical assets include:
- **Patient medical records**: Complete health histories, diagnoses, medications, and treatment plans
- **Personal identification data**: Patient names, dates of birth, social security numbers, addresses
- **Administrative credentials**: Database administrator accounts and system access credentials
- **Payment information**: Insurance details and billing records linked to patient accounts

## Application Typology and Tech Stack

The patient portal is a **web application** built with:
- **Backend**: PHP 7.4 with Laravel framework
- **Database**: MariaDB 10.5 running on Linux servers
- **Frontend**: JavaScript (React) with RESTful API endpoints
- **Architecture**: Three-tier architecture with web servers, application servers, and database servers

The application handles user authentication, patient record queries, appointment management, and generates medical reports through dynamic SQL queries constructed from user inputs.

## Business Risks Specific to Boolean-based Blind SQL Injection

An attacker exploiting this Boolean-based Blind SQL Injection vulnerability could systematically extract sensitive data character-by-character without triggering traditional security alerts, leading to:

- **Regulatory compliance violations**: Unauthorized access to patient health records violates HIPAA regulations, potentially resulting in fines up to $1.5 million per violation and mandatory breach notifications to affected patients and regulatory bodies.

- **Identity theft and medical fraud**: Extracted patient identification data (SSN, dates of birth, addresses) enables identity theft, fraudulent medical claims, and prescription fraud, causing direct financial harm to patients and insurance providers.

- **Privilege escalation attacks**: Extraction of administrative database credentials allows attackers to gain full database access, potentially modifying or deleting patient records, compromising data integrity, and enabling lateral movement to other systems.

- **Reputation and trust damage**: A data breach would severely damage HealthLabs' reputation with healthcare providers and patients, leading to contract terminations, loss of business partnerships, and long-term revenue decline as clients migrate to competitors.

- **Legal liability**: Affected patients may pursue class-action lawsuits for privacy violations, with potential settlements and legal costs significantly impacting the company's financial stability.
