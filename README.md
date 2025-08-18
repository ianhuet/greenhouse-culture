# WordPress Local Development Setup
- Cross-Platform, Free, Git-Friendly Development (Themes + Custom Plugins)

## Why Docker?
- **100% Free** (Docker Desktop is free for personal use)
- **Cross-platform** (identical setup on Windows, Mac, Linux)
- **Git-friendly**
- **Team consistency** (everyone gets the same environment)
- **Production-like** (mirrors real hosting environments)

## Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed
- Git installed
- Basic command line knowledge

## Quick Start

```bash
# 1. Clone this repository
git clone https://github.com/ianhuet/greenhouse-culture
cd greenhouse-culture

# 2. Copy environment template and configure
- create `.env` file in project root
- edit .env with your database credentials, provided separately

# 3. Start Docker container
docker-compose up -d

# 4. Access your site
- WordPress: http://localhost:8000
- Admin login: provided separately
```

## Project Structure

```
your-project/
├── docker-compose.yml          # Docker configuration (tracked in Git)
├── .gitignore                  # Git ignore rules (tracked in Git)
├── README.md                   # This file (tracked in Git)
├── .env.development            # Environment template (tracked in Git)
├── .env                        # Your actual credentials (NOT tracked in Git)
├── wp-content/
│   ├── themes/
│   │   └── greenhouseculture/ # Your custom theme (tracked in Git)
│   └── plugins/
│       ├── contributor-bio-block/ # Custom plugin (tracked in Git)
│       └── members-map/           # Custom plugin (tracked in Git)
└── [WordPress core files]      # Auto-generated (NOT tracked in Git)
```

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

### Starting Development
```bash
# Start containers in background
docker-compose up -d

# View logs if needed
docker-compose logs -f

# Stop containers
docker-compose down
```

### Installing WordPress
1. Navigate to http://localhost:8000
2. Follow WordPress installation wizard
3. Use any admin credentials you prefer

### Theme Development
- Edit files in `wp-content/themes/greenhouseculture/`
- Changes reflect immediately in browser
- All changes are tracked in Git

### Plugin Development
- Edit files in `wp-content/plugins/contributor-bio-block/` or `wp-content/plugins/members-map/`
- Activate plugins via WordPress admin
- These custom plugins are tracked in Git

### Database Management
- The development database is hosted remotely
- Database credentials are provided in your `.env` file
- Contact the team lead for database access details

### Installing Third-Party Plugins/Themes
1. Install via WordPress admin panel
2. They persist in Docker volume
3. Not tracked in Git (unless you modify `.gitignore`)

## Common Commands

```bash
# Start environment
docker-compose up -d

# Stop environment
docker-compose down

# Rebuild containers (after docker-compose.yml changes)
docker-compose up -d --build

# View WordPress logs
docker-compose logs wordpress

# Access WordPress container shell
docker-compose exec wordpress bash

# Run WP-CLI commands
docker-compose exec wordpress wp [command]

# Clean everything (local files only, database is remote)
docker-compose down -v
```
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
- [Docker Compose Reference](https://docs.docker.com/compose/)

## License
MIT licence

## Contributing
Ian Huet
