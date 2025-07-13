# Universal Verification Protocol for Data-Driven Analysis

## 1. Primary Source Verification Principle
**Always identify and examine the authoritative source of truth**:
- In databases: Query the exact tables/fields that store canonical state
- In configuration files: Check the primary config, not derived/cached values
- In code: Examine the actual implementation, not documentation or comments

**Command**: Before any analysis, ask yourself: "What is the single source of truth for this information?"

## 2. First Principles Investigation
**Never assume - always derive from ground truth**:
```bash
# Example: Instead of assuming based on file presence
ls themes/  # Shows installed themes (not active)

# Query the definitive state
grep -E "primary_key_pattern" authoritative_source.file
```

**Principle**: Start with the fundamental data structures that define system state, not secondary indicators.

## 3. Evidence-Based Validation
**Require explicit proof before proceeding**:
- Extract the exact data that defines current state
- Show the specific lines/values that prove your conclusion
- Distinguish between "exists in system" vs "currently active/used"

**Template**: "The authoritative evidence shows [exact data] which definitively proves [conclusion]"

## 4. Assumption Audit Protocol
**Before any analysis, explicitly state**:
- What you're assuming vs what you've verified
- Which data sources you're using as truth
- Whether you've examined primary vs secondary sources

**Red Flag**: If you can't point to specific primary source data, stop and verify.

## 5. Hierarchical Source Reliability
**Rank your data sources by authority**:
1. **Primary**: Direct system state (database records, config files)
2. **Secondary**: Derived data (caches, logs, metadata)
3. **Tertiary**: Documentation, comments, assumptions

**Rule**: Only use primary sources for definitive conclusions.

## 6. Verification-First Workflow
**Mandatory sequence**:
1. Identify the primary source for the question
2. Extract the exact authoritative data
3. Prove your conclusion with specific evidence
4. Only then proceed with analysis

**Instruction Template**:
> "Before analyzing [system/component]:
> 1. Identify the primary source that defines [current state]
> 2. Extract the exact authoritative data
> 3. Show me the specific evidence that proves [conclusion]
> 4. Distinguish between what exists vs what is currently active
> 5. Only proceed after confirming ground truth"

This protocol ensures rigorous, evidence-based analysis you can trust.