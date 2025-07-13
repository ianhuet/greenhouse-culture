# Setup Version History - Greenhouse Culture WordPress Site

## Current Setup
- **Hosting**: Legacy hosted server (unchanged)
- **Deployment Method**: Manual file uploads via FileZilla (SFTP)
- **Access**: SFTP credentials only
- **Update Frequency**: Maximum 1 deployment per week, often less
- **Deployment Scope**: Theme files only (WordPress core & plugins managed via admin)

## Proposed Git-Based Deployment Solution

### Research Summary

#### Requirements Analyzed
1. Keep existing hosting provider (no migration)
2. Implement version control with private Git repository
3. Automate deployments when code is merged to specific branch
4. Free or low-cost solution preferred
5. GitHub preferred for Git hosting
6. Preview/staging environments nice-to-have but not required

#### CI/CD Options Researched

**1. GitHub Actions (RECOMMENDED)**
- **Cost**: Free for public repos, 2,000 minutes/month for private repos
- **Pros**: Native GitHub integration, extensive marketplace actions, active community
- **SFTP Support**: Multiple reliable actions available (wlixcc/SFTP-Deploy-Action, easingthemes/ssh-deploy)
- **Build Support**: Full Node.js/npm/composer support for theme builds

**2. GitLab CI/CD**
- **Cost**: 400 CI/CD minutes/month free tier
- **Pros**: Built-in CI/CD, good documentation
- **SFTP Support**: Via custom scripts or Docker images
- **Consideration**: Requires GitLab account instead of GitHub

**3. Other Free Alternatives Evaluated**
- **Buddy.works**: 5 free projects, visual pipeline builder, native SFTP
- **DeployHQ**: 1 free project, 10 deployments/day, connects to GitHub
- **Jenkins**: Self-hosted, completely free but requires server maintenance
- **CircleCI/Travis CI**: Limited free tiers, more complex setup

### Recommended Implementation Plan

#### 1. Repository Structure
```
greenhouseculture-theme/
├── .github/
│   └── workflows/
│       └── deploy.yml
├── .gitignore
├── src/              # Development files
├── dist/             # Built theme files
├── functions.php
├── style.css
├── package.json
└── README.md
```

#### 2. GitHub Actions Workflow Configuration
- Trigger on push to `main` branch
- Optional build step for compiled assets (CSS/JS)
- SFTP deployment to existing host
- Exclude unnecessary files (node_modules, .git, src/)
- Use GitHub Secrets for credentials

#### 3. Security Setup
- Store SFTP credentials as GitHub Secrets
- Optional: Use SSH key authentication instead of password
- Implement branch protection rules
- Require PR reviews before merging to main

#### 4. Workflow Benefits
- **Version Control**: Complete history of all theme changes
- **Collaboration**: Multiple developers can work safely
- **Rollback Capability**: Easy to revert problematic deployments
- **Automated Testing**: Can add linting, testing before deployment
- **Zero Downtime**: Only changed files are uploaded
- **Free**: Within GitHub Actions free tier limits

### Migration Steps

1. **Initialize Git Repository**
   - Create private GitHub repository
   - Add existing theme files
   - Create `.gitignore` for unnecessary files

2. **Setup GitHub Secrets**
   - SFTP_HOST
   - SFTP_USER
   - SFTP_PASSWORD (or SSH_PRIVATE_KEY)

3. **Add GitHub Actions Workflow**
   - Copy provided deploy.yml template
   - Adjust paths and build commands as needed

4. **Test Deployment**
   - Create test branch
   - Make small change
   - Merge to main and verify deployment

5. **Documentation**
   - Document deployment process
   - Create README with setup instructions
   - Note any theme-specific build requirements

### Cost Analysis
- **GitHub**: Free for public repos, private repos include 2,000 Action minutes/month
- **Current Deployment Time**: ~5-10 minutes manual
- **Automated Deployment**: ~2-3 minutes
- **Weekly Usage**: ~12 minutes/month (well within free tier)

### Future Enhancements (Optional)
- Add staging environment deployment
- Implement automated testing
- Add deployment notifications (Slack/email)
- Create preview deployments for PRs
- Add performance monitoring

---
*Document created: 2025-07-11*
*Research conducted for transitioning from manual SFTP deployment to automated Git-based CI/CD*