1# WordPress Local Development Setup
- Cross-Platform, Free, Git-Friendly Themes + Custom Plugins Development

## Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed & running
- [Git installed](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) or [desktop app](https://git-scm.com/downloads/guis)
- [Basic command line knowledge](https://code.visualstudio.com/docs/terminal/basics)
- [Wordpress](https://wordpress.org/download/)

## Quick Start

### 1. Open a Terminal & navigate to the directory where you store your development work

### 2. Clone this repository
```
git clone https://github.com/ianhuet/greenhouse-culture
cd greenhouse-culture
```

### 3. Download Wordpress
- Go to https://wordpress.org/download/ & download Wordpress ZIP

### 4. Extract into Wordpress.zip
- Do this away from the greenhouse-culture directory
- When extracted open the 'wordpress' directory and delete the 'wp-content' directory
- Copy all the remaining files and directories within the 'wordpress' directory into /your-development-directory/greenhouse-culture

### 5. Setup environment credentials
- Create `.env` file in project root
- Add database credentials, provided separately

# 6. Start Docker container
- First, ensure Docker Desktop is running
```
docker-compose up -d
```

# 7. Access your site
- WordPress: http://localhost:8000
- Admin login, provided separately: http://localhost:8000/wp-admin

## Project Structure

```
your-project/
├── docker-compose.yml          # Docker configuration (tracked in Git)
├── .gitignore                  # Git ignore rules (tracked in Git)
├── README.md                   # This file (tracked in Git)
├── .env                        # Environment credentials (NOT tracked in Git)
├── wp-content/
│   ├── themes/
│   │   └── greenhouseculture/ # Your custom theme (tracked in Git)
│   └── plugins/
│       ├── contributor-bio-block/ # Custom plugin (tracked in Git)
│       └── members-map/           # Custom plugin (tracked in Git)
└── [WordPress core files]      # Auto-generated (NOT tracked in Git)
```

## Why Docker?
- **100% Free** (Docker Desktop is free for personal use)
- **Cross-platform** (identical setup on Windows, Mac, Linux)
- **Git-friendly**
- **Team consistency** (everyone gets the same environment)
- **Production-like** (mirrors real hosting environments)

## Docker Configuration

The `docker-compose.yml` file is already configured in the project root with:
- WordPress latest image
- Remote database connection via environment variables
- Mounted wp-content directory for live development
- WordPress core files in Docker volume (not tracked in Git)

## Git Configuration

The `.gitignore` file is pre-configured to:
- Track only custom themes and plugins
- Ignore WordPress core files
- Ignore actual environment files (.env)
- Ignore uploads, cache, and other generated files

## Development Workflow

### Database Management
- The development database is hosted remotely, on TiDB Cloud
- Database credentials are set in your `.env` file
- Contact the team lead for database access details

### Installing Third-Party Plugins/Themes
1. Install via WordPress admin panel
2. They persist in Docker volume
3. Not tracked in Git (unless you modify `.gitignore`)

### Code Linting
The project includes automated linting for JavaScript and PHP files:

**JavaScript (ESLint)**
```bash
npm run lint        # Check JS files
npm run lint:fix    # Auto-fix JS issues
```

**PHP Linting & Formatting**
```bash
npm run lint:php       # Check PHP files for syntax issues
npm run format:php     # Preview PHP formatting changes
npm run format:php:fix # Apply PHP formatting fixes
```

**Combined**
```bash
npm run lint:all    # Check both JS and PHP files
npm run format:all  # Fix formatting for both JS and PHP
```

The linting checks for syntax errors, coding standards, and common issues. PHP formatting removes trailing whitespace, fixes spacing, and ensures consistent code style while preserving WordPress conventions.

## Production Deployment
** This setup is for local development only.

**To update production:**
1. Raise a Pull Request (PR) to [GitHub:Greenhouse-Culture](https://github.com/ianhuet/greenhouse-culture)
  - if a code change requires associated database changes detail them on the PR
3. When the PR is approved it will merge to `main`, and trigger an action to deploy these updates to the production codebase.
4. After the deployment is complete, review the live website ensuring everything is as expected.
5. Login into the production admin and make changes required to adopt the code change.


## Troubleshooting

### Port Already in Use
If port 8000 or 8080 is already in use, modify the ports in `docker-compose.yml`:
```yaml
ports:
  - "8001:80"  # Change 8000 to 8001
```

### Permission Issues
On Linux/Mac, if you encounter permission issues:
```bash
# Fix permissions for themes/plugins
chmod -R 755 wp-content/
```

### Database Connection Error
1. Ensure Docker containers are running: `docker-compose ps`
2. Check your `.env` file has correct database credentials
3. Verify you can reach the remote database host
4. Check logs: `docker-compose logs wordpress`

### "Error establishing a database connection"
- Verify your `.env` file exists and contains valid credentials
- Ensure the remote database server is accessible
- Contact team lead if you need new database credentials

### Resetting Everything
```bash
# Stop and remove all containers and volumes (database is remote)
docker-compose down -v
rm -rf wordpress_data
docker-compose up -d
```

## Resources
- [Docker Documentation](https://docs.docker.com/)
- [WordPress Developer Resources](https://developer.wordpress.org/)

## License
MIT licence

## Contributing
Ian Huet
