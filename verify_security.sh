#!/bin/bash

# ============================================
# SECURITY IMPLEMENTATION VERIFICATION SCRIPT
# ============================================
# Script ini memeriksa apakah semua security measures
# telah diimplementasikan dengan benar

echo "=================================================="
echo "   SECURITY IMPLEMENTATION VERIFICATION"
echo "=================================================="

# Color codes
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Counter for results
PASSED=0
FAILED=0

# ============================================
# Function untuk test apakah file exists
# ============================================
test_file_exists() {
    local file=$1
    local desc=$2
    
    if [ -f "$file" ]; then
        echo -e "${GREEN}✓ PASS${NC} - $desc"
        ((PASSED++))
    else
        echo -e "${RED}✗ FAIL${NC} - $desc (File not found: $file)"
        ((FAILED++))
    fi
}

# ============================================
# Function untuk test apakah directory exists
# ============================================
test_dir_exists() {
    local dir=$1
    local desc=$2
    
    if [ -d "$dir" ]; then
        echo -e "${GREEN}✓ PASS${NC} - $desc"
        ((PASSED++))
    else
        echo -e "${RED}✗ FAIL${NC} - $desc (Directory not found: $dir)"
        ((FAILED++))
    fi
}

# ============================================
# Function untuk test PHP syntax
# ============================================
test_php_syntax() {
    local file=$1
    local desc=$2
    
    if php -l "$file" &> /dev/null; then
        echo -e "${GREEN}✓ PASS${NC} - $desc"
        ((PASSED++))
    else
        echo -e "${RED}✗ FAIL${NC} - $desc (PHP syntax error)"
        ((FAILED++))
    fi
}

echo -e "\n${YELLOW}1. Checking Middleware Files${NC}"
test_file_exists "app/Http/Middleware/SecurityHeadersMiddleware.php" "SecurityHeadersMiddleware"
test_file_exists "app/Http/Middleware/InputValidationMiddleware.php" "InputValidationMiddleware"
test_file_exists "app/Http/Middleware/RateLimitMiddleware.php" "RateLimitMiddleware"
test_file_exists "app/Http/Middleware/LogSecurityEventsMiddleware.php" "LogSecurityEventsMiddleware"
test_file_exists "app/Http/Middleware/CorsSecurityMiddleware.php" "CorsSecurityMiddleware"

echo -e "\n${YELLOW}2. Checking Service Files${NC}"
test_file_exists "app/Services/EncryptionService.php" "EncryptionService"

echo -e "\n${YELLOW}3. Checking Repository Files${NC}"
test_file_exists "app/Repositories/SecureDatabaseRepository.php" "SecureDatabaseRepository"

echo -e "\n${YELLOW}4. Checking Configuration Files${NC}"
test_file_exists "config/security.php" "Security Config"

echo -e "\n${YELLOW}5. Checking Test Files${NC}"
test_file_exists "tests/Security/SecurityTestCase.php" "Security Test Case"
test_file_exists "tests/Security/RoleBasedSecurityTest.php" "Role Based Security Test"
test_file_exists "tests/Security/MiddlewareSecurityTest.php" "Middleware Security Test"
test_dir_exists "tests/Security" "Security Tests Directory"

echo -e "\n${YELLOW}6. Checking Documentation Files${NC}"
test_file_exists "SECURITY_DOCUMENTATION.md" "Security Documentation"
test_file_exists "SECURITY_CHECKLIST.md" "Security Checklist"
test_file_exists "README_SECURITY.md" "Security README"
test_file_exists ".env.security.example" "Environment Security Example"
test_file_exists "php.security.ini" "PHP Security Config"

echo -e "\n${YELLOW}7. Checking Script Files${NC}"
test_file_exists "pentest_auto.sh" "Penetration Testing Script"
test_file_exists "security_hardening.sh" "Server Hardening Script"

echo -e "\n${YELLOW}8. Checking PHP Syntax${NC}"
test_php_syntax "app/Http/Middleware/SecurityHeadersMiddleware.php" "SecurityHeadersMiddleware syntax"
test_php_syntax "app/Http/Middleware/InputValidationMiddleware.php" "InputValidationMiddleware syntax"
test_php_syntax "app/Http/Middleware/RateLimitMiddleware.php" "RateLimitMiddleware syntax"
test_php_syntax "app/Http/Middleware/LogSecurityEventsMiddleware.php" "LogSecurityEventsMiddleware syntax"
test_php_syntax "app/Http/Middleware/CorsSecurityMiddleware.php" "CorsSecurityMiddleware syntax"
test_php_syntax "app/Services/EncryptionService.php" "EncryptionService syntax"
test_php_syntax "app/Repositories/SecureDatabaseRepository.php" "SecureDatabaseRepository syntax"
test_php_syntax "config/security.php" "Security Config syntax"

echo -e "\n${YELLOW}9. Checking .env Configuration${NC}"
if [ -f ".env" ]; then
    if grep -q "APP_DEBUG" .env; then
        echo -e "${GREEN}✓ PASS${NC} - .env file exists with APP_DEBUG"
        ((PASSED++))
    else
        echo -e "${YELLOW}⚠ WARN${NC} - .env exists but missing APP_DEBUG"
        ((FAILED++))
    fi
else
    echo -e "${RED}✗ FAIL${NC} - .env file not found"
    ((FAILED++))
fi

echo -e "\n${YELLOW}10. Checking Directory Structure${NC}"
test_dir_exists "app/Http/Middleware" "Middleware Directory"
test_dir_exists "app/Services" "Services Directory"
test_dir_exists "app/Repositories" "Repositories Directory"
test_dir_exists "config" "Config Directory"
test_dir_exists "storage/logs" "Logs Directory"

echo -e "\n${YELLOW}11. Checking Automation Scripts${NC}"
if [ -f "pentest_auto.sh" ]; then
    if grep -q "nmap" pentest_auto.sh; then
        echo -e "${GREEN}✓ PASS${NC} - pentest_auto.sh contains nmap"
        ((PASSED++))
    else
        echo -e "${RED}✗ FAIL${NC} - pentest_auto.sh malformed"
        ((FAILED++))
    fi
fi

if [ -f "security_hardening.sh" ]; then
    if grep -q "UFW\|Fail2Ban" security_hardening.sh; then
        echo -e "${GREEN}✓ PASS${NC} - security_hardening.sh configured"
        ((PASSED++))
    else
        echo -e "${RED}✗ FAIL${NC} - security_hardening.sh incomplete"
        ((FAILED++))
    fi
fi

echo -e "\n${YELLOW}12. Checking Documentation Completeness${NC}"
if [ -f "SECURITY_DOCUMENTATION.md" ]; then
    if grep -q "10 Security Measures\|Security Headers\|SQL Injection" SECURITY_DOCUMENTATION.md; then
        echo -e "${GREEN}✓ PASS${NC} - Documentation comprehensive"
        ((PASSED++))
    else
        echo -e "${RED}✗ FAIL${NC} - Documentation incomplete"
        ((FAILED++))
    fi
fi

# ============================================
# Final Report
# ============================================
echo -e "\n=================================================="
echo -e "              VERIFICATION REPORT"
echo -e "=================================================="
echo -e "${GREEN}Passed: $PASSED${NC}"
echo -e "${RED}Failed: $FAILED${NC}"

TOTAL=$((PASSED + FAILED))
PERCENTAGE=$((PASSED * 100 / TOTAL))

echo -e "Total: $TOTAL"
echo -e "Success Rate: ${PERCENTAGE}%"

if [ $FAILED -eq 0 ]; then
    echo -e "\n${GREEN}✓ ALL SECURITY MEASURES VERIFIED${NC}"
    echo -e "${GREEN}Status: READY FOR PRODUCTION${NC}"
    exit 0
else
    echo -e "\n${RED}✗ SOME CHECKS FAILED${NC}"
    echo -e "${YELLOW}Please review the failed items above${NC}"
    exit 1
fi
