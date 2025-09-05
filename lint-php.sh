#!/bin/bash

# PHP Linting Script for WordPress Theme
# This script checks for basic PHP syntax issues without requiring PHP installation

echo "🔍 Running PHP lint checks..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

ERRORS=0
WARNINGS=0

# Function to check basic PHP syntax patterns
check_php_file() {
    local file="$1"
    local file_errors=0
    
    echo "Checking: $file"
    
    # Check for missing opening PHP tags
    if ! grep -q "<?php" "$file" && [[ "$file" == *.php ]]; then
        echo -e "${RED}ERROR: Missing opening PHP tag in $file${NC}"
        ((file_errors++))
    fi
    
    # Check for basic syntax issues
    # Unclosed quotes (basic check)
    if grep -n "[^\\\\]'[^']*$" "$file" > /dev/null; then
        echo -e "${YELLOW}WARNING: Possible unclosed single quote in $file${NC}"
        ((WARNINGS++))
    fi
    
    # Missing semicolons (basic patterns)
    if grep -n "^\s*\$[^;]*[^;{]$" "$file" > /dev/null; then
        echo -e "${YELLOW}WARNING: Possible missing semicolon in $file${NC}"
        ((WARNINGS++))
    fi
    
    ERRORS=$((ERRORS + file_errors))
    
    if [ $file_errors -eq 0 ]; then
        echo -e "${GREEN}✓ $file looks good${NC}"
    fi
}

# Find and check PHP files in theme directory
find wp-content/themes/greenhouseculture -name "*.php" -type f | while read -r file; do
    check_php_file "$file"
done

echo ""
echo "📊 Summary:"
echo -e "Errors: ${RED}$ERRORS${NC}"
echo -e "Warnings: ${YELLOW}$WARNINGS${NC}"

if [ $ERRORS -eq 0 ]; then
    echo -e "${GREEN}🎉 No critical PHP syntax errors found!${NC}"
    exit 0
else
    echo -e "${RED}❌ Found $ERRORS critical errors that need fixing${NC}"
    exit 1
fi