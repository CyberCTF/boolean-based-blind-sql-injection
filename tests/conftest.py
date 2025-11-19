import pytest
import os

# Configure pytest
def pytest_configure(config):
    """Configure pytest with custom markers"""
    config.addinivalue_line(
        "markers", "docker: marks tests as Docker-related"
    )
    config.addinivalue_line(
        "markers", "integration: marks tests as integration tests"
    )
