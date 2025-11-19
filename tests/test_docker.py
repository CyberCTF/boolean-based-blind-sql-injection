import pytest
import requests
import time
import subprocess
import os

# Get environment variables for ports
WEB_PORT = os.getenv('WEB_PORT', '3206')
DB_PORT = os.getenv('DB_HOST_PORT', '3207')
BASE_URL = f"http://localhost:{WEB_PORT}"

@pytest.fixture(scope="session")
def wait_for_services():
    """Wait for services to be ready"""
    max_attempts = 30
    for attempt in range(max_attempts):
        try:
            response = requests.get(f"{BASE_URL}/health.php", timeout=5)
            if response.status_code == 200:
                break
        except requests.exceptions.RequestException:
            if attempt < max_attempts - 1:
                time.sleep(2)
            else:
                raise
    else:
        raise Exception("Services did not become ready in time")

def test_containers_running():
    """Test that Docker containers are running"""
    result = subprocess.run(
        ['docker', 'ps', '--format', '{{.Names}}'],
        capture_output=True,
        text=True
    )
    assert result.returncode == 0
    container_names = result.stdout.strip().split('\n')
    assert 'boolean-blind-sql-injection_web' in container_names or any('web' in name for name in container_names)
    assert 'boolean-blind-sql-injection_database' in container_names or any('database' in name for name in container_names)

def test_web_health_check(wait_for_services):
    """Test web service health endpoint"""
    response = requests.get(f"{BASE_URL}/health.php", timeout=10)
    assert response.status_code == 200
    data = response.json()
    assert data['status'] == 'ok'

def test_web_port_accessible(wait_for_services):
    """Test that web port is accessible"""
    response = requests.get(f"{BASE_URL}/", timeout=10)
    assert response.status_code == 200
    assert 'HealthLabs' in response.text

def test_database_port_accessible():
    """Test that database port is accessible"""
    import socket
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.settimeout(5)
    result = sock.connect_ex(('localhost', int(DB_PORT)))
    sock.close()
    assert result == 0

def test_home_page_loads(wait_for_services):
    """Test that home page loads correctly"""
    response = requests.get(f"{BASE_URL}/", timeout=10)
    assert response.status_code == 200
    assert 'HealthLabs Patient Portal' in response.text
    assert 'Welcome' in response.text

def test_patients_page_loads(wait_for_services):
    """Test that patients listing page loads"""
    response = requests.get(f"{BASE_URL}/items.php", timeout=10)
    assert response.status_code == 200
    assert 'Patient Directory' in response.text

def test_search_page_loads(wait_for_services):
    """Test that search page loads"""
    response = requests.get(f"{BASE_URL}/search.php", timeout=10)
    assert response.status_code == 200
    assert 'Search Patients' in response.text

def test_about_page_loads(wait_for_services):
    """Test that about page loads"""
    response = requests.get(f"{BASE_URL}/about.php", timeout=10)
    assert response.status_code == 200
    assert 'About HealthLabs' in response.text

def test_contact_page_loads(wait_for_services):
    """Test that contact page loads"""
    response = requests.get(f"{BASE_URL}/contact.php", timeout=10)
    assert response.status_code == 200
    assert 'Contact HealthLabs' in response.text

def test_admin_pages_load(wait_for_services):
    """Test that admin pages load"""
    response = requests.get(f"{BASE_URL}/admin/index.php", timeout=10)
    assert response.status_code == 200
    assert 'Administrative Dashboard' in response.text

def test_404_error_page(wait_for_services):
    """Test that 404 error page works"""
    response = requests.get(f"{BASE_URL}/nonexistent-page", timeout=10)
    # Should either return 404 or redirect to error page
    assert response.status_code in [404, 200]

def test_database_connectivity(wait_for_services):
    """Test that database is accessible and contains data"""
    # Test by checking that patient data is returned
    response = requests.get(f"{BASE_URL}/items.php", timeout=10)
    assert response.status_code == 200
    # Should have patient data
    assert 'PAT-' in response.text or 'patient' in response.text.lower()

def test_search_functionality(wait_for_services):
    """Test basic search functionality"""
    # Test with a valid search query
    response = requests.get(f"{BASE_URL}/search.php?q=Smith", timeout=10)
    assert response.status_code == 200
    assert 'Search Results' in response.text

def test_patient_detail_page(wait_for_services):
    """Test patient detail page"""
    response = requests.get(f"{BASE_URL}/item.php?id=PAT-001", timeout=10)
    assert response.status_code == 200
    assert 'Patient Details' in response.text
