# Create database
echo "Creating airline database..."
bin/console doctrine:database:create

# Make migrations
echo "Executing migrations..."
bin/console doctrine:migrations:migrate

# Load fixtures
echo "Loading fixtures..."
bin/console doctrine:fixtures:load --append